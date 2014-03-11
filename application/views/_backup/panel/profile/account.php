<?php
	$user = $this->User_model->get_session();
	$user = $this->User_model->get_by_id(array( 'id' => $user['id'] ));
?>
<?php $this->load->view( 'panel/common/meta' ); ?>
<body>
<section class="vbox">
    <?php $this->load->view( 'panel/common/header' ); ?>
	
	<section><section class="hbox stretch">
        <?php $this->load->view( 'panel/common/sidebar' ); ?>
		
        <section id="content">
			<section class="vbox">
				<header class="header bg-white b-b b-light">
					<p><?php echo $user['first_name']; ?>'s profile</p>
				</header>
				
				<section class="scrollable">
					<section class="hbox stretch">
						<?php $this->load->view( 'panel/common/profile' ); ?>
						
						<section class="panel panel-default">
							<header class="panel-heading font-bold">Change Email</header>
							<div class="panel-body" style="margin: 0 0 25px 0;">
								<form id="form-email">
									<input type="hidden" name="action" value="update_mail" />
									
									<div class="form-group">
										<label>Email address</label>
										<input type="text" name="email" placeholder="Enter email" class="form-control" data-required="true" data-type="email" />
									</div>
									<div class="form-group">
										<label>Password</label>
										<input type="password" name="passwd" placeholder="Password" class="form-control" data-required="true" />
									</div>
									<div class="checkbox">
										<label>
											<input type="checkbox" name="checking" value="1" data-required="true" /> I'am sure
										</label>
									</div>
									<button class="btn btn-sm btn-info" type="submit">Submit</button>
								</form>
							</div>
							
							<header class="panel-heading font-bold" style="border-top: 1px solid #CCCCCC; border-radius: 0px;">Change Password</header>
							<div class="panel-body">
								<form id="form-passwd">
									<input type="hidden" name="action" value="update_password" />
									
									<div class="form-group">
										<label>Old Password</label>
										<input type="password" name="passwd_old" placeholder="Old Password" class="form-control" />
									</div>
									<div class="form-group">
										<label>Password</label>
										<input type="password" name="passwd" placeholder="New Password" class="form-control input_passwd" data-equalto=".input_passwd_confirm" />
									</div>
									<div class="form-group">
										<label>Password Confirm</label>
										<input type="password" name="passwd_confirm" placeholder="New Password" class="form-control input_passwd_confirm" data-equalto=".input_passwd" />
									</div>
									<div class="checkbox">
										<label>
											<input type="checkbox" name="checking" value="1" data-required="true" /> I'am sure
										</label>
									</div>
									<button class="btn btn-sm btn-info" type="submit">Submit</button>
								</form>
							</div>
						</section>
					</section>
				</section>
			</section>
			<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
		</section>
	</section></section>
</section>

<?php $this->load->view( 'panel/common/footer'); ?>

<script>
$(document).ready(function() {
	// form email
	var form = $('#form-email').parsley();
	$('#form-email').submit(function(e) {
		e.preventDefault();
		if (! form.isValid()) {
			return false;
		}
		
		var param = Site.Form.GetValue('form-email');
		Func.update({
			param: param,
			link: web.base + 'panel/profile/account/action',
			callback: function() {
				$('#form-email')[0].reset();
			}
		});
	});
	
	// form passwprd
	var form = $('#form-passwd').parsley();
	$('#form-passwd').submit(function(e) {
		e.preventDefault();
		if (! form.isValid()) {
			return false;
		}
		
		var param = Site.Form.GetValue('form-passwd');
		Func.update({
			param: param,
			link: web.base + 'panel/profile/account/action',
			callback: function() {
				$('#form-passwd')[0].reset();
			}
		});
	});
});
</script>