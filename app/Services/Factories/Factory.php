<?php

namespace App\Services\Factories;

interface Factory
{
    public static function get(mixed $value, mixed $param = null): mixed;
}
