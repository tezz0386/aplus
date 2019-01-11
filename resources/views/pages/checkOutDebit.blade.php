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
    				<form method="post" action="{{route('user.checkout')}}" id="payment-form">
					 @include('partial.errors')
						@csrf
						<div class="charge-error" id="charge-error">
							
						</div>
    					<div class="form-group">
    					<label for="name">Name:</label>
    					<input type="text" name="name" id="name" class="form-control" required>
    				</div>
    				<div class="form-group">
    					<label for="address">Adress:</label>
    					<input type="text" name="address" id="address" class="form-control" required>
    				</div>
    				<div class="form-group">
    					<label for="card_name">Card Holder Name:</label>
    					<input type="text" name="card_name" id="card_name" class="form-control" required>
    				</div>
    				<div class="form-group">
					<label for="card-element">
    
                    </label>
                   <div id="card-element">
					  <!-- A Stripe Element will be inserted here. -->
					  <label>hello</label>
                    </div>

                      <!-- Used to display form errors. -->
                     <div id="card-errors" role="alert"></div>
					</div>
    				<div class="form-group">
    					<button type="submit" class="btn btn-primary btn-large 	@if(!Session::has('auth')){{'js-show-modal1'}}@endif" id="buyNow">Buy Now</button>
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
@section('scripts')
<script src="https://js.stripe.com/v3/"></script>
<script src="{{URL::asset('js/checkout.js')}}"></script>
@endsection
