<?php

namespace Application\Http;

readonly class Route
{
    private function __construct(
        public string $method,
        public string $uri,
        public string $handler,
    ) {
    }

    public static function get(string $uri, string $handler): Route
    {
        return new Route('GET', $uri, $handler);
    }

    public static function post(string $uri, string $handler): Route
    {
        return new Route('POST', $uri, $handler);
    }

    public static function delete(string $uri, string $handler): Route
    {
        return new Route('DELETE', $uri, $handler);
    }
}