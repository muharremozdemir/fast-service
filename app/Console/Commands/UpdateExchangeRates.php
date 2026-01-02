<?php

namespace App\Console\Commands;

use App\Services\TcmbService;
use Illuminate\Console\Command;

class UpdateExchangeRates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'currency:update-rates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'TCMB\'den güncel döviz kurlarını çek ve güncelle';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('TCMB\'den döviz kurları güncelleniyor...');

        $tcmbService = new TcmbService();
        $result = $tcmbService->updateExchangeRates();

        if ($result) {
            $this->info('Döviz kurları başarıyla güncellendi!');
            return Command::SUCCESS;
        } else {
            $this->error('Döviz kurları güncellenirken bir hata oluştu!');
            return Command::FAILURE;
        }
    }
}
