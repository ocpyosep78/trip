<?php
	$array_category = $this->Category_model->get_array();
?>
<?php $this->load->view( 'panel/common/meta' ); ?>
<body>
<section class="vbox">
	<style>.dataTables_paginate { display: none; }</style>
	<input type="hidden" name="category_id" value="0" />
	<input type="hidden" name="category_sub_id" value="0" />
	
	<div class="modal fade" id="modal-category-price">
		<div class="modal-dialog">
			<div class="modal-content">
				<form data-validate="parsley">
					<input type="hidden" name="action" value="update" />
					<input type="hidden" name="id" value="0" />
					<input type="hidden" name="price_type" value="1" />
					
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Category Price Form</h4>
					</div>
					<div class="modal-body">
						<section class="panel panel-default">
							<div class="panel-body">
								<div class="form-group">
									<label>Price</label>
									<input type="text" class="form-control" name="price" data-required="true" />
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
							<h3 class="m-b-none">Category Price</h3>
						</div>
						
						<section class="panel panel-default panel-table">
							<header class="header bg-white b-b clearfix">
								<div class="row m-t-sm">
									<div class="col-sm-8 m-b-xs">
										<div class="btn-group group-category">
											<button data-toggle="dropdown" class="btn btn-default btn-sm dropdown-toggle">
												<span class="title-replace">Category</span>
												<span class="caret"></span>
											</button>
											<ul class="dropdown-menu">
												<?php foreach ($array_category as $row) { ?>
												<li><a class="cursor select-category" data-row='<?php echo json_encode($row); ?>'><?php echo $row['name']; ?></a></li>
												<?php } ?>
											</ul>
										</div>
										<div class="btn-group group-category-sub">
											<button data-toggle="dropdown" class="btn btn-default btn-sm dropdown-toggle">
												<span class="title-replace">Sub Category</span>
												<span class="caret"></span>
											</button>
											<ul class="dropdown-menu"></ul>
										</div>
										<a class="btn btn-sm btn-default show-dialog" data-price-type="1"><i class="fa fa-plus"></i> Create</a>
									</div>
								</div>
							</header>
							
							<div class="table-responsive">
								<table class="table table-striped m-b-none" id="price-minimum">
								<thead>
									<tr>
										<th width="50%">Price Minimun</th>
										<th width="50%">&nbsp;</th>
									</tr>
								</thead>
								<tbody></tbody>
								</table>
							</div>
						</section>
						
						<section class="panel panel-default panel-table" style="margin-top: 35px;">
							<header class="header bg-white b-b clearfix">
								<div class="row m-t-sm">
									<div class="col-sm-8 m-b-xs">
										<a class="btn btn-sm btn-default show-dialog" data-price-type="2"><i class="fa fa-plus"></i> Create</a>
									</div>
								</div>
							</header>
							
							<div class="table-responsive">
								<table class="table table-striped m-b-none" id="price-maximum">
								<thead>
									<tr>
										<th width="50%">Price Maximum</th>
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
	var param_min = {
		id: 'price-minimum',
		source: web.base + 'panel/setup/category_price/grid',
		column: [ { }, { bSortable: false, sClass: 'center', sWidth: '10%' } ],
		fnServerParams: function (aoData) {
			aoData.push(
				{
					'name': 'category_sub_id',
					'value': $('input[name="category_sub_id"]').val()
				},
				{
					'name': 'price_type',
					'value': 1
				}
			)
		},
		callback: function() {
			$('#price-minimum .btn-edit').click(function() {
				var raw_record = $(this).siblings('.hide').text();
				eval('var record = ' + raw_record);
				
				Func.ajax({ url: web.base + 'panel/setup/category_price/action', param: { action: 'get_by_id', id: record.id }, callback: function(result) {
					$('#modal-category-price [name="id"]').val(result.id);
					$('#modal-category-price [name="price"]').val(result.price);
					$('#modal-category-price [name="price_type"]').val(result.price_type);
					$('#modal-category-price').modal();
				} });
			});
			
			$('#price-minimum .btn-delete').click(function() {
				var raw_record = $(this).siblings('.hide').text();
				eval('var record = ' + raw_record);
				
				Func.confirm_delete({
					data: { action: 'delete', id: record.id },
					url: web.base + 'panel/setup/category_price/action', callback: function() { dt_min.reload(); }
				});
			});
		}
	}
	var dt_min = Func.init_datatable(param_min);
	var param_max = {
		id: 'price-maximum',
		source: web.base + 'panel/setup/category_price/grid',
		column: [ { }, { bSortable: false, sClass: 'center', sWidth: '10%' } ],
		fnServerParams: function (aoData) {
			aoData.push(
				{
					'name': 'category_sub_id',
					'value': $('input[name="category_sub_id"]').val()
				},
				{
					'name': 'price_type',
					'value': 2
				}
			)
		},
		callback: function() {
			$('#price-maximum .btn-edit').click(function() {
				var raw_record = $(this).siblings('.hide').text();
				eval('var record = ' + raw_record);
				
				Func.ajax({ url: web.base + 'panel/setup/category_price/action', param: { action: 'get_by_id', id: record.id }, callback: function(result) {
					$('#modal-category-price [name="id"]').val(result.id);
					$('#modal-category-price [name="price"]').val(result.price);
					$('#modal-category-price [name="price_type"]').val(result.price_type);
					$('#modal-category-price').modal();
				} });
			});
			
			$('#price-maximum .btn-delete').click(function() {
				var raw_record = $(this).siblings('.hide').text();
				eval('var record = ' + raw_record);
				
				Func.confirm_delete({
					data: { action: 'delete', id: record.id },
					url: web.base + 'panel/setup/category_price/action', callback: function() { dt_max.reload(); }
				});
			});
		}
	}
	var dt_max = Func.init_datatable(param_max);
	
	// form
	var form = $('#modal-category-price form').parsley();
	$('#modal-category-price form').submit(function(e) {
		e.preventDefault();
		if (! form.isValid()) {
			return false;
		}
		
		var param = Site.Form.GetValue('modal-category-price form');
		param.category_sub_id = $('[name="category_sub_id"]').val();
		Func.ajax({ url: web.base + 'panel/setup/category_price/action', param: param, callback: function(result) {
			if (result.status == 1) {
				dt_min.reload();
				dt_max.reload();
				$('#modal-category-price').modal('hide');
				$.notify(result.message, "success");
				$('#modal-category-price form')[0].reset();
			} else {
				$.notify(result.message, "error");
			}
		} });
		
		return false;
	});
	
	// helper
	$('.show-dialog').click(function() {
		var price_type = $(this).data('price-type');
		var category_sub_id = $('[name="category_sub_id"]').val();
		
		if (category_sub_id == 0) {
			$.notify('Please select Sub Category', "warning");
			return false;
		}
		
		$('#modal-category-price').modal();
		$('#modal-category-price form')[0].reset();
		$('#modal-category-price [name="id"]').val(0);
		$('#modal-category-price [name="price_type"]').val(price_type);
	});
	Func.combo({
		category_change: function(category) {
			$('input[name="category_id"]').val(category.id);
			$('.group-category .title-replace').text(category.name);
		},
		category_sub_change: function(category_sub) {
			$('input[name="category_sub_id"]').val(category_sub.id);
			$('.group-category-sub .title-replace').text(category_sub.name);
			
			// reload table
			dt_min.reload();
			dt_max.reload();
		}
	});
});
</script>

<?php $this->load->view( 'panel/common/footer'); ?>