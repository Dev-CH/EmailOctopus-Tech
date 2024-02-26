<?php

namespace Application\Controller;

use Application\Http\ViewInterface;

interface ViewController
{
    public function __invoke(array $vars): ViewInterface;
}