<?php

namespace Application\Connection;

interface ConnectionProviderInterface
{
    public function connect(): Connection;

    public function exit(): void;
}