<?php
	$user = $this->user_model->get_session();
	$user = $this->user_model->get_by_id(array( 'id' => $user['id'] ));
?>
<aside class="bg-dark lter aside-md hidden-print" id="nav">
	<section class="vbox">
		<header class="header bg-primary lter text-center clearfix">
			<div class="btn-group">
				<button type="button" class="btn btn-sm btn-dark btn-icon" title="New project"><i class="fa fa-plus"></i></button>
				<div class="btn-group hidden-nav-xs">
					<button type="button" class="btn btn-sm btn-primary dropdown-toggle link-post" data-toggle="dropdown">
						Entry Ad
						<span class="caret"></span>
					</button>
				</div>
			</div>
		</header>
		
		<section class="w-f scrollable">
			<div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="5px" data-color="#333333">
				<nav class="nav-primary hidden-xs">
					<ul class="nav">
						<li>
							<a href="<?php echo base_url('panel'); ?>">
								<i class="fa fa-dashboard icon"><b class="bg-danger"></b></i>
								<span>Dashboard</span>
							</a>
						</li>
						<li>
							<a href="<?php echo base_url('panel/myad'); ?>">
								<i class="fa fa-columns icon"><b class="bg-info"></b></i>
								<span>My Ads</span>
							</a>
						</li>
						<li>
							<a href="<?php echo base_url('panel/message'); ?>">
								<i class="fa fa-envelope-o icon"><b class="bg-primary dker"></b></i>
								<span>Message</span>
							</a>
						</li>
						<li data-menu-parent="profile">
							<a>
								<i class="fa fa-file-text icon"><b class="bg-primary"></b></i>
								<span class="pull-right">
									<i class="fa fa-angle-down text"></i>
									<i class="fa fa-angle-up text-active"></i>
								</span>
								<span>Profile</span>
							</a>
							
							<ul class="nav lt">
								<li>
									<a href="<?php echo base_url('panel/profile/info'); ?>" data-menu-child="info">
										<i class="fa fa-angle-right"></i>
										<span>Edit Info</span>
									</a>
								</li>
								<li>
									<a href="<?php echo base_url('panel/profile/account'); ?>" data-menu-child="account">
										<i class="fa fa-angle-right"></i>
										<span>Edit Account</span>
									</a>
								</li>
								<li>
									<a href="<?php echo base_url('panel/profile/user'); ?>" data-menu-child="user">
										<i class="fa fa-angle-right"></i>
										<span>Edit Profile</span>
									</a>
								</li>
								<?php if ($user['verify_address'] == 0) { ?>
								<li>
									<a href="<?php echo base_url('panel/profile/verify_address'); ?>" data-menu-child="verify_address">
										<i class="fa fa-angle-right"></i>
										<span>Get Verified Address</span>
									</a>
								</li>
								<?php } ?>
								<li>
									<a href="<?php echo base_url('panel/profile/membership'); ?>" data-menu-child="membership">
										<i class="fa fa-angle-right"></i>
										<span>Request Membership</span>
									</a>
								</li>
							</ul>
						</li>
						<li>
							<a href="<?php echo base_url('panel/setting'); ?>">
								<i class="fa fa-flask icon"><b class="bg-info"></b></i>
								<span>Setting</span>
							</a>
						</li>
						<li>
							<a href="<?php echo base_url('panel/note'); ?>">
								<i class="fa fa-pencil icon"><b class="bg-info"></b></i>
								<span>Notes</span>
							</a>
						</li>
						<?php if (in_array($user['user_type_id'], array(USER_TYPE_ADMINISTRATOR, USER_TYPE_EDITOR))) { ?>
						<li data-menu-parent="manage">
							<a>
								<i class="fa fa-file-text icon"><b class="bg-primary"></b></i>
								<span class="pull-right">
									<i class="fa fa-angle-down text"></i>
									<i class="fa fa-angle-up text-active"></i>
								</span>
								<span>Manage</span>
							</a>
							
							<ul class="nav lt">
								<li>
									<a href="<?php echo base_url('panel/manage/advert'); ?>" data-menu-child="advert">
										<i class="fa fa-angle-right"></i>
										<span>Advert</span>
									</a>
								</li>
								<?php if (in_array($user['user_type_id'], array(USER_TYPE_ADMINISTRATOR))) { ?>
								<li>
									<a href="<?php echo base_url('panel/manage/announce'); ?>" data-menu-child="announce">
										<i class="fa fa-angle-right"></i>
										<span>Announce</span>
									</a>
								</li>
								<li>
									<a href="<?php echo base_url('panel/manage/report'); ?>" data-menu-child="report">
										<i class="fa fa-angle-right"></i>
										<span>Report</span>
									</a>
								</li>
								<?php } ?>
							</ul>
						</li>
						<?php } ?>
						<?php if (in_array($user['user_type_id'], array(USER_TYPE_ADMINISTRATOR))) { ?>
						<li data-menu-parent="user">
							<a>
								<i class="fa fa-file-text icon"><b class="bg-primary"></b></i>
								<span class="pull-right">
									<i class="fa fa-angle-down text"></i>
									<i class="fa fa-angle-up text-active"></i>
								</span>
								<span>User</span>
							</a>
							
							<ul class="nav lt">
								<li>
									<a href="<?php echo base_url('panel/user/user'); ?>" data-menu-child="user">
										<i class="fa fa-angle-right"></i>
										<span>User</span>
									</a>
								</li>
								<li>
									<a href="<?php echo base_url('panel/user/mass_email'); ?>" data-menu-child="mass_email">
										<i class="fa fa-angle-right"></i>
										<span>Mass Email</span>
									</a>
								</li>
								<li>
									<a href="<?php echo base_url('panel/user/verify_address'); ?>" data-menu-child="verify_address">
										<i class="fa fa-angle-right"></i>
										<span>Verify Address</span>
									</a>
								</li>
								<li>
									<a href="<?php echo base_url('panel/user/membership'); ?>" data-menu-child="membership">
										<i class="fa fa-angle-right"></i>
										<span>Membership Request</span>
									</a>
								</li>
							</ul>
						</li>
						<li data-menu-parent="setup">
							<a>
								<i class="fa fa-file-text icon"><b class="bg-primary"></b></i>
								<span class="pull-right">
									<i class="fa fa-angle-down text"></i>
									<i class="fa fa-angle-up text-active"></i>
								</span>
								<span>Setup</span>
							</a>
							
							<ul class="nav lt">
								<li>
									<a href="<?php echo base_url('panel/setup/advert_type_sub'); ?>" data-menu-child="advert_type_sub">
										<i class="fa fa-angle-right"></i>
										<span>Advert Type</span>
									</a>
								</li>
								<li>
									<a href="<?php echo base_url('panel/setup/membership'); ?>" data-menu-child="membership">
										<i class="fa fa-angle-right"></i>
										<span>Membership</span>
									</a>
								</li>
								<li>
									<a href="<?php echo base_url('panel/setup/category_price'); ?>" data-menu-child="category_price">
										<i class="fa fa-angle-right"></i>
										<span>Category Price</span>
									</a>
								</li>
								<li>
									<a href="<?php echo base_url('panel/setup/category_input'); ?>" data-menu-child="category_input">
										<i class="fa fa-angle-right"></i>
										<span>Category Input</span>
									</a>
								</li>
								<li>
									<a href="<?php echo base_url('panel/setup/vehicle_brand'); ?>" data-menu-child="vehicle_brand">
										<i class="fa fa-angle-right"></i>
										<span>Vehicle Brand</span>
									</a>
								</li>
								<li>
									<a href="<?php echo base_url('panel/setup/vehicle_type'); ?>" data-menu-child="vehicle_type">
										<i class="fa fa-angle-right"></i>
										<span>Vehicle Type</span>
									</a>
								</li>
							</ul>
						</li>
						<?php } ?>
						<?php if (in_array($user['user_type_id'], array(USER_TYPE_ADMINISTRATOR))) { ?>
						<li data-menu-parent="master">
							<a>
								<i class="fa fa-file-text icon"><b class="bg-primary"></b></i>
								<span class="pull-right">
									<i class="fa fa-angle-down text"></i>
									<i class="fa fa-angle-up text-active"></i>
								</span>
								<span>Master</span>
							</a>
							
							<ul class="nav lt">
								<li>
									<a href="<?php echo base_url('panel/master/advert_type'); ?>" data-menu-child="advert_type">
										<i class="fa fa-angle-right"></i>
										<span>Advert Type</span>
									</a>
								</li>
								<li>
									<a href="<?php echo base_url('panel/master/category'); ?>" data-menu-child="category">
										<i class="fa fa-angle-right"></i>
										<span>Category</span>
									</a>
								</li>
								<li>
									<a href="<?php echo base_url('panel/master/category_sub'); ?>" data-menu-child="category_sub">
										<i class="fa fa-angle-right"></i>
										<span>Sub Category</span>
									</a>
								</li>
								<li>
									<a href="<?php echo base_url('panel/master/city'); ?>" data-menu-child="city">
										<i class="fa fa-angle-right"></i>
										<span>City</span>
									</a>
								</li>
								<li>
									<a href="<?php echo base_url('panel/master/page_static'); ?>" data-menu-child="page_static">
										<i class="fa fa-angle-right"></i>
										<span>Page Static</span>
									</a>
								</li>
								<li>
									<a href="<?php echo base_url('panel/master/region'); ?>" data-menu-child="region">
										<i class="fa fa-angle-right"></i>
										<span>Region</span>
									</a>
								</li>
								<li>
									<a href="<?php echo base_url('panel/master/widget'); ?>" data-menu-child="widget">
										<i class="fa fa-angle-right"></i>
										<span>Widget</span>
									</a>
								</li>
							</ul>
						</li>
						<?php } ?>
					</ul>
				</nav>
			</div>
		</section>
		
		<footer class="footer lt hidden-xs b-t b-dark">
			<a href="#nav" data-toggle="class:nav-xs" class="pull-right btn btn-sm btn-dark btn-icon">
				<i class="fa fa-angle-left text"></i>
				<i class="fa fa-angle-right text-active"></i>
			</a>
		</footer>
	</section>
</aside>