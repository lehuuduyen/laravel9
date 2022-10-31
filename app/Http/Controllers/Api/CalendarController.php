<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Models\Event;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class CalendarController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $data = [];
        if(isset($request->start)) {  
            $data = Event::join('category', 'category.id', '=', 'events.service_id')->join('appointments', 'appointments.id', '=', 'events.appointment_id')->whereDate('events.start', '>=', $request->start)
                ->whereDate('events.end',   '<=', $request->end)
                ->get(['events.user_id as resourceId', 'events.title', 'events.start', 'events.end','events.id','category.name','appointments.code']);
            foreach($data as $key => $val){
                $data[$key]['start'] = date(DATE_ATOM,strtotime($val['start']));
                $data[$key]['end'] = date(DATE_ATOM,strtotime($val['end']));
                $data[$key]['color'] = '#a5dff8';
            }
        }
        return response()->json($data);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response    
     */
    public function store(Request $request)
    {
        //
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
