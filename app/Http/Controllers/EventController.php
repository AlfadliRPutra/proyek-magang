<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class EventController extends Controller
{
    /**
     * Menampilkan daftar semua resource.
     */
    public function index()
    {
        // Mengambil semua data event dari database
        $events = Event::all();
        // Mengembalikan tampilan dengan data event
        return view('admin.event', compact('events'));
    }

    /**
     * Menampilkan formulir untuk membuat resource baru.
     */
    public function create()
    {
        // Mengembalikan tampilan formulir untuk membuat event baru
        return view('admin.event-buat');
    }

    /**
     * Menyimpan resource yang baru dibuat di penyimpanan.
     */
    public function store(Request $request)
    {
        try {
            // Validasi data dari request
            $validatedData = $request->validate([
                'nama' => 'required|string|max:255',
                'tanggal_mulai' => 'required|date',
                'durasi' => 'required|integer|min:1',
                'file' => 'nullable|file|mimes:jpg,jpeg,png|max:2048', // Menyesuaikan tipe mime dan ukuran file
            ]);

            // Menangani unggahan file jika ada
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $originalName = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $timestamp = Carbon::now()->format('Ymd_His'); // Format timestamp saat ini

                // Membuat nama file baru: timestamp_namafileorisinil.extension
                $newFileName = $timestamp . '_' . $originalName;

                // Menyimpan file di direktori 'public/events' dengan nama file baru
                $file->storeAs('events', $newFileName, 'public');

                // Menetapkan nama file baru dalam array data yang divalidasi untuk disimpan di database
                $validatedData['file'] = $newFileName;
            }

            // Membuat record event baru
            Event::create($validatedData);

            // Redirect kembali dengan pesan sukses
            return redirect()->route('admin.event')->with('success', 'Event berhasil dibuat!');
        } catch (Exception $e) {
            // Mencatat pengecualian untuk keperluan debugging
            Log::error('Terjadi kesalahan saat membuat event: ' . $e->getMessage());

            // Redirect kembali dengan pesan kesalahan
            return redirect()->back()->with('error', 'Terjadi kesalahan saat membuat event. Silakan coba lagi.');
        }
    }

    /**
     * Menampilkan resource yang ditentukan.
     */
    public function show(string $id)
    {
        // Fungsi ini belum diimplementasikan
    }

    /**
     * Menampilkan formulir untuk mengedit resource yang ditentukan.
     */
    public function edit(string $id)
    {
        // Fungsi ini belum diimplementasikan
    }

    /**
     * Memperbarui resource yang ditentukan di penyimpanan.
     */
    public function update(Request $request, string $id)
    {
        // Fungsi ini belum diimplementasikan
    }

    /**
     * Menghapus resource yang ditentukan dari penyimpanan.
     */
    public function destroy(string $id)
    {
        // Fungsi ini belum diimplementasikan
    }
}