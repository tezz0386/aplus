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
                <button class="how-pos3 hov3 trans-04 js-hide-modal1">
                <img src="{{URL::asset('images/icons/icon-close.png')}}" alt="CLOSE">
			        	</button>
              </div>
              <div class="modal-body">
                     <form action="{{route('login')}}" method="POST">
                      @include('partial.error')
                                @csrf
                                @method('post')
                                <div class="form-group">
                                    <label for="email" class="col-form-label">Email:</label>
                                    <input name="email" type="email" class="form-control" id="email" required>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="col-form-label">Password:</label>
                                    <input name="password" type="password" class="form-control" id="password">
                                </div>
            </div>
            <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Login</button>
			<strong>Not have account..................................................?</strong>
            <a href="#" class="btn btn-info">Signup</a>
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