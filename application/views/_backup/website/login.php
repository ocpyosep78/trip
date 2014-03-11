<?php
	$is_login = $this->User_model->is_login();
	if ($is_login) {
		header("HTTP/1.1 301 Moved Permanently");
		header('Location: '.base_url('panel'));
		exit;
	}
	
	// build breadcrumb
	$param_breadcrumb['title_list'][] = array( 'link' => base_url(), 'title' => 'Home', 'class' => 'first' );
	$param_breadcrumb['title_list'][] = array( 'link' => base_url('login'), 'title' => 'login' );
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
					<div class="wrapper underline no-margin">
						<h2>SIGN IN</h2>
						
						<form class="sky-form" id="form-login">
							<input type="hidden" name="action" value="login" />
							
							<fieldset>
								<section>
									<label class="label">Email</label>
									<label class="input">
										<input type="text" name="email" placeholder="Email" value="" />
									</label>
								</section>
								<section>
									<label class="label">Password</label>
									<label class="input">
										<input type="password" name="passwd" placeholder="Password" value="" />
									</label>
								</section>
							</fieldset>
							<br/><br/>
							
							<footer>
								<button type="submit" class="button">Sign In</button>
								<button type="button" class="button button-secondary" onclick="window.history.back();">Cancel</button>
							</footer>
						</form>
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

<script>
	// form login
	$('#form-login').validate({
		rules: {
			email: { required: true, email: true },
			passwd: { required: true }
		}
	});
	$('#form-login').submit(function(e) {
		e.preventDefault();
		if (! $('#form-login').valid()) {
			return;
		}
		
		var param = Site.Form.GetValue('#form-login');
		Func.ajax({ url: web.base + 'login/action', param: param, callback: function(result) {
			if (result.status == 1) {
				window.location = result.panel_link;
			} else {
				$.notify(result.message, "error");
			}
		} });
	});
</script>

</body>
</html>