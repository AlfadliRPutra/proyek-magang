<?php

namespace App\Http\Controllers;

use App\Models\Kantor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class OfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // Using Eloquent to fetch the first record in the office table
        $loc_office = Kantor::first();

        // Passing the data to the view
        return view('admin.office', compact('loc_office'));
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
        // Validate the incoming request data
        $validatedData = $request->validate([
            'location_office' => 'required|max:100',
            'radius' => 'required|max:10000',
        ]);

        // Create a new instance of the Kantor model
        $office = new Kantor();
        $office->location_office = $validatedData['location_office'];
        $office->radius = $validatedData['radius'];
        $office->save();

        // Optionally, remove or comment out the debug statement after testing
        // dd($office);

        // Redirect back with a success message
        return Redirect::back()->with('success', 'Office data successfully saved.');
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
        //
        $loc_office = Kantor::first();

        // Passing the data to the view
        return view('admin.office-edit', compact('loc_office'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
        // Validate the incoming request data
        $validatedData = $request->validate([
            'location_office' => 'required|max:100',
            'radius' => 'required|max:10000',
        ]);

        // Retrieve the specific record by ID and update the attributes
        $office = Kantor::find(1); // Replace '1' with the actual ID if needed

        if ($office) {
            // Attempt to update and save the record
            $office->location_office = $validatedData['location_office'];
            $office->radius = $validatedData['radius'];

            try {
                $office->save();
                // Redirect with success message
                return Redirect()->route('admin.office')->with('success', 'Berhasil Mengubah Lokasi Kantor');
            } catch (\Exception $e) {
                // Redirect with error message if an exception occurs
                return Redirect()->route('admin.office')->with('error', 'Gagal Mengubah Lokasi Kantor. Nilai radius terlalu besar.');
            }
        } else {
            // Redirect with error message if office not found
            return Redirect()->route('admin.office')->with('error', 'Lokasi Kantor tidak ditemukan');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function organisasi()
    {
        return view('intern.organisasi');
    }

    public function unit()
    {
        return view('intern.unit');
    }

    public function showunit($name)
    {

        // Mapping unit name to data (e.g., image, description)
        $units = [
            'tennis_lapangan' => [
                'title' => 'Tennis Lapangan',
                'image' => 'https://mediaini.com/wp-content/uploads/2022/02/daftar-lapangan-tenis-di-Bandung-by-Pixabay-640x375.jpg',
                'description' => 'Detail about Finance & Collection...',
                'pic' => 'Ezra',
                'days' => 'Selasa, Jumat',
                'time' => '17:00 WIB - Selesai',
                'image-pic' => 'venue/img/pic_ezra.png'
            ],
            'basket' => [
                'title' => 'Basket',
                'image' => 'path/to/basket_image.jpg',
                'description' => 'Detail about Basket...'
            ],
            'aom' => [
                'title' => 'AOM',
                'image' => 'path/to/aom_image.jpg',
                'description' => 'Detail about AOM...'
            ],
            'finance_collection' => [
                'title' => 'Finance & Collection',
                'image' => 'https://mediaini.com/wp-content/uploads/2022/02/daftar-lapangan-tenis-di-Bandung-by-Pixabay-640x375.jpg',
                'description' => 'Detail about Finance & Collection...',
                'pic' => 'Ezra',
                'days' => 'Selasa, Jumat',
                'time' => '17:00 WIB - Selesai',
                'image-pic' => 'venue/img/pic_ezra.png'
            ],
            'daman' => [
                'title' => 'Daman',
                'image' => 'path/to/daman_image.jpg',
                'description' => 'Detail about Daman...'
            ],
            'bges' => [
                'title' => 'BGES',
                'image' => 'path/to/bges_image.jpg',
                'description' => 'Detail about BGES...'
            ],
            'panahan' => [
                'title' => 'Panahan',
                'image' => 'https://cdn.antaranews.com/cache/1200x800/2018/08/902C6C71-D62E-4A33-8584-C9FC88EEB829.jpeg',
                'description' => 'Detail about Panahan...'
            ],
            'mushola' => [
                'title' => 'Mushola',
                'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT2bc1uGq77aIlHFaOcKVsoF9qklOvOjZiXEw&s',
                'description' => 'Detail about Mushola...'
            ],
        ];

        // Check if unit exists in the array
        if (array_key_exists($name, $units)) {
            // Pass the relevant unit data to the view
            return view('intern.unit-show', ['unit' => $units[$name]]);
        } else {
            // If the unit doesn't exist, show a 404 page
            abort(404);
        }
    }
}
