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
                    ->maxSize(10240)
                    ->acceptedFileTypes(['image/jpeg','image/png','image/webp'])
                    ->openable()
                    ->deletable(true)
                    ->helperText('Square photo, 1200x1200px, plain background, JPG/PNG/WebP, up to 10 MB.')
                    ->directory('products'),
                FileUpload::make('images')
                    ->disk('public')
                    ->visibility('public')
                    ->image()
                    ->multiple()
                    ->reorderable()
                    ->acceptedFileTypes(['image/jpeg','image/png','image/webp'])
                    ->maxSize(10240)
                    ->maxFiles(5)
                    ->directory('products')
                    ->helperText('Extra gallery photos. The main image above is always shown first.'),
                TextInput::make('finish')
                    ->nullable()
                    ->helperText('e.g. Matte, Polished, Hammered'),
                TextInput::make('size')
                    ->nullable(),
                TextInput::make('weight')
                    ->nullable(),
                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->minValue(1)
                    ->prefix('Rs')
                    ->helperText('Shown on the website. Price is required for every product.'),
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
