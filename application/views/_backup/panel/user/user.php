<?php
	$array_user_type = $this->User_Type_model->get_array();
?>
<?php $this->load->view( 'panel/common/meta' ); ?>
<body>
<section class="vbox">
	<div class="hide">
		<iframe name="iframe_thumbnail_profile" src="<?php echo base_url('panel/upload?callback_name=set_thumbnail_profile'); ?>"></iframe>
		<iframe name="iframe_thumbnail_banner" src="<?php echo base_url('panel/upload?callback_name=set_thumbnail_banner'); ?>"></iframe>
	</div>
	<?php $this->load->view( 'panel/common/header' ); ?>
	
    <section>
		<section class="hbox stretch">
			<?php $this->load->view( 'panel/common/sidebar' ); ?>
			
			<section id="content">
				<section class="vbox">
					<section class="scrollable padder">
						<div class="m-b-md">
							<h3 class="m-b-none">User</h3>
						</div>
						
						<section class="panel panel-default panel-table grid-view">
							<header class="header bg-white b-b clearfix">
								<div class="row m-t-sm">
									<div class="col-sm-8 m-b-xs">
										<a class="btn btn-sm btn-default show-form"><i class="fa fa-plus"></i> Create</a>
									</div>
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
										<th width="15%">Alias</th>
										<th width="15%">First Name</th>
										<th width="15%">Last Name</th>
										<th width="15%">User Type</th>
										<th width="20%">&nbsp;</th>
									</tr>
								</thead>
								<tbody></tbody>
								</table>
							</div>
						</section>
						
						<section class="panel panel-default form-view hide">
							<header class="panel-heading font-bold">Category Input Form</header>
							<div class="panel-body">
								<form class="bs-example form-horizontal" data-validate="parsley">
									<input type="hidden" name="id" value="0" />
									<input type="hidden" name="action" value="update" />
									
									<div class="form-group">
										<label class="col-lg-2 control-label">Input Type</label>
										<div class="col-lg-10">
											<select name="user_type_id" class="form-control" data-required="true">
												<?php echo ShowOption(array( 'Array' => $array_user_type, 'ArrayID' => 'id', 'ArrayTitle' => 'name' )); ?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-lg-2 control-label">Email</label>
										<div class="col-lg-10">
											<input type="text" name="email" class="form-control" placeholder="Email" data-required="true" data-type="email" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-lg-2 control-label">Alias</label>
										<div class="col-lg-10">
											<input type="text" name="alias" class="form-control" placeholder="Alias" data-required="true" />
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
										<label class="col-lg-2 control-label">BB PIN</label>
										<div class="col-lg-10">
											<input type="text" name="bb_pin" class="form-control" placeholder="BB PIN" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-lg-2 control-label">Advert Count</label>
										<div class="col-lg-10">
											<input type="text" name="advert_count" class="form-control" placeholder="Advert Count" disabled="disabled" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-lg-2 control-label">Membership Date</label>
										<div class="col-lg-10">
											<input type="text" name="membership_date" class="form-control" placeholder="Membership Date" disabled="disabled" />
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
										<label class="col-lg-2 control-label">Thumbnail Profile</label>
										<div class="col-lg-7">
											<input type="text" name="thumbnail_profile" class="form-control" placeholder="Thumbnail Profile" />
										</div>
										<div class="col-lg-3">
											<button type="button" class="btn btn-default browse-thumbnail-profile">Select Picture</button>
										</div>
									</div>
									<div class="form-group">
										<label class="col-lg-2 control-label">Thumbnail Banner</label>
										<div class="col-lg-7">
											<input type="text" name="thumbnail_banner" class="form-control" placeholder="Thumbnail Banner" />
										</div>
										<div class="col-lg-3">
											<button type="button" class="btn btn-default browse-thumbnail-banner">Select Picture</button>
										</div>
									</div>
									<div class="form-group">
										<div class="col-lg-offset-2 col-lg-10">
											<div class="checkbox">
												<label><input type="checkbox" name="is_ic_number" value="1" /> Check this box if you are a Foreigner/Army/Police</label>
											</div>
										</div>
									</div>
									<div class="form-group" id="cnt-ic-number">
										<label class="col-lg-2 control-label">IC Number</label>
										<div class="col-lg-10">
											<input type="text" name="ic_number" class="form-control" placeholder="IC Number" />
										</div>
									</div>
									<div class="form-group">
										<div class="col-lg-offset-2 col-lg-10">
											<div class="checkbox">
												<label><input type="checkbox" name="is_active" value="1" /> Active</label>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="col-lg-offset-2 col-lg-10">
											<button type="submit" class="btn btn-sm btn-info">Save</button>
											<button type="button" class="btn btn-sm btn-default show-grid">Cancel</button>
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
		show_grid: function() {
			$('.grid-view').show();
			$('.form-view').hide();
		},
		show_form: function() {
			$('.grid-view').hide();
			$('.form-view').show();
			page.ic_number();
		},
		ic_number: function() {
			var param = Site.Form.GetValue('.form-view form');
			if (param.is_ic_number == 1) {
				$('#cnt-ic-number label').text('Other ID Number');
				$('#cnt-ic-number input').attr('placeholder', 'Other ID Number');
			} else {
				$('#cnt-ic-number label').text('IC Number');
				$('#cnt-ic-number input').attr('placeholder', 'IC Number');
			}
		}
	}
	
	// grid
	var param = {
		id: 'datatable',
		source: web.base + 'panel/user/user/grid',
		column: [ { }, { }, { }, { }, { }, { bSortable: false, sClass: 'center', sWidth: '10%' } ],
		callback: function() {
			$('#datatable .btn-edit').click(function() {
				var raw_record = $(this).siblings('.hide').text();
				eval('var record = ' + raw_record);
				
				Func.ajax({ url: web.base + 'panel/user/user/action', param: { action: 'get_by_id', id: record.id }, callback: function(result) {
					Func.populate({ cnt: '.form-view form', record: result });
					$('.form-view form [type="password"]').val('');
					
					page.show_form();
				} });
			});
			
			$('#datatable .btn-delete').click(function() {
				var raw_record = $(this).siblings('.hide').text();
				eval('var record = ' + raw_record);
				
				Func.confirm_delete({
					data: { action: 'update', id: record.id, is_delete: 1 },
					url: web.base + 'panel/user/user/action', callback: function() { dt.reload(); }
				});
			});
		}
	}
	var dt = Func.init_datatable(param);
	
	// form
	var form = $('.form-view form').parsley();
	$('.form-view form').submit(function(e) {
		e.preventDefault();
		if (! form.isValid()) {
			return false;
		}
		
		var param = Site.Form.GetValue('.form-view form');
		Func.update({
			param: param,
			link: web.base + 'panel/user/user/action',
			callback: function() {
				dt.reload();
				page.show_grid();
			}
		});
	});
	
	// helper
	$('.show-form').click(function() {
		page.show_form();
		$('.form-view form')[0].reset();
		$('.form-view [name="id"]').val(0);
	});
	$('.show-grid').click(function() {
		page.show_grid();
	});
	$('[name="is_ic_number"]').click(function(){
		page.ic_number();
	});
	
	// upload
	$('.browse-thumbnail-profile').click(function() { window.iframe_thumbnail_profile.browse() });
	set_thumbnail_profile = function(p) {
		$('.form-view form [name="thumbnail_profile"]').val(p.file_name);
	}
	$('.browse-thumbnail-banner').click(function() { window.iframe_thumbnail_banner.browse() });
	set_thumbnail_banner = function(p) {
		$('.form-view form [name="thumbnail_banner"]').val(p.file_name);
	}
});
</script>

<?php $this->load->view( 'panel/common/footer'); ?>