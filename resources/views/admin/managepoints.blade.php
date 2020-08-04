@extends('layout.admin')

@section('content')

<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Add Points</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Add Points</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
 <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
        
         <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add Points</h3>
              </div>

              <form method="POST" action="{{ route('admin.postpoints',['id'=>$id])}}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  @if (Session::has('error'))
                 <div class="alert alert-danger">{{ Session::get('error') }}</div>
                 @endif
                 @if (Session::has('success'))
                 <div class="alert alert-success">{{ Session::get('success') }}</div>
                 @endif 

                   <?php $points = isset($points->points)?$points->points:'';?>
 
                   <div class="form-group">
                    <label for="exampleInputEmail1">Points</label>
                    <input type="text" value="{{ (old('points'))?old('points'):$points}}" class="form-control @error('points') is-invalid @enderror" id="points" name="points">

                    @error('points')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    </div>

                  
                </div>
                <!-- /.card-body -->


                <div class="card-footer">

                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            </div>
          </div>       
      </div>
  </section>
  @endsection