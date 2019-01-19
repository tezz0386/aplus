@extends('admin.dashboard')
@section('content')
<div class="container-fluid dashboard-content">
                <!-- ============================================================== -->
               
                <div class="dashboard-short-list">
                    <div class="row">
    
                    @foreach($orders as $order)
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 co-12">
                            <section class="card card-fluid">
                                <h5 class="card-header drag-handle">Transaction Details</h5>
                                <div class="dd" id="nestable2">
                                @foreach($order->cart->items as $item)
                                    <ol class="dd-list">
                                         <li class="dd-item" data-id="13">
                                            <div class="dd-handle"> <span class=""></span>
                                                <div>Product Name:  {{$item['item']['p_name']}}<img src="{{URL::asset('product/'.$item['item']['path'])}}" width="30" height="40">  </div>
                                            </div>
                                        </li>
                                        <li class="dd-item" data-id="13">
                                            <div class="dd-handle"> <span class=""></span>
                                                <div>Sold Qty: {{$item['qty']}} At RS {{$item['item']['price']}}</div>
                                            </div>
                                        </li>
                                        <li class="dd-item" data-id="13">
                                            <div class="dd-handle"> <span class=""></span>
                                                <div>Income Rs: {{$item['price']}}</div>
                                            </div>
                                        </li>
                                        <br>
                                    </ol>
                                    @endforeach
                                </div>
                            </section>
                            <h5>Total Qty Sold: {{$order->cart->totalQty}} </h5>
                            <h5>Total Sold Rs: {{$order->cart->totalPrice}} </h5>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 co-12">
                            <section class="card card-fluid">
                                <h5 class="card-header drag-handle">Consumer Details</h5>
                                <div class="dd" id="nestable">
                                    <ol class="dd-list">
                                        <li class="dd-item" data-id="13">
                                            <div class="dd-handle"> <span class="drag-indicator"></span>
                                                <div>Sold To: {{$order->name}}</div>
                                            </div>
                                        </li>
                                        <li class="dd-item" data-id="13">
                                            <div class="dd-handle"> <span class="drag-indicator"></span>
                                            <div>Phone No: {{$order->contact}}</div>
                                            </div>
                                        </li>
                                        <li class="dd-item" data-id="13">
                                            <div class="dd-handle"> <span class="drag-indicator"></span>
                                            <div>Delivered Address: {{$order->address}}</div>
                                            </div>
                                        </li>
                                    </ol>
                                </div>
                            </section>
                        </div>
                    @endforeach
                    </div>
                    <!-- ============================================================== -->
                    <!-- end nestable list  -->
                    <!-- ============================================================== -->
                </div>
            </div>
@endsection