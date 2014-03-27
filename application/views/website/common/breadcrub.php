<?php
	$array = (isset($array)) ? $array : array();
?>

<div class="container breadcrub">
	<div>
		<a class="homebtn left" href="#"></a>
		<div class="left"><ul class="bcrumbs">
			<?php foreach ($array as $key => $row) { ?>
			<li>/</li>
			<li><a href="<?php echo $row['link']; ?>"><?php echo $row['title']; ?></a></li>
			<?php } ?>
		</ul></div>
		<a class="backbtn right" href="#"></a>
	</div>
	<div class="clearfix"></div>
	<div class="brlines"></div>
</div>