<?php

namespace Database\Seeders;

use App\Models\Property;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         User::factory()->create([
             'name' => 'Martin',
             'email' => 'martin@laravel-php.com',
             'password' => bcrypt('bla123')
         ]);

        User::factory(10)->create();

        Property::factory(10)->create(
            [
                'slider' => true,
            ]
        );
        Property::factory(50)->create();

    }
}
