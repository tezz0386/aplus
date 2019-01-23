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
              <div class="modal-body">
                     <form action="{{route('postReset')}}" method="POST">
                      @include('partial.error')
                                @csrf
                                @method('post')
                                <div class="form-group">
                                    <label for="verification" class="col-form-label">Verification Code:</label>
                                    <input name="verification" type="text" class="form-control" id="verification" required="required" autocomplete="off"
                                    @if(isset($verification) && count($verification)>0)value={{$verification}}@endif
                                    >
                                </div>
                                <div class="form-group">
                                    <label for="password" class="col-form-label">password:</label>
                                    <input name="password" type="password" class="form-control" id="password" required="required" autocomplete="off">
                                </div>
                 </div>
                     <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Reset</button>
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