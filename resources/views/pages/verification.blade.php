@extends('main.navbar')
@section('content')
<br><br><br><br><br>
  <div class="container">
  	<div class="row">
  		<div class="col-md-3 col-lg-3 col-sm-0"></div>
  		<div class="col-md-6 col-lg-6 col-sm-12">
  			<form role="form" action="{{route('postVerification')}}" method="post">
				@include('partial.error')
  				@method('post')
  				@csrf
          <div class="alert alert-sucess">
            <strong>The email verification will take some times about to 5 minute</strong><br>
            <strong>Or Not get................................<span style="margin-left: 181px;"><a href="#" class="btn btn-info">Resend The verification</a></span></strong>
          </div>
  				<div class="form-group">
  					<label for="email">Verification Code:</label>
            
  					<input type="text" name="verification" required="required" class="form-control"
            @if(isset($verification) && count($verification)>0)
            value="{{$verification}}"
            @endif
            >
  				</div>
  				<div class="form-group">
  					<button type="submit" class="btn btn-primary">Verify</button>
  				</div>
  			</form>

  		</div>
  		<div class="col-md-3 col-lg-3 col-sm-0"></div>
  	</div>
  </div>
@endsection