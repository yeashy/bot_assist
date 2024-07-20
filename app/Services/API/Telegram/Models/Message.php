<?php

namespace App\Services\API\Telegram\Models;

use App\Services\API\Telegram\Helpers\CommandHelper;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Facades\Log;

class Message implements Arrayable
{
    public int $id;
    public ?string $text;
    public string $date;
    public array $commands;
    public User $user;
    public ?Contact $contact = null;
    public Chat $chat;

    public function __construct(array $data = [])
    {
        $data = (object)$data;

        $this->id = $data->message_id;
        $this->text = !empty($data->text) ? $data->text : null;
        $this->date = Carbon::parse($data->date)->toDateTimeString();
        $this->commands = CommandHelper::getCommandsFromMessage($data);
        $this->user = new User($data->from);
        $this->contact = !empty($data->contact) ? new Contact($data->contact) : null;
        $this->chat = new Chat($data->chat);
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'text' => $this->text,
            'date' => $this->date,
            'commands' => $this->commands,
            'user' => $this->user->toArray(),
            'contact' => $this->contact->toArray(),
            'chat' => $this->chat->toArray(),
        ];
    }
}
