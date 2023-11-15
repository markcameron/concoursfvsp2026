<?php

namespace App\Filament\Account\Pages;

use Filament\Forms;
use App\Models\User;
use Filament\Pages\Page;
use Illuminate\Http\Request;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;

class FinalizeAccount extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.account.pages.finalize-account';

    protected static ?string $title = 'Finaliser votre compte';

    public ?User $user;

    public string $email;
    public string $first_name;
    public string $last_name;
    public string $password;
    public string $token;

    public function mount(Request $request)
    {
        $this->user = User::where('create_token', $request->token)->firstOrFail();

        $this->email = $this->user->email;
        $this->first_name = $this->user->first_name;
        $this->last_name = $this->user->last_name;
        $this->password = '';
        $this->token = $request->token;
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('email')
                ->label(__('fields.email'))
                ->readOnly()
                ->disabled(),
            Forms\Components\TextInput::make('first_name')
                ->label(__('fields.first_name'))
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('last_name')
                ->label(__('fields.last_name'))
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('password')
                ->label(__('fields.password'))
                ->password()
                ->required(),
            Forms\Components\Hidden::make('token')
                ->required(),
        ];
    }

    public function submit(Request $request)
    {
        $validated = $this->validate();

        $this->user = User::where('create_token', $validated['token'])->firstOrFail();

        $this->user->update([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email_verified_at' => now(),
            'password' => Hash::make($validated['password']),
            'create_token' => null,
        ]);

        return redirect()->route('filament.admin.pages.dashboard');
    }
}
