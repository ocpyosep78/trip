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

<html>

<head>

  	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="google-site-verification" content="T2_fZziYAJ0DfMh70dC49mmiBjrmwn6iItECVBCLkWw" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title><?php echo $title; ?></title>

 
	<!-- meta -->

	<?php foreach ($array_meta as $row) { ?>

	<meta name="<?php echo $row['name']; ?>" content="<?php echo $row['content']; ?>" />

	<?php } ?>

<LINK REV="made" href="mailto:tripdomestik.com@gmail.com">
<meta content='INDEX, FOLLOW' name='ROBOTS'/>
<META NAME="author" CONTENT="Trip Domestik">
<META NAME="ROBOTS" CONTENT="ALL">
<meta content='text/html; charset=utf-8' http-equiv='Content-Type'/>
<meta content='1 days' name='revisit-after'/>
<meta content='in' name='geo.country'/>
<meta content='global' name='Distribution'/>
<meta content='both' http-equiv='Content-Language'/>
<meta content='global' name='geo.country'/>
<meta content='follow, all' name='Googlebot-Image'/>
<meta content='global' name='geo.placename'/>
<meta content='global' name='geo.country'/>
<meta CONTENT='NOYDIR' name='ROBOTS'/>
<meta content='text/html; charset=UTF-8' http-equiv='Content-Type'/>
<meta content='true' name='MSSmartTagsPreventParsing'/>
<link rel="alternate" type="application/rss+xml" title=" Tempat wisata di indonesia | tripdomestik RSS Feed" href="http://www.tripdomestik.com/rss" />
 
<link rel="pingback" href="http://tripdomestik.com/xmlrpc.php">
 
<link rel="author" href="https://plus.google.com/u/0/b/102033708952551219666/102033708952551219666/posts"/>


	<!-- link -->

	<?php foreach ($array_link as $row) { ?>

	<?php if (isset($row['href'])) { ?>

	<meta rel="<?php echo $row['rel']; ?>" href="<?php echo $row['href']; ?>" />

	<?php } else if (isset($row['content'])) { ?>

	<meta rel="<?php echo $row['rel']; ?>" content="<?php echo $row['content']; ?>" />

	<?php } ?>

	<?php } ?>

	

    <!-- Bootstrap -->

    <link href="<?php echo base_url('static/theme/forest/css/bootstrap.css'); ?>" rel="stylesheet" media="screen">

    <link href="<?php echo base_url('static/theme/forest/css/custom.css'); ?>" rel="stylesheet" media="screen">

	

    <!-- Carousel -->

	<link href="<?php echo base_url('static/theme/forest/lib/carousel/carousel.css'); ?>" rel="stylesheet">

	

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

    <!--[if lt IE 9]>

		<script src="<?php echo base_url('static/theme/forest/js/html5shiv.js'); ?>"></script>

		<script src="<?php echo base_url('static/theme/forest/js/respond.min.js'); ?>"></script>

    <![endif]-->

	

    <!-- Fonts -->	

	<link href="<?php echo base_url('static/theme/forest/css/font_lato.css'); ?>" rel="stylesheet" type="text/css">

	<link href="<?php echo base_url('static/theme/forest/css/font_open_sans.css'); ?>" rel="stylesheet" type="text/css">

	

	<!-- Font-Awesome -->

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('static/theme/forest/css/font-awesome.css'); ?>" media="screen" />

    <!--[if lt IE 7]><link rel="stylesheet" type="text/css" href="<?php echo base_url('static/theme/forest/css/font-awesome-ie7.css'); ?>" media="screen" /><![endif]-->

	

	<!--  datepicker  -->

	<link rel="stylesheet" href="<?php echo base_url('static/theme/forest/lib/datepicker/datepicker3.css'); ?>" type="text/css">

	

    <!-- REVOLUTION BANNER CSS SETTINGS -->

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('static/theme/forest/css/fullscreen.css'); ?>" media="screen" />

	<link rel="stylesheet" type="text/css" href="<?php echo base_url('static/theme/forest/lib/rs-plugin/css/settings.css'); ?>" media="screen" />

	

	<!-- Animo css-->

	<link rel="stylesheet" type="text/css" href="<?php echo base_url('static/theme/forest/lib/animo/animate+animo.css'); ?>" media="screen" />

	

    <!-- Picker UI-->	

	<link rel="stylesheet" href="<?php echo base_url('static/theme/forest/css/jquery-ui.css'); ?>" />

	

    <!-- jQuery -->	

    <script>var web = <?php echo json_encode($web); ?></script>

    <script src="<?php echo base_url('static/theme/forest/js/jquery.v2.0.3.js'); ?>"></script>

	

	<!-- bin/jquery.slider.min.css -->

	<link rel="stylesheet" href="<?php echo base_url('static/theme/forest/lib/jslider/css/jslider.css'); ?>" type="text/css">

	<link rel="stylesheet" href="<?php echo base_url('static/theme/forest/lib/jslider/css/jslider.round.css'); ?>" type="text/css">

	

	<!-- typeahead -->

	<link rel="stylesheet" href="<?php echo base_url('static/theme/forest/lib/typeahead/examples.css'); ?>">

	

	<script type="text/javascript" src="<?php echo base_url('static/theme/forest/lib/jslider/js/jshashtable-2.1_src.js'); ?>"></script>

	<script type="text/javascript" src="<?php echo base_url('static/theme/forest/lib/jslider/js/jquery.numberformatter-1.2.3.js'); ?>"></script>

	<script type="text/javascript" src="<?php echo base_url('static/theme/forest/lib/jslider/js/tmpl.js'); ?>"></script>

	<script type="text/javascript" src="<?php echo base_url('static/theme/forest/lib/jslider/js/jquery.dependClass-0.1.js'); ?>"></script>

	<script type="text/javascript" src="<?php echo base_url('static/theme/forest/lib/jslider/js/draggable-0.1.js'); ?>"></script>

	<script type="text/javascript" src="<?php echo base_url('static/theme/forest/lib/jslider/js/jquery.slider.js'); ?>"></script>

	<!-- end -->

</head>