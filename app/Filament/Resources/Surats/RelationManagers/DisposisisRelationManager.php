<?php

namespace App\Filament\Resources\Surats\RelationManagers;

use App\Enums\Instruksi;
use App\Enums\StatusDisposisi;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class DisposisisRelationManager extends RelationManager
{
    protected static string $relationship = 'disposisis';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('ke_user_id')
                    ->label('Ditujukan ke')
                    ->relationship('keUser', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),

                Select::make('instruksi')
                    ->options(Instruksi::class)
                    ->required(),

                Textarea::make('catatan')
                    ->columnSpanFull(),

                DatePicker::make('batas_waktu')
                    ->label('Batas Waktu'),

                Select::make('status')
                    ->options(StatusDisposisi::class)
                    ->default(StatusDisposisi::BelumDibaca)
                    ->required(),

                Textarea::make('catatan_tindak_lanjut')
                    ->label('Catatan Tindak Lanjut')
                    ->columnSpanFull(),

                FileUpload::make('bukti_path')
                    ->label('Bukti Tindak Lanjut')
                    ->disk('local')
                    ->directory('bukti-disposisi')
                    ->downloadable()
                    ->openable(),
            ]);
    }

    public function keUser(): BelongsTo
    {
        return $this->belongsTo(user::class, 'ke_user_id');
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('instruksi')
            ->columns([
                TextColumn::make('keUser.name')
                    ->label('Ditujukan ke')
                    ->searchable(),

                TextColumn::make('instruksi')
                    ->badge(),

                TextColumn::make('batas_waktu')
                    ->label('Batas Waktu')
                    ->date('d M Y')
                    ->sortable(),

                TextColumn::make('status')
                    ->badge(),

                TextColumn::make('dariUser.name')
                    ->label('Dari')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('selesai_at')
                    ->label('Selesai')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options(StatusDisposisi::class),
            ])
            ->headerActions([
                CreateAction::make()
                    ->mutateFormDataUsing(function (array $data): array {
                        $data['dari_user_id'] = auth()->id();

                        return $data;
                    }),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}