<?php
	// user & site info
	$user_session = $this->user_model->get_session();
	$user = $this->user_model->get_by_id(array( 'user_type_id' => $user_session['user_type_id'], 'id' => $user_session['id'] ));
	
	// content
	if (in_array($user['user_type_id'], array(USER_TYPE_ADMINISTRATOR, USER_TYPE_EDITOR))) {
		$post_count = $this->post_model->get_count(array( 'query' => true ));
		$member_count = $this->member_model->get_count(array( 'query' => true ));
		$traveler_count = $this->traveler_model->get_count(array( 'query' => true ));
	} else if ($user['user_type_id'] == USER_TYPE_MEMBER) {
		$widget = $this->widget_model->get_by_id(array( 'alias' => 'dashboard-member' ));
	} else if ($user['user_type_id'] == USER_TYPE_TRAVELER) {
		$widget = $this->widget_model->get_by_id(array( 'alias' => 'dashboard-traveler' ));
	}
	
	// time active
	$unix_active_time = ConvertToUnixTime($user_session['active_time']);
	$unix_current_limit = ConvertToUnixTime($this->config->item('current_datetime')) - LOGIN_ACTIVE_TIME;
	$left_time = $unix_active_time - $unix_current_limit;
	
	// page data
	$page['left_time'] = $left_time;
?>
<?php $this->load->view( 'panel/common/meta' ); ?>
<body>
<section class="vbox">
	<div class="hide"><div id="cnt-page"><?php echo json_encode($page); ?></div></div>
	<?php $this->load->view( 'panel/common/header' ); ?>
	
	<section>
		<section class="hbox stretch">
			<?php $this->load->view( 'panel/common/sidebar' ); ?>
			
			<section id="content">
				<section class="vbox">  
					<section class="scrollable padder">
						<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
							<li><a href="index.html"><i class="fa fa-home"></i> Home</a></li>
							<li class="active">Dashboard</li>
						</ul>
						
						<div class="m-b-md">
							<h3 class="m-b-none">Dashboard</h3>
							<small>Welcome back, <?php echo $user['full_name']; ?></small>
						</div>
						
						<?php if (in_array($user['user_type_id'], array(USER_TYPE_ADMINISTRATOR, USER_TYPE_EDITOR))) { ?>
						<section class="panel panel-default">
							<div class="row m-l-none m-r-none bg-light lter">
								<div class="col-sm-6 col-md-3 padder-v b-r b-light">
									<span class="fa-stack fa-2x pull-left m-r-sm">
										<i class="fa fa-circle fa-stack-2x text-info"></i>
										<i class="fa fa-building-o fa-stack-1x text-white"></i>
									</span>
									<a class="clear" href="#">
										<span class="h3 block m-t-xs"><strong><?php echo $member_count; ?></strong></span>
										<small class="text-muted text-uc">Member</small>
									</a>
								</div>
								
								<div class="col-sm-6 col-md-3 padder-v b-r b-light lt">
									<span class="fa-stack fa-2x pull-left m-r-sm">
										<i class="fa fa-circle fa-stack-2x text-warning"></i>
										<i class="fa fa-plane fa-stack-1x text-white"></i>
									</span>
									<a class="clear" href="#">
										<span class="h3 block m-t-xs"><strong><?php echo $traveler_count; ?></strong></span>
										<small class="text-muted text-uc">Traveler</small>
									</a>
								</div>
								
								<div class="col-sm-6 col-md-3 padder-v b-r b-light">
									<span class="fa-stack fa-2x pull-left m-r-sm">
										<i class="fa fa-circle fa-stack-2x text-success"></i>
										<i class="fa fa-check fa-stack-1x text-white"></i>
									</span>
									<a class="clear" href="#">
										<span class="h3 block m-t-xs"><strong><?php echo $post_count; ?></strong></span>
										<small class="text-muted text-uc">Post</small>
									</a>
								</div>
								
								<div class="col-sm-6 col-md-3 padder-v b-r b-light lt">
									<span class="fa-stack fa-2x pull-left m-r-sm">
										<i class="fa fa-circle fa-stack-2x icon-muted"></i>
										<i class="fa fa-clock-o fa-stack-1x text-white"></i>
									</span>
									<a class="clear" href="#">
										<span class="h3 block m-t-xs cnt-time-label"><strong>00:00</strong></span>
										<small class="text-muted text-uc">Left to exit</small>
									</a>
								</div>
							</div>
						</section>
						<?php } ?>
						
						<?php if (in_array($user['user_type_id'], array(USER_TYPE_MEMBER, USER_TYPE_TRAVELER))) { ?>
						<section class="panel panel-default">
							<div class="bg-white"><div style="padding: 20px;">
								<?php echo $widget['content']; ?>
							</div></div>
						</section>
						<?php } ?>
					</section>
				</section>
				
				<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
			</section>
		</section>
	</section>
</section>

<script>
$(document).ready(function() {
	// page
	var page = {
		init: function() {
			var raw_page = $('#cnt-page').html();
			eval('var data = ' + raw_page);
			page.data = data;
			
			page.init_time();
		},
		init_time: function() {
			setInterval(function(){
				// get minute
				var minute = Math.floor(page.data.left_time / 60);
				var second = str_pad(page.data.left_time % 60, 2, '0', 'STR_PAD_LEFT');
				var label = minute + ':' + second;
				$('.cnt-time-label strong').text(label);
				
				page.data.left_time--;
				if (page.data.left_time <= 0) {
					window.location = window.location.href;
				}
			},
			1000);
		}
	}
	page.init();
});
</script>

<?php $this->load->view( 'panel/common/footer'); ?>