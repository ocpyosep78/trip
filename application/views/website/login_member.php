<?php
	// breadcrub
	$array_breadcrub = array(
		array( 'link' => '#', 'title' => 'Login' ),
		array( 'link' => '#', 'title' => 'Member' )
	);
?>

<?php $this->load->view( 'website/common/meta' ); ?>
<body id="top" class="thebg">
	<?php $this->load->view( 'website/common/header_menu' ); ?>
	<?php $this->load->view( 'website/common/breadcrub', array( 'array' => $array_breadcrub ) ); ?>
	
	<div class="container">
		<div class="container mt25 offset-0">
			<div class="col-md-8 pagecontainer2 offset-0">
				<br />
				<h2 class="opensans slim green2"><div style="margin-left:20px;">Login Member</div></h2><br />
				<div class="line2"></div><br />
				
				<form class="form-class" id="form-login">
					<input type="hidden" name="action" value="login_member" />
					
					<div class="left">Email</div>
					<div class="right"><input type="text" name="email" class="form-control wh70percent" placeholder="Email" /></div>
					<div class="clearfix"></div>
					<div class="left">Password</div>
					<div class="right"><input type="password" name="passwd" class="form-control wh70percent" placeholder="Password" /></div>
					<div class="clearfix"></div>
					<div class="left">&nbsp;</div>
					<div class="right"><button type="submit" class="btn-search4">Submit</button></div>
					<div class="clearfix"></div>
					<div class="left">&nbsp;</div>
					<div class="right">
						or <a href="<?php echo base_url('register/member'); ?>">Register</a><br />
						or login via<br /><br />
						<img class="logo" alt="Travel Agency Logo" src="http://localhost/trip/trunk/static/theme/forest/images/logo.png" />
					</div>
					<div class="clearfix"></div>
				</form>
				<div class="clearfix"></div>
			</div>
			
			<div class="col-md-4">
				<?php $this->load->view( 'website/common/random_post' ); ?>
			</div>
		</div>
	</div>
	
	<?php $this->load->view( 'website/common/footer' ); ?>
	<?php $this->load->view( 'website/common/library', array( 'js_add' => array( 'js-details.js' ) ) ); ?>

<script>
$('#form-login').validate({
	rules: {
		email: { required: true, email: true },
		passwd: { required: true }
	}
});

$('#form-login').submit(function(e) {
	e.preventDefault();
	if (! $('#form-login').valid()) {
		return false;
	}
	
	var param = Site.Form.GetValue('form-login');
	Func.update({
		param: param,
		link: web.base + 'login/action',
		callback: function(result) {
			window.location = result.redirect_link;
		}
	});
});
</script>

</body>
</html>