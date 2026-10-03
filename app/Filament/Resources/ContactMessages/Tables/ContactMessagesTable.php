<?php

namespace App\Filament\Resources\ContactMessages\Tables;

use App\Filament\Resources\ContactMessages\ContactMessageResource;
use Filament\Actions\Action;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class ContactMessagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('subject')
                    ->badge()
                    ->color(fn ($state) => match ($state) {
                        'general' => 'gray',
                        'products' => 'info',
                        'orders' => 'warning',
                        'other' => 'success',
                        default => 'gray',
                    })
                    ->searchable()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime('M d, Y H:i')
                    ->sortable(),
                TextColumn::make('read_at')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state ? 'Read' : 'Unread')
                    ->color(fn ($state) => $state ? 'success' : 'warning'),
            ])
            ->recordActions([
                ViewAction::make(),
                Action::make('markAsRead')
                    ->label('Mark as read')
                    ->icon('heroicon-o-check')
                    ->visible(fn (Model $record) => $record->read_at === null)
                    ->action(function (Model $record) {
                        $record->update(['read_at' => now()]);
                    }),
            ]);
    }
}
