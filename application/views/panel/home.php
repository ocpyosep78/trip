<?php
	$user = $this->user_model->get_session();
	$user = $this->user_model->get_by_id(array( 'user_type_id' => $user['user_type_id'], 'id' => $user['id'] ));
	
	$page = array();
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
		}
	}
	page.init();
});
</script>

<?php $this->load->view( 'panel/common/footer'); ?>