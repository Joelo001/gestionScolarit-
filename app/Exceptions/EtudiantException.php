<?php

namespace App\Exceptions;

use Exception;

class EtudiantException extends Exception
{
    //
    public function __construct(string $message = "", int $code = 0, \Throwable $previous = null){
        parent::__construct($message,$code);
    }
}
