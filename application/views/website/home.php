<?php
	$page['CATEGORY_HOTEL'] = CATEGORY_HOTEL;
	$page['CATEGORY_RESTAURANT'] = CATEGORY_RESTAURANT;
	$page['CATEGORY_DESTINATION'] = CATEGORY_DESTINATION;
	$ticket = $this->widget_model->get_by_id(array( 'alias' => 'ticket' ));
?>


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

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="google-site-verification" content="T2_fZziYAJ0DfMh70dC49mmiBjrmwn6iItECVBCLkWw" />
<title>Hotel Information and Destination Traveling complete with Restaurant review</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<meta name="description" content="Tripdomestik.com adalah Website informasi Hotel terlengkap dengan tempat tempat wisata, Review kuliner berdasarkan lokasi."/>
<meta name="keywords" content="tripdomestik,hotel murah, tempat wisata favorit, panduan wisata, jalan jalan, travel, backpacking, travel review"/>

	  
	
<!-- Open Graph data -->
<meta property="og:title" content="Hotel Information and Destination Traveling complete with Restaurant review" />
<meta property="og:type" content="article" />
<meta property="og:url" content="http://www.tripdomestik.com/" />
<meta property="og:image" content="http://tripdomestik.com/static/img/pulau-komodo.jpg" />
<meta property="og:description" content="Tripdomestik.com adalah Website informasi Hotel terlengkap dengan tempat tempat wisata, Review kuliner berdasarkan lokasi." />
<meta property="og:site_name" content="tripdomestik" />
<meta property="article:published_time" content="2013-09-17T05:59:00+01:00" />
<meta property="article:modified_time" content="2013-09-16T19:08:47+01:00" />
<meta property="article:section" content="Article Section" />
<meta property="article:tag" content="tripdomestik, hotel murah" />
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
<body id="top">
<div class="breadcrumbs">
<div xmlns:v="http://rdf.data-vocabulary.org/#"><span typeof="v:Breadcrumb">
<a href="http://www.tripdomestik.com/" property="v:title" rel="v:url">Home</a></span> </div></div>
	<?php $this->load->view( 'website/common/header_menu' ); ?>
	<div class="hide">
		<div class="cnt-page"><?php echo json_encode($page); ?></div>
	</div>
	
	 
	
	<div class="fullscreen-container mtslide sliderbg fixed">
		<div style="float:none;padding:20px;"></div>
	</div>
	
	
	
	<div class="wrap cstyle03">
		<div class="container mt-130 z-index100">		
			<div class="row">
				<div class="col-md-12">
					<div class="bs-example bs-example-tabs cstyle04">
						<ul class="nav nav-tabs" id="myTab">
							<li class="active"><a data-toggle="tab" href="#hotel2"><span class="hotel"></span>&nbsp;<span class="hidetext">Hotel</span></a></li>
							<li class=""><a data-toggle="tab" href="#vacations2"><span class="suitcase"></span>&nbsp;<span class="hidetext">Destination</span></a></li>
							<li class=""><a data-toggle="tab" href="#eat"><span class="suitcase"></span>&nbsp;<span class="hidetext">Restaurant</span></a></li>
							<li class=""><a href="http://www.tripdomestik.com/tiket.htm"><span class="flighthotel"></span>&nbsp;<span class="hidetext">Tiket</span></a></li>
						</ul>
						<div class="tab-content2" id="myTabContent">
							<div id="hotel2" class="tab-pane fade active in" style="height: 500px;">
								<div class="col-md-44 pt-6 form-class" style="z-index: 200; position: relative;">
									<span class="opensans size18">Where do you want to go?</span>
									<div class="cnt-typeahead">
										<input type="text" class="form-control hotel-typeahead" placeholder="City or Region" />
									</div>
									<label for="passwd" class="error hide">Silahkan mengisi field ini.</label>
								</div>
							</div>
							<div id="vacations2" class="tab-pane fade" style="height: 500px;">
								<div class="col-md-44 pt-6 form-class" style="z-index: 200; position: relative;">
									<span class="opensans size18">Where do you want to go?</span>
									<div class="cnt-typeahead">
										<input type="text" class="form-control destination-typeahead" placeholder="City or Region" />
									</div>
									<label for="passwd" class="error hide">Silahkan mengisi field ini.</label>
								</div>
							</div>
							<div id="eat" class="tab-pane fade" style="height: 500px;">
								<div class="col-md-44 pt-6 form-class" style="z-index: 200; position: relative;">
									<span class="opensans size18">Where do you want eat?</span>
									<div class="cnt-typeahead">
										<input type="text" class="form-control restaurant-typeahead" placeholder="City or Region" />
									</div>
									<label for="passwd" class="error hide">Silahkan mengisi field ini.</label>
								</div>
							</div>
						<!--	<div id="flighthotel2" class="tab-pane fade">
								<div class="col-md-4"><?php echo $ticket['content']; ?></div>
							</div> -->
						</div>
						<div class="searchbg2">
							<!-- <div class="left ca01"><a href="#">Advanced +</a></div> -->
							<form action="<?php echo base_url('search'); ?>" id="form-search-index">
								<button type="submit" class="btn-search right mr30">Search</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="lastminute2 lcfix">
			<div class="container lmc">	
				LAST MINUTE<br />
				<a class="btn iosbtn" href="<?php echo base_url('last-minute'); ?>">Read more</a>
			</div>
		</div>
		
		<div class="footerbg sfix2">
			<div class="container">		
				<footer>
					<div class="footer">
						<a href="#" class="social1"><img src="<?php echo base_url('static/theme/forest/images/icon-facebook.png'); ?>" alt=""/></a>
						<a href="#" class="social2"><img src="<?php echo base_url('static/theme/forest/images/icon-twitter.png'); ?>" alt=""/></a>
						<a href="#" class="social3"><img src="<?php echo base_url('static/theme/forest/images/icon-gplus.png'); ?>" alt=""/></a>
						<a href="#" class="social4"><img src="<?php echo base_url('static/theme/forest/images/icon-youtube.png'); ?>" alt=""/></a>
						<br /><br />
						
						Copyright &copy; <?php echo date("Y"); ?> <a href="<?php echo base_url(); ?>">Travel Agency</a> All rights reserved.
						<br /><br />
						
						<a href="#top" id="gotop2" class="gotop"><img src="<?php echo base_url('static/theme/forest/images/spacer.png'); ?>" alt=""/></a>
					</div>
				</footer>
			</div>	
		</div>
	</div>
	
	<?php $this->load->view( 'website/common/library', array( 'js_add' => array( 'js-index3.js' ) ) ); ?>
	
<script>
	var config = Func.get_config();
	
	// hotel
	var hotel_store = new Bloodhound({
		limit: 10,
		datumTokenizer: Bloodhound.tokenizers.obj.whitespace('title'),
		queryTokenizer: Bloodhound.tokenizers.whitespace,
		prefetch: web.base + 'panel/typeahead/?action=auto_complete&category_id=' + config.CATEGORY_HOTEL,
		remote: web.base + 'panel/typeahead/?action=auto_complete&category_id=' + config.CATEGORY_HOTEL + '&namelike=%QUERY'
	});
	hotel_store.initialize();
	var hotel_ahead = $('.hotel-typeahead').typeahead(null, {
		name: 'hotel-selector',
		displayKey: 'title',
		source: hotel_store.ttAdapter(),
		templates: {
			empty: [ '<div class="empty-message">', 'no result', '</div>' ].join('\n'),
			suggestion: Handlebars.compile('<p><strong>{{title}}</strong></p>')
		}
	});
	hotel_ahead.on('typeahead:selected',function(evt, data) {
		window.location = data.link;
	});
	
	// destination
	var destination_store = new Bloodhound({
		limit: 10,
		datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
		queryTokenizer: Bloodhound.tokenizers.whitespace,
		prefetch: web.base + 'panel/typeahead/?action=auto_complete&category_id=' + config.CATEGORY_DESTINATION,
		remote: web.base + 'panel/typeahead/?action=auto_complete&category_id=' + config.CATEGORY_DESTINATION + '&namelike=%QUERY'
	});
	destination_store.initialize();
	var destination_ahead = $('.destination-typeahead').typeahead(null, {
		name: 'destination-selector',
		displayKey: 'title',
		source: destination_store.ttAdapter(),
		templates: {
			empty: [ '<div class="empty-message">', 'no result', '</div>' ].join('\n'),
			suggestion: Handlebars.compile('<p><strong>{{title}}</strong></p>')
		}
	});
	destination_ahead.on('typeahead:selected',function(evt, data) {
		window.location = data.link;
	});
	
	// restaurant
	var restaurant_store = new Bloodhound({
		limit: 10,
		datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
		queryTokenizer: Bloodhound.tokenizers.whitespace,
		prefetch: web.base + 'panel/typeahead/?action=auto_complete&category_id=' + config.CATEGORY_RESTAURANT,
		remote: web.base + 'panel/typeahead/?action=auto_complete&category_id=' + config.CATEGORY_RESTAURANT + '&namelike=%QUERY'
	});
	restaurant_store.initialize();
	var restaurant_ahead = $('.restaurant-typeahead').typeahead(null, {
		name: 'restaurant-selector',
		displayKey: 'title',
		source: restaurant_store.ttAdapter(),
		templates: {
			empty: [ '<div class="empty-message">', 'no result', '</div>' ].join('\n'),
			suggestion: Handlebars.compile('<p><strong>{{title}}</strong></p>')
		}
	});
	restaurant_ahead.on('typeahead:selected',function(evt, data) {
		window.location = data.link;
	});
	
	// form search
	$('#form-search-index').submit(function(e) {
		var label = $('#myTabContent div.active').find('label');
		if (label.length > 0) {
			e.preventDefault();
			label.removeClass('hide');
		}
	});
</script>
<a target="_blank" href="http://www.blogtopsites.com/"><img style="border:none;" src="http://www.blogtopsites.com/v_182449.gif" alt="blog directory" /></a><br /><a target="_blank" href="http://www.blogtopsites.com" style="font-size:10px;">blog directory</a>
<!-- Begin BlogToplist tracker code -->
<a href="http://www.blogtoplist.com/travel/" title="Travel">
<img src="http://www.blogtoplist.com/tracker.php?u=232030" alt="Travel" border="0" /></a>
<!-- End BlogToplist tracker code -->
<br><a href="http://www.billigthotell.org/">Billigthotell.org</a>


</body>
</html>