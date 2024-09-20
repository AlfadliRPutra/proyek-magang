<?php

namespace App\Http\Controllers;

use App\Models\Intern;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ExportController extends Controller
{
    public function getInternPresensi(Request $request, $internId)
    {
        // Ambil data intern
        $intern = Intern::findOrFail($internId);
        $createdDate = $intern->created_at->addDay(); // One day after created_at
        $today = now(); // Current date

        // Ambil semua data presensi dari satu hari setelah created_at sampai hari ini
        $presensi = $intern->presensi()
            ->whereDate('date_attendance', '>=', $createdDate)
            ->whereDate('date_attendance', '<=', $today)
            ->get();

        // Generate keterangan
        $data = [];
        $datesRange = collect();
        for ($date = $createdDate; $date <= $today; $date->addDay()) {
            if ($date->isWeekday()) { // Check if the date is a weekday (Monday to Friday)
                $datesRange->push($date->format('Y-m-d'));
            }
        }

        $totalHadir = 0;
        $totalTidakHadir = 0;

        foreach ($datesRange as $date) {
            $presensiItem = $presensi->firstWhere('date_attendance', $date);

            if ($presensiItem) {
                $keterangan = 'Hadir';
                $totalHadir++;
            } else {
                $keterangan = 'Tidak Hadir';
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
}