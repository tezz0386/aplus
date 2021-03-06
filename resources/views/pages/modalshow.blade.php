<div class="wrap-modal1 js-modal1 p-t-60 p-b-20">
		<div class="overlay-modal1 js-hide-modal1"></div>

		<div class="container">
			<div class="bg0 p-t-60 p-b-30 p-lr-15-lg how-pos3-parent">
				<button class="how-pos3 hov3 trans-04 js-hide-modal1">
					<img src="{{URL::asset('images/icons/icon-close.png')}}" alt="CLOSE">
				</button>
				<div class="row">
					<div class="col-md-6 col-lg-7 p-b-30">
						<div class="p-l-25 p-r-30 p-lr-0-lg">
							<div class="wrap-slick3 flex-sb flex-w">
								<div class="wrap-slick3-dots"></div>
								<div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

								<div class="slick3 gallery-lb">
									<div class="item-slick3" id="myThumb" data-thumb="">
										<div class="wrap-pic-w pos-relative">
											<img src="#" id="my_image" alt="IMG-PRODUCT">
											<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" id="imageShow" href="">
												<i class="fa fa-expand"></i>
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="col-md-6 col-lg-5 p-b-30">
						<div class="p-r-50 p-t-5 p-lr-0-lg">
							<h4 class="mtext-105 cl2 js-name-detail p-b-14" id="product_name">
								
							</h4>
                            <span class="mtext-106 cl2" id="product_color">
								
							</span><br>
							<span class="mtext-106 cl2" id="product_price">
								
							</span>

							<p class="stext-102 cl3 p-t-23" id="description">
								
							</p>
							
							<!--  -->
							<div class="p-t-33">
								

							
                            <br><br><br><br>
							<br><br><br><br>
							<br><br><br><br>
								<div class="flex-w flex-r-m p-b-10">
									<div class="size-204 flex-w flex-m respon6-next">
										

										<button class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail" product_id="">
											Add to cart
										</button>
									</div>
								</div>	
							</div>

							<!--  -->
							<div class="flex-w flex-m p-l-100 p-t-40 respon7">
								<div class="flex-m bor9 p-r-10 m-r-11">
									<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 js-addwish-detail tooltip100" data-tooltip="Add to Wishlist">
										<i class="zmdi zmdi-favorite"></i>
									</a>
								</div>

								<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Facebook">
									<i class="fa fa-facebook"></i>
								</a>

								<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Twitter">
									<i class="fa fa-twitter"></i>
								</a>

								<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Google Plus">
									<i class="fa fa-google-plus"></i>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
</div>
@section('scriptsForCart')
<script type="text/javascript">
	$(document).ready(function(){
		//for save the data
       $('.js-addcart-detail').click(function(){
           var p_id=$(this).attr('product_id');
          // var u_id=$(this).attr('product_id');
           $.ajax({
           	// url:"php/cart.php",
           	url:"{{route('addToCart')}}",
           	type:"post",
           	async:true,
           	data: {
           		"_token":"{{ csrf_token() }}",
           		"p_id":p_id,
                dataType: 'JSON'
           	},
           	success: function(data){
              $('.js-show-cart').attr('data-notify', data);
           	}
          })
        });

    //    $('.js-show-cart').click(function(){
    //            $.ajax({
    //            	url:"{{route('showCart')}}",
    //            	type:"post",
    //            	async:true,
    //            	data:{
    //                "_token":"{{ csrf_token() }}",
    //                "dataType":'JSON'
    //            	},
    //            	sucess: function(data){
    //            		console.log('hello');
    //            	}
    //          })
    //    });
	});
</script>
@endsection