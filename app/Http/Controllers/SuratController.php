<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SuratController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            // Mengambil data Surat yang pengirim_id-nya sesuai dengan ID pengguna yang terautentikasi
            $userId = Auth::user()->id_pengguna;
            $surats = Surat::where('pengirim_id', $userId)->get();

            // Mengirimkan data Surat ke tampilan
            return view('intern.surat', compact('surats'));
        } catch (Exception $e) {
            // Mencatat pesan kesalahan pada log
            Log::error('Error fetching surat: ' . $e->getMessage());

            // Mengalihkan kembali dengan pesan kesalahan
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengambil daftar surat. Silakan coba lagi.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Mengembalikan tampilan form untuk membuat Surat baru
        return view('intern.surat-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Memvalidasi data dari permintaan
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'jenis' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:6144', // 6MB dalam kilobyte
        ]);

        // Menangani unggahan file jika ada
        if ($request->hasFile('file')) {
            $file = $request->file('file');

            // Cek ukuran file
            if ($file->getSize() > 6144 * 1024) { // Maksimal 6MB
                return redirect()->back()->with('error', 'Ukuran file terlalu besar. Maksimal 6MB.')->withInput();
            }

            $originalName = $file->getClientOriginalName();
            $timestamp = Carbon::now()->format('Ymd_His');
            $newFileName = $timestamp . '_' . $originalName;

            // Simpan file
            $file->storeAs('surats', $newFileName, 'public');
            $validatedData['file'] = $newFileName;
        }


        // Menambahkan ID pengguna yang terautentikasi sebagai pengirim_id
        $validatedData['pengirim_id'] = Auth::user()->id_pengguna;

        // Menambahkan status default
        $validatedData['status'] = 0;
        // Membuat data Surat baru
        Surat::create($validatedData);

        // Mengalihkan kembali dengan pesan sukses
        return redirect()->route('intern.surat')->with('success', 'Surat berhasil dibuat!');
    }


    public function adminIndex()
    {
        // Mengambil semua data surat
        $surats = Surat::with('pengirim')->get(); // Mengasumsikan 'pengirim' adalah relasi yang didefinisikan di model Surat

        // Mengembalikan tampilan dengan data surat
        return view('admin.surat', compact('surats'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Tidak ada implementasi untuk fungsi ini
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Mengambil data Surat berdasarkan ID
        $surat = Surat::findOrFail($id);
        // Mengembalikan tampilan form untuk mengedit Surat
        return view('admin.surat-edit', compact('surat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            // Memvalidasi data dari permintaan
            $request->validate([
                'hasil_file' => 'required|file|mimes:pdf,word|max:2048',
            ]);

            // Menemukan data Surat berdasarkan ID
            $surat = Surat::findOrFail($id);

            // Menangani unggahan file jika ada
            if ($request->hasFile('hasil_file')) {
                $file = $request->file('hasil_file');
                $originalName = $file->getClientOriginalName();
                $timestamp = Carbon::now()->format('Ymd_His');
                $newFileName = $timestamp . '_' . $originalName;
                $file->storeAs('hasil_file', $newFileName, 'public');
                $surat->hasil_file = $newFileName;
            }

            // Memperbarui status menjadi 1 setelah file diunggah
            $surat->status = 1;

            // Menyimpan perubahan
            $surat->save();

            // Mengalihkan kembali dengan pesan sukses
            return redirect()->route('admin.surat')->with('success', 'Surat berhasil diperbarui!');
        } catch (Exception $e) {
            // Mencatat pesan kesalahan pada log
            Log::error('Error updating surat: ' . $e->getMessage());
            // Mengalihkan kembali dengan pesan kesalahan
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui surat. Silakan coba lagi.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Temukan data berdasarkan ID
        $surat = Surat::find($id);

        // Cek jika data ditemukan
        if (!$surat) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }

        // Hapus file utama jika ada
        if ($surat->file) {
            $filePath = public_path('surats/' . $surat->file);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        // Hapus hasil_file jika ada
        if ($surat->hasil_file) {
            $hasilFilePath = public_path('app/hasil_file/' . $surat->hasil_file);
            if (file_exists($hasilFilePath)) {
                unlink($hasilFilePath);
            }
        }

        // Hapus data dari database
        $surat->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('admin.surat')->with('success', 'Data berhasil dihapus.');
    }
}
