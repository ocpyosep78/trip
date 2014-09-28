<?php
	// post
	$post = $this->post_model->get_by_id(array( 'alias' => $this->uri->segments[4] ));
	
	// get photo / review by alias
	$photo = $review = array();
	$photo = $this->post_traveler_photo_model->get_by_id(array( 'alias' => $this->uri->segments[6], 'post_id' => $post['id'] ));
	if (count($photo) == 0) {
		$review = $this->post_traveler_review_model->get_by_id(array( 'alias' => $this->uri->segments[6], 'post_id' => $post['id'] ));
	}
	if (count($photo) > 0) {
		$timeline = $this->post_traveler_photo_model->get_timeline($photo);
	} else if (count($review) > 0) {
		$timeline = $this->post_traveler_review_model->get_timeline($review);
	} else {
		echo 'Timeline is empty.<br /> Back to <a href="'.base_url().'">Home</a>';
		exit;
	}
	
	// traveler
	$traveler = $this->traveler_model->get_by_id(array( 'alias' => $this->uri->segments[2] ));
	
	// array seo
	$array_seo = array(
		'title' => $traveler['full_name'].' - '.$timeline['title'],
		'array_meta' => array(
			array( 'name' => 'Title', 'content' => $traveler['full_name'].' - '.$timeline['title'] ),
			array( 'name' => 'Description', 'content' => $timeline['content'] )
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
			
			<?php if ($timeline['type'] == 'gallery') { ?>
			<article style="position: absolute; left: 0px; top: 0px;" class="post-66 post type-post status-publish format-gallery hentry category-photography item six columns isotope-item item-right item-left">
				<span class="indicator-top"></span>
				<div class="post-content"><!-- BEGIN .post-content -->
					<a href="<?php echo $timeline['link_source']; ?>" title="<?php echo $timeline['title']; ?>" rel="bookmark">
						<div class="entry-format entry-gallery"><!-- BEGIN .entry-format -->
							<img src="<?php echo $timeline['thumbnail_link']; ?>" alt="flowers-2" height="673" width="602" />
						</div><!-- END .entry-format -->
					</a>
					<header class="entry-header">
						<h2 class="entry-title">
							<a href="<?php echo $timeline['link_source']; ?>" title="<?php echo $timeline['title']; ?>" rel="bookmark">
								<?php echo $timeline['title']; ?>
							</a>
						</h2>
					</header>
					<div class="entry-content"><!-- BEGIN .entry-content -->
						<p><?php echo get_length_char($timeline['content'], 150, ' ...'); ?></p>
						<p><a href="#" class="more-link">Continue reading <span class="meta-nav">»</span></a></p>
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
			</article>
			<?php } else if ($timeline['type'] == 'review') { ?>
			<article style="position: absolute; left: 0px; top: 0px;" class="post-66 post type-post status-publish format-gallery hentry category-photography item six columns isotope-item item-right item-left">
				<span class="indicator-top"></span>
				<div class="post-content"><!-- BEGIN .post-content -->
					<header class="entry-header">
						<h2 class="entry-title">
							<a href="<?php echo $timeline['link_source']; ?>" title="<?php echo $timeline['title']; ?>" rel="bookmark">
								<?php echo $timeline['title']; ?>
							</a>
						</h2>
					</header>
					<div class="entry-content"><!-- BEGIN .entry-content -->
						<p><?php echo get_length_char($timeline['content'], 150, ' ...'); ?></p>
						<p><a href="#" class="more-link">Continue reading <span class="meta-nav">»</span></a></p>
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
			</article>
			<?php } ?>
			
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