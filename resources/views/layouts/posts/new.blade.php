@extends('home')

@section('title', 'New post')
@section('content-title', 'New posts')

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
                            <div class="form-group">
                                <label for="exampleInputEmail1">Description</label>
                                <textarea id="summernote">
                                </textarea>
                            </div>
                            {{-- image --}}
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
                                            <div id="actions" class="row">
                                                <div class="col-lg-6">
                                                    <div class="btn-group w-100">
                                                        <span class="btn btn-success col fileinput-button">
                                                            <i class="fas fa-plus"></i>
                                                            <span>Add files</span>
                                                        </span>
                                                        <button type="submit" class="btn btn-primary col start">
                                                            <i class="fas fa-upload"></i>
                                                            <span>Start upload</span>
                                                        </button>
                                                        <button type="reset" class="btn btn-warning col cancel">
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
                                                        <span class="preview"><img src="data:," alt=""
                                                                data-dz-thumbnail /></span>
                                                    </div>
                                                    <div class="col d-flex align-items-center">
                                                        <p class="mb-0">
                                                            <span class="lead" data-dz-name></span>
                                                            (<span data-dz-size></span>)
                                                        </p>
                                                        <strong class="error text-danger" data-dz-errormessage></strong>
                                                    </div>
                                                    <div class="col-4 d-flex align-items-center">
                                                        <div class="progress progress-striped active w-100"
                                                            role="progressbar" aria-valuemin="0" aria-valuemax="100"
                                                            aria-valuenow="0">
                                                            <div class="progress-bar progress-bar-success" style="width:0%;"
                                                                data-dz-uploadprogress></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto d-flex align-items-center">
                                                        <div class="btn-group">
                                                            <button class="btn btn-primary start">
                                                                <i class="fas fa-upload"></i>
                                                                <span>Start</span>
                                                            </button>
                                                            <button data-dz-remove class="btn btn-warning cancel">
                                                                <i class="fas fa-times-circle"></i>
                                                                <span>Cancel</span>
                                                            </button>
                                                            <button data-dz-remove class="btn btn-danger delete">
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
                            </div>
                            {{-- for workers --}}
                            <div class="card card-default">
                                <div class="card-header">
                                    <h3 class="card-title font-weight-bold">Services</h3>

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
                                        
                                    </div>

                                    <!-- /.row -->
                                </div>
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
    <!-- dropzonejs -->
    <script src="{{ asset('/adminlte/plugins/dropzone/min/dropzone.min.js') }}"></script>
    <script>
        $('#summernote').summernote({
            height: 200
        })
        $('.select2').select2()
        // DropzoneJS Demo Code Start
        Dropzone.autoDiscover = false
        // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
        var previewNode = document.querySelector("#template")
        previewNode.id = ""
        var previewTemplate = previewNode.parentNode.innerHTML
        previewNode.parentNode.removeChild(previewNode)
        var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
            url: "/target-url", // Set the url
            thumbnailWidth: 80,
            thumbnailHeight: 80,
            parallelUploads: 20,
            previewTemplate: previewTemplate,
            autoQueue: false, // Make sure the files aren't queued until manually added
            previewsContainer: "#previews", // Define the container to display the previews
            clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
        })

        myDropzone.on("addedfile", function(file) {
            // Hookup the start button
            file.previewElement.querySelector(".start").onclick = function() {
                myDropzone.enqueueFile(file)
            }
        })

        // Update the total progress bar
        myDropzone.on("totaluploadprogress", function(progress) {
            document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
        })

        myDropzone.on("sending", function(file) {
            // Show the total progress bar when upload starts
            document.querySelector("#total-progress").style.opacity = "1"
            // And disable the start button
            file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
        })

        // Hide the total progress bar when nothing's uploading anymore
        myDropzone.on("queuecomplete", function(progress) {
            document.querySelector("#total-progress").style.opacity = "0"
        })

        // Setup the buttons for all transfers
        // The "add files" button doesn't need to be setup because the config
        // `clickable` has already been specified.
        document.querySelector("#actions .start").onclick = function() {
            myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
        }
        document.querySelector("#actions .cancel").onclick = function() {
            myDropzone.removeAllFiles(true)
        }
    </script>
@endsection
