<?php

namespace Database\Seeders;

use App\Models\User;
use Hash;
use Illuminate\Database\Seeder;
use Str;

class UserSeeder extends Seeder
{
    protected static ?string $password = 'danielCosta@test.com';

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //ADMIN PARA TESTES  
        User::firstOrCreate(
            ['email' => 'admin@escola.com'],
            [
                'name' => 'Maria Thereza',
                'tipo_usuario' => 'admin',
                'password' => Hash::make('senha123'),


            ]
        );
        // ALUNO PARA TESTES
        User::firstOrCreate(
            ['email' => 'danielCosta@test.com'],
            [
                'name' => 'Daniel Costa',
                'tipo_usuario' => 'aluno',
                'email_verified_at' => now(),
                'password' => static::$password ??= Hash::make('password'),
                'two_factor_secret' => null,
                'two_factor_recovery_codes' => null,
                'remember_token' => Str::random(10),
                'matricula' => '0076107'
            ]

        );
        //ORIENTADOR PARA TESTES
        User::firstOrCreate(
            ['email' => 'danielFaria@test.com'],
            [
                'name' => 'Daniel Costa',
                'tipo_usuario' => 'orientador',
                'email_verified_at' => now(),
                'password' => Hash::make('costa1234'),
                'two_factor_secret' => null,
                'two_factor_recovery_codes' => null,
                'remember_token' => Str::random(10),
            ]

        );

        //ORIENTADOR PARA TESTES
        User::firstOrCreate(
            ['email' => 'lucasAPV@test.com'],
            [
                'name' => 'Lucas APV',
                'tipo_usuario' => 'orientador',
                'email_verified_at' => now(),
                'password' => Hash::make('lulu1234'),
                'two_factor_secret' => null,
                'two_factor_recovery_codes' => null,
                'remember_token' => Str::random(10),
            ]
        );

        // ALUNO PARA TESTES
        User::firstOrCreate(
            ['email' => 'bit@test.com'],
            [
                'name' => 'Beatriz',
                'tipo_usuario' => 'aluno',
                'email_verified_at' => now(),
                'password' => Hash::make('biti1234'),
                'two_factor_secret' => null,
                'two_factor_recovery_codes' => null,
                'remember_token' => Str::random(10),
                'matricula' => fake()->numerify('#######')
            ]

        );
        User::factory()->count(10)->create();


    }
}
