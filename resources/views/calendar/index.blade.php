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
                eventContent: function(arg) {
                    var event = arg.event;
                    var customHtml =
                        `<div class ="VoOe8c BvZth5" > 
                            <div class ="LuQ1Ve" > 
                                <div class ="HYN1Wg" > 
                                    <div class="Y-BcB3" > ${arg.timeText} </div>
                                    <div class="Wp8yiJ">${event.title}</div> 
                                </div>
                                <div class="+uhSCd" >Manucure</div> 
                            </div>
                        </div>`


                    return {
                        html: customHtml
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
                // selectMirror: true,
                slotDuration: '00:30',
                snapDuration: '00:05',
                timeZone: 'UTC',

                locale: 'en-GB',

                slotLabelFormat: {
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: false
                },

            })
            calendar.render();

        });
        document.addEventListener('mousemove', e => {
            mX = e.pageX;
            mY = e.pageY;

            let eleCursor = document.elementFromPoint(e.clientX, e.clientY);


            if ($(eleCursor).hasClass('fc-timegrid-slot')) {

                var cellWidth = $('th.fc-col-header-cell').width();
                var cellHeight = $(eleCursor).height();
                var distanceLeft = $(eleCursor).position().left;
                var distanceRight = distanceLeft + cellWidth
                var distanceLeftToCalendar = $('#duyen').offset().left; //second element distance from top
                
                var time = $(eleCursor).attr('data-time')
                time = time.split(":");
                time = time[0]+":"+time[1];
                if (mX >= distanceLeftToCalendar + distanceRight) {
                    $('.temp-cell').remove();

                    $(eleCursor).append(
                        `<div class="GvBFIk RNzZJP temp-cell" style="height:${cellHeight}px;width:${cellWidth}px;left:${distanceRight}px;"> ${time} </div>`
                    );
                } else {
                    $('.temp-cell').remove();

                    $(eleCursor).append(
                        `<div class="GvBFIk RNzZJP temp-cell" style="height:${cellHeight}px;width:${cellWidth}px;left:${distanceLeft}px;"> ${time} </div>`
                    );
                }



                $(eleCursor).children('td').each(function() {
                    $(eleCursor).hover(function() {
                        // $(eleCursor).html('<div class="current-time"></div>');
                        $(eleCursor).html('<div class="current-time">' + $(eleCursor).parent()
                            .parent()
                            .data('time').substring(0, 5) + '</div>');

                    }, function() {
                        $(eleCursor).html('');
                    });
                });
            } else {
                $('.temp-cell').remove();
            }

        }, {
            passive: true
        })

        $(document).on({
            mouseleave: function() {
                // $(this).children('.temp-cell').remove();

            }
        }, '.fc-timegrid-slot');
        // $(document).on({
        //     mouseenter: function(e) {
        // var cellWidth = $('th.fc-col-header-cell').width();
        // var cellHeight = $(this).height();

        //         var columnCount = $('th.fc-col-header-cell').children().length;

        // if (!$(this).html()) {
        //     $element = $('#duyen');
        //     mX = e.pageX;
        //     mY = e.pageY;
        //     console.log(mX);
        //     console.log(mY);

        //     var distance = calculateDistance($element, mX, mY);
        //     console.log(distance);

        //     // $(this).append(
        //     //         '<td class="temp-cell" style="background-color:#ffef8f;border:0px; height:' + (
        //     //             cellHeight - 1) +
        //     //         'px;width:' + (cellWidth + 1) + 'px"></td>');
        //     $(this).append(
        //         `<div class="GvBFIk RNzZJP temp-cell" style="height:${cellHeight}px;width:${cellWidth}px;left:${distance*2}px;"> 15:45 </div>`
        //     );


        // }
        // $(this).children('td').each(function() {
        //     $(this).hover(function() {
        //         // $(this).html('<div class="current-time"></div>');
        //         $(this).html('<div class="current-time">' + $(this).parent().parent()
        //             .data('time').substring(0, 5) + '</div>');

        //     }, function() {
        //         $(this).html('');
        //     });
        // });

        //     },

        //     mouseleave: function() {
        //         $(this).children('.temp-cell').remove();

        //     }
        // },'.fc-timegrid-slot-lane');

        function calculateDistance(elem, mouseX, mouseY) {
            return Math.floor(Math.sqrt(Math.pow(mouseX - (elem.offset().left + (elem.width() / 2)), 2) + Math.pow(
                mouseY - (elem.offset().top + (elem.height() / 2)), 2)));
        }
    </script>
@endsection
