<?php

namespace App\Services\API\Telegram\Handlers;

use App\Models\Client;
use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class MessageHandler extends UpdateHandler
{
    public function handle(): void
    {
        if ($this->isAuthorizing()) {
            $user = User::query()->where('external_id', $this->message->user->id)->first();

            Log::debug(print_r($this->message->toArray(), true));

            if (!$user) {
                $user = new User();
                $user->external_id = $this->message->user->id;
                $user->name = $this->message->user->username;
                $user->phone_number = $this->message->contact->phoneNumber;
                $user->save();

                $this->telegram->sendMessage([
                    'chat_id' => $this->message->chat->id,
                    'text' =>
                        'Кажется, Вас еще нет у нас в списке! ' .
                        'Давайте зарегистрируемся.' . PHP_EOL . PHP_EOL .
                        'Напишите /register, и далее укажите ФИО, как в паспорте, пример: ' . PHP_EOL . PHP_EOL .
                        '/register Иванов Иван Иванович'
                ]);
            } else {
                $company = Company::query()->where('bot_token', $this->token)->first();
                $client = Client::query()
                    ->where('company_id', $company->id)
                    ->where('user_id', $user->id)
                    ->first();

                if (!$client) {
                    $this->telegram->sendMessage([
                        'chat_id' => $this->message->chat->id,
                        'text' =>
                            'Кажется, Вас еще нет у нас в списке! ' .
                            'Давайте зарегистрируемся.' . PHP_EOL . PHP_EOL .
                            'Напишите /register, и далее укажите ФИО, как в паспорте, пример: ' . PHP_EOL . PHP_EOL .
                            '/register Иванов Иван Иванович'
                    ]);
                } else {
                    $this->telegram->sendMessage([
                        'chat_id' => $this->message->chat->id,
                        'text' => 'Здравствуйте, ' . $client->full_name . '!'
                    ]);
                }
            }

            return;
        }

        $this->telegram->sendMessage([
            'chat_id' => $this->message->chat->id,
            'text' => 'Неизвестный тип сообщения. Для начала работы напишите /start'
        ]);
    }

    private function isAuthorizing(): bool
    {
        if ($this->message->contact && $this->message->contact->userId === $this->message->user->id) {
            return true;
        }

        return false;
    }
}
