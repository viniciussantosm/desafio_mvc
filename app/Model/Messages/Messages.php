<?php

namespace App\Model\Messages;

abstract class Messages {
    abstract public static function getMessage(string $name, $type = null):string;
}