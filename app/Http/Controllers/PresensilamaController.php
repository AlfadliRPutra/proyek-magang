<?php

namespace App\Http\Controllers;

use App\Exports\ExportPresensi;
use App\Models\Presensi;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class PresensilamaController extends Controller
{





    public function history()
    {
        $namaBulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        return view('intern.riwayat', compact('namaBulan'));
    }

    public function gethistory(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $id_pengguna = Auth::User()->id_pengguna;

        $history = DB::table('presensi')
            ->whereRaw('MONTH(date_attendance)="' . $bulan . '"')
            ->whereRaw('YEAR(date_attendance)="' . $tahun . '"')
            ->where('id_pengguna', $id_pengguna)
            ->orderBy('date_attendance')
            ->get();
        return view('presensi.gethistory', compact('history'));
    }





    public function showmap($id)
    {
        $presensi = Presensi::with('pengguna') // Assuming you have a relationship defined in the model
            ->where('id', $id)
            ->firstOrFail(); // Will throw a 404 error if not found

        return view('presensi.showmap', compact('presensi'));
    }

    public function laporan()
    {
        $namaBulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        $intern = DB::table('users')->orderBy('name')->get();
        return view('admin.report', compact('namaBulan', 'intern'));
    }

    public function cetaklaporan(Request $request)
    {
        $id_pengguna = $request->id_pengguna;
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $intern = DB::table('users')->where('id_pengguna', $id_pengguna)->first();
        $namaBulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        $presensi = DB::table('presensi')
            ->where('id_pengguna', $id_pengguna)
            ->whereRaw('MONTH(date_attendance)="' . $bulan . '"')
            ->whereRaw('YEAR(date_attendance)="' . $tahun . '"')
            ->orderBy('date_attendance')
            ->get();

        return view('presensi.cetaklaporan', compact('namaBulan', 'bulan', 'tahun', 'intern', 'presensi'));
    }

    public function rekap()
    {
        $namaBulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        return view('admin.rekap', compact('namaBulan'));
    }

    public function cetakrekap(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $namaBulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        $rekap = DB::table('presensi')
            ->selectRaw('presensi.id_pengguna,name,
            MAX(IF(DAY(date_attendance) = 1, CONCAT(in_hour,"_",IFNULL(out_hour,"00:00:00")),"")) as tgl_1,
            MAX(IF(DAY(date_attendance) = 2, CONCAT(in_hour,"_",IFNULL(out_hour,"00:00:00")),"")) as tgl_2,
            MAX(IF(DAY(date_attendance) = 3, CONCAT(in_hour,"_",IFNULL(out_hour,"00:00:00")),"")) as tgl_3,
            MAX(IF(DAY(date_attendance) = 4, CONCAT(in_hour,"_",IFNULL(out_hour,"00:00:00")),"")) as tgl_4,
            MAX(IF(DAY(date_attendance) = 5, CONCAT(in_hour,"_",IFNULL(out_hour,"00:00:00")),"")) as tgl_5,
            MAX(IF(DAY(date_attendance) = 6, CONCAT(in_hour,"_",IFNULL(out_hour,"00:00:00")),"")) as tgl_6,
            MAX(IF(DAY(date_attendance) = 7, CONCAT(in_hour,"_",IFNULL(out_hour,"00:00:00")),"")) as tgl_7,
            MAX(IF(DAY(date_attendance) = 8, CONCAT(in_hour,"_",IFNULL(out_hour,"00:00:00")),"")) as tgl_8,
            MAX(IF(DAY(date_attendance) = 9, CONCAT(in_hour,"_",IFNULL(out_hour,"00:00:00")),"")) as tgl_9,
            MAX(IF(DAY(date_attendance) = 10, CONCAT(in_hour,"_",IFNULL(out_hour,"00:00:00")),"")) as tgl_10,
            MAX(IF(DAY(date_attendance) = 11, CONCAT(in_hour,"_",IFNULL(out_hour,"00:00:00")),"")) as tgl_11,
            MAX(IF(DAY(date_attendance) = 12, CONCAT(in_hour,"_",IFNULL(out_hour,"00:00:00")),"")) as tgl_12,
            MAX(IF(DAY(date_attendance) = 13, CONCAT(in_hour,"_",IFNULL(out_hour,"00:00:00")),"")) as tgl_13,
            MAX(IF(DAY(date_attendance) = 14, CONCAT(in_hour,"_",IFNULL(out_hour,"00:00:00")),"")) as tgl_14,
            MAX(IF(DAY(date_attendance) = 15, CONCAT(in_hour,"_",IFNULL(out_hour,"00:00:00")),"")) as tgl_15,
            MAX(IF(DAY(date_attendance) = 16, CONCAT(in_hour,"_",IFNULL(out_hour,"00:00:00")),"")) as tgl_16,
            MAX(IF(DAY(date_attendance) = 17, CONCAT(in_hour,"_",IFNULL(out_hour,"00:00:00")),"")) as tgl_17,
            MAX(IF(DAY(date_attendance) = 18, CONCAT(in_hour,"_",IFNULL(out_hour,"00:00:00")),"")) as tgl_18,
            MAX(IF(DAY(date_attendance) = 19, CONCAT(in_hour,"_",IFNULL(out_hour,"00:00:00")),"")) as tgl_19,
            MAX(IF(DAY(date_attendance) = 20, CONCAT(in_hour,"_",IFNULL(out_hour,"00:00:00")),"")) as tgl_20,
            MAX(IF(DAY(date_attendance) = 21, CONCAT(in_hour,"_",IFNULL(out_hour,"00:00:00")),"")) as tgl_21,
            MAX(IF(DAY(date_attendance) = 22, CONCAT(in_hour,"_",IFNULL(out_hour,"00:00:00")),"")) as tgl_22,
            MAX(IF(DAY(date_attendance) = 23, CONCAT(in_hour,"_",IFNULL(out_hour,"00:00:00")),"")) as tgl_23,
            MAX(IF(DAY(date_attendance) = 24, CONCAT(in_hour,"_",IFNULL(out_hour,"00:00:00")),"")) as tgl_24,
            MAX(IF(DAY(date_attendance) = 25, CONCAT(in_hour,"_",IFNULL(out_hour,"00:00:00")),"")) as tgl_25,
            MAX(IF(DAY(date_attendance) = 26, CONCAT(in_hour,"_",IFNULL(out_hour,"00:00:00")),"")) as tgl_26,
            MAX(IF(DAY(date_attendance) = 27, CONCAT(in_hour,"_",IFNULL(out_hour,"00:00:00")),"")) as tgl_27,
            MAX(IF(DAY(date_attendance) = 28, CONCAT(in_hour,"_",IFNULL(out_hour,"00:00:00")),"")) as tgl_28,
            MAX(IF(DAY(date_attendance) = 29, CONCAT(in_hour,"_",IFNULL(out_hour,"00:00:00")),"")) as tgl_29,
            MAX(IF(DAY(date_attendance) = 30, CONCAT(in_hour,"_",IFNULL(out_hour,"00:00:00")),"")) as tgl_30,
            MAX(IF(DAY(date_attendance) = 31, CONCAT(in_hour,"_",IFNULL(out_hour,"00:00:00")),"")) as tgl_31')
            ->join('users', 'presensi.id_pengguna', '=', 'users.id_pengguna')
            ->whereRaw('MONTH(date_attendance)="' . $bulan . '"')
            ->whereRaw('YEAR(date_attendance)="' . $tahun . '"')
            ->groupByRaw('presensi.id_pengguna,name')
            ->get();

        if ($request->has('exportexcel')) {
            $filename = "Rekap_Presensi_intern_$tahun-$bulan.xlsx";

            // Export data menggunakan class RekapPresensiExport
            return Excel::download(new ExportPresensi($bulan, $tahun), $filename);
        }

        return view('presensi.cetakrekap', compact('bulan', 'tahun', 'namaBulan', 'rekap'));
    }
}