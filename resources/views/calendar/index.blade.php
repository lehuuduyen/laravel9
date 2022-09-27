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
        const buttons = document.querySelectorAll(".card-buttons button");
        const sections = document.querySelectorAll(".card-section");
        const card = document.querySelector(".card");

        const handleButtonClick = (e) => {
            const targetSection = e.target.getAttribute("data-section");
            const section = document.querySelector(targetSection);
            targetSection !== "#about" ?
                card.classList.add("is-active") :
                card.classList.remove("is-active");
            card.setAttribute("data-state", targetSection);
            sections.forEach((s) => s.classList.remove("is-active"));
            buttons.forEach((b) => b.classList.remove("is-active"));
            e.target.classList.add("is-active");
            section.classList.add("is-active");
        };

        buttons.forEach((btn) => {
            btn.addEventListener("click", handleButtonClick);
        });

        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('full_calendar_events');
            var user = JSON.parse(document.getElementById('user').value);

            var calendar = new FullCalendar.Calendar(calendarEl, {
                selectOverlap: false,
                editable: true,
                selectable: true,
                selectHelper: true,
                // selectMirror: true,
                slotDuration: '00:15',
                snapDuration: '00:05',
                timeZone: 'UTC',
                allDaySlot: false,
                locale: 'en-GB',
                slotLabelFormat: {
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: false
                },

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
                eventDrop: function(info, delta) {
                    var infoResources = info.event.getResources();
                    var staffId = infoResources[0]._resource.id;
                    var start = info.event.start.toISOString();
                    var end = (info.event.end == null) ? start : info.event.end.toISOString();

                    $.ajax({
                        url: SITEURL + '/calendar-crud-ajax',
                        data: {
                            'start': start,
                            'end': end,
                            'id': info.event.id,
                            'staff_id': staffId,
                            'type': 'edit'
                        },
                        type: "POST",
                        success: function(response) {
                            toastr.success(info.event.title, 'Updated Successfully')
                        }
                    });
                },
                eventResize: function(info, delta, revertFunc) {
                    var infoResources = info.event.getResources();
                    var staffId = infoResources[0]._resource.id;

                    var start = info.event.start.toISOString();
                    var end = (info.event.end == null) ? start : info.event.end.toISOString();

                    $.ajax({
                        url: SITEURL + '/calendar-crud-ajax',
                        data: {
                            'start': start,
                            'end': end,
                            'id': info.event.id,
                            'staff_id': staffId,
                            'type': 'edit'
                        },
                        type: "POST",
                        success: function(response) {
                            toastr.success(info.event.title, 'Updated Successfully')
                        }
                    });
                },
                eventContent: function(arg) {
                    var event = arg.event;

                    var customHtml =
                        `<div class ="VoOe8c BvZth5"  > 
                            <div class ="LuQ1Ve" > 
                                <div class ="HYN1Wg" > 
                                    <div class="Y-BcB3" id="time-${event.id}" > ${arg.timeText} </div>
                                    <div class="Wp8yiJ" id="title-${event.id}" >${event.title}</div> 
                                </div>
                                <div class="+uhSCd" >Manucure</div> 
                            </div>
                        </div>`


                    return {
                        html: customHtml
                    }
                },

                eventMouseEnter: function(arg, element, jsEvent, view) {

                    var event = arg.event;
                    var timeText = $('#time-' + event.id).html()

                    console.log("-------hover--------");
                    tooltip =
                        `<div class="fresha-partner-react-portal-wrapper"><div><div class="show __react_component_tooltip td0ce21d6-6176-472b-a49e-1328f0e25daf place-right type-light _3iFzxb Ww-ky8 MQJT9J R+efxS" id="event:booking:571612105" data-id="tooltip" style="left: 374px; top: 256px;">
                            <div class="TX48NX" data-qa="calendar-event-popover-571612105"><div class="_0TvLLS seceHd PFNv8o N32lJl" style="display: flex; flex-direction: row; flex-grow: 1; align-items: center;"><div class="Rmj0sK r8arb5" style="display: flex; flex-direction: row; flex-grow: 1; align-items: center;"><div class="KZUYM7" data-qa="row-button-image" style="align-self: flex-start;"><div class="Avatar_self__38e78c9c Avatar_shapeRound__38e78c9c Avatar_size64__38e78c9c Avatar_placeholder__38e78c9c"><div class="Avatar_content__38e78c9c"><span class="Icon_self__7a585911 Icon_size28__7a585911 Icon_colorBlue600__7a585911"><svg viewBox="0 0 20 21" xmlns="http://www.w3.org/2000/svg"><path d="M18.1442122 17.4191984c.0969062-.0626465.1793254-.1188398.2474255-.1673564-.1171291-1.9985543-1.4569865-3.806594-3.5322974-4.700818-.3043222-.1311284-.4447235-.4841308-.3135951-.7884529.1311284-.3043222.4841308-.4447235.788453-.3135951 2.6010538 1.1207596 4.2662422 3.4835669 4.2658017 6.089587-.000029.1713473-.0733151.3345071-.2013817.4483441-.3939269.3501573-1.1635676.8477028-2.3305401 1.3358481C15.1562347 20.1224806 12.805944 20.6 10 20.6c-2.80594396 0-5.1562346-.4775194-7.06807795-1.2772448-1.16697251-.4881453-1.93661322-.9856908-2.33054012-1.3358481-.12804953-.1138218-.20133401-.2769542-.20138166-.4482787-.0007247-2.6057181 1.66382498-4.9684572 4.26430371-6.0896035.30429517-.131191.65732646.0091376.78851746.3134328.131191.3042951-.00913765.6573264-.31343281.7885174-2.07483383.8945247-3.4141797 2.7025125-3.53105991 4.7008429.06810665.0485221.15053702.1047236.24745925.1673804.4168128.2694547.92893818.5412294 1.53921339.7965079C5.16104255 18.9544425 7.35402103 19.4 10 19.4c2.645979 0 4.8389575-.4455575 6.6049988-1.1842937.6102752-.2552785 1.1224006-.5270532 1.5392134-.7965079zM14.6 5.375c0 2.9460693-2.1494631 6.225-4.6 6.225-2.45053694 0-4.59999996-3.2789307-4.59999996-6.225C5.40000004 2.63878867 7.4468925.40000004 10 .40000004S14.6 2.63878867 14.6 5.375zm-1.2 0c0-2.09628023-1.5348295-3.77500004-3.4-3.77500004-1.8651705 0-3.40000004 1.67871981-3.40000004 3.77500004C6.59999996 7.73829076 8.344851 10.4 10 10.4c1.655149 0 3.4-2.66170924 3.4-5.025z"></path></svg></span></div></div></div><div class="KrH5mo" style="display: flex; flex-direction: column; flex-grow: 1;"><div class="_06rxAz" style="display: flex; flex-direction: row; flex-grow: 1;"><div class="fM7L52" style="display: flex; flex-direction: column; flex-grow: 1;"><p class="Text_self__32440045 Text_typeTypefaceTitle17__32440045 Text_colorGreyDark600__32440045 Text_clamp3__32440045" data-qa="row-button-primary">Walk-In</p><p class="Text_self__32440045 Text_typeTypefaceCaption15__32440045 Text_colorGreyDark400__32440045" data-qa="row-button-secondary"><p class="Text_self__32440045 Text_typeTypefaceCaption15__32440045 Text_colorGreyDark400__32440045"></p></p></div></div></div></div></div><div class="Ol4EMJ"><div class="_5inCaP"></div></div><div class="Content_self__76ab3680 Content_spaceY8__76ab3680 cssCore_padding16161616__33cdafe8 cssCore_flexColumn__33cdafe8"><div class="Content_self__76ab3680 cssCore_flexRow__33cdafe8"><div class="Content_self__76ab3680 Content_spaceY2__76ab3680 cssCore_flexColumn__33cdafe8 cssCore_flexGrow1__33cdafe8" data-qa="row-button-primary"><span><span class="Text_self__32440045 Text_typeTypefaceCaption15__32440045 Text_colorGreyDark400__32440045">${timeText}</span><span class="fNyHBS DfgYL+" style="color: rgb(3, 122, 255);">New</span></span><div class="Content_self__76ab3680 cssCore_flexColumn__33cdafe8 cssCore_flexGrow1__33cdafe8"><p class="Text_self__32440045 Text_typeTypefaceTitle17__32440045 Text_colorGreyDark600__32440045">Manicure &amp; Pedicure</p><p class="Text_self__32440045 Text_typeTypefaceCaption15__32440045 Text_colorGreyDark400__32440045">1h 15min with duyen le</p></div></div><div class="Content_self__76ab3680 cssCore_flexColumn__33cdafe8 cssCore_flexGrow1__33cdafe8 cssCore_flexAlignItemsFlexEnd__33cdafe8 cssCore_flexJustifyContentCenter__33cdafe8"><p class="Text_self__32440045 Text_typeTypefaceTitle17__32440045 Text_colorGreyDark600__32440045 Text_noWrap__32440045" data-qa="right-row-primary"><span data-qa="retail-price">₫45</span></p></div></div></div></div></div></div><style data-react-tooltip="true">.__react_component_tooltip {
  border-radius: 3px;
  display: inline-block;
  font-size: 13px;
  left: -999em;
  opacity: 0;
  padding: 8px 21px;
  position: fixed;
  pointer-events: none;
  transition: opacity 0.3s ease-out;
  top: -999em;
  visibility: hidden;
  z-index: 999;
}
.__react_component_tooltip.allow_hover, .__react_component_tooltip.allow_click {
  pointer-events: auto;
}
.__react_component_tooltip::before, .__react_component_tooltip::after {
  content: "";
  width: 0;
  height: 0;
  position: absolute;
}
.__react_component_tooltip.show {
  opacity: 0.9;
  margin-top: 0;
  margin-left: 0;
  visibility: visible;
}
.__react_component_tooltip.place-top::before {
  border-left: 10px solid transparent;
  border-right: 10px solid transparent;
  bottom: -8px;
  left: 50%;
  margin-left: -10px;
}
.__react_component_tooltip.place-bottom::before {
  border-left: 10px solid transparent;
  border-right: 10px solid transparent;
  top: -8px;
  left: 50%;
  margin-left: -10px;
}
.__react_component_tooltip.place-left::before {
  border-top: 6px solid transparent;
  border-bottom: 6px solid transparent;
  right: -8px;
  top: 50%;
  margin-top: -5px;
}
.__react_component_tooltip.place-right::before {
  border-top: 6px solid transparent;
  border-bottom: 6px solid transparent;
  left: -8px;
  top: 50%;
  margin-top: -5px;
}
.__react_component_tooltip .multi-line {
  display: block;
  padding: 2px 0;
  text-align: center;
}</style></div>`;
                    mX = arg.jsEvent.pageX;
                    mY = arg.jsEvent.pageY;

                    let eleCursor = document.elementFromPoint(arg.jsEvent.clientX, arg.jsEvent.clientY);
                    var cellWidth = $('th.fc-col-header-cell').width();
                    var distanceLeft = $(eleCursor).position().left;
                    var distanceRight = distanceLeft + cellWidth

                    if ($(eleCursor).hasClass('fc-timegrid-slot-lane') || $(eleCursor).hasClass(
                            'LuQ1Ve') || $(eleCursor).hasClass('+uhSCd') || $(eleCursor).hasClass(
                            'fc-event-resizer') || $(eleCursor).hasClass('fc-timegrid-event') || $(
                            eleCursor).hasClass('fc-event-main') || $(eleCursor).hasClass('VoOe8c')) {
                        var distanceLeftToCalendar = $('#duyen').offset().left;
                        $("body").append(tooltip);
                        $('.fresha-partner-react-portal-wrapper').fadeIn('500');
                        $('.fresha-partner-react-portal-wrapper').fadeTo('10', 1.9);
                        if (mX >= distanceLeftToCalendar + distanceRight) {
                            $('.__react_component_tooltip').css('top', mY);
                            $('.__react_component_tooltip').css('left', distanceRight);
                        } else {
                            $('.__react_component_tooltip').css('top', mY);
                            $('.__react_component_tooltip').css('left', distanceLeft);
                        }
                    }


                },
                eventMouseLeave: function(event) {
                    $('.fresha-partner-react-portal-wrapper').remove();

                },
                //hien thi hover https://fullcalendar.io/docs/date-clicking-selecting
                //ko dc dung lap
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
                    $('#duyen').load(nextURL);
                    document.title = nextTitle

                },



            })
            calendar.render();

        });

        document.addEventListener('mousemove', e => {
            mX = e.pageX;
            mY = e.pageY;

            let eleCursor = document.elementFromPoint(e.clientX, e.clientY);
            let col = $(".fc-day").length
            if ($(eleCursor).hasClass('fc-timegrid-slot-lane')) {

                var cellWidth = $('th.fc-col-header-cell').width();
                var cellHeight = $(eleCursor).height();
                var distanceLeft = $(eleCursor).position().left; // khoảng cách từ trái đên cột staff đầu tiên

                var distanceRight = distanceLeft + cellWidth

                var distanceLeftToCalendar = $('#duyen').offset().left; //second element distance from left
                // console.log(distanceLeftToCalendar);

                var time = $(eleCursor).attr('data-time')
                time = time.split(":");
                time = time[0] + ":" + time[1];
                for (i = 0; i <= col; i++) {
                    distanceRight = distanceLeft + (cellWidth * i) + 4
                    if (mX >= distanceLeftToCalendar + distanceRight && mX <= distanceLeftToCalendar +
                        distanceRight + cellWidth) {
                        $('.temp-cell').remove();

                        $(eleCursor).append(
                            `<div class="GvBFIk RNzZJP temp-cell" style="height:${cellHeight}px;width:${cellWidth}px;left:${distanceRight}px;"> ${time} </div>`
                        );
                    }
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
    </script>
@endsection
