@extends('home')

@section('title', 'New post')
@section('content-title', 'New posts')

@section('css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('/adminlte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- dropzonejs -->
    <link rel="stylesheet" href="{{ asset('/adminlte/plugins/dropzone/min/dropzone.min.css') }}">
    <style>
        .form-group {
            width: 100%;
        }

        .disabled {
            opacity: 0.3;
        }

        .disabled:after {
            width: 100%;
            height: 100%;
            position: absolute;
        }
    </style>
@endsection

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">

                <div class="card card-primary">

                    <!-- /.card-header -->
                    <!-- form start -->
                    <div class="card-body">
                        <div class="form-group">
                            <button type="button" onclick="addText()" class="btn btn-block btn-outline-info btn-lg">
                                <i class="fas fa-plus"></i>
                                <span>Add Text</span>
                            </button>
                            <button type="button" onclick="addTextArea()" class="btn btn-block btn-outline-warning btn-lg">
                                <i class="fas fa-plus"></i>
                                <span>Add Textarea</span>
                            </button>
                            <button type="button" onclick="addImg()" class="btn btn-block btn-outline-secondary  btn-lg">
                                <i class="fas fa-plus"></i>
                                <span>Add Image</span>
                            </button>

                        </div>
                        <div id="addhtml">



                        </div>








                    </div>
                    <form>

                    </form>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>

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
        function addImg() {
            let htmlImg = ` {{-- image --}}
                         <div class="card card-default">
                            
                            <div class="card-header">
                                <h3 class="card-title font-weight-bold">Image</h3>

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
                                <div class="row">
                                    
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Title</label>
                                            <input type="email" class="form-control" id="exampleInputEmail1"
                                                placeholder="Enter ">
                                        </div>
                                        <div id="actions" class="row">
                                            <div class="col-lg-6">
                                                <div class="btn-group w-100">
                                                    <span class="btn btn-success col fileinput-button">
                                                        <i class="fas fa-plus"></i>
                                                        <span>Add files</span>
                                                    </span>
                                                    <button type="button" class="btn btn-primary col start">
                                                        <i class="fas fa-upload"></i>
                                                        <span>Start upload</span>
                                                    </button>
                                                    <button type="button" class="btn btn-warning col cancel">
                                                        <i class="fas fa-times-circle"></i>
                                                        <span>Cancel upload</span>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 d-flex align-items-center">
                                                <div class="fileupload-process w-100">
                                                    <div id="total-progress" class="progress progress-striped active"
                                                        role="progressbar" aria-valuemin="0" aria-valuemax="100"
                                                        aria-valuenow="0">
                                                        <div class="progress-bar progress-bar-success" style="width:0%;"
                                                            data-dz-uploadprogress></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table table-striped files" id="previews">
                                            <div id="template" class="row mt-2">
                                                <div class="col-auto">
                                                    
                                                </div>
                                                <div class="col d-flex align-items-center">
                                                    
                                                </div>
                                                <div class="col-4 d-flex align-items-center">
                                                    
                                                </div>
                                                <div class="col-auto d-flex align-items-center">
                                                    <div class="btn-group">
                                                        <button class="btn btn-primary ">
                                                            <i class="fas fa-upload"></i>
                                                            <span>Start</span>
                                                        </button>
                                                        <button class="btn btn-warning ">
                                                            <i class="fas fa-times-circle"></i>
                                                            <span>Cancel</span>
                                                        </button>
                                                        <button class="btn btn-danger ">
                                                            <i class="fas fa-trash"></i>
                                                            <span>Delete</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- /.row -->
                            </div>
                        </div>`
            $("#addhtml").append(htmlImg)
        }

        function addTextArea() {
            let htmlTextarea = ` {{-- for textarea --}}
                            <div class="card card-default">
                                <div class="card-header">
                                    <h3 class="card-title font-weight-bold">Textarea</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool " data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body" style="display: block;">
                                    <div class="row">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Title</label>
                                            <input type="email" class="form-control" id="exampleInputEmail1"
                                                placeholder="Enter ">
                                        </div>
                                        <div class="form-group disabled">

                                            <textarea class="summernote">



                        
                                            </textarea>
                                        </div>
                                    </div>

                                    <!-- /.row -->
                                </div>
                            </div> `
            $("#addhtml").append(htmlTextarea)
            $('.summernote').summernote('disable')

        }

        function addText() {
            let htmlText = `{{-- for text --}}
                            <div class="card card-default">
                                <div class="card-header">
                                    <h3 class="card-title font-weight-bold">Text</h3>

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
                                    <div class="row">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Title</label>
                                            <input type="email" class="form-control" id="exampleInputEmail1"
                                                placeholder="Enter ">
                                        </div>
                                        <div class="form-group">
                                            <input type="email" class="form-control" disabled id="exampleInputEmail1"
                                                placeholder="Enter ">
                                        </div>
                                    </div>

                                    <!-- /.row -->
                                </div>
                            </div>`
            $("#addhtml").append(htmlText)
        }
    </script>
@endsection
