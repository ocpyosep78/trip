<?php
	// breadcrub
	$array_breadcrub = array(
		array( 'link' => '#', 'title' => 'Register' ),
		array( 'link' => '#', 'title' => 'Traveler' )
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
				<h2 class="opensans slim green2"><div style="margin-left:20px;">Register Traveler</div></h2><br />
				<div class="line2"></div><br />
				
				<form class="form-class" id="form-register">
					<input type="hidden" name="action" value="register_traveler" />
					<div class="left">Email</div>
					<div class="right"><input type="text" name="email" class="form-control wh70percent" placeholder="Email" /></div>
					<div class="clearfix"></div>
					<div class="left">Alias</div>
					<div class="right"><input type="text" name="alias" class="form-control wh70percent" placeholder="Alias" /></div>
					<div class="clearfix"></div>
					<div class="left">First Name</div>
					<div class="right"><input type="text" name="first_name" class="form-control wh70percent" placeholder="First Name" /></div>
					<div class="clearfix"></div>
					<div class="left">Last Name</div>
					<div class="right"><input type="text" name="last_name" class="form-control wh70percent" placeholder="Last Name" /></div>
					<div class="clearfix"></div>
					<div class="left">Address</div>
					<div class="right"><textarea name="address" class="form-control wh70percent" placeholder="Address"></textarea></div>
					<div class="clearfix"></div>
					<div class="left">Phone</div>
					<div class="right"><input type="text" name="phone" class="form-control wh70percent" placeholder="Phone" /></div>
					<div class="clearfix"></div>
					<div class="left">Password</div>
					<div class="right"><input type="password" name="passwd" class="form-control wh70percent" placeholder="Password" id="passwd" /></div>
					<div class="clearfix"></div>
					<div class="left">Password Confirm</div>
					<div class="right"><input type="password" name="passwd_check" class="form-control wh70percent" placeholder="Password Confirm" /></div>
					<div class="clearfix"></div>
					<div class="left">&nbsp;</div>
					<div class="right"><button type="submit" class="btn-search4">Submit</button></div>
					<div class="clearfix"></div>
					<div class="left">&nbsp;</div>
					<div class="right">
						or <a href="<?php echo base_url('login/traveler'); ?>">Login</a><br />
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
$('#form-register').validate({
	rules: {
		email: { required: true, email: true },
		alias: { required: true, no_special_char: true },
		first_name: { required: true },
		passwd: { required: true },
		passwd_check: { required: true, equalTo: "#passwd" }
	}
});

$('#form-register').submit(function(e) {
	e.preventDefault();
	if (! $('#form-register').valid()) {
		return false;
	}
	
	var param = Site.Form.GetValue('form-register');
	Func.update({
		param: param,
		link: web.base + 'register/action',
		callback: function(result) {
			$('#form-register')[0].reset();
		}
	});
});
</script>

</body>
</html>