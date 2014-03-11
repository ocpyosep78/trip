<?php
	$array_region = $this->Region_model->get_array(array( 'limit' => 50 ));
	
	// build breadcrumb
	$param_breadcrumb['title_list'][] = array( 'link' => base_url(), 'title' => 'Home', 'class' => 'first' );
	$param_breadcrumb['title_list'][] = array( 'link' => base_url(), 'title' => 'INDEX' );
	$param_breadcrumb['title_list'][] = array( 'link' => base_url(), 'title' => 'MALAYSIA ONLINE MARKET' );
?>
<?php $this->load->view('website/common/meta'); ?>
<body id="offcanvas-container" class="offcanvas-container layout-fullwidth fs12 page-product">
<section id="page" class="offcanvas-pusher" role="main">
	<?php $this->load->view('website/common/header'); ?>
	
	<section id="columns" class="offcanvas-siderbars">
		<?php $this->load->view( 'website/common/breadcrumb', $param_breadcrumb ); ?>
		
		<div class="container">
			<div class="row">
				<section class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div id="content-index">
						<div class="column col-xs-12 col-sm-6 col-lg-3-index-kanan">
							<div class="box contact-us">
								<div class="box-content">
									<div style="float:none;padding:10px 0 1px 0">Category</div>
									<ul class="links kota">
										<div style="float:left;padding:30px 1px 10px 20px;margin-bottom:20px;">
											<li style="padding: 10px 0 0 5px;"><a title="Twitter" href="https://twitter.com/" class="fa icon-twitter">&nbsp;</a>Twitter</li>
											<li style="padding: 8px 0 0 4px;"><a title="dribbble" href="http://dribbble.com/" class="fa icon-dribbble">&nbsp;</a>dribbble</li>
											<li style="padding: 7px 0 0 4px;"><a title="fa-skype" href="http://dribbble.com/" class="fa icon-skype">&nbsp;</a>dribbble</li>
										</div>
									</ul>
								</div>
							</div>
						</div>
						<div class="column col-xs-12-kota col-sm-6 col-lg-3-index">
							<div class="box contact-us">
								<div class="box-content">
									<div style="float: none; padding: 21px 0px 0px;">
									<img src="http://kedaipedia.com/static/img/kedaimalaysia.png"></div>
								</div>
							</div>
						</div>	
						<div style="float:left;margin-top:38px;">
							<?php foreach ($array_region as $row) { ?>
								<a href="<?php echo $row['region_link']; ?>"><?php echo $row['name']; ?></a>
							<?php } ?>
						</div>
					</div>
					<hr/><br /><br /><br />
				</section>
			</div>
		</div>
	</section>
	
	<?php $this->load->view('website/common/footer'); ?>
</section>

<?php $this->load->view('website/common/menu_canvas'); ?>
</body></html>