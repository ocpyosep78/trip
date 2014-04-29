<?php
	// get category
	$category_alias = (isset($this->uri->segments[1])) ? $this->uri->segments[1] : '';
	$category = $this->category_model->get_by_id(array( 'alias' => $category_alias ));
	if (count($category) == 0) {
		echo 'category not found.';
		exit;
	}
	
	// get selected category sub, region & city
	$category_sub = $region = $city = array();
	$array_region = $array_city = array();
	$selected_category_sub = (empty($this->uri->segments[2])) ? '' : $this->uri->segments[2];
	$selected_region = (empty($this->uri->segments[2])) ? '' : $this->uri->segments[2];
	$selected_city = (empty($this->uri->segments[3])) ? '' : $this->uri->segments[3];
	if (!empty($selected_category_sub)) {
		$category_sub = $this->category_sub_model->get_by_id(array( 'alias' => $selected_category_sub ));
	}
	if (!empty($selected_region)) {
		$region = $this->region_model->get_by_id(array( 'alias' => $selected_region ));
	}
	if (!empty($selected_city)) {
		$city = $this->city_model->get_by_id(array( 'alias' => $selected_city, 'region_id' => $region['id'] ));
	}
	
	// get array region & city
	if (count($region) > 0) {
		$array_region = $this->region_model->get_array(array( 'country_id' => $region['country_id'], 'limit' => 1000 ));
	}
	if (count($city) > 0) {
		$array_city = $this->city_model->get_array(array( 'region_id' => $city['region_id'], 'limit' => 1000 ));
	}
	
	// master
	$array_country = $this->country_model->get_array();
	$array_category_sub = $this->category_sub_model->get_array(array( 'category_id' => $category['id'] ));
	
	// post count
	$destination_count = $this->post_model->get_count(array( 'query' => true, 'category_id' => $category['id'] ));
	
	// post facility
	$param_facility['searchable'] = 1;
	$param_facility['category_id'] = $category['id'];
	$array_facility = $this->category_facility_model->get_array($param_facility);
	
	// category tag
	$array_tag = $this->category_tag_model->get_array(array( 'category_id' => $category['id'] ));
	
	// breadcrub
	$array_breadcrub = array(
		array( 'link' => $category['link_category'], 'title' => $category['title'] )
	);
	if (count($category_sub) > 0) {
		$array_breadcrub[] = array( 'link' => $category_sub['link_category_sub'], 'title' => $category_sub['title'] );
	}
	if (count($region) > 0) {
		$array_breadcrub[] = array( 'link' => $category['link_category'].'/'.$region['alias'], 'title' => $region['title'] );
	}
	if (count($city) > 0) {
		$array_breadcrub[] = array( 'link' => $category['link_category'].'/'.$region['alias'].'/'.$city['alias'], 'title' => $city['title'] );
	}
	
	// array post
	$param_post = array(
		'post_status' => 'approve',
		'category_id' => $category['id'],
		'sort' => '[{"property":"having_promo","direction":"DESC"}]',
		'limit' => 5
	);
	if (count($category_sub) > 0) {
		$param_post['category_sub_id'] = $category_sub['id'];
	}
	if (count($region) > 0) {
		$param_post['region_id'] = $region['id'];
	}
	if (count($city) > 0) {
		$param_post['city_id'] = $city['id'];
	}
	$array_post = $this->post_model->get_array($param_post);
	
	// prepare meta
	$keyword = $canonical = $image_post = '';
	$array_image = array();
	$title = WEBSITE_TITLE.' - '.$category['title'];
	$description = get_length_char($category['content'], 150, '');
	$canonical = $category['link_category'];
	if (count($region) > 0) {
		$title .= ' - '.$region['title'];
		$canonical .= '/'.$region['alias'];
		$description = $region['content'];
	}
	if (count($city) > 0) {
		$title .= ' - '.$city['title'];
		$canonical .= '/'.$city['alias'];
		$description = $city['content'];
	}
	foreach($array_category_sub as $key => $row) {
		$keyword .= (empty($keyword)) ? $row['title'] : ', '.$row['title'];
	}
	foreach($array_tag as $key => $row) {
		$keyword .= (empty($keyword)) ? $row['tag_title'] : ', '.$row['tag_title'];
	}
	foreach($array_post as $key => $row) {
		$image_post .= (empty($image_post)) ? $row['link_thumbnail_small'] : ', '.$row['link_thumbnail_small'];
	}
	
	// meta
	$array_seo = array(
		'title' => $title,
		'array_meta' => array( ),
		'array_link' => array( )
	);
	$array_seo['array_meta'][] = array( 'name' => 'Description', 'content' => $description );
	$array_seo['array_meta'][] = array( 'name' => 'Keywords', 'content' => $keyword );
	$array_seo['array_link'][] = array( 'rel' => 'canonical', 'href' => $canonical );
	$array_seo['array_link'][] = array( 'rel' => 'image_src', 'href' => $image_post );
	$array_seo['array_link'][] = array( 'rel' => 'citation_authors', 'content' => WEBSITE_OWNER_POST );
	
	// page
	$page['city'] = $city;
	$page['region'] = $region;
?>
<?php $this->load->view( 'website/common/meta', $array_seo ); ?>
<body id="top" class="thebg" >
	<?php $this->load->view( 'website/common/header_menu' ); ?>
	<?php $this->load->view( 'website/common/breadcrub', array( 'array' => $array_breadcrub ) ); ?>
	<div class="hide">
		<div id="cnt-page"><?php echo json_encode($page); ?></div>
	</div>
	
	<div class="container"><div class="container pagecontainer offset-0" id="post-list">
		<div class="col-md-3 filters offset-0">
			<input type="hidden" name="action" value="get_post_view" />
			<input type="hidden" name="category_id" value="<?php echo $category['id']; ?>" />
			<input type="hidden" name="page_active" value="1" />
			<input type="hidden" name="reload" value="0" />
			
			<div class="filtertip">
				<div class="padding20">
					<p class="size13"><span class="size18 bold destination-count"><?php echo $destination_count; ?></span> <?php echo $category['title']; ?></p>
					<p class="size13">Narrow results or <a>view all</a></p>
				</div>
				<div class="tip-arrow"></div>
			</div>
			
			<div class="padding20title"><h3 class="opensans dark">Type</h3></div>
			<div class="line2"></div>
			<div class="hpadding20">
				<div class="radio">
					<label><input type="radio" name="category_sub_id" value="0" checked /> All</label>
				</div>
				<?php foreach($array_category_sub as $row) { ?>
				<?php $checked = (@$category_sub['id'] == $row['id']) ? 'checked' : ''; ?>
				<div class="radio">
					<label><input type="radio" name="category_sub_id" value="<?php echo $row['id']; ?>" <?php echo $checked; ?> /> <?php echo $row['title']; ?></label>
				</div>
				<?php } ?>
			</div>
			
			<div class="padding20title"><h3 class="opensans dark">Area</h3></div>
			<div class="line2"></div><br />
			<div class="hpadding20">
				<select name="country_id" class="form-control mySelectBoxClass">
					<?php echo ShowOption(array( 'Array' => $array_country, 'LabelEmptySelect' => 'All Country', 'Selected' => @$region['country_id'] )); ?>
				</select>
			</div>
			<div class="clearfix"></div><br />
			<div class="hpadding20">
				<select name="region_id" class="form-control mySelectBoxClass">
					<?php echo ShowOption(array( 'Array' => $array_region, 'LabelEmptySelect' => 'All Region', 'Selected' => @$region['id'] )); ?>
				</select>
			</div>
			<div class="clearfix"></div><br />
			<div class="hpadding20">
				<select name="city_id" class="form-control mySelectBoxClass">
					<?php echo ShowOption(array( 'Array' => $array_city, 'LabelEmptySelect' => 'All City', 'Selected' => @$city['id'] )); ?>
				</select>
			</div>
			
			<div class="hide">
				<button type="button" class="collapsebtn" data-toggle="collapse" data-target="#collapse2">
					Price range
					<span class="collapsearrow"></span>
				</button>
				<div id="collapse2" class="collapse in">
					<div class="padding20">
						<div class="layout-slider wh100percent">
							<span class="cstyle09"><input id="bar-slider" type="slider" name="price" value="0;2000" /></span>
						</div>
						<script type="text/javascript">
							$("#bar-slider").slider({
								from: 0, to: 2000, step: 5, smooth: true, round: 0, dimension: "&nbsp;$", skin: "round",
								callback: function(value) {
									$('#post-list [name="reload"]').val(1);
								}
							});
						</script>
					</div>
				</div>
				<div class="line2"></div>
			</div>
			
			<button type="button" class="collapsebtn last" data-toggle="collapse" data-target="#collapse4">
				Fasilities
				<span class="collapsearrow"></span>
			</button>	
			<div id="collapse4" class="collapse in">
				<div class="hpadding20">
					<?php foreach ($array_facility as $row) { ?>
					<div class="checkbox">
						<label><input type="checkbox" name="facility_id[]" value="<?php echo $row['facility_id']; ?>" /> <?php echo $row['facility_title_select']; ?></label>
					</div>
					<?php } ?>
				</div>
			</div>	
			<div class="line2"></div>
			<div class="clearfix"></div>
			
			<div class="padding20title"><h3 class="opensans dark">Tags</h3></div>
			<div class="line2"></div><br />
			<div class="hpadding20"> 
				<?php foreach ($array_tag as $key => $row) { ?>
				<?php if (!empty($key)) { ?>
				<div class="clearfix"></div>
				<?php } ?>
				<label><a href="<?php echo $row['tag_link']; ?>"><?php echo $row['tag_title']; ?></a></label>
				<?php } ?>
			</div>
			<div class="clearfix"></div><br /><br /><br />
		</div>
		
		<div class="rightcontent col-md-9 offset-0">
			<div class="hpadding20"><div class="topsortby">
				<div class="col-md-4 offset-0">
					<div class="left mt7"><b>Sort by:</b></div>
					<div class="right wh70percent">
						<select class="form-control mySelectBoxClass" name="page_order">			  
							<option value="promo">Promo</option>
							<option value="title_asc">A to Z</option>
							<option value="title_desc">Z to A</option>
							<option value="review">Top Review</option>
						</select>
					</div>
				</div>	
				<div class="col-md-4">
					<div class="left mt7"><b>Show:</b></div>
					<div class="right wh70percent">
						<select class="form-control mySelectBoxClass" name="page_item">
							<option value="20">20</option>
							<option value="20">30</option>
							<option value="40">40</option>
							<option value="50">50</option>
						</select>
					</div>
				</div>
			</div></div><br /><br />
			<div class="clearfix"></div>
			<div class="cnt-post">&nbsp;</div>
		</div>
	</div></div>
	
	<?php $this->load->view( 'website/common/footer' ); ?>
	<?php $this->load->view( 'website/common/library', array( 'js_add' => array( 'js-list3.js' ) ) ); ?>
	
<script>
jQuery(function($) {
	var page = {
		init: function() {
			var raw_page = $('#cnt-page').html();
			eval('var data = ' + raw_page);
			page.data = data;
			
			// set city & region
			if (page.data.region.id != null) {
				combo.region({ country_id: page.data.region.country_id, target: $('[name="region_id"]'), value: page.data.region.id });
			}
			if (page.data.city.id != null) {
				combo.city({ region_id: page.data.city.region_id, target: $('[name="city_id"]'), value: page.data.city.id });
			}
			
			page.load_post({});
			page.is_refresh();
		},
		load_post: function(p) {
			Func.ajax({
				is_json: 0,
				url: web.base + 'destination/view',
				param: Site.Form.GetValue('post-list'),
				callback: function(content) {
					$('.cnt-post').html(content);
					
					// paging
					$('#post-list .pagination a').click(function() {
						$('#post-list [name="page_active"]').val($(this).data('page_active'));
						page.load_post();
					});
				}
			});
		},
		is_refresh: function() {
			setTimeout(function() {
				page.is_refresh();
				
				// check reload post
				if ($('#post-list [name="reload"]').val() == 1) {
					page.load_post({});
					$('#post-list [name="reload"]').val(0)
				}
			}, 1000);
		}
	}
	
	// count number
	$('.destination-count').countTo({ from: 1, to: parseInt($('.destination-count').text(), 10), speed: 2000, refreshInterval: 50 });
	
	// filter
	$('[name="category_sub_id"]').change(function() {
		$('[name="page_active"]').val(1);
		page.load_post();
	});
	$('[name="country_id"]').change(function() {
		combo.region({ country_id: $(this).val(), target: $('[name="region_id"]'), label_empty_select: 'All Region', callback: function() {
			$('[name="region_id"]').change();
			$('[name="city_id"]').html('<option value="">All City</option>');
			$('[name="city_id"]').change();
			
			$('[name="page_active"]').val(1);
			page.load_post();
		} });
	});
	$('[name="region_id"]').change(function() {
		combo.city({ region_id: $(this).val(), target: $('[name="city_id"]'), label_empty_select: 'All City', callback: function() {
			$('[name="page_active"]').val(1);
			page.load_post();
		} });
	});
	$('[name="city_id"]').change(function() {
		$('[name="page_active"]').val(1);
		page.load_post();
	});
	$('[name="facility_id[]"]').change(function() {
		$('[name="page_active"]').val(1);
		page.load_post();
	});
	
	// order / limit
	$('#post-list [name="page_order"]').change(function() {
		page.load_post();
	});
	$('#post-list [name="page_item"]').change(function() {
		page.load_post();
	});
	
	// init page
	page.init();
});
</script>

</body>
</html>