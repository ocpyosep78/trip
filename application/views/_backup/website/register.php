<?php
	$is_login = $this->User_model->is_login();
	if ($is_login) {
		header("HTTP/1.1 301 Moved Permanently");
		header('Location: '.base_url('panel'));
		exit;
	}
	
	// build breadcrumb
	$param_breadcrumb['title_list'][] = array( 'link' => base_url(), 'title' => 'Home', 'class' => 'first' );
	$param_breadcrumb['title_list'][] = array( 'link' => base_url('login'), 'title' => 'Register' );
?>
<?php $this->load->view('website/common/meta'); ?>
<body id="offcanvas-container" class="offcanvas-container layout-fullwidth fs12 page-product">
<section id="page" class="offcanvas-pusher" role="main">
	<?php $this->load->view('website/common/header'); ?>
	
	<section id="columns" class="offcanvas-siderbars">
		<?php $this->load->view( 'website/common/breadcrumb', $param_breadcrumb ); ?>
		
		<div class="container">
			<div class="row">
				<section class="col-lg-99 col-md-9 col-sm-12 col-xs-12 main-column">
					<div class="description">
						<div class="wrapper underline no-margin">
							<h2>Register</h2>
							<p>If you already have an account with us, please login at the <a href="<?php echo base_url('login'); ?>">login page</a>.</p>
							<form method="post" id="form-register">
								<input type="hidden" name="action" value="update" />
								
								<h3>Your Personal Details</h3>
								<div class="content">
									<table class="form"><tbody>
									<tr>
										<td>
											<span class="required">*</span> URL name / Alias:
										</td>
										<td><input type="text" name="alias" maxlength="30" /></td>
									</tr>
									<tr>
										<td>
											<span class="required">*</span> First Name:
										</td>
										<td><input type="text" name="first_name" maxlength="30" /></td>
									</tr>
									<tr>
										<td>
											<span class="required">*</span> Last Name:
										</td>
										<td><input type="text" name="last_name" maxlength="30" /></td>
									</tr>
									<tr>
										<td>
											<span class="required">*</span> Telp:
										</td>
										<td><input type="text" name="phone" class="digits no_special_char" maxlength="14" /></td>
									</tr>
									<tr>
										<td>
											<span class="required">*</span> E-Mail:
										</td>
										<td><input type="text" name="email" /></td>
									</tr>
									</tbody></table>
								</div>
								
								<h3>Your Password</h3>
								<div class="content">
									<table class="form table-condensed"><tbody>
										<tr>
											<td>
												<span class="required">*</span> Password:
											</td>
											<td><input type="password" name="passwd" id="passwd" /></td>
										</tr>
										<tr>
											<td>
												<span class="required">*</span>
												Password Confirm:
											</td>
											<td><input type="password" name="passwd_confirm" /></td>
										</tr>
									</tbody></table>
								</div>
								
								<h3>Newsletter</h3>
								<div class="content">
									<table class="form table-condensed"><tbody>
									<tr>
										<td>Subscribe:</td>
										<td>
											<input type="radio" value="1" name="newsletter" /> Yes
											<input type="radio" value="0" name="newsletter" checked="checked" /> No
										</td>
									</tr>
									</tbody></table>
								</div>
				
								<div class="buttons">
									<div class="right" style="width: 310px;">
										<div style="float: left;">I have read and agree to the <a alt="Privacy Policy" href="<?php echo base_url('privacy_policy'); ?>" class="colorbox cboxElement"><b>Privacy Policy</b></a></div>
										<input type="checkbox" value="1" name="agree" style="float: right;"/>
										<div style="clear: both;"></div>
										<div style="margin: 10px 0 0 0;"><input type="submit" class="button" value="Continue" /></div>
									</div>
								</div>
							</form>
						</div>
					</div> 
				</section>
				
				<aside id="oc-column-right" class="col-lg-3 col-md-3 col-sm-12 col-xs-12 offcanvas-sidebar">
					<div id="column-right" class="sidebar">
			 			<?php $this->load->view('website/common/widget_section'); ?>
					</div>
				</aside>
			</div>
		</div>
	</section>
	
	<?php $this->load->view('website/common/footer'); ?>
</section>

<?php $this->load->view('website/common/menu_canvas'); ?>

<script>
$('#form-register').validate({
	rules: {
		alias: { required: true, minlength: 5 },
		first_name: { required: true },
		last_name: { required: true },
		phone: { required: true },
		email: { required: true, email: true },
		passwd: { required: true },
		passwd_confirm: { required: true, equalTo: "#passwd" },
		agree: { required: true }
	}
});

$('#form-register').submit(function(e) {
	e.preventDefault();
	if (! $('#form-register').valid()) {
		return false;
	}
	
	var param = Site.Form.GetValue('form-register');
	Func.ajax({ url: web.base + 'register/action', param: param, callback: function(result) {
		if (result.status == 1) {
			$('#form-register')[0].reset();
			$.notify(result.message, "success");
		} else {
			$.notify(result.message, "error");
		}
	} });
});
</script>

</body></html>