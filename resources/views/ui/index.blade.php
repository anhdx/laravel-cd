@extends('layouts.client')
@section('content')


	<div class="fullwidthbanner-container">
					<div class="fullwidthbanner">
						<div class="bannercontainer" >
					    <div class="banner" >
								<ul>

	@if(Session::has('status'))
		<span class="alert alert-success">{{Session::get('status')}}</span>
	@endif
	@foreach($slide as $slides)

<li data-transition="boxfade" data-slotamount="20" class="active-revslide current-sr-slide-visible" style="width: 100%; height: 100%; overflow: hidden; visibility: inherit; opacity: 1; z-index: 20;">
    <div class="slotholder" style="width:100%;height:100%;" data-duration="undefined" data-zoomstart="undefined" data-zoomend="undefined" data-rotationstart="undefined" data-rotationend="undefined" data-ease="undefined" data-bgpositionend="undefined" data-bgposition="undefined" data-kenburns="undefined" data-easeme="undefined" data-bgfit="undefined" data-bgfitend="undefined" data-owidth="undefined" data-oheight="undefined">
	<div class="tp-bgimg defaultimg" data-lazyload="undefined" data-bgfit="cover" data-bgposition="center center" data-bgrepeat="no-repeat" data-lazydone="undefined" src="source/image/slide/{{$slides->image}}" data-src="source/image/slide/{{$slides->image}}" style="background-color: rgba(0, 0, 0, 0); background-repeat: no-repeat; background-image: url('source/image/slide/{{$slides->image}}'); background-size: cover; background-position: center center; width: 100%; height: 100%; opacity: 1; visibility: inherit;">
												</div>
											</div>

						        </li>
						        @endforeach
								</ul>
							</div>
						</div>

						<div class="tp-bannertimer"></div>
					</div>
			
				<!--slider-->
	</div>
	<div class="container">
		<div id="content" class="space-top-none">
			<div class="main-content">
				<div class="space60">&nbsp;</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="beta-products-list">
							<h4>New Products</h4>
							<div class="beta-products-details">
								<p class="pull-left">{{count($p)}} Product found</p>
								<div class="clearfix"></div>
							</div>

							<div class="row">
								@foreach($p as $products)
								<div class="col-sm-3">
									<div class="single-item">
										<div class="single-item-header">
											<a href="{{route('detail',$products->id)}}"><img src="source/image/product/{{$products->image}}" alt=""></a>
										</div>
										<div class="single-item-body">
											<p class="single-item-title">{{$products->name}}</p>
											<p class="single-item-price">
												<span>{{number_format($products->unit_price) }} VND </span>
											</p>
										</div>
										<div class="single-item-caption">
											<a class="add-to-cart pull-left" href="{{route('addToCart',$products->id)}}"><i class="fa fa-shopping-cart"></i></a>
											<a class="beta-btn primary" href="{{route('detail',$products->id)}}">Details <i class="fa fa-chevron-right"></i></a>
											<div class="clearfix"></div>
										</div>
									</div>
								</div>
								@endforeach
							</div>
						</div> <!-- .beta-products-list -->

						<div class="space50">&nbsp;</div>

						<div class="beta-products-list">
							<h4>Top Products</h4>
							<div class="beta-products-details">
								<p class="pull-left">{{count($product)}} Product found</p>
								<div class="clearfix"></div>
							</div>
							
							<div class="space40">&nbsp;</div>
							<div class="row">
								@foreach($product as $productSale )
								<div class="col-sm-3 margin">
									<div class="single-item">
										@if($productSale->promotion_price!=0 && $productSale->unit_price!=$productSale->promotion_price )
										<div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
										@endif
										<div class="single-item-header">
											<a href="{{route('detail',$productSale->id)}}"><img src="source/image/product/{{$productSale->image}}" alt=""></a>
										</div>
										<div class="single-item-body">
											<p class="single-item-title">{{$productSale->name}}</p>
											<p class="single-item-price">
												@if($productSale->unit_price==$productSale->promotion_price ||$productSale->promotion_price==0)
												
												<span class="flash-sale">{{number_format($productSale->unit_price)}}VND</span>

												@else
													<span class="flash-del">{{number_format($productSale->unit_price) }} VND</span>
												<span class="flash-sale">{{number_format($productSale->promotion_price) }} VND</span>

												@endif
											</p>
										</div>
										<div class="single-item-caption">
											<a class="add-to-cart pull-left" href="{{route('addToCart',$productSale->id)}}"><i class="fa fa-shopping-cart"></i></a>
											<a class="beta-btn primary" href="{{route('detail',$productSale->id)}}">Details <i class="fa fa-chevron-right"></i></a>
											<div class="clearfix"></div>
										</div>
									</div>
								</div>

								@endforeach
							</div>
							<div class="row">{{$product->links()}}</div>
						</div> <!-- .beta-products-list -->
					</div>
				</div> <!-- end section with sidebar and main content -->


			</div> <!-- .main-content -->
		</div> <!-- #content -->
	</div> <!-- .container -->


	@endsection