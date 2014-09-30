<?php
	// traveler
	$traveler = $this->traveler_model->get_by_id(array( 'alias' => $this->uri->segments[2] ));
	
	// my travelling
	$param = array( 'traveler_alias' => $this->uri->segments[2], 'alias' => $this->uri->segments[4] );
	$my_traveling = $this->my_travelling_model->get_by_id($param);
	
	// array seo
	$array_seo = array(
		'title' => $traveler['full_name'].' - '.$my_traveling['title'],
		'array_meta' => array(
			array( 'name' => 'Title', 'content' => $traveler['full_name'].' - '.$my_traveling['title'] ),
			array( 'name' => 'Description', 'content' => get_length_char(strip_tags($my_traveling['desc']), 150, '') )
		)
	);
?>

<?php $this->load->view( 'website/common/timeline_meta', $array_seo ); ?>
<body class="home blog custom-background" id="top">
	<?php $this->load->view( 'website/common/timeline_header' ); ?>

<section id="content-wrap" class="wrap" role="main"><!-- BEGIN #content-wrap -->
	<div class="timeline animated fadeInDownBig"></div>
	<a href="#" class="subheader-widgets-trigger animated fadeInDown"></a>
	<div id="content" class="row"><!-- BEGIN #content -->
		<div style="position: relative; overflow: hidden; height: 576px;" id="isotope" class="isotope animated fadeIn">
			<?php $this->load->view( 'website/timeline_list', array( 'array_timeline' => array( $my_traveling ), 'is_detail' => true ) ); ?>
		</div>
		<div class="isotope-new"></div>
		<div id="load-posts"><!-- BEGIN #load-posts -->
			<a class="load-more" href="#"></a>
			<a class="to-the-top" href="#top"></a>
			<div id="loading-isotope" data-perpage="12"></div>
		</div><!-- END #load-posts -->
	</div><!-- END #content -->
</section><!-- END #content-wrap -->
	
<?php $this->load->view( 'website/common/timeline_footer' ); ?>
</body></html>