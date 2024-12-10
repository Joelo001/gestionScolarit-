<?php

namespace App\Exceptions;

use Exception;

class EmploieTempsException extends Exception
{
    protected $message;
    public function __construct($message=""){
        $this->message=$message;
    }
}
