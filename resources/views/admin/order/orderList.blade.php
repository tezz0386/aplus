@extends('admin.dashboard')
@section('content')
<div class="row">
                    <!-- ============================================================== -->
                    <!-- basic table  -->
                    <!-- ============================================================== -->
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <input type="text" name="search" style="border-radius: 10px;" placeholder="Search here...............">
                            <h5 class="card-header">Category Table</h5>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                      @if(isset($orders)&&count($orders)>0)
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>User Email</th>
                                                <th>Customer Name</th>
                                                <th>Card Holder</th>
                                                <th>Delivery Address</th>
                                                <th>Status</th>
                                                <th colspan="5">Action</th>
                                            </tr>
                                        </thead>
                                        @endif
                                        <tbody>
                                            @if(isset($orders)&&count($orders)>0)
                                            @foreach($orders as $order)
                                             <tr>
                                                <td>{{$order->id}}</td>
                                                <td>{{$order->user->email}}</td>
                                                <td>{{$order->name}}</td>
                                                <td>{{$order->card_holder_name}}</td>
                                                <td>{{$order->address}}</td>
                                                <td>
                                                 @if($order->status=='on')
                                                     Delivered
                                                 @else
                                                     Not Delivered
                                                 @endif
                                                <td>
                                                <td><a href="{{route('admin.order.details', $order->id)}}">view Details</a><td>
                                                <td><a href="{{route('admin.order.trash', $order->id)}}">
                                                @if($order->trash=='off')
                                                Trash
                                                @else
                                                Recover
                                                @endif
                                                </a><td>
                                            </tr>
                                            @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        {{$orders->links()}}
                    </div>
                    <!-- ============================================================== -->
                    <!-- end basic table  -->
                    <!-- ============================================================== -->
                </div>      
@endsection
@section('scripts')
     
@endsection