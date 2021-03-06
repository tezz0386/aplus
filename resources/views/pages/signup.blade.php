
@extends('main.navbar')
@section('content')
  <div class="container">
  	<div class="row">
  		<div class="col-md-3 col-lg-3 col-sm-0"></div>
  		<div class="col-md-6 col-lg-6 col-sm-12">
		
		<div class="p-t-60 p-b-20">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Login</h5>
              </div>
              <div class="modal-body">
			<form role="form" action="{{route('signup')}}" method="post">
			  	@include('partial.errors')
          @method('post')
          @csrf
  				<div class="form-group">
  					<label for="email">Email:</label>
  					<input type="email" name="email" required="required" class="form-control">
  				</div>
          <div class="form-group">
            <label for="cantact">Contact:</label>
            <input type="text" name="contact" required="required" class="form-control" id="conact">
          </div>
           <div class="form-group">
            <label for="address">Address:</label>
            <input type="text" name="address" required="required" class="form-control" id="address>
          </div>
  				<div class="form-group">
  					<label for="password">Password:</label>
  					<input type="password" name="password" required="required" class="form-control">
  				</div>
          <div class="form-group">
            <label for="password1">Confirm Password:</label>
            <input type="password" name="password1" required="required" class="form-control" id="password1">
          </div>
  				<br>
         <div class="form-group">
  					<button type="submit" class="btn btn-primary">Signup</button>
  					<a href="{{route('/')}}" class="btn btn-warning">Cancell</a>
  				</div>
  		</form>

              </div>
            </div>
          </div>
        </div>
  		</div>
  		<div class="col-md-3 col-lg-3 col-sm-0"></div>
  	</div>
  </div>
@endsection