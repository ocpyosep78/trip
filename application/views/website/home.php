<?php $this->load->view( 'website/common/meta' ); ?>
<body id="top">
	<?php $this->load->view( 'website/common/header_menu' ); ?>
	
	<div class="fullscreen-container mtslide sliderbg fixed">
		<div style="float:none;padding:20px;"></div>
	</div>
	
	<div class="wrap cstyle03">
		<div class="container mt-130 z-index100">		
			<div class="row">
				<div class="col-md-12">
					<div class="bs-example bs-example-tabs cstyle04">
						<ul class="nav nav-tabs" id="myTab">
							<li onclick="mySelectUpdate()" class="active"><a data-toggle="tab" href="#hotel2"><span class="hotel"></span><span class="hidetext">Hotel</span>&nbsp;</a></li>
							<li onclick="mySelectUpdate()" class=""><a data-toggle="tab" href="#vacations2"><span class="suitcase"></span><span class="hidetext">Vacations</span>&nbsp;</a></li>
							<li onclick="mySelectUpdate()" class=""><a data-toggle="tab" href="#eat"><span class="suitcase"></span><span class="hidetext">Eat Place</span>&nbsp;</a></li>
							<li onclick="mySelectUpdate()" class=""><a data-toggle="tab" href="#flighthotel2"><span class="flighthotel"></span><span class="hidetext">Tiket</span>&nbsp;</a></li>
						</ul>
						<div class="tab-content2" id="myTabContent">
							<div id="hotel2" class="tab-pane fade active in" style="height: 350px;">
								<div class="col-md-44 pt-6" style="z-index: 200; position: relative;">
									<span class="opensans size18" >Where do you want to go?</span>
									<div class="cnt-typeahead">
										<input type="text" class="form-control custom-templates-typeahead" placeholder="City or Region 123" />
									</div>
								</div>
							</div>
							<div id="vacations2" class="tab-pane fade">
								<div class="col-md-44 pt-6">
									<span class="opensans size18" >Where do you want to go?</span>
									<input type="text" class="form-control" placeholder="City or Region">
								</div>
							</div>
							<div id="eat" class="tab-pane fade">
								<div class="col-md-44 pt-6">
									<span class="opensans size18" >Where do you want eat?</span>
									<input type="text" class="form-control" placeholder="City or Region">
								</div>
							</div>
							<div id="flighthotel2" class="tab-pane fade">
								<div class="col-md-4">HTML widget..	soon..</div>
							</div>
						</div>
						<div class="searchbg2">
							<!-- <div class="left ca01"><a href="#">Advanced +</a></div> -->
							<form action="<?php echo base_url('search'); ?>">
								<button type="submit" class="btn-search right mr30">Search</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="lastminute2 lcfix">
			<div class="container lmc">	
				<img src="<?php echo base_url('static/theme/forest/images/rating-4.png'); ?>" alt=""/><br />
				LAST MINUTE: <b>Barcelona</b> - 2 nights - Flight+4* Hotel, Dep 27h Aug from $209/person<br />
				<form action="list4.html">
					<button class="btn iosbtn" type="submit">Read more</button>
				</form>
			</div>
		</div>
		
		<div class="footerbg sfix2">
			<div class="container">		
				<footer>
					<div class="footer">
						<a href="#" class="social1"><img src="static/theme/forest/images/icon-facebook.png" alt=""/></a>
						<a href="#" class="social2"><img src="static/theme/forest/images/icon-twitter.png" alt=""/></a>
						<a href="#" class="social3"><img src="static/theme/forest/images/icon-gplus.png" alt=""/></a>
						<a href="#" class="social4"><img src="static/theme/forest/images/icon-youtube.png" alt=""/></a>
						<br /><br />
						
						Copyright &copy; <?php echo date("Y"); ?> <a href="<?php echo base_url(); ?>">Travel Agency</a> All rights reserved.
						<br /><br />
						
						<a href="#top" id="gotop2" class="gotop"><img src="<?php echo base_url('static/theme/forest/images/spacer.png'); ?>" alt=""/></a>
					</div>
				</footer>
			</div>	
		</div>
	</div>
	
	<?php $this->load->view( 'website/common/library' ); ?>
</body>
</html>