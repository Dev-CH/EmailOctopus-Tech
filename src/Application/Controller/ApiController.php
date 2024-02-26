<?php

namespace Application\Controller;

use Application\Http\ApiResponse;

interface ApiController
{
    public function __invoke(array $vars): ApiResponse;
}