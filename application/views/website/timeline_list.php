<?php foreach ($array_timeline as $key => $row) { ?>
<article style="position: absolute; left: 0px; top: 0px;" class="post-66 post type-post status-publish format-gallery hentry category-photography item six columns isotope-item item-right item-left">
	<span class="indicator-top"></span>
	<div class="post-content">
		<?php if (!empty($row['thumbnail_link'])) { ?>
		<a href="<?php echo $row['link_source']; ?>" title="<?php echo $row['title']; ?>" rel="bookmark">
			<div class="entry-format entry-gallery">
				<img src="<?php echo $row['thumbnail_link']; ?>" alt="flowers-2" height="673" width="602" />
			</div>
		</a>
		<?php } ?>
		<header class="entry-header">
			<h2 class="entry-title">
				<a href="<?php echo $row['link_source']; ?>" title="<?php echo $row['title']; ?>" rel="bookmark">
					<?php echo $row['title']; ?>
				</a>
			</h2>
		</header>
		<div class="entry-content">
			<p><?php echo get_length_char($row['content'], 150, ' ...'); ?></p>
			<p><a href="#" class="more-link">Continue reading <span class="meta-nav">»</span></a></p>
		</div>
	</div>
	<div class="entry-meta">
		<span class="indicator"></span>
		<span class="posted meta-item">
			<a href="#" rel="bookmark"><span class="entry-date"><?php echo GetFormatDate($row['post_date']); ?></span></a>
		</span>
		<span class="read-more meta-item">
			<div style="float:left;color:#b30;">Share : &nbsp;&nbsp;</div>
			<a href="http://www.facebook.com/sharer.php?u=tripdomestik.com" target="_blank">Facebook</a>
		</span>
	</div>
</article>
<?php } ?>