<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use App;
use App\Models\Event;

class CalendarController extends BaseController
{
    public function index(Request $request)
    {
        if($request->ajax()) {  
            $data = Event::whereDate('start', '>=', $request->start)
                ->whereDate('end',   '<=', $request->end)
                ->get(['id', 'title', 'start', 'end']);
            return response()->json($data);
        }
        return view('fullcalendar');
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
