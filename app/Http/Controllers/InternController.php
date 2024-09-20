<?php

namespace App\Http\Controllers;

use App\Models\Intern;
use Illuminate\Http\Request;

class InternController extends Controller
{
    //
    public function getChartData()
    {
        $data = Intern::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        return response()->json($data);
    }
}