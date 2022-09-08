<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Fullcalender CRUD Events in Laravel</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    {{-- Scripts --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://unpkg.com/moment@2.19.1/min/moment.min.js"></script>
    <style>
        .fc-view {
            overflow-x: auto;
        }

        .fc-view>table {
            min-width: 100%;
        }

        .fc-time-grid .fc-slats {
            z-index: 4;
            pointer-events: none;
        }

        .fc-scroller.fc-time-grid-container {
            overflow: initial !important;
        }

        .fc-axis {
            position: sticky;
            left: 0;
            background: white;
        }
    </style>
</head>

<body>
    <div class="container mt-5" >
        <h2 class="h2 text-center mb-5 border-bottom pb-3">Laravel FullCalender CRUD Events Example</h2>
        <div id='full_calendar_events'></div>
    </div>

    <script>
        $(document).ready(function() {
            var SITEURL = "{{ url('/') }}";
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var calendarEl = document.getElementById('full_calendar_events');

            var calendar = $('#full_calendar_events').fullCalendar({
                editable: true,
                events: SITEURL + "/calendar-event",
                displayEventTime: true,
                defaultView: 'agendaWeek',


                // defaultView: 'resourceTimeGridFourDay',
                // datesAboveResources: true,
                // allDaySlot: false,
                // plugins: ['resourceTimeGrid'],
                // header: {
                //     left: 'prev,next',
                //     center: 'title',
                //     right: 'resourceTimeGridDay,resourceTimeGridFourDay'
                // },
                // views: {
                //     resourceTimeGridFourDay: {
                //         type: 'resourceTimeGrid',
                //         duration: {
                //             days: 4
                //         },
                //         buttonText: '4 days'
                //     }
                // },
                // resources: [{
                //         id: 'a',
                //         title: 'Room A'
                //     },
                //     {
                //         id: 'b',
                //         title: 'Room B'
                //     }
                // ],
                // events: 'https://fullcalendar.io/demo-events.json?with-resources=2',

                eventRender: function(event, element, view) {
                    if (event.allDay === 'true') {
                        event.allDay = true;
                    } else {
                        event.allDay = false;
                    }
                },
                selectable: true,
                selectHelper: true,
                select: function(event_start, event_end, allDay) {
                    var event_name = prompt('Event Name:');
                    if (event_name) {
                        console.log(event_start);
                        
                        var event_start = moment (event_start).format( "Y-MM-DD HH:mm:ss");
                        console.log(event_start);
                        
                        var event_end = moment (event_end).format("Y-MM-DD HH:mm:ss");
                        $.ajax({
                            url: SITEURL + "/calendar-crud-ajax",
                            data: {
                                event_name: event_name,
                                event_start: event_start,
                                event_end: event_end,
                                type: 'create'
                            },
                            type: "POST",
                            success: function(data) {
                                displayMessage("Event created.");
                                calendar.fullCalendar('renderEvent', {
                                    id: data.id,
                                    title: event_name,
                                    start: event_start,
                                    end: event_end,
                                    allDay: allDay
                                }, true);
                                calendar.fullCalendar('unselect');
                            }
                        });
                    }
                },
                eventDrop: function(event, delta) {
                    var event_start = $.fullCalendar.formatDate(event.start, "Y-MM-DD");
                    var event_end = $.fullCalendar.formatDate(event.end, "Y-MM-DD");
                    $.ajax({
                        url: SITEURL + '/calendar-crud-ajax',
                        data: {
                            title: event.event_name,
                            start: event_start,
                            end: event_end,
                            id: event.id,
                            type: 'edit'
                        },
                        type: "POST",
                        success: function(response) {
                            displayMessage("Event updated");
                        }
                    });
                },
                eventClick: function(event) {
                    var eventDelete = confirm("Are you sure?");
                    if (eventDelete) {
                        $.ajax({
                            type: "POST",
                            url: SITEURL + '/calendar-crud-ajax',
                            data: {
                                id: event.id,
                                type: 'delete'
                            },
                            success: function(response) {
                                calendar.fullCalendar('removeEvents', event.id);
                                displayMessage("Event removed");
                            }
                        });
                    }
                }
            });

        });

        function displayMessage(message) {
            toastr.success(message, 'Event');
        }
    </script>
</body>

</html>
