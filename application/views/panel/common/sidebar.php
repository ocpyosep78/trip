<?php
	$user = $this->user_model->get_session();
	$user = $this->user_model->get_by_id(array( 'user_type_id' => $user['user_type_id'], 'id' => $user['id'] ));
?>
<aside class="bg-dark lter aside-md hidden-print" id="nav">
	<section class="vbox">
		<header class="header bg-primary lter text-center clearfix">
			<div class="btn-group">
				<button type="button" class="btn btn-sm btn-dark btn-icon" title="New project"><i class="fa fa-plus"></i></button>
				<div class="btn-group hidden-nav-xs">
					<button type="button" class="btn btn-sm btn-primary dropdown-toggle link-post" data-toggle="dropdown">
						Create Promo
						<span class="caret"></span>
					</button>
				</div>
			</div>
		</header>
		
		<section class="w-f scrollable">
			<div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="5px" data-color="#333333">
				<nav class="nav-primary hidden-xs">
					<?php if ($user['user_type_id'] == USER_TYPE_ADMINISTRATOR) { ?>
					<ul class="nav">
						<li>
							<a href="<?php echo base_url('panel'); ?>">
								<i class="fa fa-dashboard icon"><b class="bg-danger"></b></i>
								<span>Dashboard</span>
							</a>
						</li>
						<li data-menu-parent="post">
							<a>
								<i class="fa fa-file-text icon"><b class="bg-primary"></b></i>
								<span class="pull-right">
									<i class="fa fa-angle-down text"></i>
									<i class="fa fa-angle-up text-active"></i>
								</span>
								<span>Post</span>
							</a>
							
							<ul class="nav lt">
								<li>
									<a href="<?php echo base_url('panel/post/hotel'); ?>" data-menu-child="hotel">
										<i class="fa fa-angle-right"></i>
										<span>Hotel</span>
									</a>
								</li>
								<li>
									<a href="<?php echo base_url('panel/post/destination'); ?>" data-menu-child="destination">
										<i class="fa fa-angle-right"></i>
										<span>Destination</span>
									</a>
								</li>
								<li>
									<a href="<?php echo base_url('panel/post/restaurant'); ?>" data-menu-child="restaurant">
										<i class="fa fa-angle-right"></i>
										<span>Restaurant</span>
									</a>
								</li>
								<li>
									<a href="<?php echo base_url('panel/post/other'); ?>" data-menu-child="other">
										<i class="fa fa-angle-right"></i>
										<span>Other</span>
									</a>
								</li>
								<li>
									<a href="<?php echo base_url('panel/post/promo'); ?>" data-menu-child="promo">
										<i class="fa fa-angle-right"></i>
										<span>Promo</span>
									</a>
								</li>
								<li>
									<a href="<?php echo base_url('panel/post/review'); ?>" data-menu-child="review">
										<i class="fa fa-angle-right"></i>
										<span>Review</span>
									</a>
								</li>
								<li>
									<a href="<?php echo base_url('panel/post/gallery'); ?>" data-menu-child="gallery">
										<i class="fa fa-angle-right"></i>
										<span>Traveler Upload</span>
									</a>
								</li>
								<li>
									<a href="<?php echo base_url('panel/post/gallery_report'); ?>" data-menu-child="gallery_report">
										<i class="fa fa-angle-right"></i>
										<span>Traveler Report</span>
									</a>
								</li>
								<li>
									<a href="<?php echo base_url('panel/post/payment'); ?>" data-menu-child="payment">
										<i class="fa fa-angle-right"></i>
										<span>Payment</span>
									</a>
								</li>
							</ul>
						</li>
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
									<a href="<?php echo base_url('panel/user/editor'); ?>" data-menu-child="editor">
										<i class="fa fa-angle-right"></i>
										<span>Editor</span>
									</a>
								</li>
								<li>
									<a href="<?php echo base_url('panel/user/member'); ?>" data-menu-child="member">
										<i class="fa fa-angle-right"></i>
										<span>Member</span>
									</a>
								</li>
								<li>
									<a href="<?php echo base_url('panel/user/traveler'); ?>" data-menu-child="traveler">
										<i class="fa fa-angle-right"></i>
										<span>Traveler</span>
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
									<a href="<?php echo base_url('panel/user/verify_membership'); ?>" data-menu-child="verify_membership">
										<i class="fa fa-angle-right"></i>
										<span>Verify Membership</span>
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
									<a href="<?php echo base_url('panel/setup/auto_complete'); ?>" data-menu-child="auto_complete">
										<i class="fa fa-angle-right"></i>
										<span>Auto Complete</span>
									</a>
								</li>
								<li>
									<a href="<?php echo base_url('panel/setup/category'); ?>" data-menu-child="category">
										<i class="fa fa-angle-right"></i>
										<span>Category</span>
									</a>
								</li>
								<li>
									<a href="<?php echo base_url('panel/setup/category_sub'); ?>" data-menu-child="category_sub">
										<i class="fa fa-angle-right"></i>
										<span>Category Sub</span>
									</a>
								</li>
								<li>
									<a href="<?php echo base_url('panel/setup/category_facility'); ?>" data-menu-child="category_facility">
										<i class="fa fa-angle-right"></i>
										<span>Category Facility</span>
									</a>
								</li>
								<li>
									<a href="<?php echo base_url('panel/setup/language'); ?>" data-menu-child="language">
										<i class="fa fa-angle-right"></i>
										<span>Language</span>
									</a>
								</li>
								<li>
									<a href="<?php echo base_url('panel/setup/promo_duration'); ?>" data-menu-child="promo_duration">
										<i class="fa fa-angle-right"></i>
										<span>Promo Duration</span>
									</a>
								</li>
								<li>
									<a href="<?php echo base_url('panel/setup/room_amenity'); ?>" data-menu-child="room_amenity">
										<i class="fa fa-angle-right"></i>
										<span>Room Amenity</span>
									</a>
								</li>
								<li>
									<a href="<?php echo base_url('panel/setup/page_static'); ?>" data-menu-child="page_static">
										<i class="fa fa-angle-right"></i>
										<span>Page Static</span>
									</a>
								</li>
								<li>
									<a href="<?php echo base_url('panel/setup/widget'); ?>" data-menu-child="widget">
										<i class="fa fa-angle-right"></i>
										<span>Widget</span>
									</a>
								</li>
							</ul>
						</li>
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
									<a href="<?php echo base_url('panel/master/facility'); ?>" data-menu-child="facility">
										<i class="fa fa-angle-right"></i>
										<span>Facility</span>
									</a>
								</li>
								<li>
									<a href="<?php echo base_url('panel/master/city'); ?>" data-menu-child="city">
										<i class="fa fa-angle-right"></i>
										<span>City</span>
									</a>
								</li>
								<li>
									<a href="<?php echo base_url('panel/master/country'); ?>" data-menu-child="country">
										<i class="fa fa-angle-right"></i>
										<span>Country</span>
									</a>
								</li>
								<li>
									<a href="<?php echo base_url('panel/master/region'); ?>" data-menu-child="region">
										<i class="fa fa-angle-right"></i>
										<span>Region</span>
									</a>
								</li>
								<li>
									<a href="<?php echo base_url('panel/master/membership'); ?>" data-menu-child="membership">
										<i class="fa fa-angle-right"></i>
										<span>Membership</span>
									</a>
								</li>
							</ul>
						</li>
						<li data-menu-parent="log">
							<a>
								<i class="fa fa-file-text icon"><b class="bg-primary"></b></i>
								<span class="pull-right">
									<i class="fa fa-angle-down text"></i>
									<i class="fa fa-angle-up text-active"></i>
								</span>
								<span>Log</span>
							</a>
							
							<ul class="nav lt">
								<li>
									<a href="<?php echo base_url('panel/log/city_ip'); ?>" data-menu-child="city_ip">
										<i class="fa fa-angle-right"></i>
										<span>City IP</span>
									</a>
								</li>
								<li>
									<a href="<?php echo base_url('panel/log/ip_banned'); ?>" data-menu-child="ip_banned">
										<i class="fa fa-angle-right"></i>
										<span>IP Banned</span>
									</a>
								</li>
								<li>
									<a href="<?php echo base_url('panel/log/ip_pass'); ?>" data-menu-child="ip_pass">
										<i class="fa fa-angle-right"></i>
										<span>IP Pass</span>
									</a>
								</li>
								<li>
									<a href="<?php echo base_url('panel/log/ip_log'); ?>" data-menu-child="ip_log">
										<i class="fa fa-angle-right"></i>
										<span>IP Log</span>
									</a>
								</li>
							</ul>
						</li>
					</ul>
					<?php } else if ($user['user_type_id'] == USER_TYPE_MEMBER) { ?>
					<ul class="nav">
						<li>
							<a href="<?php echo base_url('panel'); ?>">
								<i class="fa fa-dashboard icon"><b class="bg-danger"></b></i>
								<span>Dashboard</span>
							</a>
						</li>
						<li data-menu-parent="post">
							<a>
								<i class="fa fa-file-text icon"><b class="bg-primary"></b></i>
								<span class="pull-right">
									<i class="fa fa-angle-down text"></i>
									<i class="fa fa-angle-up text-active"></i>
								</span>
								<span>Post</span>
							</a>
							
							<ul class="nav lt">
								<li>
									<a href="<?php echo base_url('panel/post/hotel'); ?>" data-menu-child="hotel">
										<i class="fa fa-angle-right"></i>
										<span>Hotel</span>
									</a>
								</li>
								<li>
									<a href="<?php echo base_url('panel/post/destination'); ?>" data-menu-child="destination">
										<i class="fa fa-angle-right"></i>
										<span>Destination</span>
									</a>
								</li>
								<li>
									<a href="<?php echo base_url('panel/post/restaurant'); ?>" data-menu-child="restaurant">
										<i class="fa fa-angle-right"></i>
										<span>Restaurant</span>
									</a>
								</li>
								<li>
									<a href="<?php echo base_url('panel/post/other'); ?>" data-menu-child="other">
										<i class="fa fa-angle-right"></i>
										<span>Other</span>
									</a>
								</li>
								<li>
									<a href="<?php echo base_url('panel/post/promo'); ?>" data-menu-child="promo">
										<i class="fa fa-angle-right"></i>
										<span>Promo</span>
									</a>
								</li>
							</ul>
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
								<?php if (empty($user['verify_address'])) { ?>
								<li>
									<a href="<?php echo base_url('panel/profile/verify_address'); ?>" data-menu-child="verify_address">
										<i class="fa fa-angle-right"></i>
										<span>Get Verified</span>
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
					</ul>
					<?php } else if ($user['user_type_id'] == USER_TYPE_TRAVELER) { ?>
					<ul class="nav">
						<li>
							<a href="<?php echo base_url('panel'); ?>">
								<i class="fa fa-dashboard icon"><b class="bg-danger"></b></i>
								<span>Dashboard</span>
							</a>
						</li>
						<li data-menu-parent="review">
							<a href="<?php echo base_url('panel/review'); ?>">
								<i class="fa fa-file-text icon"><b class="bg-primary"></b></i>
								<span>My Review</span>
							</a>
						</li>
						<li data-menu-parent="gallery">
							<a href="<?php echo base_url('panel/gallery'); ?>">
								<i class="fa fa-file-text icon"><b class="bg-primary"></b></i>
								<span>My Gallery</span>
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
									<a href="<?php echo base_url('panel/profile/user'); ?>" data-menu-child="user">
										<i class="fa fa-angle-right"></i>
										<span>Edit Profile</span>
									</a>
								</li>
							</ul>
						</li>
						<li data-menu-parent="setting">
							<a href="<?php echo base_url('panel/setting'); ?>">
								<i class="fa fa-flask icon"><b class="bg-info"></b></i>
								<span>Setting</span>
							</a>
						</li>
					</ul>
					<?php } ?>
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