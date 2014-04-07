<?php
	$user = $this->user_model->get_session();
	$user = $this->user_model->get_by_id(array( 'user_type_id' => $user['user_type_id'], 'id' => $user['id'] ));
	
	$array_region = $this->region_model->get_array();
	
	$page['user'] = $user;
?>
<?php $this->load->view( 'panel/common/meta' ); ?>
<body>
<section class="vbox">
	<div class="hide"><div id="cnt-page"><?php echo json_encode($page); ?></div></div>
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
							<header class="panel-heading font-bold">Edit Profile</header>
							<div class="panel-body">
								<form id="form-user">
									<input type="hidden" name="action" value="update" />
									<input type="hidden" name="id" value="0" />
									
									<div class="form-group">
										<label>First Name</label>
										<input type="text" name="first_name" placeholder="First Name" class="form-control" data-required="true" maxlength="30" />
									</div>
									<div class="form-group">
										<label>Last Name</label>
										<input type="text" name="last_name" placeholder="Last Name" class="form-control" maxlength="30" />
									</div>
									<div class="form-group">
										<label>Address (max 200 charakter)</label>
										<textarea name="address" placeholder="Address Name" class="form-control" maxlength="200" data-required="true"></textarea>
									</div>
									<div class="form-group">
										<label>Region</label>
										<select name="region_id" class="form-control" data-required="true">
											<?php echo ShowOption(array( 'Array' => $array_region, 'ArrayID' => 'id', 'ArrayTitle' => 'name' )); ?>
										</select>
									</div>
									<div class="form-group">
										<label>City</label>
										<select name="city_id" class="form-control" data-required="true">
											<option value="">-</option>
										</select>
									</div>
									<div class="form-group">
										<label>Postal Code</label>
										<input type="text" name="postal_code" placeholder="Postal Code" class="form-control" />
									</div>
									<div class="checkbox">
										<label>
											<input type="checkbox" name="is_check" value="1" data-required="true" />
											Dengan mengirimkan form ini saya menyatakan bahwa semua informasi diatas adalah benar dan bisa dipertanggungjawabkan.
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
<script>
$(document).ready(function() {
	// page
	var page = {
		init: function() {
			var raw_page = $('#cnt-page').html();
			eval('var data = ' + raw_page);
			page.data = data;
			
			Func.populate({ cnt: '#form-user', record: page.data.user });
			combo.city({ region_id: page.data.user.region_id, target: $('#form-user [name="city_id"]'), value: page.data.user.city_id });
			
			if (page.data.user.verify_address == 1) {
				$('#form-user input, #form-user select, #form-user textarea').prop('disabled', 'disabled');
				$('#form-user button').hide();
			}
		}
	}
	page.init();
	
	// form
	var form = $('#form-user').parsley();
	$('#form-user').submit(function(e) {
		e.preventDefault();
		if (! form.isValid()) {
			return false;
		}
		
		var param = Site.Form.GetValue('form-user');
		Func.update({
			param: param,
			link: web.base + 'panel/profile/user/action'
		});
	});
	
	// helper
	$('#form-user [name="region_id"]').change(function() {
		combo.city({
			region_id: $(this).val(),
			target: $('#form-user [name="city_id"]')
		});
	});
});
</script>

<?php $this->load->view( 'panel/common/footer'); ?>