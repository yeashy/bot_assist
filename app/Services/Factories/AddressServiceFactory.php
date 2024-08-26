<?php

namespace App\Services\Factories;

use App\Enums\Factories\Address;
use App\Services\Http\API\Address\DadataService;
use App\Services\Http\API\Address\Geographical;

class AddressServiceFactory implements Factory
{

    public static function get(mixed $value, mixed $param = null): Geographical
    {
        return match ($value) {
            Address::Dadata => new DadataService(),
        };
    }
}
