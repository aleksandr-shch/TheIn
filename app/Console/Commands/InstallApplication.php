<?php

namespace App\Console\Commands;

use Closure;
use Illuminate\Console\Command;

class InstallApplication extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install application';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Run callback whe condition is true
     *
     * @param bool $condition
     * @param Closure $callback
     * @return InstallApplication
     */
    protected function when(bool $condition, Closure $callback): self
    {
        if ($condition) {
            call_user_func($callback, $this);
        }

        return $this;
    }

    /**
     * Generate application key
     *
     * @return $this
     */
    protected function generateApplicationKey(): self
    {
        $this->comment('Generate application key');
        $this->call('key:generate');

        return $this;
    }

    /**
     * Run database migrations
     *
     * @return $this
     */
    protected function runMigrations(): self
    {
        $this->comment('Run migrations');
        $this->call('migrate');

        return $this;
    }

    /**
     * Install laravel passport
     *
     * @return $this
     */
    protected function installLaravelPassport(): self
    {
        $this->comment('Install Laravel Passport');
        $this->call('passport:install');

        return $this;
    }

    /**
     * Run database seeds
     *
     * @return $this
     */
    protected function runDatabaseSeeds(): self
    {
        $this->comment('Run database seeds');
        $this->call('db:seed');

        return $this;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $environment = app()->environment();

        $this->info("Installing application in {$environment} environment.");

        $this
            ->generateApplicationKey()
            ->runMigrations()
            ->installLaravelPassport()
            ->when(app()->environment('local'), function (InstallApplication $command) {
                $command->runDatabaseSeeds();
            });

        $this->info('Application successful installed.');
    }
}
