<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ActivityReportResource\Pages;
use App\Models\ActivityReport;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Notifications\Notification;
use Illuminate\Support\HtmlString;

class ActivityReportResource extends Resource
{
    protected static ?string $model = ActivityReport::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'Laporan Kegiatan';

    protected static ?string $modelLabel = 'Laporan Kegiatan';

    protected static ?string $pluralModelLabel = 'Laporan Kegiatan';

    protected static ?int $navigationSort = 2;

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make('Informasi Laporan')
                    ->schema([
                        Infolists\Components\TextEntry::make('user.name')
                            ->label('Dilaporkan oleh'),
                        Infolists\Components\TextEntry::make('title')
                            ->label('Judul'),
                        Infolists\Components\TextEntry::make('description')
                            ->label('Deskripsi')
                            ->columnSpanFull(),
                        Infolists\Components\TextEntry::make('activity_date')
                            ->label('Tanggal Kegiatan')
                            ->date('d/m/Y'),
                        Infolists\Components\TextEntry::make('status')
                            ->label('Status')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'pending' => 'warning',
                                'approved' => 'success',
                                'rejected' => 'danger',
                                default => 'gray',
                            })
                            ->formatStateUsing(fn (string $state): string => match ($state) {
                                'pending' => 'Menunggu Verifikasi',
                                'approved' => 'Disetujui',
                                'rejected' => 'Ditolak',
                                default => $state,
                            }),
                    ])->columns(2),

                Infolists\Components\Section::make('Dokumen Bukti')
                    ->schema([
                        Infolists\Components\ImageEntry::make('document_path')
                            ->label('')
                            ->disk('public')
                            ->height(400)
                            ->extraImgAttributes(['class' => 'rounded-lg', 'style' => 'max-width: 100%; height: auto;'])
                            ->placeholder('Tidak ada dokumen yang diunggah.')
                            ->visible(function ($record) {
                                if (!$record?->document_path) return false;
                                $ext = strtolower(pathinfo($record->document_path, PATHINFO_EXTENSION));
                                return in_array($ext, ['jpg', 'jpeg', 'png', 'webp', 'gif']);
                            }),
                        Infolists\Components\TextEntry::make('document_link')
                            ->label('Dokumen PDF')
                            ->state(fn ($record) => $record?->document_path ? asset('storage/' . $record->document_path) : null)
                            ->url(fn ($record) => $record?->document_path ? asset('storage/' . $record->document_path) : null)
                            ->openUrlInNewTab()
                            ->visible(function ($record) {
                                if (!$record?->document_path) return false;
                                $ext = strtolower(pathinfo($record->document_path, PATHINFO_EXTENSION));
                                return $ext === 'pdf';
                            }),
                    ]),

                Infolists\Components\Section::make('Alasan Penolakan')
                    ->schema([
                        Infolists\Components\TextEntry::make('rejection_reason')
                            ->label('')
                            ->columnSpanFull(),
                    ])
                    ->visible(fn ($record) => $record?->status === 'rejected'),
            ]);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Laporan')
                    ->schema([
                        Forms\Components\Placeholder::make('pamong_name')
                            ->label('Dilaporkan oleh')
                            ->content(fn ($record) => $record?->user?->name ?? '-'),
                        Forms\Components\TextInput::make('title')
                            ->label('Judul')
                            ->disabled(),
                        Forms\Components\Textarea::make('description')
                            ->label('Deskripsi')
                            ->disabled()
                            ->rows(4),
                        Forms\Components\DatePicker::make('activity_date')
                            ->label('Tanggal Kegiatan')
                            ->disabled(),
                    ]),

                Forms\Components\Section::make('Dokumen Bukti')
                    ->schema([
                        Forms\Components\Placeholder::make('document_preview')
                            ->label('')
                            ->content(function ($record) {
                                if (!$record || !$record->document_path) {
                                    return new \Illuminate\Support\HtmlString(
                                        '<p class="text-sm text-gray-500 italic">Tidak ada dokumen yang diunggah.</p>'
                                    );
                                }

                                $url = asset('storage/' . $record->document_path);
                                $extension = strtolower(pathinfo($record->document_path, PATHINFO_EXTENSION));

                                if (in_array($extension, ['jpg', 'jpeg', 'png', 'webp'])) {
                                    return new \Illuminate\Support\HtmlString(
                                        '<div class="space-y-2">
                                            <img src="' . $url . '" alt="Bukti Kegiatan" class="max-w-full rounded-lg border border-gray-200" style="max-height: 400px;">
                                            <a href="' . $url . '" target="_blank" class="inline-flex items-center text-sm text-indigo-600 hover:text-indigo-800 underline">
                                                Buka gambar di tab baru ↗
                                            </a>
                                        </div>'
                                    );
                                }

                                return new \Illuminate\Support\HtmlString(
                                    '<a href="' . $url . '" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-50 text-indigo-700 rounded-md hover:bg-indigo-100 text-sm font-medium">
                                        📄 Download Dokumen PDF ↗
                                    </a>'
                                );
                            }),
                    ])
                    ->collapsible(),

                Forms\Components\Section::make('Status Verifikasi')
                    ->schema([
                        Forms\Components\Placeholder::make('status_display')
                            ->label('Status')
                            ->content(fn ($record) => match ($record?->status) {
                                'pending' => '⏳ Menunggu Verifikasi',
                                'approved' => '✅ Disetujui',
                                'rejected' => '❌ Ditolak',
                                default => '-',
                            }),
                        Forms\Components\Textarea::make('rejection_reason')
                            ->label('Alasan Penolakan')
                            ->disabled()
                            ->visible(fn ($record) => $record?->status === 'rejected'),
                    ])
                    ->visible(fn ($record) => $record !== null),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Pamong')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->limit(40),
                Tables\Columns\TextColumn::make('activity_date')
                    ->label('Tanggal')
                    ->date('d/m/Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'approved' => 'success',
                        'rejected' => 'danger',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pending' => 'Pending',
                        'approved' => 'Disetujui',
                        'rejected' => 'Ditolak',
                    }),
                Tables\Columns\TextColumn::make('verifier.name')
                    ->label('Diverifikasi oleh')
                    ->placeholder('-'),
                Tables\Columns\TextColumn::make('verified_at')
                    ->label('Waktu Verifikasi')
                    ->dateTime('d/m/Y H:i')
                    ->placeholder('-'),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'approved' => 'Disetujui',
                        'rejected' => 'Ditolak',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\Action::make('approve')
                    ->label('Setujui')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn (ActivityReport $record): bool => $record->isPending())
                    ->requiresConfirmation()
                    ->action(function (ActivityReport $record) {
                        $record->approve(auth()->id());
                        Notification::make()
                            ->title('Laporan disetujui')
                            ->success()
                            ->send();
                    }),
                Tables\Actions\Action::make('reject')
                    ->label('Tolak')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->visible(fn (ActivityReport $record): bool => $record->isPending())
                    ->form([
                        Forms\Components\Textarea::make('rejection_reason')
                            ->label('Alasan Penolakan')
                            ->required()
                            ->placeholder('Jelaskan alasan penolakan laporan...'),
                    ])
                    ->action(function (ActivityReport $record, array $data) {
                        $record->reject(auth()->id(), $data['rejection_reason']);
                        Notification::make()
                            ->title('Laporan ditolak')
                            ->danger()
                            ->send();
                    }),
            ])
            ->bulkActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListActivityReports::route('/'),
            'view' => Pages\ViewActivityReport::route('/{record}'),
        ];
    }
}
