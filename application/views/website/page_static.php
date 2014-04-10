<?php
	$alias = $this->uri->segments[1];
	$page_static = $this->page_static_model->get_by_id(array( 'alias' => $alias ));
	
	// breadcrub
	$array_breadcrub = array(
		array( 'link' => '#', 'title' => $page_static['title'] )
	);
?>

<?php $this->load->view( 'website/common/meta' ); ?>
<body id="top" class="thebg" >
	<?php $this->load->view( 'website/common/header_menu' ); ?>
	<?php $this->load->view( 'website/common/breadcrub', array( 'array' => $array_breadcrub ) ); ?>
	
	<div class="container">
		<div class="container mt25 offset-0">
			<div class="col-md-12 pagecontainer2 offset-0">
				<div class="hpadding50c">
					<p class="lato size30 slim"><?php echo $page_static['title']; ?></p>
					<p class="aboutarrow"></p>
				</div>
				<div class="line3"></div>
				
				<div class="hpadding50c">
					<div class="col-md-8 cpdd01 grey2">
						<?php echo $page_static['content']; ?>
						<div class="clearfix"></div>
						<div class="line4"></div>
					</div>
					
					<div class="col-md-4 cpdd02">
						<?php $this->load->view( 'website/common/widget_01' ); ?>
					</div>
					<div class="clearfix"></div>
					<br /><br />
				</div>
				<div class="clearfix"></div><br /><br />
			</div>
		</div>
	</div>
	
	<?php $this->load->view( 'website/common/footer' ); ?>
	<?php $this->load->view( 'website/common/library', array( 'js_add' => array( 'js-blog.js', 'lightbox.js' ) ) ); ?>
  </body>
</html>
