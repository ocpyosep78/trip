<?php
	// user
	$user_session = $this->user_model->get_session();
	$user = $this->user_model->get_by_id(array( 'user_type_id' => $user_session['user_type_id'], 'id' => $user_session['id'] ));
	
	// master
	$array_language = $this->language_model->get_array();
	$array_promo_duration = $this->promo_duration_model->get_array();
	
	// page data
	$page['USER_TYPE_ADMINISTRATOR'] = USER_TYPE_ADMINISTRATOR;
	$page['USER_TYPE_EDITOR'] = USER_TYPE_EDITOR;
	$page['USER_TYPE_MEMBER'] = USER_TYPE_MEMBER;
	$page['user'] = $user_session;
?>

<?php $this->load->view( 'panel/common/meta' ); ?>
<body>
<section class="vbox">
	<div class="hide"><div id="cnt-page"><?php echo json_encode($page); ?></div></div>
	
	<div class="modal fade" id="modal-confirm">
		<div class="modal-dialog">
			<div class="modal-content"><form>
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Promo Duration</h4>
				</div>
				<div class="modal-body">
					<section>
						<div class="form-group">
							<label>Promo Duration</label>
							<select name="promo_duration_id" class="form-control" data-required="true">
								<?php echo ShowOption(array( 'Array' => $array_promo_duration, 'ArrayTitle' => 'title_text' )); ?>
							</select>
						</div>
						<div class="checkbox">
							<label>
								<input type="checkbox" name="check" data-required="true"> I agree to the <a href="<?php echo base_url('term-of-use'); ?>" target="_blank" class="text-info">Terms of Use</a>
							</label>
						</div>
					</section>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-info">Save changes</button>
				</div>
			</form></div>
		</div>
	</div>
	
	<div class="modal fade" id="modal-validation">
		<div class="modal-dialog">
			<div class="modal-content">
				<form>
					<input type="hidden" name="action" value="update_status" />
					<input type="hidden" name="id" value="0" />
					<input type="hidden" name="promo_status" value="" />
					
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Sent Mail Form</h4>
					</div>
					<div class="modal-body">
						<section class="panel panel-default">
							<div class="panel-body">
								<div class="form-group">
									<label>Title</label>
									<input type="text" class="form-control" name="title" data-required="true" />
								</div>
								<div class="form-group">
									<label>Content</label>
									<textarea class="form-control" name="content" data-required="true"></textarea>
								</div>
							</div>
						</section>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-info">Save changes</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<?php $this->load->view( 'panel/common/header' ); ?>
	
	<div class="hide">
		<div class="form-language">
			<div class="form-group">
				<label class="col-lg-2 control-label">Title</label>
				<div class="col-lg-10"><input type="text" name="title" class="form-control" placeholder="Title" /></div>
			</div>
			<div class="form-group">
				<label class="col-lg-2 control-label">Content</label>
				<div class="col-lg-10"><div name="content" class="input-tinymce"></div></div>
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
							<h3 class="m-b-none">Promo</h3>
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
										<th width="25%">Post</th>
										<th width="15%">Duration</th>
										<th width="15%">Publish Date</th>
										<th width="15%">Closed Date</th>
										<th width="15%">Status</th>
										<th width="15%">&nbsp;</th>
									</tr>
								</thead>
								<tbody></tbody>
								</table>
							</div>
						</section>
						
						<section class="panel panel-default panel-form hide">
							<header class="panel-heading font-bold">Form Promo</header>
							<div class="panel-body">
								<form class="bs-example form-horizontal">
									<input type="hidden" name="action" value="update" />
									<input type="hidden" name="id" value="0" />
									<input type="hidden" name="post_id" value="0" />
									
									<div class="form-group">
										<label class="col-lg-2 control-label">Post</label>
										<div class="col-lg-10 cnt-typeahead"><input type="text" name="post_title_text" class="form-control post-typeahead" placeholder="Post" data-required="true" /></div>
									</div>
									<div class="form-group hide">
										<label class="col-lg-2 control-label">Promo Duration</label>
										<div class="col-lg-10">
											<select name="promo_duration_id" class="form-control">
												<?php echo ShowOption(array( 'Array' => $array_promo_duration, 'ArrayTitle' => 'title_text' )); ?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-lg-2 control-label">Publish Date</label>
										<div class="col-lg-10">
											<input type="text" name="publish_date" class="form-control datepicker-input" placeholder="Publish Date" data-date-format="dd-mm-yyyy" data-required="true" />
										</div>
									</div>
									<div class="form-group input-close-date">
										<label class="col-lg-2 control-label">Closed Date</label>
										<div class="col-lg-10">
											<input type="text" name="close_date" class="form-control datepicker-input" placeholder="Closed Date" data-date-format="dd-mm-yyyy" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-lg-2 control-label">Status</label>
										<div class="col-lg-10">
											<select name="promo_status" class="form-control" data-required="true">
												<option value="">-</option>
												<option value="draft">draft</option>
												<option value="request approve">request approve</option>
												<?php if (in_array($user['user_type_id'], array(USER_TYPE_ADMINISTRATOR, USER_TYPE_EDITOR))) { ?>
												<option value="approve">approve</option>
												<option value="reject">reject</option>
												<?php } ?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-lg-2 control-label">Keyword Tag</label>
										<div class="col-lg-10"><input type="text" name="keyword" class="form-control" placeholder="Keyword Tag" /></div>
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
				$('.panel-form .input-close-date').hide();
			}
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
	
	// typeahead
	var post_store = new Bloodhound({
		limit: 15,
		datumTokenizer: Bloodhound.tokenizers.obj.whitespace('title_text'),
		queryTokenizer: Bloodhound.tokenizers.whitespace,
		prefetch: web.base + 'panel/typeahead/?action=post',
		remote: web.base + 'panel/typeahead/?action=post&namelike=%QUERY'
	});
	post_store.initialize();
	var post_ahead = $('.post-typeahead').typeahead(null, {
		name: 'post-selector',
		displayKey: 'title_text',
		source: post_store.ttAdapter(),
		templates: {
			empty: [ '<div class="empty-message">', 'no result', '</div>' ].join('\n'),
			suggestion: Handlebars.compile('<p><strong>{{title_text}}</strong></p>')
		}
	});
	post_ahead.on('typeahead:selected',function(evt, data) {
		$('.panel-form [name="post_id"]').val(data.id);
	});
	
	// grid
	var param = {
		id: 'datatable', aaSorting: [[ 2, 'DESC' ]],
		source: web.base + 'panel/post/promo/grid',
		column: [ { }, { }, { }, { }, { }, { bSortable: false, sClass: 'center', sWidth: '15%' } ],
		callback: function() {
			$('#datatable .btn-edit').click(function() {
				var raw_record = $(this).siblings('.hide').text();
				eval('var record = ' + raw_record);
				
				Func.ajax({ url: web.base + 'panel/post/promo/action', param: { action: 'get_by_id', id: record.id }, callback: function(result) {
					// set it draft
					if (Func.InArray(result.promo_status, ['approve', 'reject'])) {
						result.promo_status = 'draft';
					}
					
					Func.populate({ cnt: '.panel-form', record: result });
					page.show_form();
				} });
			});
			
			$('#datatable .btn-approve').click(function() {
				var raw_record = $(this).siblings('.hide').text();
				eval('var record = ' + raw_record);
				
				Func.populate({ cnt: '#modal-validation', record: { id: record.id, promo_status: 'approve' } });
				$('#modal-validation').modal();
				/*
				Func.update({
					link: web.base + 'panel/post/promo/action',
					param: { id: record.id, action: 'update_status', promo_status: 'approve' },
					callback: function() {
						dt.reload();
					}
				});
				/*	*/
			});
			
			$('#datatable .btn-reject').click(function() {
				var raw_record = $(this).siblings('.hide').text();
				eval('var record = ' + raw_record);
				
				Func.populate({ cnt: '#modal-validation', record: { id: record.id, promo_status: 'reject' } });
				$('#modal-validation').modal();
				
				/*
				Func.update({
					link: web.base + 'panel/post/promo/action',
					param: { id: record.id, action: 'update_status', promo_status: 'reject' },
					callback: function() {
						dt.reload();
					}
				});
				/*	*/
			});
		
			$('#datatable .btn-delete').click(function() {
				var raw_record = $(this).siblings('.hide').text();
				eval('var record = ' + raw_record);
				
				Func.confirm_delete({
					data: { action: 'delete', id: record.id },
					url: web.base + 'panel/post/promo/action', callback: function() { dt.reload(); }
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
	$('.panel-form form').submit(function(e) {
		e.preventDefault();
		if (! form.isValid()) {
			return false;
		}
		
		var param = Site.Form.GetValue('.panel-form form');
		if (param.promo_status == 'request approve') {
			$('#modal-confirm').modal();
			$('#modal-confirm [name="check"]').prop('checked', false);
		} else {
			Func.update({
				link: web.base + 'panel/post/promo/action',
				param: Site.Form.GetValue('.panel-form form'),
				callback: function() {
					dt.reload();
					page.show_grid();
					$('.panel-form form')[0].reset();
				}
			});
		}
	});
	
	// modal confirm
	var form_confirm = $('#modal-confirm form').parsley();
	$('#modal-confirm [name="promo_duration_id"]').change(function() {
		$('.panel-form [name="promo_duration_id"]').val($(this).val());
	});
	$('#modal-confirm form').submit(function(e) {
		e.preventDefault();
		if (! form_confirm.isValid()) {
			return false;
		}
		
		Func.update({
			link: web.base + 'panel/post/promo/action',
			param: Site.Form.GetValue('.panel-form form'),
			callback: function() {
				dt.reload();
				page.show_grid();
				$('#modal-confirm').modal('hide');
			}
		});
	});
	
	// modal validation email
	var form_validation = $('#modal-validation form').parsley();
	$('#modal-validation form').submit(function(e) {
		e.preventDefault();
		if (! form_validation.isValid()) {
			return false;
		}
		
		// execute
		var param = Site.Form.GetValue('#modal-validation form');
		Func.update({
			link: web.base + 'panel/post/promo/action',
			param: param,
			callback: function() {
				dt.reload();
				$('#modal-validation').modal('hide');
				
				if (param.promo_status == 'approve') {
					Func.ajax({ url: web.base + 'service/post_update', is_json: false });
				}
			}
		});
	});
	
	// helper
	$('.show-dialog').click(function() {
		page.show_form();
		$('.panel-form form')[0].reset();
		$('.panel-form form').parsley().reset();
		$('.panel-form form .input-tinymce').html('');
		$('.panel-form [name="id"]').val(0);
	});
});
</script>

<?php $this->load->view( 'panel/common/footer'); ?>