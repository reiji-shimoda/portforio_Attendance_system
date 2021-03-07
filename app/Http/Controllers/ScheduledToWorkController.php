<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Timestamp;
use Auth;
use Illuminate\Support\Facades\DB;

class ScheduledToWorkController extends Controller
{
    public function index()
    {
        $times = DB::table('timestamps')->select('begin', 'finish', 'employeeNumber')->get();
        $user = Auth::user();

        return view('attendance.ScheduledToWork', compact('times'), [ 'user' => $user ]);
    }
}
