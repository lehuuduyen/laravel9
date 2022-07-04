@extends('home')

@section('title', 'New post')
@section('content-title', 'New posts')

@section('css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('/adminlte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">

                <div class="card card-primary">

                    <!-- /.card-header -->
                    <!-- form start -->
                    <form>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Title</label>
                                <input type="email" class="form-control" id="exampleInputEmail1"
                                    placeholder="Enter email">
                            </div>
                            <div class="form-group select2-purple">
                                <label for="exampleInputPassword1">Category</label>
                                <select class="select2" multiple="multiple" data-placeholder="Select a State"
                                    data-dropdown-css-class="select2-purple" style="width: 100%;">
                                    <option>News</option>
                                    <option>Recruit</option>
                                    <option>Service</option>
                                    <option>Works</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Image</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="exampleInputFile">
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text">Upload</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Description</label>

                                <textarea id="summernote">
                            </textarea>
                            </div>
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
    <!-- Summernote -->
    <script src="{{ asset('/adminlte/plugins/select2/js/select2.full.min.js') }}"></script>

    <script>
        $('#summernote').summernote()
        $('.select2').select2()
    </script>
@endsection
