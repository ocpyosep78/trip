<?php
	$user_session = $this->user_model->get_session();
	$user = $this->user_model->get_by_id(array( 'user_type_id' => $user_session['user_type_id'], 'id' => $user_session['id'] ));
	
	$page['user'] = $user;
?>
<?php $this->load->view( 'panel/common/meta' ); ?>
<body>
<section class="vbox">
	<div class="hide">
		<div id="cnt-page"><?php echo json_encode($page); ?></div>
		<iframe name="iframe_thumbnail" src="<?php echo base_url('panel/upload?callback_name=set_thumbnail'); ?>"></iframe>
	</div>
	<?php $this->load->view( 'panel/common/header' ); ?>
	
	<section>
		<section class="hbox stretch">
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
								<header class="panel-heading font-bold">Edit Info</header>
								<div class="panel-body" style="margin: 0 0 25px 0;">
									<form id="form-user">
										<input type="hidden" name="action" value="update_info" />
										<input type="hidden" name="id" value="0" />
										
										<div class="form-group">
											<label>Phone</label>
											<input type="text" name="phone" placeholder="Phone" class="form-control" data-required="true" data-digits="true" data-no_special_char="true" maxlength="14" />
										</div>
										<div class="form-group">
											<label>BB PIN</label>
											<input type="text" name="bb_pin" placeholder="BB PIN" class="form-control" maxlength="9" data-no_special_char="true" />
										</div>
										<div class="form-group">
											<label>About</label>
											<input type="text" name="user_about" placeholder="About" class="form-control" />
										</div>
										<div class="form-group">
											<label>Info</label>
											<textarea name="user_info" placeholder="Info" class="form-control"></textarea>
										</div>
										<div class="form-group" style="padding: 0 0 35px 0;">
											<label class="col-lg-2 control-label" style="padding: 5px 0 0 0;">Thumbnail</label>
											<div class="col-lg-7">
												<input type="text" placeholder="Thumbnail" class="form-control" name="thumbnail">
											</div>
											<div class="col-lg-3">
												<button class="btn btn-default browse-thumbnail" type="button">Select Picture</button>
											</div>
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
		</section>
	</section>
</section>

<script>
$(document).ready(function() {
	// page
	var page = {
		init: function() {
			var raw_page = $('#cnt-page').html();
			eval('var data = ' + raw_page);
			page.data = data;
			
			Func.populate({ cnt: '#form-user', record: page.data.user });
		}
	}
	page.init();
	
	// form email
	var form = $('#form-user').parsley();
	$('#form-user').submit(function(e) {
		e.preventDefault();
		if (! form.isValid()) {
			return false;
		}
		
		var param = Site.Form.GetValue('form-user');
		Func.update({
			param: param,
			link: web.base + 'panel/profile/info/action',
			callback: function() {
				window.location = window.location.href;
			}
		});
	});
	
	// upload
	$('.browse-thumbnail').click(function() { window.iframe_thumbnail.browse() });
	set_thumbnail = function(p) {
		$('#form-user [name="thumbnail"]').val(p.file_name);
	}
});
</script>

<?php $this->load->view( 'panel/common/footer'); ?>