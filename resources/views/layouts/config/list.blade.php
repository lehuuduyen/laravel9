@extends('home')

@section('title', 'List posts')
@section('content-title', 'List posts')
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
                        <div class="pull-right" style="text-align: right;margin: 10px 20px 0px;">
                            <a class="btn btn-success" href="/config/new"> Create New Config Post</a>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body table-responsive">
                            <table id="example1" class=" table table-striped  " style="text-align: center">
                                <thead>
                                    <tr>
                                        <th style="text-align: center">Title</th>
                                        <th style="text-align: left">Summary</th>
                                        <th style="text-align: center">Updated at</th>
                                        <th style="text-align: center">Post Used</th>
                                        <th style="text-align: center">Status</th>

                                        <th style="text-align: left">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php  
                                        for($i=1;$i<3;$i++){
                                            
                                        ?>
                                    <tr>
                                        <td>Custom {{ $i }}</td>
                                        <td >
                                            <div>1: text</div>
                                            <div>0: textarea</div>
                                            <div>3: img</div>
                                        </td>
                                        <td>2022/08/04 {{ rand(1, 24) }}:00</td>
                                        <td >
                                            <a href="">http://localhost:8080/post/edit/{{ rand(1, 100) }}</a>
                                            {{-- <a href="">http://localhost:8080/post/edit/{{ rand(1, 100) }}</a> --}}
                                            {{-- <a href="">http://localhost:8080/post/edit/{{ rand(1, 100) }}</a> --}}
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                  <input type="checkbox" class="custom-control-input" id="customSwitch3">
                                                  <label class="custom-control-label" for="customSwitch3"></label>
                                                </div>
                                              </div>
                                        </td>
                                        <td>
                                            <button class="btn btn-primary"><i class="fa fa-eye" aria-hidden="true"></i>
                                            </button>
                                            <button class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i>
                                            </button>
                                        </td>

                                    </tr>
                                    <?php
                                        }

                                        ?>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Category</th>
                                        <th>Title</th>
                                        <th>Updated at</th>
                                        <th>Viewer</th>
                                        <th >Status</th>
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
            $("#example1").DataTable({
                initComplete: function() {
                    this.api().columns().every(function() {
                        var column = this;
                        var select = $('<select><option value=""></option></select>')
                            .appendTo($(column.footer()).empty())
                            .on('change', function() {
                                var val = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                                );

                                column
                                    .search(val ? '^' + val + '$' : '', true, false)
                                    .draw();
                            });

                        column.data().unique().sort().each(function(d, j) {
                            select.append('<option value="' + d + '">' + d +
                                '</option>')
                        });
                    });
                }
            });

        });
    </script>
@endsection
