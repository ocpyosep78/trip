<?php
	// traveler
	$traveler = $this->traveler_model->get_by_id(array( 'alias' => $this->uri->segments[2] ));
	  
	
	// array timeline
	$array_timeline = $this->traveler_model->get_array_timeline(array( 'traveler_id' => $traveler['id'] ));
	
	// array seo
	$array_seo = array(
		'title' => $traveler['full_name'],
		'array_meta' => array(
			array( 'name' => 'Title', 'content' => $traveler['full_name'] )
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
			
			<?php foreach ($array_timeline as $key => $row) { ?>
			<?php if ($row['type'] == 'gallery') { ?>
			<article style="position: absolute; left: 0px; top: 0px;" class="post-66 post type-post status-publish format-gallery hentry category-photography item six columns isotope-item item-right item-left">
				<span class="indicator-top"></span>
				<div class="post-content"><!-- BEGIN .post-content -->
					<a href="<?php echo $row['link_source']; ?>" title="<?php echo $row['title']; ?>" rel="bookmark">
						<div class="entry-format entry-gallery"><!-- BEGIN .entry-format -->
							<img src="<?php echo $row['thumbnail_link']; ?>" alt="flowers-2" height="673" width="602" />
						</div><!-- END .entry-format -->
					</a>
					<header class="entry-header">
						<h2 class="entry-title">
							<a href="<?php echo $row['link_source']; ?>" title="<?php echo $row['title']; ?>" rel="bookmark">
								<?php echo $row['title']; ?>
							</a>
						</h2>
					</header>
					<div class="entry-content"><!-- BEGIN .entry-content -->
						<p><?php echo get_length_char($row['content'], 150, ' ...'); ?></p>
						<p><a href="#" class="more-link">Continue reading <span class="meta-nav">»</span></a></p>
					</div><!-- END .entry-content -->
				</div><!-- END .post-content -->
				<div class="entry-meta"><!-- BEGIN .entry-meta -->
					<span class="indicator"></span>
					<span class="posted meta-item">
						<a href="#" title="" rel="bookmark"><span class="entry-date">20/5/2014</span></a>
					</span>
					<span class="read-more meta-item">
						<div style="float:left;color:#b30;">Share : &nbsp;&nbsp;</div>
						<a href="http://www.facebook.com/sharer.php?u=<?php echo $traveler['link_traveler']; ?>" target="_blank">Facebook</a>
					</span>
				</div><!-- END .entry-meta -->
			</article>
			<?php } else if ($row['type'] == 'review') { ?>
			<article style="position: absolute; left: 0px; top: 0px;" class="post-66 post type-post status-publish format-gallery hentry category-photography item six columns isotope-item item-right item-left">
				<span class="indicator-top"></span>
				<div class="post-content"><!-- BEGIN .post-content -->
					<header class="entry-header">
						<h2 class="entry-title">
							<a href="<?php echo $row['link_source']; ?>" title="<?php echo $row['title']; ?>" rel="bookmark">
								<?php echo $row['title']; ?>
							</a>
						</h2>
					</header>
					<div class="entry-content"><!-- BEGIN .entry-content -->
						<p><?php echo get_length_char($row['content'], 150, ' ...'); ?></p>
						<p><a href="#" class="more-link">Continue reading <span class="meta-nav">»</span></a></p>
					</div><!-- END .entry-content -->
				</div><!-- END .post-content -->
				<div class="entry-meta"><!-- BEGIN .entry-meta -->
					<span class="indicator"></span>
					<span class="posted meta-item">
						<a href="#" title="" rel="bookmark"><span class="entry-date">20/5/2014</span></a>
					</span>
					<span class="read-more meta-item">
						<div style="float:left;color:#b30;">Share : &nbsp;&nbsp;</div>
						<a href="http://www.facebook.com/sharer.php?u=<?php echo $traveler['link_traveler']; ?>" target="_blank">Facebook</a>
					</span>
				</div><!-- END .entry-meta -->
			</article>
			<?php } ?>
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