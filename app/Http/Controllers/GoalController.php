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
        // Validate the request data
        $validatedData = $request->validate([
            'description' => 'required|string|max:255',
            'status' => 'required|string|in:In Progress,Done',
        ]);

        // Get the current user's ID
        $id_pengguna = Auth::id();

        // Attempt to create the goal
        try {
            Goal::create([
                'description' => $validatedData['description'],
                'status' => $validatedData['status'],
                'id_pengguna' => $id_pengguna,
            ]);

            // Redirect back with success message
            return redirect()->back()->with('success', 'Goal created successfully!');
        } catch (\Exception $e) {
            // Redirect back with error message if something goes wrong
            return redirect()->back()->with('error', 'Failed to create goal: ' . $e->getMessage());
        }
    }

    // Update the status of an existing goal by ID
    public function update(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'status' => 'required|in:In Progress,Done',
        ]);

        // Find the goal
        $goal = Goal::where('id', $id)->where('id_pengguna', Auth::id())->first();

        if ($goal) {
            $goal->status = $request->status;
            $goal->save();

            // Redirect back with success message
            return redirect()->back()->with('success', 'Goal status updated successfully!');
        }

        // Redirect back with error message if goal not found
        return redirect()->back()->with('error', 'Goal not found.');
    }

    // Get the current user's latest goal for today (optional, not needed if only for internal use)
    public function getGoal()
    {
        $goal = Goal::where('id_pengguna', Auth::id())->latest()->first(); // Fetch the latest goal
        return response()->json(['goal' => $goal]); // You can remove this if you don't need it.
    }
}