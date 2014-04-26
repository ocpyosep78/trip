<?php
	$page['CATEGORY_HOTEL'] = CATEGORY_HOTEL;
	$page['CATEGORY_RESTAURANT'] = CATEGORY_RESTAURANT;
	$page['CATEGORY_DESTINATION'] = CATEGORY_DESTINATION;
	$ticket = $this->widget_model->get_by_id(array( 'alias' => 'ticket' ));
?>

<?php $this->load->view( 'website/common/meta' ); ?>
<body id="top">
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
							<li class=""><a data-toggle="tab" href="#flighthotel2"><span class="flighthotel"></span>&nbsp;<span class="hidetext">Tiket</span></a></li>
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
							<div id="flighthotel2" class="tab-pane fade">
								<div class="col-md-4"><?php echo $ticket['content']; ?></div>
							</div>
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
</body>
</html>