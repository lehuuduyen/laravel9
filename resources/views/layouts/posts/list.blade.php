@extends('home')

@section('title', $getPage['title'])
@section('content-title', 'List '.$getPage['title'])
@section('css')
    <link rel="stylesheet" href="{{ asset('/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
  
@endsection

@section('content')

    <input type="hidden" id="page_id" value="{{ $getPage['id'] }}">
    <input type="hidden" id="post_type" value="{{ $getPage['slug'] }}">

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">


                    <div class="card">
                        <div class="pull-right" style="text-align: right;margin: 10px 20px 0px;">
                            <a class="btn btn-success" href="/post/create?post_type={{ $getPage['slug'] }}"> Create New {{ $getPage['title'] }}</a>
                        </div>
                        
                        <!-- /.card-header -->
                        <div class="card-body table-responsive">
                            <table id="example1" class=" table table-striped  " style="text-align: center;">
                                <thead>
                                    <tr>
                                        <th>Slug</th>
                                        <th>Category</th>
                                        <th>Updated at</th>
                                        <th>Viewer</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Slug</th>
                                        <th>Category</th>
                                        <th>Updated at</th>
                                        <th>Viewer</th>
                                        <th>Action</th>

                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('javascript')
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('/adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('/adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/adminlte/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('/adminlte/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('/adminlte/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('/adminlte/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('/adminlte/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('/adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <script>
        $(function() {
            let categoryId = $("#page_id").val()
            let postType = $("#post_type").val()
            var table = $('#example1').DataTable({
                "responsive": true,

                "processing": true,
                "ajax": {
                    "url": "/api/post?page_id="+categoryId,
                    "type": "GET"
                },
                "columns": [{
                        "data": "slug"
                    },
                    {
                        "data": "category"
                    },
                    {
                        "data": "update_at"
                    },
                    {
                        "data": "id"
                    }
                    ,
                    {
                        "data": "id"
                    }
                ],
                "aoColumnDefs": [
                    {
                        "mRender": function(data, type, row) {

                            html = `
                        <a href="/post/${row.id}/edit?post_type=${postType}">
                            <button class="btn btn-primary"><i class="fa fa-eye" aria-hidden="true"></i>
                            </button>
                        </a>
                        `
                                html += `<button class="btn btn-danger" onclick="deleteRow(${row.id})"><i
                                    class="fa fa-trash" aria-hidden="true"></i>
                            </button>`


                            return html;
                        },
                        "aTargets": [-1]
                    },

                ],

            });

            function deleteRow(id) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'delete',
                            url: `/post/${id}`,

                            success: function(msg) {
                                table.ajax.reload();
                                Swal.fire(
                                    'Deleted!',
                                    msg.message,
                                    'success'
                                )
                            }
                        });

                    }
                })
            }

        });
    </script>
@endsection
