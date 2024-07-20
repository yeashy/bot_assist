<?php

namespace App\Services\API\Telegram\Commands;

use App\Models\Client;
use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Commands\Command;

class RegisterCommand extends Command
{
    protected string $name = 'register';
    protected string $description = 'Register a User';

    protected string $pattern = '{surname}
    {name}
    {patronymic}
    ';

    /**
     * @inheritDoc
     */
    public function handle(): void
    {
        $userId = $this->getUpdate()->getMessage()->from->id;

        $user = User::query()->where('external_id', $userId)->first();

        if ($user) {
            $company = Company::query()->where('bot_token', $this->getTelegram()->getAccessToken())->first();

            Log::debug(print_r($this->arguments, true));

            $name = $this->argument('name');
            $surname = $this->argument('surname');
            $patronymic = $this->argument('patronymic');

            if (!$name || !$surname) {
                $this->replyWithMessage([
                    'text' => 'Имя и фамилия должны быть заполнены! Попробуйте еще раз.'
                ]);

                return;
            }

            $client = new Client();
            $client->name = $name;
            $client->surname = $surname;
            $client->patronymic = $patronymic;
            $client->user_id = $user->id;
            $client->company_id = $company->id;
            $client->save();

            $this->replyWithMessage([
                'text' => 'Вы успешно зарегистрированы!'
            ]);
        } else {
            $this->replyWithMessage([
                'text' => 'Вашего номера нет в списке! Начните регистрацию командой /start'
            ]);
        }
    }
}
