@extends('layout.admin')

@section('content')

<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Add Team</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Add Team</li>
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
                <h3 class="card-title">Add Team</h3>
              </div>

              <form method="POST" action="{{ route('admin.postteam')}}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  @if (Session::has('error'))
                 <div class="alert alert-danger">{{ Session::get('error') }}</div>
                 @endif
                 @if (Session::has('success'))
                 <div class="alert alert-success">{{ Session::get('success') }}</div>
                 @endif
                 @error('team_logo')
                        <div class="alert alert-danger">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                   
 
                   <div class="form-group">
                    <label for="exampleInputEmail1">Team Name</label>
                    <input type="text" value="{{ (old('team_name'))?old('team_name'):''}}" class="form-control @error('team_name') is-invalid @enderror" id="team_name" name="team_name">

                    @error('team_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    </div>

                    <div class="form-group">
                    <label for="exampleInputEmail1">Team State</label>
                    <input type="text" value="{{ (old('team_state'))?old('team_state'):''}}" class="form-control @error('team_state') is-invalid @enderror" id="team_state" name="team_state" />

                    @error('team_state')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    </div>

                    <div class="form-group">
                    <label for="exampleInputFile">Team Logo</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input @error('team_logo') is-invalid @enderror" id="team_logo" name="team_logo">

                        <label class="custom-file-label" for="exampleInputFile">Choose Logo</label> 
                      </div> 
                    </div>
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