<?php

namespace App\Helpers;

final class PhoneNumberHelper
{
    /**
     * @return array<string>|int|string
     */
    public static function getStandardFromPretty(string $phoneNumber): array|int|string
    {
        return str_replace(
            ['+', '(', ')', '-', ' '],
            '',
            $phoneNumber,
        );
    }

    public static function getPrettyFromStandard(string $phoneNumber): string
    {
        if (preg_match('/^7\d{10}$/', $phoneNumber)) {
            return '+7 (' . substr($phoneNumber, 1, 3) . ') ' . substr($phoneNumber, 4, 3) . '-' . substr($phoneNumber, 7, 2) . '-' . substr($phoneNumber, 9, 2);
        }

        return $phoneNumber;

    }
}
