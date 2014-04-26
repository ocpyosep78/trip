<?php
	$class_style = (isset($class_style)) ? $class_style : 'testimonialbox';
	
	$array_post = $this->post_model->get_session();
	krsort($array_post);
	$array_post = array_values($array_post);
?>

<div class="pagecontainer2 <?php echo $class_style; ?>">
	<div class="cpadding1">
		<span class="icon-location"></span>
		<h3 class="opensans">Latest Visit</h3>
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