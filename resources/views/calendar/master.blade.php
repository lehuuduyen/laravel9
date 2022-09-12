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

        .modal-dialog {
            width: 100%;
            max-width: none;
            height: 100%;
            margin: 0;
        }

        .modal-content {
            height: 100%;
            border: 0;
            border-radius: 0;
        }

        .modal-body {
            overflow-y: auto;
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
                <div class="col-12" id="duyen">
                    @yield('content_calendar')
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
                    let date = moment(info.dateStr).format('YYYY-MM-DD');
                    let hour = moment(info.dateStr).format('HH');
                    let minute = moment(info.dateStr).format('mm');
                    let startTime = (hour * 3600) + (minute * 60)

                    const nextURL = SITEURL +
                        `/calendar-detail?startDate=${date}&startTime=${startTime}&employeeId=${info.resource.id}`;
                    const nextTitle = 'My new page title';
                    const nextState = {
                        additionalInformation: 'Updated the URL with JS'
                    };
                    window.history.pushState({
                        urlPath: window.location.href
                    }, nextTitle, nextURL);
                    document.title = nextTitle

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
