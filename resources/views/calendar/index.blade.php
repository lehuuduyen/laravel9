@extends('calendar.master')
@section('content_calendar')
    <div id='full_calendar_events'></div>
    <input type="hidden" name="user" id="user" value="{{ $user }}">
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
                    url: SITEURL + "/api/calendar",
                },
                dayRender: function(date, cell) {
                    alert(1)
                    if (moment(date).format('x') < moment().subtract(1, 'days').format('x')) {
                        $(cell).addClass('disabled');
                    }
                },
                //hien thi hover https://fullcalendar.io/docs/date-clicking-selecting
                //ko dc dung lap
                // dateClick: function(info) {
                //     let date = moment(info.dateStr).format('YYYY-MM-DD');
                //     let hour = moment(info.dateStr).format('HH');
                //     let minute = moment(info.dateStr).format('mm');
                //     let startTime = (hour * 3600) + (minute * 60)

                //     const nextURL = SITEURL +
                //         `/calendar-detail?startDate=${date}&startTime=${startTime}&employeeId=${info.resource.id}`;
                //     const nextTitle = 'My new page title';
                //     const nextState = {
                //         additionalInformation: 'Updated the URL with JS'
                //     };
                //     window.history.pushState({
                //         urlPath: window.location.href
                //     }, nextTitle, nextURL);
                //     $('#duyen').load(nextURL);
                //     document.title = nextTitle

                // },

                selectOverlap: false,
                editable: true,
                selectable: true,
                selectHelper: true,
                selectMirror: true,
                slotDuration: '00:30',
                snapDuration: '00:05',
                timeZone: 'UTC',

                locale: 'en-GB',

                slotLabelFormat: {
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: false
                }

            })
            calendar.render();

        });
        // $(document).on({
        //     mouseenter: function() {
        //         //stuff to do on mouse enter
        //         console.log($(this).html());

        //         if (!$(this).html()) {
        //             for (i = 0; i < 7; i++) {
        //                 $(this).append('<td class="temp_cell" style="background-color:#ffef8f;border: 0px; width:' + (Number($('.fc-day')
        //                     .width()) + 2) + 'px">ssssssssssss</td>');
        //             }

        //             // $(this).children('td').each(function() {
        //             //     $(this).hover(function() {
        //             //         $(this).css({
        //             //             'background-color': '#ffef8f',
        //             //             'cursor': 'pointer'
        //             //         });
        //             //     }, function() {
        //             //         $(this).prop('style').removeProperty('background-color');
        //             //     });
        //             // });
        //         }
        //     },
        //     mouseleave: function() {
        //         // $(this).children('.temp_cell').remove();

        //     }
        // }, ".fc-timegrid-slot-lane");
    </script>
@endsection
