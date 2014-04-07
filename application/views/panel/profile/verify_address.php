<?php
	$user = $this->user_model->get_session();
	$user = $this->user_model->get_by_id(array( 'user_type_id' => $user['user_type_id'], 'id' => $user['id'] ));
	
	$array_region = $this->region_model->get_array();
//	$verify_address_count = $this->Verify_Address_model->get_count(array( 'user_id' => $user['id'] ));
//	$verify_address_left = VERIFY_ADDRESS_MAX - $verify_address_count;
	
	$page['user'] = $user;
?>
<?php $this->load->view( 'panel/common/meta' ); ?>
<body>
<section class="vbox">
	<?php $this->load->view( 'panel/common/header' ); ?>
	<div class="hide">
		<div id="cnt-page"><?php echo json_encode($page); ?></div>
	</div>
	
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
							<header class="panel-heading font-bold">Get Verify Address</header>
							<div class="panel-body">
								<form id="form-user">
									<input type="hidden" name="action" value="request" />
									<input type="hidden" name="id" value="0" />
									
									<div class="form-group">
										<label>First Name</label>
										<input type="text" name="first_name" placeholder="First Name" class="form-control" data-required="true" disabled="disabled" />
									</div>
									<div class="form-group">
										<label>Last Name</label>
										<input type="text" name="last_name" placeholder="Last Name" class="form-control" disabled="disabled" />
									</div>
									<div class="form-group">
										<label>Address</label>
										<textarea name="address" placeholder="Address Name" class="form-control" maxlength="200" data-required="true" disabled="disabled"></textarea>
									</div>
									<div class="form-group">
										<label>Region</label>
										<select name="region_id" class="form-control" data-required="true" disabled="disabled">
											<?php echo ShowOption(array( 'Array' => $array_region, 'ArrayID' => 'id', 'ArrayTitle' => 'name' )); ?>
										</select>
									</div>
									<div class="form-group">
										<label>City</label>
										<select name="city_id" class="form-control" data-required="true" disabled="disabled">
											<option value="">-</option>
										</select>
									</div>
									<div class="form-group">
										<label>Postal Code</label>
										<input type="text" name="postal_code" placeholder="Postal Code" class="form-control" disabled="disabled" />
									</div>
									<div class="form-group has-success">
										<label class="control-label">You can only request verify address max <?php echo VERIFY_ADDRESS_MAX; ?> (<?php echo $verify_address_left; ?> left).</label>
									</div>
									<button class="btn btn-sm btn-info" type="submit">Request Verify Address</button>
								</form>
							</div>
							
							<header class="panel-heading font-bold" style="border-top: 1px solid #CCCCCC; border-radius: 0px;">Submit Code</header>
							<div class="panel-body">
								<form id="form-code">
									<input type="hidden" name="action" value="submit_code" />
									
									<div class="form-group">
										<label>Code</label>
										<input type="text" name="code" placeholder="Code" class="form-control" data-required="true" />
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
		}
	}
	page.init();
	
	// form request
	var form_user = $('#form-user').parsley();
	$('#form-user').submit(function(e) {
		e.preventDefault();
		if (! form_user.isValid()) {
			return false;
		}
		
		var param = Site.Form.GetValue('form-user');
		Func.update({
			param: param,
			link: web.base + 'panel/profile/verify_address/action'
		});
	});
	
	// form code
	var form_code = $('#form-code').parsley();
	$('#form-code').submit(function(e) {
		e.preventDefault();
		if (! form_code.isValid()) {
			return false;
		}
		
		var param = Site.Form.GetValue('form-code');
		Func.update({
			param: param,
			link: web.base + 'panel/profile/verify_address/action',
			callback: function(result) {
				window.location = web.base + 'panel';
			}
		});
	});
});
</script>

<?php $this->load->view( 'panel/common/footer'); ?>