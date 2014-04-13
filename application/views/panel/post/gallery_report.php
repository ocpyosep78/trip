<?php $this->load->view( 'panel/common/meta' ); ?>
<body>
<section class="vbox">
	<div class="modal fade" id="modal-gallery">
		<div class="modal-dialog">
			<div class="modal-content">
				<form class="form-horizontal">
					<input type="hidden" name="action" value="update" />
					<input type="hidden" name="id" value="0" />
					
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Traveler Report Form</h4>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label class="col-sm-2 control-label">Name</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="name" data-required="true" placeholder="Name" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Email</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="email" data-required="true" placeholder="Email" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Topic</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="topic" data-required="true" placeholder="Topic" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Content</label>
							<div class="col-sm-10">
								<textarea class="form-control" name="content" data-required="true" placeholder="Content"></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Status</label>
							<div class="col-sm-10">
								<select name="status" class="form-control" data-required="true">
									<option value="">-</option>
									<option value="pending">pending</option>
									<option value="done">done</option>
								</select>
							</div>
						</div>
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
							<h3 class="m-b-none">Traveler Report</h3>
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
										<th width="25%">Name</th>
										<th width="25%">Topic</th>
										<th width="20%">Post Date</th>
										<th width="15%">Status</th>
										<th width="15%">&nbsp;</th>
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
		id: 'datatable', aaSorting: [[ 2, 'DESC' ]],
		source: web.base + 'panel/post/gallery_report/grid',
		column: [ { }, { }, { }, { }, { bSortable: false, sClass: 'center', sWidth: '15%' } ],
		callback: function() {
			$('#datatable .btn-edit').click(function() {
				var raw_record = $(this).siblings('.hide').text();
				eval('var record = ' + raw_record);
				
				Func.ajax({ url: web.base + 'panel/post/gallery_report/action', param: { action: 'get_by_id', id: record.id }, callback: function(result) {
					Func.populate({ cnt: '#modal-gallery', record: result });
					$('#modal-gallery').modal();
				} });
			});
			
			$('#datatable .btn-link').click(function() {
				var raw_record = $(this).siblings('.hide').text();
				eval('var record = ' + raw_record);
				window.open(record.link_traveler_report);
			});
			
			$('#datatable .btn-delete').click(function() {
				var raw_record = $(this).siblings('.hide').text();
				eval('var record = ' + raw_record);
				
				Func.confirm_delete({
					data: { action: 'delete', id: record.id },
					url: web.base + 'panel/post/gallery_report/action', callback: function() { dt.reload(); }
				});
			});
		}
	}
	var dt = Func.init_datatable(param);
	
	// form
	var form = $('#modal-gallery form').parsley();
	$('#modal-gallery form').submit(function(e) {
		e.preventDefault();
		if (! form.isValid()) {
			return false;
		}
		
		Func.update({
			link: web.base + 'panel/post/gallery_report/action',
			param: Site.Form.GetValue('modal-gallery form'),
			callback: function() {
				dt.reload();
				$('#modal-gallery').modal('hide');
				$('#modal-gallery form')[0].reset();
			}
		});
	});
});
</script>

<?php $this->load->view( 'panel/common/footer'); ?>