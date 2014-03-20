<?php
	$array_country = $this->country_model->get_array();
?>
<?php $this->load->view( 'panel/common/meta' ); ?>
<body>
<section class="vbox">
	<div class="modal fade" id="modal-city">
		<div class="modal-dialog">
			<div class="modal-content">
				<form data-validate="parsley">
					<input type="hidden" name="action" value="update" />
					<input type="hidden" name="id" value="0" />
					
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">City Form</h4>
					</div>
					<div class="modal-body">
						<section class="panel panel-default">
							<div class="panel-body">
								<div class="form-group">
									<label>Country</label>
									<select name="country_id" class="form-control" data-required="true">
										<?php echo ShowOption(array( 'Array' => $array_country )); ?>
									</select>
								</div>
								<div class="form-group">
									<label>Region</label>
									<select name="region_id" class="form-control" data-required="true">
										<option value="">-</option>
									</select>
								</div>
								<div class="form-group">
									<label>Title</label>
									<input type="text" class="form-control" name="title" data-required="true" />
								</div>
								<div class="form-group">
									<label>Alias</label>
									<input type="text" class="form-control" name="alias" data-required="true" readonly="readonly" />
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
							<h3 class="m-b-none">City</h3>
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
										<th width="20%">Country</th>
										<th width="20%">Region</th>
										<th width="20%">City</th>
										<th width="20%">Alias</th>
										<th width="20%">&nbsp;</th>
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
		source: web.base + 'panel/master/city/grid',
		column: [ { }, { }, { }, { }, { bSortable: false, sClass: 'center', sWidth: '10%' } ],
		callback: function() {
			$('#datatable .btn-edit').click(function() {
				var raw_record = $(this).siblings('.hide').text();
				eval('var record = ' + raw_record);
				
				Func.ajax({ url: web.base + 'panel/master/city/action', param: { action: 'get_by_id', id: record.id }, callback: function(result) {
					Func.populate({ cnt: '#modal-city', record: result });
					combo.region({ country_id: result.country_id, target: $('#modal-city [name="region_id"]'), value: result.region_id });
					$('#modal-city').modal();
				} });
			});
			
			$('#datatable .btn-delete').click(function() {
				var raw_record = $(this).siblings('.hide').text();
				eval('var record = ' + raw_record);
				
				Func.confirm_delete({
					data: { action: 'delete', id: record.id },
					url: web.base + 'panel/master/city/action', callback: function() { dt.reload(); }
				});
			});
		}
	}
	var dt = Func.init_datatable(param);
	
	// form
	var form = $('#modal-city form').parsley();
	$('#modal-city [name="country_id"]').change(function(){
		combo.region({ country_id: $(this).val(), target: $('#modal-city [name="region_id"]') });
	});
	$('#modal-city [name="title"]').keyup(function() {
		var value = Func.GetName($(this).val());
		$('#modal-city [name="alias"]').val(value);
	});
	$('#modal-city form').submit(function(e) {
		e.preventDefault();
		if (! form.isValid()) {
			return false;
		}
		
		Func.update({
			link: web.base + 'panel/master/city/action',
			param: Site.Form.GetValue('modal-city form'),
			callback: function() {
				dt.reload();
				$('#modal-city').modal('hide');
				$('#modal-city form')[0].reset();
			}
		});
	});
	
	// helper
	$('.show-dialog').click(function() {
		$('#modal-city').modal();
		$('#modal-city form')[0].reset();
		$('#modal-city form').parsley().reset();
		$('#modal-city [name="id"]').val(0);
	});
});
</script>

<?php $this->load->view( 'panel/common/footer'); ?>