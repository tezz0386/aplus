@extends('main.navbar')
@section('content')
<br><br><br><br><br><br>
<div class="container">
    <div class="row">
       <div class="col-md-1"></div>
       <div class="col-md-10">
            <div class="list-group">
            @foreach($orders as $order)
            <li class="list-group-item">
            <div class="container">
                <div class="row">
                    <div class="col-md-5">Transaction Date : {{$order->created_at}}</div>
                    <div class="col-md-3"></div>
                    <div class="col-md-4">
                          @if($order->status=='on')
                            Dalivered Date : {{$order->updated_at}}
                          @endif
                    </div>
                </div>
            </div>
            </li>
            @foreach($order->cart->items as $item)
              <li class="list-group-item">
              <div class="container">
                <div class="row">
                 <div class="col-md-3">Product Name:  {{ $item['item']['p_name'] }}</div>
                 <div class="col-md-3">{{ $item['qty'] }} X  {{ $item['item']['price'] }}</div>
                 <div class="col-md-3">Rs: {{ $item['price'] }}</div>
                  <div class="col-md-3"> 
                  Status:
                    @if($order->status=='off')  
                       Not Delivered
                    @else
                        Delivered 
                    @endif 
                 </div>
               </div>
               </div>
              </li>
            @endforeach
            <li class="list-group-item">
                Total RS: {{$order->cart->totalPrice}}
            </li>
            <br>
            @endforeach
        </div>
       </div>
       <div class="col-md-1"></div>
    </div>
</div>
<br><br><br><br><br><br>
@endsection