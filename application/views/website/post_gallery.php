<?php
	// user
	$is_login = $this->user_model->is_login();
	if ($is_login) {
		$user_session = $this->user_model->get_session();
		$user = $this->user_model->get_by_id(array( 'user_type_id' => $user_session['user_type_id'], 'id' => $user_session['id'] ));
	}
	
	// post
	$post = $this->post_model->get_by_id(array( 'alias' => $this->uri->segments[2] ));
	
	// tag
	$array_tag = $this->post_tag_model->get_array(array( 'post_id' => $post['id'] ));
	
	// current photo
	$photo = $array_gallery = array();
	if (empty($this->uri->segments[4])) {
		$photo = $this->post_traveler_photo_model->get_by_id(array( 'latest_photo' => true, 'post_id' => $post['id'] ));
	} else {
		// get photo by alias
		$photo = $this->post_traveler_photo_model->get_by_id(array( 'alias' => $this->uri->segments[4], 'post_id' => $post['id'] ));
		
		// alias not found
		if (count($photo) == 0) {
			header("HTTP/1.1 301 Moved Permanently");
			header('Location: '.base_url());
			exit;
		}
	}
	
	if (count($photo) > 0) {
		// post gallery prev
		$param_gallery_prev = array(
			'post_id' => $post['id'],
			'post_status' => 'approve',
			'post_date_max' => $photo['post_date'],
			'limit' => 2
		);
		$array_gallery_prev = $this->post_traveler_photo_model->get_array($param_gallery_prev);
		
		// post gallery next
		$param_gallery_next = array(
			'post_id' => $post['id'],
			'post_status' => 'approve',
			'post_date_min' => $photo['post_date'],
			'limit' => 2
		);
		$array_gallery_next = $this->post_traveler_photo_model->get_array($param_gallery_next);
		
		// array gallery
		$array_gallery = array();
		$array_gallery = array_merge($array_gallery_prev, array( $photo ), $array_gallery_next );
		
		// traveler
		$traveler = $this->traveler_model->get_by_id(array( 'id' => $photo['traveler_id'] ));
	}
	
	// widget
	$widget = $this->widget_model->get_by_id(array( 'alias' => 'widget-traveler-gallery' ));
	
	// breadcrub
	$array_breadcrub = array(
		array( 'link' => $post['link_category'], 'title' => $post['category_title'] ),
		array( 'link' => $post['link_region'], 'title' => $post['region_title'] ),
		array( 'link' => $post['link_city'], 'title' => $post['city_title'] ),
		array( 'link' => $post['link_post'], 'title' => $post['title_select'] ),
		array( 'link' => $post['link_post_gallery'], 'title' => 'Traveler Gallery' )
	);
	
	// prepare meta
	$keyword = $image_src = '';
	if (empty($this->uri->segments[4])) {
		$title = $post['title_select'].' - '.$post['city_title'];
		foreach ($array_tag as $row) {
			$keyword .= (empty($keyword)) ? $row['tag_title'] : ', '.$row['tag_title'];
		}
		$canonical = $post['link_post_gallery'];
		$array_gallery_temp = $this->post_traveler_photo_model->get_array(array( 'post_id' => $post['id'], 'post_status' => 'approve', 'limit' => 10 ));
		foreach ($array_gallery_temp as $row) {
			$image_src .= (empty($keyword)) ? $row['thumbnail_link'] : ', '.$row['thumbnail_link'];
		}
	} else {
		$title = $photo['title'].' - '.$post['title_select'].' - '.$post['city_title'];
		$keyword = $post['title_select'].', '.$photo['title'];
		$canonical = $photo['link_traveler_photo'];
		$image_src = $photo['thumbnail_link'];
		$citation_authors = $photo['traveler_full_name'];
	}
	
	// meta
	$array_seo = array(
		'title' => $title,
		'array_meta' => array( ),
		'array_link' => array( )
	);
	$array_seo['array_meta'][] = array( 'name' => 'Description', 'content' => get_length_char($post['desc_01_select'], 150, '') );
	$array_seo['array_meta'][] = array( 'name' => 'Keywords', 'content' => $keyword );
	$array_seo['array_link'][] = array( 'rel' => 'canonical', 'href' => $canonical );
	$array_seo['array_link'][] = array( 'rel' => 'image_src', 'href' => $image_src );
	if (!empty($citation_authors)) {
		$array_seo['array_link'][] = array( 'rel' => 'citation_authors', 'href' => $citation_authors );
	}
	
	// page
	$page['link_post'] = $post['link_post'];
	if ($is_login) {
		$page['user'] = $user;
	}
?>

<?php $this->load->view( 'website/common/meta', $array_seo ); ?>
<body id="top" class="thebg">
	<?php $this->load->view( 'website/common/header_menu' ); ?>
	<?php $this->load->view( 'website/common/breadcrub', array( 'array' => $array_breadcrub ) ); ?>
	<div class="hide">
		<div id="cnt-page"><?php echo json_encode($page); ?></div>
	</div>
	
	<div class="container">
		<div class="container pagecontainer offset-0">
			<div class="col-md-8 details-slider"><div id="c-carousel"><div id="wrapper">
				<div id="inner">
					<?php if (count($photo) > 0) { ?>
					<div id="caroufredsel_wrapper2">
						<div id="carousel">
							<img src="<?php echo $photo['thumbnail_link']; ?>" style="width: 100%; height: 80%;" alt=""/>
						</div>
					</div>
					<div id="pager-wrapper">
						<div class="caroufredsel_wrapper" style="display: block; text-align: start; float: none; position: relative; top: auto; right: auto; bottom: auto; left: auto; z-index: auto; width: 759px; height: 120px; margin: 0px; overflow: hidden;"><div id="pager" style="text-align: left; float: none; position: absolute; top: 0px; right: auto; bottom: auto; left: 30px; margin: 0px; width: 2439px; height: 100px; z-index: auto;">
							<?php foreach ($array_gallery as $row) { ?>
								<?php $style_class = ($row['id'] == $photo['id']) ? 'selected' : ''; ?>
								<a href="<?php echo $row['link_traveler_photo']; ?>">
									<img width="120" height="68" alt="" src="<?php echo $row['thumbnail_link']; ?>" style="margin-right: 10px;" class="<?php echo $style_class; ?>">
								</a>
							<?php } ?>
						</div></div>
					</div>
					<?php } else { ?>
					<div id="caroufredsel_wrapper2">
						<div id="carousel">
							<img src="<?php echo base_url('static/img/no-image-available.gif'); ?>" style="width: 100%; height: 80%;" alt=""/>
						</div>
					</div>
					<?php } ?>
				</div>
				<div class="clearfix"></div>
				<button id="prev_btn2" class="prev2"><img src="<?php echo base_url('static/theme/forest/images/spacer.png'); ?>" alt=""/></button>
				<button id="next_btn2" class="next2"><img src="<?php echo base_url('static/theme/forest/images/spacer.png'); ?>" alt=""/></button>
			</div></div></div>
			
			<div class="col-md-4 detailsright offset-0">
				<div class="padding20">
					<div class="cpadding11">
						<span class="icon-location"></span>
						<h3 class="opensans"><?php echo $post['title_select']; ?></h3>
						<div class="clearfix"></div>
					</div>
				</div>
				<div class="line3"></div><br />
				
				<div class="col-md-6 bordertype3"><?php echo $post['review_count']; ?> reviews</div>
				<div class="col-md-6 bordertype3">
					<a href="<?php echo $post['link_post_review']; ?>" class="grey">+Add review</a>
				</div>
				<div class="clearfix"></div><br />
				
				<div class="hpadding20">
					<?php if (count($photo) > 0) { ?>
					<a class="cursor add2fav margtop5 report-image">Report this image</a>
					<?php } ?>
					<a href="<?php echo $photo['link_timeline']; ?>" class="booknow margtop20 btnmarg">Traveler Timeline</a>
					<a href="<?php echo $post['link_post_upload']; ?>" class="booknow margtop20 btnmarg">Upload Your Photo</a>
				</div>
			</div>
		</div>
		
		<div class="container mt25 offset-0" id="cnt-gallery">
			<div class="col-md-8 pagecontainer2 offset-0">
				<div class="cnt-widget">
					<div class="tab-content4">
						<p class="hpadding20"><?php echo $widget['content']; ?></p>
					</div>
				</div>
				
				<?php if (count($photo) > 0) { ?>
				<div class="cnt-report" style="display: none;">
					<h2 class="opensans slim green2"><div style="margin-left:20px;">Report Image</div></h2><br />
					<div class="line2"></div><br />
					<form class="form-class" id="form-payment">
						<input type="hidden" name="action" value="report_traveler_photo" />
						<input type="hidden" name="post_traveler_photo_id" value="<?php echo $photo['id']; ?>" />
						
						<div class="cnt-login">
							<div class="left">Name</div>
							<div class="right"><input type="text" name="name" class="form-control wh70percent" placeholder="Name" /></div>
							<div class="clearfix"></div>
							<div class="left">Email</div>
							<div class="right"><input type="text" name="email" class="form-control wh70percent" placeholder="Email" /></div>
							<div class="clearfix"></div>
						</div>
						<div class="left">Topic</div>
						<div class="right"><input type="text" name="topic" class="form-control wh70percent" placeholder="Topic" /></div>
						<div class="clearfix"></div>
						<div class="left">Description</div>
						<div class="right"><textarea name="content" class="form-control wh70percent" rows="3" placeholder="Description"></textarea></div>
						<div class="clearfix"></div>
						<div class="left">&nbsp;</div>
						<div class="right"><button type="submit" class="btn-search4">Submit</button></div>
						<div class="clearfix"></div>
					</form>
					<div class="clearfix"></div>
				</div>
				<?php } ?>
			</div>
			<div class="col-md-4">
				<?php if (count($photo) > 0) { ?>
				<div class="pagecontainer2 testimonialbox">
					<div class="cpadding0 mt-10">
						<span class="icon-quote"></span>
						<p class="opensans size16 grey2">
							<?php echo $photo['title']; ?><br />
							<?php echo $photo['content']; ?><br /><br />
							<span class="lato orange bold size13"><i>by <?php echo $traveler['full_name']; ?> from <?php echo $traveler['country_title']; ?></i></span>
						</p>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
	
	<?php $this->load->view( 'website/common/footer' ); ?>
	<?php $this->load->view( 'website/common/library', array( 'js_add' => array( 'js-details.js', 'counter.js' ) ) ); ?>
<script>
$(document).ready(function() {
	var page = {
		init: function() {
			var raw_page = $('#cnt-page').html();
			eval('var data = ' + raw_page);
			page.data = data;
			
			// is login
			if (page.data.user != null) {
				$('#cnt-gallery .cnt-login').hide();
				$('#cnt-gallery [name="name"]').val(page.data.user.full_name);
				$('#cnt-gallery [name="email"]').val(page.data.user.email);
			}
		}
	}
	page.init();
	
	// form report
	$('#cnt-gallery form').validate({
		rules: {
			name: { required: true },
			email: { required: true },
			topic: { required: true },
			content: { required: true }
		}
	});

	$('#cnt-gallery form').submit(function(e) {
		e.preventDefault();
		if (! $('#cnt-gallery form').valid()) {
			return false;
		}
		
		var param = Site.Form.GetValue('cnt-gallery form');
		Func.update({
			param: param,
			link: page.data.link_post + '/action',
			callback: function(result) {
				$('#cnt-gallery form')[0].reset();
				page.init();
			}
		});
	});
	
	// helper
	$('.report-image').click(function() {
		$('#cnt-gallery .cnt-widget').hide();
		$('#cnt-gallery .cnt-report').show();
		
		$('html, body').animate({scrollTop:700}, 'slow');
	});
});
</script>
</body>
</html>
