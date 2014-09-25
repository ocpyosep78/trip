<?php
	$param_region = array(
		'post_status' => 'approve',
		'category_id' => $_POST['category_id'],
		'region_id' => $_POST['region_id']
	);
	$array_city = $this->post_model->get_city_count($param_region);
?>
<?php foreach ($array_city as $row) { ?>
	<?php if (@$_POST['city_id'] == $row['city_id']) { ?>
	<div style="float: left; font-size: 14px; padding: 5px 0px 0px 7px;">
	<a href="<?php echo $row['link_city']; ?>"><strong><?php echo $row['city_title']; ?> <!--(<?php echo $row['total']; ?>) --></strong></a>
	
	</div> <div style="float:left;padding-bottom:20px;"></div>
	<?php } else { ?>
 	<div style="float: left; font-size: 14px; padding: 5px 0px 0px 7px;"><a href="<?php echo $row['link_city']; ?>"><?php echo $row['city_title']; ?> <!--(<?php echo $row['total']; ?>) --></a>

	</div> 
<div style="float:left;padding-bottom:20px;"></div>	
	<?php } ?>
<?php } ?>
