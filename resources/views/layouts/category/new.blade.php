@extends('home')

@section('title', 'New category')
@section('content-title', 'New category')

@section('css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('/adminlte/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">

@endsection

@section('content')
    <!-- Main content -->
    <section class="content">
        <form action="/category/insert" enctype="multipart/form-data" id="form" method="post">
            {{ csrf_field() }}
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
                                <label for="exampleInputEmail1">Name</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}"
                                    placeholder="Enter name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Slug</label>
                                <input type="text" class="form-control" name="slug" value="{{ old('slug') }}"
                                    placeholder="Enter slug">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Image pc</label>
                                <input accept="image/*" type='file' name="imgpc" id="imgpc" />
                                <img id="blah_imgpc"
                                    style="    width: 60%;
                                height: 200px;" />
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Image sp</label>
                                <input accept="image/*" type='file' name="imgsp" id="imgsp" />
                                <img id="blah_imgsp"
                                    style="    width: 60%;
                                height: 200px;" />
                            </div>
                        </div>

                        <div class="card card-default">
                            <div class="card-header">
                                <h3 class="card-title">Attached Config Field</h3>

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
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Multiple</label>
                                            <select class="duallistbox" id="selectListField" multiple="multiple"
                                                name="select_list_field[]">
                                                <?php
                                                    foreach($configField as $value){
                                                       ?>
                                                <option value="{{ $value->id }}">{{ $value->title }}</option>
                                                <?php 
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
                                                    name="languages[{{ $key }}][title]"
                                                    value="{{ old('title') }}" placeholder="Enter title">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Sub Title</label>
                                                <input type="text" class="form-control"
                                                    name="languages[{{ $key }}][sub_title]"
                                                    value="{{ old('sub_title') }}" placeholder="Enter sub title">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Excerpt</label>
                                                <input type="text" class="form-control"
                                                    name="languages[{{ $key }}][excerpt]"
                                                    value="{{ old('excerpt') }}" placeholder="Enter excerpt">
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

            Swal.fire({
                title: 'Do you want to create?',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Create',
                denyButtonText: `Don't Create`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $("#form").submit()
                    // Swal.fire('Saved!', '', 'success')
                } else if (result.isDenied) {
                    Swal.fire('Changes are not created', '', 'info')
                }
            })
        }
    </script>
@endsection
