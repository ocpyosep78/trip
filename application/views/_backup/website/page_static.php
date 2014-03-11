<?php	
	// build breadcrumb
	$param_breadcrumb['title_list'][] = array( 'link' => base_url(), 'title' => 'Home', 'class' => 'first' );
	$param_breadcrumb['title_list'][] = array( 'link' => $page_static['page_link'], 'title' => $page_static['name'] );
	
	/* region seo */
	
	// meta
	$param_meta = array(
		'title' => $page_static['name'].' - '.WEBSITE_DOMAIN,
		'array_meta' => array(
			array( 'name' => 'Title', 'content' => $page_static['name'] ),
			array( 'name' => 'Description', 'content' => get_length_char($page_static['content'], 200, '') ),
			array( 'name' => 'Keywords', 'content' => WEBSITE_TITLE.', '.$page_static['name'] )
		),
		'array_link' => array(
			array( 'rel' => 'canonical', 'href' => $page_static['page_link'] ),
			array( 'rel' => 'image_src', 'href' => base_url(WEBSITE_LOGO) )
		)
	);
	
	/* end region seo */
?>
<?php $this->load->view( 'website/common/meta', $param_meta ); ?>
<body id="offcanvas-container" class="offcanvas-container layout-fullwidth fs12 page-product">
<section id="page" class="offcanvas-pusher" role="main">
	<?php $this->load->view('website/common/header'); ?>
	
	<section id="columns" class="offcanvas-siderbars">
		<?php $this->load->view( 'website/common/breadcrumb', $param_breadcrumb ); ?>
		
		<div class="container"><div class="row">
			<section class="col-lg-99 col-md-9 col-sm-12 col-xs-12 main-column">
				<div id="content" class="product-detail">
					<div class="product-info">
						<div class="row">
							<div class="col-lg-7-single col-sm-7-gambar col-xs-12">
								<div class="description">
									<h3><?php echo $page_static['name']; ?></h3><hr>
									<?php echo $page_static['content']; ?>
								</div>
							</div>
						</div>
					</div>
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