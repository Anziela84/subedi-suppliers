<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),
                Select::make('category_id')
                    ->relationship('category', 'name')
                    ->required(),
                TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true),
                Textarea::make('description')
                    ->nullable()
                    ->columnSpanFull(),
                FileUpload::make('image')
                    ->disk('public')
                    ->visibility('public')
                    ->image()
                    ->imageEditor()
                    ->imageEditorAspectRatios(['1:1'])
                    ->imageCropAspectRatio('1:1')
                    ->imageResizeMode('cover')
                    ->imageResizeTargetWidth('1200')
                    ->imageResizeTargetHeight('1200')
                    ->maxSize(2048)
                    ->helperText('Square photo, 1200x1200px, plain background, JPG/PNG/WebP')
                    ->directory('products'),
                TextInput::make('dimensions')
                    ->nullable(),
                TextInput::make('size')
                    ->nullable(),
                TextInput::make('weight')
                    ->nullable(),
                TextInput::make('price')
                    ->numeric()
                    ->nullable()
                    ->prefix('Rs')
                    ->helperText('Leave empty to show "Enquire for price" on the website')
                    ->minValue(0),
                TextInput::make('sort_order')
                    ->numeric()
                    ->default(0)
                    ->required(),
                \Filament\Forms\Components\Toggle::make('is_featured')
                    ->label('Show on homepage')
                    ->default(false),
                \Filament\Forms\Components\Toggle::make('is_active')
                    ->label('Visible on website')
                    ->default(true),
            ]);
    }
}
