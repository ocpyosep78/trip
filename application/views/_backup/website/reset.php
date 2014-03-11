<?php
	// reset key
	preg_match('/reset\/([a-z0-9\-]+)$/i', $_SERVER['REQUEST_URI'], $match);
	$key = (isset($match[1])) ? $match[1] : '';
	$user = $this->User_model->get_by_id(array( 'passwd_reset_key' => $key ));
	
	// generate message
	$message = '';
	if (count($user) == 0) {
		$message = 'Key is expired.';
	} else if (count($user) > 0) {
		$passwd = rand(1000,9999).'-'.rand(1000,9999);
		
		// sent mail
		$param_mail['to'] = $user['email'];
		$param_mail['subject']  = WEBSITE_TITLE.' - New Password';
		$param_mail['message']  = 'You have request new password :<br /><br />';
		$param_mail['message'] .= 'Email : '.$user['email'].'<br />';
		$param_mail['message'] .= 'Password : '.$passwd.'<br /><br />';
		$param_mail['message'] .= 'Please update your password after you sign in.';
		sent_mail($param_mail);
		
		// update password
		$param['id'] = $user['id'];
		$param['passwd'] = EncriptPassword($passwd);
		$param['passwd_reset_key'] = '';
		$result = $this->User_model->update($param);
		
		$message = 'Please check your email to get your new password.';
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