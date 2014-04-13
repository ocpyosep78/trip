<?php
	$array_review = (isset($array_review)) ? $array_review : array();
?>

<?php if (count($array_review) > 0) { ?>
	<?php foreach ($array_review as $row) { ?>
	<div class="hpadding20">
		<div class="col-md-4 offset-0 center"><div class="padding20"><div class="bordertype5">
			<div class="circlewrap">
				<img src="<?php echo $row['traveler_thumbnail_link']; ?>" class="circleimg" alt="" style="width: 52px; height: 52px;" />
			</div>
			<span class="dark">by <?php echo $row['traveler_full_name']; ?></span><br />
			from <?php echo $row['city_title']; ?>, <?php echo $row['country_title']; ?><br />
			<img src="<?php echo $row['rating_link']; ?>" alt=""/><br />
			<span class="orange"><?php echo $row['evaluation']; ?></span>
		</div></div></div>
		<div class="col-md-8 offset-0">
			<div class="padding20">
				<span class="opensans size16 dark"><?php echo $row['title']; ?></span><br />
				<span class="opensans size13 lgrey">Posted <?php echo GetFormatDate($row['post_date'], array( 'FormatDate' => 'M d, Y' )); ?></span><br />
				<p><?php echo $row['content']; ?></p>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="line2"></div>
	<?php } ?>
<?php } else { ?>
	<div style="margin: 25px 0; text-align: center;">
		No review found.
	</div>
	<div class="line2"></div>
<?php } ?>