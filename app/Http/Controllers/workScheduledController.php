<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\workscheduled;
use Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class WorkScheduledController extends Controller
{
     public function index()
     {
        $users = DB::table('users')->select('name', 'employeeNumber')->get();
        return view('attendance.workScheduled', compact('users'));
     }

     public function inquiry($employeeNumber) 
     {
        $workScheduleds = DB::table('workscheduleds')->select('id', 'days', 'workTime' ,'employeeNumber')->get();

        return view('attendance.workInquiry', compact('workScheduleds'), ['employeeNumber' => $employeeNumber] );
     }

     public function inquiryAuth() 
     {
        $workScheduleds = DB::table('workscheduleds')->select('days', 'workTime' ,'employeeNumber')->get();

        return view('attendance.workAuthInquiry', compact('workScheduleds'));
     }
     
     public function edit($id) 
     {
        $workScheduled = workScheduled::find($id);

        return view('attendance.workEdit', compact('workScheduled') );

     }
     
     public function scheduledUpdate(Request $request, $id)
     {
         $workScheduled = workScheduled::find($id);

         $workScheduled->workTime = $request->input('workTime');

         $workScheduled->save();

         return view('attendance.store_ScheduledUpdate');

     }

     public function scheduledCreate(Request $request)
     {
         $this->validate($request,
               [
                  'days' => ['required', 'date'],
                  'workTime' => ['required', 'string'],
                  'employeeNumber' => ['required', 'string', 'min:10'],
               ]
            );

         $oldDays = new Carbon($request->days);
         $newDays = new Carbon($request->days);

         for($newDays; $newDays->month == $oldDays->month; $newDays->addDay()) 
         {
            if($newDays->isWeekday())
            {
               Workscheduled::create([
                  'days' => $newDays,
                  'workTime' => $request->workTime,
                  'employeeNumber' => $request->employeeNumber,
               ]);
            }
            else 
            {
               Workscheduled::create([
                  'days' => $newDays,
                  'workTime' => '休日',
                  'employeeNumber' => $request->employeeNumber,
               ]);
            }
            
         }
         
         return view('attendance.store_workScheduled');

         
     }
}
