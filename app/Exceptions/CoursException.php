<?php

namespace App\Exceptions;

use Exception;

class CoursException extends Exception
{
    protected $message;
    public function __construct($message=""){
        $this->message=$message;
    }
}
