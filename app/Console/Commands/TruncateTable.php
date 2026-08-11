<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class TruncateTable extends Command
{
    protected $signature = 'truncate:table {table}'; // Accepts table name as argument
    protected $description = 'Truncate a specific database table';

    public function handle()
    {
        $table = $this->argument('table');

        if (!$this->confirm("Are you sure you want to truncate the table: $table?")) {
            $this->info("Operation canceled.");
            return;
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=0;'); // Disable foreign key constraints
        DB::table($table)->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;'); // Re-enable constraints

        $this->info("Table '$table' has been truncated successfully.");
    }
}
