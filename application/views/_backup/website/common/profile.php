<?php
	// user page
	$user_id = (isset($user_id)) ? $user_id : 0;
	$user = $this->User_model->get_by_id(array( 'id' => $user_id ));
	$advert_count = $this->Advert_model->get_count(array( 'user_id' => $user_id ));
	
	// user session
	$is_login = $this->User_model->is_login();
	$user_session = $this->User_model->get_session();
	
	// data
	$is_follow = false;
	if ($is_login) {
		$is_follow = $this->User_Follow_model->is_follow(array( 'user_id' => @$user_session['id'], 'follow_id' => $user['id'] ));
		$is_follow = ($is_follow) ? 1 : 0;
	}
?>
<div id="cnt-profile" class="box category highlights" data-is-follow="<?php echo $is_follow; ?>" data-is-login="<?php echo ($is_login) ? 1 : 0; ?>">
	<article class="hotel-details clearfix">
		<h1>
			<?php echo $user['fullname']; ?>
			<span class="stars">.</span>
		</h1>
		<div class="address">Member Since: <?php echo GetFormatDate($user['register_date'], array( 'FormatDate' => 'd-m-Y' )); ?></div>
		<hr /><br />
		<div class="gambarprofile"> 
			<a class="landingImageWrapper-profil" href="<?php echo $user['user_link']; ?>"><img alt="<?php echo $user['fullname']; ?>" src="<?php echo $user['thumbnail_profile_link']; ?>"></a>
		</div>
	</article>
	<div class="box box-product bestseller">
		<div class="box-heading"><span>PHONE : <?php echo $user['phone']; ?></span></div>
		<div class="box-heading"><span class="cursor btn-contact" style="text-decoration: underline;">Contact Advertiser</span></div>
		<div class="box-heading hide cnt-follow"><span class="cursor btn-follow" style="text-decoration: underline;" data-user-id="<?php echo $user['id']; ?>">Follow</span></div>
		<div class="box-heading hide cnt-unfollow"><span class="cursor btn-unfollow" style="text-decoration: underline;" data-user-id="<?php echo $user['id']; ?>">Unfollow</span></div>
		<div class="box-heading"><span>Ads in the shop: <?php echo $advert_count; ?></span></div>
	</div>
</div>

<script>
var is_follow = $('#cnt-profile').data('is-follow');
if (is_follow == 1) {
	$('#cnt-profile .cnt-follow').hide();
	$('#cnt-profile .cnt-unfollow').show();
} else {
	$('#cnt-profile .cnt-follow').show();
	$('#cnt-profile .cnt-unfollow').hide();
}

$('#cnt-profile .btn-contact').click(function() {
	$('a[href="#tab-advertiser"]').click();
});

$('#cnt-profile .btn-follow').click(function() {
	// check login
	var is_login = $('#cnt-profile').data('is-login');
	if (is_login == 0) {
		window.location = web.base + 'login';
	}
	
	var element = $(this);
	var param = Site.Form.GetValue('#form-advert');
	Func.update({
		param: {
			action: 'follow',
			user_id: $(this).data('user-id')
		},
		link: web.base + 'ajax',
		callback: function(result) {
			$('#cnt-profile .cnt-follow').hide();
			$('#cnt-profile .cnt-unfollow').show();
		}
	});
});

$('#cnt-profile .btn-unfollow').click(function() {
	var element = $(this);
	var param = Site.Form.GetValue('#form-advert');
	Func.update({
		param: {
			action: 'unfollow',
			user_id: $(this).data('user-id')
		},
		link: web.base + 'ajax',
		callback: function(result) {
			$('#cnt-profile .cnt-follow').show();
			$('#cnt-profile .cnt-unfollow').hide();
		}
	});
});
</script>