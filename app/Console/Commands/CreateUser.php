<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateUser extends Command
{
    protected $signature = 'user:create';

    protected $description = '';

    public function handle(): int
    {
        $name = $this->ask('Name');
        $email = $this->ask('Email');

        if (User::where('email', $email)->exists()) {
            $this->error("Email exists {$email}");
            return self::FAILURE;
        }

        $password = $this->secret('Pw');
        $passwordConfirm = $this->secret('Repeat pw');

        if ($password !== $passwordConfirm) {
            $this->error('Does not match.');
            return self::FAILURE;
        }

        $user = User::create([
            'name'     => $name,
            'email'    => $email,
            'password' => Hash::make($password),
        ]);

        $this->info("✅ User {$user->email} created (ID: {$user->id})");

        return self::SUCCESS;
    }
}
