<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),
                TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true),
                Textarea::make('description')
                    ->nullable()
                    ->columnSpanFull()
                    ->helperText('Shown on the Categories page, keep it under 160 characters')
                    ->maxLength(200),
                FileUpload::make('image')
                    ->disk('public')
                    ->visibility('public')
                    ->image()
                    ->imageEditor()
                    ->imageEditorAspectRatios(['4:3'])
                    ->imageCropAspectRatio('4:3')
                    ->imageResizeMode('cover')
                    ->imageResizeTargetWidth('1600')
                    ->imageResizeTargetHeight('1200')
                    ->maxSize(10240)
                    ->acceptedFileTypes(['image/jpeg','image/png','image/webp'])
                    ->openable()
                    ->deletable(true)
                    ->helperText('Landscape photo 4:3, JPG/PNG/WebP, up to 10 MB. JPG or WebP is recommended for faster loading.')
                    ->directory('categories'),
                \Filament\Forms\Components\TextInput::make('sort_order')
                    ->numeric()
                    ->default(0)
                    ->required(),
                \Filament\Forms\Components\Toggle::make('is_active')
                    ->label('Active')
                    ->default(true),
            ]);
    }
}
