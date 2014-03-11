<?php
	/*	start up data */
	$search_link = get_search_link();
	if (!empty($search_link)) {
		$_POST['namelike'] = $search_link;
	}
	/*	end start up data */
	
	/* region form */
	
	$namelike = (isset($_POST['namelike'])) ? $_POST['namelike'] : '';
	$city_id = (isset($_POST['city_id'])) ? $_POST['city_id'] : 0;
	$region_id = (isset($_POST['region_id'])) ? $_POST['region_id'] : 0;
	$price_min = (isset($_POST['price_min'])) ? $_POST['price_min'] : 0;
	$price_max = (isset($_POST['price_max'])) ? $_POST['price_max'] : 0;
	$condition = (isset($_POST['condition'])) ? $_POST['condition'] : '';
	$advert_type_id = (isset($_POST['advert_type_id'])) ? $_POST['advert_type_id'] : DEFAULT_ADVERT_TYPE;
	$advert_type_last_id = (isset($_POST['advert_type_last_id'])) ? $_POST['advert_type_last_id'] : 0;
	$category_input_json = (isset($_POST['category_input_json'])) ? $_POST['category_input_json'] : '[]';
	
	$array_region = $this->Region_model->get_array();
	$array_city = $this->City_model->get_array(array( 'region_id' => $region_id ));
	$array_sort = $this->Advert_model->get_array_sort();
	$array_limit = $this->Advert_model->get_array_limit();
	$array_condition = $this->Condition_model->get_array();
	$array_advert_type = $this->Advert_Type_model->get_array();
	$array_price_min = $this->Category_Price_model->get_array(array( 'category_sub_id' => $category_sub['id'], 'price_type' => 1 ));
	$array_price_max = $this->Category_Price_model->get_array(array( 'category_sub_id' => $category_sub['id'], 'price_type' => 2 ));
	
	// advert type sub id & category input
	$advert_type_sub = $array_category_input = array();
	if (!empty($advert_type_id) && !empty($category_sub['id'])) {
		$advert_type_sub = $this->Advert_Type_Sub_model->get_by_id(array( 'advert_type_id' => $advert_type_id, 'category_sub_id' => $category_sub['id'] ));
		
		if (count($advert_type_sub) > 0) {
			$param_category_input = array(
				'is_searchable' => 1,
				'advert_type_sub_id' => $advert_type_sub['id'],
				'sort' => '[{"property":"CategoryInput.order_no","direction":"DESC"}]'
			);
			$array_category_input = $this->Category_Input_model->get_array($param_category_input);
		}
	}
	
	// category input data
	$category_input_search = array();
	if (empty($advert_type_last_id) || $advert_type_id == $advert_type_last_id) {
		$array_temp = object_to_array(json_decode($category_input_json));
		foreach ($array_temp as $input) {
			$category_input_search[$input['name']] = $input['value'];
		}
	}
	
	/* end region form */
	
	/* region advert */
	
	$page_sort = (isset($_POST['page_sort'])) ? $_POST['page_sort'] : $array_sort[0]['value'];
	$page_active = (isset($_POST['page_active'])) ? $_POST['page_active'] : 1;
	$page_limit = (isset($_POST['page_limit'])) ? $_POST['page_limit'] : 12;
	$page_offset = ($page_active * $page_limit) - $page_limit;
	
	$param_advert = array(
		'namelike' => $namelike,
		'advert_status_id' => ADVERT_STATUS_APPROVE,
		'city_id' => $city_id,
		'region_id' => $region_id,
		'condition' => $condition,
		'advert_type_id' => $advert_type_id,
		'price_min' => $price_min,
		'price_max' => $price_max,
		'category_id' => @$category['id'],
		'category_sub_id' => @$category_sub['id'],
		'category_input_search' => $category_input_search,
		'sort' => $page_sort,
		'start' => $page_offset,
		'limit' => $page_limit
	);
	$array_advert = $this->Advert_model->get_array($param_advert);
	$total_item = $this->Advert_model->get_count($param_advert);
	$page_total = ceil($total_item / $page_limit);
	
	/* end region advert */
	
	// build breadcrumb
	$param_breadcrumb['title_list'][] = array( 'link' => base_url(), 'title' => 'Home', 'class' => 'first' );
	$param_breadcrumb['title_list'][] = array( 'link' => $category['category_link'], 'title' => $category['name'] );
	$param_breadcrumb['title_list'][] = array( 'link' => $category_sub['category_sub_link'], 'title' => $category_sub['name'] );
	
	// advert list
	$param_advert_view['array_advert'] = $array_advert;
	$param_advert_view['page_active'] = $page_active;
	$param_advert_view['page_total'] = $page_total;
	$param_advert_view['total_item'] = $total_item;
	$param_advert_view['page_offset'] = $page_offset;
	
	/* region seo */
	
	if (empty($namelike)) {
		// get string image
		$string_image = '';
		$array_check = array();
		foreach ($array_advert as $row) {
			if (! in_array($row['thumbnail_link'], $array_check)) {
				$array_check[] = $row['thumbnail_link'];
				$string_image .= (empty($string_image)) ? $row['thumbnail_link'] : ', '.$row['thumbnail_link'];
			}
		}
		
		// meta
		$param_meta = array(
			'title' => $category_sub['name'].' - '.WEBSITE_DOMAIN,
			'array_meta' => array(
				array( 'name' => 'Description', 'content' => 'Market jual beli '.$category['name'].' - '.$category_sub['name'].' at '.WEBSITE_DOMAIN ),
				array( 'name' => 'Keywords', 'content' => $category['name'].', '.$category_sub['name'] )
			),
			'array_link' => array(
				array( 'rel' => 'canonical', 'href' => $category_sub['category_sub_link'] ),
				array( 'rel' => 'image_src', 'href' => $string_image )
			)
		);
	} else {
		// meta
		$param_meta = array(
			'title' => ucfirst($namelike).' - '.WEBSITE_DOMAIN,
			'array_meta' => array(
				array( 'name' => 'Title', 'content' => WEBSITE_DESC ),
				array( 'name' => 'Description', 'content' => WEBSITE_DESC ),
				array( 'name' => 'Keywords', 'content' => strtolower(WEBSITE_TITLE).', '.strtolower($namelike).', '.strtolower($category['name']).', '.strtolower($category_sub['name']) )
			),
			'array_link' => array(
				array( 'rel' => 'canonical', 'href' => $category['category_link'].'/search/'.strtolower($namelike) ),
				array( 'rel' => 'image_src', 'href' => base_url(WEBSITE_LOGO) )
			)
		);
	}
	
	/* end region seo */
?>
<?php $this->load->view( 'website/common/meta', $param_meta ); ?>
<body id="offcanvas-container" class="offcanvas-container layout-fullwidth fs12 page-product">

<section id="page" class="offcanvas-pusher" role="main">
	<?php $this->load->view('website/common/header'); ?>
	
	<section id="columns" class="offcanvas-siderbars">
		<?php $this->load->view( 'website/common/breadcrumb', $param_breadcrumb ); ?>
		
		<div class="container"><div class="row">
			<section class="col-lg-9 col-md-9 col-sm-12 col-xs-12 main-column">
				<div id="content">
					<h1>Refine Search</h1>
					<div class="category-info clearfix">
						<div class="product-filter clearfix">
							<div class="display" style="padding-top: 0px;">
								<div class="limit">
									<select name="city_id" class="form_submit">
										<?php echo ShowOption(array( 'Array' => $array_city, 'ArrayID' => 'id', 'ArrayTitle' => 'name', 'LabelEmptySelect' => 'All City', 'Selected' => $city_id )); ?>
									</select>
								</div>
								<div class="limit">
									<select name="region_id" class="form_change">
										<?php echo ShowOption(array( 'Array' => $array_region, 'ArrayID' => 'id', 'ArrayTitle' => 'name', 'LabelEmptySelect' => 'All Region', 'Selected' => $region_id )); ?>
									</select>
								</div>
							</div>
							<div class="sort">
								<select>
									<option>Max sq.ft</option>
								</select>	
							</div>
							<div class="sort">
								<select>
									<option>Mix sq.ft</option>
								</select>
							</div>
							<div class="sort">
								<select name="price_max" class="form_submit">
									<?php echo ShowOption(array( 'Array' => $array_price_max, 'ArrayID' => 'price', 'ArrayTitle' => 'price_text', 'LabelEmptySelect' => 'Price To', 'Selected' => $price_max )); ?>
								</select>
							</div>
							<div class="limit">
								<select name="price_min" class="form_submit">
									<?php echo ShowOption(array( 'Array' => $array_price_min, 'ArrayID' => 'price', 'ArrayTitle' => 'price_text', 'LabelEmptySelect' => 'Price From', 'Selected' => $price_min )); ?>
								</select>
							</div>
						</div>
					</div>
					<hr/>
					
					<div class="hidden">
						<form id="form-hidden" method="post">
							<input type="hidden" name="namelike" value="<?php echo $namelike; ?>" />
							<input type="hidden" name="city_id" value="<?php echo $city_id; ?>" />
							<input type="hidden" name="region_id" value="<?php echo $region_id; ?>" />
							<input type="hidden" name="price_min" value="<?php echo $price_min; ?>" />
							<input type="hidden" name="price_max" value="<?php echo $price_max; ?>" />
							<input type="hidden" name="condition" value="<?php echo $condition; ?>" />
							<input type="hidden" name="advert_type_id" value="<?php echo $advert_type_id; ?>" />
							<input type="hidden" name="advert_type_last_id" value="<?php echo $advert_type_id; ?>" />
							<input type="hidden" name="category_input_json" value="<?php echo htmlentities($category_input_json); ?>" />
							
							<input type="hidden" name="page_sort" value="<?php echo htmlentities($page_sort); ?>" />
							<input type="hidden" name="page_active" value="<?php echo 1; ?>" />
							<input type="hidden" name="page_limit" value="<?php echo $page_limit; ?>" />
						</form>
					</div>
					
					<div class="product-filter clearfix">
						<div class="display">
							<span style="float: left;">Display:</span>
							<a class="list" onclick="display_item('list');">List</a>
							<a class="grid active" onclick="display_item('grid');">Grid</a>
						</div>
						<div class="limit">
							<span>Show:</span>
							<select class="change_limit">
								<?php echo ShowOption(array( 'Array' => $array_limit, 'ArrayID' => 'value', 'ArrayTitle' => 'value', 'Selected' => $page_limit, 'WithEmptySelect' => false )); ?>
							</select>
						</div>
						<div class="sort">
							<span>Sort By:</span>
							<select class="change_sort">
								<?php echo ShowOption(array( 'Array' => $array_sort, 'ArrayID' => 'value', 'ArrayTitle' => 'label', 'Selected' => $page_sort, 'WithEmptySelect' => false )); ?>
							</select>
						</div>
						<div class="limit">
							<span>Show:</span>
							<select name="advert_type_id" class="form_submit">
								<?php echo ShowOption(array( 'Array' => $array_advert_type, 'ArrayID' => 'id', 'ArrayTitle' => 'name', 'LabelEmptySelect' => 'All', 'Selected' => $advert_type_id )); ?>
							</select>
						</div>
						<div class="limit">
							<span>Condition:</span>
							<select name="condition" class="form_submit">
								<?php echo ShowOption(array( 'Array' => $array_condition, 'ArrayID' => 'name', 'ArrayTitle' => 'name', 'LabelEmptySelect' => 'All', 'Selected' => $condition )); ?>
							</select>
						</div>
						<div style="clear: both;"></div>
						<?php foreach ($array_category_input as $key => $row) { ?>
							<?php echo search_category_input($row, $category_input_search); ?>
						<?php } ?>
					</div>
					
					<?php $this->load->view( 'website/common/advert_list', $param_advert_view ); ?>
				</div>
			</section>
		</div></div>
	</section>
	
	<?php $this->load->view('website/common/footer'); ?>
</section>

<?php $this->load->view('website/common/menu_canvas'); ?>

<script type="text/javascript">
	// form
	$('.category-info [name="region_id"]').change(function() {
		combo.city({
			region_id: $(this).val(),
			target: $('.category-info [name="city_id"]'),
			label_empty_select: 'All City'
		});
	});
	$('.product-filter [name="vehicle_brand_id"]').change(function() {
		combo.vehicle_type({
			vehicle_brand_id: $(this).val(),
			target: $('.product-filter [name="vehicle_type_id"]'),
			label_empty_select: 'All Type'
		});
	});
	$('.form_change').change(function() {
		var name = $(this).attr('name');
		var value = $(this).val();
		$('#form-hidden [name="' + name + '"]').val(value);
		
		if (name == 'region_id') {
			$('#form-hidden [name="city_id"]').val(0);
		}
	});
	$('.form_submit').change(function() {
		// set common search
		var name = $(this).attr('name');
		var value = $(this).val();
		$('#form-hidden [name="' + name + '"]').val(value);
		
		// set category input search
		var array_category_input = [];
		for (var i = 0; i < $('.category-input-search').length; i++) {
			var temp_object = {
				value: $('.category-input-search').eq(i).find('.input').val(),
				name: $('.category-input-search').eq(i).find('.input').attr('name')
			}
			array_category_input.push(temp_object);
		}
		var category_input_json = Func.ArrayToJson(array_category_input);
		$('#form-hidden [name="category_input_json"]').val(category_input_json);
		
		// submit form
		$('#form-hidden').submit();
	});
	
	// search
	$('.change_sort').change(function() {
		$('#form-hidden [name="page_sort"]').val($(this).val());
		$('#form-hidden').submit();
	});
	$('.change_limit').change(function() {
		$('#form-hidden [name="page_limit"]').val($(this).val());
		$('#form-hidden').submit();
	});
	$('.pagination .links a').click(function() {
		$('#form-hidden [name="page_active"]').val($(this).data('page-value'));
		$('#form-hidden').submit();
	});
	
	// display
	var view_type = get_local('view_type');
	display_item(view_type);
</script>

</body></html>