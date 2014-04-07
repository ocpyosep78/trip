<?php
	$user = $this->user_model->get_session();
	$user = $this->user_model->get_by_id(array( 'user_type_id' => $user['user_type_id'], 'id' => $user['id'] ));
?>
<aside class="aside-lg bg-light lter b-r">
	<section class="vbox">
		<section class="scrollable">
			<div class="wrapper">
				<div class="clearfix m-b">
					<a href="#" class="pull-left thumb m-r">
						<img src="http://localhost/trip/trunk/static/img/avatar.jpg" class="img-circle" />
					</a>
					<div class="clear">
						<div class="h3 m-t-xs m-b-xs"><?php echo $user['full_name']; ?></div>
						<?php if (!empty($user['city_name'])) { ?>
						<small class="text-muted"><i class="fa fa-map-marker"></i> <?php echo $user['city_name'].', '.$user['region_name']; ?></small>
						<?php } ?>
					</div>
				</div>
				
				<?php
				/*
				<div class="panel wrapper panel-success">
					<div class="row">
						<div class="col-xs-4">
							<a href="#">
								<span class="m-b-xs h4 block"><?php echo $user_follow['follower']; ?></span>
								<small class="text-muted">Followers</small>
							</a>
						</div>
						<div class="col-xs-4">
							<a href="#">
								<span class="m-b-xs h4 block"><?php echo $user_follow['following']; ?></span>
								<small class="text-muted">Following</small>
							</a>
						</div>
						<div class="col-xs-4">
							<a href="#">
								<span class="m-b-xs h4 block"><?php echo $user_follow['advert']; ?></span>
								<small class="text-muted">Advert</small>
							</a>
						</div>
					</div>
				</div>
				*/
				?>
				
				<!--
				<div class="btn-group btn-group-justified m-b">
					<a class="btn btn-primary btn-rounded" data-toggle="button">
						<span class="text">
							<i class="fa fa-eye"></i> Follow
						</span>
						<span class="text-active">
							<i class="fa fa-eye-slash"></i> Following
						</span>
					</a>
					<a class="btn btn-dark btn-rounded" data-loading-text="Connecting">
						<i class="fa fa-comment-o"></i> Chat
					</a>
				</div>
				<!-- -->
				<div>
					<small class="text-uc text-xs text-muted">about me</small>
					<p><?php echo (empty($user['user_about'])) ? '-' : $user['user_about']; ?></p>
					<small class="text-uc text-xs text-muted">info</small>
					<p><?php echo (empty($user['user_info'])) ? '-' : $user['user_info']; ?></p>
					<div class="line"></div>
					<small class="text-uc text-xs text-muted">connection</small>
					<p class="m-t-sm">
						<a href="#" class="btn btn-rounded btn-twitter btn-icon"><i class="fa fa-twitter"></i></a>
						<a href="#" class="btn btn-rounded btn-facebook btn-icon"><i class="fa fa-facebook"></i></a>
						<a href="#" class="btn btn-rounded btn-gplus btn-icon"><i class="fa fa-google-plus"></i></a>
					</p>
				</div>
			</div>
		</section>
	</section>
</aside>