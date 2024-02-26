<?php

namespace Application\Http;

interface ApiResponse
{
    public function send(): void;
}