
<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Bootstrap-ecommerce by Vosidiy">
<title>Squanchy POS</title>
    <!-- jQuery -->
    <!-- Bootstrap4 files-->
    <link href="{{ asset('site/css/bootstrap.css') }}" rel="stylesheet" type="text/css"/> 
    <link href="{{ asset('site/css/ui.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('site/fonts/fontawesome/css/fontawesome-all.min.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ asset('site/css/OverlayScrollbars.css') }}" type="text/css" rel="stylesheet"/>
    <!-- Font awesome 5 -->
    <style>
        .avatar {
    vertical-align: middle;
    width: 35px;
    height: 35px;
    border-radius: 50%;
    }
    .bg-default, .btn-default{
        background-color: #f2f3f8;
    }
    .btn-error{
        color: #ef5f5f;
    }
    </style>
<!-- custom style -->
</head>
<body>
	<section class="header-main">
		<div class="container">
    {{-- top navigation --}}
	<div class="row align-items-center">
		<div class="col-lg-3">
		<div class="brand-wrap">
			<img class="logo" src="{{ asset('site/images/logos/squanchy.jpg') }}">
			<h2 class="logo-text">Squanchy POS</h2>
		</div> <!-- brand-wrap.// -->
		</div>
		<div class="col-lg-6 col-sm-6">
			<form action="#" class="search-wrap">
				<div class="input-group">
					<input type="text" class="form-control" placeholder="Search">
					<div class="input-group-append">
					<button class="btn btn-primary" type="submit">
						<i class="fa fa-search"></i>
					</button>
					</div>
				</div>
			</form> 
		</div> <!-- col.// -->
		<div class="col-lg-3 col-sm-6">
			<div class="widgets-wrap d-flex justify-content-end">
				<div class="widget-header">
					<a href="#" class="icontext">
						<a href="#" class="btn btn-primary m-btn m-btn--icon m-btn--icon-only">
							<i class="fa fa-home"></i>
						</a>
					</a>
				</div> <!-- widget .// -->
				<div class="widget-header dropdown">
					<a href="#" class="ml-3 icontext" data-toggle="dropdown" data-offset="20,10">
						<img src="{{ asset('site/images/avatars/bshbsh.png') }}" class="avatar" alt="">
					</a>
					<div class="dropdown-menu dropdown-menu-right">
							<a class="dropdown-item" href="#"><i class="fa fa-sign-out-alt"></i> Logout</a>
					</div> <!--  dropdown-menu .// -->
				</div> <!-- widget  dropdown.// -->
			</div>	<!-- widgets-wrap.// -->	
		</div> <!-- col.// -->
	</div> <!-- row.// -->
		</div> <!-- container.// -->
	</section>
<!-- ========================= SECTION CONTENT ========================= -->
	<section class="section-content padding-y-sm bg-default ">
		<div class="container-fluid">
		<div class="row">
			<div class="col-md-4">
				<div class="card">
					<span id="cart">
						<table class="table table-hover shopping-cart-wrap">
						<thead class="text-muted">
						<tr>
						<th scope="col">Item</th>
						<th scope="col" width="120">Qty</th>
						<th scope="col" width="120">Price</th>
						<th scope="col" class="text-right" width="200">Delete</th>
						</tr>
						</thead>
						<tbody>
						<tr>
							<td>
						<figure class="media">
							<div class="img-wrap"><img src="{{ asset('site/images/items/1.jpg') }}" class="img-thumbnail img-xs"></div>
							<figcaption class="media-body">
								<h6 class="title text-truncate">Product name </h6>
							</figcaption>
						</figure> 
							</td>
							<td class="text-center"> 
								<div class="m-btn-group m-btn-group--pill btn-group mr-2" role="group" aria-label="..." id="mainDiv">
								<button type="button" class="m-btn btn btn-default" id="minus"><i class="fa fa-minus"></i></button>
								<span id="numberPlace" class="btn btn-default">0</span>
								<button type="button" class="m-btn btn btn-default" id="plus"><i class="fa fa-plus"></i></button>
							</div>
							</td>
							<td> 
								<div class="price-wrap"> 
									<var class="price">$145</var> 
								</div> <!-- price-wrap .// -->
							</td>
							<td class="text-right"> 
							<a href="" class="btn btn-outline-danger"> <i class="fa fa-trash"></i></a>
							</td>
						</tr>
						</tbody>
						</table>
					</span>
				</div> <!-- card.// -->
				<div class="box">
					<dl class="dlist-align">
						<dt>Tax: </dt>
						<dd class="text-right">5%</dd>
					</dl>
					<dl class="dlist-align">
						<dt>Discount:</dt>
						<dd class="text-right"><a href="#">0%</a></dd>
					</dl>
					<dl class="dlist-align">
						<dt>Sub Total:</dt>
						<dd class="text-right">$145</dd>
					</dl>
					<dl class="dlist-align">
						<dt>Total: </dt>
						<dd class="text-right h4 b"> $145 </dd>
					</dl>
					<div class="row">
						<div class="col-md-6">
							<a href="#" class="btn  btn-default btn-error btn-lg btn-block"><i class="fa fa-times-circle "></i> Cancel </a>
						</div>
						<div class="col-md-6">
							<a href="#" class="btn  btn-primary btn-lg btn-block"><i class="fa fa-shopping-bag"></i> Charge </a>
						</div>
					</div>
				</div> <!-- box.// -->
			</div>
            
			<div class="col-md-8 card padding-y-sm card ">
                {{-- category --}}
				<ul class="nav bg radius nav-pills nav-fill mb-3 bg" role="tablist">
					<li class="nav-item">
						<a class="nav-link active show" data-toggle="pill" href="#nav-tab-card">
						<i class="fa fa-tags"></i> All</a></li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="pill" href="#nav-tab-paypal">
						<i class="fa fa-tags "></i>  Category 1</a>
                    </li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="pill" href="#nav-tab-paypal">
						<i class="fa fa-tags "></i>  Category 2</a>
                    </li>
				</ul>
                {{-- Display Items --}}
				<span  id="items">
					<div class="row">
						<div class="col-md-3">
							<figure class="card card-product">
								<span class="badge-new"> NEW </span>
								<div class="img-wrap"> 
									<img src="site/images/items/3.jpg">
									<a class="btn-overlay" href="#"><i class="fa fa-search-plus"></i> Quick view</a>
								</div>
								<figcaption class="info-wrap">
									<a href="#" class="title">Good item name</a>
									<div class="action-wrap">
										<a href="#" class="btn btn-primary btn-sm float-right"> <i class="fa fa-cart-plus"></i> Add </a>
										<div class="price-wrap h5">
											<span class="price-new">$1280</span>
										</div> <!-- price-wrap.// -->
									</div> <!-- action-wrap -->
								</figcaption>
							</figure> <!-- card // -->
						</div> <!-- col // -->
					</div> <!-- row.// -->
				</span>

			</div>
		</div>
	</div><!-- container //  -->
</section>


<script src="{{ asset('site/js/jquery-2.0.0.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('site/js/bootstrap.bundle.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('site/js/OverlayScrollbars.js') }}" type="text/javascript"></script>
<script>
	$(function() {
	//The passed argument has to be at least a empty object or a object with your desired options
	//$("body").overlayScrollbars({ });
	$("#items").height(700);
	$("#items").overlayScrollbars({overflowBehavior : {
		x : "hidden",
		y : "scroll"
	} });
	$("#cart").height(600);
	$("#cart").overlayScrollbars({ });
});
</script>
</body>
</html>