<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use App;
use App\Models\Event;
use App\Models\User;

class CalendarController extends BaseController
{
    public function index(Request $request)
    {
        $user = User::get(['id','name as title']);
        if($request->ajax()) {  
            $data = Event::whereDate('start', '>=', $request->start)
                ->whereDate('end',   '<=', $request->end)
                ->get(['user_id as id', 'title', 'start', 'end']);
            return response()->json($data);
        }
        return $this->renderView('calendar/index',['user'=>$user,'active'=>'calendar-event']);
    }
    public function detail(Request $request)
    {
        $user = User::get(['id','name as title']);
        
        return $this->renderView('calendar/detail',['active'=>'calendar-event']);
    }
    public function calendarEvents(Request $request)
    {
 
        switch ($request->type) {
           case 'create':
              $event = Event::create([
                  'title' => $request->event_name,
                  'start' => $request->event_start,
                  'end' => $request->event_end,
              ]);
 
              return response()->json($event);
             break;
  
           case 'edit':
              $event = Event::find($request->id)->update([
                  'title' => $request->event_name,
                  'start' => $request->event_start,
                  'end' => $request->event_end,
              ]);
 
              return response()->json($event);
             break;
  
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
