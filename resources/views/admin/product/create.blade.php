@extends('admin.dashboard')
@section('content')

                        <div class="card">
                                    <h5 class="card-header">Item Add Form 
                                             
                                    </h5>
                                    <div class="card-body">
            <form method="post" action="{{route('storeproduct')}}" enctype="multipart/form-data">
              @csrf
              <div class="input-group mb-3">
              <select class="form-control" name="child_name">
                  @if(isset($category) && count($category))
                  @foreach($category as $category)
                  <option value="{{$category->child_name}}">{{$category->child_name}}</option>
                   @endforeach
                   @endif
              </select>
            </div>
                                <span><label>Status Activation:</label>
                                                  <div class="switch-button">
                                                        <input type="checkbox" checked="" name="switch14" id="switch14"><span>
                                                    <label for="switch14"></label></span>
                                                    </div>
                                             </span>

                        
                                            <div class="form-group">
                                                <label for="inputText3" class="col-form-label">Item Name:</label>
                                                <input id="inputText3" type="text" class="form-control" name="name">
                                            </div>
                                            <div class="form-group">
                                                <label for="description">Description</label>
                                                <textarea class="form-control" id="description" rows="3" name="description"></textarea>
                                            </div>
                                             <li class="list-group-item active"><h5>Feaured Image</h5></li>
                                             <li class="list-group-item">
				                                     <div class="img-thumbnail  text-center">
				                                     	<img src=" http://127.0.0.1/l5ecom/public/images/no-thumbnail.jpeg" id="imgthumbnail" class="img-fluid" alt="Image not found" height="300" width="200">
				                                     </div>
                                             <div class="input-group mb-3">
                                               <div class="custom-file ">
                                                <input type="file" class="custom-file-input" name="image" id="thumbnail">
                                                <label class="custom-file-label" for="thumbnail">Choose Item Image</label>
                                               </div>
                                             </div>
			                                     </li>




                    <div class="row">
                             <div class="col-md-6">

                                            <div class="form-group">
                                            	<label for="price">Price:</label>
                                            <div class="input-group mb-3">

                                                <div class="input-group-prepend"><span class="input-group-text">$</span></div>

                                                <input type="text" class="form-control" name="price" id="price">
                                                <div class="input-group-append"><span class="input-group-text">.00</span></div>
                                            </div>
                                            </div>







                                            <div class="form-group">
                                              <label for="discount">Discount:</label>
                                            <div class="input-group mb-3">

                                                <div class="input-group-prepend"><span class="input-group-text">$</span></div>

                                                <input type="text" class="form-control" name="discount" id="discount">
                                                <div class="input-group-append"><span class="input-group-text">.00</span></div>
                                            </div>
                                            </div>

                        </div>

                                           <div class="form-group">
                                                <label for="qty">Qty:</label>
                                                <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="qty" id="qty">
                                                <div class="input-group-append"><span class="input-group-text">.00</span></div>
                                            </div>
                                            </div>
                    </div>

                                        
                                               <li class="list-group-item active"><h5>Other Feature</h5></li>
				                                     	<div class="form-group">
				                                     		<label for="color">Color:</label>
				                                     		<input type="text" name="color" class="form-control" id="color">
				                                     	</div>
				                                     	<div class="form-group">
				                                     		<label for="size">Size:</label>
				                                     		<input type="text" name="size" class="form-control">
				                                     	</div>

                                            </div>
                                            </div>
                                            <div class="form-group">
                                            	<button type="submit" class="btn btn-primary">Add</button>
                                            	<a href="#" class="btn btn-warning">Canel</a>
                                            </div>
                                        </form>
                                    </div>
                             </div>

@endsection


@section('scripts')
<script type="text/javascript">
	$('#thumbnail').on('change', function() {
var file = $(this).get(0).files;
var reader = new FileReader();
reader.readAsDataURL(file[0]);
reader.addEventListener("load", function(e) {
var image = e.target.result;
$("#imgthumbnail").attr('src', image);
});
});
</script>
@endsection