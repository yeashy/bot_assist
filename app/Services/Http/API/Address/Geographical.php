<?php

namespace App\Services\Http\API\Address;

interface Geographical
{
    public function suggest(string $address): array;
}
