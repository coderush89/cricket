@extends('layout.admin')

@section('content')

<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Players List</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Players</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
        <div class="col-sm-12 text-right">

                <a href="{{route('admin.addplayer')}}" class="btn btn-primary btn-sm active" role="button" aria-pressed="true">Add Player
                </a> 
              </div>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
 <section class="content">
      <div class="container-fluid">
        
         <div class="card">
              <div class="card-header">
                <h3 class="card-title">Players List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body"> 
                <table id="users" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Player Name</th>
                    <th>Player Team</th>  
                    <th>Jersey Number</th>
                    <th>Country</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php $i=1; ?>
                  @if($players)	
                    @foreach($players as $player)
	                  <tr>
	                    <td>{{$i}}</td>
	                    <td>{{ucwords($player->firstname.' '.$player->lastname)}}</td>
	                    <td>{{ucwords($player->playerteam)}}</td>
                      <td>{{ucwords($player->jersey_number)}}</td>
                      <td>{{ucwords($player->country)}}</td> 
	                    <td>{{($player->status==1)?'Active':'Deactivate'}}</td>
                      <th> 
                        <a title="Manage Stats" class="btn btn-primary" href="{{ route('admin.managestats',['id' => $player->id])}}"><i class="fa fa-edit" aria-hidden="true"></i>&nbsp;Manage Stats</a>
                         

                      </th>
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