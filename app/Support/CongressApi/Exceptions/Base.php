<?php

namespace App\Support\CongressApi\Exceptions;

abstract class Base extends \RuntimeException
{
    public $response;
}
