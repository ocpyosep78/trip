<?php
	/*	start up data */
	$search_link = get_search_link();
	if (!empty($search_link)) {
		$_POST['namelike'] = $search_link;
	}
	/*	end start up data */
	
	/* region form */
	
	$namelike = (isset($_POST['namelike'])) ? $_POST['namelike'] : '';
	$condition = (isset($_POST['condition'])) ? $_POST['condition'] : '';
	$advert_type_id = (isset($_POST['advert_type_id'])) ? $_POST['advert_type_id'] : DEFAULT_ADVERT_TYPE;
	
	$array_sort = $this->Advert_model->get_array_sort();
	$array_limit = $this->Advert_model->get_array_limit();
	$array_condition = $this->Condition_model->get_array();
	$array_advert_type = $this->Advert_Type_model->get_array();
	
	/* end region form */
	
	/* region advert */
	
	$page_sort = (isset($_POST['page_sort'])) ? $_POST['page_sort'] : $array_sort[0]['value'];
	$page_active = (isset($_POST['page_active'])) ? $_POST['page_active'] : 1;
	$page_limit = (isset($_POST['page_limit'])) ? $_POST['page_limit'] : 12;
	$page_offset = ($page_active * $page_limit) - $page_limit;
	
	$param_advert = array(
		'namelike' => $namelike,
		'advert_status_id' => ADVERT_STATUS_APPROVE,
		'condition' => $condition,
		'advert_type_id' => $advert_type_id,
		'category_id' => @$category['id'],
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
	
	// advert list
	$param_advert_view['array_advert'] = $array_advert;
	$param_advert_view['page_active'] = $page_active;
	$param_advert_view['page_total'] = $page_total;
	$param_advert_view['total_item'] = $total_item;
	$param_advert_view['page_offset'] = $page_offset;
	
	// array sub category
	$array_category_sub = $this->Category_Sub_model->get_array(array( 'category_id' => $category['id'] ));
	
	/* region seo */
	
	if (empty($namelike)) {
		// get category sub name
		$string_category_sub = '';
		foreach($array_category_sub as $key => $row) {
			$string_category_sub .= (empty($string_category_sub)) ? $row['name'] : ', '.$row['name'];
			if ($key >= 4) {
				break;
			}
		}
		$string_advert_type = $this->Advert_Type_model->get_string();
		
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
			'title' => $category['name'].' - '.WEBSITE_DOMAIN,
			'array_meta' => array(
				array( 'name' => 'Description', 'content' => 'Market jual beli '.$category['name'].' at '.WEBSITE_DOMAIN ),
				array( 'name' => 'Keywords', 'content' => $string_category_sub.', '.$string_advert_type )
			),
			'array_link' => array(
				array( 'rel' => 'canonical', 'href' => $category['category_link'] ),
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
				array( 'name' => 'Keywords', 'content' => strtolower(WEBSITE_TITLE).', '.strtolower($namelike).', '.strtolower($category['name'])  )
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
					<h1>List Sub Category</h1>
					<div class="category-info clearfix">
						<div class="product-filter clearfix">
							<div class="display">
								<?php foreach ($array_category_sub as $row) { ?>
									<a href="<?php echo $row['category_sub_link']; ?>"><?php echo $row['name']; ?></a>
								<?php } ?>
							</div>
						</div>
					</div>
					<hr/>
					
					<div class="hidden">
						<form id="form-hidden" method="post">
							<input type="hidden" name="namelike" value="<?php echo $namelike; ?>" />
							<input type="hidden" name="condition" value="<?php echo $condition; ?>" />
							<input type="hidden" name="advert_type_id" value="<?php echo $advert_type_id; ?>" />
							
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