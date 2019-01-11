@extends('admin.dashboard')
@section('content')
  <div class="row">
                    <!-- ============================================================== -->
                    <!-- basic table  -->
                    <!-- ============================================================== -->
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
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
                                                <td>{{$product->status}}</td>
                                                <td>{{$product->child_name}}</td>
                                                <td>{{$product->price}}</td>
                                                <td>{{$product->discount}}</td>
                                                <td>{{$product->qty}}</td>
                                                <td>{{$product->color}}</td>
                                                <td>{{$product->size}}</td>
                                                <td>{{$product->available_qty}}</td>
                                                <td><a href="{{route('showproduct', $product->id)}}">Edit</a></td>
                                                <td>
                                                    <a href="#" onclick="trashProduct()">Trash</a>
                                                   
                                                </td>
                                                <td>
                                                    <a href="#" onclick="deleteMethod()">Remove</a>
                                                   
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

                 <script type="text/javascript">
                    function deleteMethod(){
                        // if(confirm('Are you want to remove...................?')){
                        //      event.preventDefault();
                        //     document.getElementById('delete-form').submit();
                        // }
                    }
                </script>
@endsection