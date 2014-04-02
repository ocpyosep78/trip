<?php
	// breadcrub
	$array_breadcrub = array(
		array( 'link' => '#', 'title' => 'Payment' ),
		array( 'link' => '#', 'title' => 'Confirmation' )
	);
?>

<?php $this->load->view( 'website/common/meta' ); ?>
<style>
.form-class .left { float: left; width: 33%; padding: 6px 0 0 0; text-align: right; }
.form-class .right { float: right; width: 66%; padding: 0 0 10px 20px; }
.form-class label.error { font-size: 10px; color: #F25D2E; padding: 5px 0 0 0; }
</style>
<body id="top" class="thebg">
	<?php $this->load->view( 'website/common/header_menu' ); ?>
	<?php $this->load->view( 'website/common/breadcrub', array( 'array' => $array_breadcrub ) ); ?>
	
	<div class="container">
		<div class="container mt25 offset-0">
			<div class="col-md-8 pagecontainer2 offset-0">
				<br />
				<h2 class="opensans slim green2"><div style="margin-left:20px;">Confirmation</div></h2><br />
				<div class="line2"></div>
				
				<form class="form-class" id="form-payment">
					<input type="hidden" name="action" value="payment_update" />
					
					<div class="left">Post Title</div>
					<div class="right"><input type="text" name="post_title" class="form-control wh70percent" placeholder="Post Title" /></div>
					<div class="clearfix"></div>
					<div class="left">Email</div>
					<div class="right"><input type="text" name="email" class="form-control wh70percent" placeholder="Email" /></div>
					<div class="clearfix"></div>
					<div class="left">Nama Pemilik Rekening</div>
					<div class="right"><input type="text" name="sender" class="form-control wh70percent" placeholder="Nama Pemilik Rekening" /></div>
					<div class="clearfix"></div>
					<div class="left">Pembayaran dari bank</div>
					<div class="right"><input type="text" name="bank_from" class="form-control wh70percent" placeholder="Pembayaran dari bank" /></div>
					<div class="clearfix"></div>
					<div class="left">Bank Tujuan</div>
					<div class="right"><input type="text" name="bank_to" class="form-control wh70percent" placeholder="Bank Tujuan" /></div>
					<div class="clearfix"></div>
					<div class="left">Jumlah Dana</div>
					<div class="right"><input type="text" name="transfer_count" class="form-control wh70percent" placeholder="Jumlah Dana" /></div>
					<div class="clearfix"></div>
					<div class="left">Tanggal Pembayaran</div>
					<div class="right"><input type="text" name="transfer_date" class="form-control wh70percent datepicker" placeholder="Tanggal Pembayaran" /></div>
					<div class="clearfix"></div>
					<div class="left">Keterangan</div>
					<div class="right"><textarea name="content" class="form-control wh70percent" rows="3" placeholder="Keterangan"></textarea></div>
					<div class="clearfix"></div>
					<div class="left">&nbsp;</div>
					<div class="right"><button type="submit" class="btn-search4">Submit</button></div>
					<div class="clearfix"></div>
				</form>
				<div class="clearfix"></div>
			</div>
			<div class="col-md-4">
				<div class="pagecontainer2 testimonialbox">
					<div class="cpadding1">
							<span class="icon-location"></span>
							<h3 class="opensans">My Experince</h3>
							<div class="clearfix"></div>
						</div>
						<div class="hpadding20">
						 
						<a href="#" class="booknow margtop20 btnmarg">Upload Your Photo</a><br /><br />
					</div>
				</div>
				<div class="pagecontainer2 mt20 alsolikebox">
					<div class="cpadding1">
						<span class="icon-location"></span>
						<h3 class="opensans">Random 3 tempat wisata sekitar malang</h3>
						<div class="clearfix"></div>
					</div>
					<div class="cpadding1 ">
						<a href="#"><img src="<?php echo base_url('static/theme/forest/images/smallthumb-1.jpg'); ?>" class="left mr20" alt=""/></a>
						<a href="#" class="dark"><b>Pemandian dudo</b></a><br />
					 <br />
						<img src="<?php echo base_url('static/theme/forest/images/filter-rating-5.png'); ?>" alt=""/>
					</div>
					<div class="line5"></div>
					<div class="cpadding1 ">
						<a href="#"><img src="<?php echo base_url('static/theme/forest/images/smallthumb-2.jpg'); ?>" class="left mr20" alt=""/></a>
						<a href="#" class="dark"><b>Hotel Amaragua</b></a><br />
						 <br />
						<img src="<?php echo base_url('static/theme/forest/images/filter-rating-5.png'); ?>" alt=""/>
					</div>
					<div class="line5"></div>			
					<div class="cpadding1 ">
						<a href="#"><img src="<?php echo base_url('static/theme/forest/images/smallthumb-3.jpg'); ?>" class="left mr20" alt=""/></a>
						<a href="#" class="dark"><b>Hotel Amaragua</b></a><br />
					 <br />
						<img src="<?php echo base_url('static/theme/forest/images/filter-rating-5.png'); ?>" alt=""/>
					</div>
					<br />
				</div>
			</div>
		</div>
	</div>
	
	<?php $this->load->view( 'website/common/footer' ); ?>
	<?php $this->load->view( 'website/common/library', array( 'js_add' => array( 'js-details.js', 'counter.js' ) ) ); ?>

<script>
$('#form-payment').validate({
	rules: {
		post_title: { required: true },
		email: { required: true, email: true },
		sender: { required: true },
		bank_from: { required: true },
		bank_to: { required: true },
		transfer_count: { required: true },
		transfer_date: { required: true }
	}
});

$('#form-payment').submit(function(e) {
	e.preventDefault();
	if (! $('#form-payment').valid()) {
		return false;
	}
	
	var param = Site.Form.GetValue('form-payment');
	Func.update({
		param: param,
		link: web.base + 'payment/action',
		callback: function(result) {
			$('#form-payment')[0].reset();
		}
	});
});
</script>
</body>
</html>