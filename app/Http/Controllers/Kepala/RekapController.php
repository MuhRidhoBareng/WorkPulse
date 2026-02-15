<?php

namespace App\Http\Controllers\Kepala;

use App\Http\Controllers\Controller;
use App\Models\ActivityReport;
use App\Models\Attendance;
use App\Models\User;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Font;

class RekapController extends Controller
{
    public function index(Request $request)
    {
        $month = (int) $request->get('month', now()->month);
        $year = (int) $request->get('year', now()->year);

        $pamongs = User::where('role', 'pamong')->where('is_active', true)->get();

        $workdaysInMonth = $this->countWorkdays($month, $year);
        $targetActivities = 4;

        $rekap = $pamongs->map(function ($pamong) use ($month, $year, $workdaysInMonth, $targetActivities) {
            $totalAttendance = Attendance::where('user_id', $pamong->id)
                ->whereMonth('date', $month)->whereYear('date', $year)
                ->where('status', 'hadir')->count();

            $totalActivities = ActivityReport::where('user_id', $pamong->id)
                ->whereMonth('activity_date', $month)->whereYear('activity_date', $year)
                ->where('status', 'approved')->count();

            $pendingActivities = ActivityReport::where('user_id', $pamong->id)
                ->whereMonth('activity_date', $month)->whereYear('activity_date', $year)
                ->where('status', 'pending')->count();

            return (object) [
                'pamong' => $pamong,
                'total_attendance' => $totalAttendance,
                'target_attendance' => $workdaysInMonth,
                'total_activities' => $totalActivities,
                'target_activities' => $targetActivities,
                'pending_activities' => $pendingActivities,
            ];
        });

        return view('kepala.rekap.index', compact('rekap', 'month', 'year'));
    }

    public function exportExcel(Request $request)
    {
        $month = (int) $request->get('month', now()->month);
        $year = (int) $request->get('year', now()->year);
        $monthName = \Carbon\Carbon::create()->month($month)->translatedFormat('F');

        $pamongs = User::where('role', 'pamong')->where('is_active', true)->get();
        $workdaysInMonth = $this->countWorkdays($month, $year);
        $targetActivities = 4;

        $spreadsheet = new Spreadsheet();

        // ============================================
        // SHEET 1: RINGKASAN KINERJA
        // ============================================
        $sheet1 = $spreadsheet->getActiveSheet();
        $sheet1->setTitle('Ringkasan Kinerja');

        // Title row
        $sheet1->mergeCells('A1:I1');
        $sheet1->setCellValue('A1', "REKAP KINERJA PAMONG — SKB DINAS PENDIDIKAN");
        $sheet1->getStyle('A1')->getFont()->setBold(true)->setSize(14)->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color('FFFFFF'));
        $sheet1->getStyle('A1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('1F4E79');
        $sheet1->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);
        $sheet1->getRowDimension(1)->setRowHeight(35);

        // Subtitle row
        $sheet1->mergeCells('A2:I2');
        $sheet1->setCellValue('A2', "Periode: {$monthName} {$year} | Diekspor: " . now()->translatedFormat('d F Y H:i'));
        $sheet1->getStyle('A2')->getFont()->setItalic(true)->setSize(10)->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color('FFFFFF'));
        $sheet1->getStyle('A2')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('2E75B6');
        $sheet1->getStyle('A2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Headers
        $headers = ['No', 'Nama Pamong', 'NIP', 'Total Kehadiran', 'Target Kehadiran', '% Kehadiran', 'Kegiatan Disetujui', 'Target Kegiatan', '% Kegiatan'];
        $row = 4;
        foreach ($headers as $col => $header) {
            $colLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($col + 1);
            $sheet1->setCellValue("{$colLetter}{$row}", $header);
        }
        $this->applyHeaderStyle($sheet1, "A{$row}:I{$row}");

        // Data
        $row = 5;
        $no = 1;
        foreach ($pamongs as $pamong) {
            $totalAtt = Attendance::where('user_id', $pamong->id)
                ->whereMonth('date', $month)->whereYear('date', $year)
                ->where('status', 'hadir')->count();
            $totalAct = ActivityReport::where('user_id', $pamong->id)
                ->whereMonth('activity_date', $month)->whereYear('activity_date', $year)
                ->where('status', 'approved')->count();

            $attPercent = $workdaysInMonth > 0 ? round(($totalAtt / $workdaysInMonth) * 100, 1) : 0;
            $actPercent = $targetActivities > 0 ? round(($totalAct / $targetActivities) * 100, 1) : 0;

            $sheet1->setCellValue("A{$row}", $no);
            $sheet1->setCellValue("B{$row}", $pamong->name);
            $sheet1->setCellValue("C{$row}", "'" . $pamong->nip); // prefix ' to keep as text
            $sheet1->setCellValue("D{$row}", $totalAtt);
            $sheet1->setCellValue("E{$row}", $workdaysInMonth);
            $sheet1->setCellValue("F{$row}", $attPercent . '%');
            $sheet1->setCellValue("G{$row}", $totalAct);
            $sheet1->setCellValue("H{$row}", $targetActivities);
            $sheet1->setCellValue("I{$row}", $actPercent . '%');

            // Color code the percentages
            if ($attPercent >= 80) {
                $sheet1->getStyle("F{$row}")->getFont()->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color('006100'));
                $sheet1->getStyle("F{$row}")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('C6EFCE');
            } elseif ($attPercent >= 50) {
                $sheet1->getStyle("F{$row}")->getFont()->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color('9C5700'));
                $sheet1->getStyle("F{$row}")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('FFEB9C');
            } else {
                $sheet1->getStyle("F{$row}")->getFont()->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color('9C0006'));
                $sheet1->getStyle("F{$row}")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('FFC7CE');
            }

            if ($actPercent >= 80) {
                $sheet1->getStyle("I{$row}")->getFont()->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color('006100'));
                $sheet1->getStyle("I{$row}")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('C6EFCE');
            } elseif ($actPercent >= 50) {
                $sheet1->getStyle("I{$row}")->getFont()->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color('9C5700'));
                $sheet1->getStyle("I{$row}")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('FFEB9C');
            } else {
                $sheet1->getStyle("I{$row}")->getFont()->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color('9C0006'));
                $sheet1->getStyle("I{$row}")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('FFC7CE');
            }

            // Zebra row coloring
            if ($no % 2 == 0) {
                $sheet1->getStyle("A{$row}:I{$row}")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('F2F7FB');
            }

            $this->applyDataBorder($sheet1, "A{$row}:I{$row}");
            $row++;
            $no++;
        }

        // Auto width
        foreach (range('A', 'I') as $col) {
            $sheet1->getColumnDimension($col)->setAutoSize(true);
        }

        // ============================================
        // SHEET 2: DETAIL KEHADIRAN
        // ============================================
        $sheet2 = $spreadsheet->createSheet();
        $sheet2->setTitle('Detail Kehadiran');

        // Title
        $sheet2->mergeCells('A1:H1');
        $sheet2->setCellValue('A1', "DETAIL KEHADIRAN — {$monthName} {$year}");
        $sheet2->getStyle('A1')->getFont()->setBold(true)->setSize(14)->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color('FFFFFF'));
        $sheet2->getStyle('A1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('1F4E79');
        $sheet2->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet2->getRowDimension(1)->setRowHeight(35);

        // Headers
        $attHeaders = ['No', 'Nama Pamong', 'NIP', 'Tanggal', 'Clock In', 'Clock Out', 'Status', 'Foto Clock In', 'Foto Clock Out'];
        $row = 3;
        foreach ($attHeaders as $col => $header) {
            $colLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($col + 1);
            $sheet2->setCellValue("{$colLetter}{$row}", $header);
        }
        $this->applyHeaderStyle($sheet2, "A{$row}:I{$row}");

        // Data
        $row = 4;
        $no = 1;
        foreach ($pamongs as $pamong) {
            $attendances = Attendance::where('user_id', $pamong->id)
                ->whereMonth('date', $month)->whereYear('date', $year)
                ->orderBy('date')->get();

            foreach ($attendances as $att) {
                $sheet2->setCellValue("A{$row}", $no);
                $sheet2->setCellValue("B{$row}", $pamong->name);
                $sheet2->setCellValue("C{$row}", "'" . $pamong->nip);
                $sheet2->setCellValue("D{$row}", $att->date->format('d/m/Y'));
                $sheet2->setCellValue("E{$row}", $att->clock_in ? $att->clock_in->format('H:i:s') : '-');
                $sheet2->setCellValue("F{$row}", $att->clock_out ? $att->clock_out->format('H:i:s') : '-');
                $sheet2->setCellValue("G{$row}", ucfirst($att->status));

                // Foto Clock In - hyperlink
                if ($att->clock_in_photo) {
                    $photoUrl = url('storage/' . $att->clock_in_photo);
                    $sheet2->setCellValue("H{$row}", 'Lihat Foto');
                    $sheet2->getCell("H{$row}")->getHyperlink()->setUrl($photoUrl);
                    $sheet2->getStyle("H{$row}")->getFont()->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color('0563C1'))->setUnderline(true);
                } else {
                    $sheet2->setCellValue("H{$row}", '-');
                }

                // Foto Clock Out - hyperlink
                if ($att->clock_out_photo) {
                    $photoUrl = url('storage/' . $att->clock_out_photo);
                    $sheet2->setCellValue("I{$row}", 'Lihat Foto');
                    $sheet2->getCell("I{$row}")->getHyperlink()->setUrl($photoUrl);
                    $sheet2->getStyle("I{$row}")->getFont()->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color('0563C1'))->setUnderline(true);
                } else {
                    $sheet2->setCellValue("I{$row}", '-');
                }

                // Status coloring
                $statusColor = match ($att->status) {
                    'hadir' => 'C6EFCE',
                    'izin' => 'BDD7EE',
                    'sakit' => 'FFEB9C',
                    'alpha' => 'FFC7CE',
                    default => 'FFFFFF',
                };
                $sheet2->getStyle("G{$row}")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB($statusColor);

                if ($no % 2 == 0) {
                    $sheet2->getStyle("A{$row}:F{$row}")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('F2F7FB');
                }

                $this->applyDataBorder($sheet2, "A{$row}:I{$row}");
                $row++;
                $no++;
            }
        }

        foreach (range('A', 'I') as $col) {
            $sheet2->getColumnDimension($col)->setAutoSize(true);
        }

        // ============================================
        // SHEET 3: DETAIL LAPORAN KEGIATAN
        // ============================================
        $sheet3 = $spreadsheet->createSheet();
        $sheet3->setTitle('Detail Laporan Kegiatan');

        // Title
        $sheet3->mergeCells('A1:J1');
        $sheet3->setCellValue('A1', "DETAIL LAPORAN KEGIATAN — {$monthName} {$year}");
        $sheet3->getStyle('A1')->getFont()->setBold(true)->setSize(14)->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color('FFFFFF'));
        $sheet3->getStyle('A1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('1F4E79');
        $sheet3->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet3->getRowDimension(1)->setRowHeight(35);

        // Headers
        $rptHeaders = ['No', 'Nama Pamong', 'NIP', 'Tanggal Kegiatan', 'Judul Kegiatan', 'Deskripsi', 'Status', 'Diverifikasi Oleh', 'Waktu Verifikasi', 'Dokumen/Foto Bukti'];
        $row = 3;
        foreach ($rptHeaders as $col => $header) {
            $colLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($col + 1);
            $sheet3->setCellValue("{$colLetter}{$row}", $header);
        }
        $this->applyHeaderStyle($sheet3, "A{$row}:J{$row}");

        // Data
        $row = 4;
        $no = 1;
        foreach ($pamongs as $pamong) {
            $reports = ActivityReport::with('verifier')
                ->where('user_id', $pamong->id)
                ->whereMonth('activity_date', $month)->whereYear('activity_date', $year)
                ->orderBy('activity_date')->get();

            foreach ($reports as $report) {
                $statusLabel = match ($report->status) {
                    'pending' => 'Menunggu',
                    'approved' => 'Disetujui',
                    'rejected' => 'Ditolak',
                    default => $report->status,
                };

                $sheet3->setCellValue("A{$row}", $no);
                $sheet3->setCellValue("B{$row}", $pamong->name);
                $sheet3->setCellValue("C{$row}", "'" . $pamong->nip);
                $sheet3->setCellValue("D{$row}", $report->activity_date->format('d/m/Y'));
                $sheet3->setCellValue("E{$row}", $report->title);
                $sheet3->setCellValue("F{$row}", $report->description);
                $sheet3->setCellValue("G{$row}", $statusLabel);
                $sheet3->setCellValue("H{$row}", $report->verifier?->name ?? '-');
                $sheet3->setCellValue("I{$row}", $report->verified_at ? $report->verified_at->format('d/m/Y H:i') : '-');

                // Dokumen - hyperlink
                if ($report->document_path) {
                    $docUrl = url('storage/' . $report->document_path);
                    $sheet3->setCellValue("J{$row}", 'Lihat Dokumen');
                    $sheet3->getCell("J{$row}")->getHyperlink()->setUrl($docUrl);
                    $sheet3->getStyle("J{$row}")->getFont()->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color('0563C1'))->setUnderline(true);
                } else {
                    $sheet3->setCellValue("J{$row}", '-');
                }

                // Status coloring
                $statusColor = match ($report->status) {
                    'approved' => 'C6EFCE',
                    'pending' => 'FFEB9C',
                    'rejected' => 'FFC7CE',
                    default => 'FFFFFF',
                };
                $sheet3->getStyle("G{$row}")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB($statusColor);

                // Wrap description text
                $sheet3->getStyle("F{$row}")->getAlignment()->setWrapText(true);
                $sheet3->getColumnDimension('F')->setWidth(40);

                if ($no % 2 == 0) {
                    $sheet3->getStyle("A{$row}:E{$row}")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('F2F7FB');
                    $sheet3->getStyle("H{$row}:I{$row}")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('F2F7FB');
                }

                $this->applyDataBorder($sheet3, "A{$row}:J{$row}");
                $row++;
                $no++;
            }
        }

        foreach (range('A', 'J') as $col) {
            if ($col !== 'F') { // F already set to 40
                $sheet3->getColumnDimension($col)->setAutoSize(true);
            }
        }

        // ============================================
        // GENERATE FILE
        // ============================================
        $spreadsheet->setActiveSheetIndex(0);
        $filename = "Rekap_Kinerja_{$monthName}_{$year}.xlsx";

        $tempFile = tempnam(sys_get_temp_dir(), 'rekap_') . '.xlsx';
        $writer = new Xlsx($spreadsheet);
        $writer->save($tempFile);

        return response()->download($tempFile, $filename, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ])->deleteFileAfterSend(true);
    }

    // ============================================
    // HELPER METHODS
    // ============================================

    private function applyHeaderStyle($sheet, string $range): void
    {
        $sheet->getStyle($range)->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 11,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '2E75B6'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '1F4E79'],
                ],
            ],
        ]);
        // Set header row height
        $rowNumber = (int) preg_replace('/[^0-9]/', '', explode(':', $range)[0]);
        $sheet->getRowDimension($rowNumber)->setRowHeight(25);
    }

    private function applyDataBorder($sheet, string $range): void
    {
        $sheet->getStyle($range)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => 'D6DCE4'],
                ],
            ],
            'alignment' => [
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);
    }

    private function countWorkdays(int $month, int $year): int
    {
        $start = \Carbon\Carbon::create($year, $month, 1);
        $end = $start->copy()->endOfMonth();
        $workdays = 0;

        while ($start->lte($end)) {
            if ($start->isWeekday()) {
                $workdays++;
            }
            $start->addDay();
        }

        return $workdays;
    }
}
