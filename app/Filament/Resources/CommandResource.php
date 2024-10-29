<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CommandResource\Pages;
use App\Models\Bab;
use App\Models\Command;
use App\Models\MataPelajaran;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CommandResource extends Resource
{
    protected static ?string $model = Command::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-bottom-center-text';

    protected static ?string $navigationLabel = 'Command';

    protected static ?string $slug = 'command';

    protected static ?int $navigationSort = 6;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('kata')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('rute')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Select::make('entity_type')
                    ->label('Entity Type')
                    ->required()
                    ->options([
                        'Global' => 'Global',
                        'Mata Pelajaran' => 'Mata Pelajaran',
                        'Bab' => 'Bab',
                    ])
                    ->reactive()
                    ->afterStateUpdated(fn(callable $set) => $set('entity_id', null)),

                Forms\Components\Select::make('entity_id')
                    ->label('Entity')
                    ->required()
                    ->reactive()
                    ->options(function (callable $get) {
                        $entityType = $get('entity_type');
                        if ($entityType === 'Mata Pelajaran') {
                            return MataPelajaran::query()->pluck('nama', 'uuid');
                        } elseif ($entityType === 'Bab') {
                            return Bab::query()->pluck('nama', 'uuid');
                        } else {
                            return [
                                '0' => 'Global',
                            ];
                        }
                    })
                    ->afterStateUpdated(function (callable $get, callable $set, $state) {
                        $entityType = $get('entity_type');

                        if ($entityType === 'Mata Pelajaran') {
                            $set('rute', "/home/" . $state);
                            $set('kata', strtolower($state));
                        } elseif ($entityType === 'Bab') {
                            $bab = Bab::whereUuid($state)->firstOrFail();
                            $set('rute', "/home/" . $state . "/bab");
                            $set('kata', strtolower($bab->nama));
                        } else {
                            $set('rute', "/");
                        }
                    })
                    ->default(0),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kata')
                    ->searchable(),
                Tables\Columns\TextColumn::make('rute')
                    ->searchable(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                ]),
            ])
            ->paginated([25, 50, 100, 'all']);
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
            'index' => Pages\ListCommands::route('/'),
            // 'create' => Pages\CreateCommand::route('/create'),
            // 'edit' => Pages\EditCommand::route('/{record}/edit'),
        ];
    }
}