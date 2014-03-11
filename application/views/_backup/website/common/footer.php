<?php
	$page_static = $this->Page_Static_model->get_by_id(array( 'alias' => 'about-us' ));
?>

<footer id="footer">
	<div class="footer-top"><div class="container">
	</div></div>
	
	<div class="footer-center"><div class="container"><div class="row">
		<div class="column col-xs-12 col-sm-12 col-lg-3">
			<div class="box about-us">
				<div class="box-heading"><span>About Us</span></div>
				<div class="box-content">
					<p><span style=" line-height: 20px;"><?php echo get_length_char($page_static['content'], 150, ' ...'); ?></span></p>
					<p><a class="link-more" href="<?php echo base_url('about-us'); ?>" title="About Us"><i class="fa icon-expand">&nbsp;</i><span>view more</span></a></p>
				</div>
			</div>
		</div>
		<div class="column col-xs-12 col-sm-6 col-lg-2">
			<div class="box info">
				<div class="box-heading"><span>Information</span></div>
				<div class="box-content">
					<ul class="list">
						<li class="first"><a href="<?php echo base_url('about-us'); ?>">About Us</a></li>
						<li><a href="<?php echo base_url('delivery-information'); ?>">Delivery Information</a></li>
						<li><a href="<?php echo base_url('privacy-policy'); ?>">Privacy Policy</a></li>
						<li><a href="<?php echo base_url('terms-conditions'); ?>">Terms &amp; Conditions</a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="column col-xs-12 col-sm-6 col-lg-2">
			<div class="box extra">
				<div class="box-heading"><span>Extras</span></div>
				<div class="box-content">
					<ul class="list">
						<li class="first"><a href="<?php echo base_url('brands'); ?>">Brands</a></li>
						<li><a href="<?php echo base_url('gift-vouchers'); ?>">Gift Vouchers</a></li>
						<li class="last"><a href="<?php echo base_url('specials'); ?>">Specials</a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="column col-xs-12 col-sm-6 col-lg-3">
			<div class="box contact-us">
				<div class="box-heading"><span>Get Update</span></div>
				<div class="box-content">
				<div><form novalidate="novalidate" id="form-subscribe">
					<input name="email" type="text">
					<input name="submit" value="Send" class="send-subscribe" type="button">
				</form></div>
				
							<script type="text/javascript">
			$('#form-subscribe').validate({
				rules: { email: { required: true, email: true } }
			});
			$('.send-subscribe').click(function() {
				if (! $('#form-subscribe').valid()) {
					return false;
				}
				
				var param = { action: 'mail_subscriber', email: $('#form-subscribe [name="email"]').val() }
				Func.ajax({ url: web.host + 'ajax', param: param, callback: function(result) {
					if (result.status) {
						$.notify(result.message, "success");
						$('#form-subscribe')[0].reset();
					} else {
						$.notify(result.message, "error");
					}
				} });
			});
			</script>
				
				</div>
			</div>
		</div>
	</div></div></div>
	<p style="display: block;" id="back-top"><a href="#top"><i class="fa icon-caret-up"></i></a></p>
	<div id="powered"><div class="container">
		<div class="copyright pull-left">
			Copyright <?php echo date("Y"); ?> Powered by OpenCart.
			<!-- All Rights Reserved Designed by <a href="http://www.themeshopermarket.com/" title="pavethemes - opencart themes clubs" target="_blank">Themeshopermarket</a> -->
		</div>
		<div class="paypal pull-right"><ul class="contact-us">
			<ul class="links social">
				<li class="first"><a class="fa icon-facebook" href="http://www.facebook.com/" title="Facebook">&nbsp;</a>Facebook</li>
				<li><a class="fa icon-google-plus" href="https://plus.google.com/" title="Google">&nbsp;</a>Google</li>
				<li><a class="fa icon-twitter" href="https://twitter.com/" title="Twitter">&nbsp;</a>Twitter</li>
				<li><a class="fa icon-dribbble" href="http://dribbble.com/" title="dribbble">&nbsp;</a>dribbble</li>
				<li class="last"><a class="fa icon-youtube" href="http://www.youtube.com/" title="Youtube">&nbsp;</a>Youtube</li>
			</ul>
		</ul></div>
	</div></div>
</footer>