@extends('layout.admin')

@section('content')

<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Manage Stats</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Manage Stats</li>
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
                <h3 class="card-title">Manage Stats</h3>
              </div>

              <form method="POST" action="{{ route('admin.postmanagestats',['id'=>$id])}}" >
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
                   
                   <?php $matches = (isset($stats->matches))?$stats->matches:''; ?>
                   <div class="form-group">
                    <label for="exampleInputEmail1">Matches</label>
                    <input type="text" value="{{ (old('matches'))?old('matches'):$matches}}" class="form-control @error('matches') is-invalid @enderror" id="matches" name="matches">

                    @error('matches')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    </div>


                    <?php $runs = (isset($stats->runs))?$stats->runs:''; ?> 
                    <div class="form-group">
                    <label for="exampleInputEmail1">Runs</label>
                    <input type="text" value="{{ (old('runs'))?old('runs'):$runs}}" class="form-control @error('runs') is-invalid @enderror" id="runs" name="runs">

                    @error('runs')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    </div>

                  
                    <?php $highest_score = (isset($stats->highest_score))?$stats->highest_score:''; ?>
                    <div class="form-group">
                    <label for="exampleInputEmail1">Highest Score</label>
                    <input type="text" value="{{ (old('highest_score'))?old('highest_score'):$highest_score}}" class="form-control @error('highest_score') is-invalid @enderror" id="highest_score" name="highest_score">

                    @error('highest_score')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    </div>


                    <?php $fifties = (isset($stats->fifties))?$stats->fifties:''; ?> 
                    <div class="form-group">
                    <label for="exampleInputEmail1">Fifties</label>
                    <input type="text" value="{{ (old('fifties'))?old('fifties'):$fifties}}" class="form-control @error('fifties') is-invalid @enderror" id="fifties" name="fifties">

                    @error('fifties')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    </div> 

                    <?php $hundreds = (isset($stats->hundreds))?$stats->hundreds:''; ?>  
                    <div class="form-group">
                    <label for="exampleInputEmail1">hundreds</label>
                    <input type="text" value="{{ (old('hundreds'))?old('hundreds'):$hundreds}}" class="form-control @error('hundreds') is-invalid @enderror" id="hundreds" name="hundreds">

                    @error('hundreds')
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