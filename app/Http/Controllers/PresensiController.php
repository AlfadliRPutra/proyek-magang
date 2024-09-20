<?php

namespace App\Http\Controllers;

use App\Models\Kantor;
use App\Models\Presensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PresensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $today = date("Y-m-d");
        $id_pengguna = Auth::user()->id_pengguna;

        // Check the count of today's attendance for the authenticated user
        $cek = Presensi::where('date_attendance', $today)
            ->where('id_pengguna', $id_pengguna)
            ->count();

        // Get the office location with ID 1
        $loc_office = Kantor::find(1);

        return view('intern.presensi', compact('cek', 'loc_office'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $id_pengguna = Auth::user()->id_pengguna;
        $date_attendance = date("Y-m-d");
        $hour = date("H:i:s");

        // Retrieve office location using Eloquent
        $loc_office = Kantor::find(1);
        $loc = explode(",", $loc_office->location_office);
        $latitudekantor = $loc[0];
        $longitudekantor = $loc[1];

        // Get user's location from the request
        $lokasi = $request->lokasi;
        $lokasiuser = explode(",", $lokasi);
        $latitudeuser = $lokasiuser[0];
        $longitudeuser = $lokasiuser[1];

        // Calculate the distance between the office and the user's location
        $distance = function ($lat1, $lon1, $lat2, $lon2) {
            $theta = $lon1 - $lon2;
            $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
            $miles = acos($miles);
            $miles = rad2deg($miles);
            $miles = $miles * 60 * 1.1515;
            $kilometers = $miles * 1.609344;
            $meters = $kilometers * 1000;
            return round($meters);
        };

        $radius = $distance($latitudekantor, $longitudekantor, $latitudeuser, $longitudeuser);

        // Check if the user has already checked in today
        $presensi = Presensi::where('date_attendance', $date_attendance)
            ->where('id_pengguna', $id_pengguna)
            ->first();

        $current_hour = date('H:i');

        if ($presensi) {
            // User has already checked in, so proceed with check-out
            if ($presensi->out_hour) {
                echo "error|Anda sudah melakukan absen out hari ini.";
                return;
            }
            if ($current_hour < '12:31' || $current_hour > '19:00') {
                echo "error|Anda hanya bisa melakukan absen keluar antara jam 12:31 siang sampai 19:00.";
                return;
            }
            // Proceed with check-out
            $ket = "out";
        } else {
            // User is attempting to check in
            if ($current_hour < '06:30' || $current_hour > '12:30') {
                echo "error|Anda hanya bisa melakukan absen masuk antara jam 06:30 pagi sampai 12:30 siang.";
                return;
            }
            // Proceed with check-in
            $ket = "in";
        }

        // Code to handle the actual check-in or check-out process using $ket


        // Process the image
        $image = $request->image;
        $folderPath = "public/uploads/presensi/";
        $formatName = $id_pengguna . "-" . $date_attendance . "-" . $ket;
        $image_parts = explode(";base64", $image);
        $image_base64 = base64_decode($image_parts[1]);
        $fileName = $formatName . ".png";
        $file = $folderPath . $fileName;

        if ($radius > $loc_office->radius) {
            echo "error|Maaf Anda Berada Diluar Radius. Jarak Anda " . $radius . " meter dari Kantor|";
        } else {
            if ($presensi) {
                // Update the existing attendance record for check-out
                $presensi->update([
                    'out_hour' => $hour,
                    'foto_out' => $fileName,
                    'location_out' => $lokasi,
                ]);

                echo "success|Waktunya pulang, Hati Hati Di Jalan|out";
                Storage::put($file, $image_base64);
            } else {
                // Create a new attendance record for check-in
                $presensi = Presensi::create([
                    'id_pengguna' => $id_pengguna,
                    'date_attendance' => $date_attendance,
                    'in_hour' => $hour,
                    'foto_in' => $fileName,
                    'location_in' => $lokasi,
                ]);

                if ($presensi) {
                    echo "success|Selamat Bekerja|in";
                    Storage::put($file, $image_base64);
                } else {
                    echo "error|Gagal Presensi Masuk, Hubungi Admin IT|in";
                }
            }
        }
    }

    public function monitoring()
    {
        return view('admin.presensi-monitoring');
    }

    public function getpresensi(Request $request)
    {
        $tanggal = $request->query('tanggal'); // Menggunakan query parameter
        $presensi = DB::table('presensi')
            ->join('users', 'presensi.id_pengguna', '=', 'users.id_pengguna')
            ->select('presensi.*', 'users.name')
            ->where('date_attendance', $tanggal)
            ->get();

        return view('presensi.getpresensi', compact('presensi'))->render(); // Menggunakan render untuk AJAX
    }





    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
