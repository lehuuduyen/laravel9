<!DOCTYPE html>
<html>
<head>
    <title>Laravel 8 Form Example Tutorial</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
  <div class="container mt-4">
  @if(session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
  @endif
  <div class="card">
    <div class="card-header text-center font-weight-bold">
        I Love YOU PAC PAC !!!
    </div>
    <div class="card-body">
      <form name="add-blog-post-form" id="add-blog-post-form" method="post" action="{{url('format-link')}}">
       @csrf
        <div class="form-group">
          <label for="exampleInputEmail1">Nhập link</label>
          <input type="text" id="title" required name="link" class="form-control" required="" value="{{($link)??$link}}">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Nhập title</label>
            <input type="text" id="title" required name="title" class="form-control" required="" value="{{($title)??$title}}">
          </div>
          <h1>{{($code)??$code}}</h1>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>
</div>  
</body>
</html>