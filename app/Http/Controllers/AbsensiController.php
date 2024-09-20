<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil ID pengguna yang terautentikasi
        $id_pengguna = Auth::user()->id_pengguna;

        // Mengambil data pengguna dengan id_pengguna yang ditentukan dan memuat relasi 'absensi'
        $user = User::with('absensi')->where('id_pengguna', $id_pengguna)->first();

        // Mengakses data 'absensi' dari pengguna yang diambil
        $dataizin = $user ? $user->absensi : collect();

        // Mengirimkan data yang diambil ke tampilan
        return view('intern.absensi', compact('dataizin'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Mengembalikan tampilan form untuk membuat data absensi baru
        return view('intern.absensi-form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Mengambil ID pengguna saat ini
        $id_pengguna = Auth::user()->id_pengguna;

        // Membuat instance Absensi baru dan mengatur propertinya
        $absensi = new Absensi();
        $absensi->id_pengguna = $id_pengguna;
        $absensi->date_izin = $request->input('date_izin');
        $absensi->status = $request->input('status');
        $absensi->keterangan = $request->input('keterangan');
        $absensi->status_approved = 0; // Mengatur nilai default untuk status_approved

        // Menyimpan data Absensi ke database
        if ($absensi->save()) {
            return redirect()->route('intern.absensi')->with(['success' => 'Data Berhasil Disimpan']);
        } else {
            return redirect()->route('intern.absensi')->with(['error' => 'Data Gagal Disimpan']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        // Mengambil data absensi dengan join ke tabel users dan mengurutkan berdasarkan tanggal izin
        $izinsakit = DB::table('absensi')
            ->join('users', 'absensi.id_pengguna', '=', 'users.id_pengguna')
            ->orderBy('date_izin', 'desc')
            ->get();

        // Mengembalikan tampilan dengan data izin sakit
        return view('admin.absensi', compact('izinsakit'));
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
    public function update(Request $request)
    {
        // Mengambil status_approved dan id_izinsakit_form dari permintaan
        $status_approved = $request->status_approved;
        $id_izinsakit_form = $request->id_izinsakit_form;

        // Memperbarui status_approved pada data absensi berdasarkan ID
        $update = DB::table('absensi')->where('id', $id_izinsakit_form)->update([
            'status_approved' => $status_approved
        ]);

        // Mengalihkan kembali dengan pesan sukses atau peringatan
        if ($update) {
            return Redirect::back()->with(['success' => 'Data Berhasil Diupdate']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Diupdate']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Fungsi ini belum diimplementasikan
    }

    public function batalIzin($id)
    {
        // Memperbarui status_approved menjadi 0 untuk data absensi berdasarkan ID
        $update = DB::table('absensi')->where('id', $id)->update([
            'status_approved' => 0
        ]);

        // Mengalihkan kembali dengan pesan sukses atau peringatan
        if ($update) {
            return Redirect::back()->with(['success' => 'Data Berhasil Diupdate']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Diupdate']);
        }
    }
}