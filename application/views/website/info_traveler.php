<?php
	// traveler
	$traveler = $this->traveler_model->get_by_id(array( 'alias' => $this->uri->segments[2] ));
	
	// breadcrub
	$array_breadcrub = array(
		array( 'link' => '#', 'title' => 'Member' ),
		array( 'link' => $traveler['link_traveler'], 'title' => $traveler['full_name'] )
	);
?>

<!DOCTYPE html>
<!--[if lt IE 7 ]> <html class="ie ie6 no-js" lang="en-US"> <![endif]-->
<!--[if IE 7 ]> <html class="ie ie7 no-js" lang="en-US"> <![endif]-->
<!--[if IE 8 ]> <html class="ie ie8 no-js" lang="en-US"> <![endif]-->
<!--[if IE 9 ]> <html class="ie ie9 no-js" lang="en-US"> <![endif]-->
<!--[if gt IE 9]><!-->
<html class="csstransforms no-csstransforms3d csstransitions js flexbox canvas canvastext webgl no-touch geolocation postmessage no-websqldatabase indexeddb hashchange history draganddrop websockets rgba hsla multiplebgs backgroundsize borderimage borderradius boxshadow textshadow opacity cssanimations csscolumns cssgradients no-cssreflections csstransforms csstransforms3d csstransitions fontface video audio localstorage sessionstorage webworkers applicationcache svg inlinesvg smil svgclippaths" lang="en-US">
<!--<![endif]--><!-- the "no-js" class is for Modernizr. -->
<head lang="en-US">
	<title><?php echo $traveler['full_name']; ?></title>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta name="description" content="Timeline oriented personal Blogging WordPress Theme">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
	
	<link rel="stylesheet" type="text/css" media="all" href="http://tripdomestik.com/static/theme/timeline/style.css">
	<link href="http://tripdomestik.com/static/theme/timeline/animate.css" media="all" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="http://tripdomestik.com/static/theme/timeline/injected_002.css">
	<link rel="stylesheet" id="options_typography_Roboto-css" href="http://tripdomestik.com/static/theme/timeline/css_002.css" type="text/css" media="all">
	<link rel="stylesheet" id="options_typography_Roboto+Condensed-css" href="http://tripdomestik.com/static/theme/timeline/css.css" type="text/css" media="all">
	<link rel="stylesheet" id="prettyPhoto-css" href="http://tripdomestik.com/static/theme/timeline/prettyPhoto.css" type="text/css" media="all">
	<link rel="stylesheet" type="text/css" href="timeline2_files/injected.css">
	
	<style>
		.fluid-width-video-wrapper { width: 100%; position: relative; padding: 0; }
		.fluid-width-video-wrapper iframe, .fluid-width-video-wrapper object, .fluid-width-video-wrapper embed { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }
	</style>
	<style type="text/css">

body {
background-color: #ece9d5;
background-image: url(http://www.tienvooracht.nl/themes/sann/wp-content/themes/sannv2/images/bg.jpg);
background-position: top left;
background-repeat: repeat;
background-attachement: fixed;
color: #555555;
font-family: Roboto, sans-serif;
font-size: 14px;
font-weight: normal;
}

#header-wrap {
background-color: #ee482e;
}

body a {
color: #222222;
}

body a:hover {
color: #ee482e;
}

#header,
#header #navigation {
color: #ffffff;
font-family: Roboto Slab, serif;
font-size: 16px;
font-weight: bold;
}

#header a,
#header #navigation a {
color: #ffffff;
font-size: 16px;
}

#header a:hover,
#header #navigation a:hover {
color: #fcdad5;
}

.post .entry-meta,
.format-link .entry-link .entry-url,
.format-quote .entry-quote .quoted {
color: #aaaaaa;
font-family: Roboto Condensed, sans-serif;
font-size: 12px;
font-weight: bold;
}

.post .entry-meta a {
color: #aaaaaa;
}

.post .entry-meta a:hover {
color: #555555;
}
.post .entry-meta a:hover .meta-icon {
background-color: #555555;
}

h1,
h2,
h3,
h4,
h5,
h6 {
color: #222222;
font-family: Roboto Slab, serif;

font-weight: bold;
}

h1 a,
h2 a,
h3 a,
h4 a,
h5 a,
h6 a {
color: #222222;
}

h1 a:hover,
h2 a:hover,
h3 a:hover,
h4 a:hover,
h5 a:hover,
h6 a:hover {
color: #ee482e;
}

.post .entry-meta .post-like .like.voted,
.post .entry-meta .post-like .like.alreadyvoted,
.post .entry-meta .post-like .like:hover,
#load-posts a.load-more,
.subheader-widgets-trigger:hover,
.highlight {
background-color: #ee482e;
}
	</style>
	<style type="text/css">.recentcomments a{display:inline !important;padding:0 !important;margin:0 !important;}</style>
	
	<script src="http://tripdomestik.com/static/theme/timeline/tienvooracht.txt" async=""></script>
	<script type="text/javascript" src="http://tripdomestik.com/static/theme/timeline/jquery_002.js"></script>
	<script type="text/javascript" src="http://tripdomestik.com/static/theme/timeline/jquery-migrate.js"></script>
	<script type="text/javascript" src="http://tripdomestik.com/static/theme/timeline/jquery_004.js"></script>
	<script type="text/javascript" src="http://tripdomestik.com/static/theme/timeline/jquery_006.js"></script>
	<script type="text/javascript" src="http://tripdomestik.com/static/theme/timeline/jquery_003.js"></script>
	<script type="text/javascript" src="http://tripdomestik.com/static/theme/timeline/jquery.js"></script> 
	
	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<!--[if lt IE 9]>
	<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
	<![endif]-->
</head>
<body class="home blog custom-background" id="top">

<div id="loading"></div>
<header id="header-wrap" class="wrap" role="banner"><!-- BEGIN #header-wrap -->
	<div id="header" class="row"><!-- BEGIN #header -->
		<div id="navigation"><!-- BEGIN #navigation -->
		<div class="menu-navigation-container">
			<ul id="menu-navigation" class="sf-menu menu sf-js-enabled"><li id="menu-item-15" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-home menu-item-15">
				<a href="<?php echo base_url(); ?>">Home</a></li>
			</ul>
		</div>		</div><!-- END #navigation -->
		<a style="display: none;" class="navigation-trigger" href="#"></a>
		
		<table style="z-index: 1002;" id="logo-wrap">
			<tbody><tr>
				<td>
				<h1 id="logo" class="avatar"><!-- BEGIN #logo -->
				<a href="<?php echo $traveler['link_traveler']; ?>" title="<?php echo $traveler['full_name']; ?>" rel="home">
					<img src="<?php echo $traveler['thumbnail_link']; ?>" alt="<?php echo $traveler['full_name']; ?>" style="width: 80px;">
				</a>
				</h1><!-- END #logo -->
				</td>
			</tr>
		</tbody></table>
		
		<div id="header-right" class="social"><!-- BEGIN #header-right -->
			<ul class="tva-social-icons">
				<li><a class="facebook" href="#facebook" title="Facebook" target="_blank">Facebook</a></li>
				<li><a class="linkedin" href="#linkedin" title="LinkedIN" target="_blank">LinkedIN</a></li>
				<li><a class="pinterest" href="#pinterest" title="Pinterest" target="_blank">Pinterest</a></li>
				<li><a class="twitter" href="#twitter" title="Twitter" target="_blank">Twitter</a></li>
			</ul>
		</div><!-- END #header-right -->
	</div><!-- END #header -->
</header><!-- END #header-wrap -->

<section id="subheader-wrap" class="wrap animated fadeInDown">
<!-- BEGIN #subheader-wrap -->
<div id="subheader" class="row tagline"><!-- BEGIN #subheader -->
<span>Timeline | About </span></div><!-- END #subheader -->
</section><!-- END #subheader-wrap -->

<section id="subheader-widgets-wrap" class="wrap"><!-- BEGIN #subheader-widgets-wrap -->
	
	<div id="subheader-widgets" class="row"><!-- BEGIN #subheader-widgets -->

		<div class="six columns"><aside id="text-7" class="widget widget_text"><h3 class="widget-title">About Me</h3>			
		<div class="textwidget"><p><?php echo (empty($traveler['user_about'])) ? '-' : $traveler['user_about']; ?></p>
</div>
		</aside></div><div class="six columns"><aside id="tva-latest-tweets-widget-2" class="widget tva-latest-tweets-widget"><h3 class="widget-title">Latest Tweets</h3>

		
		Biarin saja

		<ul id="twitter_update_list_0"><li>Loading Tweets...</li></ul>
		
 	</aside></div>
	</div><!-- END #subheader-widgets -->
</section><!-- END #subheader-widgets-wrap -->

<section id="content-wrap" class="wrap" role="main"><!-- BEGIN #content-wrap -->

	<div class="timeline animated fadeInDownBig"></div>
	<a href="#" class="subheader-widgets-trigger animated fadeInDown"></a>
	<div id="content" class="row"><!-- BEGIN #content -->

		<div style="position: relative; overflow: hidden; height: 576px;" id="isotope" class="isotope animated fadeIn"><!-- BEGIN #isotope -->

			
			
	 
	 
			
		 
			
		 
			
	
			
		 
			<article style="position: absolute; left: 0px; top: 0px;" id="post-66" class="post-66 post type-post status-publish format-gallery hentry category-photography item six columns isotope-item item-right item-left"><!-- BEGIN #post-66 -->

				
				<span class="indicator-top"></span>

				
	
	
	<div class="post-content"><!-- BEGIN .post-content -->

			
		<div class="entry-format entry-gallery"><!-- BEGIN .entry-format -->
<img src="http://tripdomestik.com/static/theme/timeline/20140416_083556_3547.jpg" alt="flowers-2" height="673" width="602"></div><!-- END .entry-format -->

		<header class="entry-header">

		<h2 class="entry-title">
		<a href="http://tripdomestik.com/restaurant/jawa-timur/kota-malang/423434323423/gallery/mantap-tempatnya-bro" title="" rel="bookmark">
		Mantap tempatnya bro (judul image)
		</a></h2>
			
		</header>
		
				<div class="entry-content"><!-- BEGIN .entry-content -->

			<p>Isi detail gambar... max 150 karakter.... dan di link ke link gambar traveler di traveler galery....</p>
<p> <a href="#" class="more-link">Continue reading <span class="meta-nav">»</span></a></p>

		</div><!-- END .entry-content -->
		
	</div><!-- END .post-content -->

		
	<div class="entry-meta"><!-- BEGIN .entry-meta -->
	
		<span class="indicator"></span>

		
		<span class="posted meta-item">
		
			<a href="#" title="" rel="bookmark"><span class="posted-icon meta-icon"></span><span class="entry-date">20/5/2014</span></a>

				</span>

		
		
			 
		
			 <span style="display: inline; opacity: 0.849456;" class="read-more meta-item">
			<div style="float:left;color:#b30;">Share : &nbsp;&nbsp;</div> 
			
    <a href="http://www.facebook.com/sharer.php?u=tripdomestik.com" target="_blank">Facebook</a>  
 
 
		</span>
		
	</div><!-- END .entry-meta -->

    	
			</article><!-- END #post-66 -->

			
			<article style="position: absolute; left: 504px; top: 0px;" id="post-116" class="post-116 post type-post status-publish format-standard hentry category-news item six columns isotope-item item-left item-right"><!-- BEGIN #post-116 -->

				
				<span class="indicator-top"></span>

				
	
	
	<div class="post-content"><!-- BEGIN .post-content -->

		
		<header class="entry-header">

						<h2 class="entry-title">
						<a href="" title="Permalink to Just a simple standard post without a featured image" rel="bookmark">
						REVIEW : Pecel lele Lela Malang
						</a></h2>
			
		</header>

				<div class="entry-content"><!-- BEGIN .entry-content -->

			<p>Tempat makanya sih lumayan nyaman, menunya juga enak.. cuma waktu tiba di parkiran.. baru kepikiran... mahal juga ya.. :p</p>
<p> <a href="#" class="more-link">Continue reading <span class="meta-nav">»</span></a></p>

		</div><!-- END .entry-content -->
		
	</div><!-- END .post-content -->

		
	<div class="entry-meta"><!-- BEGIN .entry-meta -->
	
		<span class="indicator"></span>

		
		<span class="posted meta-item">
		
			<a href="#" title="Permalink to Just a simple standard post without a featured image" rel="bookmark"><span class="posted-icon meta-icon"></span><span class="entry-date">14/5/2014</span></a>

				</span>

		
		
			 	<span style="display: none;" class="read-more meta-item">
			<a href="#" title="Permalink to Just a simple standard post without a featured image" rel="bookmark">Read more<span class="read-more-icon meta-icon"></span></a>
		</span>
		
	</div><!-- END .entry-meta -->

    	
			</article><!-- END #post-116 -->

			
		 	 

			
			 

			
		</div><!-- END #isotope -->

				<div class="isotope-new"></div>

		<div id="load-posts"><!-- BEGIN #load-posts -->

			<a class="load-more" href="#"></a>
			<a class="to-the-top" href="#top"></a>

			<div id="loading-isotope" data-perpage="12"></div>

		</div><!-- END #load-posts -->
		
	</div><!-- END #content -->

</section><!-- END #content-wrap --><!-- END #content-wrap -->
	
<footer id="footer-wrap" class="wrap"><!-- BEGIN #footer-wrap -->
	<div id="footer" class="row"><!-- BEGIN #footer -->
		© 2014 <a href="#" class="home-url">Tripdomestik.com</a> 
	</div><!-- END #footer -->
</footer><!-- END #footer-wrap -->

<script type="text/javascript" src="http://tripdomestik.com/static/theme/timeline/jquery_005.js"></script>
<script type="text/javascript" src="http://tripdomestik.com/static/theme/timeline/superfish.js"></script>
<script type="text/javascript" src="http://tripdomestik.com/static/theme/timeline/custom.js"></script>
</body></html>