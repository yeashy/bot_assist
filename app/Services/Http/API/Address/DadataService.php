<?php

namespace App\Services\Http\API\Address;

use Exception;
use MoveMoveIo\DaData\DaDataAddress;

class DadataService implements Geographical
{
    /**
     * @throws Exception
     */
    public function suggest(string $address): array
    {
        $response = (new DaDataAddress())->prompt(
            $address,
            5,
            from_bound: ['value' => 'city'],
            to_bound: ['value' => 'house']
        );

        return array_map(function ($suggestion) {
            return [
                'name' => $suggestion['value'],
                'latitude' => $suggestion['data']['geo_lat'],
                'longitude' => $suggestion['data']['geo_lon'],
            ];
        }, $response['suggestions']);
    }
}
