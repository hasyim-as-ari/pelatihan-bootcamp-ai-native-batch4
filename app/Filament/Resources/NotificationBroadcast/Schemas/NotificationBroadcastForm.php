<?php
namespace App\Filament\Resources\NotificationBroadcast\Schemas;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
class NotificationBroadcastForm {
    public static function configure(Schema $schema): Schema {
        return $schema->components([
            Section::make('Notification Content')->schema([
                TextInput::make('title')->label('Title')->required()->placeholder('e.g. Flight Schedule Changed - Tomorrow 07:00')->columnSpanFull(),
                Textarea::make('message')->label('Message Content')->required()->rows(5)->placeholder('Write the full notification message here...')->columnSpanFull(),
            ]),
            Section::make('Delivery Settings')->columns(2)->schema([
                Select::make('channel')->label('Channel')->options(['system'=>'System (In-App)','email'=>'Email','whatsapp'=>'WhatsApp','both'=>'Email + WhatsApp'])->required()->default('system'),
                Select::make('priority')->label('Priority')->options(['low'=>'Low','normal'=>'Normal','high'=>'High','urgent'=>'Urgent'])->required()->default('normal'),
                Select::make('target_role')->label('Target Audience')->options(['all'=>'All Users','student'=>'Students Only','instructor'=>'Instructors Only','admin'=>'Admins Only','specific'=>'Specific Users'])->required()->default('all'),
                Select::make('trigger_type')->label('Trigger Type')->options(['manual'=>'Manual','schedule_change'=>'Schedule Changed','schedule_approved'=>'Schedule Approved','schedule_cancelled'=>'Schedule Cancelled','reminder'=>'Reminder','alert'=>'Alert'])->required()->default('manual'),
                Select::make('jadwal_penerbangan_id')->label('Linked Flight Schedule')->relationship('jadwalPenerbangan','kode_jadwal')->searchable()->preload()->nullable(),
                DateTimePicker::make('scheduled_at')->label('Scheduled Send Time')->nullable()->helperText('Leave blank to send immediately'),
            ]),
            Section::make('Status')->schema([
                Select::make('status')->label('Status')->options(['draft'=>'Draft','queued'=>'Queued','sending'=>'Sending','sent'=>'Sent','failed'=>'Failed','cancelled'=>'Cancelled'])->required()->default('draft'),
            ]),
        ]);
    }
}
