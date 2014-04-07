<?php
	$user = $this->user_model->get_session();
	$user = $this->user_model->get_by_id(array( 'user_type_id' => $user['user_type_id'], 'id' => $user['id'] ));
//	$has_request = $this->User_Membership_model->has_request(array( 'user_id' => $user['id'] ));
	$has_request['status'] = false;
?>
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
						
						<?php if ($has_request['status']) { ?>
						<div class="panel-group m-b" id="accordion2">
							<div class="panel panel-default">
								<div class="panel-heading">
									<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
										Membership Request
									</a>
								</div>
								<div id="collapseOne" class="panel-collapse in">
									<div class="panel-body text-sm">
										Detail<br />
										Title : <?php echo $has_request['array']['title']; ?><br />
										Advert Count : <?php echo $has_request['array']['advert_count']; ?><br />
										Advert Time : <?php echo $has_request['array']['advert_time']; ?><br />
										Request Time : <?php echo $has_request['array']['request_time']; ?><br />
										Status : <?php echo $has_request['array']['status']; ?><br /><br />
										
										Please wait until admin confirm your request.
										<div class="pull-right">
											<a class="btn btn-sm btn-info btn-cancel-requuest">Cancel Request</a>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php } else { ?>
						<section class="panel panel-default panel-table">
							<div class="table-responsive">
								<table class="table table-striped m-b-none" data-ride="datatable" id="datatable">
								<thead>
									<tr>
										<th width="30%">Title</th>
										<th width="30%">Advert Count</th>
										<th width="20%">Duration</th>
										<th width="20%">&nbsp;</th>
									</tr>
								</thead>
								<tbody></tbody>
								</table>
							</div>
						</section>
						<?php } ?>
						
					</section>
				</section>
				
				<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
			</section>
		</section>
    </section>
</section>

<script>
$(document).ready(function() {
	if ($('#datatable').length == 1) {
		// grid
		var param = {
			id: 'datatable', aaSorting: [[1, 'ASC']], bPaginate: false,
			source: web.base + 'panel/profile/membership/grid',
			column: [ { }, { }, { }, { bSortable: false, sClass: 'center', sWidth: '10%' } ],
			callback: function() {
				$('#datatable .btn-request').click(function() {
					var raw_record = $(this).siblings('.hide').text();
					eval('var record = ' + raw_record);
					
					Func.update({
						param: { action: 'request', id: record.id },
						link: web.base + 'panel/profile/membership/action',
						callback: function() {
							window.location = window.location.href;
						}
					});
				});
			}
		}
		var dt = Func.init_datatable(param);
	}
	
	if ($('.btn-cancel-requuest').length == 1) {
		$('.btn-cancel-requuest').click(function() {
			Func.update({
				param: { action: 'cancel_request' },
				link: web.base + 'panel/profile/membership/action',
				callback: function() {
					window.location = window.location.href;
				}
			});
		});
	}
});
</script>

<?php $this->load->view( 'panel/common/footer'); ?>