<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AttendanceResource\Pages;
use App\Models\Attendance;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\HtmlString;

class AttendanceResource extends Resource
{
    protected static ?string $model = Attendance::class;

    protected static ?string $navigationIcon = 'heroicon-o-clock';

    protected static ?string $navigationLabel = 'Data Kehadiran';

    protected static ?string $modelLabel = 'Kehadiran';

    protected static ?string $pluralModelLabel = 'Kehadiran';

    protected static ?int $navigationSort = 3;

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make('Informasi Kehadiran')
                    ->schema([
                        Infolists\Components\TextEntry::make('user.name')
                            ->label('Nama Pamong'),
                        Infolists\Components\TextEntry::make('date')
                            ->label('Tanggal')
                            ->date('d/m/Y'),
                        Infolists\Components\TextEntry::make('clock_in')
                            ->label('Clock In')
                            ->dateTime('H:i:s'),
                        Infolists\Components\TextEntry::make('clock_out')
                            ->label('Clock Out')
                            ->dateTime('H:i:s')
                            ->placeholder('Belum clock out'),
                        Infolists\Components\TextEntry::make('status')
                            ->label('Status')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'hadir' => 'success',
                                'izin' => 'info',
                                'sakit' => 'warning',
                                'alpha' => 'danger',
                                default => 'gray',
                            })
                            ->formatStateUsing(fn (string $state): string => ucfirst($state)),
                    ])->columns(2),

                Infolists\Components\Section::make('Foto Clock In')
                    ->schema([
                        Infolists\Components\ImageEntry::make('clock_in_photo')
                            ->label('')
                            ->disk('public')
                            ->height(300)
                            ->extraImgAttributes(['class' => 'rounded-lg'])
                            ->placeholder('Tidak ada foto clock in.'),
                    ]),

                Infolists\Components\Section::make('Foto Clock Out')
                    ->schema([
                        Infolists\Components\ImageEntry::make('clock_out_photo')
                            ->label('')
                            ->disk('public')
                            ->height(300)
                            ->extraImgAttributes(['class' => 'rounded-lg'])
                            ->placeholder('Tidak ada foto clock out.'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('date')
                    ->label('Tanggal')
                    ->date('d/m/Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('clock_in')
                    ->label('Clock In')
                    ->dateTime('H:i:s'),
                Tables\Columns\TextColumn::make('clock_out')
                    ->label('Clock Out')
                    ->dateTime('H:i:s')
                    ->placeholder('-'),
                Tables\Columns\ImageColumn::make('clock_in_photo')
                    ->label('Foto In')
                    ->disk('public')
                    ->circular()
                    ->defaultImageUrl(fn () => null)
                    ->placeholder('-'),
                Tables\Columns\ImageColumn::make('clock_out_photo')
                    ->label('Foto Out')
                    ->disk('public')
                    ->circular()
                    ->defaultImageUrl(fn () => null)
                    ->placeholder('-'),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'hadir' => 'success',
                        'izin' => 'info',
                        'sakit' => 'warning',
                        'alpha' => 'danger',
                    })
                    ->formatStateUsing(fn (string $state): string => ucfirst($state)),
            ])
            ->defaultSort('date', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'hadir' => 'Hadir',
                        'izin' => 'Izin',
                        'sakit' => 'Sakit',
                        'alpha' => 'Alpha',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([]);
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAttendances::route('/'),
            'view' => Pages\ViewAttendance::route('/{record}'),
        ];
    }
}
