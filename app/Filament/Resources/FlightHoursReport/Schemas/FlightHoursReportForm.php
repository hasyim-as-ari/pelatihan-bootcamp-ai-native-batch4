<?php
namespace App\Filament\Resources\FlightHoursReport\Schemas;
use App\Models\Pesawat;
use App\Models\Taruna;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
class FlightHoursReportForm {
    public static function configure(Schema $schema): Schema {
        return $schema->components([
            Section::make('Report Period')->columns(2)->schema([
                Select::make('period_type')->label('Period Type')->options(['monthly'=>'Monthly','quarterly'=>'Quarterly','semester'=>'Semester','annual'=>'Annual','custom'=>'Custom'])->required()->default('monthly')->reactive(),
                TextInput::make('period_year')->label('Year')->numeric()->required()->default(date('Y')),
                TextInput::make('period_month')->label('Month (1-12)')->numeric()->minValue(1)->maxValue(12)->placeholder('Leave blank for non-monthly'),
                DatePicker::make('period_start')->label('Period Start')->required(),
                DatePicker::make('period_end')->label('Period End')->required(),
            ]),
            Section::make('Scope')->columns(2)->schema([
                Select::make('taruna_id')->label('Student (blank = all students)')->relationship('taruna','nama')->getOptionLabelFromRecordUsing(fn(Taruna $r)=>"{$r->nama} ({$r->nim})")->searchable()->preload()->nullable(),
                Select::make('pesawat_id')->label('Aircraft (blank = all aircraft)')->relationship('pesawat','nama_pesawat')->getOptionLabelFromRecordUsing(fn(Pesawat $r)=>"{$r->nomor_registrasi} {$r->nama_pesawat}")->searchable()->preload()->nullable(),
            ]),
            Section::make('Flight Hours Summary')->columns(3)->schema([
                TextInput::make('total_flight_hours')->label('Total Flight Hours')->numeric()->default(0)->suffix('hrs'),
                TextInput::make('dual_hours')->label('Dual Instruction Hours')->numeric()->default(0)->suffix('hrs'),
                TextInput::make('solo_hours')->label('Solo Hours')->numeric()->default(0)->suffix('hrs'),
                TextInput::make('total_flights')->label('Total Flights')->numeric()->default(0),
                TextInput::make('total_landings')->label('Total Landings')->numeric()->default(0),
            ]),
            Section::make('Status')->schema([
                Select::make('status')->label('Status')->options(['draft'=>'Draft','generated'=>'Generated','approved'=>'Approved','published'=>'Published'])->required()->default('draft'),
                Textarea::make('notes')->label('Notes')->rows(3)->columnSpanFull(),
            ]),
        ]);
    }
}
