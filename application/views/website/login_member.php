<?php $this->load->view( 'website/common/meta' ); ?>
<body id="top" class="thebg">
	<?php $this->load->view( 'website/common/header_menu' ); ?>
	
	<div class="container breadcrub">
	    <div>
			<a class="homebtn left" href="#"></a>
			<div class="left"><ul class="bcrumbs">
				<li>/</li>
				<li><a href="#">Login</a></li>
				<li>/</li>
				<li><a href="#">Member</a></li>
			</ul></div>
			<a class="backbtn right" href="#"></a>
		</div>
		<div class="clearfix"></div>
		<div class="brlines"></div>
	</div>
	
	<div class="container">
		<div class="container mt25 offset-0">
			<div class="col-md-8 pagecontainer2 offset-0"><br />
				<h2 class="opensans slim green2"><div style="margin-left:20px;">Login Member</div></h2><br />
				<p class="hpadding20">
					<div class="line2"></div>
					<div class="wh33percent left center"><br />
						<ul class="jslidetext2">
							<li>Username</li>
							<li>Password</li>
						</ul>
					</div>
					<div class="wh66percent right offset-0">
						<div class="padding20 relative wh70percent">
							<input type="text" class="form-control margtop10" placeholder="Username" />
							<input type="text" class="form-control margtop10" placeholder="Password" />
							<button type="submit" class="btn-search4 margtop20">Submit</button><br /><br />
							or login via<br /><br />
							<img class="logo" alt="Travel Agency Logo" src="http://localhost/trip/trunk/static/theme/forest/images/logo.png" />
						</div>
					</div>
					<div class="clearfix"></div>
				</p>
			</div>
			
			<div class="col-md-4" >
				<div class="pagecontainer2 testimonialbox">
					<div class="cpadding1">
						<span class="icon-location"></span>
						<h3 class="opensans">Random 3 tempat wisata sekitar malang</h3>
						<div class="clearfix"></div>
					</div>
					
					<div class="cpadding1">
						<a href="#"><img src="<?php echo base_url('static/theme/forest/images/smallthumb-1.jpg'); ?>" class="left mr20" alt=""/></a>
						<a href="#" class="dark"><b>Pemandian dudo</b></a><br /><br />
						<img src="<?php echo base_url('static/theme/forest/images/filter-rating-5.png'); ?>" alt=""/>
					</div>
					<div class="line5"></div>
					
					<div class="cpadding1">
						<a href="#"><img src="<?php echo base_url('static/theme/forest/images/smallthumb-2.jpg'); ?>" class="left mr20" alt=""/></a>
						<a href="#" class="dark"><b>Hotel Amaragua</b></a><br /><br />
						<img src="<?php echo base_url('static/theme/forest/images/filter-rating-5.png'); ?>" alt=""/>
					</div>
					<div class="line5"></div>
					
					<div class="cpadding1">
						<a href="#"><img src="<?php echo base_url('static/theme/forest/images/smallthumb-3.jpg'); ?>" class="left mr20" alt=""/></a>
						<a href="#" class="dark"><b>Hotel Amaragua</b></a><br /><br />
						<img src="<?php echo base_url('static/theme/forest/images/filter-rating-5.png'); ?>" alt=""/>
					</div>
					
					<br />
				</div>
			</div>
		</div>
	</div>
	
	<?php $this->load->view( 'website/common/footer' ); ?>
	<?php $this->load->view( 'website/common/library', array( 'js_add' => array( 'js-details.js', 'counter.js' ) ) ); ?>
</body>
</html>
