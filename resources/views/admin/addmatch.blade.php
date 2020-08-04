@extends('layout.admin')

@section('content')

<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Add Match</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Add Match</li>
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
                <h3 class="card-title">Add Match</h3>
              </div>

              <form method="POST" action="{{ route('admin.postmatch')}}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  @if (Session::has('error'))
                 <div class="alert alert-danger">{{ Session::get('error') }}</div>
                 @endif
                 @if (Session::has('success'))
                 <div class="alert alert-success">{{ Session::get('success') }}</div>
                 @endif 
                   
 
                   <div class="form-group">
                    <label for="exampleInputEmail1">Team One</label>
                     <select class="form-control @error('team_one') is-invalid @enderror" name="team_one">
                      <option value="">Please select a team</option>
                      @if($teams)
                       @foreach($teams as $team)
                       <option value="{{$team->id}}" <?php echo (old('team_one')==$team->id)?'selected':''; ?>>
                         {{$team->team_name}}
                       </option>
                       @endforeach
                      @endif
                    </select>
                    @error('team_one')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    </div>

                    <div class="form-group">
                    <label for="exampleInputEmail1">Team Two</label>
                    
                    <select class="form-control @error('team_two') is-invalid @enderror" name="team_two">
                      <option value="">Please select a team</option>
                      @if($teams)
                       @foreach($teams as $team)
                       <option value="{{$team->id}}" <?php echo (old('team_two')==$team->id)?'selected':''; ?>>
                         {{$team->team_name}}
                       </option>
                       @endforeach
                      @endif
                    </select>
                    @error('team_two')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    </div>
 

                  <div class="form-group">
                    <label for="exampleInputEmail1">Match Date</label>
                    <input type='text' class="form-control @error('match_date') is-invalid @enderror"  value="{{ (old('match_date'))?old('match_date'):''}}" name="match_date"/>
                    <span>Date Format: DD-MM-YYYY HH:MM</span>
                    @error('match_date')
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