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
										<th width="50%">Title</th>
										<th width="20%">Update Time</th>
										<th width="15%">Status</th>
										<th width="15%">&nbsp;</th>
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
										<label class="col-sm-2 control-label">Title</label>
										<div class="col-sm-10">
											<input type="text" name="name" class="form-control" data-required="true" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label">Content</label>
										<div class="col-sm-10">
											<div class="btn-toolbar m-b-sm btn-editor" data-role="editor-toolbar" data-target="#editor-content">
												<div class="btn-group">
													<a class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" title="Font"><i class="fa fa-font"></i><b class="caret"></b></a>
													<ul class="dropdown-menu"></ul>
												</div>
												<div class="btn-group">
													<a class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" title="Font Size"><i class="fa fa-text-height"></i>&nbsp;<b class="caret"></b></a>
													<ul class="dropdown-menu">
														<li><a data-edit="fontSize 5"><font size="5">Huge</font></a></li>
														<li><a data-edit="fontSize 3"><font size="3">Normal</font></a></li>
														<li><a data-edit="fontSize 1"><font size="1">Small</font></a></li>
													</ul>
												</div>
												<div class="btn-group">
													<a class="btn btn-default btn-sm" data-edit="bold" title="Bold (Ctrl/Cmd+B)"><i class="fa fa-bold"></i></a>
													<a class="btn btn-default btn-sm" data-edit="italic" title="Italic (Ctrl/Cmd+I)"><i class="fa fa-italic"></i></a>
													<a class="btn btn-default btn-sm" data-edit="strikethrough" title="Strikethrough"><i class="fa fa-strikethrough"></i></a>
													<a class="btn btn-default btn-sm" data-edit="underline" title="Underline (Ctrl/Cmd+U)"><i class="fa fa-underline"></i></a>
												</div>
												<div class="btn-group">
													<a class="btn btn-default btn-sm" data-edit="insertunorderedlist" title="Bullet list"><i class="fa fa-list-ul"></i></a>
													<a class="btn btn-default btn-sm" data-edit="insertorderedlist" title="Number list"><i class="fa fa-list-ol"></i></a>
													<a class="btn btn-default btn-sm" data-edit="outdent" title="Reduce indent (Shift+Tab)"><i class="fa fa-dedent"></i></a>
													<a class="btn btn-default btn-sm" data-edit="indent" title="Indent (Tab)"><i class="fa fa-indent"></i></a>
												</div>
												<div class="btn-group">
													<a class="btn btn-default btn-sm" data-edit="justifyleft" title="Align Left (Ctrl/Cmd+L)"><i class="fa fa-align-left"></i></a>
													<a class="btn btn-default btn-sm" data-edit="justifycenter" title="Center (Ctrl/Cmd+E)"><i class="fa fa-align-center"></i></a>
													<a class="btn btn-default btn-sm" data-edit="justifyright" title="Align Right (Ctrl/Cmd+R)"><i class="fa fa-align-right"></i></a>
													<a class="btn btn-default btn-sm" data-edit="justifyfull" title="Justify (Ctrl/Cmd+J)"><i class="fa fa-align-justify"></i></a>
												</div>
												<div class="btn-group">
													<a class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" title="Hyperlink"><i class="fa fa-link"></i></a>
													<div class="dropdown-menu">
														<div class="input-group m-l-xs m-r-xs">
															<input class="form-control input-sm" placeholder="URL" type="text" data-edit="createLink"/>
															<div class="input-group-btn">
																<button class="btn btn-default btn-sm" type="button">Add</button>
															</div>
														</div>
													</div>
													<a class="btn btn-default btn-sm" data-edit="unlink" title="Remove Hyperlink"><i class="fa fa-cut"></i></a>
												</div>
												<div class="btn-group">
													<a class="btn btn-default btn-sm" data-edit="undo" title="Undo (Ctrl/Cmd+Z)"><i class="fa fa-undo"></i></a>
													<a class="btn btn-default btn-sm" data-edit="redo" title="Redo (Ctrl/Cmd+Y)"><i class="fa fa-repeat"></i></a>
												</div>
											</div>
											<div id="editor-content" class="form-control editor-wysiwyg" style="overflow:scroll;height:150px;max-height:150px"></div>
										</div>
									</div>
									<div class="line line-dashed line-lg pull-in"></div>
									<div class="form-group">
										<div class="col-sm-4 col-sm-offset-2">
											<button class="btn btn-default show-table" type="button">Cancel</button>
											<button class="btn btn-primary" type="submit">Save</button>
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
		show_table: function() {
			$('.panel-table').show();
			$('.panel-form').hide();
		},
		show_form: function() {
			$('.panel-table').hide();
			$('.panel-form').show();
		}
	}
	
	// grid
	var param = {
		id: 'datatable', aaSorting: [[1, 'desc']],
		source: web.base + 'panel/user/mass_email/grid',
		column: [ { }, { }, { }, { bSortable: false, sClass: 'center', sWidth: '15%' } ],
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