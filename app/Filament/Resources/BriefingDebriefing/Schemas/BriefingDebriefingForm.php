<?php
namespace App\Filament\Resources\BriefingDebriefing\Schemas;
use App\Models\Instruktur;
use App\Models\Taruna;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
class BriefingDebriefingForm {
    public static function configure(Schema $schema): Schema {
        return $schema->components([
            Select::make('type')->label('Type')->options(['briefing'=>'Pre-Flight Briefing','debriefing'=>'Post-Flight Debriefing'])->required()->default('briefing'),
            Select::make('instruktur_id')->label('Instructor')->relationship('instruktur','nama')->getOptionLabelFromRecordUsing(fn(Instruktur $r)=>"{$r->nama} ({$r->nidn})")->searchable()->preload()->required(),
            Select::make('taruna_id')->label('Student / Cadet')->relationship('taruna','nama')->getOptionLabelFromRecordUsing(fn(Taruna $r)=>"{$r->nama} ({$r->nim})")->searchable()->preload()->required(),
            Select::make('jadwal_penerbangan_id')->label('Linked Flight Schedule (optional)')->relationship('jadwalPenerbangan','kode_jadwal')->searchable()->preload()->nullable(),
            DatePicker::make('date')->label('Date')->required()->default(now()),
            TimePicker::make('time_start')->label('Start Time')->required(),
            TimePicker::make('time_end')->label('End Time'),
            TextInput::make('location')->label('Location')->placeholder('e.g. Briefing Room 1, Apron, Hangar'),
            Textarea::make('topics_covered')->label('Topics Covered')->placeholder('Weather, route, emergency procedures, SOP, etc.')->rows(3)->columnSpanFull(),
            Textarea::make('instructor_notes')->label('Instructor Notes')->rows(3)->columnSpanFull(),
            Textarea::make('student_notes')->label('Student Notes / Feedback')->rows(2)->columnSpanFull(),
            Select::make('performance_rating')->label('Performance Rating')->options(['excellent'=>'Excellent','good'=>'Good','satisfactory'=>'Satisfactory','needs_improvement'=>'Needs Improvement','unsatisfactory'=>'Unsatisfactory'])->nullable(),
            Toggle::make('cleared_for_flight')->label('Cleared for Flight')->default(false)->helperText('Student passed briefing and is cleared to fly'),
            Select::make('status')->label('Status')->options(['scheduled'=>'Scheduled','completed'=>'Completed','cancelled'=>'Cancelled'])->required()->default('scheduled'),
        ]);
    }
}
