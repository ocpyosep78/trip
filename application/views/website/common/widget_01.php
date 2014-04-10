<?php
	$widget = $this->widget_model->get_by_id(array( 'alias' => 'widget-01' ));
?>

<div class="opensans grey">
	<?php echo $widget['content']; ?>
	<br /><br />
</div>