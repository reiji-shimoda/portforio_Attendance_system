<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Timestamp;
use Auth;
use Illuminate\Support\Facades\DB;

class AttendanceSystemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $times = DB::table('timestamps')->select('begin', 'finish', 'employeeNumber')->get();
        $user = Auth::user();

        return view('attendance.create', compact('times'), [ 'user' => $user ]);
    }

    //出勤打刻
    public function beginTimeStamp() {
        $user = Auth::user()->employeeNumber;
        $latestData =  DB::table('timestamps')->where('employeeNumber', $user)->latest()->first();

        $oldTime = $latestData;
        if($oldTime == null){
            Timestamp::create([
                'begin' => Carbon::now(),
                
                'employeeNumber' => Auth::user()->employeeNumber,
                ]);
    
            return view('attendance.store_begin');
        }
        $oldTimeCarbon = new Carbon($oldTime->begin);
        $oldTimeDay = $oldTimeCarbon->startOfday();

        $newTime = Carbon::today();
        $newTimeDay = $newTime->startOfday();

        if( !($oldTimeDay == $newTimeDay) ) 
        {
            Timestamp::create([
            'begin' => Carbon::now(),
            
            'employeeNumber' => Auth::user()->employeeNumber,
            ]);

            return view('attendance.store_begin');
    
        }
        else
        {
            return redirect()->back()->with('error', '出勤エラー');
        }
    }

    //退勤打刻
    public function finishTimestamp() {
        $user = Auth::user()->employeeNumber;
        $latestData =  DB::table('timestamps')->where('employeeNumber', $user)->latest()->first();
        if($latestData == null)
        {
            return redirect()->back()->with('error', '退勤エラー');
        }
        
        $oldFinishTime = $latestData->finish;

        $oldTimeCarbon = new Carbon($latestData->begin);
        $oldTimeDay = $oldTimeCarbon->startOfday();
        

        $newTime = Carbon::today();
        $newTimeDay = $newTime->startOfday();

        if( !($oldTimeDay == $newTimeDay) || !($oldFinishTime == null))
        {
            return redirect()->back()->with('error', '退勤エラー');
        }    
        else
        {
            $updateTime = Timestamp::select('id')->latest()->first();


            $updateTime->finish = Carbon::now();

            $updateTime->save();
    
            return view('attendance.store_finish');
        }
    }        

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
