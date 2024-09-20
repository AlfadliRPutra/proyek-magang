<?php

namespace App\Http\Controllers;

use App\Models\Intern;
use App\Models\UnitListing;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class DataMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Mengambil data pengguna dengan peran 'intern' dan memuat relasi 'interns' serta 'unitListing'
        $interns = User::role('intern')
            ->with('interns.unitListing')
            ->get();

        // Mengembalikan tampilan dengan data interns
        return view('admin.data-master', compact('interns'));
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
        // Validasi input dari request
        $validatedData = $request->validate([
            'nik' => 'required|unique:users|max:255',
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users|max:255',
            'no_hp' => 'required|max:15',
            'role' => 'required|max:50',
        ]);

        // Membuat instance User baru dan menyimpan data dari request
        $intern = new User();
        $intern->nik = $request->nik;
        $intern->name = $request->name;
        $intern->email = $request->email;
        $intern->no_hp = $request->no_hp;
        $intern->role = $request->role;
        $intern->password = Hash::make('intern123'); // Menetapkan password default
        $intern->save();

        // Redirect kembali dengan pesan sukses
        return Redirect::back()->with('success', 'User berhasil disimpan.');
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
    public function edit($id)
    {
        // Mengambil data pengguna dengan relasi 'interns' dan 'unitListing'
        $intern = User::with(['interns.unitListing'])->findOrFail($id);
        $units = UnitListing::all(); // Mengambil semua unit

        // Mengembalikan tampilan dengan data intern dan units
        return view('admin.data-master-edit', compact('intern', 'units'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi input dari request
        $validated = $request->validate([
            'unit_id' => 'required|exists:unit_listings,id',
            // Tambahkan validasi untuk field lain jika perlu
        ]);

        try {
            // Menemukan user berdasarkan ID dan memuat relasi 'interns'
            $user = User::with('interns')->where('id', $id)->firstOrFail();

            // Menemukan intern terkait
            $intern = $user->interns;

            // Pastikan intern ditemukan
            if (!$intern) {
                return redirect()->route('admin.intern.edit', $id)->with('error', 'Intern tidak ditemukan.');
            }

            // Memperbarui unit_id intern
            $intern->unit_id = $request->input('unit_id');

            // Menyimpan perubahan ke database
            $intern->save();

            // Redirect dengan pesan sukses
            return redirect()->route('admin.intern', $id)->with('success', 'Intern berhasil diperbarui!');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Tangani jika user atau intern tidak ditemukan
            return redirect()->route('admin.intern.edit', $id)->with('error', 'User atau Intern tidak ditemukan.');
        } catch (\Exception $e) {
            // Tangani kesalahan lain, seperti kesalahan database
            return redirect()->route('admin.intern.edit', $id)->with('error', 'Gagal memperbarui intern. Silakan coba lagi.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Menemukan pengguna dengan relasi 'interns'
        $user = User::with('interns')->findOrFail($id);

        // Menghapus data terkait di tabel Intern
        $user->interns()->delete();

        // Menghapus pengguna dari tabel User
        $user->delete();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('admin.intern')->with('success', 'Data pengguna dan data terkait berhasil dihapus.');
    }
}