<?php

namespace App\Filament\Resources\User\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                Select::make('role')
                    ->options([
            'super_admin' => 'Super admin',
            'admin_operasional' => 'Admin operasional',
            'instruktur' => 'Instruktur',
            'taruna' => 'Taruna',
            'pimpinan' => 'Pimpinan',
        ])
                    ->default('taruna')
                    ->required(),
                TextInput::make('avatar')
                    ->default(null),
                Toggle::make('is_active')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                DateTimePicker::make('email_verified_at'),
                TextInput::make('password')
                    ->password()
                    ->required(),
            ]);
    }
}

