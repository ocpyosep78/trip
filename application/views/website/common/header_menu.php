<?php
	// page data
	$is_login = $this->user_model->is_login();
	$array_language = $this->language_model->get_array();
	$language = $this->language_model->get_session();
	
	// array category
	$param_category = array(
		'in' => CATEGORY_HOTEL.','.CATEGORY_DESTINATION.','.CATEGORY_RESTAURANT,
		'sort' => '[{"property":"order_no","direction":"ASC"}]'
	);
	$array_category = $this->category_model->get_array($param_category);
?>
<div class="navbar-wrapper2 navbar-fixed-top">
	<div class="container">
		<div class="navbar">
			<div class="container offset-3">
				<div class="navbar-header">
					<button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a href="<?php echo base_url(); ?>" class="navbar-brand"><img src="<?php echo base_url('static/theme/forest/images/logo.png'); ?>" alt="Travel Agency Logo" class="logo"/></a>
				</div>
				<div class="navbar-collapse collapse">
					<ul class="nav navbar-nav navbar-right">
						<li><a href="<?php echo base_url(); ?>">Home</a></li>
						
						<?php if ($is_login) { ?>
						<li><a href="<?php echo base_url('panel'); ?>">Dashboard</a></li>
						<?php } ?>
						
						<?php foreach ($array_category as $row) { ?>
						<li><a href="<?php echo $row['link_category']; ?>"><?php echo $row['title']; ?></a></li>
						<?php } ?>
						
						<li class="dropdown">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">Language<b class="lightcaret mt-2"></b></a>
							<ul class="dropdown-menu">
								<?php foreach ($array_language as $row) { ?>
								<?php $class = ($language == $row['code']) ? 'active' : ''; ?>
								<li class="<?php echo $class; ?>"><a class="cursor change-language" data-code="<?php echo $row['code']; ?>"><?php echo $row['title']; ?></a></li>
								<?php } ?>
							</ul>
						</li>
						
						<?php if ($is_login) { ?>
						<li><a href="<?php echo base_url('panel/home/logout'); ?>">Log Out</a></li>
						<?php } else { ?>
						<li class="dropdown">
							<a data-toggle="dropdown" class="dropdown-toggle" href="<?php echo base_url('login/member'); ?>">Login<b class="lightcaret mt-2"></b></a>
							<ul class="dropdown-menu">
								<li><a href="<?php echo base_url('login/member'); ?>">Member</a></li>
								<li><a href="<?php echo base_url('login/traveler'); ?>">Traveler</a></li>
							</ul>
						</li>
						<?php } ?>
						
						<li>
							<div style="float:none;margin-top:7px;width:95%">
								<form id="form-header">
									<input type="text" name="namelike" class="form-control" placeholder="Search" />
								</form>
							</div>
						</li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div style="background-color:#b30;border-bottom:1px inset #b30;">
	</div>
</div>