<?php
	$param_advert = array(
		'advert_status_id' => ADVERT_STATUS_APPROVE,
		'sort' => '{"is_custom":"1","query":"RAND()"}',
		'limit' => 5
	);
	
	// add sub category id
	if (isset($category_sub_id)) {
		$param_advert['category_sub_id'] = $category_sub_id;
	}
	
	$array_advert = $this->Advert_model->get_array($param_advert);
?>
<div class="box box-product bestseller">
	<div class="box-heading"><span>5 Related sub-kategori random</span></div>	
	<div class="product-grid">
		<?php foreach ($array_advert as $key => $row) { ?>
		<div class="row"> 
			<div class="col-lg-3 col-sm-3 col-xs-12">
				<div class="product-block">
					<div class="image">
						<div class="image_container">
							<a class="img front" href="<?php echo $row['advert_link']; ?>">
								<img class="img-responsive" alt="<?php echo $row['name']; ?>" title="<?php echo $row['name']; ?>" src="<?php echo $row['thumbnail_link']; ?>">
							</a>
						</div>
					</div>
					<div class="product-meta">
						<h3 class="name"><a href="<?php echo $row['advert_link']; ?>"><?php echo get_length_char($row['name'], 30, ' ...'); ?></a></h3>
						<div class="price">
							<span class="price-new"><?php echo $row['price_text']; ?></span>
						</div>
					</div>
				</div>
			</div>
	    </div>
		<?php } ?>
	</div>
</div>