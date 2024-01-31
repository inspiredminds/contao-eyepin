<?php

declare(strict_types=1);

/*
 * This file is part of the Contao eyepin Gateway extension.
 *
 * (c) INSPIRED MINDS
 */

namespace InspiredMinds\ContaoEyepinGateway\Gateway;

use Codefog\HasteBundle\StringParser;
use Contao\StringUtil;
use Contao\System;
use Contao\Validator;
use InspiredMinds\EyepinApi\EyepinApi;
use InspiredMinds\EyepinApi\EyepinApiFactory;
use InspiredMinds\EyepinApi\Model\AddressList;
use InspiredMinds\EyepinApi\Model\Request\AddressInsertRequest;
use InspiredMinds\EyepinApi\Model\Request\AddressListAddRequest;
use NotificationCenter\Gateway\Base;
use NotificationCenter\Gateway\GatewayInterface;
use NotificationCenter\Model\Gateway;
use NotificationCenter\Model\Message;
use Psr\Log\LoggerInterface;
use Symfony\Component\ExpressionLanguage\ExpressionFunction;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;
use Symfony\Component\ExpressionLanguage\SyntaxError;
use Symfony\Component\HttpKernel\Kernel;

class EyepinGateway extends Base implements GatewayInterface
{
    final public const TYPE = 'eyepin';

    private readonly EyepinApi $api;

    private readonly StringParser $stringParser;

    private readonly ExpressionLanguage $expressionLanguage;

    public function __construct(Gateway $model)
    {
        parent::__construct($model);

        if ($model->eyepinUsername && $model->eyepinPassword) {
            /** @var EyepinApiFactory $eyepinApiFactory */
            $eyepinApiFactory = System::getContainer()->get(EyepinApiFactory::class);
            $this->api = $eyepinApiFactory->createForCredentials($model->eyepinUsername, $model->eyepinPassword);
        }

        $this->stringParser = new StringParser();
        $this->expressionLanguage = new ExpressionLanguage();
        $this->expressionLanguage->addFunction(ExpressionFunction::fromPhp('in_array'));
        $this->expressionLanguage->addFunction(ExpressionFunction::fromPhp('explode'));
    }

    public function send(Message $message, array $tokens, $language = ''): bool
    {
        if (!$this->api) {
            return true;
        }

        try {
            if (!$this->matchExpression($message, $tokens, $language)) {
                return true;
            }

            match ($message->eyepinAction) {
                'createAddress' => $this->createAddress($message, $tokens),
                'addToLists' => $this->addToLists($message, $tokens),
                default => throw new \InvalidArgumentException('Action "'.$message->eyepinAction.'" is not implemented.'),
            };
        } catch (\Throwable $e) {
            /** @var Kernel $kernel */
            $kernel = System::getContainer()->get('kernel');

            if ($kernel->isDebug()) {
                throw $e;
            }

            /** @var LoggerInterface $contaoErrorLogger */
            $contaoErrorLogger = System::getContainer()->get('monolog.logger.contao.error');
            $contaoErrorLogger->error($e->getMessage());
        }

        return true;
    }

    private function createAddress(Message $message, array $tokens): void
    {
        $email = $this->stringParser->recursiveReplaceTokensAndTags((string) $message->eyepinEmail, $tokens);

        if (!$email || !Validator::isEmail($email)) {
            throw new \InvalidArgumentException('Invalid email address given.');
        }

        $fields = $this->getParameters($message, $tokens);

        $addressInsertRequest = new AddressInsertRequest();
        $addressInsertRequest->status = '1';
        $addressInsertRequest->setData($fields);
        $addressInsertRequest->email = $email;

        $logMessage = sprintf('eyepin: created/updated "%s"', $email);

        if ($listIds = StringUtil::deserialize($message->eyepinLists, true)) {
            foreach ($listIds as $listId) {
                $addressInsertRequest->lists[] = new AddressList((int) $listId);
            }

            $logMessage .= sprintf(' and added to lists %s', implode(', ', $listIds));
        }

        $this->api->createUpdateAddress($addressInsertRequest);

        /** @var LoggerInterface $contaoLogger */
        $contaoLogger = System::getContainer()->get('monolog.logger.contao.general');
        $contaoLogger->info($logMessage);
    }

    private function addToLists(Message $message, array $tokens): void
    {
        $email = $this->stringParser->recursiveReplaceTokensAndTags((string) $message->eyepinEmail, $tokens);

        if (!$email || !Validator::isEmail($email)) {
            throw new \InvalidArgumentException('Invalid email address given.');
        }

        if ($listIds = StringUtil::deserialize($message->eyepinLists, true)) {
            foreach ($listIds as $listId) {
                $request = new AddressListAddRequest(id: (int) $listId, addresses: [$email]);
                $this->api->addToList($request);
            }

            /** @var LoggerInterface $contaoLogger */
            $contaoLogger = System::getContainer()->get('monolog.logger.contao.general');
            $contaoLogger->info(sprintf('eyepin: added "%s" to lists %s', $email, implode(', ', $listIds)));
        }
    }

    private function getParameters(Message $message, array $tokens): array
    {
        $messageParams = StringUtil::deserialize($message->eyepinParameters, true);
        $processedParams = [];

        foreach ($messageParams as $param) {
            $key = $this->stringParser->recursiveReplaceTokensAndTags((string) $param['key'], $tokens);
            $value = $this->stringParser->recursiveReplaceTokensAndTags((string) $param['value'], $tokens);
            $processedParams[$key] = $value;
        }

        return $processedParams;
    }

    private function matchExpression(Message $message, array $tokens, string $language): bool
    {
        if ('' === ($expression = (string) $message->eyepinExpression)) {
            return true;
        }

        $data = $tokens + [
            'language' => $language,
            'request' => System::getContainer()->get('request_stack')->getCurrentRequest(),
            'page' => $GLOBALS['objPage'] ?? null,
        ];

        try {
            return (bool) $this->expressionLanguage->evaluate($expression, $data);
        } catch (SyntaxError) {
            return false;
        }
    }
}
