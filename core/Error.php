<?php

namespace core;

class Error
{
    public int $code;

    public ?string $message;

    public function __construct($code, $message = null)
    {
        $this->code = $code;
        $this->message = $message;
    }

    public const ALLOWED_ERRORS_TYPES = [403, 404];

}