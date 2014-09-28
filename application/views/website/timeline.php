<?php
	// traveler
	$traveler = $this->traveler_model->get_by_id(array( 'alias' => $this->uri->segments[2] ));
	
	// array timeline
	$timeline_per_page = 10;
	$array_timeline = $this->traveler_model->get_array_timeline(array( 'traveler_id' => $traveler['id'], 'limit' => $timeline_per_page ));
	$count_timeline = $this->traveler_model->get_array_timeline_count(array( 'traveler_id' => $traveler['id'] ));
	
	// array seo
	$array_seo = array(
		'title' => $traveler['full_name'],
		'array_meta' => array(
			array( 'name' => 'Title', 'content' => $traveler['full_name'] ),
			array( 'name' => 'Description', 'content' => $traveler['user_about'] )
		)
	);
	
	// page data
	$page['traveler'] = $traveler;
	$page['count_timeline'] = $count_timeline;
	$page['timeline_per_page'] = $timeline_per_page;
?>

<?php $this->load->view( 'website/common/timeline_meta', $array_seo ); ?>
<body class="home blog custom-background" id="top">
	<?php $this->load->view( 'website/common/timeline_header' ); ?>
	<div style="display: none;">
		<div class="cnt-page"><?php echo json_encode($page); ?></div>
	</div>

<section id="content-wrap" class="wrap" role="main">
	<div class="timeline animated fadeInDownBig"></div>
	<a href="#" class="subheader-widgets-trigger animated fadeInDown"></a>
	<div id="content" class="row">
		<div style="position: relative; overflow: hidden; height: 576px;" id="isotope" class="isotope animated fadeIn">
			<?php $this->load->view( 'website/timeline_list', array( 'array_timeline' => $array_timeline ) ); ?>
		</div>
		<div class="isotope-new"></div>
		
		<div id="load-posts">
			<div style="margin: 0 0 15px 0;">
				<a class="btn-load-more" style="background: #ee482e; padding: 2px 5px; color: #FFFFFF; font-size: 12px; cursor: pointer;" data-start="<?php echo $timeline_per_page; ?>" data-limit="<?php echo $timeline_per_page; ?>">More</a>
			</div>
			
			<a class="load-more" href="#"></a>
			<a class="to-the-top" href="#top"></a>
			<div id="loading-isotope" data-perpage="10"></div>
		</div>
	</div>
</section>

<script>
var page = {
	init: function() {
		var raw_data = $('.cnt-page').html();
		eval('var data = ' + raw_data);
		page.data = data;
		
		// init isotope
		Func.helper.isotope.auto_set();
	}
}
page.init();

// show or hide button
setInterval(function() {
	if ($('#isotope article').length == page.data.count_timeline) {
		$('.btn-load-more').remove();
	}
}, 250);

// init button
$('.btn-load-more').click(function() {
	// button
	var button = $(this);
	
	// ajax request
	Func.ajax({
		url: page.data.traveler.link_traveler,
		is_json: false,
		param: {
			action: 'load_more_timeline',
			traveler_id: page.data.traveler.id,
			start: $(this).data('start'),
			limit: $(this).data('limit')
		},
		callback: function(cnt_html) {
			if (cnt_html == '') {
				$('.btn-load-more').remove();
			}
			
			// update button
			var start = button.data('start') + page.data.timeline_per_page;
			button.data('start', start);
			
			// append html
			$('.isotope-new').append(cnt_html);
			Func.helper.isotope.render_grid();
		}
	});
});
</script>
	
<?php $this->load->view( 'website/common/timeline_footer' ); ?>
</body></html>