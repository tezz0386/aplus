@extends('main.navbar')
@section('content')
		

	<!-- Slider -->
	 @include('pages.sidebarCrusial')
	 @include('partial.sucess')

	<!-- Banner -->
    @include('pages.firstSection')

	<!-- Product -->
	<section class="bg0 p-t-23 p-b-140">
		<div class="container">
			<div class="p-b-10">
				<h3 class="ltext-103 cl5">
					Product Overview
				</h3>
			</div>

			<div class="flex-w flex-sb-m p-b-52">
				<div class="flex-w flex-l-m filter-tope-group m-tb-10">
					 <a href="{{route('/')}}" class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5">
                    	All Products
                    </a>
					@if(isset($parents) && count($parents)>0)
                    @foreach($parents as $parent)
                    @foreach($parent->childs as $child)
                    <a href="{{route('viewInformation', $child->child_name)}}" class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5">
                    	{{$child->child_name}}
                    </a>
                    @endforeach
                    @endforeach
                    @endif
				</div>

				<!-- filter and search include -->
				@include('pages.filter')
			</div>

			<div class="row isotope-grid">
				@include('pages.product')
			</div>
			<!-- Load more -->
			<div class="flex-c-m flex-w w-full p-t-45">
				<a href="#" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
					Load More
				</a>
			</div>
		</div>
	</section>

@endsection


	