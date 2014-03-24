<?php
	$array_country = $this->country_model->get_array();
?>

<?php $this->load->view( 'panel/common/meta' ); ?>
<body>
<section class="vbox">
	<div class="hide">
		<iframe name="iframe_thumbnail" src="<?php echo base_url('panel/upload?callback_name=set_thumbnail'); ?>"></iframe>
	</div>
	<?php $this->load->view( 'panel/common/header' ); ?>
	
    <section>
		<section class="hbox stretch">
			<?php $this->load->view( 'panel/common/sidebar' ); ?>
			
			<section id="content">
				<section class="vbox">
					<section class="scrollable padder">
						<div class="m-b-md">
							<h3 class="m-b-none">Member</h3>
						</div>
						
						<section class="panel panel-default panel-table">
							<header class="header bg-white b-b clearfix">
								<div class="row m-t-sm">
									<div class="col-sm-8 m-b-xs">&nbsp;</div>
									<div class="col-sm-4 m-b-xs">
										<div class="input-group">
											<input type="text" class="input-sm form-control input-keyword" placeholder="Search" />
											<span class="input-group-btn">
												<button class="btn btn-sm btn-default btn-search" type="button">Go!</button>
											</span>
										</div>
									</div>
								</div>
							</header>
							
							<div class="table-responsive">
								<table class="table table-striped m-b-none" data-ride="datatable" id="datatable">
								<thead>
									<tr>
										<th width="20%">Email</th>
										<th width="20%">First Name</th>
										<th width="20%">Last Name</th>
										<th width="20%">Phone</th>
										<th width="20%">&nbsp;</th>
									</tr>
								</thead>
								<tbody></tbody>
								</table>
							</div>
						</section>
						
						<section class="panel panel-default panel-form hide">
							<header class="panel-heading font-bold">Form Member</header>
							<div class="panel-body">
								<form class="bs-example form-horizontal">
									<input type="hidden" name="id" value="0" />
									<input type="hidden" name="action" value="update" />
									
									<div class="form-group">
										<label class="col-lg-2 control-label">Email</label>
										<div class="col-lg-10">
											<input type="text" name="email" class="form-control" placeholder="Email" data-required="true" data-type="email" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-lg-2 control-label">Alias</label>
										<div class="col-lg-10">
											<input type="text" name="alias" class="form-control" placeholder="Alias" data-required="true" readonly="readonly" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-lg-2 control-label">First Name</label>
										<div class="col-lg-10">
											<input type="text" name="first_name" class="form-control" placeholder="First Name" data-required="true" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-lg-2 control-label">Last Name</label>
										<div class="col-lg-10">
											<input type="text" name="last_name" class="form-control" placeholder="Last Name" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-lg-2 control-label">Password</label>
										<div class="col-lg-10">
											<input type="password" name="passwd" class="form-control input_passwd" id="" placeholder="Password" data-equalto=".input_passwd_confirm" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-lg-2 control-label">Confirm Password</label>
										<div class="col-lg-10">
											<input type="password" name="passwd_confirm" class="form-control input_passwd_confirm" placeholder="Confirm Password" data-equalto=".input_passwd" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-lg-2 control-label">Address</label>
										<div class="col-lg-10">
											<textarea name="address" class="form-control" placeholder="Address"></textarea>
										</div>
									</div>
									<div class="form-group">
										<label class="col-lg-2 control-label">Phone</label>
										<div class="col-lg-10">
											<input type="text" name="phone" class="form-control" placeholder="Phone" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-lg-2 control-label">Postal Code</label>
										<div class="col-lg-10">
											<input type="text" name="postal_code" class="form-control" placeholder="Postal Code" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-lg-2 control-label">User About</label>
										<div class="col-lg-10">
											<input type="text" name="user_about" class="form-control" placeholder="User About" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-lg-2 control-label">User Info</label>
										<div class="col-lg-10">
											<input type="text" name="user_info" class="form-control" placeholder="User Info" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-lg-2 control-label">Country</label>
										<div class="col-lg-10">
											<select name="country_id" class="form-control" data-required="true">
												<?php echo ShowOption(array( 'Array' => $array_country )); ?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-lg-2 control-label">Region</label>
										<div class="col-lg-10">
											<select name="region_id" class="form-control" data-required="true">
												<option value="">-</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-lg-2 control-label">City</label>
										<div class="col-lg-10">
											<select name="city_id" class="form-control" data-required="true">
												<option value="">-</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-lg-2 control-label">Register Date</label>
										<div class="col-lg-10">
											<input type="text" name="register_date" class="form-control" placeholder="Register Date" readonly="readonly" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-lg-2 control-label">Membership Date</label>
										<div class="col-lg-10">
											<input type="text" name="membership_date" class="form-control datepicker-input" placeholder="Membership Date" readonly="readonly" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-lg-2 control-label">Thumbnail</label>
										<div class="col-lg-7">
											<input type="text" name="thumbnail" class="form-control" placeholder="Thumbnail" />
										</div>
										<div class="col-lg-3">
											<button type="button" class="btn btn-default browse-thumbnail">Select Picture</button>
										</div>
									</div>
									<div class="form-group">
										<label class="col-lg-2 control-label">Access Login</label>
										<div class="col-lg-10">
											<input type="text" name="provider" class="form-control" placeholder="Access Login" />
										</div>
									</div>
									<div class="form-group">
										<div class="col-lg-offset-2 col-lg-10">
											<div class="checkbox">
												<label><input type="checkbox" name="verify_email" value="1" disabled="disabled" /> Verified Email</label>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="col-lg-offset-2 col-lg-10">
											<div class="checkbox">
												<label><input type="checkbox" name="verify_address" value="1" disabled="disabled" /> Verified Address</label>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="col-lg-offset-2 col-lg-10">
											<div class="checkbox">
												<label><input type="checkbox" name="is_active" value="1" /> Active</label>
											</div>
										</div>
									</div>
									
									<hr />
									<div class="form-group">
										<div class="col-lg-offset-2 col-lg-10">
											<button class="btn btn-sm btn-primary" type="button">Cancel</button>
											<button class="btn btn-sm btn-info" type="submit">Submit</button>
										</div>
									</div>
								</form>
							</div>
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
	var page = {
		init: function() {
		},
		show_grid: function() {
			$('.panel-form').hide();
			$('.panel-table').show();
		},
		show_form: function() {
			$('.panel-form').show();
			$('.panel-table').hide();
		},
	}
	page.init();
	
	// upload
	$('.browse-thumbnail').click(function() { window.iframe_thumbnail.browse() });
	set_thumbnail = function(p) {
		$('.panel-form form [name="thumbnail"]').val(p.file_name);
	}
	
	// grid
	var param = {
		id: 'datatable',
		source: web.base + 'panel/user/member/grid',
		column: [ { }, { }, { }, { }, { bSortable: false, sClass: 'center', sWidth: '10%' } ],
		callback: function() {
			$('#datatable .btn-edit').click(function() {
				var raw_record = $(this).siblings('.hide').text();
				eval('var record = ' + raw_record);
				
				Func.ajax({ url: web.base + 'panel/user/member/action', param: { action: 'get_by_id', id: record.id }, callback: function(result) {
					Func.populate({ cnt: '.panel-form', record: result });
					$('.panel-form [type="password"]').val('');
					combo.region({ country_id: result.country_id, target: $('.panel-form [name="region_id"]'), value: result.region_id });
					combo.city({ region_id: result.region_id, target: $('.panel-form [name="city_id"]'), value: result.city_id });
					
					page.show_form();
				} });
			});
			
			$('#datatable .btn-delete').click(function() {
				var raw_record = $(this).siblings('.hide').text();
				eval('var record = ' + raw_record);
				
				Func.confirm_delete({
					data: { action: 'delete', id: record.id },
					url: web.base + 'panel/user/member/action', callback: function() { dt.reload(); }
				});
			});
		}
	}
	var dt = Func.init_datatable(param);
	
	// form
	var form = $('.panel-form form').parsley();
	$('.panel-form .btn-primary').click(function() {
		page.show_grid();
	});
	$('.panel-form [name="country_id"]').change(function(){
		combo.region({ country_id: $(this).val(), target: $('.panel-form [name="region_id"]') });
	});
	$('.panel-form [name="region_id"]').change(function(){
		combo.city({ region_id: $(this).val(), target: $('.panel-form [name="city_id"]') });
	});
	$('.panel-form form').submit(function(e) {
		e.preventDefault();
		if (! form.isValid()) {
			return false;
		}
		
		Func.update({
			link: web.base + 'panel/user/member/action',
			param: Site.Form.GetValue('.panel-form form'),
			callback: function() {
				dt.reload();
				page.show_grid();
				$('.panel-form form')[0].reset();
			}
		});
	});
	
	// helper
	$('.show-dialog').click(function() {
		page.show_form();
		$('.panel-form form')[0].reset();
		$('.panel-form form').parsley().reset();
		$('.panel-form [name="id"]').val(0);
	});
});
</script>

<?php $this->load->view( 'panel/common/footer'); ?>