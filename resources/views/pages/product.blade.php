  @if(isset($products) && count($products)>0)
  @foreach($products as $product)
              <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
					<!-- loop start -->
					<!-- Block2 -->
					<div class="block2">
						<div class="block2-pic hov-img0">
							<img src="{{URL::asset('product/'.$product->path)}}" alt="IMG-PRODUCT">

							<a href="{{URL::asset('product/'.$product->path)}}" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1" p_id="{{$product->id}}" price="{{$product->price}}" p_name="{{$product->p_name}}" description="{{$product->description}}" product_color="{{$product->color}}">
								Quick View
							</a>
						</div>

						<div class="block2-txt flex-w flex-t p-t-14">
							<div class="block2-txt-child1 flex-col-l ">
								<a href="product-detail.html" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
									{{$product->p_name}}
								</a>
                                <span class="stext-105 cl3">
									Color : {{$product->color}}
								</span>
								<span class="stext-105 cl3">
									Rs:{{$product->price}}
								</span>
							</div>

							<div class="block2-txt-child2 flex-r p-t-3">
								<a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
									<img class="icon-heart1 dis-block trans-04" src="{{URL::asset('images/icons/icon-heart-01.png')}}" alt="ICON">
									<img class="icon-heart2 dis-block trans-04 ab-t-l" src="{{URL::asset('images/icons/icon-heart-02.png')}}" alt="ICON">
								</a>
							</div>
						</div>
						@include('pages.modalshow')
					</div>
				</div>
		{{$products->onEachSide(5)->links()}}
				<!-- loop end -->
@endforeach
@endif
@section('scripts')
 <script type="text/javascript">
 	 $(document).ready(function(){
         $('.block2-btn').click(function(){
         	var product_name=$(this).attr('p_name');
         	var price=$(this).attr('price');
			var product_color=$(this).attr('product_color');
         	var description=$(this).attr('description');
			$('.wrap-modal1 #my_image').attr('src', $(this).attr('href'));
			$('.wrap-modal1 #myThumb').attr('data-thumb', $(this).attr('href'));
			$('.wrap-modal1 #imageShow').attr('href', $(this).attr('href'));
         	$('.wrap-modal1 .js-addcart-detail').attr('product_id', $(this).attr('p_id'));
         	$(".wrap-modal1 #product_name").html(product_name);
         	$(".wrap-modal1 #product_price").html("RS: "+price);
			 $(".wrap-modal1 #product_color").html("Color: "+product_color);
         	$(".wrap-modal1 #description").html(description);
         });
     });
 </script>
@endsection