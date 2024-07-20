<?php

namespace App\Services\API\Telegram\Models;

use Illuminate\Contracts\Support\Arrayable;

class Chat implements Arrayable
{

    public int $id;
    public string $type;

    public function __construct(array $data)
    {
        $data = (object)$data;

        $this->id = $data->id;
        $this->type = $data->type;
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
        ];
    }
}
