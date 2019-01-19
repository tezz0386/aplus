@extends('admin.dashboard')
@section('content')
<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#parentCategory">Add Category</button>
<hr>
            <div class="row">
                        @if(isset($parents) && count($parents)>0)
                        @foreach($parents as $parent)
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 co-12">
                        <!-- iteration start here -->
                            <section class="card card-fluid">
                             <h5 class="card-header drag-handle">{{$parent->parent_name}}
                             
                                               <div class="dd-nodrag btn-group ml-auto">
                                                    <button class="btn btn-sm btn-outline-light" data-toggle="modal" data-target="#parentCategory">Add New Category</button>
                                                    <button class="btn btn-sm btn-outline-light" data-toggle="modal" data-target="#subCategory" cat_id="{{$parent->id}}" id="subCategory{{$parent->id}}">Add Sub Category</button>
                                                    <button class="btn btn-sm btn-outline-light" data-toggle="modal" data-target="#parentCategoryEdit" p_name="{{$parent->parent_name}}" cat_id="{{$parent->id}}" id="btn{{$parent->id}}">Edit</button>
                                                    <button class="btn btn-sm btn-outline-light">
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>
                                                </div>
                              </h5>
                                <div class="dd" id="nestable">
                                    <ol class="dd-list">
                                    @foreach($parent->childs as $child)
                                        <li class="dd-item" data-id="13">
                                            <div class="dd-handle"> <span class="drag-indicator"></span>
                                                <div>{{$child->child_name}}</div>
                                                <div class="dd-nodrag btn-group ml-auto">
                                                   <button class="btn btn-sm btn-outline-light" cat_id="{{$child->id}}" id="productadd{{$child->id}}"  data-toggle="modal" data-target="#productAdd">Add Products</button>
                                                   <button class="btn btn-sm btn-outline-light">View Products</button>
                                                    <button class="btn btn-sm btn-outline-light" data-toggle="modal" data-target="#subCategoryEdit" id="subEdit{{$child->id}}" id_child="{{$child->id}}" child_name="{{$child->child_name}}">Edit</button>
                                                    <button class="btn btn-sm btn-outline-light" data-toggle="modal" data-target="#deleteChild" cat_id="{{$child->id}}" id="deleteIdForChild{{$child->id}}">
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </li>
                                     @endforeach
                                    </ol>
                                </div>
                            </section>
                            <!-- iteration close here -->
                        </div>
                        @endforeach
                        @endif
            </div>



  <!-- Modal for add Parent -->
  <div class="modal fade" id="parentCategory" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">

        <div class="modal-header">
        <h4 class="modal-title">New Category</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
         
               <form method="post" action="{{route('storeparent')}}">
                 @method('post')
                 @csrf
                 <div class="input-group mb-3">
                   <input type="text" class="form-control" name="name">
                     <div class="input-group-append">
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                 </div>
              </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

   <!-- Modal for edit Parent -->
   <div class="modal fade" id="parentCategoryEdit" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">

        <div class="modal-header">
        <h4 class="modal-title">Edit Category</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
         
               <form method="post"action="{{route('updateparent')}}">
                     @method('patch')
                     @csrf
                     <div class="input-group mb-3">
                        <input type="text" class="form-control" name="name" id="parentName">
                        <input type="text" hidden="hidden" class="form-control" name="id" id="parent_id">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </div>
              </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

   <!-- Modal for add Sub Category -->
   <div class="modal fade" id="subCategory" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">

        <div class="modal-header">
        <h4 class="modal-title">Sub Category Adden</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
         
               <form method="post" action="{{route('storechild')}}">
                     @method('post')
                     @csrf
                     <div class="input-group mb-3">
                        <input type="text" class="form-control" name="name">
                        <input type="text" hidden="hidden" class="form-control" name="id" id="parentIdForSub">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </div>
              </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>



   <!-- Modal for update sub Category -->
   <div class="modal fade" id="subCategoryEdit" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">

        <div class="modal-header">
        <h4 class="modal-title">Sub Category Adden</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
         
               <form method="post"action="{{route('updatechild')}}">
                     @method('patch')
                     @csrf
                     <div class="input-group mb-3">
                        <input type="text" class="form-control" name="name" id="subName">
                        <input type="text" hidden="hidden" class="form-control" name="id" id="child_id">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
              </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

  <div class="modal fade" id="deleteChild" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">

        <div class="modal-header">
        <h5>Sub Category Deletion</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
         
               <form method="post" action="{{route('deletechild')}}">
                     @method('delete')
                     @csrf
                     <div class="input-group mb-3">
                     <input type="text" hidden="hidden" name="id" id="idForDelete">
                     <p>Are You Want to Delete that.........?<p>
                    </div>
                    <div class="form-group">
                    <button type="submit" class="btn btn-danger">Yes<button>
                    </div>
              </form>
        </div>
      </div>
    </div>
  </div>



<!-- for product add -->
  <div class="modal fade" id="productAdd" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">

        <div class="modal-header">
        <h4 class="modal-title">Sub Category Adden</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
         
        <form method="post" action="{{route('storeproduct')}}" enctype="multipart/form-data">
              @csrf
                   <div class="input-group mb-3">
                            </div>
                                <span><label>Status Activation:</label>
                                                  <div class="switch-button">
                                                        <input type="checkbox" checked="" name="switch14" id="switch14"><span>
                                                    <label for="switch14"></label></span>
                                                    </div>
                                             </span>

                                            <input type="text" hidden="hidden" name="id" id="childIdForProduct">
                                            <div class="form-group">
                                                <label for="inputText3" class="col-form-label">Item Name:</label>
                                                <input id="inputText3" type="text" class="form-control" name="name">
                                            </div>
                                            <div class="form-group">
                                                <label for="description">Description</label>
                                                <textarea class="form-control" id="description" rows="3" name="description"></textarea>
                                            </div>
                                             <li class="list-group-item">
                                             <label>Image Feature</label>
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
				                                     	<div class="form-group">
				                                     		<label for="color">Color:</label>
				                                     		<input type="text" name="color" class="form-control" id="color">
				                                     	</div>
				                                     	<div class="form-group">
				                                     		<label for="size">Size:</label>
				                                     		<input type="text" name="size" class="form-control">
				                                     	</div>

                                            <div class="form-group">
                                            	<button type="submit" class="btn btn-primary">Add</button>
                                            	<a href="#" class="btn btn-warning">Canel</a>
                                            </div>
                                            </div>
                                            </div>
                                        </form>

        </div>
      </div>
      
    </div>
  </div>





@endsection
@section('scripts')
   <script>
         $(document).ready(function(){
           @foreach($parents as $parent)
             $('#btn{{$parent->id}}').click(function(){
                  $('#parentName').val($(this).attr('p_name'));
                  $('#parent_id').val($(this).attr('cat_id'));
             });
             $('#subCategory{{$parent->id}}').click(function(){
                  $('#parentIdForSub').val($(this).attr('cat_id'));
             });
             @foreach($parent->childs as $child)
               $('#subEdit{{$child->id}}').click(function(){
                   $('#subName').val($(this).attr('child_name'));
                  $('#child_id').val($(this).attr('id_child'));
               });
               $('#productadd{{$child->id}}').click(function(){
                  $('#childIdForProduct').val($(this).attr('cat_id'));
               });
               $('#deleteIdForChild{{$child->id}}').click(function(){
                      $('#idForDelete').val($(this).attr('cat_id')); 
               });
             @endforeach
           @endforeach

       $('#thumbnail').on('change', function() {
       var file = $(this).get(0).files;
       var reader = new FileReader();
       reader.readAsDataURL(file[0]);
       reader.addEventListener("load", function(e) {
       var image = e.target.result;
      $("#imgthumbnail").attr('src', image);
      });
});
         }); 
   </script>
@endsection
