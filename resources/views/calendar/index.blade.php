@extends('calendar.master')
@section('content_calendar')
    <div id='full_calendar_events'></div>

    <input type="hidden" name="user" id="user" value="{{ $user }}">
@endsection
