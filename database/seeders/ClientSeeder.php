<?php

namespace Database\Seeders;

use App\Enum\ProfileTypeEnum;
use App\Models\Administrator;
use App\Models\Client;
use App\Models\User;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $client = Client::factory()->create();
        User::factory()->create([
            'name' => 'Client 1',
            'email' => 'client1@yahoo.com.br',
            'password' => bcrypt('password'),
            'profile_type' => ProfileTypeEnum::Client->value,
            'profile_id' => $client->id,
        ]);
    }
}
