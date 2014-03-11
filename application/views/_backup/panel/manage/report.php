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
							<h3 class="m-b-none">Report</h3>
						</div>
						
						<section class="panel panel-default panel-table grid-view">
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
										<th width="35%">Report Type</th>
										<th width="35%">Detail</th>
										<th width="15%">Post Time</th>
										<th width="15%">&nbsp;</th>
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
										<label class="col-lg-2 control-label">Report Type</label>
										<div class="col-lg-10">
											<input type="text" name="report_type_name" class="form-control" placeholder="Name" readonly="readonly" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-lg-2 control-label">Email Sender</label>
										<div class="col-lg-10">
											<input type="text" name="email" class="form-control" placeholder="Email Sender" readonly="readonly" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-lg-2 control-label">Post Time</label>
										<div class="col-lg-10">
											<input type="text" name="post_time" class="form-control" placeholder="Post Time" readonly="readonly" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-lg-2 control-label">Detail</label>
										<div class="col-lg-10">
											<textarea name="detail" class="form-control" placeholder="Name" readonly="readonly"></textarea>
										</div>
									</div>
									<div class="form-group">
										<div class="col-lg-offset-2 col-lg-10">
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
		}
	}
	
	// grid
	var param = {
		id: 'datatable', aaSorting: [[2, 'desc']],
		source: web.base + 'panel/manage/report/grid',
		column: [ { }, { }, { }, { bSortable: false, sClass: 'center', sWidth: '15%' } ],
		callback: function() {
			$('#datatable .btn-edit').click(function() {
				var raw_record = $(this).siblings('.hide').text();
				eval('var record = ' + raw_record);
				
				Func.ajax({ url: web.base + 'panel/manage/report/action', param: { action: 'get_by_id', id: record.id }, callback: function(result) {
					Func.populate({ cnt: '.form-view form', record: result });
					$('#editor-content').html(result.content);
					page.show_form();
				} });
			});
			
			$('#datatable .btn-delete').click(function() {
				var raw_record = $(this).siblings('.hide').text();
				eval('var record = ' + raw_record);
				
				Func.confirm_delete({
					data: { action: 'delete', id: record.id },
					url: web.base + 'panel/manage/report/action', callback: function() { dt.reload(); }
				});
			});
		}
	}
	var dt = Func.init_datatable(param);
	
	// helper
	$('.show-form').click(function() {
		page.show_form();
		$('.form-view form')[0].reset();
		$('.form-view [name="id"]').val(0);
		$('#editor-content').html('');
	});
	$('.show-grid').click(function() {
		page.show_grid();
	});
});
</script>

<?php $this->load->view( 'panel/common/footer'); ?>