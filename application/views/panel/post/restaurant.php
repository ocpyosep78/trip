<?php
	$array_country = $this->country_model->get_array();
	$array_language = $this->language_model->get_array();
	$array_category_sub = $this->category_sub_model->get_array(array( 'category_id' => CATEGORY_RESTAURANT ));
?>

<?php $this->load->view( 'panel/common/meta' ); ?>
<body>
<section class="vbox">
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
					<button type="submit" class="btn btn-info">Save changes</button>
				</div>
			</div>
		</div>
	</div>
	
	<div class="hide">
		<iframe name="iframe_thumbnail" src="<?php echo base_url('panel/upload?callback_name=set_thumbnail'); ?>"></iframe>
	</div>
	<?php $this->load->view( 'panel/common/header' ); ?>
	
	<div class="hide">
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
				<label class="col-lg-2 control-label">Description 3</label>
				<div class="col-lg-10"><textarea name="desc_03" class="form-control" placeholder="Description 3"></textarea></div>
			</div>
			<div class="form-group">
				<label class="col-lg-2 control-label">Map</label>
				<div class="col-lg-10"><div name="map" class="input-tinymce"></div></div>
			</div>
			<div class="form-group">
				<label class="col-lg-2 control-label">Field 1</label>
				<div class="col-lg-10"><input type="text" name="field_01" class="form-control" placeholder="Field 1" /></div>
			</div>
		</div>
	</div>
	
    <section>
		<section class="hbox stretch">
			<?php $this->load->view( 'panel/common/sidebar' ); ?>
			
			<section id="content">
				<section class="vbox">
					<section class="scrollable padder">
						<div class="m-b-md">
							<h3 class="m-b-none">Restaurant</h3>
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
										<th width="20%">Category</th>
										<th width="20%">Sub Category</th>
										<th width="30%">Title</th>
										<th width="15%">Status</th>
										<th width="15%">&nbsp;</th>
									</tr>
								</thead>
								<tbody></tbody>
								</table>
							</div>
						</section>
						
						<section class="panel panel-default panel-form hide">
							<header class="panel-heading font-bold">Form Restaurant</header>
							<div class="panel-body">
								<form class="bs-example form-horizontal">
									<input type="hidden" name="action" value="update" />
									<input type="hidden" name="id" value="0" />
									<input type="hidden" name="member_id" value="0" />
									
									<div class="form-group">
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
											<option value="approve">approve</option>
											<option value="reject">reject</option>
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
			Func.language();
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
	
	// grid post
	var param = {
		id: 'datatable',
		source: web.base + 'panel/post/restaurant/grid',
		column: [ { }, { }, { }, { }, { bSortable: false, sClass: 'center', sWidth: '10%' } ],
		fnServerParams : function (aoData) {
			aoData.push( { name: "action", "value": 'post' } )
		},
		callback: function() {
			$('#datatable .btn-edit').click(function() {
				var raw_record = $(this).siblings('.hide').text();
				eval('var record = ' + raw_record);
				
				Func.ajax({ url: web.base + 'panel/post/restaurant/action', param: { action: 'get_by_id', tag_include: true, id: record.id }, callback: function(result) {
					Func.populate({ cnt: '.panel-form', record: result });
					combo.region({ country_id: result.country_id, target: $('.panel-form [name="region_id"]'), value: result.region_id });
					combo.city({ region_id: result.region_id, target: $('.panel-form [name="city_id"]'), value: result.city_id });
					
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
					url: web.base + 'panel/post/restaurant/action', callback: function() { dt.reload(); }
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
		$('.panel-form [name="member_id"]').val(data.id);
	});
	
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
			link: web.base + 'panel/post/restaurant/action',
			param: Site.Form.GetValue('.panel-form form'),
			callback: function() {
				dt.reload();
				page.show_grid();
				$('.panel-form form')[0].reset();
			}
		});
	});
	
	// form facility
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