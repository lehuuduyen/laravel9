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
                    <form action="/category/insert" method="post">
                        {{ csrf_field() }}

                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Slug</label>
                                <input type="text" class="form-control" name="slug" value="{{ old('slug') }}"
                                    placeholder="Enter slug">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Image pc</label>
                                <input accept="image/*"  type='file' id="imgpc" />
                                <img id="blah_imgpc"/>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Image sp</label>
                                <input accept="image/*"  type='file' id="imgsp" />
                                <img id="blah_imgsp" />
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
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>

                    </form>
                    <!-- /.card -->


                </div>
            </div>
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
                    <form action="/category/insert" method="post">
                        {{ csrf_field() }}

                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Slug</label>
                                <input type="text" class="form-control" name="slug" value="{{ old('slug') }}"
                                    placeholder="Enter slug">
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Title</label>
                                <input type="text" class="form-control" name="title" value="{{ old('title') }}"
                                    placeholder="Enter title">
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputtext1">Short Description</label>
                                <input type="text" class="form-control" value="{{ old('description') }}"
                                    name="description" placeholder="Enter short description">
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
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>

                    </form>
                    <!-- /.card -->


                </div>
            </div>
            <!-- /.col-->
        </div>
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
    </script>
@endsection
