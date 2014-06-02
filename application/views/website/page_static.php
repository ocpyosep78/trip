<?php
	$alias = $this->uri->uri_string;
	$page_static = $this->page_static_model->get_by_id(array( 'alias' => $alias ));
	
	// breadcrub
	$array_breadcrub = array(
		array( 'link' => '#', 'title' => $page_static['title'] )
	);
	
	// meta
	$array_seo = array(
		'title' => WEBSITE_TITLE.' - '.$page_static['title'],
		'array_meta' => array( ),
		'array_link' => array( )
	);
	$array_seo['array_meta'][] = array( 'name' => 'Description', 'content' => get_length_char($page_static['content'], 150, '') );
	$array_seo['array_link'][] = array( 'rel' => 'canonical', 'href' => $page_static['page_link'] );
	$array_seo['array_link'][] = array( 'rel' => 'citation_authors', 'content' => WEBSITE_OWNER_POST );
?>

<?php $this->load->view( 'website/common/meta', $array_seo ); ?>
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
