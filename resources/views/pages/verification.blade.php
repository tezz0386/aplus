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
                <h5 class="modal-title" id="exampleModalLabel">Verification</h5>
              </div>
              <div class="modal-body">
							<form role="form" action="{{route('postVerification')}}" method="post">
			  	@include('partial.error')
  				@method('post')
  				@csrf
          <div class="alert alert-sucess">
            <strong>The email verification will take some times to arrive about to 5 minute</strong><br>
            <label>Or Not get.......................<a href="{{route('user.resend')}}" class="btn btn-link">Resend The verification</a></label>
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
            </div>
          </div>
        </div>

  		</div>
  		<div class="col-md-3 col-lg-3 col-sm-0"></div>
  	</div>
  </div>
@endsection