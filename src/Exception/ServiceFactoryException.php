<?php

namespace ServiceFactory\Exception;

use Exception;
use Throwable;

class ServiceFactoryException extends Exception
{
    function __construct($message = "", $code = 0, Throwable $previous = null){
        parent::__construct($message, $code, $previous);
    }
}
