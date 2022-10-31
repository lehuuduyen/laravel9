<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use App;
use App\Models\Appointment;
use App\Models\Event;
use App\Models\Event_service;
use App\Models\User;

class CalendarController extends BaseController
{

    public function index()
    {
        $user = User::get(['id', 'name as title']);
        foreach ($user as $key => $val) {
            $user[$key]['width'] = "50px";
        }
        return $this->renderView('calendar/index', ['user' => $user, 'active' => 'calendar-event']);
    }
    public function detail(Request $request)
    {
        $user = User::get(['id', 'name as title']);

        return $this->renderView('calendar/detail', ['active' => 'calendar-event']);
    }
    public function calendarEvents(Request $request)
    {
        date_default_timezone_set('UTC');

        switch ($request->type) {
            case 'create':
                $date = $request->date;

                DB::beginTransaction();
                try {
                    if(count($request->items) >0){
                        $appointment = Appointment::create([
                            'customer_id' => (isset($request->customer_id))?$request->customer_id:null,
                            'code' =>Appointment::randomCode()
                        ]);
                        foreach ($request->items as $item) {
                            $start = date('Y/m/d', strtotime($date)) . " " . date("H:i:s", $item['start']);
                            $timeEnd = $item['start'] + $item['duration'];
                            $end = date('Y/m/d', strtotime($date)) . " " . date("H:i:s", $timeEnd);
    
                            $event = Event::create([
                                'title' => "Walk-In",
                                'start' => $start,
                                'end' => $end,
                                'appointment_id' => $appointment->id,
                                'user_id' => $item['employee'],
                                'service_id' => $item['serviceId'],
                            ]);
    
                        }
                        date_default_timezone_set('UTC');
                    }

                    

                    // Commit the queries!
                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollback();
                    return redirect('calendar-event')->with('toast_error', 'Task Created error!');

                }


                return redirect('calendar-event')->with('toast_success', 'Task Created Successfully!');

            case 'edit':
                $event = Event::find($request->id)->update([
                    'start' => $request->start,
                    'end' => $request->end,
                    'user_id' => $request->staff_id,

                ]);

                return response()->json($event);

            case 'delete':
                $event = Event::find($request->id)->delete();

                return response()->json($event);
                break;

            default:
                # ...
                break;
        }
    }
}
