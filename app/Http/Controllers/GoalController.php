<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GoalController extends Controller
{
    // Display the goal page and retrieve the current user's goal
    public function index()
    {
        $today = now()->format('Y-m-d'); // Get today's date in Y-m-d format
        $userId = Auth::user()->id_pengguna; // Get authenticated user's custom ID



        // Fetch today's goals
        $goalsToday = Goal::where('id_pengguna', $userId)
            ->whereDate('created_at', $today) // Ensure the goal is created today
            ->latest() // Optional: Get the latest goals first
            ->get();


        // Fetch goals done before today
        $goalsDone = Goal::where('id_pengguna', $userId)
            ->whereDate('created_at', '<', $today) // Goals created before today
            ->latest() // Optional: Get the latest done goals first
            ->get();

        return view('intern.goal', compact('goalsToday', 'goalsDone')); // Send both sets of goals to the view
    }



    // Store a new goal
    public function store(Request $request)
    {
        $userId = auth()->user()->id_pengguna;
        $today = now()->format('Y-m-d'); // Atau pakai timestamp sesuai preferensi

        // Cek apakah sudah ada goal hari ini
        $existingGoal = Goal::where('id_pengguna', $userId)
            ->whereDate('created_at', $today)
            ->exists();

        if ($existingGoal) {
            return redirect()->back()->with('error', 'Kamu sudah mengisi goal hari ini.');
        }

        // Lanjutkan penyimpanan goal jika belum ada
        $goal = new Goal();
        $goal->user_id = $userId;
        $goal->goal = $request->input('goal');
        $goal->status = $request->input('status');
        $goal->save();

        return redirect()->back()->with('success', 'Goal berhasil ditambahkan!');
    }


    public function update(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'status' => 'required|in:In Progress,Done',
        ]);

        // Update the goal directly
        $goal = Goal::find($id);

        if ($goal) {
            $goal->update(['status' => $request->status]);

            return redirect()->back()->with('success', 'Goal status updated successfully!');
        }

        return redirect()->back()->with('error', 'Goal not found.');
    }



    // Get the current user's latest goal for today (optional, not needed if only for internal use)
    public function getGoal()
    {
        $goal = Goal::where('id_pengguna', Auth::id())->latest()->first(); // Fetch the latest goal
        return response()->json(['goal' => $goal]); // You can remove this if you don't need it.
    }
}
