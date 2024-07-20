<?php

namespace App\Console\Commands\API\Telegram;

use App\Models\Company;
use App\Services\API\Telegram\TelegramService;
use App\Services\API\Telegram\WebhookService;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;

class SetTelegramWebhooks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api:telegram:set-webhooks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $companies = $this->getCompanies();

        $this->logStart();

        $totalIntegrated = $this->integrateCompanies($companies);

        $this->logEnd($totalIntegrated);
    }

    private function getCompanies(): Collection
    {
        return Company::query()->get();
    }

    private function integrateCompanies(Collection $companies): int
    {
        $totalIntegrated = 0;

        foreach ($companies as $company) {
            $isIntegrated = $this->integrateCompany($company);

            $totalIntegrated += $isIntegrated ? 1 : 0;
        }

        return $totalIntegrated;
    }

    private function integrateCompany(Company $company): bool
    {
        try {
            $this->logTrying($company->id);

            $service = new WebhookService($company->bot_token);

            $service->integrate();

            $this->logSuccess();

            return true;
        } catch (Exception $e) {
            $this->logError($e->getMessage());
        }

        return false;
    }

    private function logStart(): void
    {
        Log::debug('=== STARTING TO SET TELEGRAM WEBHOOKS TO COMPANIES ===' . PHP_EOL);
    }

    private function logEnd(int $total): void
    {
        Log::debug('=== SUCCESSFULLY INTEGRATED ' . $total . ' COMPANIES ===' . PHP_EOL);
    }

    private function logTrying(int $companyId): void
    {
        Log::debug('Trying to integrate company ID: ' . $companyId);
    }

    private function logSuccess(): void
    {
        Log::debug('Successfully integrated' .  PHP_EOL);
    }

    private function logError(string $message): void
    {
        Log::debug('Error while integrating. Check the message below.');
        Log::error($message . PHP_EOL);
    }
}
