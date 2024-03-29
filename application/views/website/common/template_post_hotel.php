<?php
	// page info
	$page_item = (isset($_POST['page_item'])) ? $_POST['page_item'] : 9;
	$page_active = (isset($_POST['page_active'])) ? $_POST['page_active'] : 1;
	$param_post = array(
		'post_status' => 'approve',
		'start' => ($page_active - 1) * $page_item,
		'limit' => $page_item
	);
	
	// additional filter
	if (!empty($_POST['category_id'])) {
		$param_post['category_id'] = $_POST['category_id'];
	}
	if (!empty($_POST['category_sub_id'])) {
		$param_post['category_sub_id'] = $_POST['category_sub_id'];
	}
	if (!empty($_POST['country_id'])) {
		$param_post['country_id'] = $_POST['country_id'];
	}
	if (!empty($_POST['region_id'])) {
		$param_post['region_id'] = $_POST['region_id'];
	}
	if (!empty($_POST['city_id'])) {
		$param_post['city_id'] = $_POST['city_id'];
	}
	if (!empty($_POST['star'])) {
		$param_post['star'] = $_POST['star'];
	}
	if (!empty($_POST['price'])) {
		$temp = explode(';', $_POST['price']);
		$param_post['price_min'] = $temp[0];
		$param_post['price_max'] = $temp[1];
	}
	if (!empty($_POST['facility_id'])) {
		$array_facility = object_to_array(json_decode($_POST['facility_id']));
		$param_post['array_facility'] = $array_facility;
	}
	
	// page order
	$array_page_order = array(
		'promo' => '[{"property":"having_promo","direction":"DESC"}]',
		'title_asc' => '[{"property":"title","direction":"ASC"}]',
		'title_desc' => '[{"property":"title","direction":"DESC"}]',
		'review' => '[{"property":"review_count","direction":"DESC"}]'
	);
	$page_order = (isset($_POST['page_order'])) ? $_POST['page_order'] : 'promo';
	$param_post['sort'] = (isset($array_page_order[$page_order])) ? $array_page_order[$page_order] : $array_page_order['promo'];
	
	// array post
	$array_post = $this->post_model->get_array($param_post);
	
	// paging count
	$page_count = ceil($this->post_model->get_count() / $page_item);
?>


 


<div class="itemscontainer offset-1">
	<?php foreach ($array_post as $key => $row) { ?>
	<div class="col-md-4">
	<div class="col-md-4-hover">
	 
		<div class="listitem"><?php echo (empty($row['having_promo'])) ? '' : '<div class="featured_tag"></div>'; ?>
		 
			<a href="<?php echo $row['link_post']; ?>" alt="<?php echo $row['title_select']; ?>" title="<?php echo $row['title_select']; ?>"><img src="<?php echo $row['link_thumbnail_small']; ?>" /></a>
		</div> 
		<div class="itemlabel2">
			<div class="labelright">
			    <!--
				<?php if (!empty($row['link_star'])) { ?>
					<img src="<?php echo $row['link_star']; ?>" width="60" />
				<?php } ?> 
				-->
				
				 
			<center>	<span class="size11 grey"></span> </center><br /><br /> 
				
			
				
				<a class="bookbtn mt1" alt="<?php echo $row['title_select']; ?>" title="<?php echo $row['title_select']; ?>" href="<?php echo $row['link_post']; ?>">View</a>
			</div>
			<div class="labelleft">
				<div class="title"><a href="<?php echo $row['link_post']; ?>" alt="<?php echo $row['title_select']; ?>" title="<?php echo $row['title_select']; ?>"><b><?php echo $row['title_select']; ?></b></a></div>
			 

				<p class="lightgrey"><span class="green size14"><b><?php if (!empty($row['rate_per_night'])) { ?>
				$<?php echo $row['rate_per_night']; ?> <span class="size11 grey"> Avg/night </span>
				<?php } ?></b></span></p>
				
	            

				<!--<?php echo get_length_char($row['desc_01_select'], 155, ' ...'); ?>--> 
			</div>
		</div></div> 
	</div>
	
	<?php $line_write = true; ?>
	<?php $line_check = $key + 1; ?>
	<?php if ($line_check % 3 == 0) { ?>
		<?php $line_write = false; ?>
		<div class="clearfix"></div>
		<div class="offset-2"><hr class="featurette-divider3"></div>
	<?php } ?>
	
	<?php } ?>
	
	<?php if (isset($line_write) && $line_write) { ?>
		<div class="clearfix"></div>
		<div class="offset-2"><hr class="featurette-divider3"></div>
	<?php } ?>
</div>

<?php if (!empty($page_count)) { ?>
<div class="hpadding20">
	<ul class="pagination right paddingbtm20">
		<?php if ($page_active > 1) { ?>
		<li class="cursor"><a data-page_active="1">&laquo;</a></li>
		<?php } else { ?>
		<li class="disabled"><a>&laquo;</a></li>
		<?php } ?>
		
		<?php for ($i = -5; $i <= 5; $i++) { ?>
			<?php $page_counter = $page_active + $i; ?>
			<?php $class = ($i == 0) ? 'active' : ''; ?>
			<?php if ($page_counter > 0 && $page_counter <= $page_count) { ?>
			<li class="cursor <?php echo $class; ?>"><a data-page_active="<?php echo $page_counter; ?>"><?php echo $page_counter; ?></a></li>
			<?php } ?>
		<?php } ?>
		
		<?php if ($page_active < $page_count) { ?>
		<li class="cursor"><a data-page_active="<?php echo $page_count; ?>">&raquo;</a></li>
		<?php } else { ?>
		<li class="disabled"><a>&raquo;</a></li>
		<?php } ?>
	</ul>
</div>
<?php } ?>