@extends('calendar.master')



@section('javascript')
    <script src="{{ asset('/adminlte/plugins/select2/js/select2.min.js') }}"></script>

    <script>
        function findGetParameter(parameterName) {
            var result = null,
                tmp = [];
            location.search
                .substr(1)
                .split("&")
                .forEach(function(item) {
                    tmp = item.split("=");
                    if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
                });
            return result;
        }

        function setView2(startTime = 0) {
            let html = `<div class="YgIysy" style="transform-origin: center top;">
                            <div class="fgulPZ -l3rLl +J3zJ1 +MhXeZ"
                                style="display: flex; flex-flow: row wrap;">
                                <div
                                    class="Field_self__b22a9f75 Field_padding__b22a9f75 cssGrid_colspan12__436c4c8b Jj5n6Z">
                                    <div class="Field_top__b22a9f75"><label
                                            class="Label_self__97ecaa1e"
                                            data-qa="start-label">Start Time</label></div>
                                    <div
                                        class="Select_self__eeee3dfd Select_sizeDefault__eeee3dfd">
                                        <select class="Select_select__eeee3dfd"
                                            name="start">`
            for ($i = 0; $i <= 86100; $i = $i + 300) {
                selected = "";

                if ($i == startTime) {
                    selected = "selected";
                }
                html +=
                    `<option ${selected} value="${$i}">${moment("00:00", "hh:mm H").add($i, 'seconds').format('HH:mm')}</option>`

            }

            html += `                                
                                        </select><span
                                            class="Icon_self__7a585911 Icon_size16__7a585911 Select_suffix__eeee3dfd Select_suffixIcon__eeee3dfd"><svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M12 14.481l6.247-7.14a1 1 0 011.506 1.318l-7 8a1 1 0 01-1.506 0l-7-8a1 1 0 111.506-1.317L12 14.482z">
                                                </path>
                                            </svg></span>
                                    </div>
                                </div>
                                <div class="UjyuCR pzB7+h">
                                    <div class="Field_self__b22a9f75 Field_padding__b22a9f75 cssGrid_colspan12__436c4c8b pAfbFK"
                                        data-qa="service-input">
                                        <div class="Field_top__b22a9f75"><label
                                                class="Label_self__97ecaa1e"
                                                data-qa="label-name">Service</label></div>
                                        <div class="Input_self__03800786 Input_sizeDefault__03800786 Input_inlineSuffix__03800786 Input_readOnly__03800786">
                                            <input autocomplete="off"
                                                class="Input_input__03800786 Input_readOnly__03800786 sLSoAL"
                                                data-qa="selected-service" name="bookedItem"
                                                placeholder="Choose a service" value=""
                                                readonly="">
                                            <div class="Input_suffix__03800786 APXB8m"><span
                                                    class="Icon_self__7a585911 Icon_size16__7a585911"><svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 24 24">
                                                        <path
                                                            d="M12 14.481l6.247-7.14a1 1 0 011.506 1.318l-7 8a1 1 0 01-1.506 0l-7-8a1 1 0 111.506-1.317L12 14.482z">
                                                        </path>
                                                    </svg></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>`
            $("#view-item").append(html)

            $('.select2').select2()
        }

        function getViewService(_element) {
            var rect = _element.getBoundingClientRect();
            var width = _element.clientWidth
            var height = _element.clientHeight
            var left = rect.left
            var top = rect.top + height +10
           
            let services = JSON.parse(localStorage.getItem('sta'))['service'];
            var html = ``;
            $.each(services, function(key, val) {
                html += `<div class="_1Z5s3b" id="1917698">
                            <p class="Text_self__32440045 Text_typeTypefaceTitle20__32440045 Text_colorGreyDark600__32440045 GWrsvp"
                                data-qa="nails">${val.name}</p>
                            <ul class="BvzVBL yyapjb">
                                <div class="JlRnJN xgR9V2" style="background-color: rgb(165, 223, 248);"></div>
                            `
                $.each(val.category_child, function(keyChild, valChild) {
                    html += `<div class="_0TvLLS p8KH04" data-qa="spl-result-item-manucure"
                                    style="display: flex; flex-direction: row; flex-grow: 1; align-items: center;">
                                    <div class="Rmj0sK"
                                        style="display: flex; flex-direction: row; flex-grow: 1; align-items: center;">
                                        <div class="KrH5mo" style="display: flex; flex-direction: column; flex-grow: 1;">
                                            <div class="_06rxAz"
                                                style="display: flex; flex-direction: row; flex-grow: 1;">
                                                <div class="fM7L52"
                                                    style="display: flex; flex-direction: column; flex-grow: 1;">
                                                    <div>
                                                        <p class="Text_self__32440045 Text_typeTypefaceTitle17__32440045"
                                                            data-qa="item-name">${valChild.name}</p>
                                                    </div>
                                                    <div>${valChild.duration}</div>
                                                </div>
                                                <div class="P5mq63"
                                                    style="display: flex; flex-direction: column; flex-shrink: 0; flex-grow: 1; justify-content: center;">
                                                    
                                                    <p
                                                        class="Text_self__32440045 Text_typeTypefaceTitle17__32440045 Text_colorGreyDark600__32440045">
                                                        <span data-qa="item-retail-price">₫${valChild.price}</span></p>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>`
                })


                html += `</ul>
                        </div>`;

                
            })
            $(".jbOD0b").css('left',left)
            $(".jbOD0b").css('top',top)
            $(".jbOD0b").css('width',width)
            $('.UjyuCR').append(`<div><div class="DP71MP p8KH04 x9kGst" data-qa="overlay"></div></div>`)
            $(".fresha-partner-react-portal-wrapper").css('display','block')
            
            $("#list-service").html(html)
        }
        //click input all service
        $(document).on('click','.sLSoAL',function(e){
            
            getViewService(this)
        })
        function getUser() {
            $.ajax({
                type: 'GET',
                url: 'api/staff_service',
                success: function(msg) {
                    localStorage.setItem('sta', JSON.stringify(msg));
                }
            });
        }
        getUser()
        setView2()
    </script>
@endsection
@section('content_calendar')
    <div class="modal fade modal-fullscreen show" style="display: block;" id="exampleModal" tabindex="-1"
        aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="w-100 text-center font-weight-bold">
                        <h2 class="modal-title" id="exampleModalLabel">New Appointment</h2>

                    </div>
                    <button type="button" class="close" onclick="history.back(-1);$('#duyen').load('/calendar-event');"
                        data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="mOWLIO">
                        <div class="aZH33U" style="display: flex; flex-direction: column;">
                            <div class="SzmcJt" style="display: flex; flex-direction: column; flex-grow: 1;">
                                <div class="fgulPZ hEFhKo hANl13 ABtpP+ t7dPP7"
                                    style="display: flex; flex-direction: column; flex-shrink: 1; flex-grow: 0;">
                                    <div class="JLuAjZ" style="flex-shrink: 0; flex-grow: 0;">
                                        <form novalidate="" data-qa="form-">
                                            <div class="nz9VBK" data-qa="customer-input"
                                                style="display: flex; flex-direction: row; align-items: center;">
                                                <div
                                                    class="Field_self__b22a9f75 Field_padding__b22a9f75 cssGrid_colspan12__436c4c8b SearchField_self__57707add ZH+XyV">
                                                    <div
                                                        class="Input_self__03800786 Input_sizeDefault__03800786 Input_inlinePrefix__03800786 Input_inlineSuffix__03800786 SearchField_widget__57707add">
                                                        <div class="Input_prefix__03800786"><span
                                                                class="Icon_self__7a585911 Icon_size24__7a585911"><svg
                                                                    viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M23.78 22.722l-4.328-4.328c1.073-1.307 1.72-2.983 1.72-4.808C21.17 9.398 17.77 6 13.585 6 9.395 6 6 9.398 6 13.586c0 4.187 3.394 7.585 7.586 7.585 1.825 0 3.497-.64 4.805-1.712l4.33 4.324c.294.294.768.294 1.06 0 .295-.29.295-.767 0-1.057zm-10.194-3.06c-3.354 0-6.08-2.726-6.08-6.076 0-3.35 2.726-6.08 6.08-6.08 3.35 0 6.08 2.73 6.08 6.08s-2.73 6.076-6.08 6.076z">
                                                                    </path>
                                                                </svg></span></div><input
                                                            class="Input_input__03800786 SearchField_input__57707add"
                                                            input="[object Object]" meta="[object Object]"
                                                            placeholder="Search client" grow="1" name="searchString"
                                                            value="">
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="TZ-mYB"
                                    style="display: flex; flex-direction: column; flex-shrink: 1; flex-grow: 1;">
                                    <div class="KqAzWh"
                                        style="display: flex; flex-direction: column; flex-shrink: 1; flex-grow: 1;">
                                        <div class="Placeholder_self__c17797c9" data-qa="placeholder-container">
                                            <div class="Placeholder_content__c17797c9"><span
                                                    class="Icon_self__7a585911 Icon_size56__7a585911 Icon_colorGreyDark600__7a585911 Placeholder_icon__c17797c9"
                                                    data-qa="placeholder-icon"><svg xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 64 64">
                                                        <g fill="none" fill-rule="evenodd">
                                                            <circle fill="#FBD74C" cx="28.5" cy="23.5"
                                                                r="9.5"></circle>
                                                            <path
                                                                d="M28.5 4C42.031 4 53 14.969 53 28.5a24.413 24.413 0 01-6.508 16.63c.041.022.082.05.12.08l.095.083 14 14a1 1 0 01-1.32 1.497l-.094-.083-14-14a1 1 0 01-.164-.216A24.404 24.404 0 0128.5 53C14.969 53 4 42.031 4 28.5S14.969 4 28.5 4zm0 2C16.074 6 6 16.074 6 28.5S16.074 51 28.5 51 51 40.926 51 28.5 40.926 6 28.5 6zM28 32c3.856 0 7.096.928 9.689 2.392 1.362.77 2.226 2.143 2.305 3.66l.006.229V40a1 1 0 01-.883.993L39 41H17a1 1 0 01-.993-.883L16 40v-1.739c0-1.599.871-3.067 2.29-3.877C20.856 32.924 24.095 32 28 32zm0 2c-3.545 0-6.446.827-8.719 2.122-.748.426-1.216 1.16-1.275 1.966L18 38.26V39h20v-.72c0-.76-.364-1.472-.989-1.945l-.148-.105-.158-.097C34.401 34.832 31.495 34 28 34zm.5-17a6.5 6.5 0 110 13 6.5 6.5 0 010-13zm0 2a4.5 4.5 0 100 9 4.5 4.5 0 000-9z"
                                                                fill="#101928" fill-rule="nonzero"></path>
                                                        </g>
                                                    </svg></span>
                                                <p class="Text_self__32440045 Text_typeTypefaceParagraph17__32440045 Placeholder_text__c17797c9"
                                                    data-qa="placeholder-body">Use the search to add a client, or keep
                                                    empty to save as walk-in.</p>
                                            </div>
                                            <div class="Placeholder_children__c17797c9"></div>
                                        </div>
                                        <div style="flex-grow: 1;"></div>
                                        <div class="_7p6omb">
                                            <div>
                                                <div class="UQ5Ndy">
                                                    <p class="Text_self__32440045 Text_typeTypefaceTitle17__32440045 Text_colorGreyDark600__32440045"
                                                        data-qa="appointment-total">Total: <span>Free</span> (0min)</p>
                                                </div>
                                                <div style="display: flex; flex-direction: row;"><button
                                                        class="Button_self__0869cc83 Button_sizeDefault__0869cc83 Button_variantSecondary__0869cc83 Button_dynamicIconColor__0869cc83 Button_disabled__0869cc83 AqbXaR"
                                                        data-qa="express-checkout-button" disabled="">
                                                        <div class="Button_visualLayer__0869cc83"></div>
                                                        <div class="Button_buttonBox__0869cc83">
                                                            <p
                                                                class="Text_self__32440045 Text_typeTypefaceTitle17__32440045 Button_buttonLabel__0869cc83">
                                                                Express checkout</p>
                                                        </div>
                                                    </button><button
                                                        class="Button_self__0869cc83 Button_sizeDefault__0869cc83 Button_variantPrimary__0869cc83 Button_dynamicIconColor__0869cc83 yh1vpz Action_hasAction__0901d2f4"
                                                        data-qa="save-appointment-button">
                                                        <div class="Button_visualLayer__0869cc83"></div>
                                                        <div class="Button_buttonBox__0869cc83">
                                                            <p
                                                                class="Text_self__32440045 Text_typeTypefaceTitle17__32440045 Button_buttonLabel__0869cc83">
                                                                Save appointment</p>
                                                        </div>
                                                    </button></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="_3CfJJ-" style="flex-grow: 1;">
                            <div class="kXP7ZQ ODyGda" style="display: flex; flex-direction: column;">
                                <form novalidate="" data-qa="form-appointment-form">
                                    <div currencycode="VND" allcustomerpaidplans="" items="[object Object]">
                                        <div class="fgulPZ ieJ9WX O3kzCg ABtpP+"
                                            style="display: flex; flex-direction: column;">
                                            <div class="YgIysy"
                                                style="display: flex; flex-direction: row; justify-content: space-between; align-items: center;">
                                                <div class="wyvXUg p8KH04" data-qa="date-dropdown">
                                                    <div
                                                        class="Content_self__76ab3680 Content_spaceX16__76ab3680 cssCore_flexRow__33cdafe8 cssCore_flexAlignItemsCenter__33cdafe8">
                                                        <p
                                                            class="Text_self__32440045 Text_typeTypefaceTitle20__32440045 Text_noWrap__32440045">
                                                            Wednesday, 7 Sep 2022</p><span
                                                            class="Icon_self__7a585911 Icon_size12__7a585911 Icon_colorGreyDark600__7a585911"><svg
                                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 11 6">
                                                                <path
                                                                    d="M5.5 4.793L10.146.146a.5.5 0 1 1 .708.708l-5 5a.5.5 0 0 1-.708 0l-5-5A.5.5 0 1 1 .854.146L5.5 4.793z"
                                                                    fill-rule="nonzero"></path>
                                                            </svg></span>
                                                    </div>
                                                </div>
                                                <div style="display: flex; flex-direction: row; align-items: center;"><a
                                                        class="wyvXUg p8KH04 jX3mzZ " data-qa="repeat-button">
                                                        
                                                            <div
                                                                class="Content_self__76ab3680 Content_spaceX8__76ab3680 cssCore_flexRow__33cdafe8 cssCore_flexAlignItemsCenter__33cdafe8">
                                                                <span
                                                                    class="Icon_self__7a585911 Icon_size12__7a585911 Icon_colorBlue600__7a585911"><svg
                                                                        version="1.1" id="Capa_1"
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                        x="0px" y="0px"
                                                                        viewBox="0 0 438.529 438.528"
                                                                        style="enable-background:new 0 0 438.529 438.528;"
                                                                        xml:space="preserve">
                                                                        <path
                                                                            d="M433.109,23.694c-3.614-3.612-7.898-5.424-12.848-5.424c-4.948,0-9.226,1.812-12.847,5.424l-37.113,36.835 c-20.365-19.226-43.684-34.123-69.948-44.684C274.091,5.283,247.056,0.003,219.266,0.003c-52.344,0-98.022,15.843-137.042,47.536 C43.203,79.228,17.509,120.574,5.137,171.587v1.997c0,2.474,0.903,4.617,2.712,6.423c1.809,1.809,3.949,2.712,6.423,2.712h56.814 c4.189,0,7.042-2.19,8.566-6.565c7.993-19.032,13.035-30.166,15.131-33.403c13.322-21.698,31.023-38.734,53.103-51.106 c22.082-12.371,45.873-18.559,71.376-18.559c38.261,0,71.473,13.039,99.645,39.115l-39.406,39.397 c-3.607,3.617-5.421,7.902-5.421,12.851c0,4.948,1.813,9.231,5.421,12.847c3.621,3.617,7.905,5.424,12.854,5.424h127.906 c4.949,0,9.233-1.807,12.848-5.424c3.613-3.616,5.42-7.898,5.42-12.847V36.542C438.529,31.593,436.733,27.312,433.109,23.694z">
                                                                        </path>
                                                                        <path
                                                                            d="M422.253,255.813h-54.816c-4.188,0-7.043,2.187-8.562,6.566c-7.99,19.034-13.038,30.163-15.129,33.4 c-13.326,21.693-31.028,38.735-53.102,51.106c-22.083,12.375-45.874,18.556-71.378,18.556c-18.461,0-36.259-3.423-53.387-10.273 c-17.13-6.858-32.454-16.567-45.966-29.13l39.115-39.112c3.615-3.613,5.424-7.901,5.424-12.847c0-4.948-1.809-9.236-5.424-12.847 c-3.617-3.62-7.898-5.431-12.847-5.431H18.274c-4.952,0-9.235,1.811-12.851,5.431C1.807,264.844,0,269.132,0,274.08v127.907 c0,4.945,1.807,9.232,5.424,12.847c3.619,3.61,7.902,5.428,12.851,5.428c4.948,0,9.229-1.817,12.847-5.428l36.829-36.833 c20.367,19.41,43.542,34.355,69.523,44.823c25.981,10.472,52.866,15.701,80.653,15.701c52.155,0,97.643-15.845,136.471-47.534 c38.828-31.688,64.333-73.042,76.52-124.05c0.191-0.38,0.281-1.047,0.281-1.995c0-2.478-0.907-4.612-2.715-6.427 C426.874,256.72,424.731,255.813,422.253,255.813z">
                                                                        </path>
                                                                    </svg></span>
                                                                <p
                                                                    class="Text_self__32440045 Text_typeTypefaceParagraph17__32440045">
                                                                    Repeat</p>
                                                            </div>
                                                        </p>
                                                    </a></div>
                                            </div>
                                        </div>
                                        <div>








                                            <div class="o5xhhv" data-qa="service-list">
                                                <div class="OCRPjL kHR-+9"></div>
                                                <div class="OCRPjL IFX6O1"></div>
                                                <div id="view-item" style="position: relative;">

                                                    <div data-qa="appointment-item-section">
                                                        <div class="kmKtqs" currencycode="VND">
                                                            <div class="YgIysy">
                                                                <div class="OCRPjL"></div>
                                                                <div class="Ugknc6">1</div>
                                                                <div class="fgulPZ -l3rLl -v8jU+"
                                                                    data-qa="appointment-item-card"
                                                                    style="display: flex; flex-flow: row wrap; align-items: flex-start;">
                                                                    <div role="button" class="Ne3Sw- ccozoh p8KH04"
                                                                        data-qa="delete-appointment-item-action-icon">
                                                                        <div class="WTZV0a">
                                                                            <div><span
                                                                                    class="Icon_self__7a585911 Icon_size12__7a585911 Icon_colorRed400__7a585911"><svg
                                                                                        viewBox="0 0 18 18"
                                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                                        <path
                                                                                            d="M17 1.914L16.086 1 9 8.086 1.914 1 1 1.914 8.086 9 1 16.086l.914.914L9 9.914 16.086 17l.914-.914L9.914 9z">
                                                                                        </path>
                                                                                    </svg></span></div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="UjyuCR pzB7+h"
                                                                        data-qa="add-new-service-select-btn">
                                                                        <div class="Field_self__b22a9f75 Field_padding__b22a9f75 cssGrid_colspan12__436c4c8b pAfbFK"
                                                                            data-qa="service-input">
                                                                            <div class="Field_top__b22a9f75"><label
                                                                                    class="Label_self__97ecaa1e"
                                                                                    data-qa="label-name">Service</label>
                                                                            </div>
                                                                            <div
                                                                                class="Input_self__03800786 Input_sizeDefault__03800786 Input_inlineSuffix__03800786 Input_readOnly__03800786">
                                                                                <input autocomplete="off"
                                                                                    class="Input_input__03800786 Input_readOnly__03800786 sLSoAL"
                                                                                    data-qa="selected-service"
                                                                                    name="items[0].bookedItem"
                                                                                    placeholder="Choose a service"
                                                                                    warning="duyen le has another booking at 11:00, but your team member can still double-book appointments for them."
                                                                                    value="Manucure (45min, ₫25)"
                                                                                    readonly="">
                                                                                <div class="Input_suffix__03800786 APXB8m">
                                                                                    <span
                                                                                        class="Icon_self__7a585911 Icon_size16__7a585911"><svg
                                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                                            viewBox="0 0 24 24">
                                                                                            <path
                                                                                                d="M12 14.481l6.247-7.14a1 1 0 011.506 1.318l-7 8a1 1 0 01-1.506 0l-7-8a1 1 0 111.506-1.317L12 14.482z">
                                                                                            </path>
                                                                                        </svg></span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="Field_helperText__b22a9f75"
                                                                                data-qa="input-hint">duyen le has another
                                                                                booking at 11:00, but your team member can
                                                                                still double-book appointments for them.
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div
                                                                        class="Field_self__b22a9f75 Field_padding__b22a9f75 cssGrid_colspan12__436c4c8b k3qwoY z+xzBx">
                                                                        <div class="Field_top__b22a9f75"><label
                                                                                class="Label_self__97ecaa1e"
                                                                                data-qa="items[0].employee-label">Team
                                                                                member</label></div>
                                                                        <div
                                                                            class="Select_self__eeee3dfd Select_sizeDefault__eeee3dfd Select_inlinePrefix__eeee3dfd">
                                                                            <div class="Select_prefix__eeee3dfd">
                                                                                <div
                                                                                    style="display: flex; flex-direction: row; flex-grow: 1; justify-content: center; align-items: center; margin-left: 6px;">
                                                                                    <label class="RMq13K J9Mqmu M0ZaF2"
                                                                                        data-qa="items[0].employeeIsRequested-label"><input
                                                                                            class="fuKGX4" type="checkbox"
                                                                                            name="items[0].employeeIsRequested"
                                                                                            value="false">
                                                                                        <div role="button" class="Ne3Sw-"
                                                                                            data-qa="action-icon">
                                                                                            <div class="WTZV0a">
                                                                                                <div><span
                                                                                                        class="Icon_self__7a585911 Icon_size20__7a585911 Icon_colorGreyDark400__7a585911"><svg
                                                                                                            viewBox="0.75 0.75 20.25 17.25"
                                                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                                                            <path
                                                                                                                d="M19.2727 2.4258C18.2233 1.4063 16.8282.8453 15.344.8453c-1.4844 0-2.8796.561-3.9293 1.5805l-.5172.5024-.5171-.5024C9.331 1.4063 7.9355.8453 6.4515.8453s-2.8796.561-3.929 1.5805c-2.1665 2.1048-2.1665 5.5295 0 7.6336l7.7633 7.5416a.8549.8549 0 0 0 .45.2287.8843.8843 0 0 0 .1668.0156c.2197 0 .4396-.0814.6069-.2443l7.7632-7.5416c2.1666-2.104 2.1666-5.5288 0-7.6336zM18.059 8.8804l-7.1613 6.9569-7.1615-6.957C2.239 7.4262 2.239 5.06 3.7362 3.605c.7253-.7045 1.6899-1.092 2.7153-1.092 1.0255 0 1.9899.3875 2.7148 1.092l1.1245 1.0927c.3223.3126.8918.3126 1.214 0l1.124-1.0927c.725-.7045 1.6895-1.092 2.7153-1.092 1.0256 0 1.9898.3875 2.7149 1.092 1.4973 1.455 1.4973 3.8211 0 5.2755z">
                                                                                                            </path>
                                                                                                        </svg></span></div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </label>
                                                                                </div>
                                                                            </div><select
                                                                                class="Select_select__eeee3dfd HpmIxr"
                                                                                name="items[0].employee">
                                                                                <option value="2004472">duyen le</option>
                                                                                <option value="2004480">Wendy Smith
                                                                                </option>
                                                                            </select><span
                                                                                class="Icon_self__7a585911 Icon_size16__7a585911 Select_suffix__eeee3dfd Select_suffixIcon__eeee3dfd"><svg
                                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                                    viewBox="0 0 24 24">
                                                                                    <path
                                                                                        d="M12 14.481l6.247-7.14a1 1 0 011.506 1.318l-7 8a1 1 0 01-1.506 0l-7-8a1 1 0 111.506-1.317L12 14.482z">
                                                                                    </path>
                                                                                </svg></span>
                                                                        </div>
                                                                    </div>
                                                                    <div
                                                                        class="Field_self__b22a9f75 Field_padding__b22a9f75 cssGrid_colspan12__436c4c8b Jj5n6Z">
                                                                        <div class="Field_top__b22a9f75"><label
                                                                                class="Label_self__97ecaa1e"
                                                                                data-qa="items[0].start-label">Start
                                                                                time</label></div>
                                                                        <div
                                                                            class="Select_self__eeee3dfd Select_sizeDefault__eeee3dfd">
                                                                            <select class="Select_select__eeee3dfd"
                                                                                name="items[0].start">
                                                                                <option value="0">00:00</option>
                                                                                <option value="300">00:05</option>
                                                                                <option value="600">00:10</option>
                                                                                <option value="900">00:15</option>
                                                                                <option value="1200">00:20</option>
                                                                                <option value="1500">00:25</option>
                                                                                <option value="1800">00:30</option>
                                                                                <option value="2100">00:35</option>
                                                                                <option value="2400">00:40</option>
                                                                                <option value="2700">00:45</option>
                                                                                <option value="3000">00:50</option>
                                                                                <option value="3300">00:55</option>
                                                                                <option value="3600">01:00</option>
                                                                                <option value="3900">01:05</option>
                                                                                <option value="4200">01:10</option>
                                                                                <option value="4500">01:15</option>
                                                                                <option value="4800">01:20</option>
                                                                                <option value="5100">01:25</option>
                                                                                <option value="5400">01:30</option>
                                                                                <option value="5700">01:35</option>
                                                                                <option value="6000">01:40</option>
                                                                                <option value="6300">01:45</option>
                                                                                <option value="6600">01:50</option>
                                                                                <option value="6900">01:55</option>
                                                                                <option value="7200">02:00</option>
                                                                                <option value="7500">02:05</option>
                                                                                <option value="7800">02:10</option>
                                                                                <option value="8100">02:15</option>
                                                                                <option value="8400">02:20</option>
                                                                                <option value="8700">02:25</option>
                                                                                <option value="9000">02:30</option>
                                                                                <option value="9300">02:35</option>
                                                                                <option value="9600">02:40</option>
                                                                                <option value="9900">02:45</option>
                                                                                <option value="10200">02:50</option>
                                                                                <option value="10500">02:55</option>
                                                                                <option value="10800">03:00</option>
                                                                                <option value="11100">03:05</option>
                                                                                <option value="11400">03:10</option>
                                                                                <option value="11700">03:15</option>
                                                                                <option value="12000">03:20</option>
                                                                                <option value="12300">03:25</option>
                                                                                <option value="12600">03:30</option>
                                                                                <option value="12900">03:35</option>
                                                                                <option value="13200">03:40</option>
                                                                                <option value="13500">03:45</option>
                                                                                <option value="13800">03:50</option>
                                                                                <option value="14100">03:55</option>
                                                                                <option value="14400">04:00</option>
                                                                                <option value="14700">04:05</option>
                                                                                <option value="15000">04:10</option>
                                                                                <option value="15300">04:15</option>
                                                                                <option value="15600">04:20</option>
                                                                                <option value="15900">04:25</option>
                                                                                <option value="16200">04:30</option>
                                                                                <option value="16500">04:35</option>
                                                                                <option value="16800">04:40</option>
                                                                                <option value="17100">04:45</option>
                                                                                <option value="17400">04:50</option>
                                                                                <option value="17700">04:55</option>
                                                                                <option value="18000">05:00</option>
                                                                                <option value="18300">05:05</option>
                                                                                <option value="18600">05:10</option>
                                                                                <option value="18900">05:15</option>
                                                                                <option value="19200">05:20</option>
                                                                                <option value="19500">05:25</option>
                                                                                <option value="19800">05:30</option>
                                                                                <option value="20100">05:35</option>
                                                                                <option value="20400">05:40</option>
                                                                                <option value="20700">05:45</option>
                                                                                <option value="21000">05:50</option>
                                                                                <option value="21300">05:55</option>
                                                                                <option value="21600">06:00</option>
                                                                                <option value="21900">06:05</option>
                                                                                <option value="22200">06:10</option>
                                                                                <option value="22500">06:15</option>
                                                                                <option value="22800">06:20</option>
                                                                                <option value="23100">06:25</option>
                                                                                <option value="23400">06:30</option>
                                                                                <option value="23700">06:35</option>
                                                                                <option value="24000">06:40</option>
                                                                                <option value="24300">06:45</option>
                                                                                <option value="24600">06:50</option>
                                                                                <option value="24900">06:55</option>
                                                                                <option value="25200">07:00</option>
                                                                                <option value="25500">07:05</option>
                                                                                <option value="25800">07:10</option>
                                                                                <option value="26100">07:15</option>
                                                                                <option value="26400">07:20</option>
                                                                                <option value="26700">07:25</option>
                                                                                <option value="27000">07:30</option>
                                                                                <option value="27300">07:35</option>
                                                                                <option value="27600">07:40</option>
                                                                                <option value="27900">07:45</option>
                                                                                <option value="28200">07:50</option>
                                                                                <option value="28500">07:55</option>
                                                                                <option value="28800">08:00</option>
                                                                                <option value="29100">08:05</option>
                                                                                <option value="29400">08:10</option>
                                                                                <option value="29700">08:15</option>
                                                                                <option value="30000">08:20</option>
                                                                                <option value="30300">08:25</option>
                                                                                <option value="30600">08:30</option>
                                                                                <option value="30900">08:35</option>
                                                                                <option value="31200">08:40</option>
                                                                                <option value="31500">08:45</option>
                                                                                <option value="31800">08:50</option>
                                                                                <option value="32100">08:55</option>
                                                                                <option value="32400">09:00</option>
                                                                                <option value="32700">09:05</option>
                                                                                <option value="33000">09:10</option>
                                                                                <option value="33300">09:15</option>
                                                                                <option value="33600">09:20</option>
                                                                                <option value="33900">09:25</option>
                                                                                <option value="34200">09:30</option>
                                                                                <option value="34500">09:35</option>
                                                                                <option value="34800">09:40</option>
                                                                                <option value="35100">09:45</option>
                                                                                <option value="35400">09:50</option>
                                                                                <option value="35700">09:55</option>
                                                                                <option value="36000">10:00</option>
                                                                                <option value="36300">10:05</option>
                                                                                <option value="36600">10:10</option>
                                                                                <option value="36900">10:15</option>
                                                                                <option value="37200">10:20</option>
                                                                                <option value="37500">10:25</option>
                                                                                <option value="37800">10:30</option>
                                                                                <option value="38100">10:35</option>
                                                                                <option value="38400">10:40</option>
                                                                                <option value="38700">10:45</option>
                                                                                <option value="39000">10:50</option>
                                                                                <option value="39300">10:55</option>
                                                                                <option value="39600">11:00</option>
                                                                                <option value="39900">11:05</option>
                                                                                <option value="40200">11:10</option>
                                                                                <option value="40500">11:15</option>
                                                                                <option value="40800">11:20</option>
                                                                                <option value="41100">11:25</option>
                                                                                <option value="41400">11:30</option>
                                                                                <option value="41700">11:35</option>
                                                                                <option value="42000">11:40</option>
                                                                                <option value="42300">11:45</option>
                                                                                <option value="42600">11:50</option>
                                                                                <option value="42900">11:55</option>
                                                                                <option value="43200">12:00</option>
                                                                                <option value="43500">12:05</option>
                                                                                <option value="43800">12:10</option>
                                                                                <option value="44100">12:15</option>
                                                                                <option value="44400">12:20</option>
                                                                                <option value="44700">12:25</option>
                                                                                <option value="45000">12:30</option>
                                                                                <option value="45300">12:35</option>
                                                                                <option value="45600">12:40</option>
                                                                                <option value="45900">12:45</option>
                                                                                <option value="46200">12:50</option>
                                                                                <option value="46500">12:55</option>
                                                                                <option value="46800">13:00</option>
                                                                                <option value="47100">13:05</option>
                                                                                <option value="47400">13:10</option>
                                                                                <option value="47700">13:15</option>
                                                                                <option value="48000">13:20</option>
                                                                                <option value="48300">13:25</option>
                                                                                <option value="48600">13:30</option>
                                                                                <option value="48900">13:35</option>
                                                                                <option value="49200">13:40</option>
                                                                                <option value="49500">13:45</option>
                                                                                <option value="49800">13:50</option>
                                                                                <option value="50100">13:55</option>
                                                                                <option value="50400">14:00</option>
                                                                                <option value="50700">14:05</option>
                                                                                <option value="51000">14:10</option>
                                                                                <option value="51300">14:15</option>
                                                                                <option value="51600">14:20</option>
                                                                                <option value="51900">14:25</option>
                                                                                <option value="52200">14:30</option>
                                                                                <option value="52500">14:35</option>
                                                                                <option value="52800">14:40</option>
                                                                                <option value="53100">14:45</option>
                                                                                <option value="53400">14:50</option>
                                                                                <option value="53700">14:55</option>
                                                                                <option value="54000">15:00</option>
                                                                                <option value="54300">15:05</option>
                                                                                <option value="54600">15:10</option>
                                                                                <option value="54900">15:15</option>
                                                                                <option value="55200">15:20</option>
                                                                                <option value="55500">15:25</option>
                                                                                <option value="55800">15:30</option>
                                                                                <option value="56100">15:35</option>
                                                                                <option value="56400">15:40</option>
                                                                                <option value="56700">15:45</option>
                                                                                <option value="57000">15:50</option>
                                                                                <option value="57300">15:55</option>
                                                                                <option value="57600">16:00</option>
                                                                                <option value="57900">16:05</option>
                                                                                <option value="58200">16:10</option>
                                                                                <option value="58500">16:15</option>
                                                                                <option value="58800">16:20</option>
                                                                                <option value="59100">16:25</option>
                                                                                <option value="59400">16:30</option>
                                                                                <option value="59700">16:35</option>
                                                                                <option value="60000">16:40</option>
                                                                                <option value="60300">16:45</option>
                                                                                <option value="60600">16:50</option>
                                                                                <option value="60900">16:55</option>
                                                                                <option value="61200">17:00</option>
                                                                                <option value="61500">17:05</option>
                                                                                <option value="61800">17:10</option>
                                                                                <option value="62100">17:15</option>
                                                                                <option value="62400">17:20</option>
                                                                                <option value="62700">17:25</option>
                                                                                <option value="63000">17:30</option>
                                                                                <option value="63300">17:35</option>
                                                                                <option value="63600">17:40</option>
                                                                                <option value="63900">17:45</option>
                                                                                <option value="64200">17:50</option>
                                                                                <option value="64500">17:55</option>
                                                                                <option value="64800">18:00</option>
                                                                                <option value="65100">18:05</option>
                                                                                <option value="65400">18:10</option>
                                                                                <option value="65700">18:15</option>
                                                                                <option value="66000">18:20</option>
                                                                                <option value="66300">18:25</option>
                                                                                <option value="66600">18:30</option>
                                                                                <option value="66900">18:35</option>
                                                                                <option value="67200">18:40</option>
                                                                                <option value="67500">18:45</option>
                                                                                <option value="67800">18:50</option>
                                                                                <option value="68100">18:55</option>
                                                                                <option value="68400">19:00</option>
                                                                                <option value="68700">19:05</option>
                                                                                <option value="69000">19:10</option>
                                                                                <option value="69300">19:15</option>
                                                                                <option value="69600">19:20</option>
                                                                                <option value="69900">19:25</option>
                                                                                <option value="70200">19:30</option>
                                                                                <option value="70500">19:35</option>
                                                                                <option value="70800">19:40</option>
                                                                                <option value="71100">19:45</option>
                                                                                <option value="71400">19:50</option>
                                                                                <option value="71700">19:55</option>
                                                                                <option value="72000">20:00</option>
                                                                                <option value="72300">20:05</option>
                                                                                <option value="72600">20:10</option>
                                                                                <option value="72900">20:15</option>
                                                                                <option value="73200">20:20</option>
                                                                                <option value="73500">20:25</option>
                                                                                <option value="73800">20:30</option>
                                                                                <option value="74100">20:35</option>
                                                                                <option value="74400">20:40</option>
                                                                                <option value="74700">20:45</option>
                                                                                <option value="75000">20:50</option>
                                                                                <option value="75300">20:55</option>
                                                                                <option value="75600">21:00</option>
                                                                                <option value="75900">21:05</option>
                                                                                <option value="76200">21:10</option>
                                                                                <option value="76500">21:15</option>
                                                                                <option value="76800">21:20</option>
                                                                                <option value="77100">21:25</option>
                                                                                <option value="77400">21:30</option>
                                                                                <option value="77700">21:35</option>
                                                                                <option value="78000">21:40</option>
                                                                                <option value="78300">21:45</option>
                                                                                <option value="78600">21:50</option>
                                                                                <option value="78900">21:55</option>
                                                                                <option value="79200">22:00</option>
                                                                                <option value="79500">22:05</option>
                                                                                <option value="79800">22:10</option>
                                                                                <option value="80100">22:15</option>
                                                                                <option value="80400">22:20</option>
                                                                                <option value="80700">22:25</option>
                                                                                <option value="81000">22:30</option>
                                                                                <option value="81300">22:35</option>
                                                                                <option value="81600">22:40</option>
                                                                                <option value="81900">22:45</option>
                                                                                <option value="82200">22:50</option>
                                                                                <option value="82500">22:55</option>
                                                                                <option value="82800">23:00</option>
                                                                                <option value="83100">23:05</option>
                                                                                <option value="83400">23:10</option>
                                                                                <option value="83700">23:15</option>
                                                                                <option value="84000">23:20</option>
                                                                                <option value="84300">23:25</option>
                                                                                <option value="84600">23:30</option>
                                                                                <option value="84900">23:35</option>
                                                                                <option value="85200">23:40</option>
                                                                                <option value="85500">23:45</option>
                                                                                <option value="85800">23:50</option>
                                                                                <option value="86100">23:55</option>
                                                                            </select><span
                                                                                class="Icon_self__7a585911 Icon_size16__7a585911 Select_suffix__eeee3dfd Select_suffixIcon__eeee3dfd"><svg
                                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                                    viewBox="0 0 24 24">
                                                                                    <path
                                                                                        d="M12 14.481l6.247-7.14a1 1 0 011.506 1.318l-7 8a1 1 0 01-1.506 0l-7-8a1 1 0 111.506-1.317L12 14.482z">
                                                                                    </path>
                                                                                </svg></span>
                                                                        </div>
                                                                    </div>
                                                                    <div
                                                                        class="Field_self__b22a9f75 Field_padding__b22a9f75 cssGrid_colspan12__436c4c8b _884ofg">
                                                                        <div class="Field_top__b22a9f75"><label
                                                                                class="Label_self__97ecaa1e"
                                                                                data-qa="items[0].duration-label">Duration</label>
                                                                        </div>
                                                                        <div
                                                                            class="Select_self__eeee3dfd Select_sizeDefault__eeee3dfd">
                                                                            <select class="Select_select__eeee3dfd"
                                                                                name="items[0].duration">
                                                                                <option value="300">5min</option>
                                                                                <option value="600">10min</option>
                                                                                <option value="900">15min</option>
                                                                                <option value="1200">20min</option>
                                                                                <option value="1500">25min</option>
                                                                                <option value="1800">30min</option>
                                                                                <option value="2100">35min</option>
                                                                                <option value="2400">40min</option>
                                                                                <option value="2700">45min</option>
                                                                                <option value="3000">50min</option>
                                                                                <option value="3300">55min</option>
                                                                                <option value="3600">1h</option>
                                                                                <option value="3900">1h 5min</option>
                                                                                <option value="4200">1h 10min</option>
                                                                                <option value="4500">1h 15min</option>
                                                                                <option value="4800">1h 20min</option>
                                                                                <option value="5100">1h 25min</option>
                                                                                <option value="5400">1h 30min</option>
                                                                                <option value="5700">1h 35min</option>
                                                                                <option value="6000">1h 40min</option>
                                                                                <option value="6300">1h 45min</option>
                                                                                <option value="6600">1h 50min</option>
                                                                                <option value="6900">1h 55min</option>
                                                                                <option value="7200">2h</option>
                                                                                <option value="8100">2h 15min</option>
                                                                                <option value="9000">2h 30min</option>
                                                                                <option value="9900">2h 45min</option>
                                                                                <option value="10800">3h</option>
                                                                                <option value="11700">3h 15min</option>
                                                                                <option value="12600">3h 30min</option>
                                                                                <option value="13500">3h 45min</option>
                                                                                <option value="14400">4h</option>
                                                                                <option value="16200">4h 30min</option>
                                                                                <option value="18000">5h</option>
                                                                                <option value="19800">5h 30min</option>
                                                                                <option value="21600">6h</option>
                                                                                <option value="23400">6h 30min</option>
                                                                                <option value="25200">7h</option>
                                                                                <option value="27000">7h 30min</option>
                                                                                <option value="28800">8h</option>
                                                                                <option value="32400">9h</option>
                                                                                <option value="36000">10h</option>
                                                                                <option value="39600">11h</option>
                                                                                <option value="43200">12h</option>
                                                                            </select><span
                                                                                class="Icon_self__7a585911 Icon_size16__7a585911 Select_suffix__eeee3dfd Select_suffixIcon__eeee3dfd"><svg
                                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                                    viewBox="0 0 24 24">
                                                                                    <path
                                                                                        d="M12 14.481l6.247-7.14a1 1 0 011.506 1.318l-7 8a1 1 0 01-1.506 0l-7-8a1 1 0 111.506-1.317L12 14.482z">
                                                                                    </path>
                                                                                </svg></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>




                                                    {{-- ADD new --}}

                                                    {{-- ADD new --}}

                                                </div>
                                            </div>


















                                        </div>
                                        <div class="YgIysy sYPIEA">
                                            <div class="Field_self__b22a9f75 cssGrid_colspan12__436c4c8b">
                                                <div class="Field_top__b22a9f75"><label class="Label_self__97ecaa1e"
                                                        data-qa="label-name">Appointment notes</label></div>
                                                <textarea class="Textarea_self__672a4d15" name="notes" placeholder="Add an appointment note (visible to team only)"
                                                    type="textarea" rows="3" style="overflow: hidden; overflow-wrap: break-word; height: 94px;"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div></div>
                    </div>














                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>











    <div class="fresha-partner-react-portal-wrapper" style="display: none">
        <div>
            <div class="jbOD0b wLxfd8" anchorel="[object Object]"
                style="left: 545.5px; top: 30px; opacity: 1; transform: translateY(0px); transition: opacity 250ms cubic-bezier(0, 0, 0.2, 1) 0ms, transform 250ms cubic-bezier(0, 0, 0.2, 1) 0ms; width: 566px; height: 307px;">
                <div class="qcaxwe PhKPrN" style="display: flex; flex-direction: column; flex-grow: 1;">
                    <div class="_1yyyTz" style="opacity: 0;"></div>
                    <div class="+ME8JR" id="list-service" data-qa="service-pricing-level-select-results"
                        style="display: flex; flex-direction: column; flex-grow: 1;">




                        <div class="_50W3uq UKgewO f3gB-f" data-qa="spinner"
                            style="display: flex; flex-direction: column; flex-grow: 1; justify-content: center;">
                            <div class="Jrxrsm"></div>
                        </div>
                    </div>
                    <div class="_1FPrf5" style="opacity: 1;"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
