@extends('home')

@section('title', 'Page')
@section('content-title', 'Page')

@section('css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('/adminlte/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">

@endsection

@section('content')

    <!-- Main content -->
    <section class="content">
        <input type="hidden" id="allLanguage" value="{{ json_encode($allLanguage) }}">
        @if (isset($getPage))
            <input type="hidden" name="action" value="Update">
            <div class="" style="text-align: right;margin: 10px 0px ">
                <a class="btn btn-success" href="/page/create"> Create New Page </a>
            </div>
            <form action="/page/{{ $getPage->id }}" enctype="multipart/form-data" id="form" method="put">
                {{-- {{ method_field('PUT') }} --}}

            @else
                <input type="hidden" name="action" value="Create">

                <form action="/page" enctype="multipart/form-data" id="form" method="post">
        @endif
        
        @csrf
        <div class="row">
            <div class="col-md-6">

                <div class="card card-primary">
                   
                    <!-- /.card-header -->
                    <!-- form start -->


                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Show on menu</label>
                            <select class="form-control" name="status">
                                <option {{ (isset($getPage->status) && $getPage->status == 1) ? 'selected' : '' }} value="1">Active</option>
                                <option {{ (isset($getPage->status) && $getPage->status == 2) ? 'selected' : '' }} value="2">Unactive</option>
                            </select>
                           
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Show category</label>
                            <select class="form-control" name="is_category">
                                <option {{ (isset($getPage->status) && $getPage->is_category == 1) ? 'selected' : '' }} value="1">Active</option>
                                <option {{ (isset($getPage->status) && $getPage->is_category == 2) ? 'selected' : '' }} value="2">Unactive</option>
                            </select>
                           
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputEmail1">Slug <abbr>*</abbr></label>
                            <input type="text" class="form-control" name="slug" {{ isset($getPage->slug)?"disabled":"" }}
                                value="{{ isset($getPage->slug) ? $getPage->slug : '' }}" placeholder="Enter slug">
                        </div>
                       
                    </div>
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Attached Config Field</h3>


                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Multiple</label>
                                        <select class="duallistbox" id="selectListField" multiple="multiple"
                                            name="select_list_field[]">
                                            <?php
                                                    foreach($configField as $value){
                                                        if(isset($pageFiled)){
                                                            ?>
                                            <option {{ in_array($value->id, $pageFiled) ? 'selected="selected"' : '' }}
                                                value="{{ $value->id }}">{{ $value->title }}</option>

                                            <?php
                                                        }else{
                                                            ?>
                                            <option value="{{ $value->id }}">{{ $value->title }}</option>
                                            <?php 
                                                        }

                                                    }
                                                ?>

                                        </select>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.card-body -->

                    </div>

                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="button" onclick="onSubmit(this)" data-original-text="Submit" class="btn btn-primary">Submit</button>
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
                                        if(isset($getPage)){
                                            $title = ($getPage['page_all_transiation'][$key]['language_id'] == $language->id )?$getPage['page_all_transiation'][$key]['title']:"";
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
                                            <label for="exampleInputEmail1">Title <abbr>*</abbr></label>
                                            <input type="text" class="form-control"
                                                name="languages[{{ $key }}][title]" value="{{ $title }}"
                                                placeholder="Enter title">
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
        function changeTabLanguage(typeLanguage) {
            $("input[name='languge_id']").val(typeLanguage)
        }

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

                    $.ajax({
                        type: $("#form").attr('method'),
                        url: $("#form").attr('action'),
                        data: $("#form").serialize(), // serializes the form's elements.
                        success: function(msg) {
                            BtnReset(_this)
                            if($("#form").attr('method') == 'put'){
                                alertSuccess(msg.message,location.href)
                            }else if($("#form").attr('method') == 'post'){
                                alertSuccess(msg.message,'/page')
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
