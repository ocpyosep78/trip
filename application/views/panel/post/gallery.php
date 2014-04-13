<?php
	// user
	$user_session = $this->user_model->get_session();
	$user = $this->user_model->get_by_id(array( 'user_type_id' => $user_session['user_type_id'], 'id' => $user_session['id'] ));
	
	$page['user'] = $user;
	$page['USER_TYPE_TRAVELER'] = USER_TYPE_TRAVELER;
?>

<?php $this->load->view( 'panel/common/meta' ); ?>
<body>
<section class="vbox">
	<div class="hide">
		<div id="cnt-page"><?php echo json_encode($page); ?></div>
	</div>
	
	<div class="modal fade" id="modal-gallery">
		<div class="modal-dialog">
			<div class="modal-content">
				<form class="form-horizontal">
					<input type="hidden" name="action" value="update" />
					<input type="hidden" name="id" value="0" />
					
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Traveler Upload Form</h4>
					</div>
					<div class="modal-body">
						<div class="center" style="margin: 0 0 25px 0;">
							<img class="cnt-thumbnail" src="<?php echo base_url('static/theme/forest/images/logo.png'); ?>"style="width: 25%;"  />
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Post</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="post_title_default" readonly="readonly" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Title</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="title" data-required="true" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Content</label>
							<div class="col-sm-10">
								<textarea class="form-control" name="content" data-required="true"></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Status</label>
							<div class="col-sm-10">
								<select name="post_status" class="form-control" data-required="true">
									<option value="">-</option>
									<option value="pending">pending</option>
									<option value="approve">approve</option>
									<option value="reject">reject</option>
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
							<h3 class="m-b-none">Traveler Upload</h3>
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
										<th width="25%">Post</th>
										<th width="25%">Title</th>
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
	var page = {
		init: function() {
			var raw_page = $('#cnt-page').html();
			eval('var data = ' + raw_page);
			page.data = data;
			
			// user traveler
			if (page.data.user.user_type_id == page.data.USER_TYPE_TRAVELER) {
				$('#modal-gallery .btn-info').hide();
				$('#modal-gallery input, #modal-gallery select, #modal-gallery textarea').attr('disabled', true);
			}
		}
	}
	page.init();
	
	// grid
	var param = {
		id: 'datatable', aaSorting: [[ 2, 'DESC' ]],
		source: window.location.href + '/grid',
		column: [ { }, { }, { }, { }, { bSortable: false, sClass: 'center', sWidth: '15%' } ],
		callback: function() {
			$('#datatable .btn-edit, #datatable .btn-preview').click(function() {
				var raw_record = $(this).siblings('.hide').text();
				eval('var record = ' + raw_record);
				
				Func.ajax({ url: window.location.href + '/action', param: { action: 'get_by_id', id: record.id }, callback: function(result) {
					Func.populate({ cnt: '#modal-gallery', record: result });
					$('#modal-gallery .cnt-thumbnail').attr('src', result.thumbnail_link);
					$('#modal-gallery').modal();
				} });
			});
			
			$('#datatable .btn-approve').click(function() {
				var raw_record = $(this).siblings('.hide').text();
				eval('var record = ' + raw_record);
				
				Func.ajax({ url: window.location.href + '/action', param: { action: 'update_status', id: record.id, post_status: 'approve' }, callback: function(result) {
					dt.reload();
				} });
			});
			
			$('#datatable .btn-reject').click(function() {
				var raw_record = $(this).siblings('.hide').text();
				eval('var record = ' + raw_record);
				
				Func.ajax({ url: window.location.href + '/action', param: { action: 'update_status', id: record.id, post_status: 'reject' }, callback: function(result) {
					dt.reload();
				} });
			});
			
			$('#datatable .btn-delete').click(function() {
				var raw_record = $(this).siblings('.hide').text();
				eval('var record = ' + raw_record);
				
				Func.confirm_delete({
					data: { action: 'delete', id: record.id },
					url: window.location.href + '/action', callback: function() { dt.reload(); }
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
			link: window.location.href + '/action',
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