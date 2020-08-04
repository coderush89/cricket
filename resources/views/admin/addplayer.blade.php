@extends('layout.admin')

@section('content')

<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Add Player</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Add Player</li>
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
                <h3 class="card-title">Add Player</h3>
              </div>

              <form method="POST" action="{{ route('admin.postplayer')}}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  @if (Session::has('error'))
                 <div class="alert alert-danger">{{ Session::get('error') }}</div>
                 @endif
                 @if (Session::has('success'))
                 <div class="alert alert-success">{{ Session::get('success') }}</div>
                 @endif
                 @error('profile_pic')
                        <div class="alert alert-danger">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                   
 
                   <div class="form-group">
                    <label for="exampleInputEmail1">Firstname</label>
                    <input type="text" value="{{ (old('firstname'))?old('firstname'):''}}" class="form-control @error('firstname') is-invalid @enderror" id="firstname" name="firstname">

                    @error('firstname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    </div>

                    <div class="form-group">
                    <label for="exampleInputEmail1">Lastname</label>
                    <input type="text" value="{{ (old('lastname'))?old('lastname'):''}}" class="form-control @error('lastname') is-invalid @enderror" id="lastname" name="lastname">

                    @error('lastname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    </div>

                    <div class="form-group">
                    <label for="exampleInputEmail1">Team</label> 

                    <select class="form-control" name="team_id">
                      <option value="">Please select a team</option>
                      @if($teams)
                       @foreach($teams as $team)
                       <option value="{{$team->id}}" >
                         {{$team->team_name}}
                       </option>
                       @endforeach
                      @endif
                    </select>
                    @error('Team')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    </div>

                    <div class="form-group">
                    <label for="exampleInputEmail1">Jersey Number</label>
                    <input type="text" value="{{ (old('jersey_number'))?old('jersey_number'):''}}" class="form-control @error('jersey_number') is-invalid @enderror" id="jersey_number" name="jersey_number">

                    @error('jersey_number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    </div>

                    <div class="form-group">
                    <label for="exampleInputEmail1">Country</label>
                    <input type="text" value="{{ (old('country'))?old('country'):''}}" class="form-control @error('country') is-invalid @enderror" id="country" name="country">

                    @error('country')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    </div>

                    <div class="form-group">
                    <label for="exampleInputFile">Player Pic</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input @error('profile_pic') is-invalid @enderror" id="profile_pic" name="profile_pic">

                        <label class="custom-file-label" for="exampleInputFile">Choose Pic</label> 
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