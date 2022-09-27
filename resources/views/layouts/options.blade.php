@extends('home')

@section('title', 'Options')
@section('content-title', 'Options')

@section('css')
    <!-- Select2 -->
    <style>
        .form-group {
            width: 100%;
        }
    </style>
@endsection

@section('content')

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-12 ">
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
                    <div class="card-body">

                        <input type="hidden" id="allLanguage" value="{{ json_encode($allLanguage) }}">
                        <form action="/option" id="form" method="POST">
                            @csrf
                            <div class="col-md-12 ">
                                <div class="form-group">
                                    <label for="exampleInputtext1">ID Service <abbr>*</abbr></label>
                                    <input type="text" required style="border: 1px solid #20c997!important;"
                                        class="form-control" id="serviceId" name="service" placeholder="Enter Title... "
                                        value="{{ isset($data['service']) ? $data['service'] : '' }}">
                                </div>
                            </div>

                    </div>

                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="button" onclick="onSubmit(this)" data-original-text="Submit"  class="btn btn-primary">Submit</button>
                    </div>

                    <!-- /.card -->
                    </form>
                </div>
            </div>

        </div>

    </section>
@endsection

@section('javascript')
<script>
    function onSubmit(_this) {
            Swal.fire({
                title: `Do You Want To Update?`,
                showCancelButton: true,
                confirmButtonText: 'Update',
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    BtnLoading(_this)

                    $("#form").submit()
                    // Swal.fire('Saved!', '', 'success')
                }
            })
        }
</script>
@endsection
