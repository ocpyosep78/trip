<?php
	$array_category = $this->Category_model->get_array();
	$array_advert_type = $this->Advert_Type_model->get_array();
?>
<?php $this->load->view( 'panel/common/meta' ); ?>
<body>
<section class="vbox">
	<div class="modal fade" id="modal-advert-type-sub">
		<div class="modal-dialog">
			<div class="modal-content">
				<form data-validate="parsley">
					<input type="hidden" name="action" value="update" />
					<input type="hidden" name="id" value="0" />
					
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Advert Type Form</h4>
					</div>
					<div class="modal-body">
						<section class="panel panel-default">
							<div class="panel-body">
								<div class="form-group">
									<label>Category</label>
									<select name="category_id" class="form-control" data-required="true">
										<?php echo ShowOption(array( 'Array' => $array_category, 'ArrayID' => 'id', 'ArrayTitle' => 'name' )); ?>
									</select>
								</div>
								<div class="form-group">
									<label>Sub Category</label>
									<select name="category_sub_id" class="form-control" data-required="true">
										<option value="">-</option>
									</select>
								</div>
								<div class="form-group">
									<label>Advert Type</label>
									<select name="advert_type_id" class="form-control" data-required="true">
										<?php echo ShowOption(array( 'Array' => $array_advert_type, 'ArrayID' => 'id', 'ArrayTitle' => 'name' )); ?>
									</select>
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
							<h3 class="m-b-none">Advert Type</h3>
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
										<th width="30%">Category</th>
										<th width="30%">Sub Category</th>
										<th width="30%">Advert Type</th>
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
		id: 'datatable',
		source: web.base + 'panel/setup/advert_type_sub/grid',
		column: [ { }, { }, { }, { bSortable: false, sClass: 'center', sWidth: '10%' } ],
		callback: function() {
			$('#datatable .btn-edit').click(function() {
				var raw_record = $(this).siblings('.hide').text();
				eval('var record = ' + raw_record);
				
				Func.ajax({ url: web.base + 'panel/setup/advert_type_sub/action', param: { action: 'get_by_id', id: record.id }, callback: function(result) {
					$('#modal-advert-type-sub [name="id"]').val(result.id);
					$('#modal-advert-type-sub [name="category_id"]').val(result.category_id);
					$('#modal-advert-type-sub [name="advert_type_id"]').val(result.advert_type_id);
					combo.category_sub({ category_id: result.category_id, target: $('#modal-advert-type-sub [name="category_sub_id"]'), value: result.category_sub_id });
					
					$('#modal-advert-type-sub').modal();
				} });
			});
			
			$('#datatable .btn-delete').click(function() {
				var raw_record = $(this).siblings('.hide').text();
				eval('var record = ' + raw_record);
				
				Func.confirm_delete({
					data: { action: 'delete', id: record.id },
					url: web.base + 'panel/setup/advert_type_sub/action', callback: function() { dt.reload(); }
				});
			});
		}
	}
	var dt = Func.init_datatable(param);
	
	// form
	var form = $('#modal-advert-type-sub form').parsley();
	$('#modal-advert-type-sub form').submit(function(e) {
		e.preventDefault();
		if (! form.isValid()) {
			return false;
		}
		
		var param = Site.Form.GetValue('modal-advert-type-sub form');
		Func.ajax({ url: web.base + 'panel/setup/advert_type_sub/action', param: param, callback: function(result) {
			if (result.status == 1) {
				dt.reload();
				$.notify(result.message, "success");
				$('#modal-advert-type-sub').modal('hide');
				$('#modal-advert-type-sub form')[0].reset();
			} else {
				$.notify(result.message, "error");
			}
		} });
		
		return false;
	});
	
	// helper
	$('.show-dialog').click(function() {
		$('#modal-advert-type-sub').modal();
		$('#modal-advert-type-sub form')[0].reset();
		$('#modal-advert-type-sub [name="id"]').val(0);
	});
	$('[name="category_id"]').change(function() {
		combo.category_sub({
			category_id: $(this).val(),
			target: $('#modal-advert-type-sub [name="category_sub_id"]')
		});
	});
});
</script>

<?php $this->load->view( 'panel/common/footer'); ?>