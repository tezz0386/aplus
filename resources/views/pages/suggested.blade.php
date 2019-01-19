@if(isset($suggests) && count($suggests)>0)
  @foreach($suggests as $suggest)
              <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
					<!-- loop start -->
					<!-- Block2 -->
					<div class="block2">
						<div class="block2-pic hov-img0">
							<img src="{{URL::asset('product/'.$suggest->path)}}" alt="IMG-suggest">

							<a href="{{URL::asset('product/'.$suggest->path)}}" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1" p_id="{{$suggest->id}}" price="{{$suggest->price}}" p_name="{{$suggest->p_name}}" description="{{$suggest->description}}" suggest_color="{{$suggest->color}}">
								Quick View
							</a>
						</div>

						<div class="block2-txt flex-w flex-t p-t-14">
							<div class="block2-txt-child1 flex-col-l ">
								<a href="suggest-detail.html" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
									{{$suggest->p_name}}
								</a>
                                <span class="stext-105 cl3">
									Color : {{$suggest->color}}
								</span>
								<span class="stext-105 cl3">
									Rs:{{$suggest->price}}
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
		{{$suggests->onEachSide(5)->links()}}
				<!-- loop end -->
@endforeach
@endif