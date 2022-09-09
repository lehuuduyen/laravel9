@extends('home')

@section('title', 'List page')
@section('content-title', 'List page')
@section('css')
    <style>
        html,
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
            font-size: 14px;
        }

        #calendar {
            max-width: 1100px;
            margin: 40px auto;
        }
    </style>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@5.11.3/main.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@5.11.3/main.min.js"></script>

@endsection

@section('content')


    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div id='full_calendar_events'></div>

                    <input type="hidden" name="user" id="user" value="{{ $user }}">

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('javascript')
    <script>
        var SITEURL = "{{ url('/') }}";
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('full_calendar_events');
            var user = JSON.parse(document.getElementById('user').value);

            var calendar = new FullCalendar.Calendar(calendarEl, {
                allDaySlot: false,
                editable: true,

                initialView: 'resourceTimeGridFourDay',
                headerToolbar: {
                    left: 'prev,next',
                    center: 'title',
                    right: 'resourceTimeGridDay,resourceTimeGridFourDay'
                },
                views: {
                    resourceTimeGridFourDay: {
                        type: 'resourceTimeGrid',

                        buttonText: 'All days'
                    }
                },
                resources: user,
                events: {
                    url: SITEURL + "/calendar-event",
                },
                selectHelper: true,

                //hien thi hover https://fullcalendar.io/docs/date-clicking-selecting
                selectable: true,
                //ko dc dung lap
                selectOverlap: false,
                dateClick: function(info) {
                    const nextURL = SITEURL + "/calendar-event";
                    const nextTitle = 'My new page title';
                    const nextState = {
                        additionalInformation: 'Updated the URL with JS'
                    };
                    window.history.pushState(nextState, nextTitle, nextURL);


                },

                eventDrop: function(event, delta) {
                    alert(event.title + ' was moved ' + delta + ' days\n' +
                        '(should probably update your database)');
                },
                snapDuration: '00:15:00',
                locale: 'en-GB',

                slotLabelFormat: {
                    hour: 'numeric',
                    minute: '2-digit',
                    hour12: false
                }

            })
            calendar.render();

        });
    </script>
@endsection
