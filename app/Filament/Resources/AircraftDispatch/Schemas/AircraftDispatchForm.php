<?php
namespace App\Filament\Resources\AircraftDispatch\Schemas;
use App\Models\Instruktur;
use App\Models\Pesawat;
use App\Models\Taruna;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
class AircraftDispatchForm {
    public static function configure(Schema $schema): Schema {
        return $schema->components([
            Section::make('Flight Info')->columns(2)->schema([
                Select::make('pesawat_id')->label('Aircraft')->relationship('pesawat','nama_pesawat')->getOptionLabelFromRecordUsing(fn(Pesawat $r)=>"{$r->nomor_registrasi} - {$r->nama_pesawat}")->searchable()->preload()->required(),
                Select::make('instruktur_id')->label('Instructor')->relationship('instruktur','nama')->searchable()->preload()->required(),
                Select::make('taruna_id')->label('Student / Cadet')->relationship('taruna','nama')->getOptionLabelFromRecordUsing(fn(Taruna $r)=>"{$r->nama} ({$r->nim})")->searchable()->preload()->required(),
                Select::make('jadwal_penerbangan_id')->label('Linked Schedule')->relationship('jadwalPenerbangan','kode_jadwal')->searchable()->preload()->nullable(),
                DatePicker::make('dispatch_date')->label('Dispatch Date')->required()->default(now()),
                TimePicker::make('planned_departure')->label('Planned Departure'),
                TimePicker::make('actual_departure')->label('Actual Departure'),
                TimePicker::make('actual_return')->label('Actual Return'),
            ]),
            Section::make('Hobbs & Fuel')->columns(3)->schema([
                TextInput::make('hobbs_start')->label('Hobbs Start')->numeric()->suffix('hrs'),
                TextInput::make('hobbs_end')->label('Hobbs End')->numeric()->suffix('hrs'),
                TextInput::make('fuel_before_liters')->label('Fuel Before')->numeric()->suffix('L'),
                TextInput::make('fuel_added_liters')->label('Fuel Added')->numeric()->suffix('L'),
                TextInput::make('fuel_after_liters')->label('Fuel After')->numeric()->suffix('L'),
                TextInput::make('tach_start')->label('Tach Start')->numeric(),
                TextInput::make('tach_end')->label('Tach End')->numeric(),
            ]),
            Section::make('Weather & ATC')->columns(2)->schema([
                TextInput::make('weather_conditions')->label('Weather (METAR/ATIS)')->columnSpanFull(),
                TextInput::make('visibility_meters')->label('Visibility')->numeric()->suffix('m'),
                TextInput::make('wind_info')->label('Wind')->placeholder('e.g. 090/10kt'),
                TextInput::make('cloud_ceiling_ft')->label('Cloud Ceiling')->numeric()->suffix('ft'),
                Toggle::make('atc_clearance_obtained')->label('ATC Clearance Obtained')->default(false),
                TextInput::make('atc_clearance_code')->label('ATC Clearance Code'),
            ]),
            Section::make('Notes & Status')->schema([
                Textarea::make('pre_flight_check_notes')->label('Pre-Flight Check Notes')->rows(3)->columnSpanFull(),
                Textarea::make('post_flight_notes')->label('Post-Flight Notes')->rows(3)->columnSpanFull(),
                Select::make('status')->label('Status')->options(['planned'=>'Planned','dispatched'=>'Dispatched','airborne'=>'Airborne','returned'=>'Returned','cancelled'=>'Cancelled'])->required()->default('planned'),
            ]),
        ]);
    }
}
