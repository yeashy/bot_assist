<?php

namespace App\Helpers;

class PhoneNumberHelper
{
    public static function getStandardFromPretty(string|int $phoneNumber): array|int|string
    {
        return str_replace(
            ['+', '(', ')', '-', ' '],
            '',
            $phoneNumber
        );
    }

    public static function getPrettyFromStandard(string|int $phoneNumber): string
    {
        if (preg_match('/^7\d{10}$/', $phoneNumber)) {
            return '+7 (' . substr($phoneNumber, 1, 3) . ') ' . substr($phoneNumber, 4, 3) . '-' . substr($phoneNumber, 7, 2) . '-' . substr($phoneNumber, 9, 2);
        } else {
            return $phoneNumber;
        }
    }
}
