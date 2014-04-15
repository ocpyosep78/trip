<?php
	// get name like
	preg_match('/search\/([a-z0-9\-]+)/i', $_SERVER['REQUEST_URI'], $match);
	$keyword = (empty($match[1])) ? '' : $match[1];
	$namelike = str_replace('-', ' ', $keyword);
	$link_search = base_url('search/'.$keyword);
	
	// get page info
	preg_match('/page-([0-9]+)$/', $_SERVER['REQUEST_URI'], $match);
	$page_item = 10;
	$page_active = (empty($match[1])) ? 1 : $match[1];
	
	
	// array post
	if (!empty($namelike)) {
		$param_post = array(
			'post_status' => 'approve',
			'namelike' => $namelike,
			'sort' => '[{"property":"title","direction":"ASC"}]',
			'start' => ($page_active - 1) * $page_item,
			'limit' => $page_item
		);
		$array_post = $this->post_model->get_array($param_post);
		$page_count = ceil($this->post_model->get_count() / $page_item);
	}
	
	// breadcrub
	$array_breadcrub = array(
		array( 'link' => '#', 'title' => 'Search' ),
		array( 'link' => '#', 'title' => ucwords($namelike) )
	);
?>

<?php $this->load->view( 'website/common/meta' ); ?>
<body id="top" class="thebg" >
	<?php $this->load->view( 'website/common/header_menu' ); ?>
	<?php $this->load->view( 'website/common/breadcrub', array( 'array' => $array_breadcrub ) ); ?>
	
	<div class="container">
		<div class="container mt25 offset-0">
			<div class="col-md-8 pagecontainer2 offset-0">
				<?php if (!empty($namelike) && count($array_post) == 0) { ?>
					<div class="padding30 grey">
						<div class="cpadding1">
							<h3 class="opensans">No result found for <u><?php echo $namelike; ?></u>.</h3>
							<div class="clearfix"></div>
						</div><br /><br />
					</div>
				<?php } else if (!empty($namelike) && count($array_post) > 0) { ?>
					<div class="padding30 grey">
						<div class="cpadding1">
							<h3 class="opensans">Result of <u><?php echo ucwords($namelike); ?></u></h3>
							<div class="clearfix"></div>
						</div><br /><br />
						
						<?php foreach ($array_post as $key => $row) { ?>
							<div class="deal">
								<a href="details.html"><img src="<?php echo $row['link_thumbnail_small']; ?>" alt="<?php echo $row['title_select']; ?>" class="dealthumb" style="width: 50px; height: 50px;" /></a>
								<div class="dealtitle" style="max-width: 85%;">
									<p><a href="<?php echo $row['link_post']; ?>" class="dark"><?php echo $row['title_select']; ?></a></p>
									<span class="size13 grey mt-9"><?php echo get_length_char(string_escape($row['desc_01_select']), 175, ' ...'); ?></span>
								</div>
							</div>
						<?php } ?>
						<div class="clearfix"></div>
					</div>
					
					<div class="hpadding20">
						<ul class="pagination right paddingbtm20">
							<?php if ($page_active > 1) { ?>
							<li class="cursor"><a href="<?php echo $link_search; ?>">&laquo;</a></li>
							<?php } else { ?>
							<li class="disabled"><a>&laquo;</a></li>
							<?php } ?>
							
							<?php for ($i = -5; $i <= 5; $i++) { ?>
								<?php $page_counter = $page_active + $i; ?>
								<?php $class = ($i == 0) ? 'active' : ''; ?>
								<?php if ($page_counter > 0 && $page_counter <= $page_count) { ?>
								<li class="cursor <?php echo $class; ?>"><a href="<?php echo $link_search.'/page-'.$page_counter; ?>"><?php echo $page_counter; ?></a></li>
								<?php } ?>
							<?php } ?>
							
							<?php if ($page_active < $page_count) { ?>
							<li class="cursor"><a href="<?php echo $link_search.'/page-'.$page_count; ?>">&raquo;</a></li>
							<?php } else { ?>
							<li class="disabled"><a>&raquo;</a></li>
							<?php } ?>
						</ul>
					</div>
				<?php } else { ?>
					<div class="padding30 grey">
						<div class="cpadding1">
							<h3 class="opensans">Please enter your keyword to search.</h3>
							<div class="clearfix"></div>
						</div><br /><br />
					</div>
				<?php } ?>
			</div>
			<div class="col-md-4">
				<?php $this->load->view( 'website/common/random_post' ); ?>
			</div>
		</div>
	</div>
	
	<?php $this->load->view( 'website/common/footer' ); ?>
	<?php $this->load->view( 'website/common/library', array( 'js_add' => array( 'js-payment.js' ) ) ); ?>
</body>
</html>