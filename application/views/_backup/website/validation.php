<?php
	// validation key
	preg_match('/validation\/([a-z0-9\-\_]+)$/i', $_SERVER['REQUEST_URI'], $match);
	$key = (isset($match[1])) ? $match[1] : '';
	$user = $this->User_model->get_by_id(array( 'email_key' => $key ));
	
	// generate message
	$message = '';
	if (count($user) == 0) {
		$message = 'Invalid key.';
	} else if (count($user) > 0 && $user['verify_email'] == 0) {
		$param['id'] = $user['id'];
		$param['is_active'] = 1;
		$param['verify_email'] = 1;
		$result = $this->User_model->update($param);
		
		$message = 'Your email validation successful, please login to continue.';
	} else {
		$message = 'Key is expired.';
	}
	
	// build breadcrumb
	$param_breadcrumb['title_list'][] = array( 'link' => base_url(), 'title' => 'Home', 'class' => 'first' );
	$param_breadcrumb['title_list'][] = array( 'link' => '#', 'title' => 'Validation' );
?>
<?php $this->load->view('website/common/meta'); ?>
<body id="offcanvas-container" class="offcanvas-container layout-fullwidth fs12 page-product">
<section id="page" class="offcanvas-pusher" role="main">
	<?php $this->load->view('website/common/header'); ?>
	
	<section id="columns" class="offcanvas-siderbars">
		<?php $this->load->view( 'website/common/breadcrumb', $param_breadcrumb ); ?>
		
		<div class="container"><div class="row">
			<section class="col-lg-99 col-md-9 col-sm-12 col-xs-12 main-column">
				<div id="content">
					<div style="background: #FFFFFF; padding: 10px;"><?php echo $message; ?></div>
				</div>
			</section>
			
			<aside id="oc-column-right" class="col-lg-3 col-md-3 col-sm-12 col-xs-12 offcanvas-sidebar">
				<div id="column-right" class="sidebar">
					<div id="column-right" class="sidebar">
						<?php $this->load->view('website/common/widget_section'); ?>
					</div>
				</div>
			</aside>
		</div></div>
	</section>
	
	<?php $this->load->view('website/common/footer'); ?>
</section>

<?php $this->load->view('website/common/menu_canvas'); ?>

</body>
</html>