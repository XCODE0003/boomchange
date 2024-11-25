<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CurrencyResource\Pages;
use App\Filament\Resources\CurrencyResource\RelationManagers;
use App\Models\Currency;
use Filament\Forms;
use Filament\Forms\Components\Group;
use Filament\Forms\Form;
use Filament\Tables\Columns\ImageColumn;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CurrencyResource extends Resource
{
    protected static ?string $model = Currency::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make([
                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->label('Название монеты'),
                    Forms\Components\TextInput::make('symbol')
                        ->required()
                        ->label('Символ'),
        
                ])->columns(2),
                Group::make([
                    Group::make([
                        Forms\Components\TextInput::make('min_amount')
                            ->label('Минимальная сумма'),
                        Forms\Components\Select::make('type')
                            ->options([
                                'fiat' => 'Фиат',
                                'crypto' => 'Криптовалюта',
                            ])
                            ->label('Тип')
                            ->live(),

                    ])->columns(2),
                
                ])->columns(1),
                Group::make([
                    Forms\Components\Toggle::make('static_course')
                        ->default(false)
                        ->live()
                        ->label('Статичная цена'),
                    Forms\Components\Toggle::make('is_active')
                        ->default(true)
                        ->label('Активна'),
                ])->columns(1),
                Forms\Components\FileUpload::make('image')
                ->label('Изображение')
                ->disk('public')
                ->directory('uploads/coins'),
                Forms\Components\TextInput::make('coinmarketcap_id')
                    ->label('CoinMarketCap ID монеты')
                    ->visible(fn(Forms\Get $get): bool => $get('type') === 'crypto'),
                Forms\Components\TextInput::make('address')
                    ->label('Адрес для пополнения')
                    ->placeholder('Введите адрес для пополнения'),
                Forms\Components\TextInput::make('course')
                    ->label('Цена')
                    ->hint('Введите цену в долларах')
                    ->numeric()
                    ->visible(fn(Forms\Get $get): bool => $get('static_course')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')->label('Изображение'),
                Tables\Columns\TextColumn::make('name')->label('Название монеты'),
                Tables\Columns\TextColumn::make('symbol')->label('Символ'),
                Tables\Columns\ToggleColumn::make('is_active')->label('Активна'),
                Tables\Columns\ToggleColumn::make('static_course')->label('Статичная цена'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCurrencies::route('/'),
            'create' => Pages\CreateCurrency::route('/create'),
            'edit' => Pages\EditCurrency::route('/{record}/edit'),
        ];
    }
}
