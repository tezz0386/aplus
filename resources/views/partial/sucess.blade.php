@if(Session::has('sucess'))
   <div class="alert alert-dismissable alert-danger">
	<button type="button" class="close" data-dismiss="alert" aria-label="close">
		<span aria-hidden="true">&times;</span>
	</button>
	
	<li><strong>{!! session()->get('sucess') !!}</strong></li>
	
   </div>
@endif