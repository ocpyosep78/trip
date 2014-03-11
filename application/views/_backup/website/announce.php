<?php
	preg_match('/announce\/([a-z0-9\-]+)$/i', $_SERVER['REQUEST_URI'], $match);
	$alias = (isset($match[1])) ? $match[1] : '';
	$announce = $this->Announce_model->get_by_id(array( 'alias' => $alias ));
	
	// page index / detail => ???
	$is_index = true;
	if (count($announce) > 0) {
		$is_index = false;
	}
	
	// collect data
	if ($is_index) {
		$array_announce = $this->Announce_model->get_array();
	}
	
	// build breadcrumb
	$param_breadcrumb['title_list'][] = array( 'link' => base_url(), 'title' => 'Home', 'class' => 'first' );
	$param_breadcrumb['title_list'][] = array( 'link' => base_url('announce'), 'title' => 'announce' );
	if (!$is_index) {
		$param_breadcrumb['title_list'][] = array( 'link' => $announce['announce_link'], 'title' => $announce['name'] );
	}
?>
<?php $this->load->view('website/common/meta'); ?>
<body id="offcanvas-container" class="offcanvas-container layout-fullwidth fs12 page-product">
<section id="page" class="offcanvas-pusher" role="main">
	<?php $this->load->view('website/common/header'); ?>
	
	<section id="columns" class="offcanvas-siderbars">
		<?php $this->load->view( 'website/common/breadcrumb', $param_breadcrumb ); ?>
		
		<div class="container"><div class="row">
			<section class="col-lg-99 col-md-9 col-sm-12 col-xs-12 main-column">
				<div id="content" class="product-detail">
					
					<?php if ($is_index) { ?>
					<div class="product-list"><div class="products-block"><div class="row">
						<?php foreach ($array_announce as $key => $row) { ?>
						<div class="col-lg-333 col-md-3 col-sm-6 col-xs-12 col-fullwidth">
							<div class="product-block">
								<div class="product-meta">
									<div class="left">
										<h3 class="name"><a href="<?php echo $row['announce_link']; ?>"><?php echo $row['name']; ?></a></h3>
										<p class="description"><?php echo get_length_char($row['name'], 250, ' ...'); ?></p>
										<p class="my-date"><?php echo GetFormatDate($row['post_time']); ?></p>
									</div>
								</div>
							</div>
						</div>
						<?php } ?>
					</div></div></div>
					<?php } else { ?>
					<div class="product-info">
						<div class="row">
							<div class="col-lg-7-single col-sm-7-gambar col-xs-12">
								<div class="description">
									<h3><?php echo $announce['name']; ?></h3><hr>
									<?php echo $announce['content']; ?>
								</div>
							</div>
						</div>
					</div>
					<?php } ?>
					
				</div> 
			</section>
			
			<aside id="oc-column-right" class="col-lg-3 col-md-3 col-sm-12 col-xs-12 offcanvas-sidebar">
				<div id="column-right" class="sidebar">
					<?php $this->load->view('website/common/widget_section'); ?>
				</div>
			</aside>
		</div></div>
	</section>
	
	<?php $this->load->view('website/common/footer'); ?>
</section>

<?php $this->load->view('website/common/menu_canvas'); ?>
</body></html>