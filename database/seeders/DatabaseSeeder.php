<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DataSource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $dataSources = [
            [
                'name' => 'Provider1',
                'base_url' => 'https://raw.githubusercontent.com/WEG-Technology/mock/refs/heads/main/v2/provider1',
                'format' => 'json',
                'parser_class' => 'App\\Services\\Parsers\\JsonSourceParser',
                'rate_limit_per_minute' => 60,
                'enabled' => true,
            ],
            [
                'name' => 'Provider2',
                'base_url' => 'https://raw.githubusercontent.com/WEG-Technology/mock/refs/heads/main/v2/provider2',
                'format' => 'xml',
                'parser_class' => 'App\\Services\\Parsers\\XmlSourceParser',
                'rate_limit_per_minute' => 60,
                'enabled' => true,
            ],
        ];

        foreach ($dataSources as $source) {
            DataSource::updateOrCreate(
                ['base_url' => $source['base_url']],
                $source
            );
        }

        $users = [
            [
                'name' => 'First User',
                'email' => 'first_user@example.com',
                'password' => Hash::make('12345'),
                'type' => 'portal',
            ],
            [
                'name' => 'Second User',
                'email' => 'second_user@example.com',
                'password' => Hash::make('12345'),
                'type' => 'admin',
            ],
        ];

        foreach ($users as $user) {
            User::updateOrCreate(
                ['email' => $user['email']],
                $user
            );
        }
    }
}
