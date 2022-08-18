@extends('home')

@section('title', $getCategory->name)
@section('content-title', $getCategory->name)

@section('css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('/adminlte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- dropzonejs -->
    <link rel="stylesheet" href="{{ asset('/adminlte/plugins/dropzone/min/dropzone.min.css') }}">
@endsection

@section('content')
    <!-- Main content -->
    <section class="content">
        @if (isset($postDetail))
                    <div class="pull-right" style="text-align: right;margin: 10px 0px ">
                        <a class="btn btn-success" href="/config/create"> Create New Config filed </a>
                    </div>
                    <form action="/post/{{ $postDetail->id }}/edit?post_type={{ $getCategory->slug }}" id="form" method="put">
                    @else
                        <form action="/post?post_type={{ $getCategory->slug }}" id="form" method="post">
                @endif


        <form action="/{{ $getCategory->slug }}/insert" enctype="multipart/form-data" id="form" method="post">
            {{ csrf_field() }}
            <div class="row">

                <div class="col-md-8">

                    <input type="hidden" name="category_id" value="{{ $getCategory->id }}">



                    @if (\Session::has('error'))
                        <div class="alert alert-danger">
                            <ul>
                                <li>{!! \Session::get('error') !!}</li>
                            </ul>
                        </div>
                    @endif
                    @if (\Session::has('success'))
                        <div class="alert alert-success">
                            <ul>
                                <li>{!! \Session::get('success') !!}</li>
                            </ul>
                        </div>
                    @endif


                    <div class="col-md-12">

                        <div class="card card-primary card-outline card-outline-tabs">
                            <div class="card-header p-0 border-bottom-0">
                                <ul class="nav nav-tabs" id="custom-tabs-five-tab" role="tablist">
                                    <?php 
                                    foreach($allLanguage as $key => $language){
                                     ?>
                                    <li class="nav-item">
                                        <a class="nav-link {{ $key == 0 ? 'active' : '' }}"
                                            id="custom-tabs-five-overlay-tab" data-toggle="pill"
                                            href="#custom-tabs{{ $key }}" role="tab"
                                            aria-controls="custom-tabs-five-overlay"
                                            aria-selected="true">{{ $language->name }}</a>
                                    </li>
                                    <?php
                                    }    
                                     ?>


                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="custom-tabs-five-tabContent">
                                    <?php 
                                    foreach($allLanguage as $key => $language){
                                     ?>
                                    <div class="tab-pane fade {{ $key == 0 ? 'active show' : '' }}""
                                        id="custom-tabs{{ $key }}" role="tabpanel"
                                        aria-labelledby="custom-tabs-five-overlay-tab">
                                        <div class="overlay-wrapper">
                                            {{-- <div class="overlay"><i class="fas fa-3x fa-sync-alt fa-spin"></i>
                                            <div class="text-bold pt-2">Loading...</div>
                                            </div> --}}
                                            <?php 
                                                foreach($listDetailFieldLanguage as $value ){
                                                    if($value['type'] ==1){
                                                        ?>
                                            {{-- text --}}
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">{{ $value['title'] }}</label>
                                                <input type=" text" class="form-control"
                                                    name="languages[{{ $key }}][{{ $value['key'] }}]"
                                                    placeholder="Enter {{ $value['title'] }}">
                                            </div>
                                            <?php
                                                                            }
                                                                            if($value['type'] == 2){
                                                                                ?>
                                            {{-- textarea --}}

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">{{ $value['title'] }}</label>
                                                <textarea class="summernote" name="languages[{{ $key }}][{{ $value['key'] }}]">
                                                                                </textarea>
                                            </div>
                                            <?php
                                                                }
                                                }    
                                                
                                            ?>
                                            <input type="hidden" name="languages[{{ $key }}][languge_id]"
                                                value="{{ $language->id }}" />

                                        </div>
                                    </div>
                                    <?php
                                    }    
                                     ?>

                                </div>
                            </div>
                            <!-- /.card -->
                           
                        </div>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-primary card-outline card-outline-tabs">
                        
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-five-tabContent">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Slug</label>
                                    <input type="text" class="form-control"
                                        name="slug"
                                        placeholder="Enter slug" value="">
                                </div>
                            </div>
                        </div>
                        <!-- /.card -->
                        <!-- /.card-footer -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                    <?php 
                        foreach($listDetailFieldNotLanguage as $value){
                            if($value['type'] == 3){
                                        ?>
                    {{-- image --}}
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title font-weight-bold">{{ $value['title'] }}</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="file-upload">
                            <div class="field-image">
                                <div class="image-upload-wrap">
                                    <input class="file-upload-input" name="{{ $value['key'] }}" type='file'
                                        onchange="readURL(this);" accept="image/*" />
                                    <div class="drag-text">
                                        <h3>Drag and drop a file or select add Image</h3>
                                    </div>
                                </div>
                                <div class="file-upload-content">
                                    <img class="file-upload-image" src="#" alt="your image" />
                                    <div class="image-title-wrap">
                                        <button type="button" onclick="removeUpload(this)" class="remove-image">Remove
                                            <span class="image-title">Uploaded Image</span></button>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                    <?php
                                    }
                        }    
                        
                        
                    ?>
                </div>
            </div>

        </form>
    </section>
@endsection

@section('javascript')
    <!-- Summernote -->
    <script src="{{ asset('/adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- dropzonejs -->
    <script src="{{ asset('/adminlte/plugins/dropzone/min/dropzone.min.js') }}"></script>
    <script>
        $('.summernote').summernote({
            height: 200
        })
        $('.select2').select2()

        function readURL(input) {
            if (input.files && input.files[0]) {

                var reader = new FileReader();

                reader.onload = function(e) {
                    $(input).closest('.field-image').find('.image-upload-wrap').hide();

                    $(input).closest('.field-image').find('.file-upload-image').attr('src', e.target.result);
                    $(input).closest('.field-image').find('.file-upload-content').show();

                    $(input).closest('.field-image').find('.image-title').html(input.files[0].name);
                };
                console.log(input.files[0])
                reader.readAsDataURL(input.files[0]);

            } else {
                removeUpload();
            }
        }

        function removeUpload(input) {
            $(input).closest('.field-image').find('.file-upload-input').replaceWith($('.file-upload-input').clone());
            $(input).closest('.field-image').find('.file-upload-content').hide();
            $(input).closest('.field-image').find('.image-upload-wrap').show();
        }
        $('.image-upload-wrap').bind('dragover', function() {
            $('.image-upload-wrap').addClass('image-dropping');
        });
        $('.image-upload-wrap').bind('dragleave', function() {
            $('.image-upload-wrap').removeClass('image-dropping');
        });
    </script>
@endsection
