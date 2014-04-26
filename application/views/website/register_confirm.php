<?php
	// verify email
	$message = '';
	$verify_email_key = (empty($this->uri->segments[3])) ? '' : $this->uri->segments[3];
	if (!empty($verify_email_key)) {
		$member = $this->member_model->get_by_id(array( 'verify_email_key' => $verify_email_key ));
		$traveler = $this->traveler_model->get_by_id(array( 'verify_email_key' => $verify_email_key ));
		
		// member or traveler
		if (count($member) > 0) {
			$user = $member;
			$model_name = 'member_model';
			$link_login = base_url('login/member');
		} else if (count($traveler) > 0) {
			$user = $traveler;
			$model_name = 'traveler_model';
			$link_login = base_url('login/traveler');
		} else {
			$message = 'Sorry, your key is invalid.';
		}
		
		// update
		if (!empty($model_name)) {
			$param_update['id'] = $user['id'];
			$param_update['is_active'] = 1;
			$param_update['verify_email'] = 1;
			$param_update['verify_email_key'] = '';
			$this->$model_name->update($param_update);
			
			$message = 'Congratulation, your account already active, please <a href="'.$link_login.'">login</a> to continue.';
		}
	}
	
	// breadcrub
	$array_breadcrub = array(
		array( 'link' => '#', 'title' => 'Register' ),
		array( 'link' => '#', 'title' => 'Confirmation' )
	);
?>

<?php $this->load->view( 'website/common/meta' ); ?>
<body id="top" class="thebg">
	<?php $this->load->view( 'website/common/header_menu' ); ?>
	<?php $this->load->view( 'website/common/breadcrub', array( 'array' => $array_breadcrub ) ); ?>
	
	<div class="container">
		<div class="container mt25 offset-0">
			<div class="col-md-8 pagecontainer2 offset-0">
				<br />
				<h2 class="opensans slim green2"><div style="margin-left:20px;">Register Confirmation</div></h2><br />
				<div class="line2"></div><br />
				
				<div class="hpadding50c">
					<?php echo $message; ?>
				</div>
				
				<div class="clearfix"></div>
			</div>
			
			<div class="col-md-4">
				<?php $this->load->view( 'website/common/random_post' ); ?>
				<?php $this->load->view( 'website/common/visit_post', array( 'class_style' => 'mt20 alsolikebox' ) ); ?>
			</div>
		</div>
	</div>
	
	<?php $this->load->view( 'website/common/footer' ); ?>
	<?php $this->load->view( 'website/common/library', array( 'js_add' => array( 'js-details.js' ) ) ); ?>
</body>
</html>