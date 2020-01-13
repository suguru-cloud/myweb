<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>劇場一覧</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Free HTML5 Template by FREEHTML5.CO" />
	<meta name="keywords" content="free html5, free template, free bootstrap, html5, css3, mobile first, responsive" />
	<meta name="author" content="FREEHTML5.CO" />

  <!-- 
	//////////////////////////////////////////////////////

	FREE HTML5 TEMPLATE 
	DESIGNED & DEVELOPED by FREEHTML5.CO
		
	Website: 		http://freehtml5.co/
	Email: 			info@freehtml5.co
	Twitter: 		http://twitter.com/fh5co
	Facebook: 		https://www.facebook.com/fh5co

	//////////////////////////////////////////////////////
	 -->

  	<!-- Facebook and Twitter integration -->
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
	<link rel="shortcut icon" href="favicon.ico">

	<!-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet"> -->
	
	<!-- Animate.css -->
	<link rel="stylesheet" href="{{ secure_asset('energy/css/animate.css') }}">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="{{ secure_asset('energy/css/icomoon.css') }}">
	<!-- Simple Line Icons -->
	<link rel="stylesheet" href="{{ secure_asset('energy/css/simple-line-icons.css') }}">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="{{ secure_asset('energy/css/bootstrap.css') }}">
	<!-- Superfish -->
	<link rel="stylesheet" href="{{ secure_asset('energy/css/superfish.css') }}">
	<!-- Flexslider  -->
	<link rel="stylesheet" href="{{ secure_asset('energy/css/flexslider.css') }}">

	<link rel="stylesheet" href="{{ secure_asset('energy/css/style.css') }}">


	<!-- Modernizr JS -->
	<script src="{{ secure_asset('energy/js/modernizr-2.6.2.min.js') }}" defer></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->

	</head>
	<body>
		<div id="fh5co-wrapper">
		<div id="fh5co-page">
		<div id="fh5co-header">
			<header id="fh5co-header-section">
				<div class="container">
					<div class="nav-header">
						<a href="#" class="js-fh5co-nav-toggle fh5co-nav-toggle"><i></i></a>
						<h1 id="fh5co-logo"><a href="{{ route('top') }}">演劇Post</a></h1>
						<!-- START #fh5co-menu-wrap -->
						<nav id="fh5co-menu-wrap" role="navigation">
							<ul class="sf-menu" id="fh5co-primary-menu">
							<!-- 	<li>
									<a class="active" href="index.html">Home</a>
								</li> -->
								<li><a href="{{ route('theaters') }}">劇場一覧</a></li>
								<li><a href="{{ route('programs') }}">公演作品</a></li>
								<li><a href="{{ route('photos') }}">写真一覧</a></li>
					            @guest
					              <li><a class="nav-link" href="{{ route ('login') }}">ログイン</a></li>
					              
					            {{-- ログインしていたらユーザー名とログアウトボタンを表示 --}}
					            @else
					              <li class="nav-item dropdown">
					                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#"
					                role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
					                  {{ Auth::user()->name }} <span class="caret"></span>
					                </a>
					                
					                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
										<a class="dropdown-item" href="{{ route('home') }}">Home</a>
										<a class="dropdown-item" href="{{ route('logout') }}"
					                		onclick="event.preventDefault();
					                		document.getElementById('logout-form').submit();">ログアウト</a>
					                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
					                    {{csrf_field()}}
					                  </form>
					                </div>
					              </li>
					              @endguest
								<li><a href="{{ route('register') }}">アカウント登録</a></li>
							</ul>
						</nav>
					</div>
				</div>
			</header>		
		</div>
		<!-- end:fh5co-header -->
		<aside id="fh5co-hero" class="js-fullheight">
			<div class="flexslider js-fullheight">
				<ul class="slides">
			   	@foreach($posts as $post)
			   	
			   	<!-- ここからローカルに保存した画像を表示するコード
			   	<li style="background-image: url({{ secure_asset('storage/image/' .$post->image_path) }});">
			   	ここまでローカルに保存した画像を表示するコード -->
			   	
			   	<!-- ここからS3に保存した画像を表示するコード -->
			   	<li style="background-image: url({{ $post->image_path }});">
			   	<!-- ここまでS3に保存した画像を表示するコード -->			   	
			   		<div class="overlay-gradient"></div>
			   		<div class="container">
			   			<div class="col-md-10 col-md-offset-1 text-center js-fullheight slider-text">
			   				<div class="slider-text-inner">
			   					<h2>{{ $post->title }}</h2>
			   				</div>
			   			</div>
			   		</div>
			   	</li>
			   	@endforeach
			  	</ul>
		  	</div>
		</aside>
		<div id="fh5co-portfolio-section">
			<div class="portfolio-row-half">
				<div class="portfolio-grid-item-color">
					<div class="desc">
						<h2>劇場一覧</h2>
					</div>
				</div>
				<a href="#" class="portfolio-grid-item" style="background-color:#CCCCCC;">
					<div class="title">
						@foreach($posts as $post)
						    @if ($post->id == 1)
						        <h3>{{ \Str::limit($post->title, 100) }}</h3>
						        <strong>住所</strong><br />
						        <span>{{ \Str::limit($post->address, 100) }}</span><br />
						        <strong>アクセス</strong><br />
						        <span>{!! nl2br(e($post->access)) !!}</span>
						    @endif
						@endforeach
					</div>
				</a>
				<a href="#" class="portfolio-grid-item" style="background-color:#CCCCCC;">
					<div class="title">
						@foreach($posts as $post)
						    @if ($post->id == 2)
						        <h3>{{ \Str::limit($post->title, 100) }}</h3>
						        <strong>住所</strong><br />
						        <span>{{ \Str::limit($post->address, 100) }}</span><br />
						        <strong>アクセス</strong><br />
						        <span>{!! nl2br(e($post->access)) !!}</span>
						    @endif
						@endforeach
					</div>
				</a>
				<a href="#" class="portfolio-grid-item" style="background-color:#CCCCCC;">
					<div class="title">
						@foreach($posts as $post)
						    @if ($post->id == 3)
						        <h3>{{ \Str::limit($post->title, 100) }}</h3>
						        <strong>住所</strong><br />
						        <span>{{ \Str::limit($post->address, 100) }}</span><br />
						        <strong>アクセス</strong><br />
						        <span>{!! nl2br(e($post->access)) !!}</span>
						    @endif
						@endforeach
					</div>
				</a>
			</div>
		</div>

<!--ここからfooter -->
		<footer id="footer">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<div class="copyright">
							<p><small>&copy; 2020 Takeuchi</small></p>
						</div>
					</div>
					<div class="col-md-6">
						<div class="row">
							<div class="col-md-6">
								<h3>Contents</h3>
								<ul class="link">
									<li><a href="{{ route('top') }}">Top</a></li>
									<li><a href="{{ route('theaters') }}">Theaters</a></li>
									<li><a href="{{ route('programs') }}">Programs</a></li>
									<li><a href="{{ route('photos') }}">Photo</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>	
		</footer>
	

	</div>
	<!-- END fh5co-page -->

	</div>
	<!-- END fh5co-wrapper -->

	<!-- jQuery -->

	<script src="{{ secure_asset('energy/js/jquery.min.js') }}" defer></script>
	<!-- jQuery Easing -->
	<script src="{{ secure_asset('energy/js/jquery.easing.1.3.js') }}" defer></script>
	<!-- Bootstrap -->
	<script src="{{ secure_asset('energy/js/bootstrap.min.js') }}" defer></script>
	<!-- Waypoints -->
	<script src="{{ secure_asset('energy/js/jquery.waypoints.min.js') }}" defer></script>
	<!-- Superfish -->
	<script src="{{ secure_asset('energy/js/hoverIntent.js') }}" defer></script>
	<script src="{{ secure_asset('energy/js/superfish.js') }}" defer></script>
	<!-- Flexslider -->
	<script src="{{ secure_asset('energy/js/jquery.flexslider-min.js') }}" defer></script>
	<!-- Stellar -->
	<script src="{{ secure_asset('energy/js/jquery.stellar.min.js') }}" defer></script>
	<!-- Counters -->
	<script src="{{ secure_asset('energy/js/jquery.countTo.js') }}" defer></script>

	<!-- Main JS (Do not remove) -->
	<script src="{{ secure_asset('energy/js/main.js') }}" defer></script>

	</body>
</html>

