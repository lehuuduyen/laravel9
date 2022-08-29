@extends('home')

@section('title', 'Category')
@section('content-title', 'Category')

@section('css')

@endsection

@section('content')

    <!-- Main content -->
    <section class="content">
        <input type="hidden" id="allLanguage" value="{{ json_encode($allLanguage) }}">
        @if (isset($getCategory))
            <input type="hidden" name="action" value="Update">
            <div class="pull-right" style="text-align: right;margin: 10px 0px ">
                <a class="btn btn-success" href="/category/create"> Create New Category </a>
            </div>
            <form action="/category/{{ $getCategory->id }}?post_type={{ $pageSlug }}" enctype="multipart/form-data"
                id="form" method="post">
                {{ method_field('PUT') }}
            @else
                <input type="hidden" name="action" value="Create">

                <form action="/category?post_type={{ $pageSlug }}" enctype="multipart/form-data" id="form"
                    method="post">
        @endif

        @csrf
        <div class="row">
            <div class="col-md-6">

                <div class="card card-primary">
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
                    <!-- /.card-header -->
                    <!-- form start -->






                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Show on menu</label>
                            <select class="form-control" name="status">
                                <option {{ isset($getCategory->status) && $getCategory->status == 1 ? 'selected' : '' }}
                                    value="1">Active</option>
                                <option {{ isset($getCategory->status) && $getCategory->status == 2 ? 'selected' : '' }}
                                    value="2">Unactive</option>
                            </select>

                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <input type="text" class="form-control" name="name"
                                value="{{ isset($getCategory->name) ? $getCategory->name : '' }}" placeholder="Enter name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Slug</label>
                            <input type="text" class="form-control" name="slug"
                                {{ isset($getCategory->slug) ? 'disabled' : '' }}
                                value="{{ isset($getCategory->slug) ? $getCategory->slug : '' }}" placeholder="Enter slug">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Image pc</label>
                            <div class="form-image text-center"><a href="javascript:void(0)" class="image-clear"><i
                                        class="fa fa-times-circle fa-2x"></i></a> <input type="hidden" name="imagepc"
                                    class="input-path" value="">
                                <div class="dropify-preview image-hidden" style="display: none;"><span
                                        class="dropify-render"></span>
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
                        <div class="form-group">
                            <label for="exampleInputEmail1">Image sp</label>
                            <div class="form-image text-center"><a href="javascript:void(0)" class="image-clear"><i
                                        class="fa fa-times-circle fa-2x"></i></a> <input type="hidden" name="imagesp"
                                    class="input-path" value="">
                                <div class="dropify-preview image-hidden" style="display: none;"><span
                                        class="dropify-render"></span>
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
                    </div>

                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="button" onclick="onSubmit()" class="btn btn-primary">Submit</button>
                    </div>

                    <!-- /.card -->
                </div>
            </div>
            <div class="col-md-6">
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
                            <div class="tab-content" id="custom-tabs-five-tabContent">
                                <?php 
                                    foreach($allLanguage as $key => $language){
                                        $title = "";
                                        $subTitle = "";
                                        $excerpt = "";
                                       
                                        
                                        if(isset($getCategory)){
                                            $title = ($getCategory['category_transiation'][$key]['language_id'] == $language->id )?$getCategory['category_transiation'][$key]['title']:"";
                                            $subTitle = ($getCategory['category_transiation'][$key]['language_id'] == $language->id )?$getCategory['category_transiation'][$key]['sub_title']:"";
                                            $excerpt = ($getCategory['category_transiation'][$key]['language_id'] == $language->id )?$getCategory['category_transiation'][$key]['excerpt']:"";
                                        }


                                     ?>
                                <div class="tab-pane fade {{ $key == 0 ? 'active show' : '' }}""
                                    id="custom-tabs{{ $key }}" role="tabpanel"
                                    aria-labelledby="custom-tabs-five-overlay-tab">
                                    <div class="overlay-wrapper">
                                        {{-- <div class="overlay"><i class="fas fa-3x fa-sync-alt fa-spin"></i>
                                            <div class="text-bold pt-2">Loading...</div>
                                            </div> --}}
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Title</label>
                                            <input type="text" class="form-control"
                                                name="languages[{{ $key }}][title]" value="{{ $title }}"
                                                placeholder="Enter title">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Sub Title</label>
                                            <input type="text" class="form-control"
                                                name="languages[{{ $key }}][sub_title]"
                                                value="{{ $subTitle }}" placeholder="Enter sub title">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Excerpt</label>
                                            <input type="text" class="form-control"
                                                name="languages[{{ $key }}][excerpt]"
                                                value="{{ $excerpt }}" placeholder="Enter excerpt">
                                        </div>
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
        </div>

        </form>

        <!-- /.col-->
    </section>
@endsection

@section('javascript')
    <!-- Bootstrap4 Duallistbox -->
    <script src="{{ asset('/adminlte/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>
    <script>
        $('.duallistbox').bootstrapDualListbox()
        imgpc.onchange = evt => {
            const [file] = imgpc.files
            if (file) {
                blah_imgpc.src = URL.createObjectURL(file)
            }
        }
        imgsp.onchange = evt => {
            const [file] = imgsp.files
            if (file) {
                blah_imgsp.src = URL.createObjectURL(file)
            }
        }

        function changeTabLanguage(typeLanguage) {
            $("input[name='languge_id']").val(typeLanguage)
        }

        function onSubmit(e) {
            let action = $('input[name="action"]').val();
            Swal.fire({
                title: `Do You Want To ${action}?`,
                showCancelButton: true,
                confirmButtonText: action,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $("#form").submit()
                    // Swal.fire('Saved!', '', 'success')
                }
            })
        }
    </script>
@endsection
