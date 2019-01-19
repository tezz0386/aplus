@extends('main.navbar')
@section('content')
@include('pages.cartSection')
<br><br><br><br><br>
    <div class="col-md-12 col-lg-12 col-sm-12">
    <div class="container">
    	<div class="row">
    			<div class="col-md-3"></div>
    			<div class="col-md-6">
				@include('partial.error')
				<strong><h2>Total Price is RS:  <span>{{session()->get('cart')->totalPrice}}</span></h1></strong>
				<strong><h2>Total Qtys:  <span>{{session()->get('cart')->totalQty}}</span></h1></strong>
    				<form method="post" action="{{route('user.checkout.cash')}}">
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
    			<div class="col-md-3"></div>
    		</div>
    	</div>
    </div>
@include('pages.loginModal')
@endsection
