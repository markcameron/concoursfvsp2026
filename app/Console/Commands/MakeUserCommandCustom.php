<?php

namespace App\Console\Commands;

use Filament\Facades\Filament;
use Filament\Support\Commands\Concerns\CanValidateInput;
use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Console\Command;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Support\Facades\Hash;

class MakeUserCommandCustom extends Command
{
    use CanValidateInput;

    protected $description = 'Creates a Filament user with split fields for First and Last name.';

    protected $signature = 'make:filament-user-custom
                            {--first-name= : The first name of the user}
                            {--last-name= : The last name of the user}
                            {--email= : A valid and unique email address}
                            {--password= : The password for the user (min. 8 characters)}';

    protected array $options;

    protected function getUserData(): array
    {
        return [
            'first_name' => $this->validateInput(fn () => $this->options['first_name'] ?? $this->ask('First Name'), 'first_name', ['required'], fn () => $this->options['first_name'] = null),
            'last_name' => $this->validateInput(fn () => $this->options['last_name'] ?? $this->ask('Last Name'), 'last_name', ['required'], fn () => $this->options['last_name'] = null),
            'email' => $this->validateInput(fn () => $this->options['email'] ?? $this->ask('Email address'), 'email', ['required', 'email', 'unique:' . $this->getUserModel()], fn () => $this->options['email'] = null),
            'password' => Hash::make($this->validateInput(fn () => $this->options['password'] ?? $this->secret('Password'), 'password', ['required', 'min:8'], fn () => $this->options['password'] = null)),
            'email_verified_at' => now(),
        ];
    }

    protected function createUser(): Authenticatable
    {
        return static::getUserModel()::create($this->getUserData());
    }

    protected function sendSuccessMessage(Authenticatable $user): void
    {
        $loginUrl = route('filament.auth.login');
        $this->info('Success! ' . ($user->getAttribute('email') ?? $user->getAttribute('username') ?? 'You') . " may now log in at {$loginUrl}.");

        if ($this->getUserModel()::count() === 1 && $this->confirm('Would you like to show some love by starring the repo?', true)) {
            if (PHP_OS_FAMILY === 'Darwin') {
                exec('open https://github.com/filamentphp/filament');
            }
            if (PHP_OS_FAMILY === 'Linux') {
                exec('xdg-open https://github.com/filamentphp/filament');
            }
            if (PHP_OS_FAMILY === 'Windows') {
                exec('start https://github.com/filamentphp/filament');
            }

            $this->line('Thank you!');
        }
    }

    protected function getAuthGuard(): Guard
    {
        return Filament::auth();
    }

    protected function getUserProvider(): UserProvider
    {
        return $this->getAuthGuard()->getProvider();
    }

    protected function getUserModel(): string
    {
        /** @var EloquentUserProvider $provider */
        $provider = $this->getUserProvider();

        return $provider->getModel();
    }

    public function handle(): int
    {
        $this->options = $this->options();

        $user = $this->createUser();

        $this->sendSuccessMessage($user);

        return static::SUCCESS;
    }
}
