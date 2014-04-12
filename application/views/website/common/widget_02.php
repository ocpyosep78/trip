<?php
	$widget = $this->widget_model->get_by_id(array( 'alias' => 'widget-01' ));
?>

<div class="pagecontainer2 testimonialbox">
	<div class="cpadding0 mt-10">
		<?php echo $widget['content']; ?>
	</div>
</div>