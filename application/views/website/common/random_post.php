<?php
	$city_id = (isset($city_id)) ? $city_id : '';
	$class_style = (isset($class_style)) ? $class_style : 'testimonialbox';
	
	// city
	if (!empty($city_id)) {
		$city = $this->city_model->get_by_id(array( 'id' => $city_id ));
	}
	
	// array post
	$param_post = array(
		'sort' => '{"is_custom":"1","query":"RAND()"}',
		'limit' => 3
	);
	if (!empty($city_id)) {
		$param_post['city_id'] = $city_id;
	}
	$array_post = $this->post_model->get_array($param_post);
?>

<div class="pagecontainer2 <?php echo $class_style; ?>">
	<div class="cpadding1">
		<span class="icon-location"></span>
		<?php if (!empty($city['title'])) { ?>
		<h3 class="opensans">Random Destination around <?php echo $city['title']; ?></h3>
		<?php } else { ?>
		<h3 class="opensans">Random Destination</h3>
		<?php } ?>
		<div class="clearfix"></div>
	</div>
	
	<?php foreach ($array_post as $key => $row) { ?>
	<div class="cpadding1">
		<a href="<?php echo $row['link_post']; ?>"><img src="<?php echo $row['link_thumbnail_small']; ?>" class="left mr20" alt="<?php echo $row['title_select']; ?>" style="width: 96px; height: 61px;" /></a>
		<a href="<?php echo $row['link_post']; ?>" class="dark"><b><?php echo $row['title_select']; ?></b></a><br /><br />
		<?php if (!empty($row['link_star'])) { ?>
		<img src="<?php echo $row['link_star']; ?>" alt="<?php echo $row['title_select']; ?>" />
		<?php } else if (!empty($row['link_review_rate'])) { ?>
		<img src="<?php echo $row['link_review_rate']; ?>" alt="<?php echo $row['title_select']; ?>" />
		<?php } else { ?>
		&nbsp;
		<?php } ?>
	</div>
	
	<?php if ($key == (count($array_post) - 1)) { ?>
	<br />
	<?php } else { ?>
	<div class="line5"></div>
	<?php } ?>
	
	<?php } ?>
	
</div>