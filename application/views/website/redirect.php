<?php
	// redirect info
	if ($this->uri->segments[2] == 'hotel-booking') {
		$array_temp = explode('-', $this->uri->segments[3]);
		$redirect = $this->hotel_booking_model->get_by_id(array( 'id' => $array_temp[0] ));
		$redirect['redirect_type'] = 'hotel-booking';
	}
	
	// widget delay
	$widget_delay = $this->widget_model->get_by_id(array( 'alias' => 'link-delay-redirect' ));
	
	// breadcrub
	$array_breadcrub = array(
		array( 'link' => '#', 'title' => 'Redirect' )
	);
?>

<?php $this->load->view( 'website/common/meta' ); ?>
<body id="top" class="thebg" >
	<?php $this->load->view( 'website/common/header_menu' ); ?>
	<?php $this->load->view( 'website/common/breadcrub', array( 'array' => $array_breadcrub ) ); ?>
	
	<div class="container">
		<div class="container mt25 offset-0">
			<div class="col-md-12 pagecontainer2 offset-0">
				
				<div class="hpadding50c">
					<p class="lato size30 slim"><?php echo $redirect['title']; ?></p>
					<p class="aboutarrow"></p>
				</div>
				<div class="line3"></div>
				
				<div style="text-align: center; padding: 30px 0 30px 25px;" id="form-redirect">
					<input type="hidden" name="action" value="broken_link" />
					<input type="hidden" name="delay" value="<?php echo $widget_delay['content']; ?>" />
					<input type="hidden" name="redirect_type" value="<?php echo $redirect['redirect_type']; ?>" />
					<input type="hidden" name="redirect_id" value="<?php echo $redirect['id']; ?>" />
					
					<div>Please wait we will send you to <?php echo $redirect['title']; ?> in <?php echo $widget_delay['content']; ?> secord, or click link below :</div>
					<a class="link-out" href="<?php echo $redirect['link']; ?>"><?php echo $redirect['link']; ?></a>
					
					<div style="padding: 20px 0 0 0;">
						<a style="padding: 6px 15px; background: #e27f7a; color: #FFFFFF;" class="broken-link">Report Broken Link</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<?php $this->load->view( 'website/common/footer' ); ?>
	<?php $this->load->view( 'website/common/library', array( 'js_add' => array( 'js-blog.js', 'lightbox.js' ) ) ); ?>

<script type="text/javascript">
	var delay = $('[name="delay"]').val() * 1000;
	setTimeout(function() {
		window.location = $('.link-out').attr('href');
	}, delay);
	
	$('.broken-link').click(function() {
		Func.update({ link: web.base + 'redirect/action', param: Site.Form.GetValue('form-redirect') });
	});
</script>
</body>
</html>