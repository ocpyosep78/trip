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
							<h3 class="m-b-none">Payment</h3>
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
										<th width="30%">Post</th>
										<th width="15%">Email</th>
										<th width="15%">Sender</th>
										<th width="15%">Transfer Date</th>
										<th width="10%">Status</th>
										<th width="15%">&nbsp;</th>
									</tr>
								</thead>
								<tbody></tbody>
								</table>
							</div>
						</section>
						
						<section class="panel panel-default panel-form hide">
							<header class="panel-heading font-bold">Form Payment</header>
							<div class="panel-body">
								<form class="bs-example form-horizontal">
									<input type="hidden" name="id" value="0" />
									
									<div class="form-group">
										<label class="col-lg-2 control-label">Post Title</label>
										<div class="col-lg-10"><input type="text" name="post_title" class="form-control" placeholder="Post Title" disabled="disabled" /></div>
									</div>
									<div class="form-group">
										<label class="col-lg-2 control-label">Email</label>
										<div class="col-lg-10"><input type="text" name="email" class="form-control" placeholder="Email" disabled="disabled" /></div>
									</div>
									<div class="form-group">
										<label class="col-lg-2 control-label">Owner Account</label>
										<div class="col-lg-10"><input type="text" name="sender" class="form-control" placeholder="Owner Account" disabled="disabled" /></div>
									</div>
									<div class="form-group">
										<label class="col-lg-2 control-label">Payment From</label>
										<div class="col-lg-10"><input type="text" name="bank_from" class="form-control" placeholder="Payment From" disabled="disabled" /></div>
									</div>
									<div class="form-group">
										<label class="col-lg-2 control-label">Payment To</label>
										<div class="col-lg-10"><input type="text" name="bank_to" class="form-control" placeholder="Payment To" disabled="disabled" /></div>
									</div>
									<div class="form-group">
										<label class="col-lg-2 control-label">Transfer Amount</label>
										<div class="col-lg-10"><input type="text" name="transfer_count" class="form-control" placeholder="Transfer Amount" disabled="disabled" /></div>
									</div>
									<div class="form-group">
										<label class="col-lg-2 control-label">Transfer Date</label>
										<div class="col-lg-10"><input type="text" name="transfer_date" class="form-control" placeholder="Transfer Date" disabled="disabled" /></div>
									</div>
									<div class="form-group">
										<label class="col-lg-2 control-label">Description</label>
										<div class="col-lg-10"><textarea name="content" class="form-control" placeholder="Description" disabled="disabled"></textarea></div>
									</div>
									<div class="form-group">
										<label class="col-lg-2 control-label">Status</label>
										<div class="col-lg-10"><input type="text" name="status" class="form-control" placeholder="Status" disabled="disabled" /></div>
									</div>
									<div class="form-group">
										<label class="col-lg-2 control-label">Confirmation Time</label>
										<div class="col-lg-10"><input type="text" name="update_time" class="form-control" placeholder="Confirmation Time" disabled="disabled" /></div>
									</div>
									
									<hr />
									<div class="form-group">
										<div class="col-lg-offset-2 col-lg-10">
											<button class="btn btn-sm btn-primary" type="button">Cancel</button>
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
	
	// grid
	var param = {
		id: 'datatable',
		source: web.base + 'panel/post/payment/grid',
		column: [ { }, { }, { }, { }, { }, { bSortable: false, sClass: 'center', sWidth: '15%' } ],
		callback: function() {
			$('#datatable .btn-edit').click(function() {
				var raw_record = $(this).siblings('.hide').text();
				eval('var record = ' + raw_record);
				
				Func.ajax({ url: web.base + 'panel/post/payment/action', param: { action: 'get_by_id', id: record.id }, callback: function(result) {
					Func.populate({ cnt: '.panel-form', record: result });
					page.show_form();
				} });
			});
			
			$('#datatable .btn-approve').click(function() {
				var raw_record = $(this).siblings('.hide').text();
				eval('var record = ' + raw_record);
				
				Func.update({
					link: web.base + 'panel/post/payment/action',
					param: { id: record.id, action: 'update_status', status: 'approve' },
					callback: function() {
						dt.reload();
					}
				});
			});
			
			$('#datatable .btn-reject').click(function() {
				var raw_record = $(this).siblings('.hide').text();
				eval('var record = ' + raw_record);
				
				Func.update({
					link: web.base + 'panel/post/payment/action',
					param: { id: record.id, action: 'update_status', status: 'reject' },
					callback: function() {
						dt.reload();
					}
				});
			});
		
			$('#datatable .btn-delete').click(function() {
				var raw_record = $(this).siblings('.hide').text();
				eval('var record = ' + raw_record);
				
				Func.confirm_delete({
					data: { action: 'delete', id: record.id },
					url: web.base + 'panel/post/payment/action', callback: function() { dt.reload(); }
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
});
</script>

<?php $this->load->view( 'panel/common/footer'); ?>