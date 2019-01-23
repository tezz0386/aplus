@extends('main.navbar')
@section('content')
	<!-- Cart -->
	<br>
	<br>
	<br>
	<!-- Shoping Cart -->
	@if(Session::has('cart'))
	<form class="bg0 p-t-75 p-b-85" method="post" action="{{route('checkout')}}">
		@method('post')
		@csrf
		<div class="container">
			<div class="row">
				<div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
					<div class="m-l-25 m-r--38 m-lr-0-xl">
						<div class="wrap-table-shopping-cart">
							<table class="table-shopping-cart">
								<tr class="table_head">
									<th class="column-1">Product</th>
									<th class="column-2"></th>
									<th class="column-3">Price</th>
									<th class="column-4">Quantity</th>
									<th class="column-5">Total</th>
								</tr>
                                @foreach($products as $product)
								<tr class="table_row">
									<td class="column-1">
										<div class="how-itemcart1">
											<img src="{{URL::asset('product/'.$product['item']['path'])}}" alt="IMG">
										</div>
									</td>
									<td class="column-2">{{$product['item']['p_name']}}</td>
									<td class="column-3">RS: {{$product['item']['price']}}</td>
									<td class="column-4">
										<div class="wrap-num-product flex-w m-l-auto m-r-0">
											<div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m" id="minusUpdate{{$product['item']['id']}}">
												<i class="fs-16 zmdi zmdi-minus"></i>
											</div>
											
											<input class="mtext-104 cl3 txt-center num-product" type="number" name="Num{{$product['item']['p_name']}}" value="{{$product['qty']}}" id="myUpdate{{$product['item']['id']}}" p_id="{{$product['item']['id']}}">

											<div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m" id="plusUpdate{{$product['item']['id']}}">
												<i class="fs-16 zmdi zmdi-plus"></i>
											</div>
										</div>
									</td>
									<td class="column-5">RS: {{$product['price']}}</td>
								</tr>
							   @endforeach
							</table>
						</div>

						<div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
							<div class="flex-w flex-m m-r-20 m-tb-5">  
						      
							</div>
						</div>
					</div>
				</div>

				<div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
					<div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
						<h4 class="mtext-109 cl2 p-b-30">
							Cart Totals
						</h4>

					

					

						<div class="flex-w flex-t p-t-27 p-b-33">
							<div class="size-208">
								<span class="mtext-101 cl2">
									Total:
								</span>
							</div>

							<div class="size-209 p-t-1">
								<span class="mtext-110 cl2">
									RS: {{$totalPrice}}
								</span>
							</div>
						</div>
                          <!-- <div class="form-group">
						       	   <select name="method" class="form-control custom-select">
						      	       <option hidden="hidden">Choose Payment Method</option>
									   <option value="1">Cash On Delivery</option>
						      	       <option value="2">Card</option>
						      	       <option value="3">Fund Trasnfer</option>
						      	       <option value="4">Other</option>
						            </select>
						    </div> -->
						<button type="submit" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
							Proceed to Checkout
						</button>
					</div>
				</div>
			</div>
		</div>
	</form>
	<style type="text/css">
		.form-group input{
			margin-top: -10px;
		}
	</style>
	@endif
	@endsection	
@section('scriptsForCart')
<script>
$(document).ready(function(){
	@foreach($products as $product)
         $('#minusUpdate{{$product['item']['id']}}').click(function(){
             var qty=$('#myUpdate{{$product['item']['id']}}').val();
			 var p_id=$('#myUpdate{{$product['item']['id']}}').attr('p_id');
			//  alert(qty);
               $.ajax({
               	url:"{{route('user.updateCart')}}",
               	type:"post",
               	async:true,
               	data:{
					"p_id":p_id,
					"qty":qty,
                   "_token":"{{ csrf_token() }}",
                   "dataType":'JSON'
               	},
               	sucess: function(data){
					// $('.js-show-cart').attr('data-notify', data);
               	}
             })
			 
		 });
		 $('#plusUpdate{{$product['item']['id']}}').click(function(){
			var qty=$('#myUpdate{{$product['item']['id']}}').val();
			var p_id=$('#myUpdate{{$product['item']['id']}}').attr('p_id');
			//  alert(p_id);
			 $.ajax({
               	url:"{{route('addToCart')}}",
               	type:"post",
               	async:true,
               	data:{
					"p_id":p_id,
					"qty":qty,
                   "_token":"{{ csrf_token() }}",
                   "dataType":'JSON'
               	},
               	sucess: function(data){
					// $('.flex-r-m .js-show-cart').attr('data-notify', data);
					// console.log(data);
               	}
             })
		 });
    @endforeach     
});
</script>
@endsection
	