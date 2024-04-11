<?php

namespace App\Filament\Imports;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Models\Import;

class UserImporter extends Importer
{
    protected static ?string $model = User::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('email')
                ->label(__('fields.email'))
                ->requiredMapping()
                ->rules(['required', 'max:255']),

            ImportColumn::make('alias')
                ->label(__('fields.alias'))
                ->requiredMapping()
                ->rules(['required', 'max:4']),

            ImportColumn::make('last_name')
                ->label(__('fields.last_name'))
                ->requiredMapping()
                ->rules(['required', 'max:255']),

            ImportColumn::make('first_name')
                ->label(__('fields.first_name'))
                ->requiredMapping()
                ->rules(['required', 'max:255']),
        ];
    }

    public function resolveRecord(): ?User
    {
        return User::firstOrNew([
            // Update existing records, matching them by `$this->data['column_name']`
            'email' => $this->data['email'],
        ]);
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your user import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }

    protected function beforeSave(): void
    {
        $this->record->password = $this->record->password ?? Hash::make(Str::random(32));
    }
}
