<?php
	$user_session = $this->user_model->get_session();
	$user = $this->user_model->get_by_id(array( 'user_type_id' => $user_session['user_type_id'], 'id' => $user_session['id'] ));
	
	// setting
	if ($user['user_type_id'] == USER_TYPE_MEMBER) {
		$param_setting['member_id'] = $user['id'];
	} else if ($user['user_type_id'] == USER_TYPE_TRAVELER) {
		$param_setting['traveler_id'] = $user['id'];
	}
	$user_setting = $this->user_setting_model->get_by_id($param_setting);
	$page['user_setting'] = $user_setting;
?>
<?php $this->load->view( 'panel/common/meta' ); ?>
<body>
<section class="vbox">
	<div id="cnt-page" class="hide"><?php echo json_encode($page); ?></div>
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
							<header class="panel-heading font-bold">Email Notification</header>
							<div class="panel-body" style="margin: 0 0 25px 0;">
								<form id="form-notify">
									<input type="hidden" name="action" value="update" />
									<div class="checkbox">
										<label>
											<input type="checkbox" name="email_notify" value="1" /> Notification
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
	// page
	var page = {
		init: function() {
			var raw_page = $('#cnt-page').html();
			eval('var data = ' + raw_page);
			page.data = data;
			
			// populate data
			if (page.data.user_setting.length == 0) {
				$('#form-notify [type="checkbox"]').prop('checked', true);
			} else {
				Func.populate({ cnt: '#form-notify', record: page.data.user_setting });
			}
		}
	}
	page.init();
	
	// form notify
	var form = $('#form-notify').parsley();
	$('#form-notify').submit(function(e) {
		e.preventDefault();
		if (! form.isValid()) {
			return false;
		}
		
		var param = Site.Form.GetValue('form-notify');
		Func.update({
			param: param,
			link: web.base + 'panel/setting/action'
		});
	});
});
</script>