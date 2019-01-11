@extends('admin.dashboard')
@section('content')
<div class="container-fluid dashboard-content">
                <!-- ============================================================== -->
               
                <div class="dashboard-short-list">
                    <div class="row">
                    @if(isset($orders))
                    @foreach($orders as $order)
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 co-12">
                            <section class="card card-fluid">
                                <h5 class="card-header drag-handle">User Details</h5>
                                <div class="dd" id="nestable">
                                    <ol class="dd-list">
                                        <li class="dd-item" data-id="13">
                                            <div class="dd-handle"> <span class="drag-indicator"></span>
                                                <div>User Email: {{$order->user->email}}</div>
                                            </div>
                                        </li>
                                        <li class="dd-item" data-id="2"><button data-action="collapse" type="button">Collapse</button><button data-action="expand" type="button" style="display: none;">Expand</button>
                                            <div class="dd-handle"> <span class="drag-indicator"></span>
                                                <div>Customer Name: {{$order->name}}</div>
                                            </div>
                                        </li>
                                        <li class="dd-item" data-id="2"><button data-action="collapse" type="button">Collapse</button><button data-action="expand" type="button" style="display: none;">Expand</button>
                                            <div class="dd-handle"> <span class="drag-indicator"></span>
                                                <div>Card Holder Name: {{$order->card_holder_name}}</div>
                                            </div>
                                        </li>
                                        <li class="dd-item" data-id="2"><button data-action="collapse" type="button">Collapse</button><button data-action="expand" type="button" style="display: none;">Expand</button>
                                            <div class="dd-handle"> <span class="drag-indicator"></span>
                                                <div>Address To Be Shiped: {{$order->address}}</div>
                                            </div>
                                        </li>
                                    </ol>
                                </div>
                            </section>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 co-12">
                            <section class="card card-fluid">
                                <h5 class="card-header drag-handle">Product Details</h5>
                                <div class="dd" id="nestable2">
                                    <ol class="dd-list">
                                    @foreach($order->cart->items as $item)
                                    <h5>Product Name: {{$item['item']['p_name']}}</h5>
                                    <li class="dd-item" data-id="13">
                                            <div class="dd-handle"> <span class="drag-indicator"></span>
                                                <div> Product Price: {{$item['item']['price']}} </div>
                                            </div>
                                        </li>
                                        <li class="dd-item" data-id="13">
                                            <div class="dd-handle"> <span class="drag-indicator"></span>
                                                <div> Registered Date: {{$item['item']['created_at']}} </div>
                                            </div>
                                        </li>
                                        <li class="dd-item" data-id="13">
                                            <div class="dd-handle"> <span class="drag-indicator"></span>
                                                <div> Registered Qty: {{$item['item']['qty']}} </div>
                                            </div>
                                        </li>
                                    @endforeach   
                                    </ol>
                                </div>
                            </section>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 co-12">
                            <section class="card card-fluid">
                                <h5 class="card-header drag-handle">Orders Details</h5>
                                <div class="dd" id="nestable2">
                                    <ol class="dd-list">
                                    @foreach($order->cart->items as $item)
                                         <li class="dd-item" data-id="13">
                                            <div class="dd-handle"> <span class=""></span>
                                                <div>Product Name: {{$item['item']['p_name']}} <img src="{{URL::asset('product/'.$item['item']['path'])}}" width="30" height="40">  </div>
                                            </div>
                                        </li>
                                        <li class="dd-item" data-id="13">
                                            <div class="dd-handle"> <span class="drag-indicator"></span>
                                                <div> Order Date: {{$order->created_at}}  </div>
                                            </div>
                                        </li>
                                        <li class="dd-item" data-id="13">
                                            <div class="dd-handle"> <span class="drag-indicator"></span>
                                                <div> Order Qty: {{$item['qty']}}  </div>
                                            </div>
                                        </li>
                                        <li class="dd-item" data-id="13">
                                            <div class="dd-handle"> <span class="drag-indicator"></span>
                                                <div> RS : {{$item['item']['price']}} /Unit</div>
                                            </div>
                                        </li>
                                        <li class="dd-item" data-id="13">
                                            <div class="dd-handle"> <span class="drag-indicator"></span>
                                                <div> Price RS: {{$item['price']}}  </div>
                                            </div>
                                        </li>
                                        
                                    @endforeach
                                        <h5>Total...............<h5>
                                        <li class="dd-item" data-id="13">
                                            <div class="dd-handle"> <span class="drag-indicator"></span>
                                                <div> Total Qty: {{$order->cart->totalQty}}  </div>
                                            </div>
                                        </li>
                                        <li class="dd-item" data-id="13">
                                            <div class="dd-handle"> <span class="drag-indicator"></span>
                                                <div> Total Price RS:  {{$order->cart->totalPrice}} </div>
                                            </div>
                                        </li>
                                                   <br>
                                                  <div class="dd-nodrag btn-group ml-auto">
                                                    <a class="btn btn-sm btn-outline-light" href="#">Send Notification</a>
                                                    <button class="btn btn-sm btn-outline-light"><a href="{{route('admin.order.deliver', $order->id)}}">@if($order->status=='on') {{'Delivered'}} @else Deliver  @endif</a></button>
                                                    <a href="{{route('admin.order.trash.now', $order->id)}}" class="btn btn-sm btn-outline-light">
                                                        <i class="far fa-trash-alt"></i>
                                                    </a>
                                                </div>
                                    </ol>
                                </div>
                            </section>
                        </div>
                    @endforeach
                    @endif
                    </div>
                    <!-- ============================================================== -->
                    <!-- end nestable list  -->
                    <!-- ============================================================== -->
                </div>
            </div>
@endsection
