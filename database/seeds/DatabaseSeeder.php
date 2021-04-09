<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Mail;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        // Disable sending mail when database seeds run
        Mail::fake();

        $this->call(DemoSeeder::class);
    }
}
