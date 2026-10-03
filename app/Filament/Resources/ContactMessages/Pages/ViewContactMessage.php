<?php

namespace App\Filament\Resources\ContactMessages\Pages;

use App\Filament\Resources\ContactMessages\ContactMessageResource;
use Filament\Actions\Action;
use Filament\Resources\Pages\ViewRecord;

class ViewContactMessage extends ViewRecord
{
    protected static string $resource = ContactMessageResource::class;

    public function mount(int|string $record): void
    {
        parent::mount($record);

        if (! $this->record->read_at) {
            $this->record->update(['read_at' => now()]);
        }
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('markAsRead')
                ->label('Mark as read')
                ->icon('heroicon-o-check')
                ->visible(fn () => $this->getRecord()?->read_at === null)
                ->action(function () {
                    $record = $this->getRecord();

                    if ($record && ! $record->read_at) {
                        $record->update(['read_at' => now()]);
                    }
                }),
        ];
    }
}
