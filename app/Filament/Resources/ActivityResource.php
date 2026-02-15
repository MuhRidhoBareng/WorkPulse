<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ActivityResource\Pages;
use App\Models\Activity;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ActivityResource extends Resource
{
    protected static ?string $model = Activity::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    protected static ?string $navigationLabel = 'Daftar Kegiatan';

    protected static ?string $modelLabel = 'Kegiatan';

    protected static ?string $pluralModelLabel = 'Daftar Kegiatan';

    protected static ?string $navigationGroup = 'Manajemen';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Detail Kegiatan')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Judul Kegiatan')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Contoh: Pelatihan Literasi Digital'),

                        Forms\Components\Textarea::make('description')
                            ->label('Deskripsi')
                            ->rows(4)
                            ->placeholder('Deskripsi kegiatan...')
                            ->columnSpanFull(),

                        Forms\Components\DatePicker::make('date')
                            ->label('Tanggal Kegiatan')
                            ->required()
                            ->native(false)
                            ->displayFormat('d M Y'),

                        Forms\Components\TimePicker::make('start_time')
                            ->label('Jam Mulai')
                            ->required()
                            ->seconds(false)
                            ->native(false),

                        Forms\Components\TimePicker::make('end_time')
                            ->label('Jam Selesai')
                            ->required()
                            ->seconds(false)
                            ->native(false)
                            ->after('start_time'),

                        Forms\Components\Toggle::make('is_active')
                            ->label('Aktif')
                            ->default(true)
                            ->helperText('Kegiatan aktif akan muncul di dashboard Pamong'),

                        Forms\Components\Hidden::make('created_by')
                            ->default(fn () => auth()->id())
                            ->dehydrated()
                            ->dehydrateStateUsing(fn ($state) => $state ?? auth()->id()),
                    ])->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->weight('bold')
                    ->limit(50),

                Tables\Columns\TextColumn::make('date')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->sortable()
                    ->badge()
                    ->color('primary'),

                Tables\Columns\TextColumn::make('start_time')
                    ->label('Mulai')
                    ->time('H:i')
                    ->placeholder('-'),

                Tables\Columns\TextColumn::make('end_time')
                    ->label('Selesai')
                    ->time('H:i')
                    ->placeholder('-'),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),

                Tables\Columns\TextColumn::make('creator.name')
                    ->label('Dibuat Oleh')
                    ->toggleable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('date', 'desc')
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status')
                    ->trueLabel('Aktif')
                    ->falseLabel('Nonaktif')
                    ->placeholder('Semua'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->iconButton(),
                Tables\Actions\DeleteAction::make()
                    ->iconButton(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListActivities::route('/'),
            'create' => Pages\CreateActivity::route('/create'),
            'edit' => Pages\EditActivity::route('/{record}/edit'),
        ];
    }
}
