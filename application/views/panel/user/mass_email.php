<?php $this->load->view( 'panel/common/meta' ); ?>
<body>
<section class="vbox">
	<?php $this->load->view( 'panel/common/header' ); ?>
	
    <section>
		<section class="hbox stretch">
			<?php $this->load->view( 'panel/common/sidebar' ); ?>
			
			<section id="content">
				<section class="vbox">
					<section class="scrollable padder">
						<div class="m-b-md">
							<h3 class="m-b-none">Mass Email</h3>
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
										<th width="20%">To</th>
										<th width="20%">Title</th>
										<th width="20%">Update Time</th>
										<th width="20%">Status</th>
										<th width="20%">&nbsp;</th>
									</tr>
								</thead>
								<tbody></tbody>
								</table>
							</div>
						</section>
						
						<section class="panel panel-default panel-form hide" id="form-mass-email">
							<header class="panel-heading font-bold">Mass Email Form</header>
							<div class="panel-body">
								<form class="form-horizontal" data-validate="parsley">
									<input type="hidden" name="action" value="update" />
									<input type="hidden" name="id" value="0" />
									
									<div class="form-group">
										<label class="col-lg-2 control-label">To</label>
										<div class="col-lg-10">
											<select name="to" class="form-control" data-required="true">
												<option value="">-</option>
												<option value="All">All</option>
												<option value="Member">Member</option>
												<option value="Traveler">Traveler</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label">Title</label>
										<div class="col-sm-10">
											<input type="text" name="name" class="form-control" data-required="true" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label">Content</label>
										<div class="col-sm-10">
											<div id="editor-content" class="form-control editor-wysiwyg" style="overflow:scroll;height:150px;max-height:150px"></div>
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
			set_wysiwyg({ id: 'editor-content' });
		},
		show_table: function() {
			$('.panel-table').show();
			$('.panel-form').hide();
		},
		show_form: function() {
			$('.panel-table').hide();
			$('.panel-form').show();
		}
	}
	page.init();
	
	// grid
	var param = {
		id: 'datatable', aaSorting: [[1, 'desc']],
		source: web.base + 'panel/user/mass_email/grid',
		column: [ { }, { }, { }, { }, { bSortable: false, sClass: 'center', sWidth: '15%' } ],
		callback: function() {
			$('#datatable .btn-edit').click(function() {
				var raw_record = $(this).siblings('.hide').text();
				eval('var record = ' + raw_record);
				
				Func.ajax({ url: web.base + 'panel/user/mass_email/action', param: { action: 'get_by_id', id: record.id }, callback: function(result) {
					Func.populate({ cnt: '#form-mass-email', record: result });
					$('#editor-content').html(result.content);
					page.show_form();
				} });
			});
			
			$('#datatable .btn-sent').click(function() {
				var raw_record = $(this).siblings('.hide').text();
				eval('var record = ' + raw_record);
				
				Func.update({ param: { action: 'sent_mail', id: record.id }, link: web.base + 'panel/user/mass_email/action', callback: function() {
					dt.reload();
				} });
			});
			
			$('#datatable .btn-delete').click(function() {
				var raw_record = $(this).siblings('.hide').text();
				eval('var record = ' + raw_record);
				
				Func.confirm_delete({
					data: { action: 'delete', id: record.id },
					url: web.base + 'panel/user/mass_email/action', callback: function() { dt.reload(); }
				});
			});
		}
	}
	var dt = Func.init_datatable(param);
	
	// form
	var form = $('#form-mass-email form').parsley();
	$('#form-mass-email .btn-primary').click(function() {
		page.show_table();
	});
	$('#form-mass-email form').submit(function(e) {
		e.preventDefault();
		if (! form.isValid()) {
			return false;
		}
		
		var param = Site.Form.GetValue('form-mass-email form');
		param.content = $('#editor-content').html();
		Func.update({
			param: param,
			link: web.base + 'panel/user/mass_email/action',
			callback: function() {
				dt.reload();
				page.show_table();
			}
		});
	});
	
	// display
	$('.show-dialog').click(function() {
		page.show_form();
		$('#form-mass-email form')[0].reset();
		$('#form-mass-email [name="id"]').val(0);
		$('#editor-content').html('');
	});
	$('.show-table').click(function() {
		page.show_table();
	});
});
</script>

<?php $this->load->view( 'panel/common/footer'); ?>