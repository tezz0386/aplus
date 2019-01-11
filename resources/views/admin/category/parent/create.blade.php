@extends('admin.dashboard')
@section('content')

<form method="post" 
@if(isset($parent) && count($parent)>0)
action="{{route('updateparent', $parent->id)}}"
@endif 

action="{{route('storeparent')}}"

>
    @if(isset($parent) && count($parent)>0)
    @method('patch')
    @endif
    @csrf
	<div class="form-group">
        <label for="inputText3" class="col-form-label">Category Title:</label>
        <input id="inputText3" type="text" class="form-control" name="name"
          @if(isset($parent) && count($parent)>0)
          value="{{$parent->parent_name}}"
          @endif

        >
    </div>
    <div class="form-group">
         <label for="description">Description</label>
         
         <textarea class="form-control" id="description" rows="3" name="description">@if(isset($parent) && count($parent)>0){{$parent->description}}@endif</textarea>
         
     </div>
     <div class="form-group">
     	<button class="btn btn-primary">Add</button>
     	<a href="#" class="btn btn-warning">Cancel</a>
     </div>
</form>
@endsection
@section('scripts')

@endsection
