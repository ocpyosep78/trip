<?php
	$is_login = $this->User_model->is_login();
	$namelike = (isset($_POST['namelike'])) ? $_POST['namelike'] : '';
	$array_category = $this->Category_model->get_array();
?>
<header id="header">
	<section id="topbar">
		<div class="container">
			<div class="navbar-header pull-left hidden-xs hidden-sm">
				<div class="clearfix">
					<div class="login links"><?php echo WEBSITE_TITLE.' - '.WEBSITE_DESC; ?></div>
				</div>
			</div>
			
			<div class="show-mobile hidden-lg hidden-md">
				<div id="search_mobile" class="search pull-left">
					<div class="quickaccess-toggle">Find</div>
					<div class="inner-toggle">
						<input name="search" placeholder="Search" class="form-control input-search" type="text" value="<?php echo $namelike; ?>" />
						<div class="button-search-mobile"><span class="fa icon-search cursor"></span></div>
					</div>
				</div>
			</div>
			
			<div class="support pull-right hidden-xs hidden-sm">
				<div class="pull-right right"></div>
				<div class="pull-right left">
					<ul class="links hidden-xs hidden-sm hidden-md">
						<li><a href="<?php echo base_url('post'); ?>">Post</a></li>
						<?php if ($is_login) { ?>
						<li><a href="<?php echo base_url('panel/'); ?>">Panel</a></li>
						<li><a href="<?php echo base_url('panel/home/logout'); ?>">Logout</a></li>
						<?php } else { ?>
						<li><a href="<?php echo base_url('login'); ?>">Sign in</a></li>
						<li><a href="<?php echo base_url('forget_password'); ?>">Forget</a></li>
						<li><a href="<?php echo base_url('register'); ?>">Register</a></li>
						<?php } ?>
					</ul>
				</div>
			</div>
		</div>
	</section>
	
	<section id="header-main">
		<div class="container">
			<div class="header-wrap">
				<div class="pull-left inner"><div id="logo">
					<a href="<?php echo base_url(); ?>">
						<img src="<?php echo base_url('static/theme/shoper/img/logo.png'); ?>" title="<?php echo WEBSITE_TITLE; ?>" alt="<?php echo WEBSITE_TITLE; ?>">
					</a>
				</div></div>
				
				<div class="pull-right inner">
					<section id="pav-mainnav">
						<div class="container"><div class="pav-megamenu"><div class="navbar navbar-default"><div id="mainmenutop" class="megamenu" role="navigation">
							<div class="navbar-header">
								<a href="javascript:;" data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</a>
								<div class="collapse navbar-collapse navbar-ex1-collapse">
									<ul class="nav navbar-nav megamenu">
										<li class="home first">
											<a href="<?php echo base_url(); ?>"><span class="menu-title">Home</span></a>
										</li>
										<li class="parent dropdown pav-parrent"></li>
										<li class="">
											<a href="http://shopermarket.com/holiday-shopping-guide" alt="Holiday Shopping Guide 2014" title="Holiday Shopping Guide 2014">
												<span class="menu-title">Holiday Shopping Guide</span>
											</a>
										</li>
										<li class="">
											<a href="http://shopermarket.com/deals" alt="Deals" title="Deals">
												<span class="menu-title">Deals</span>
											</a>
										</li>
										<li class="last">
											<a href="http://blog.shopermarket.com/">
												<span class="menu-title">Blog</span>
											</a>
										</li>
									</ul>
								</div>
							</div>
						</div></div></div></div>
					</section>
				</div>
			</div>
		</div>
	</section>
	
	<section id="header-bottom" class="hidden-xs hidden-sm">
		<div class="container">
			<div class="row">
				<div class="col-lg-33 col-sm-3 col-md-3 hidden-xs hidden-sm">
					<div id="pav-verticalmenu" class="pav-dropdown">
						<div class="menu-heading d-heading">
							<h4>categories <span class="arrow-down pull-right"><span></span></span></h4>
						</div>
						<div class="menu-content d-content"><div class="pav-verticalmenu"><div class="navbar navbar-default"><div id="mainmenutop" class="verticalmenu" role="navigation"><div class="navbar-header"><div class="collapse navbar-collapse navbar-ex1-collapse">
							<ul class="nav navbar-nav verticalmenu">
								<?php foreach ($array_category as $category) { ?>
								<li class="parent dropdown pav-parrent">
									<a href="<?php echo $category['category_link']; ?>" class="dropdown-toggle" data-toggle="dropdown"><span class="menu-title"><?php echo $category['name']; ?></span><b class="caret"></b></a>
									<div class="dropdown-menu" style="width: 700px; min-height: 300px;"><div class="dropdown-menu-inner"><div class="row">
										<div class="mega-col col-md-6"><div class="mega-col-inner">
											<div class="pavo-widget" id="wid-7">
												<?php $array_category_sub = $this->Category_Sub_model->get_array(array( 'category_id' => $category['id'] )); ?>
												<?php foreach ($array_category_sub as $category_sub) { ?>
												<h3 class="menu-title"><a href="<?php echo $category_sub['category_sub_link']; ?>"><span><?php echo $category_sub['name']; ?></span></a></h3>
												<?php } ?>
											</div>
										</div></div>
										<?php if (!empty($category['thumbnail_link'])) { ?>
										<div class="mega-col col-md-6"><div class="mega-col-inner">
											<div class="pavo-widget" id="wid-10">
												<div class="widget-image">
													<div class="widget-inner clearfix">
														<div><img src="<?php echo $category['thumbnail_link']; ?>" alt="<?php echo $category['name']; ?>" title="<?php echo $category['name']; ?>"></div>
													</div>
												</div>
											</div>
										</div></div>
										<?php } ?>
									</div></div></div>
								</li>
								<?php } ?>
							</ul>
						</div></div></div></div></div></div>
					</div>
				</div>
				<div class="col-lg-7 col-sm-6 col-md-6 col-xs-12">
					<div id="search">
						<input name="search" placeholder="Search" class="form-control input-search" type="text" value="<?php echo $namelike; ?>" />
						<div class="button-search"><span class="icon-search"></span></div>
					</div>
				</div>
				<div class="col-lg-2 col-sm-6 col-md-3 col-xs-12">
					<div class="cart-top"><div id="cart" class="clearfix"><div class="heading">
						<div style="margin-top:-4px;margin-left:-16px;"><button type="submit" class="button btn-submit">Search</button></div>
						<!--
						<i class="fa icon-shopping-cart"></i>
						
						<div class="cart-inner">
							<h4>Shdasdas Cart</h4>
							<a><span id="cart-total">0 item(s) - $0.00</span></a>
						</div>
						-->
					</div></div></div>
				</div>
			</div>
		</div>
	</section>
</header>

<section id="sys-notification">
	<div class="container">
		<div id="notification"></div>
	</div>
</section>

<script>
	var search = {
		action: function(p) {
			if (p.is_search_page == 0 && $('#form-hidden').length == 1) {
				// check on search page or not ?
				var current_link = window.location.href;
				var array_match = current_link.match(/search/g);
				if (array_match == null) {
					current_link = current_link.replace(/\/$/g, '');
				} else {
					current_link = current_link.replace(/\/search\/.+/gi, '');
				}
				window.location = current_link + '/search/' + Func.GetName(p.value);
			} else {
				window.location = web.base + 'search/' + Func.GetName(p.value);
			}
		}
	}
	
	// mobile
	$('#search_mobile .icon-search').click(function() {
		var value = $('#search_mobile [name="search"]').val();
		var is_search_page = ($('#form-hidden [name="is_search_page"]').length == 1) ? $('#form-hidden [name="is_search_page"]').val() : 0;
		search.action({ is_search_page: is_search_page, value: value });
	});
	
	// website
	$('#search .icon-search').click(function() {
		var value = $('#search [name="search"]').val();
		var is_search_page = ($('#form-hidden [name="is_search_page"]').length == 1) ? $('#form-hidden [name="is_search_page"]').val() : 0;
		search.action({ is_search_page: is_search_page, value: value });
	});
	$('.btn-submit').click(function() {
		$('#search .icon-search').click();
	});
</script>