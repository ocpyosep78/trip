<?php $this->load->view( 'panel/common/meta' ); ?>
<body>
<section class="vbox">
	<div class="modal fade" id="modal-widget">
		<div class="modal-dialog">
			<div class="modal-content">
				<form data-validate="parsley">
					<input type="hidden" name="action" value="update" />
					<input type="hidden" name="id" value="0" />
					
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Widget Form</h4>
					</div>
					<div class="modal-body">
						<section class="panel panel-default">
							<div class="panel-body">
								<div class="form-group">
									<label>Title</label>
									<input type="text" class="form-control" name="name" data-required="true" />
								</div>
								<div class="form-group">
									<label>Alias</label>
									<input type="text" class="form-control" name="alias" data-required="true" readonly="readonly" />
								</div>
								<div class="form-group">
									<label>Content</label>
									<textarea class="form-control" name="content" data-required="true" placeholder="Type your content" rows="3"></textarea>
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
	
    <section>
		<section class="hbox stretch">
			<?php $this->load->view( 'panel/common/sidebar' ); ?>
			
			<section id="content">
				<section class="vbox">
					<section class="scrollable padder">
						<div class="m-b-md">
							<h3 class="m-b-none">Widget</h3>
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
										<th width="50%">&nbsp;</th>
									</tr>
								</thead>
								<tbody></tbody>
								</table>
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
	// grid
	var param = {
		id: 'datatable',
		source: web.base + 'panel/master/widget/grid',
		column: [ { }, { bSortable: false, sClass: 'center', sWidth: '10%' } ],
		callback: function() {
			$('#datatable .btn-edit').click(function() {
				var raw_record = $(this).siblings('.hide').text();
				eval('var record = ' + raw_record);
				
				Func.ajax({ url: web.base + 'panel/master/widget/action', param: { action: 'get_by_id', id: record.id }, callback: function(result) {
					$('#modal-widget [name="id"]').val(result.id);
					$('#modal-widget [name="name"]').val(result.name);
					$('#modal-widget [name="alias"]').val(result.alias);
					$('#modal-widget [name="content"]').val(result.content);
					$('#modal-widget').modal();
				} });
			});
			
			$('#datatable .btn-delete').click(function() {
				var raw_record = $(this).siblings('.hide').text();
				eval('var record = ' + raw_record);
				
				Func.confirm_delete({
					data: { action: 'delete', id: record.id },
					url: web.base + 'panel/master/widget/action', callback: function() { dt.reload(); }
				});
			});
		}
	}
	var dt = Func.init_datatable(param);
	
	// form
	var form = $('#modal-widget form').parsley();
	$('#modal-widget [name="name"]').keyup(function() {
		var value = Func.GetName($(this).val());
		$('#modal-widget [name="alias"]').val(value);
	});
	$('.show-dialog').click(function() {
		$('#modal-widget').modal();
		$('#modal-widget form')[0].reset();
		$('#modal-widget [name="id"]').val(0);
	});
	$('#modal-widget form').submit(function(e) {
		e.preventDefault();
		if (! form.isValid()) {
			return false;
		}
		
		var param = Site.Form.GetValue('modal-widget form');
		Func.ajax({ url: web.base + 'panel/master/widget/action', param: param, callback: function(result) {
			if (result.status == 1) {
				dt.reload();
				$('#modal-widget').modal('hide');
				$.notify(result.message, "success");
				$('#modal-widget form')[0].reset();
			} else {
				$.notify(result.message, "error");
			}
		} });
		
		return false;
	});
});
</script>

<?php $this->load->view( 'panel/common/footer'); ?>