<?php
	// user
	$user_session = $this->user_model->get_session();
	$user = $this->user_model->get_by_id(array( 'user_type_id' => $user_session['user_type_id'], 'id' => $user_session['id'] ));
	
	$array_country = $this->country_model->get_array();
	$array_language = $this->language_model->get_array();
	$array_hotel_star = $this->hotel_star_model->get_array();
	$array_category_sub = $this->category_sub_model->get_array(array( 'category_id' => CATEGORY_HOTEL ));
	
	// page data
	$page['USER_TYPE_ADMINISTRATOR'] = USER_TYPE_ADMINISTRATOR;
	$page['USER_TYPE_EDITOR'] = USER_TYPE_EDITOR;
	$page['USER_TYPE_MEMBER'] = USER_TYPE_MEMBER;
	$page['user'] = $user_session;
?>

<?php $this->load->view( 'panel/common/meta' ); ?>
<body>
<section class="vbox">
	<div class="hide">
		<div id="cnt-page"><?php echo json_encode($page); ?></div>
		<iframe name="iframe_thumbnail" src="<?php echo base_url('panel/upload?callback_name=set_thumbnail'); ?>"></iframe>
		<iframe name="iframe_image_gallery" src="<?php echo base_url('panel/upload?callback_name=set_image_gallery'); ?>"></iframe>
		
		<div class="form-language">
			<div class="form-group">
				<label class="col-lg-2 control-label">Title</label>
				<div class="col-lg-10"><input type="text" name="title" class="form-control" placeholder="Title" /></div>
			</div>
			<div class="form-group">
				<label class="col-lg-2 control-label">Description 1</label>
				<div class="col-lg-10"><textarea name="desc_01" class="form-control" placeholder="Description 1"></textarea></div>
			</div>
			<div class="form-group">
				<label class="col-lg-2 control-label">Description 2</label>
				<div class="col-lg-10"><textarea name="desc_02" class="form-control" placeholder="Description 2"></textarea></div>
			</div>
			<div class="form-group">
				<label class="col-lg-2 control-label">Map</label>
				<div class="col-lg-10"><div name="map" class="input-tinymce"></div></div>
			</div>
		</div>
	</div>
	
	<div class="modal fade" id="modal-facility">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Facility Form</h4>
				</div>
				<div class="modal-body">
					<section style="margin: 0 0 25px 0;">
						<form class="form-inline">
							<input type="hidden" name="action" value="facility_update" />
							<input type="hidden" name="post_id" value="0" />
							<input type="hidden" name="facility_id" value="0" />
							
							<div class="form-group cnt-typeahead" style="width: 80%;">
								<input type="text" name="facility_search" class="form-control facility-typeahead" placeholder="Enter Facility Name" />
							</div>
							<button class="btn btn-info" style="float: right; width: 15%;" type="submit">Add</button>
						</form>
					</section>
					
					<section class="panel panel-default panel-table">
						<div class="table-responsive">
							<table class="table table-striped m-b-none" data-ride="datatable" id="table-facility">
							<thead>
								<tr>
									<th width="75%">Facility</th>
									<th width="25%">&nbsp;</th>
								</tr>
							</thead>
							<tbody></tbody>
							</table>
						</div>
					</section>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	
	<div class="modal fade" id="modal-booking">
		<div class="modal-dialog big">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Booking Form</h4>
				</div>
				<div class="modal-body">
					<section class="panel panel-default panel-form">
						<form class="bs-example form-horizontal">
							<input type="hidden" name="action" value="booking_update" />
							<input type="hidden" name="id" value="0" />
							<input type="hidden" name="post_id" value="0" />
						
							<div class="panel-body">
								<div class="form-group">
									<label class="col-lg-2 control-label">Title</label>
									<div class="col-lg-10">
										<input type="text" class="form-control" name="title" data-required="true" placeholder="Title" />
									</div>
								</div>
								<div class="form-group">
									<label class="col-lg-2 control-label">Link</label>
									<div class="col-lg-10">
										<input type="text" class="form-control" name="link" data-required="true" placeholder="Link" />
									</div>
								</div>
								<div class="form-group center">
									<input type="button" class="btn btn-primary show-booking-grid" value="Cancel" />
									<input type="submit" class="btn btn-info" value="Save" />
								</div>
							</div>
						</form>
					</section>
					
					<section class="panel panel-default panel-table">
						<div style="padding: 5px 10px; text-align: center;">
							<a class="btn btn-sm btn-default show-booking-form"><i class="fa fa-plus"></i> Create</a>
						</div>
						<div class="table-responsive">
							<table class="table table-striped m-b-none" data-ride="datatable" id="table-booking">
							<thead>
								<tr>
									<th>Title</th>
									<th>Link</th>
									<th>&nbsp;</th>
								</tr>
							</thead>
							<tbody></tbody>
							</table>
						</div>
					</section>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	
	<div class="modal fade" id="modal-gallery">
		<div class="modal-dialog big">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Gallery Form</h4>
				</div>
				<div class="modal-body">
					<section class="panel panel-default panel-form">
						<form class="bs-example form-horizontal">
							<input type="hidden" name="action" value="gallery_update" />
							<input type="hidden" name="id" value="0" />
							<input type="hidden" name="post_id" value="0" />
						
							<div class="panel-body">
								<div class="form-group">
									<label class="col-lg-2 control-label">Title</label>
									<div class="col-lg-10">
										<input type="text" class="form-control" name="title" placeholder="Title" />
									</div>
								</div>
								<div class="form-group">
									<label class="col-lg-2 control-label">Image</label>
									<div class="col-lg-7">
										<input type="text" name="thumbnail" class="form-control" placeholder="Image" />
									</div>
									<div class="col-lg-3">
										<button type="button" class="btn btn-default browse-image-gallery">Select Picture</button>
									</div>
								</div>
								<div class="form-group center">
									<input type="button" class="btn btn-primary show-gallery-grid" value="Cancel" />
									<input type="submit" class="btn btn-info" value="Save" />
								</div>
							</div>
						</form>
					</section>
					
					<section class="panel panel-default panel-table">
						<div style="padding: 5px 10px; text-align: center;">
							<a class="btn btn-sm btn-default show-gallery-form"><i class="fa fa-plus"></i> Create</a>
						</div>
						<div class="table-responsive">
							<table class="table table-striped m-b-none" data-ride="datatable" id="table-gallery">
							<thead>
								<tr>
									<th style="width: 85%;">Title</th>
									<th style="width: 15%;">&nbsp;</th>
								</tr>
							</thead>
							<tbody></tbody>
							</table>
						</div>
					</section>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	
	<div class="modal fade" id="modal-amenity">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Room Amenities Form</h4>
				</div>
				<div class="modal-body">
					<section style="margin: 0 0 25px 0;">
						<form class="form-inline">
							<input type="hidden" name="action" value="amenity_update" />
							<input type="hidden" name="post_id" value="0" />
							<input type="hidden" name="room_amenity_id" value="0" />
							
							<div class="form-group cnt-typeahead" style="width: 80%;">
								<input type="text" name="amenity_search" class="form-control amenity-typeahead" placeholder="Enter Room Amenities Name" />
							</div>
							<button class="btn btn-info" style="float: right; width: 15%;" type="submit">Add</button>
						</form>
					</section>
					
					<section class="panel panel-default panel-table">
						<div class="table-responsive">
							<table class="table table-striped m-b-none" data-ride="datatable" id="table-amenity">
							<thead>
								<tr>
									<th width="80%">Room Amenities</th>
									<th width="20%">&nbsp;</th>
								</tr>
							</thead>
							<tbody></tbody>
							</table>
						</div>
					</section>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	
	<?php $this->load->view( 'panel/common/header' ); ?>
	
    <section>
		<section class="hbox stretch">
			<?php $this->load->view( 'panel/common/sidebar' ); ?>
			
			<section id="content">
				<section class="vbox">
					<section class="scrollable padder">
						<div class="m-b-md">
							<h3 class="m-b-none">Hotel</h3>
						</div>
						
						<section class="panel panel-default panel-table">
							<header class="header bg-white b-b clearfix">
								<div class="row m-t-sm">
									<div class="col-sm-8 m-b-xs">
										<a class="btn btn-sm btn-default show-dialog"><i class="fa fa-plus"></i> Create</a>
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
										<th width="15%">Category</th>
										<th width="15%">Sub Category</th>
										<th width="30%">Title</th>
										<th width="10%">Update Time</th>
										<th width="15%">Status</th>
										<th width="15%">&nbsp;</th>
									</tr>
								</thead>
								<tbody></tbody>
								</table>
							</div>
						</section>
						
						<section class="panel panel-default panel-form hide" id="cnt-form-main">
							<header class="panel-heading font-bold">Form Hotel</header>
							<div class="panel-body">
								<form class="bs-example form-horizontal">
									<input type="hidden" name="action" value="update" />
									<input type="hidden" name="id" value="0" />
									<input type="hidden" name="member_id" value="0" />
									
									<div class="form-group input-member">
										<label class="col-lg-2 control-label">Member</label>
										<div class="col-lg-10 cnt-typeahead"><input type="text" name="full_name" class="form-control member-typeahead" placeholder="Member" data-required="true" /></div>
									</div>
									<div class="form-group">
										<label class="col-lg-2 control-label">Sub Category</label>
										<div class="col-lg-10">
											<select name="category_sub_id" class="form-control" data-required="true">
												<?php echo ShowOption(array( 'Array' => $array_category_sub )); ?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-lg-2 control-label">Alias</label>
										<div class="col-lg-10"><input type="text" name="alias" class="form-control" placeholder="Alias" data-required="true" /></div>
									</div>
									<div class="form-group">
										<label class="col-lg-2 control-label">Address</label>
										<div class="col-lg-10"><textarea name="address" class="form-control" placeholder="Address" data-required="true"></textarea></div>
									</div>
									<div class="form-group">
										<label class="col-lg-2 control-label">Status</label>
										<div class="col-lg-10"><select name="post_status" class="form-control" data-required="true">
											<option value="">-</option>
											<option value="draft">draft</option>
											<option value="request approve">request approve</option>
											<?php if (in_array($user['user_type_id'], array(USER_TYPE_ADMINISTRATOR, USER_TYPE_EDITOR))) { ?>
											<option value="approve">approve</option>
											<option value="reject">reject</option>
											<?php } ?>
										</select></div>
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
										<label class="col-lg-2 control-label">Star</label>
										<div class="col-lg-10">
											<select name="star" class="form-control">
												<?php echo ShowOption(array( 'Array' => $array_hotel_star )); ?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-lg-2 control-label">Tag</label>
										<div class="col-lg-10"><input type="text" name="tag_content" class="form-control" placeholder="Tag" /></div>
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
									<div class="form-group center post-detail">
										<input type="button" class="btn btn-default show-gallery" value="Gallery" />
										<input type="button" class="btn btn-default show-booking" value="Booking" />
										<input type="button" class="btn btn-default show-amenity" value="Room Amenities" />
									</div>
									
									<header class="panel-heading bg-light"><ul class="nav nav-tabs nav-justified">
										<?php foreach ($array_language as $key => $row) { ?>
										<?php $class_active = (empty($key)) ? 'active' : ''; ?>
										<li class="<?php echo $class_active; ?>"><a href="#language-<?php echo $row['code']; ?>" data-toggle="tab"><?php echo $row['title']; ?></a></li>
										<?php } ?>
									</ul></header>
									<div class="panel-body"><div class="tab-content">
										<?php foreach ($array_language as $key => $row) { ?>
										<?php $class_active = (empty($key)) ? 'active' : ''; ?>
										<div class="tab-pane <?php echo $class_active; ?>" id="language-<?php echo $row['code']; ?>" data-code="<?php echo $row['code']; ?>"><?php echo $row['title']; ?></div>
										<?php } ?>
									</div></div>
									
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
			var raw_page = $('#cnt-page').html();
			eval('var data = ' + raw_page);
			page.data = data;
			
			// set form
			Func.language();
			
			// set view
			if (page.data.user.user_type_id == page.data.USER_TYPE_MEMBER) {
				$('#cnt-form-main .input-member').hide();
			}
		},
		show_grid: function() {
			$('#content .panel-form').hide();
			$('#content .panel-table').show();
		},
		show_form: function() {
			$('#content .panel-form').show();
			$('#content .panel-table').hide();
		},
		modal_booking: {
			show_grid: function() {
				$('#modal-booking .panel-table').show();
				$('#modal-booking .panel-form').hide();
			},
			show_form: function() {
				$('#modal-booking .panel-form').show();
				$('#modal-booking .panel-table').hide();
			}
		},
		modal_gallery: {
			show_grid: function() {
				$('#modal-gallery .panel-table').show();
				$('#modal-gallery .panel-form').hide();
			},
			show_form: function() {
				$('#modal-gallery .panel-form').show();
				$('#modal-gallery .panel-table').hide();
			}
		},
		modal_amenity: {
			show_grid: function() {
				$('#modal-amenity .panel-table').show();
				$('#modal-amenity .panel-form').hide();
			},
			show_form: function() {
				$('#modal-amenity .panel-form').show();
				$('#modal-amenity .panel-table').hide();
			}
		}
	}
	page.init();
	
	// upload
	$('.browse-thumbnail').click(function() { window.iframe_thumbnail.browse() });
	set_thumbnail = function(p) {
		$('#cnt-form-main form [name="thumbnail"]').val(p.file_name);
	}
	$('.browse-image-gallery').click(function() { window.iframe_image_gallery.browse() });
	set_image_gallery = function(p) {
		$('#modal-gallery form [name="thumbnail"]').val(p.file_name);
	}
	
	// typeahead
	var member_store = new Bloodhound({
		limit: 15,
		datumTokenizer: Bloodhound.tokenizers.obj.whitespace('full_name'),
		queryTokenizer: Bloodhound.tokenizers.whitespace,
		prefetch: web.base + 'panel/typeahead/?action=member',
		remote: web.base + 'panel/typeahead/?action=member&namelike=%QUERY'
	});
	member_store.initialize();
	var member_ahead = $('.member-typeahead').typeahead(null, {
		name: 'member-selector',
		displayKey: 'full_name',
		source: member_store.ttAdapter(),
		templates: {
			empty: [ '<div class="empty-message">', 'no result', '</div>' ].join('\n'),
			suggestion: Handlebars.compile('<p><strong>{{full_name}}</strong></p>')
		}
	});
	member_ahead.on('typeahead:selected',function(evt, data) {
		$('#cnt-form-main [name="member_id"]').val(data.id);
	});
	var facility_store = new Bloodhound({
		limit: 15,
		datumTokenizer: Bloodhound.tokenizers.obj.whitespace('title_text'),
		queryTokenizer: Bloodhound.tokenizers.whitespace,
		prefetch: web.base + 'panel/typeahead/?action=facility',
		remote: web.base + 'panel/typeahead/?action=facility&namelike=%QUERY'
	});
	facility_store.initialize();
	var facility_ahead = $('.facility-typeahead').typeahead(null, {
		name: 'facility-selector',
		displayKey: 'title_text',
		source: facility_store.ttAdapter(),
		templates: {
			empty: [ '<div class="empty-message">', 'no result', '</div>' ].join('\n'),
			suggestion: Handlebars.compile('<p><strong>{{title_text}}</strong></p>')
		}
	});
	facility_ahead.on('typeahead:selected',function(evt, data) {
		$('#modal-facility [name="facility_id"]').val(data.id);
	});
	var amenity_store = new Bloodhound({
		limit: 15,
		datumTokenizer: Bloodhound.tokenizers.obj.whitespace('title_default'),
		queryTokenizer: Bloodhound.tokenizers.whitespace,
		prefetch: web.base + 'panel/typeahead/?action=room_amenity',
		remote: web.base + 'panel/typeahead/?action=room_amenity&namelike=%QUERY'
	});
	amenity_store.initialize();
	var amenity_ahead = $('.amenity-typeahead').typeahead(null, {
		name: 'amenity-selector',
		displayKey: 'title_default',
		source: amenity_store.ttAdapter(),
		templates: {
			empty: [ '<div class="empty-message">', 'no result', '</div>' ].join('\n'),
			suggestion: Handlebars.compile('<p><strong>{{title_default}}</strong></p>')
		}
	});
	amenity_ahead.on('typeahead:selected',function(evt, data) {
		$('#modal-amenity [name="room_amenity_id"]').val(data.id);
	});
	
	// grid post
	var param = {
		id: 'datatable', aaSorting: [[ 3, 'DESC' ]],
		source: web.base + 'panel/post/hotel/grid',
		column: [ { }, { }, { }, { sWidth: '15%' }, { }, { bSortable: false, sClass: 'center', sWidth: '13%' } ],
		fnServerParams : function (aoData) {
			aoData.push( { name: "action", "value": 'post' } )
		},
		callback: function() {
			$('#datatable .btn-edit').click(function() {
				var raw_record = $(this).siblings('.hide').text();
				eval('var record = ' + raw_record);
				
				Func.ajax({ url: web.base + 'panel/post/hotel/action', param: { action: 'get_by_id', tag_include: true, id: record.id }, callback: function(result) {
					// post status
					if (Func.InArray(result.post_status, ['approve', 'reject'])) {
						result.post_status = 'draft';
					}
					
					Func.populate({ cnt: '#cnt-form-main', record: result });
					combo.region({ country_id: result.country_id, target: $('#cnt-form-main [name="region_id"]'), value: result.region_id });
					combo.city({ region_id: result.region_id, target: $('#cnt-form-main [name="city_id"]'), value: result.city_id });
					
					$('#cnt-form-main .post-detail').show();
					page.show_form();
				} });
			});
			
			$('#datatable .btn-facility').click(function() {
				var raw_record = $(this).siblings('.hide').text();
				eval('var record = ' + raw_record);
				
				// prepare form & grid
				$('#modal-facility [name="post_id"]').val(record.id);
				facility_dt.reload();
				
				// show modal
				$('#modal-facility').modal();
			});
			
			$('#datatable .btn-delete').click(function() {
				var raw_record = $(this).siblings('.hide').text();
				eval('var record = ' + raw_record);
				
				Func.confirm_delete({
					data: { action: 'delete', id: record.id },
					url: web.base + 'panel/post/hotel/action', callback: function() { dt.reload(); }
				});
			});
		}
	}
	var dt = Func.init_datatable(param);
	
	// grid facility
	var facility_param = {
		id: 'table-facility',
		source: web.base + 'panel/post/hotel/grid',
		column: [ { }, { bSortable: false, sClass: 'center', sWidth: '10%' } ],
		fnServerParams : function (aoData) {
			aoData.push(
				{ name: "action", "value": 'post_facility' },
				{ name: "post_id", "value": $('#modal-facility [name="post_id"]').val() }
			)
		},
		callback: function() {
			$('#table-facility .btn-delete').click(function() {
				var raw_record = $(this).siblings('.hide').text();
				eval('var record = ' + raw_record);
				
				Func.ajax({
					url: web.base + 'panel/post/hotel/action',
					param: { action: 'facility_delete', id: record.id },
					callback: function(result) {
						facility_dt.reload();
					}
				});
			});
		}
	}
	var facility_dt = Func.init_datatable(facility_param);
	
	// grid booking
	var booking_param = {
		id: 'table-booking',
		source: web.base + 'panel/post/hotel/grid',
		column: [ { sWidth: '25%' }, { sWidth: '60%' }, { bSortable: false, sClass: 'center', sWidth: '15%' } ],
		fnServerParams : function (aoData) {
			aoData.push(
				{ name: "action", "value": 'post_booking' },
				{ name: "post_id", "value": $('#modal-booking [name="post_id"]').val() }
			)
		},
		callback: function() {
			$('#table-booking .btn-edit').click(function() {
				var raw_record = $(this).siblings('.hide').text();
				eval('var record = ' + raw_record);
				
				Func.ajax({ url: web.base + 'panel/post/hotel/action', param: { action: 'booking_get_by_id', id: record.id }, callback: function(result) {
					Func.populate({ cnt: '#modal-booking', record: result });
					page.modal_booking.show_form();
				} });
			});
			
			$('#table-booking .btn-delete').click(function() {
				var raw_record = $(this).siblings('.hide').text();
				eval('var record = ' + raw_record);
				
				Func.ajax({
					url: web.base + 'panel/post/hotel/action',
					param: { action: 'booking_delete', id: record.id },
					callback: function(result) {
						booking_dt.reload();
					}
				});
			});
		}
	}
	var booking_dt = Func.init_datatable(booking_param);
	
	// grid gallery
	var gallery_param = {
		id: 'table-gallery',
		source: web.base + 'panel/post/hotel/grid',
		column: [ { }, { bSortable: false, sClass: 'center', sWidth: '15%' } ],
		fnServerParams : function (aoData) {
			aoData.push(
				{ name: "action", "value": 'post_gallery' },
				{ name: "post_id", "value": $('#modal-gallery [name="post_id"]').val() }
			)
		},
		callback: function() {
			$('#table-gallery .btn-edit').click(function() {
				var raw_record = $(this).siblings('.hide').text();
				eval('var record = ' + raw_record);
				
				Func.ajax({ url: web.base + 'panel/post/hotel/action', param: { action: 'gallery_get_by_id', id: record.id }, callback: function(result) {
					Func.populate({ cnt: '#modal-gallery', record: result });
					page.modal_gallery.show_form();
				} });
			});
			
			$('#table-gallery .btn-preview').click(function() {
				var raw_record = $(this).siblings('.hide').text();
				eval('var record = ' + raw_record);
				
				window.open(record.link_thumbnail);
			});
			
			$('#table-gallery .btn-delete').click(function() {
				var raw_record = $(this).siblings('.hide').text();
				eval('var record = ' + raw_record);
				
				Func.ajax({
					url: web.base + 'panel/post/hotel/action',
					param: { action: 'gallery_delete', id: record.id },
					callback: function(result) {
						gallery_dt.reload();
					}
				});
			});
		}
	}
	var gallery_dt = Func.init_datatable(gallery_param);
	
	// grid amenity
	var amenity_param = {
		id: 'table-amenity',
		source: web.base + 'panel/post/hotel/grid',
		column: [ { }, { bSortable: false, sClass: 'center', sWidth: '20%' } ],
		fnServerParams : function (aoData) {
			aoData.push(
				{ name: "action", "value": 'post_amenity' },
				{ name: "post_id", "value": $('#modal-amenity [name="post_id"]').val() }
			)
		},
		callback: function() {
			$('#table-amenity .btn-edit').click(function() {
				var raw_record = $(this).siblings('.hide').text();
				eval('var record = ' + raw_record);
				
				Func.ajax({ url: web.base + 'panel/post/hotel/action', param: { action: 'amenity_get_by_id', id: record.id }, callback: function(result) {
					Func.populate({ cnt: '#modal-amenity', record: result });
					page.modal_amenity.show_form();
				} });
			});
			
			$('#table-amenity .btn-delete').click(function() {
				var raw_record = $(this).siblings('.hide').text();
				eval('var record = ' + raw_record);
				
				Func.ajax({
					url: web.base + 'panel/post/hotel/action',
					param: { action: 'amenity_delete', id: record.id },
					callback: function(result) {
						amenity_dt.reload();
					}
				});
			});
		}
	}
	var amenity_dt = Func.init_datatable(amenity_param);
	
	// form
	var form = $('#cnt-form-main form').parsley();
	$('.show-dialog').click(function() {
		page.show_form();
		$('#cnt-form-main form')[0].reset();
		$('#cnt-form-main form').parsley().reset();
		$('#cnt-form-main [name="id"]').val(0);
		$('#cnt-form-main .post-detail').hide();
		
		// set data for member
		if (page.data.user.user_type_id == page.data.USER_TYPE_MEMBER) {
			$('#cnt-form-main [name="member_id"]').val(page.data.user.id);
			$('#cnt-form-main [name="full_name"]').val(page.data.user.full_name);
		}
	});
	$('#cnt-form-main .btn-primary').click(function() {
		page.show_grid();
	});
	$('#cnt-form-main [name="country_id"]').change(function(){
		combo.region({ country_id: $(this).val(), target: $('#cnt-form-main [name="region_id"]') });
	});
	$('#cnt-form-main [name="region_id"]').change(function(){
		combo.city({ region_id: $(this).val(), target: $('#cnt-form-main [name="city_id"]') });
	});
	$('#cnt-form-main form').submit(function(e) {
		e.preventDefault();
		if (! form.isValid()) {
			return false;
		}
		
		Func.update({
			link: web.base + 'panel/post/hotel/action',
			param: Site.Form.GetValue('#cnt-form-main form'),
			callback: function() {
				dt.reload();
				page.show_grid();
				$('#cnt-form-main form')[0].reset();
			}
		});
	});
	
	// form facility
	$('#modal-facility form').submit(function(e) {
		e.preventDefault();
		Func.update({
			link: web.base + 'panel/post/hotel/action',
			param: Site.Form.GetValue('#modal-facility form'),
			callback: function() {
				facility_dt.reload();
				$('#modal-facility [name="facility_search"]').val('');
			}
		});
	});
	
	// form booking
	var form_booking = $('#modal-booking form').parsley();
	$('.show-booking').click(function() {
		page.modal_booking.show_grid();
		$('#modal-booking').modal();
		
		// load dt
		$('#modal-booking [name="post_id"]').val($('#cnt-form-main [name="id"]').val());
		booking_dt.reload();
	});
	$('#modal-booking .show-booking-form').click(function() {
		page.modal_booking.show_form();
		
		// set default record
		$('#modal-booking form')[0].reset();
		$('#modal-booking form').parsley().reset();
		$('#modal-booking [name="id"]').val(0);
		$('#modal-booking [name="post_id"]').val($('#cnt-form-main [name="id"]').val());
	});
	$('#modal-booking .show-booking-grid').click(function() {
		page.modal_booking.show_grid();
	});
	$('#modal-booking form').submit(function(e) {
		e.preventDefault();
		if (! form_booking.isValid()) {
			return false;
		}
		
		Func.update({
			link: web.base + 'panel/post/hotel/action',
			param: Site.Form.GetValue('#modal-booking form'),
			callback: function() {
				booking_dt.reload();
				page.modal_booking.show_grid();
				$('#modal-booking form')[0].reset();
			}
		});
	});
	
	// form gallery
	var form_gallery = $('#modal-gallery form').parsley();
	$('.show-gallery').click(function() {
		page.modal_gallery.show_grid();
		$('#modal-gallery').modal();
		
		// load dt
		$('#modal-gallery [name="post_id"]').val($('#cnt-form-main [name="id"]').val());
		gallery_dt.reload();
	});
	$('#modal-gallery .show-gallery-form').click(function() {
		page.modal_gallery.show_form();
		
		// set default record
		$('#modal-gallery form')[0].reset();
		$('#modal-gallery form').parsley().reset();
		$('#modal-gallery [name="id"]').val(0);
		$('#modal-gallery [name="post_id"]').val($('#cnt-form-main [name="id"]').val());
	});
	$('#modal-gallery .show-gallery-grid').click(function() {
		page.modal_gallery.show_grid();
	});
	$('#modal-gallery form').submit(function(e) {
		e.preventDefault();
		if (! form_gallery.isValid()) {
			return false;
		}
		
		Func.update({
			link: web.base + 'panel/post/hotel/action',
			param: Site.Form.GetValue('#modal-gallery form'),
			callback: function() {
				gallery_dt.reload();
				page.modal_gallery.show_grid();
				$('#modal-gallery form')[0].reset();
			}
		});
	});
	
	// form amenity
	var form_amenity = $('#modal-amenity form').parsley();
	$('.show-amenity').click(function() {
		page.modal_amenity.show_grid();
		$('#modal-amenity').modal();
		
		// load dt
		$('#modal-amenity [name="post_id"]').val($('#cnt-form-main [name="id"]').val());
		amenity_dt.reload();
	});
	$('#modal-amenity form').submit(function(e) {
		e.preventDefault();
		if (! form_amenity.isValid()) {
			return false;
		}
		
		Func.update({
			link: web.base + 'panel/post/hotel/action',
			param: Site.Form.GetValue('#modal-amenity form'),
			callback: function() {
				amenity_dt.reload();
				page.modal_amenity.show_grid();
				$('#modal-amenity form')[0].reset();
			}
		});
	});
});
</script>

<?php $this->load->view( 'panel/common/footer'); ?>