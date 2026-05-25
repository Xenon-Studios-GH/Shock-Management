<?php

namespace App\Console\Commands;

use App\Models\LoginLog;
use App\Models\StockTransaction;
use Illuminate\Console\Command;

class CleanOldTransactions extends Command
{
    protected $signature = 'app:clean-old-transactions';

    protected $description = 'Delete stock transactions and login logs older than 120 days';

    public function handle()
    {
        $cutoff = now()->subDays(120);

        $deletedTransactions = StockTransaction::where('created_at', '<', $cutoff)->delete();
        $this->info("Deleted {$deletedTransactions} transaction(s) older than 120 days.");

        $deletedLogs = LoginLog::where('login_at', '<', $cutoff)->delete();
        $this->info("Deleted {$deletedLogs} login log(s) older than 120 days.");
    }
}
