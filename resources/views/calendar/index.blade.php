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
                        `<div class ="VoOe8c BvZth5" id="card-${event.id}" > 
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
                eventMouseEnter: function(arg, element, jsEvent, view) {
                    var event = arg.event;
                    console.log("-------hover--------");
                    tooltip =
                        '<div class="tooltiptopicevent" style="width:auto;height:auto;background:#feb811;position:absolute;z-index:10001;padding:10px 10px 10px 10px ;  line-height: 200%;">' +
                        'title: ' + ': ' + event.title + '</br>' + 'start: ' + ': ' + event.start + '</div>';
                    console.log("#card-"+event.id);

                    $("body").append(tooltip);
                    $("#card-"+event.id).mouseover(function(e) {
                        $(this).css('z-index', 10000);
                        $('.tooltiptopicevent').fadeIn('500');
                        $('.tooltiptopicevent').fadeTo('10', 1.9);
                    }).mousemove(function(e) {
                        $('.tooltiptopicevent').css('top', e.pageY + 10);
                        $('.tooltiptopicevent').css('left', e.pageX + 20);
                    });
                    var htmlRight =
                        `<div class="fresha-partner-react-portal-wrapper"><div><div class="__react_component_tooltip show t3ca56e8d-e00a-4504-9848-d954f7810af4 place-right type-light _3iFzxb Ww-ky8 MQJT9J R+efxS" id="event:booking:564954464" data-id="tooltip" style="left: 789px; top: 489px;"><style>
  	.t3ca56e8d-e00a-4504-9848-d954f7810af4 {
	    color: #222;
	    background: #fff;
	    border: 1px solid transparent;
  	}

  	.t3ca56e8d-e00a-4504-9848-d954f7810af4.place-top {
        margin-top: -10px;
    }
    .t3ca56e8d-e00a-4504-9848-d954f7810af4.place-top::before {
        border-top: 8px solid transparent;
    }
    .t3ca56e8d-e00a-4504-9848-d954f7810af4.place-top::after {
        border-left: 8px solid transparent;
        border-right: 8px solid transparent;
        bottom: -6px;
        left: 50%;
        margin-left: -8px;
        border-top-color: #fff;
        border-top-style: solid;
        border-top-width: 6px;
    }

    .t3ca56e8d-e00a-4504-9848-d954f7810af4.place-bottom {
        margin-top: 10px;
    }
    .t3ca56e8d-e00a-4504-9848-d954f7810af4.place-bottom::before {
        border-bottom: 8px solid transparent;
    }
    .t3ca56e8d-e00a-4504-9848-d954f7810af4.place-bottom::after {
        border-left: 8px solid transparent;
        border-right: 8px solid transparent;
        top: -6px;
        left: 50%;
        margin-left: -8px;
        border-bottom-color: #fff;
        border-bottom-style: solid;
        border-bottom-width: 6px;
    }

    .t3ca56e8d-e00a-4504-9848-d954f7810af4.place-left {
        margin-left: -10px;
    }
    .t3ca56e8d-e00a-4504-9848-d954f7810af4.place-left::before {
        border-left: 8px solid transparent;
    }
    .t3ca56e8d-e00a-4504-9848-d954f7810af4.place-left::after {
        border-top: 5px solid transparent;
        border-bottom: 5px solid transparent;
        right: -6px;
        top: 50%;
        margin-top: -4px;
        border-left-color: #fff;
        border-left-style: solid;
        border-left-width: 6px;
    }

    .t3ca56e8d-e00a-4504-9848-d954f7810af4.place-right {
        margin-left: 10px;
    }
    .t3ca56e8d-e00a-4504-9848-d954f7810af4.place-right::before {
        border-right: 8px solid transparent;
    }
    .t3ca56e8d-e00a-4504-9848-d954f7810af4.place-right::after {
        border-top: 5px solid transparent;
        border-bottom: 5px solid transparent;
        left: -6px;
        top: 50%;
        margin-top: -4px;
        border-right-color: #fff;
        border-right-style: solid;
        border-right-width: 6px;
    }
  </style>
  <div class="TX48NX" data-qa="calendar-event-popover-564954464"><div class="_0TvLLS seceHd PFNv8o N32lJl" style="display: flex; flex-direction: row; flex-grow: 1; align-items: center;"><div class="Rmj0sK r8arb5" style="display: flex; flex-direction: row; flex-grow: 1; align-items: center;"><div class="KZUYM7" data-qa="row-button-image" style="align-self: flex-start;"><div class="Avatar_self__38e78c9c Avatar_shapeRound__38e78c9c Avatar_size64__38e78c9c Avatar_placeholder__38e78c9c"><div class="Avatar_content__38e78c9c">J</div></div></div><div class="KrH5mo" style="display: flex; flex-direction: column; flex-grow: 1;"><div class="_06rxAz" style="display: flex; flex-direction: row; flex-grow: 1;"><div class="fM7L52" style="display: flex; flex-direction: column; flex-grow: 1;"><p class="Text_self__32440045 Text_typeTypefaceTitle17__32440045 Text_colorGreyDark600__32440045 Text_clamp3__32440045" data-qa="row-button-primary">Jane Doe</p><p class="Text_self__32440045 Text_typeTypefaceCaption15__32440045 Text_colorGreyDark400__32440045" data-qa="row-button-secondary"><p class="Text_self__32440045 Text_typeTypefaceCaption15__32440045 Text_colorGreyDark400__32440045">jane@example.com</p></p></div></div></div></div></div><div class="Content_self__76ab3680 NnI-5+ cssCore_flexRow__33cdafe8 cssCore_flexGrow1__33cdafe8" data-qa="customer-badges"><div class="BadgeContainer_self__bcb321f0 BadgeContainer_margin4__bcb321f0" data-qa="customer-badges-container"><span class="Text_self__32440045 Text_typeTypefaceBadge13__32440045 Text_noWrap__32440045 Badge_self__a0fb2f98 Badge_variantDefault__a0fb2f98 Badge_colorBlue__a0fb2f98" data-qa="badge-new_customer"><div class="Content_self__76ab3680 CgNE3E Content_spaceX8__76ab3680 cssCore_flexRow__33cdafe8"><span class="TextEllipsis_self__862cb03d">New Client</span></div></span></div></div><div class="Ol4EMJ"><div class="_5inCaP"></div></div><div class="Content_self__76ab3680 Content_spaceY8__76ab3680 cssCore_padding16161616__33cdafe8 cssCore_flexColumn__33cdafe8"><div class="Content_self__76ab3680 cssCore_flexRow__33cdafe8"><div class="Content_self__76ab3680 Content_spaceY2__76ab3680 cssCore_flexColumn__33cdafe8 cssCore_flexGrow1__33cdafe8" data-qa="row-button-primary"><span><span class="Text_self__32440045 Text_typeTypefaceCaption15__32440045 Text_colorGreyDark400__32440045">13:25 - 14:40</span><span class="fNyHBS DfgYL+" style="color: rgb(0, 163, 109);">Started</span></span><div class="Content_self__76ab3680 cssCore_flexColumn__33cdafe8 cssCore_flexGrow1__33cdafe8"><p class="Text_self__32440045 Text_typeTypefaceTitle17__32440045 Text_colorGreyDark600__32440045">Pédicure</p><p class="Text_self__32440045 Text_typeTypefaceCaption15__32440045 Text_colorGreyDark400__32440045">1h 15min with duyen le</p></div></div><div class="Content_self__76ab3680 cssCore_flexColumn__33cdafe8 cssCore_flexGrow1__33cdafe8 cssCore_flexAlignItemsFlexEnd__33cdafe8 cssCore_flexJustifyContentCenter__33cdafe8"><p class="Text_self__32440045 Text_typeTypefaceTitle17__32440045 Text_colorGreyDark600__32440045 Text_noWrap__32440045" data-qa="right-row-primary"><span data-qa="retail-price">₫27</span></p></div></div></div></div></div></div>
  <style data-react-tooltip="true">.__react_component_tooltip {
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
                    // $('body').append(htmlRight)

                },
                eventMouseLeave: function(event) {
                    console.log(event);

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



            })
            calendar.render();

        });
        document.addEventListener('mousemove', e => {
            mX = e.pageX;
            mY = e.pageY;

            let eleCursor = document.elementFromPoint(e.clientX, e.clientY);


            if ($(eleCursor).hasClass('fc-timegrid-slot-lane')) {

                var cellWidth = $('th.fc-col-header-cell').width();
                var cellHeight = $(eleCursor).height();
                var distanceLeft = $(eleCursor).position().left;
                var distanceRight = distanceLeft + cellWidth
                var distanceLeftToCalendar = $('#duyen').offset().left; //second element distance from top

                var time = $(eleCursor).attr('data-time')
                time = time.split(":");
                time = time[0] + ":" + time[1];
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
    </script>
@endsection
