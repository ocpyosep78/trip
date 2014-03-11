<?php
	$user = $this->user_model->get_session();
	$user = $this->user_model->get_by_id(array( 'id' => $user['id'] ));
	$array_user_log = $this->user_log_model->get_array(array( 'user_id' => $user['id'], 'limit' => 3 ));
?>
<header class="bg-dark dk header navbar navbar-fixed-top-xs">
	<div class="navbar-header aside-md">
		<a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen" data-target="#nav">
			<i class="fa fa-bars"></i>
		</a>
		<a href="#" class="navbar-brand" data-toggle="fullscreen"><img src="<?php echo base_url('static/img/logo.png'); ?>" class="m-r-sm">Notebook</a>
		<a class="btn btn-link visible-xs" data-toggle="dropdown" data-target=".nav-user">
			<i class="fa fa-cog"></i>
		</a>
	</div>
	
	<ul class="nav navbar-nav hidden-xs">
		<li class="dropdown">
			<a href="#" class="dropdown-toggle dker" data-toggle="dropdown">
				<i class="fa fa-building-o"></i>
				<span class="font-bold">Activity</span>
			</a>
			
			<section class="dropdown-menu aside-xxl on animated fadeInLeft no-borders lt">
				<div class="wrapper lter m-t-n-xs">
					<a href="#" class="thumb pull-left m-r">
						<img src="<?php echo $user['thumbnail_profile_link']; ?>" class="img-circle">
					</a>
					<div class="clear">
						<a href="#"><span class="text-white font-bold"><?php echo $user['alias']; ?></span></a>
						<small class="block"><?php echo $user['fullname']; ?></small>
						<a href="#" class="btn btn-xs btn-success m-t-xs"><?php echo $user['user_type_name']; ?></a>
					</div>
				</div>
				<div class="row m-l-none m-r-none m-b-n-xs">
					<div class="col-xs">
						<div style="padding:5px;">
							<?php foreach ($array_user_log as $key => $row) { ?>
							<?php $counter = $key + 1; ?>
							<p><?php echo 'Last Login #'.$counter.' : '.$row['ip_remote'].' - '.$row['location'].' - '.$row['log_time_text']; ?></p>
							<?php } ?>
						</div>
					</div>
				</div>
			</section>
		</li>
		<li>
			<div class="m-t m-l">
				<a href="#" class="dropdown-toggle btn btn-xs btn-primary"><i class="fa fa-long-arrow-up"></i></a>
			</div>
		</li>
	</ul>
	
	<ul class="nav navbar-nav navbar-right hidden-xs nav-user">
		<li class="hidden-xs">
			<a href="#" class="dropdown-toggle dk" data-toggle="dropdown">
				<i class="fa fa-bell"></i>
				<span class="badge badge-sm up bg-danger m-l-n-sm count">0</span>
			</a>
			
			<section class="dropdown-menu aside-xl">
				<section class="panel bg-white">
					<header class="panel-heading b-light bg-light">
						<strong>You have <span class="count">0</span> notifications</strong>
					</header>
					<div class="list-group list-group-alt animated fadeInRight"></div>
					<footer class="panel-footer text-sm">
						<a href="<?php echo base_url('panel/message'); ?>">See all the notifications</a>
					</footer>
				</section>
			</section>
		</li>
		<li class="dropdown hidden-xs">
			<a href="#" class="dropdown-toggle dker" data-toggle="dropdown"><i class="fa fa-fw fa-search"></i></a>
			<section class="dropdown-menu aside-xl animated fadeInUp">
				<section class="panel bg-white">
					<form role="search" id="form-search">
						<div class="form-group wrapper m-b-none">
							<div class="input-group">
								<input type="text" class="form-control" name="search" placeholder="Search">
								<span class="input-group-btn">
									<button type="submit" class="btn btn-info btn-icon"><i class="fa fa-search"></i></button>
								</span>
							</div>
						</div>
					</form>
				</section>
			</section>
		</li>
		<li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown">
				<span class="thumb-sm avatar pull-left">
					<img src="<?php echo $user['thumbnail_profile_link']; ?>">
				</span>
				<?php echo $user['fullname']; ?> <b class="caret"></b>
			</a>
			
			<ul class="dropdown-menu animated fadeInRight">
				<span class="arrow top"></span>
				<li><a href="#">Settings</a></li>
				<li><a href="profile.html">Profile</a></li>
				<li><a href="docs.html">Help</a></li>
				<li class="divider"></li>
				<li><a href="<?php echo base_url('panel/home/logout'); ?>">Logout</a></li>
			</ul>
		</li>
	</ul>
</header>