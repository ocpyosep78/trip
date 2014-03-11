<?php
	// site & user info
	$user = $this->user_model->get_session();
	$user_count = $this->user_model->get_count(array( 'total_user' => true ));
	
	// time active
	$unix_active_time = ConvertToUnixTime($user['active_time']);
	$unix_current_limit = ConvertToUnixTime($this->config->item('current_datetime')) - LOGIN_ACTIVE_TIME;
	$left_time = $unix_active_time - $unix_current_limit;
	
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
							<small>Welcome back, <?php echo $user['fullname']; ?></small>
						</div>
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