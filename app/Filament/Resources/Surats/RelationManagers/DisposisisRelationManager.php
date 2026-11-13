<?php

namespace App\Filament\Resources\Surats\RelationManagers;

use App\Enums\Instruksi;
use App\Enums\StatusDisposisi;
use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DisposisisRelationManager extends RelationManager
{
    protected static string $relationship = 'disposisis';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('dari_user_id')
                    ->relationship('dariUser', 'name')
                    ->required(),
                Select::make('ke_user_id')
                    ->relationship('keUser', 'name')
                    ->required(),
                Select::make('instruksi')
                    ->options(Instruksi::class)
                    ->required(),
                Textarea::make('catatan')
                    ->columnSpanFull(),
                DatePicker::make('batas_waktu'),
                Select::make('status')
                    ->options(StatusDisposisi::class)
                    ->default('belum_dibaca')
                    ->required(),
                Textarea::make('catatan_tindak_lanjut')
                    ->columnSpanFull(),
                TextInput::make('bukti_path'),
                DateTimePicker::make('dibaca_at'),
                DateTimePicker::make('selesai_at'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('ke_user_id')
            ->columns([
                TextColumn::make('dariUser.name')
                    ->searchable(),
                TextColumn::make('keUser.name')
                    ->searchable(),
                TextColumn::make('instruksi')
                    ->badge()
                    ->searchable(),
                TextColumn::make('batas_waktu')
                    ->date()
                    ->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->searchable(),
                TextColumn::make('bukti_path')
                    ->searchable(),
                TextColumn::make('dibaca_at')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('selesai_at')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make(),
                AssociateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DissociateAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DissociateBulkAction::make(),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
