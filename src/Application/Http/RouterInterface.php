<?php

namespace Application\Http;

interface RouterInterface
{
    public function dispatch(): void;
}