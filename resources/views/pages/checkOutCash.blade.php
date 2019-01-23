
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
                <h5 class="modal-title" id="exampleModalLabel">Reset</h5>
              </div>
							@include('partial.errors')
              <div class="modal-body">
							<form method="post" action="{{route('user.checkout.cash')}}">
					    @include('partial.errors')
							@include('partial.errors')
						  @csrf
					            <div class="form-group">
                        <label for="name">Full Name:</label>
                        <input type="text" class="form-control" name="name" required>
                      </div>
                      <div class="form-group">
                        <label for="contact">Phone Number:</label>
                        <input type="text" class="form-control" name="contact" reqired>
                      </div>
                      <div class="form-group">
                        <label for="address">Delivery Address:</label>
                        <input type="text" class="form-control" name="address" required>
                      </div>
    				         <div class="form-group">
    				         	<button type="submit" class="btn btn-primary btn-large 	@if(!Auth::user()){{'js-show-modal1'}}@endif" id="buyNow">Buy Now</button>
    				        	<a href="#" class="btn btn-info btn-large">Cancel</a>
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
@include('pages.loginModal')
@endsection


