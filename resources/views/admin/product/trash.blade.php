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
                                                <td>
                                                      <a href="#" id="recover{{$product->id}}" p_id="{{$product->id}}" data-toggle="modal" data-target="#recoverProduct">Recover</a>
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



<!-- for remove -->
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

@endsection
@section('scripts')
<script>
     $(document).ready(function(){
        @foreach($products as $product)
         $('#delete{{$product->id}}').click(function(){
            $('#idForDelete').val($(this).attr('p_id'));
         });
         $('#recover{{$product->id}}').click(function(){
            $('#idForRecover').val($(this).attr('p_id'));
         });
         @endforeach
     })
</script>
@endsection