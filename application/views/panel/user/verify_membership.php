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
							<h3 class="m-b-none">Membership</h3>
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
										<th width="15%">Email</th>
										<th width="15%">First Name</th>
										<th width="15%">Last Name</th>
										<th width="15%">Duration</th>
										<th width="15%">Request Time</th>
										<th width="15%">Status</th>
										<th width="10%">&nbsp;</th>
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
		id: 'datatable', aaSorting: [[5, 'desc']],
		source: web.base + 'panel/user/verify_membership/grid',
		column: [ { }, { }, { }, { }, { }, { }, { bSortable: false, sClass: 'center', sWidth: '10%' } ],
		callback: function() {
			$('#datatable .btn-approve').click(function() {
				var raw_record = $(this).siblings('.hide').text();
				eval('var record = ' + raw_record);
				
				Func.update({
					param: { action: 'update', id: record.id, status: 'approve' },
					link: web.base + 'panel/user/verify_membership/action',
					callback: function() {
						dt.reload();
					}
				});
			});
			
			$('#datatable .btn-reject').click(function() {
				var raw_record = $(this).siblings('.hide').text();
				eval('var record = ' + raw_record);
				
				Func.update({
					param: { action: 'update', id: record.id, status: 'reject' },
					link: web.base + 'panel/user/verify_membership/action',
					callback: function() {
						dt.reload();
					}
				});
			});
		}
	}
	var dt = Func.init_datatable(param);
});
</script>

<?php $this->load->view( 'panel/common/footer'); ?>