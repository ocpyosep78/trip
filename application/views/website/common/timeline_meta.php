<?php
	$web['base'] = base_url();
	
	// title
	$title = (isset($title)) ? $title : WEBSITE_TITLE;
	
	/*	// array meta
		e.g. $array_meta = array(
			array( 'name' => 'Title', 'content' => 'Isi Title' ),
			array( 'name' => 'Description', 'content' => 'Isi Description' ),
			array( 'name' => 'Keywords', 'content' => 'Isi Keywords' )
		);
	/*	*/
	$array_meta = (isset($array_meta)) ? $array_meta : array();
	
	/*	// array link
		e.g. $array_link = array(
			array( 'rel' => 'canonical', 'href' => 'url item' ),
			array( 'rel' => 'image_src', 'href' => 'image default' )
		);
	/*	*/
	$array_link = (isset($array_link)) ? $array_link : array();
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
	<title><?php echo $title; ?></title>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta name="description" content="Timeline oriented personal Blogging WordPress Theme">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
	
	<!-- meta -->
	<?php foreach ($array_meta as $row) { ?>
	<meta name="<?php echo $row['name']; ?>" content="<?php echo $row['content']; ?>" />
	<?php } ?>
	
	<!-- link -->
	<?php foreach ($array_link as $row) { ?>
	<?php if (isset($row['href'])) { ?>
	<meta rel="<?php echo $row['rel']; ?>" href="<?php echo $row['href']; ?>" />
	<?php } else if (isset($row['content'])) { ?>
	<meta rel="<?php echo $row['rel']; ?>" content="<?php echo $row['content']; ?>" />
	<?php } ?>
	<?php } ?>
	
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