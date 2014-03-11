<?php
	$array_category = $this->Category_model->get_array();
	$array_input_type = $this->Input_Type_model->get_array();
?>
<?php $this->load->view( 'panel/common/meta' ); ?>
<body>
<section class="vbox">
	<input type="hidden" name="category_id" value="0" />
	<input type="hidden" name="category_sub_id" value="0" />
	<input type="hidden" name="advert_type_sub_id" value="0" />
	
	<div class="modal fade" id="modal-category-input">
		<div class="modal-dialog">
			<div class="modal-content">
				<form data-validate="parsley">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Category Price Form</h4>
					</div>
					<div class="modal-body">
						<section><div class="select"></div></section>
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
							<h3 class="m-b-none">Category Input</h3>
						</div>
						
						<section class="panel panel-default panel-table tree-list-view">
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
										<div class="btn-group group-advert-type-sub">
											<button data-toggle="dropdown" class="btn btn-default btn-sm dropdown-toggle">
												<span class="title-replace">Advert Type</span>
												<span class="caret"></span>
											</button>
											<ul class="dropdown-menu"></ul>
										</div>
										<a class="btn btn-sm btn-default show-form" data-price-type="1"><i class="fa fa-plus"></i> Create</a>
									</div>
								</div>
							</header>
						</section>
						
						<section class="panel panel-default panel-table tree-list-view">
							<div class="table-responsive cnt-tree" style="padding: 10px;"></div>
						</section>
						
						<section class="panel panel-default tree-form-view hide">
							<header class="panel-heading font-bold">Category Input Form</header>
							<div class="panel-body">
								<form class="bs-example form-horizontal" data-validate="parsley">
									<input type="hidden" name="id" value="0" />
									<input type="hidden" name="parent_id" value="0" />
									<input type="hidden" name="action" value="update" />
									
									<div class="form-group">
										<label class="col-lg-2 control-label">Parent</label>
										<div class="col-lg-7">
											<input type="text" name="parent_title" class="form-control" placeholder="Parent" readonly="readonly" />
										</div>
										<div class="col-lg-3">
											<button type="button" class="btn btn-default parent-clear">Clear</button>
											<button type="button" class="btn btn-default modal-tree">Select Parent</button>
										</div>
									</div>
									<div class="form-group">
										<label class="col-lg-2 control-label">Input Type</label>
										<div class="col-lg-10">
											<select name="input_type_id" class="form-control" data-required="true">
												<?php echo ShowOption(array( 'Array' => $array_input_type, 'ArrayID' => 'id', 'ArrayTitle' => 'name' )); ?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-lg-2 control-label">Title</label>
										<div class="col-lg-10">
											<input type="text" name="title" class="form-control" placeholder="Title" data-required="true" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-lg-2 control-label">Label</label>
										<div class="col-lg-10">
											<input type="text" name="label" class="form-control" placeholder="Label" data-required="true" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-lg-2 control-label">Order No</label>
										<div class="col-lg-10">
											<input type="text" name="order_no" class="form-control" placeholder="Order No" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-lg-2 control-label">Max Length</label>
										<div class="col-lg-10">
											<input type="text" name="max_length" class="form-control" placeholder="Max Length" />
										</div>
									</div>
									<div class="form-group">
										<div class="col-lg-offset-2 col-lg-10">
											<div class="checkbox">
												<label><input type="checkbox" name="is_required" value="1" /> Required</label>
											</div>
										</div>
									</div>
									<div class="form-group cnt-searchable">
										<div class="col-lg-offset-2 col-lg-10">
											<div class="checkbox">
												<label><input type="checkbox" name="is_searchable" value="1" /> Searchable</label>
											</div>
										</div>
									</div>
									<div class="form-group cnt-numeric">
										<div class="col-lg-offset-2 col-lg-10">
											<div class="checkbox">
												<label><input type="checkbox" name="is_numeric" value="1" /> Numeric</label>
											</div>
										</div>
									</div>
									<div class="form-group cnt-letter">
										<div class="col-lg-offset-2 col-lg-10">
											<div class="checkbox">
												<label><input type="checkbox" name="is_letter" value="1" /> Letter</label>
											</div>
										</div>
									</div>
									<div class="form-group cnt-uppercase">
										<div class="col-lg-offset-2 col-lg-10">
											<div class="checkbox">
												<label><input type="checkbox" name="no_uppercase" value="1" /> Uppercase</label>
											</div>
										</div>
									</div>
									<div class="form-group cnt-special-char">
										<div class="col-lg-offset-2 col-lg-10">
											<div class="checkbox">
												<label><input type="checkbox" name="no_special_char" value="1" /> No Special Character</label>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-lg-2 control-label">Value</label>
										<div class="col-lg-10">
											<input type="text" name="value" class="form-control" placeholder="Please use coma sign for separate value at select box" />
										</div>
									</div>
									<div class="form-group">
										<div class="col-lg-offset-2 col-lg-10">
											<button type="submit" class="btn btn-sm btn-info">Save</button>
											<button type="button" class="btn btn-sm btn-danger">Delete</button>
											<button type="button" class="btn btn-sm btn-default show-tree">Cancel</button>
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
		show_tree: function() {
			$('.tree-list-view').show();
			$('.tree-form-view').hide();
		},
		show_form: function() {
			$('.tree-list-view').hide();
			$('.tree-form-view').show();
		},
		tree: {
			load: function() {
				Func.ajax({
					is_json: 0,
					url: web.base + 'panel/setup/category_input/view',
					param: {
						view_name: 'form_tree',
						advert_type_sub_id: $('input[name="advert_type_sub_id"]').val()
					},
					callback: function(result) {
						// set tree
						$('.cnt-tree').html(result);
						Func.init_tree({ cnt: '.cnt-tree' });
						
						// editable
						$('.cnt-tree .tree-edit').click(function() {
							var row = $(this).data('row');
							Func.ajax({ url: web.base + 'panel/setup/category_input/action', param: { action: 'get_by_id', id: row.id }, callback: function(result) {
								Func.populate({ cnt: '.tree-form-view form', record: result });
								page.input_type();
								
								page.show_form();
							} });
						});
					}
				});
			}
		},
		input_type: function() {
			var value = $('.tree-form-view form [name="input_type_id"]').val();
			
			if (value == 1) {
				$('.cnt-numeric').show();
				$('.cnt-letter').show();
				$('.cnt-uppercase').show();
				$('.cnt-searchable').hide();
				$('.cnt-special-char').show();
			} else if (value == 2) {
				$('.cnt-searchable').show();
			} else {
				$('.cnt-numeric').hide();
				$('.cnt-letter').hide();
				$('.cnt-uppercase').hide();
				$('.cnt-searchable').hide();
				$('.cnt-special-char').hide();
			}
		}
	}
	
	// form
	var form = $('.tree-form-view form').parsley();
	$('.tree-form-view form').submit(function(e) {
		e.preventDefault();
		if (! form.isValid()) {
			return false;
		}
		
		var param = Site.Form.GetValue('.tree-form-view form');
		param.advert_type_sub_id = $('input[name="advert_type_sub_id"]').val();
		Func.update({
			param: param,
			link: web.base + 'panel/setup/category_input/action',
			callback: function() {
				page.tree.load();
				page.show_tree();
			}
		});
	});
	$('.tree-form-view form .btn-danger').click(function() {
		var record = Site.Form.GetValue('.tree-form-view form');
		Func.confirm_delete({
			data: { action: 'delete', id: record.id },
			url: web.base + 'panel/setup/category_input/action', callback: function() {
				page.show_tree();
				page.tree.load();
			}
		});
	});
	$('.tree-form-view form [name="input_type_id"]').change(function() {
		page.input_type();
	});
	
	// helper
	$('.show-form').click(function() {
		var advert_type_sub_id = $('[name="advert_type_sub_id"]').val();
		if (advert_type_sub_id == 0) {
			$.notify('Please select Advert Type', "warning");
			return false;
		}
		
		$('.tree-form-view form')[0].reset();
		$('.tree-form-view [name="id"]').val(0);
		
		page.show_form();
		page.input_type();
	});
	$('.show-tree').click(function() {
		page.show_tree();
	});
	$('.parent-clear').click(function() {
		$('.tree-form-view [name="parent_id"]').val(0);
		$('.tree-form-view [name="parent_title"]').val('');
	});
	$('.modal-tree').click(function() {
		Func.ajax({
			is_json: 0,
			url: web.base + 'panel/setup/category_input/view',
			param: {
				view_name: 'form_tree',
				advert_type_sub_id: $('input[name="advert_type_sub_id"]').val()
			},
			callback: function(result) {
				// set tree
				$('#modal-category-input .select').html(result);
				Func.init_tree({ cnt: '#modal-category-input .select' });
				$('#modal-category-input').modal();
				
				// event
				$('#modal-category-input .tree-option').click(function() {
					var row = $(this).data('row');
					$('.tree-form-view form [name="parent_id"]').val(row.id);
					$('.tree-form-view form [name="parent_title"]').val(row.title);
					$('#modal-category-input').modal('hide');
				});
			}
		});
		
		
		
	});
	Func.combo({
		category_change: function(category) {
			$('input[name="category_id"]').val(category.id);
			$('.group-category .title-replace').text(category.name);
		},
		category_sub_change: function(category_sub) {
			$('input[name="category_sub_id"]').val(category_sub.id);
			$('.group-category-sub .title-replace').text(category_sub.name);
		},
		advert_type_sub_change: function(advert_type_sub) {
			$('input[name="advert_type_sub_id"]').val(advert_type_sub.id);
			$('.group-advert-type-sub .title-replace').text(advert_type_sub.advert_type_name);
			page.tree.load();
		}
	});
});
</script>

<?php $this->load->view( 'panel/common/footer'); ?>