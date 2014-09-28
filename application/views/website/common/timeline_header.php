<?php
	$traveler = array( 'link_traveler' => '#', 'full_name' => '&nbsp;', 'thumbnail_link' => base_url('static/img/avatar.jpg') );
	if (!empty($this->uri->segments[2])) {
		$traveler = $this->traveler_model->get_by_id(array( 'alias' => $this->uri->segments[2] ));
	}
?>

<div id="loading"></div>
<header id="header-wrap" class="wrap" role="banner"><!-- BEGIN #header-wrap -->
	<div id="header" class="row"><!-- BEGIN #header -->
		<div id="navigation"><!-- BEGIN #navigation -->
		<div class="menu-navigation-container">
			<ul id="menu-navigation" class="sf-menu menu sf-js-enabled"><li id="menu-item-15" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-home menu-item-15">
				<a href="<?php echo base_url(); ?>">Home</a></li>
			</ul>
		</div>		</div><!-- END #navigation -->
	
<!--	<a style="display: none;" class="navigation-trigger" href="#"></a> -->
		
		<table style="z-index: 1002;" id="logo-wrap">
			<tbody><tr>
				<td>
				<h1 id="logo" class="avatar"><!-- BEGIN #logo -->
				<a href="<?php echo $traveler['link_traveler']; ?>" title="<?php echo $traveler['full_name']; ?>" rel="home">
					<img src="<?php echo $traveler['thumbnail_link']; ?>" alt="<?php echo $traveler['full_name']; ?>" style="width: 80px;">
				</a>
				</h1><!-- END #logo -->
				</td>
			</tr>
		</tbody></table>
		
		<div id="header-right" class="social"><!-- BEGIN #header-right -->
			<ul class="tva-social-icons">
				<li><a class="facebook" href="#facebook" title="Facebook" target="_blank">Facebook</a></li>
				<li><a class="linkedin" href="#linkedin" title="LinkedIN" target="_blank">LinkedIN</a></li>
				<li><a class="pinterest" href="#pinterest" title="Pinterest" target="_blank">Pinterest</a></li>
				<li><a class="twitter" href="#twitter" title="Twitter" target="_blank">Twitter</a></li>
			</ul>
		</div><!-- END #header-right -->
	</div><!-- END #header -->
</header><!-- END #header-wrap -->

<section id="subheader-wrap" class="wrap animated fadeInDown">
<!-- BEGIN #subheader-wrap -->
<div id="subheader" class="row tagline"><!-- BEGIN #subheader -->
<span><?php echo $traveler['full_name']; ?></span></div><!-- END #subheader -->
</section><!-- END #subheader-wrap -->
<!--
<section id="subheader-widgets-wrap" class="wrap"> 
	
	<div id="subheader-widgets" class="row"> 

		<div class="six columns"><aside id="text-7" class="widget widget_text"><h3 class="widget-title">About Me</h3>			<div class="textwidget"><p>Sed
 ut perspiciatis unde omnis iste natus error sit voluptatem accusantium 
doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo 
inventore veritatis et quasi architecto beatae vitae dicta sunt 
explicabo.</p>
</div>
		</aside></div><div class="six columns"><aside id="tva-latest-tweets-widget-2" class="widget tva-latest-tweets-widget"><h3 class="widget-title">Latest Tweets</h3>

		
		Biarin saja

		<ul id="twitter_update_list_0"><li>Loading Tweets...</li></ul>
		
 	</aside></div>
	</div> 
</section>  -->