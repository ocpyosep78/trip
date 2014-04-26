<?php
	// member
	$member = $this->member_model->get_by_id(array( 'alias' => $this->uri->segments[1] ));
	
	// breadcrub
	$array_breadcrub = array(
		array( 'link' => '#', 'title' => 'Member' ),
		array( 'link' => $member['link_member'], 'title' => $member['full_name'] )
	);
?>

<?php $this->load->view( 'website/common/meta' ); ?>
<body id="top" class="thebg">
	<?php $this->load->view( 'website/common/header_menu' ); ?>
	<?php $this->load->view( 'website/common/breadcrub', array( 'array' => $array_breadcrub ) ); ?>
	
<style>
.form-class { padding: 0 0 25px 0; }
.form-class .left { width: 49%; }
.form-class .right { width: 49%; padding: 6px 0 0; }
</style>
	
	<div class="container">
		<div class="container mt25 offset-0">
			<div class="col-md-8 pagecontainer2 offset-0">
				<br />
				<h2 class="opensans slim green2"><div style="margin-left:20px;">Member Information</div></h2><br />
				<div class="line2"></div><br />
				
				<form class="form-class" id="form-payment">
					<div class="center" style="padding: 0 0 25px 0;"><img src="<?php echo $member['thumbnail_link']; ?>" style="width: 30%;" /></div>
					
					<div class="left">Alias :</div>
					<div class="right"><?php echo $member['alias']; ?></div>
					<div class="clearfix"></div>
					<div class="left">First Name :</div>
					<div class="right"><?php echo $member['first_name']; ?></div>
					<div class="clearfix"></div>
					<div class="left">Last Name :</div>
					<div class="right"><?php echo $member['last_name']; ?></div>
					<div class="clearfix"></div>
					<div class="left">Address :</div>
					<div class="right"><?php echo nl2br($member['address']); ?></div>
					<div class="clearfix"></div>
					<div class="left">Postal Code :</div>
					<div class="right"><?php echo $member['postal_code']; ?></div>
					<div class="clearfix"></div>
					<div class="left">About :</div>
					<div class="right"><?php echo $member['user_about']; ?></div>
					<div class="clearfix"></div>
					<div class="left">Info :</div>
					<div class="right"><?php echo $member['user_info']; ?></div>
					<div class="clearfix"></div>
					<div class="left">Register Date :</div>
					<div class="right"><?php echo GetFormatDate($member['register_date']); ?></div>
					<div class="clearfix"></div>
				</form>
				<div class="clearfix"></div>
			</div>
			<div class="col-md-4">
				<?php $this->load->view( 'website/common/random_post' ); ?>
				<?php $this->load->view( 'website/common/visit_post', array( 'class_style' => 'mt20 alsolikebox' ) ); ?>
			</div>
		</div>
	</div>
	
	<?php $this->load->view( 'website/common/footer' ); ?>
	<?php $this->load->view( 'website/common/library', array( 'js_add' => array( 'js-details.js', 'counter.js' ) ) ); ?>
</body>
</html>