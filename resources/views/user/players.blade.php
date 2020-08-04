@extends('layout.user')

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
              <li class="breadcrumb-item"><a href="{{route('user.dashboard')}}">Home</a></li>
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
                    <th>Player Pic</th>
                    <th>Country</th>
                    <th>Status</th> 
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
                      <td>
						<?php 
						if ($player->profile_pic!='' && file_exists('storage/images/player/'.$player->profile_pic)) { 
						?>
						<img width="30px" height="30px" src="<?php echo asset('storage/images/player/'.$player->profile_pic); ?>"/>
						  
						<?php 
					     } else {
					    ?>
					    <img width="30px" height="30px" src="{{ asset('storage/images/player/na.png') }}" />
					    <?php 
						 } 
						?>
                      	</td>
                      <td>{{ucwords($player->country)}}</td> 
	                    <td>{{($player->status==1)?'Active':'Deactivate'}}</td>
                      
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