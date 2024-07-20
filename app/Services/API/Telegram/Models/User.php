<?php

namespace App\Services\API\Telegram\Models;

use Illuminate\Contracts\Support\Arrayable;

class User implements Arrayable
{
    public int $id;
    public ?string $firstName;
    public ?string $lastName;
    public string $username;

    public function __construct(array $data)
    {
        $data = (object)$data;

        $this->id = $data->id;
        $this->firstName = !empty($data->first_name) ? $data->first_name : null;
        $this->lastName = !empty($data->last_name) ? $data->last_name : null;
        $this->username = $data->username;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'username' => $this->username,
        ];
    }
}
