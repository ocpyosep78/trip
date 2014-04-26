<?php
	// breadcrub
	$array_breadcrub = array(
		array( 'link' => '#', 'title' => 'Payment' ),
		array( 'link' => '#', 'title' => 'Confirmation' )
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
				<h2 class="opensans slim green2"><div style="margin-left:20px;">Confirmation</div></h2><br />
				<div class="line2"></div><br />
				
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
				<?php $this->load->view( 'website/common/random_post' ); ?>
				<?php $this->load->view( 'website/common/visit_post', array( 'class_style' => 'mt20 alsolikebox' ) ); ?>
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