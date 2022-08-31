@extends('home')

@section('title', 'Config Post')
@section('content-title', 'Config Post')

@section('css')
    <!-- Select2 -->
    <style>
        .form-group {
            width: 100%;
        }
    </style>
@endsection

@section('content')

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <input type="hidden" id="allLanguage" value="{{ json_encode($allLanguage) }}">
                @if (isset($configFieldDetail))
                    <div class="" style="text-align: right;margin: 10px 0px ">
                        <a class="btn btn-success" hre f="/config/create"> Create New Config filed </a>
                    </div>
                    <form action="/config/{{ $configFieldDetail->id }}" id="form" method="put">
                    @else
                        <form action="/config" id="form" method="post">
                @endif
                @csrf
                {{-- <!-- {{ csrf_field() }} --> --}}

                <div class="card card-primary">

                    <!-- /.card-header -->
                    <!-- form start -->
                    <div class="card-body">
                        <div style="display:flex">
                            <div class="col-md-12 p-0 pr-1">
                                <div class="form-group">
                                    <label for="exampleInputtext1">Title <abbr>*</abbr></label>
                                    <input type="text" required style="border: 1px solid #20c997!important;" class="form-control"
                                        id="title" placeholder="Enter Title... "
                                        value="{{ isset($configFieldDetail->title) ? $configFieldDetail->title : '' }}">
                                </div>
                            </div>
                        </div>
                        @if (!isset($configFieldDetail))
                            <div class="form-group">
                                <button type="button" onclick="addHtml(1)" class="btn btn-block btn-outline-info btn-lg">
                                    <i class="fas fa-plus"></i>
                                    <span>Add Text</span>
                                </button>
                                <button type="button" onclick="addHtml(2)"
                                    class="btn btn-block btn-outline-warning btn-lg">
                                    <i class="fas fa-plus"></i>
                                    <span>Add Textarea</span>
                                </button>
                                <button type="button" onclick="addHtml(3)"
                                    class="btn btn-block btn-outline-secondary  btn-lg">
                                    <i class="fas fa-plus"></i>
                                    <span>Add Image</span>
                                </button>
                            </div>
                        @endif

                        <div id="addhtml">
                            @isset($configFieldDetail)
                                <input type="hidden" name="config_id" value="{{ $configFieldDetail->id }}">

                                @foreach ($configFieldDetail->config_detail_field as $configDetailField)
                                    @php
                                        $type = $configDetailField['type'];
                                        $classType = 'btn-outline-secondary';
                                        $textType = 'Image';
                                        if ($type == 1) {
                                            // TEXT
                                            $classType = 'btn-outline-info';
                                            $textType = 'Text';
                                        } elseif ($type == 2) {
                                            // TEXTAREA
                                            $classType = 'btn-outline-warning';
                                            $textType = 'Textarea';
                                        }
                                        $disabled = count($listPost) > 0 ? 'disabled' : '';
                                    @endphp
                                    <div class="card card-default json-html">
                                        <div class="card-header">
                                            <h3 class="card-title font-weight-bold {{ $classType }}">{{ $textType }}
                                            </h3>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                                    <i class="fas fa-times"></i>
                                                </button>

                                            </div>
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body" style="display: block;">
                                            <div style="display:flex">
                                                <div class="col-md-6 p-0 pr-1">
                                                    @foreach ($allLanguage as $language)
                                                        <div class="form-group">
                                                            <label for="exampleInputtext1">Title
                                                                {{ $language['slug'] }}</label>
                                                            <input type="text" class="form-control" name="title"
                                                                placeholder="Enter Title... "
                                                                data-language_id="{{ $language->id }}"
                                                                value="{{ isset($configDetailField['language'][$language->id]) ? $configDetailField['language'][$language->id]['title'] : '' }}">
                                                        </div>
                                                    @endforeach

                                                </div>

                                                <div class="col-md-6 p-0 pl-1">
                                                    <div class="form-group">
                                                        <label for="exampleInputtext1">Key <abbr>*</abbr></label>
                                                        <input required type="text" class="form-control" name="key"
                                                            placeholder="Enter Key..." {{ $disabled }}
                                                            value="{{ $configDetailField['key'] }}"">
                                                    </div>
                                                </div>
                                                <input type="hidden" name="type" value="{{ $type }}">

                                                <!-- /.row -->
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endisset
                        </div>
                    </div>
                </div>


                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="button" onclick="onSubmit(this)" data-original-text="Submit" class="btn btn-primary">Submit</button>
                    
                </div>

                <!-- /.card -->
                </form>

            </div>

        </div>

    </section>
@endsection

@section('javascript')
    <script>
        function addHtml(type) {
            var language = JSON.parse($("#allLanguage").val())
            // IMAGE
            let classType = "btn-outline-secondary"
            let textType = "Image"
            if (type == 1) {
                // TEXT
                classType = "btn-outline-info"
                textType = "Text"
            } else if (type == 2) {
                // TEXTAREA
                classType = "btn-outline-warning"
                textType = "Textarea"
            }
            let htmlImg = `<div class="card card-default json-html">
                                <div class="card-header">
                                    <h3 class="card-title font-weight-bold ${classType}">${textType}</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                                            <i class="fas fa-times"></i>
                                        </button>
                                        
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body" style="display: block;">
                                    <div style="display:flex">
                                        <div class="col-md-6 p-0 pr-1">
                                `;
            $.each(language, function(key, val) {
                htmlImg += ` <div class="form-group">
                                                <label for="exampleInputtext1">Title ${val.slug}</label>
                                                <input type="text" class="form-control title" data-language_id="${val.id}" name="title" placeholder="Enter Title... ">
                                            </div>`
            })
            htmlImg += `</div>
                            
                                        <div class="col-md-6 p-0 pl-1">
                                            <div class="form-group">
                                                <label for="exampleInputtext1">Key <abbr>*</abbr></label>
                                                <input type="text" class="form-control" name="key"   placeholder="Enter Key...">
                                            </div>
                                        </div>
                                        <input type="hidden" name="type" value="${type}">
                                    </div>
                                </div>

                                <!-- /.row -->
                            </div>
                        `
            $("#addhtml").append(htmlImg)
        }


        function onSubmit(_this) {
            Swal.fire({
                title: 'Do you want to create?',
                showCancelButton: true,
                confirmButtonText: 'Create',
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    BtnLoading(_this)

                    let message = []
                    let el = $('.json-html');
                    let array = [];
                    let arrayCheckKey = [];
                    let data = {};
                    $.each(el, function(k, element) {
                        if ($(element).attr('style')) {
                            return;
                        }

                        var key = $(element).find("input[name='key']").val();
                        var type = $(element).find("input[name='type']").val();
                        arrayCheckKey.push(key)


                        var elementTitles = $(element).find("input[name='title']");
                        $.each(elementTitles, function(stt, elementTitle) {
                            let json = {};
                            json.title = $(elementTitle).val()
                            json.key = key
                            json.type = type
                            json.language_id = $(elementTitle).attr('data-language_id')
                            array.push(json)
                        })

                    })
                    let titleConfig = $("#title").val()
                    $.ajax({
                        type: $("#form").attr('method'),
                        url: $("#form").attr('action'),
                        data: {
                            title: titleConfig,
                            json: JSON.stringify(array),
                        },
                        success: function(msg) {
                            BtnReset(_this)
                            if($("#form").attr('method') == 'put'){
                                alertSuccess(msg.message)
                            }else if($("#form").attr('method') == 'post'){
                                alertSuccess(msg.message,'/config')
                            }
                        },
                        error: function(msg) {
                            BtnReset(_this)
                            alertError(msg.responseJSON.message)
                        }
                    });
                }
            })

        }
    </script>
@endsection
