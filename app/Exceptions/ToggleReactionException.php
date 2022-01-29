<?php

namespace App\Exceptions;

use Exception;

class ToggleReactionException extends Exception
{
    public $message;

    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        $this->message = $message;
    }

    public function render($request)
    {
        return $this->message;
    }
}
