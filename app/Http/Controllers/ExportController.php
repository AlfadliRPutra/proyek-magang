<?php

namespace App\Http\Controllers;

use App\Models\Intern;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExportController extends Controller
{
    public function index()
    {
        // Retrieve all intern data for the dropdown
        $interns = Intern::all();
        return view('admin.export', compact('interns'));
    }

    public function getInternPresensi(Request $request)
    {
        $internId = $request->input('intern_id');
        $exportFormat = $request->input('export_format');

        if ($exportFormat === 'pdf') {
            return $this->exportToPdf($internId);
        } elseif ($exportFormat === 'excel') {
            return $this->exportToExcel($internId);
        }

        return redirect()->back()->with('error', 'Invalid export format selected.');
    }

    protected function exportToPdf($internId)
    {
        // Ambil data intern
        $intern = Intern::findOrFail($internId);
        $createdDate = $intern->created_at->addDay(); // One day after created_at
        $today = now(); // Current date

        // Ambil semua data presensi
        $presensi = $intern->presensi()
            ->whereDate('date_attendance', '>=', $createdDate)
            ->whereDate('date_attendance', '<=', $today)
            ->get();

        // Generate keterangan
        $data = [];
        $datesRange = collect();
        for ($date = $createdDate; $date <= $today; $date->addDay()) {
            if ($date->isWeekday()) {
                $datesRange->push($date->format('Y-m-d'));
            }
        }

        $totalHadir = 0;
        $totalTidakHadir = 0;

        foreach ($datesRange as $date) {
            $presensiItem = $presensi->firstWhere('date_attendance', $date);
            $keterangan = $presensiItem ? 'Hadir' : 'Tidak Hadir';

            if ($presensiItem) {
                $totalHadir++;
            } else {
                $totalTidakHadir++;
            }

            $data[] = [
                'date_attendance' => $date,
                'in_hour' => $presensiItem ? $presensiItem->in_hour : '-',
                'out_hour' => $presensiItem ? $presensiItem->out_hour : '-',
                'keterangan' => $keterangan,
            ];
        }

        // Generate PDF
        $pdf = PDF::loadView('exportpresensi', compact('intern', 'data', 'totalHadir', 'totalTidakHadir'));

        return $pdf->stream('presensi_intern_' . $intern->user->name . '.pdf');
    }

    protected function exportToExcel($internId)
    {
        $intern = Intern::findOrFail($internId);
        $createdDate = $intern->created_at->addDay();
        $today = now();

        // Retrieve presensi data
        $presensi = $intern->presensi()
            ->whereDate('date_attendance', '>=', $createdDate)
            ->whereDate('date_attendance', '<=', $today)
            ->get();

        // Create a new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set the headers
        $sheet->setCellValue('A1', 'Date Attendance');
        $sheet->setCellValue('B1', 'In Hour');
        $sheet->setCellValue('C1', 'Out Hour');
        $sheet->setCellValue('D1', 'Keterangan'); // Add a column for Keterangan

        // Prepare data for export
        $row = 2; // Starting row for data
        $datesRange = collect();
        for ($date = $createdDate; $date <= $today; $date->addDay()) {
            if ($date->isWeekday()) {
                $datesRange->push($date->format('Y-m-d'));
            }
        }

        foreach ($datesRange as $date) {
            $presensiItem = $presensi->firstWhere('date_attendance', $date);
            $keterangan = $presensiItem ? 'Hadir' : 'Tidak Hadir';

            $sheet->setCellValue('A' . $row, $date);
            $sheet->setCellValue('B' . $row, $presensiItem ? $presensiItem->in_hour : '-');
            $sheet->setCellValue('C' . $row, $presensiItem ? $presensiItem->out_hour : '-');
            $sheet->setCellValue('D' . $row, $keterangan); // Add Keterangan to the sheet
            $row++;
        }

        // Create a writer and save the Excel file
        $writer = new Xlsx($spreadsheet);
        $fileName = 'presensi_intern_' . $intern->user->name . '.xlsx';

        // Set the content type and download the file
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $fileName . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }
}
