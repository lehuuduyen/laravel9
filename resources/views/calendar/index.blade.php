@extends('calendar.master')
@section('content')
    <div id='full_calendar_events'></div>

    <input type="hidden" name="user" id="user" value="{{ $user }}">
@endsection
