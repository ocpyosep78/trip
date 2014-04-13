<?php
	// user
	$is_login = $this->user_model->is_login();
	if ($is_login) {
		$user_session = $this->user_model->get_session();
		$user = $this->user_model->get_by_id(array( 'user_type_id' => $user_session['user_type_id'], 'id' => $user_session['id'] ));
	}
	
	// post
	$post = $this->post_model->get_by_id(array( 'city_alias' => $this->uri->segments[3], 'alias' => $this->uri->segments[4] ));
	
	// breadcrub
	$array_breadcrub = array(
		array( 'link' => $post['link_category'], 'title' => $post['category_title'] ),
		array( 'link' => $post['link_region'], 'title' => $post['region_title'] ),
		array( 'link' => $post['link_city'], 'title' => $post['city_title'] ),
		array( 'link' => $post['link_post'], 'title' => $post['title_select'] ),
		array( 'link' => $post['link_post_upload'], 'title' => 'Upload' )
	);
?>

<?php $this->load->view( 'website/common/meta' ); ?>
<body id="top" class="thebg">
	<?php $this->load->view( 'website/common/header_menu' ); ?>
	<?php $this->load->view( 'website/common/breadcrub', array( 'array' => $array_breadcrub ) ); ?>
	<div class="hide">
		<iframe name="iframe_thumbnail" src="<?php echo base_url('panel/upload?callback_name=set_thumbnail'); ?>"></iframe>
	</div>
	
	<div class="container">
		<div class="container mt25 offset-0">
			<div class="col-md-8 pagecontainer2 offset-0">
				<br />
				<h2 class="opensans slim green2"><div style="margin-left:20px;">Upload <?php echo $post['title_select']; ?></div></h2><br />
				<div class="line2"></div><br />
				
				<?php if ($is_login && $user['user_type_id'] == USER_TYPE_TRAVELER) { ?>
				<form class="form-class" id="form-upload">
					<input type="hidden" name="action" value="traveler_photo_update" />
					<input type="hidden" name="post_id" value="<?php echo $post['id']; ?>" />
					<input type="hidden" name="thumbnail" value="" />
					
					<div style="padding: 0 0 20px 0; text-align: center;">
						<img src="<?php echo base_url('static/img/browse-photo.png'); ?>" style="width: 250px;" class="browse-thumbnail" />
					</div>
					
					<div class="left">Title</div>
					<div class="right"><input type="text" name="title" class="form-control wh70percent" placeholder="Title" /></div>
					<div class="clearfix"></div>
					<div class="left">Content</div>
					<div class="right"><textarea name="content" class="form-control wh70percent" rows="3" placeholder="Content"></textarea></div>
					<div class="clearfix"></div>
					<div class="left">&nbsp;</div>
					<div class="right"><button type="submit" class="btn-search4">Submit</button></div>
					<div class="clearfix"></div>
				</form>
				<div class="clearfix"></div>
				<?php } else { ?>
				<div class="center" style="margin: 45px 0;">
					<a class="btn-search4" href="<?php echo base_url('login/traveler'); ?>">Please login as Traveler to upload your photo</a>
				</div>
				<?php } ?>
			</div>
			<div class="col-md-4">
				<?php $this->load->view( 'website/common/random_post' ); ?>
			</div>
		</div>
	</div>
	
	<?php $this->load->view( 'website/common/footer' ); ?>
	<?php $this->load->view( 'website/common/library', array( 'js_add' => array( 'js-details.js', 'counter.js' ) ) ); ?>

<script>
var default_image = $('.browse-thumbnail').attr('src');

// upload
$('.browse-thumbnail').click(function() { window.iframe_thumbnail.browse() });
set_thumbnail = function(p) {
	$('.browse-thumbnail').attr('src', p.file_link);
	$('#form-upload [name="thumbnail"]').val(p.file_name);
}

$('#form-upload').validate({
	rules: {
		title: { required: true }
	}
});

$('#form-upload').submit(function(e) {
	e.preventDefault();
	if (! $('#form-upload').valid()) {
		return false;
	}
	
	var param = Site.Form.GetValue('form-upload');
	if (param.thumbnail.length == 0) {
		$.notify("Please upload your photo.", "error");
		return false;
	}
	
	Func.update({
		param: param,
		link: window.location.href + '/action',
		callback: function(result) {
			$('#form-upload')[0].reset();
			$('.browse-thumbnail').attr('src', default_image);
		}
	});
});
</script>
</body>
</html>