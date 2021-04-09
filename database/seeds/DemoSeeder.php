<?php

use App\Organisation;
use App\User;
use Illuminate\Database\Seeder;

class DemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        factory(User::class, 10)
            ->create()->each(
                static function (User $user) {
                    factory(Organisation::class)->create(
                        [
                            'owner_user_id' => $user->id,
                        ]
                    );
                }
            );
    }
}
