<?php
	// post
	$post = $this->post_model->get_by_id(array( 'city_alias' => $this->uri->segments[3], 'alias' => $this->uri->segments[4] ));
	
	// redirect
	if (count($post) == 0 || $post['post_status'] != 'approve') {
		header("HTTP/1.1 301 Moved Permanently");
		header('Location: '.base_url());
		exit;
	}
	
	// post galery
	$array_gallery = $this->post_gallery_model->get_array(array( 'post_id' => $post['id'] ));
	
	// post facility
	$array_facility = $this->post_facility_model->get_array(array( 'post_id' => $post['id'] ));
	
	// booking
	$array_booking = $this->hotel_booking_model->get_array(array( 'post_id' => $post['id'] ));
	
	// room amenity
	$array_room_amenity = $this->hotel_room_amenity_model->get_array(array( 'post_id' => $post['id'] ));
	
	// review
	$param_review = array(
		'post_id' => $post['id'],
		'post_status' => 'approve',
		'sort' => '[{"property":"post_traveler_review.post_date","direction":"DESC"}]',
		'limit' => 3
	);
	$array_review = $this->post_traveler_review_model->get_array($param_review);
	
	// promo
	if ($post['having_promo']) {
		$promo = $this->promo_model->get_by_id(array( 'post_id' => $post['id'], 'promo_status' => 'approve' ));
		if (count($promo) == 0) {
			$post['having_promo'] = 0;
		}
	}
	
	// hotel detail
	$post_detail = array();
	if ($post['category_id'] == CATEGORY_HOTEL) {
		$post_detail = $this->hotel_detail_model->get_by_id(array( 'post_id' => $post['id'] ));
	}
	
	// breadcrub
	$array_breadcrub = array(
		array( 'link' => $post['link_category'], 'title' => $post['category_title'] ),
		array( 'link' => $post['link_region'], 'title' => $post['region_title'] ),
		array( 'link' => $post['link_city'], 'title' => $post['city_title'] ),
		array( 'link' => $post['link_post'], 'title' => $post['title_select'] )
	);
?>

<?php $this->load->view( 'website/common/meta' ); ?>
<body id="top" class="thebg">
    <?php $this->load->view( 'website/common/header_menu' ); ?>
	<?php $this->load->view( 'website/common/breadcrub', array( 'array' => $array_breadcrub ) ); ?>
	
	<div class="container">
		<div class="container pagecontainer offset-0">
			<?php if (count($array_gallery) == 0) { ?>
			<div class="col-md-8 details-slider"><div id="c-carousel"><div id="wrapper">
				<div id="inner">
					<div id="caroufredsel_wrapper2">
						<div id="carousel">
							<img src="<?php echo $post['link_thumbnail']; ?>" alt="<?php echo $post['title_select']; ?>"/>
						</div>
					</div>
					<div id="pager-wrapper">
						<div id="pager">
							<img src="<?php echo $post['link_thumbnail_small']; ?>" width="120" height="68" alt="<?php echo $post['title_select']; ?>" />				
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
				<button id="prev_btn2" class="prev2"><img src="<?php echo base_url('static/theme/forest/images/spacer.png'); ?>" alt=""/></button>
				<button id="next_btn2" class="next2"><img src="<?php echo base_url('static/theme/forest/images/spacer.png'); ?>" alt=""/></button>
			</div></div></div>
			<?php } else { ?>
			<div class="col-md-8 details-slider"><div id="c-carousel"><div id="wrapper">
				<div id="inner">
					<div id="caroufredsel_wrapper2">
						<div id="carousel">
							<?php foreach ($array_gallery as $row) { ?>
							<img src="<?php echo $row['link_thumbnail']; ?>" alt="<?php echo $row['title']; ?>" />
							<?php } ?>						
						</div>
					</div>
					<div id="pager-wrapper">
						<div id="pager">
							<?php foreach ($array_gallery as $row) { ?>
							<img src="<?php echo $row['link_thumbnail']; ?>" width="120" height="68" alt="<?php echo $row['title']; ?>" />
							<?php } ?>
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
				<button id="prev_btn2" class="prev2"><img src="<?php echo base_url('static/theme/forest/images/spacer.png'); ?>" alt=""/></button>
				<button id="next_btn2" class="next2"><img src="<?php echo base_url('static/theme/forest/images/spacer.png'); ?>" alt=""/></button>
			</div></div></div>
			<?php } ?>
			
			<div class="col-md-4 detailsright offset-0">
				<div class="padding20">
					<h4 class="lh1"><?php echo $post['title_select']; ?></h4>
					<?php echo nl2br($post['address']); ?>
				</div>
			 	<div class="line3"></div>
				
				<?php if ($post['category_id'] == CATEGORY_HOTEL) { ?>
					<?php if (!empty($post['star'])) { ?>
					<div class="hpadding20">
						<h2 class="opensans slim green2">Bintang</h2>
					</div>
					<div class="line3 margtop20"></div>
					<?php } ?>
					
					<div class="col-md-6 bordertype3">
						Rate per night<br />
					</div>
					<div class="col-md-6 bordertype3">
						<a href="#" class="grey"><?php echo $post['rate_per_night']; ?> Per/night</a>
					</div>
					<div class="clearfix"></div><br />
					
					<div class="hpadding20">
						<!--   <a href="#" class="add2fav margtop5">Add to favourite</a>   -->
						<a class="booknow margtop20 btnmarg cursor btn-booking">Book now</a>
					</div>
				<?php } else { ?>
					<?php if (!empty($post['field_01_select'])) { ?>
					<div class="hpadding20">
						<h2 class="opensans slim green2"><?php echo $post['field_01_select']; ?>!</h2>
					</div>
					<div class="line3 margtop20"></div>
					<?php } ?>
					
					<div class="col-md-6 bordertype3">
						<?php if (isset($post['link_review_rate'])) { ?>
						<img src="<?php echo $post['link_review_rate']; ?>" alt=""/><br />
						<?php } ?>
						
						<?php echo $post['review_count']; ?> reviews
					</div>
					<div class="col-md-6 bordertype3">
						<a href="<?php echo $post['link_post_review']; ?>" class="grey">+Add review</a>
					</div>
					<div class="clearfix"></div><br />
					
					<div class="hpadding20">
						<a href="<?php echo $post['link_post_gallery']; ?>" class="add2fav margtop5">Traveler Gallery</a>
						<a href="<?php echo $post['link_post_upload']; ?>" class="booknow margtop20 btnmarg">Upload Your Photo</a>
					</div>  
				<?php } ?>
				
				<?php if ($post['category_id'] == CATEGORY_HOTEL) { ?>
					<?php if (count($array_booking) == 0) { ?>
					<div class="center" style="padding: 5px 0; color: #999999;">No booking avaliable</div>
					<?php } else { ?>
					<ul class="checkbook">
						<?php foreach ($array_booking as $row) { ?>
						<label><input type="checkbox" name="booking[]" value="<?php echo $row['link_redirect']; ?>" /> <?php echo $row['title']; ?></label>
						<?php } ?>
					</ul>
					<?php } ?>
				<?php } ?>
			</div>
		</div>
		
		<div class="container mt25 offset-0">
			<div class="col-md-8 pagecontainer2 offset-0">
				<div class="cstyle10"></div>
		
				<ul class="nav nav-tabs" id="myTab">
					<?php if ($post['category_id'] == CATEGORY_HOTEL) { ?>
					<li class="active"><a data-toggle="tab" href="#summary"><span class="summary"></span><span class="hidetext">Description</span>&nbsp;</a></li>
					<li><a data-toggle="tab" href="#preferences"><span class="preferences"></span><span class="hidetext">Preferences</span>&nbsp;</a></li>
					<?php } else { ?>
					<li class="active"><a data-toggle="tab" href="#summary"><span class="summary"></span><span class="hidetext">Summary</span>&nbsp;</a></li>
					<li><a data-toggle="tab" href="#reviews"><span class="reviews"></span><span class="hidetext">Reviews</span>&nbsp;</a></li>
					<?php } ?>
					
					<!--   how to booking   -->
					<?php if (count($array_booking) == 0 && count($post_detail) > 0) { ?>
					<li><a data-toggle="tab" href="#how-booking"><span class="rates"></span><span class="hidetext">How to Booking</span>&nbsp;</a></li>
					<?php } ?>
					
					<!--   promo   -->
					<?php if ($post['having_promo']) { ?>
					<li><a data-toggle="tab" href="#promo"><span class="rates"></span><span class="hidetext">Promo</span>&nbsp;</a></li>
					<?php } ?>
			 	</ul>
				<div class="tab-content4">
					<?php if ($post['category_id'] == CATEGORY_HOTEL) { ?>
					<div id="summary" class="tab-pane fade active in">
						<?php if (empty($post['desc_01_select'])) { ?>
						<p class="hpadding20">This content is not available in your language.</p>
						<?php } else { ?>
						<p class="hpadding20"><?php echo string_escape($post['desc_01_select']); ?></p>
						<?php } ?>
						
						<?php if (!empty($post['desc_02_select'])) { ?>
						<p class="hpadding20"><?php echo string_escape($post['desc_02_select']); ?></p>
						<?php } ?>
						
						<?php if (!empty($post['field_01_select'])) { ?>
						<p class="hpadding20"><?php echo string_escape($post['field_01_select']); ?></p>
						<?php } ?>
						<div class="line4"></div>
						
						<?php if (count($array_room_amenity) > 0) { ?>
						<button type="button" class="collapsebtn2" data-toggle="collapse" data-target="#collapse6">
							Room Amenities <span class="collapsearrow"></span>
						</button>
						<div id="collapse6" class="collapse in">
							<div class="column3">
								<?php foreach ($array_room_amenity as $row) { ?>
								<div class="item">
									<div class="padd">
										<img src="<?php echo base_url('static/theme/forest/images/check.png'); ?>" />
										<?php echo $row['title_select']; ?>
									</div>
								</div>
								<?php } ?>
								<div class="clear"></div>
							</div>
						</div>
						<?php } ?>
						
						<?php if (!empty($post['total_room'])) { ?>
						<div class="line2"></div><br />
						<div class="hpadding20" style="padding-bottom: 10px;">
							<div>Total Room : <?php echo $post['total_room']; ?></div>
						</div>
						<?php } ?>
					</div>
					<div id="preferences" class="tab-pane fade">
						<?php if (!empty($post['desc_03_select'])) { ?>
						<p class="hpadding20"><?php echo string_escape($post['desc_03_select']); ?></p>
						<?php } ?>
						<div class="line4"></div>
						
						<?php if (count($array_facility) > 0) { ?>
						<button type="button" class="collapsebtn2" data-toggle="collapse" data-target="#collapse7">
							Hotel facilities <span class="collapsearrow"></span>
						</button>
						<div id="collapse7" class="collapse in">
							<div class="column3 list-icon">
								<?php foreach ($array_facility as $row) { ?>
								<div class="item">
									<div class="padd">
										<div class="ic-logo"><div class="cnt <?php echo $row['facility_css_icon']; ?>"></div></div>
										<div class="ic-title"><?php echo $row['facility_title_select']; ?></div>
									</div>
								</div>
								<?php } ?>
								<div class="clear"></div>
							</div>
						</div>
						<?php } ?>
						<br />
						<div class="line4"></div>							
						
						<!--
						<button type="button" class="collapsebtn2" data-toggle="collapse" data-target="#collapse8">
							Room facilities <span class="collapsearrow"></span>
						</button>
						<div id="collapse8" class="collapse in">
							<div class="hpadding20">
								<div class="col-md-4">
									<ul class="checklist">
										<li>Climate control</li>
										<li>Air conditioning</li>
										<li>Direct-dial phone</li>
										<li>Minibar</li>
									</ul>
								</div>
								<div class="col-md-4">
									<ul class="checklist">
										<li>Wake-up calls</li>
										<li>Daily housekeeping</li>
										<li>Private bathroom</li>
										<li>Hair dryer</li>	
									</ul>									
								</div>	
								<div class="col-md-4">
									<ul class="checklist">								
										<li>Makeup/shaving mirror</li>
										<li>Shower/tub combination</li>
										<li>Satellite TV service</li>
										<li>Electronic/magnetic keys</li>	
									</ul>									
								</div>									
							</div>
							<div class="clearfix"></div>
						</div>
						-->
					</div>
					<?php } else { ?>
					<div id="summary" class="tab-pane fade active in">
						<?php if (empty($post['desc_01_select'])) { ?>
						<p class="hpadding20">This content is not available in your language.</p>
						<?php } else { ?>
						<p class="hpadding20"><?php echo $post['desc_01_select']; ?></p>
						<?php } ?>
						<div class="line4"></div>
						
						<?php if (!empty($post['desc_02_select'])) { ?>
						<button type="button" class="collapsebtn2" data-toggle="collapse" data-target="#collapse1">
							Description <span class="collapsearrow"></span>
						</button>
						<div id="collapse1" class="collapse in">
							<div class="hpadding20"><?php echo $post['desc_02_select']; ?></div>
							<div class="clearfix"></div>
						</div>
						<div class="line4"></div>
						<?php } ?>
					</div>
					<div id="reviews" class="tab-pane fade">
						<div class="hpadding20"><br />
							<span class="opensans dark size16 bold">Reviews</span>
						</div>
						<div class="line2"></div>
						
						<?php $this->load->view( 'website/common/review_list', array( 'array_review' => $array_review ) ); ?>
						
						<div class="wh33percent left center">&nbsp;</div>
						<div class="wh66percent right offset-0">
							<div class="padding20 relative wh70percent">
								<div class="clearfix"></div>
								<a class="btn-search4 margtop20 cursor" style="text-decoration: none;" href="<?php echo $post['link_post_review']; ?>">Submit Your Review</a>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
					<?php } ?>
					
					<!--   how to booking   -->
					<?php if (count($array_booking) == 0 && count($post_detail) > 0) { ?>
					<div id="how-booking" class="tab-pane fade">
						<div class="hpadding20">
							<?php echo nl2br($post_detail['booking']); ?>
						</div>
						<div class="line2"></div><br />
					</div>
					<?php } ?>
					
					<!--   promo   -->
					<?php if ($post['having_promo']) { ?>
					<div id="promo" class="tab-pane fade">
						<div class="hpadding20"><br />
							<span class="opensans dark size16 bold">Promo - <?php echo $promo['title_select']; ?></span>
						</div>
						<div class="line2"></div><br />
						
						<div class="hpadding20" style="padding-bottom: 10px;">
							<div>Start Date : <?php echo GetFormatDate($promo['publish_date']); ?></div>
							<div>End Date : <?php echo GetFormatDate($promo['close_date']); ?></div>
						</div>
						<div class="line2"></div><br />
						
						<button type="button" class="collapsebtn2" data-toggle="collapse" data-target="#collapse60">
							Content <span class="collapsearrow"></span>
						</button>
						<div id="collapse60" class="collapse in">
							<div class="hpadding20"><?php echo $promo['content_select']; ?></div>
							<div class="clearfix"></div>
						</div>
						<div class="line4"></div>
						
						<button type="button" class="collapsebtn2" data-toggle="collapse" data-target="#collapse61">
							Keyword <span class="collapsearrow"></span>
						</button>
						<div id="collapse61" class="collapse in">
							<div class="hpadding20">
								<?php $array_temp = explode(',', $promo['keyword']); ?>
								<?php foreach ($array_temp as $row) { ?>
									<div>- <a href="<?php echo base_url('tag/'.get_name($row)); ?>"><?php echo $row; ?></a></div>
								<?php } ?>
							</div>
							<div class="clearfix"></div>
						</div>
						<div class="line4"></div>
						
						<?php if (!empty($promo['link_info'])) { ?>
						<div class="center" style="padding: 25px 0 10px 0;">
							<a class="btn-search4 margtop20 cursor" style="text-decoration: none;" href="<?php echo $promo['link_info']; ?>">More Information</a>
						</div>
						<?php } ?>
					</div>
					<?php } ?>
				</div>
			</div>
			<div class="col-md-4">
				<?php $this->load->view( 'website/common/widget_02' ); ?>
				<?php $this->load->view( 'website/common/random_post', array( 'class_style' => 'mt20 alsolikebox', 'city_id' => $post['city_id'] ) ); ?>
				<?php $this->load->view( 'website/common/visit_post', array( 'class_style' => 'mt20 alsolikebox' ) ); ?>
			</div>
		</div>
	</div>
	
	<?php $this->load->view( 'website/common/footer' ); ?>
	<?php $this->load->view( 'website/common/library', array( 'js_add' => array( 'js-details.js', 'counter.js', 'initialize-carousel-detailspage.js' ) ) ); ?>
<script>
$('.btn-booking').click(function() {
	if ($('[name="booking[]"]:checked').length == 0) {
		if ($('[href="#how-booking"]').length > 0) {
			$('html, body').animate({scrollTop:700}, 'slow');
			$('[href="#how-booking"]').click();
			
			$.notify("Sorry ! Booking online is unavaliable, please see 'How to Booking' tab.", "error");
		} else {
			$.notify("Please select your booking option.", "error");
		}
		
		return false;
	}
	
	$('[name="booking[]"]:checked').each(function() {
		window.open(this.value);
	});
});
</script>
</body>
</html>

<?php
	// set post session
	$this->post_model->set_session($post);
?>