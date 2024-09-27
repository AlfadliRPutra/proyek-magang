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


    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'date_izin' => 'required|date',
            'status' => 'required',
            'keterangan' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:pdf|max:6144', // Menambahkan validasi untuk file PDF (maksimum 6MB)
        ]);

        // Mengambil ID pengguna saat ini
        $id_pengguna = Auth::user()->id_pengguna;

        // Membuat instance Absensi baru dan mengatur propertinya
        $absensi = new Absensi();
        $absensi->id_pengguna = $id_pengguna;
        $absensi->date_izin = $validatedData['date_izin'];
        $absensi->status = $validatedData['status'];
        $absensi->keterangan = $validatedData['keterangan'];
        $absensi->status_approved = 0; // Mengatur nilai default untuk status_approved

        // Menyimpan file jika ada
        if ($request->hasFile('file')) {
            // Mengambil file dan menyimpannya ke disk 'public'
            $filePath = $request->file('file')->store('absensi', 'public');
            // Menyimpan nama file ke database
            $absensi->file = $filePath; // Kolom file di model Absensi
        }

        // Menyimpan data Absensi ke database
        if ($absensi->save()) {
            // Menggunakan flash session untuk pesan sukses
            return redirect()->route('intern.absensi')->with('success', 'Data Berhasil Disimpan');
        } else {
            // Menggunakan flash session untuk pesan gagal
            return redirect()->route('intern.absensi.form')->with('warning', 'Data Gagal Disimpan');
        }
    }





    /**
     * Display the specified resource.
     */
    public function show()
    {
        // Mengambil data absensi dengan join ke tabel users dan mengurutkan berdasarkan tanggal izin
        $absensis = Absensi::with('pengguna') // Assuming you have a relationship defined in Absensi model
            ->get();

        // Mengembalikan tampilan dengan data izin sakit
        return view('admin.absensi', compact('absensis'));
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
        // Validate the incoming request
        $request->validate([
            'id' => 'required|exists:absensi,id',
            'status_approved' => 'required|in:1,2',
        ]);

        // Update the status in the database
        $update = DB::table('absensi')->where('id', $request->id)->update([
            'status_approved' => $request->status_approved
        ]);

        // Redirect back with a success or warning message
        return $update
            ? Redirect::back()->with('success', 'Data Berhasil Diupdate')
            : Redirect::back()->with('warning', 'Data Gagal Diupdate');
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
