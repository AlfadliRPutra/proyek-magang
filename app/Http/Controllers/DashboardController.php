<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Event;
use App\Models\Intern;
use App\Models\Presensi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    public function redirect()
    {
        // Get the authenticated user using the User model
        $user = auth()->user(); // This returns an instance of User

        if ($user->hasRole('super-admin')) {
            return redirect('/super-admin/dashboard');
        }

        if ($user->hasRole('admin')) {
            return redirect('/admin/dashboard');
        }

        if ($user->hasRole('intern')) {
            return redirect('/intern/dashboard');
        }

        // Fallback redirect if no role matches
        return redirect('/');
    }
    /**
     * Display a listing of the resource.
     */
    public function InternDashboard()
    {
        // Mendapatkan tanggal hari ini
        $today = date("Y-m-d");
        // Mendapatkan bulan dan tahun saat ini
        $thisMonth = date("m") * 1;
        $thisYear = date("Y");
        // Mengambil ID pengguna yang terautentikasi
        $id_pengguna = Auth::user()->id_pengguna;


        // Mengambil data presensi hari ini untuk pengguna terautentikasi
        $presensiToday = DB::table('presensi')->where('id_pengguna', $id_pengguna)->where('date_attendance', $today)->first();

        // Mengambil riwayat presensi bulan ini
        $historyThisMonth = DB::table('presensi')
            ->where('id_pengguna', $id_pengguna)
            ->whereRaw('MONTH(date_attendance)="' . $thisMonth . '"')
            ->whereRaw('YEAR(date_attendance)="' . $thisYear . '"')
            ->orderBy('date_attendance')
            ->get();

        // Menghitung rekapitulasi presensi
        $rekapPresensi = DB::table('presensi')
            ->selectRaw('
        SUM(CASE 
            WHEN (TIME(in_hour) > "08:15") THEN 1
            ELSE 0
        END) as jmlterlambat,
        COUNT(*) as jmlhadir
    ')
            ->where('id_pengguna', $id_pengguna)
            ->whereRaw('MONTH(date_attendance) = ?', [$thisMonth])
            ->whereRaw('YEAR(date_attendance) = ?', [$thisYear])
            ->first();


        // Daftar nama bulan
        $nameMonth = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

        // Mengambil rekapitulasi izin bulan ini
        $rekapizin = DB::table('absensi')
            ->where('id_pengguna', $id_pengguna)
            ->selectRaw('SUM(IF(status="i",1,0)) as jmlizin,SUM(IF(status="s",1,0)) as jmlsakit')
            ->whereRaw('MONTH(date_izin)="' . $thisMonth . '"')
            ->whereRaw('YEAR(date_izin)="' . $thisYear . '"')
            ->first();

        // Mengambil event yang akan datang
        $events = Event::whereDate('tanggal_mulai', '>=', Carbon::today())->orderBy('tanggal_mulai')->get();

        // Mengembalikan tampilan dashboard intern dengan data yang relevan
        return view('intern.dashboard', compact(
            'presensiToday',
            'historyThisMonth',
            'nameMonth',
            'thisMonth',
            'thisYear',
            'rekapPresensi',
            'rekapizin',
            'events'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function dashboardadmin()
    {
        // Mendapatkan tanggal hari ini
        $today = date("Y-m-d");

        // Menghitung rekapitulasi presensi hari ini
        $rekapPresensi = DB::table('presensi')
            ->selectRaw('COUNT(id_pengguna) as jmlhadir, 
            SUM(CASE 
                WHEN in_hour BETWEEN "08:15:00" AND "12:15:00" THEN 1 
                ELSE 0 
            END) as jmltelat')
            ->whereDate('date_attendance', $today)
            ->first();

        // Menghitung rekapitulasi izin hari ini
        $rekapizin = [
            'jmlizin' => Absensi::getTotalIzin($today),
            'jmlsakit' => Absensi::getTotalSakit($today),
        ];

        // Mengembalikan tampilan dashboard admin dengan data rekapitulasi
        return view('admin.dashboard',  compact('rekapPresensi', 'rekapizin'));
    }

    public function presensichart()
    {
        // Mengambil data presensi untuk minggu ini
        $data = Presensi::selectRaw('DAYOFWEEK(date_attendance) as day_of_week, 
                                COUNT(CASE WHEN in_hour IS NOT NULL THEN 1 END) as hadir,
                                COUNT(CASE WHEN in_hour IS NULL THEN 1 END) as tidak_hadir')
            ->whereBetween('date_attendance', [now()->startOfWeek(), now()->endOfWeek()])
            ->groupBy('day_of_week')
            ->orderBy('day_of_week')
            ->get();

        // Mengembalikan data presensi dalam format JSON
        return response()->json($data);
    }

    public function getDelayChartData()
    {
        // Mengambil semua intern
        $interns = Intern::pluck('id_pengguna')->toArray();

        // Mengambil semua hari kerja dalam minggu ini
        $daysOfWeek = [2, 3, 4, 5, 6]; // Senin - Jumat

        // Membuat array untuk menyimpan hasil akhir
        $result = [];

        foreach ($daysOfWeek as $day) {
            $date = now()->startOfWeek()->addDays($day - 1);

            // Menghitung kehadiran
            $hadirCount = Presensi::where('date_attendance', $date)
                ->whereNotNull('in_hour')
                ->count();

            // Menghitung ketidakhadiran
            $tidakHadirCount = Intern::whereNotIn('id_pengguna', function ($query) use ($date) {
                $query->select('id_pengguna')
                    ->from('presensi')
                    ->where('date_attendance', $date);
            })->count();

            // Menghitung keterlambatan
            $terlambatCount = Presensi::where('date_attendance', $date)
                ->whereNotNull('in_hour')
                ->where('in_hour', '>', '08:15:00')
                ->count();

            // Menyimpan hasil per hari dalam array
            $result[] = [
                'day_of_week' => $day,
                'hadir' => $hadirCount,
                'tidak_hadir' => $tidakHadirCount,
                'terlambat' => $terlambatCount
            ];
        }

        // Mengembalikan data keterlambatan dalam format JSON
        return response()->json($result);
    }

    public function index(Request $request)
    {
        // Fungsi ini belum diimplementasikan
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Fungsi ini belum diimplementasikan
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Fungsi ini belum diimplementasikan
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Fungsi ini belum diimplementasikan
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Fungsi ini belum diimplementasikan
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Fungsi ini belum diimplementasikan
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Fungsi ini belum diimplementasikan
    }
}
