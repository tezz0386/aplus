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
                     <form action="{{route('login')}}" method="POST">
                      @include('partial.error')
                                @csrf
                                @method('post')
                                <div class="form-group">
                                    <label for="email" class="col-form-label">Email:</label>
                                    <input name="email" type="email" class="form-control" id="email" required="required" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="password" class="col-form-label">Password:</label>
                                    <input name="password" type="password" class="form-control" id="password" required="required" autocomplete="off">
                                    <label>Forget Password..........................................................................?</label><a href="{{route('getForget')}}" class="btn btn-link">Recover</a>
                                </div>
            </div>
            <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Login</button>
		      	<strong>Not have account..................................................?</strong>
            <a href="{{route('signup')}}" class="btn btn-info">Signup</a>
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