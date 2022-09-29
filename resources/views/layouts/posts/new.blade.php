@extends('home')

@section('title', $getPage['title'])
@section('content-title', $getPage['title'])

@section('css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('/adminlte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- dropzonejs -->
    <link rel="stylesheet" href="{{ asset('/adminlte/plugins/dropzone/min/dropzone.min.css') }}">
    <style>
        .show-taxonomies {
            max-height: 200px;
            overflow: auto;
        }
    </style>
@endsection

@section('content')
    <!-- Main content -->
    <section class="content">

        @if (isset($postDetail))
            <input type="hidden" name="action" value="Update">

            <div class="" style="text-align: right;margin: 10px 0px ">
                <a class="btn btn-success" href="/post/create?post_type={{ $getPage['slug'] }}"> Create New Config filed
                </a>
            </div>
            <form action="/post/{{ $postDetail->id }}?post_type={{ $getPage['slug'] }}" enctype="multipart/form-data"
                id="form" method="post">
                {{ method_field('PUT') }}
            @else
                <input type="hidden" name="action" value="Create">

                <form action="/post?post_type={{ $getPage['slug'] }}" enctype="multipart/form-data" id="form"
                    method="post">
        @endif

        {{ csrf_field() }}
        <div class="row">

            <div class="col-md-8">

                <input type="hidden" name="category_id" value="{{ $getPage['id'] }}">



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
                                    <a class="nav-link {{ $key == 0 ? 'active' : '' }}" id="custom-tabs-five-overlay-tab"
                                        data-toggle="pill" href="#custom-tabs{{ $key }}" role="tab"
                                        aria-controls="custom-tabs-five-overlay"
                                        aria-selected="true">{{ $language->name }}</a>
                                </li>
                                <?php
                                    }    
                                     ?>


                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
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
                                                foreach($listDetailFieldLanguage as $listDetailField ){
                                                    $value = (isset($listDetailField[$language['slug']]))?$listDetailField[$language['slug']]:"";
                                                    if($listDetailField['type'] ==1){
                                                        ?>
                                        {{-- text --}}
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">{{ $listDetailField['title'] }}</label>
                                            <input type=" text" class="form-control"
                                                name="languages[{{ $listDetailField['id'] }}][{{ $language['id'] }}][{{ $listDetailField['key'] }}]"
                                                placeholder="Enter {{ $listDetailField['title'] }}"
                                                value="{{ $value }}">
                                        </div>
                                        <?php
                                                                            }
                                                                            if($listDetailField['type'] == 2){
                                                                                ?>
                                        {{-- textarea --}}

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">{{ $listDetailField['title'] }}</label>
                                            <textarea class="summernote"
                                                name="languages[{{ $listDetailField['id'] }}][{{ $language['id'] }}][{{ $listDetailField['key'] }}]">
                                                                     {{ $value }}           </textarea>
                                        </div>
                                        <?php
                                                                }
                                                                if($listDetailField['type'] == 4){
                                                                                ?>
                                        {{-- textarea --}}

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">{{ $listDetailField['title'] }}</label>
                                            <textarea class="form-control" rows="5"
                                                name="languages[{{ $listDetailField['id'] }}][{{ $language['id'] }}][{{ $listDetailField['key'] }}]">{{ $value }}</textarea>
                                        </div>
                                        <?php
                                                                }
                                                }    
                                                
                                            ?>

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
                    <div class="card-body" style="text-align: center">
                        <button type="button" onclick="onSubmit(this)" data-original-text="Submit"
                            class="btn btn-primary">Submit</button>
                    </div>
                </div>
                <div class="card card-primary card-outline card-outline-tabs">

                    <div class="card-body">
                        <div class="tab-content">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Slug</label>
                                <input type="text" class="form-control" name="slug" placeholder="Enter slug"
                                    value="{{ isset($postDetail) ? $postDetail['slug'] : '' }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-primary card-outline card-outline-tabs">
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Category</label>
                                {!! $htmlRecursiveCategory !!}
                            </div>
                        </div>
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

                    </div>
                    <div class="form-image text-center"><a href="javascript:void(0)" class="image-clear"><i
                                class="fa fa-times-circle fa-2x"></i></a> <input type="hidden"
                            name="image[{{ $value['id'] }}][{{ $value['key'] }}]" class="input-path"
                            value="{{ $value['value'] }}">
                        <div class="dropify-preview image-hidden"
                            style="{{ isset($value['value']) && $value['value'] != '' ? 'display: block' : 'display: none' }};">
                            <span class="dropify-render">
                                <?php
                            if(isset($value['value']) && $value['value'] !=""){
                                ?>
                                <img src="{{ Storage::disk(config('juzaweb.filemanager.disk'))->url($value['value']) }}"
                                    alt="">
                                <?php
                            }
                        ?></span>
                            <div class="dropify-infos">
                                <div class="dropify-infos-inner">
                                    <p class="dropify-filename"><span class="dropify-filename-inner"></span></p>
                                </div>
                            </div>
                        </div>
                        <div class="icon-choose"><i class="fa fa-cloud-upload fa-5x"></i>
                            <p>Click here to select file</p>
                        </div>
                    </div>

                </div>
                <?php
                                    }
                                    if($value['type'] == 5){
                                        ?>
                {{-- checkbox --}}
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title font-weight-bold">{{ $value['title'] }}</h3>

                    </div>
                    <div class="card-body">
                        @php
                            $tags = explode(',', $value['tags']);
                        @endphp
                        @foreach ($tags as $tag)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="{{ $value['key'] }}"
                                    value="{{ $tag }}">
                                <label class="form-check-label"> {{ $tag }} </label>
                            </div>
                        @endforeach

                    </div>

                </div>
                <?php
                                    }
                                    if($value['type'] == 6){
                                        ?>
                {{-- radio --}}
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title font-weight-bold">{{ $value['title'] }}</h3>

                    </div>
                    <div class="card-body">
                        @php
                            $tags = explode(',', $value['tags']);
                        @endphp
                        @foreach ($tags as $tag)
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="{{ $value['key'] }}"
                                    value="{{ $tag }}">
                                <label class="form-check-label"> {{ $tag }} </label>
                            </div>
                        @endforeach

                    </div>

                </div>
                <?php
                                    }
                                    if($value['type'] == 7){
                                        ?>
                {{-- select --}}
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title font-weight-bold">{{ $value['title'] }}</h3>

                    </div>
                    <div class="card-body">
                        @php
                            $tags = explode(',', $value['tags']);
                        @endphp
                        <select class="form-control" name="{{ $value['key'] }}">

                            <option value=""></option>
                            @foreach ($tags as $tag)
                            <option value="{{ $tag }}">{{ $tag }}</option>
                            @endforeach
                        </select>

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

        function onSubmit(_this) {
            let action = $('input[name="action"]').val();
            Swal.fire({
                title: `Do You Want To ${action}?`,
                showCancelButton: true,
                confirmButtonText: action,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    BtnLoading(_this)

                    $("#form").submit()
                    // Swal.fire('Saved!', '', 'success')
                }
            })
        }
    </script>
@endsection
