<?php

namespace App\Services\API\Telegram\Models;

use Illuminate\Contracts\Support\Arrayable;

class Contact implements Arrayable
{
    public string $phoneNumber;
    public string $firstName;
    public string $lastName;
    public int $userId;

    public function __construct(array $data)
    {
        $data = (object)$data;

        $this->phoneNumber = $data->phone_number;
        $this->userId = $data->user_id;
    }

    public function toArray(): array
    {
        return [
            'phoneNumber' => $this->phoneNumber,
            'user_id' => $this->userId,
        ];
    }
}
