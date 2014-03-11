<?php
	$widget = $this->Widget_model->get_by_id(array( 'alias' => 'widget-1' ));
?>
<div class="box box-product bestseller">
	<div class="box-heading"><span><?php echo $widget['name']; ?></span></div>
	<div class="box-content">
		<div class="product-list"><?php echo $widget['content']; ?></div>
	</div>
</div>