<div class="product-grid"><div class="products-block"><div class="row">
	<?php foreach ($array_advert as $row) { ?>
		<div class="col-lg-333 col-md-3 col-sm-6 col-xs-12">
			<div class="product-block">
				<div class="tanggal"><?php echo $row['post_time_text']; ?></div>
				<div class="image">
					<a href="<?php echo $row['advert_link']; ?>"><img src="<?php echo $row['thumbnail_link']; ?>" title="<?php echo $row['name']; ?>" alt="<?php echo $row['name']; ?>" class="img-responsive"></a>
					<a href="<?php echo $row['advert_link']; ?>" class="info-view colorbox product-zoom cboxElement" rel="colorbox" title="<?php echo $row['name']; ?>"><i class="fa icon-zoom-in"></i></a>
					<div class="img-overlay"></div>
				</div>
				<div class="product-meta">
					<div class="left">
						<h3 class="name"><a href="<?php echo $row['advert_link']; ?>"><?php echo get_length_char($row['name'], 40, ' ...'); ?></a></h3>
						<p class="description"><?php echo get_length_char($row['content'], 40, ' ...'); ?></p>
						<div class="action">
							<div class="cartt">Region : <?php echo $row['region_name']; ?></div>
							<div class="wishlist">City : <?php echo $row['city_name']; ?></div>
						</div>
					</div>
					<div class="right">
						<div class="price"><span class="price-new"><?php echo $row['price_text']; ?></span></div>
					</div>
				</div>
			</div>
		</div>
	<?php } ?>
	</div>
</div></div></div>
<div class="pagination">
	<div class="links">
		<?php if ($page_active > 1) { ?>
		<?php $page_counter = $page_active - 1; ?>
		<a data-page-value="<?php echo 1; ?>">|&lt;</a>
		<a data-page-value="<?php echo $page_counter; ?>">&lt;</a>
		<?php } ?>
		
		<?php for ($i = -4; $i <= 4; $i++) { ?>
			<?php $page_counter = $page_active + $i; ?>
			<?php if ($page_counter > 0 && $page_counter <= $page_total) { ?>
			<?php if ($i == 0) { ?>
			<b><?php echo $page_counter; ?></b>
			<?php } else { ?>
			<a data-page-value="<?php echo $page_counter; ?>"><?php echo $page_counter; ?></a>
			<?php } ?>
			<?php } ?>
		<?php } ?>
		
		<?php if ($page_active < $page_total) { ?>
		<?php $page_counter = $page_active + 1; ?>
		<a data-page-value="<?php echo $page_counter; ?>">&gt;</a>
		<a data-page-value="<?php echo $page_total; ?>">&gt;|</a>
		<?php } ?>
	</div>
	<div class="results"><?php echo "Showing ".($page_offset + 1)." to ".($page_offset + count($array_advert))." of $total_item ($page_total Pages)"; ?></div>
</div>