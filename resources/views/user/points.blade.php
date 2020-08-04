@extends('layout.user')

@section('content')

<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Points</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('user.dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Points</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row --> 
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
 <section class="content">
      <div class="container-fluid">
        
         <div class="card">
              <div class="card-header">
                <h3 class="card-title">Points</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body"> 
                <table id="users" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Team Name</th>
                    <th>Points</th> 
                  </tr>
                  </thead>
                  <tbody>
                  <?php $i=1; ?>
                  @if($points)	
                    @foreach($points as $team)
	                  <tr>
	                    <td>{{$i}}</td>
	                    <td>{{ucwords($team->team_name)}}</td>
	                    <td>{{ucwords($team->points)}}</td>  
                       
	                  </tr>
                    <?php $i++; ?>
                    @endforeach
                  @endif
                  </tbody>
                  </table>
                  </div>
            </div>       
      </div>
  </section>
  @endsection