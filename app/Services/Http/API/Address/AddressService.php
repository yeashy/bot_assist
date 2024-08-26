<?php

namespace App\Services\Http\API\Address;

use App\Enums\Factories\Address;
use App\Services\Factories\AddressServiceFactory;

class AddressService implements Geographical
{
    public function suggest(string $address): array
    {
        $service = AddressServiceFactory::get(Address::Dadata);

        $suggestions = $service->suggest($address);

        return [
            'suggestions' => $suggestions,
        ];
    }
}
