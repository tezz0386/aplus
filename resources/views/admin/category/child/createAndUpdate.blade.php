@extends('admin.dashboard')
@section('content')

<form method="post" 
@if(isset($category) && count($category)>0)
action="{{route('updatechild', $category->id)}}"
@endif 

action="{{route('storechild')}}"

>
    @if(isset($category) && count($category)>0)
    @method('patch')
    @endif
    @csrf

    @if(isset($parents) && count($parents)>0)
    <div class="form-group">
        <select class="form-control" name="cat_name">
        @foreach($parents as $parent)
            <option hidden="hidden">Choose Category</option>
            <option value="{{$parent->parent_name}}">{{$parent->parent_name}}</option>
        @endforeach
        </select>
    </div>
    @endif
	<div class="form-group">
        <label for="inputText3" class="col-form-label">Category Title:</label>
        <input id="inputText3" type="text" class="form-control" name="name"
          @if(isset($category) && count($category)>0)
          value="{{$category->child_name}}"
          @endif

        >
    </div>
    <div class="form-group">
         <label for="description">Description</label>
         
         <textarea class="form-control" id="description" rows="3" name="description">@if(isset($category) && count($category)>0){{$category->description}}@endif</textarea>
         
     </div>
     <div class="form-group">
     	<button class="btn btn-primary">Add</button>
     	<a href="#" class="btn btn-warning">Cancel</a>
     </div>
</form>


@endsection
@section('scripts')

@endsection
