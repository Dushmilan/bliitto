<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class MakeAdminCommand extends Command
{
    protected $signature = 'make:admin
                            {--name= : The administrator name}
                            {--email= : The administrator email address}
                            {--password= : The administrator password}';

    protected $description = 'Create an administrator account, or update the password of an existing one';

    public function handle(): int
    {
        $name = $this->option('name') ?: $this->ask('Name');
        $email = $this->option('email') ?: $this->ask('Email address');
        $password = $this->option('password') ?: $this->secret('Password');

        if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->error('That email address is not valid.');

            return self::FAILURE;
        }

        if (strlen((string) $password) < 8) {
            $this->error('The password must be at least 8 characters.');

            return self::FAILURE;
        }

        $existed = User::where('email', $email)->exists();

        $user = User::updateOrCreate(
            ['email' => $email],
            ['name' => $name, 'password' => Hash::make($password)],
        );

        $this->info(sprintf(
            'Administrator %s %s.',
            $user->email,
            $existed ? 'already existed — password updated' : 'created',
        ));

        return self::SUCCESS;
    }
}
