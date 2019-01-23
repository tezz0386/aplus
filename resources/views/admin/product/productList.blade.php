@extends('admin.dashboard')
@section('content')
  <div class="row">
                    <!-- ============================================================== -->
                    <!-- basic table  -->
                    <!-- ============================================================== -->
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <a href="{{route('createProduct')}}" class="btn btn-primary btn-sm">Add Product</a>
                        <div class="card">
                        <input type="text" name="search" style="border-radius: 10px;" placeholder="Search here...............">
                            <h5 class="card-header">Product Table:</h5>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered first">
                                       <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Item Name</th>
                                                <th>Status</th>
                                                <th>Belongs To</th>
                                                <th>price</th>
                                                <th>Discount</th>
                                                <th>Qty</th>
                                                <th>Color</th>
                                                <th>Size</th>
                                                <th>Available_qty</th>
                                                <th colspan="3">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                         @if(isset($products) && count($products)>0)
                                         @foreach($products as $product)
                                            <tr>
                                                <td>{{$product->id}}</td>
                                                <td>{{$product->p_name}}</td>
                                                <td>
                                                  @if($product->status=='on')
                                                  Active
                                                  @else
                                                  Deactive
                                                  @endif
                                                </td>
                                                <td>{{$product->child_name}}</td>
                                                <td>{{$product->price}}</td>
                                                <td>{{$product->discount}}</td>
                                                <td>{{$product->qty}}</td>
                                                <td>{{$product->color}}</td>
                                                <td>{{$product->size}}</td>
                                                <td>{{$product->available_qty}}</td>
                                                <td><button class="btn btn-link" data-toggle="modal" data-target="#editProduct"
                                                id="edit{{$product->id}}" p_id="{{$product->id}}" p_name="{{$product->p_name}}" p_price="{{$product->price}}"
                                                p_discount="{{$product->discount}}" p_qty="{{$product->qty}}" p_color="{{$product->color}}" p_size="{{$product->size}}"
                                                p_available_qty="{{$product->available_qty}}" p_description="{{$product->description}}"  href="{{URL::asset('product/'.$product->path)}}"  
                                                >Edit</button></td>
                                                <td> 
                                                      @if($product->status=='on')
                                                     <a href="#" id="trash{{$product->id}}" p_id="{{$product->id}}" data-toggle="modal" data-target="#trashProduct">Trash</a>  
                                                      @else
                                                      <a href="#" id="recover{{$product->id}}" p_id="{{$product->id}}" data-toggle="modal" data-target="#recoverProduct">Recover</a> 
                                                      @endif
                                                </td>
                                                <td>
                                                   <a href="#" id="delete{{$product->id}}" p_id="{{$product->id}}" data-toggle="modal" data-target="#deleteProduct">Remove</a>    
                                                </td>
                                            </tr>
                                            @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                                {{$products->onEachSide(4)}}
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end basic table  -->
                    <!-- ============================================================== -->
                </div>

<!-- modal for trash -->


<div id="trashProduct" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
      <h4 class="modal-title">Trash Now</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
         <form action="{{route('product.trash')}}" method="post">
            @method('patch')
            @csrf
            <input type="text" hidden="hidden" id="idForTrash" name="id">
            <p> Are You Sure Trash This Item......?</p>
            <button type="submit" class="btn btn-warning btn-sm">OK</button>
         </form>
      </div>
    </div>

  </div>
</div>

<!-- modal for recover -->
<div id="recoverProduct" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
      <h4 class="modal-title">Recover Now</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
         <form action="{{route('product.recover')}}" method="post">
            @method('patch')
            @csrf
            <input type="text" hidden="hidden" id="idForRecover" name="id">
            <p> Are You Sure Trash This Item......?</p>
            <button type="submit" class="btn btn-warning btn-sm">OK</button>
         </form>
      </div>
    </div>

  </div>
</div>

<!-- modal for delete -->

<div id="deleteProduct" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
      <h4 class="modal-title">Delete Now</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
         <form action="{{route('product.delete')}}" method="post">
            @method('delete')
            @csrf
            <input type="text" hidden="hidden" id="idForDelete" name="id">
            <p> Are You Sure Delete This Item......?</p>
            <button type="submit" class="btn btn-warning btn-sm">OK</button>
         </form>
      </div>
    </div>

  </div>
</div>

<!-- for product edit modal -->
<div class="modal fade" id="editProduct" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">

        <div class="modal-header">
        <h4 class="modal-title">Product Edit</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
         
        <form method="post" enctype="multipart/form-data" action="{{route('updateproduct')}}">
            @csrf
            @method('patch')

                                            <span><label>Status Activation:</label>
                                                  <div class="switch-button">
                                                        <input type="checkbox" checked="" name="switch14" id="switch14"><span>
                                                    <label for="switch14"></label></span>
                                                    </div>
                                             </span>

                                            <input type="text" hidden="hidden" id="idForProduct" name="id">
                                            <div class="form-group">
                                                <label for="nameProduct" class="col-form-label">Item Name:</label>
                                                <input type="text" class="form-control" name="p_name" id="nameProduct">
                                            </div>
                                            <div class="form-group">
                                                <label for="description">Description</label>
                                                <textarea class="form-control" id="description" rows="3" name="description"></textarea>
                                            </div>
                                             <li class="list-group-item">
                                                  <label>Image Feature</label>
				                                     <div class="img-thumbnail  text-center">
				                                     	<img
                                                         src="{{$product->path}}"
                                                         id="imgthumbnail" class="img-fluid" alt="Image not found">
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
                                                <input type="number" class="form-control" name="qty" id="qty">
                                                <div class="input-group-append"><span class="input-group-text">.00</span></div>
                                            </div>
                                            </div>
                    </div>

                                        
				                                     	<div class="form-group">
                                                         <label>Other Feature</label>
				                                     		<label for="color">Color:</label>
				                                     		<input type="text" name="color" class="form-control" id="color">
				                                     	</div>
				                                     	<div class="form-group">
				                                     		<label for="size">Size:</label>
				                                     		<input type="text" name="size" class="form-control" id="size">
				                                     	</div>
                                             <div class="form-group">
                                                <label for="available_qty">Available Qty:</label>
                                                <div class="input-group mb-3">
                                                <input type="number" class="form-control" name="available_qty" id="available_qty">
                                                <div class="input-group-append"><span class="input-group-text">.00</span></div>
                                            </div>
                                            </div>
                                            <div class="form-group">
                                            	<button type="submit" class="btn btn-primary">Update</button>
                                            	<a href="#" class="btn btn-warning">Canel</a>
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
        @foreach($products as $product)
         $('#edit{{$product->id}}').click(function(){
              $('#idForProduct').val($(this).attr('p_id'));
              $('#nameProduct').val($(this).attr('p_name'));
              $('#qty').val($(this).attr('p_qty'));
              $('#price').val($(this).attr('p_price'));
              $('#description').val($(this).attr('p_description'));
              $('#available_qty').val($(this).attr('p_available_qty'));
              $('#imgthumbnail').attr('src', $(this).attr('href'));
              $('#color').val($(this).attr('p_color'));
              $('#size').val($(this).attr('p_size'));
              $('#discount').val($(this).attr('p_discount'));
         });
         $('#trash{{$product->id}}').click(function(){
            $('#idForTrash').val($(this).attr('p_id'));
         });
         $('#delete{{$product->id}}').click(function(){
            $('#idForDelete').val($(this).attr('p_id'));
         });
         $('#recover{{$product->id}}').click(function(){
            $('#idForRecover').val($(this).attr('p_id'));
         });
         @endforeach
     })
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