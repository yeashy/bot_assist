<?php

namespace App\Helpers;

class TextTransformHelper
{
    public static function toSnakeCase(string $inputString): string
    {
        $snakeCaseString = preg_replace('/[^A-Za-z0-9]+/', '_', $inputString);
        $snakeCaseString = strtolower($snakeCaseString);
        $snakeCaseString = trim($snakeCaseString, '_');
        return $snakeCaseString;
    }
}
