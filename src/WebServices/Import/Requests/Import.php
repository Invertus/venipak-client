<?php

declare(strict_types=1);

namespace Invertus\VenipakApiClient\WebServices\Import\Requests;

use Saloon\Contracts\Body\HasBody;
use Saloon\Contracts\Response;
use Saloon\Data\MultipartValue;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasMultipartBody;

class Import extends Request implements HasBody
{
    protected Method $method = Method::POST;

    use HasMultipartBody;

    public function __construct(
        protected readonly string $userName,
        protected readonly string $password,
        protected readonly string $xmlFile,
        protected readonly string $xmlText
    )
    {
    }

    public function resolveEndpoint(): string
    {
        return '/import/send.php';
    }

    public function createDtoFromResponse(Response $response): string|array
    {
        $responseXml = $response->body();

        $xml = simplexml_load_string($responseXml);

        if ($xml->getName() === 'answer') {
            $answerType = (string)$xml['type'];

            if ($answerType === 'error') {
                $errors = $xml->error;
                $errorsData = [];

                foreach ($errors as $error) {
                    $errorCode = (string)$error['code'];
                    $errorMessage = (string)$error->text;

                    $errorsData[] = "Error code: $errorCode, Message: $errorMessage" . PHP_EOL;
                }

                return $errorsData;
            }

            if ($answerType === 'ok') {
                $data = [];
                foreach ($xml->text as $item) {
                    $data[] = $item;
                }

                return array_map('current', $data);
            }
        } else {
            throw new \Exception('Invalid XML response received');
        }

        return $response->body();
    }

    protected function defaultBody(): array
    {
        return [
            new MultipartValue('user', $this->userName),
            new MultipartValue('pass', $this->password),
            new MultipartValue('xml_file', $this->xmlFile),
            new MultipartValue('xml_text', $this->xmlText)
        ];
    }
}