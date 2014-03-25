<?php $this->load->view( 'website/common/meta' ); ?>
<body id="top" class="thebg" >
	<?php $this->load->view( 'website/common/header_menu' ); ?>
	
	<div class="container breadcrub">
	    <div>
			<a class="homebtn left" href="#"></a>
			<div class="left">
				<ul class="bcrumbs">
					<li>/</li>
					<li><a href="#">Search</a></li>
					<li>/</li>
									
					<li><a href="#" class="active">Malang</a></li>					
				</ul>				
			</div>
			<a class="backbtn right" href="#"></a>
		</div>
		<div class="clearfix"></div>
		<div class="brlines"></div>
	</div>	

	<!-- CONTENT -->
	<div class="container">

		
		<div class="container mt25 offset-0">
			
			
			<!-- LEFT CONTENT -->
			<div class="col-md-8 pagecontainer2 offset-0">

				<div class="padding30 grey">
				
			<div class="cpadding1">
						
						<h3 class="opensans">Result of <u>Malang</u></h3>
						<div class="clearfix"></div>
					</div><br><br>
					
					
					<!-- End of first row-->
					
					 
						 		
						<div class="deal">
							<a href="details.html"><img src="static/theme/forest/images/thumb-img.jpg" alt="" class="dealthumb"/></a>
							<div class="dealtitle">
								<p><a href="details.html" class="dark">Comfort Suites Paradise Island</a></p>
								 <span class="size13 grey mt-9">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum nec semper lectus. Suspendisse placerat enim mauris, </span>
							</div>
							 				
						</div>
						<div class="deal">
							<a href="details.html"><img src="static/theme/forest/images/thumb-img.jpg" alt="" class="dealthumb"/></a>
							<div class="dealtitle">
								<p><a href="details.html" class="dark">Barcelo Malaga</a></p>
							 <span class="size13 grey mt-9">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum nec semper lectus. Suspendisse placerat enim mauris, </span>
							</div>
							 					
						</div>	
						<div class="deal">
							<a href="details.html"><img src="static/theme/forest/images/thumb-img.jpg" alt="" class="dealthumb"/></a>
							<div class="dealtitle">
								<p><a href="details.html" class="dark">Palatino Hotel</a></p>
							 <span class="size13 grey mt-9">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum nec semper lectus. Suspendisse placerat enim mauris, </span>
							</div>
						 					
						</div>				
					 
					<!-- End of first row-->
					
					
					<div class="clearfix"></div>
				 
			
			
				</div>
		
			</div>
			<!-- END OF LEFT CONTENT -->			
		  <br/>
			<!-- RIGHT CONTENT -->
			<div class="col-md-4" >
				
				<div class="pagecontainer2 paymentbox grey">
					<div class="padding30">
						Soon
					</div>
					<div class="line3"></div>
					
					 
				 


				</div><br/>
				
				 
			 
			
			</div>
			<!-- END OF RIGHT CONTENT -->
			
			
		</div>
		
		
	</div>
	<!-- END OF CONTENT -->
	
	<?php $this->load->view( 'website/common/footer' ); ?>
	
	<?php $this->load->view( 'website/common/library', array( 'js_add' => array( 'js-payment.js' ) ) ); ?>
</body>
</html>