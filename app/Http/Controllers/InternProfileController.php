<?php

namespace App\Http\Controllers;

use App\Models\Campus;
use App\Models\User;
use App\Models\Intern;
use App\Models\UnitListing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class InternProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('intern/profil');
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
        //
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
    public function edit()
    {
        $id_pengguna = Auth::user()->id_pengguna;
        $intern = DB::table('interns')->where('id_pengguna', $id_pengguna)->first();

        // Correctly retrieve units and campuses
        $units = UnitListing::get();
        $campuses = Campus::get();

        return view('intern.profil-edit', compact('intern', 'units', 'campuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id_pengguna = auth()->user()->id_pengguna;

        $user = User::where('id_pengguna', $id_pengguna)->first();
        $intern = Intern::where('id_pengguna', $id_pengguna)->first();

        if (!$user || !$intern) {
            return Redirect::back()->with('error', 'User or Intern not found.');
        }

        // Validate the request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'campus_id' => 'required_without:other_campus', // Require campus_id unless other_campus is filled
            'other_campus' => 'nullable|string|max:255', // Validate other_campus
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        // Prepare data for User model
        $userData = [
            'name' => $request->name,
        ];

        // Update User model
        User::where('id_pengguna', $id_pengguna)->update($userData);

        // Prepare data for Intern model
        $internData = [
            'no_phone' => $request->no_hp,
            'unit_id' => $request->unit_id,
            'campus_id' => null, // Initialize campus_id as null
        ];

        // Check if 'other_campus' field is filled
        if ($request->input('other_campus')) {
            // Create a new campus entry
            $newCampus = Campus::create([
                'nama' => $request->other_campus,
            ]);
            // Set the campus_id to the new campus's ID
            $internData['campus_id'] = $newCampus->id;
        } else {
            // If a campus is selected, set the campus_id
            $internData['campus_id'] = $request->campus_id;
        }

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $filename = date('Y-m-d') . '_' . $foto->getClientOriginalName();
            $path = 'photo-user/' . $filename;
            Storage::disk('public')->put($path, file_get_contents($foto));
            $internData['foto'] = $filename;
        }

        // Update Intern model
        Intern::where('id_pengguna', $id_pengguna)->update($internData);

        return Redirect()->route('intern.profile')->with('success', 'Data successfully updated.');
    }





    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
