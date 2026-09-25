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
                    ->label('Full Name')
                    ->required(),
                Select::make('role')
                    ->label('System Role')
                    ->options([
                        'super_admin' => 'Super Admin',
                        'admin_operasional' => 'Operations Admin',
                        'instruktur' => 'Flight Instructor',
                        'taruna' => 'Student / Cadet',
                        'pimpinan' => 'Head of Flight School',
                    ])
                    ->default('taruna')
                    ->required(),
                TextInput::make('avatar')
                    ->label('Avatar URL / Filename')
                    ->default(null),
                Toggle::make('is_active')
                    ->label('Active Status')
                    ->default(true)
                    ->required(),
                TextInput::make('email')
                    ->label('Email Address')
                    ->email()
                    ->required(),
                DateTimePicker::make('email_verified_at')
                    ->label('Email Verified At'),
                TextInput::make('password')
                    ->label('Password')
                    ->password()
                    ->required(),
            ]);
    }
}

