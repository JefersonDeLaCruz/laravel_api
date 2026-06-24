<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name'   => 'Nuevo',
                'email'  => 'nuevo@test.com',
                'score'  => 0,
                'level'  => User::LEVEL_NUEVO,
            ],
            [
                'name'   => 'Colaborador',
                'email'  => 'colaborador@test.com',
                'score'  => User::SCORE_COLABORADOR,
                'level'  => User::LEVEL_COLABORADOR,
            ],
            [
                'name'   => 'Guardian',
                'email'  => 'guardian@test.com',
                'score'  => User::SCORE_GUARDIAN,
                'level'  => User::LEVEL_GUARDIAN,
            ],
            [
                'name'   => 'Experto',
                'email'  => 'experto@test.com',
                'score'  => User::SCORE_EXPERTO,
                'level'  => User::LEVEL_EXPERTO,
            ],
        ];

        foreach ($users as $data) {
            User::updateOrCreate(
                ['email' => $data['email']],
                array_merge($data, [
                    'password'           => Hash::make($data['email']),
                    'email_verified_at'  => now(),
                ])
            );
        }
    }
}
