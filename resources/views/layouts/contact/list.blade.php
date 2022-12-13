@extends('home')

@section('title', 'List category')
@section('content-title', 'List category')
@section('css')
    <link rel="stylesheet" href="{{ asset('/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

@endsection

@section('content')


    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="card">


                        <!-- /.card-header -->
                        <div class="card-body table-responsive">

                            <table id="example1" class=" table table-striped  " style="text-align: center;">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Company</th>
                                        <th>Type</th>
                                        <th>Status</th>
                                        <th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody>


                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Company</th>
                                        <th>Type</th>
                                        <th>Status</th>
                                        <th>Detail</th>

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

    <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Details of your inquiry</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <pre id="detail"></pre>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
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
        $(document).ready(function() {

            let pageSlug = $("#pageSlug").val()
            var table = $('#example1').DataTable({
                "responsive": true,

                "processing": true,
                "ajax": {
                    "url": "/api/contact",
                    "type": "GET"
                },
                "columns": [{
                        "data": "name"
                    },
                    {
                        "data": "email"
                    },
                    {
                        "data": "company"
                    },
                    {
                        "data": "type"
                    },
                    {
                        "data": "status"
                    },
                    {
                        "data": "detail"
                    }
                ],
                "aoColumnDefs": [

                    {
                        "mRender": function(data, type, row) {
                            html = `
                            <button class="btn btn-primary" onclick="showDetail(this)" data-detail="${row.detail}" data-toggle="modal" data-target="#myModal"><i class="fa fa-eye" aria-hidden="true"></i>
                            </button>
                        `
                            return html;
                        },
                        "aTargets": [-1]
                    },
                    {
                        "mRender": function(data, type, row) {
                            let selected1 = "";
                            let selected2 = "";
                            if (row.status == 2) {
                                selected2 = "selected";
                            } else {
                                selected1 = "selected";
                            }
                            html = `
                            <select class="form-control changeStatus" data-id ="${row.id}">
                                <option value="1" ${selected1}>No process</option>
                                <option value="2" ${selected2}>Processed</option>
                            </select>
                        `

                            return html;
                        },
                        "aTargets": [-2]
                    },

                ],

            });
            $(document).on('change', '.changeStatus', function() {
             
                $.ajax({
                    type: 'put',
                    url: `/api/contact/`+$(this).data('id')+`?status=`+$(this).val(),

                    success: function(msg) {
                        Swal.fire(
                            'Deleted!',
                            msg.message,
                            'success'
                        )
                    }
                });

                // Does some stuff and logs the event to the console
            });
            
           
        })
        function showDetail(_this){
               $("#detail").html($(_this).data('detail'))
               
            }
    </script>
@endsection
