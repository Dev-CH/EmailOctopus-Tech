<?php

namespace Infrastructure\Http;

use Application\Http\ApiResponse;

class Response implements ApiResponse
{
    private function __construct(
        private readonly string $content,
        private readonly int $status = 200,
    ) {
    }

    private function setHeaders(): void
    {
        http_response_code($this->status);

        header('Content-Type: application/json');
        header('Cache-Control: no-cache, no-store, must-revalidate');
        header('Access-Control-Allow-Origin: *');
        header('Content-Length: ' . strlen($this->content));
    }

    public static function create(mixed $content, int $status = 200): Response
    {
        return new Response(json_encode($content), $status);
    }

    public function send(): void
    {
        $this->setHeaders();

        echo $this->content;
    }
}