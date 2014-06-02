<?php
	// user
	$is_login = $this->user_model->is_login();
	if ($is_login) {
		$user_session = $this->user_model->get_session();
		$user = $this->user_model->get_by_id(array( 'user_type_id' => $user_session['user_type_id'], 'id' => $user_session['id'] ));
	}
	
	// review alias
	$with_review_alias = false;
	if (!empty($this->uri->segments[4])) {
		$with_review_alias = true;
	}
	
	// post
	$post = $this->post_model->get_by_id(array( 'alias' => $this->uri->segments[2] ));
	if ($with_review_alias) {
		$param_traveler = array( 'post_id' => $post['id'], 'alias' => $this->uri->segments[4] );
		$post_traveler_review = $this->post_traveler_review_model->get_by_id($param_traveler);
	}
	
	// master
	$array_language = $this->language_model->get_array();
	
	// review
	$page_item = 3;
	$page_active = (isset($_POST['page_active'])) ? $_POST['page_active'] : 1;
	$param_review = array(
		'post_id' => $post['id'],
		'post_status' => 'approve',
		'sort' => '[{"property":"post_traveler_review.post_date","direction":"DESC"}]',
		'start' => ($page_active - 1) * $page_item,
		'limit' => $page_item
	);
	
	// additional filter
	if (!empty($_POST['language_id'])) {
		$param_review['language_id'] = $_POST['language_id'];
	}
	if ($with_review_alias) {
		$param_review['alias'] = $this->uri->segments[4];
	}
	
	// array review
	$array_review = $this->post_traveler_review_model->get_array($param_review);
	
	// paging count
	$page_count = ceil($this->post_traveler_review_model->get_count() / $page_item);
	
	// breadcrub
	$array_breadcrub = array(
		array( 'link' => $post['link_category'], 'title' => $post['category_title'] ),
		array( 'link' => $post['link_region'], 'title' => $post['region_title'] ),
		array( 'link' => $post['link_city'], 'title' => $post['city_title'] ),
		array( 'link' => $post['link_post'], 'title' => $post['title_select'] ),
		array( 'link' => $post['link_post_review'], 'title' => 'Review' )
	);
	if ($with_review_alias) {
		$array_breadcrub[] = array( 'link' => $post_traveler_review['link_post_review_detail'], 'title' => $post_traveler_review['title'] );
	}
	
	// prepare meta
	$keyword = '';
	if ($with_review_alias) {
		$title = 'Review | '.$post['title_select'].' - '.$post_traveler_review['title'].' - '.$post['city_title'];
		$description = $post_traveler_review['content'];
		$keyword = 'Review, '.$post['title_select'];
		$canonical = $post_traveler_review['link_post_review_detail'];
		$image_src = $post['link_thumbnail'];
		$citation_authors = $post['full_name'];
	} else {
		$title = 'Review | '.$post['title_select'].' - '.$post['city_title'];
		$description = get_length_char($post['desc_01_select'], 150, '');
		$keyword = $post['title_select'];
		$canonical = $post['link_post_review'];
		$image_src = $post['link_thumbnail'];
		$citation_authors = $post['full_name'];
	}
	
	// meta
	$array_seo = array(
		'title' => $title,
		'array_meta' => array( ),
		'array_link' => array( )
	);
	$array_seo['array_meta'][] = array( 'name' => 'Description', 'content' => $description );
	$array_seo['array_meta'][] = array( 'name' => 'Keywords', 'content' => $keyword );
	$array_seo['array_link'][] = array( 'rel' => 'canonical', 'href' => $canonical );
	$array_seo['array_link'][] = array( 'rel' => 'image_src', 'href' => $image_src );
	if (!empty($citation_authors)) {
		$array_seo['array_link'][] = array( 'rel' => 'citation_authors', 'href' => $citation_authors );
	}
?>

<?php $this->load->view( 'website/common/meta', $array_seo ); ?>
<body id="top" class="thebg">
	<?php $this->load->view( 'website/common/header_menu' ); ?>
	<?php $this->load->view( 'website/common/breadcrub', array( 'array' => $array_breadcrub ) ); ?>
	
	<div class="container">	<div class="hreview-aggregate">   <span class="votes">24</span> ratings.    			
		<div class="container mt25 offset-0">
			<div class="col-md-8 pagecontainer2 offset-0">
				<br /><br />
				
				<h2 class="opensans slim green2">
					<div style="margin-left:20px;">															   <span class="item">      <span class="fn">Review | <?php echo $post['title_select']; ?></span>      <img src="logo.png" class="photo" />                       </span>										</div>
				</h2><br />
				<p class="hpadding20"><span class="description"><?php echo get_length_char($post['desc_01_select'], 600, ' ...'); ?></span></p>
				
				<form method="post" id="form-review">
					<input type="hidden" name="page_active" value="1" />
					
					<div class="hpadding20">
						<br /><br />
						<span class="opensans dark size16 bold">						<div style="color:#fff;"><span class="rating">4.5</span></div>  Reviews</span>
						<?php if (! $with_review_alias) { ?>
						<div style="width:40%; float:right; margin-top:-15px;">
							<select class="form-control mySelectBoxClass margtop10" name="language_id">
								<?php echo ShowOption(array( 'Array' => $array_language, 'LabelEmptySelect' => 'Sort Language', 'Selected' => @$_POST['language_id'] )); ?>
							</select>
						</div>
						<?php } ?>
					</div>
					<div class="line2"></div>
				</form>
				
				<?php $this->load->view( 'website/common/review_list', array( 'array_review' => $array_review ) ); ?>
				
				<?php if ($with_review_alias) { ?>
				<div style="padding: 15px 15px 0 0;">&nbsp;</div>
				<?php } else if (!empty($page_count)) { ?>
				<div style="padding: 15px 15px 0 0;">
					<ul class="pagination right paddingbtm20">
						<?php if ($page_active > 1) { ?>
						<li class="cursor"><a data-page_active="1">&laquo;</a></li>
						<?php } else { ?>
						<li class="disabled"><a>&laquo;</a></li>
						<?php } ?>
						
						<?php for ($i = -5; $i <= 5; $i++) { ?>
							<?php $page_counter = $page_active + $i; ?>
							<?php $class = ($i == 0) ? 'active' : ''; ?>
							<?php if ($page_counter > 0 && $page_counter <= $page_count) { ?>
							<li class="cursor <?php echo $class; ?>"><a data-page_active="<?php echo $page_counter; ?>"><?php echo $page_counter; ?></a></li>
							<?php } ?>
						<?php } ?>
						
						<?php if ($page_active < $page_count) { ?>
						<li class="cursor"><a data-page_active="<?php echo $page_count; ?>">&raquo;</a></li>
						<?php } else { ?>
						<li class="disabled"><a>&raquo;</a></li>
						<?php } ?>
					</ul>
				</div>
				<div class="clearfix"></div>
				<?php } ?>
				
				<?php if (! $with_review_alias) { ?>
				<div id="cnt-review">
					<div class="hpadding20">
						<span class="opensans dark size16 bold">Write Your Reviews</span>
					</div>
					<div class="line2"></div>
					
					<?php if ($is_login && $user['user_type_id'] == USER_TYPE_TRAVELER) { ?>
					<form class="form-class" style="padding: 15px 0 0 0;">
						<input type="hidden" name="action" value="review_update" />
						<input type="hidden" name="post_id" value="<?php echo $post['id']; ?>" />
						
						<div class="left">Evaluation</div>
						<div class="right">
							<select name="evaluation" class="form-control mySelectBoxClass wh70percent">
								<option value="" selected>-</option>
								<option value="Wonderful!">Wonderful!</option>
								<option value="Recommended for Everyone">Recommended for Everyone</option>
								<option value="Nice">Nice</option>
								<option value="Neutral">Neutral</option>
								<option value="Don't recommend">Don't recommend</option>
							</select>
						</div>
						<div class="clearfix"></div>
						<div class="left">My Language</div>
						<div class="right">
							<select name="language_id" class="form-control mySelectBoxClass wh70percent">
								<?php echo ShowOption(array( 'Array' => $array_language )); ?>
							</select>
						</div>
						<div class="clearfix"></div>
						<div class="left">When did you visit ?</div>
						<div class="right"><input type="text" name="visit_date" class="form-control wh70percent datepicker" placeholder="When did you visit ?" /></div>
						<div class="clearfix"></div>
						<div class="left">Title</div>
						<div class="right"><input type="text" name="title" class="form-control wh70percent" placeholder="Title" /></div>
						<div class="clearfix"></div>
						<div class="left">Rating</div>
						<div class="right">
							<select name="rating" class="form-control mySelectBoxClass wh70percent">
								<option value="" selected>-</option>
								<option value="0">0</option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
							</select>
						</div>
						<div class="clearfix"></div>
						<div class="left">Your Review</div>
						<div class="right"><textarea name="content" class="form-control wh70percent" rows="3" placeholder="Your Review"></textarea></div>
						<div class="clearfix"></div>
						<div class="left">&nbsp;</div>
						<div class="right">
							<div style="width: 85%;">
								I certify that this review is based on my own experience and is my genuine opinion of this restaurant, and that I have no personal or business relationship with this establishment, and have not been offered any incentive or payment originating from the establishment to write this review. I understand that TripAdvisor has a zero-tolerance policy on fake reviews.
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="left">&nbsp;</div>
						<div class="right"><button type="submit" class="btn-search4">Submit</button></div>
						<div class="clearfix"></div>
						<br /><br />
					</form>
					<div class="clearfix"></div>
					<?php } else { ?>
					<div class="center" style="margin: 45px 0;">
						<a class="btn-search4" href="<?php echo base_url('login/traveler'); ?>">Please login as Traveler to submit review</a>
					</div>
					<?php } ?>
				</div>
				<div class="clearfix"></div>
				<?php } ?>
			</div>
			
			<div class="col-md-4">
				<?php $this->load->view( 'website/common/side_upload', array( 'link_upload' => $post['link_post_upload'] ) ); ?>
				<?php $this->load->view( 'website/common/random_post', array( 'class_style' => 'mt20 alsolikebox', 'city_id' => $post['city_id']) ); ?>
				<?php $this->load->view( 'website/common/visit_post', array( 'class_style' => 'mt20 alsolikebox' ) ); ?>
			</div>
		</div>
	</div></div>
	
	<?php $this->load->view( 'website/common/footer' ); ?>
	<?php $this->load->view( 'website/common/library', array( 'js_add' => array( 'js-details.js', 'counter.js' ) ) ); ?>

<script>
$('#cnt-review form').validate({
	rules: {
		evaluation: { required: true },
		language_id: { required: true },
		post_date: { required: true },
		title: { required: true },
		rating: { required: true },
		content: { required: true }
	}
});

$('#cnt-review form').submit(function(e) {
	e.preventDefault();
	if (! $('#cnt-review form').valid()) {
		return false;
	}
	
	var param = Site.Form.GetValue('cnt-review form');
	Func.update({
		param: param,
		link: window.location.href + '/action',
		callback: function(result) {
			$('#cnt-review form')[0].reset();
		}
	});
});

$('#form-review [name="language_id"]').change(function() {
	$('#form-review').submit();
});
$('.pagination a').click(function() {
	$('#form-review [name="page_active"]').val($(this).data('page_active'));
	$('#form-review').submit();
});
</script>

</body>
</html>
