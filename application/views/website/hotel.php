<?php $this->load->view( 'website/common/meta' ); ?>
<body id="top" class="thebg" >
    
	
	<!-- Top wrapper -->
	<div class="navbar-wrapper2 navbar-fixed-top">
 <!--	<div class="container lmc">	
				 <div style="float: right; background-color: rgb(187, 51, 0); height: 25px; padding: 3px;">
				 Login | Language
				 </div>
			</div>  -->
	
      <div class="container"> 
		<div class="navbar">
	 
 
			<div class="container offset-3">
			  <!-- Navigation-->
			  <div class="navbar-header">
				<button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
				  <span class="icon-bar"></span>
				  <span class="icon-bar"></span>
				  <span class="icon-bar"></span>
				</button>
				<a href="index.html" class="navbar-brand"><img src="static/theme/forest/images/logo.png" alt="Travel Agency Logo" class="logo"/></a>
			  </div>
			 

			  <div class="navbar-collapse collapse">
			  
			  			   	
			<ul class="nav navbar-nav navbar-right">
			  <li><a href="#">Home</a></li>
			   <li><a href="#">Hotel</a></li>
			    <li><a href="#">Destination</a></li>
				 <li><a href="#">Eat Place</a></li>
				 
				 	 	  <li class="dropdown">
					<a data-toggle="dropdown" class="dropdown-toggle" href="#">Language<b class="lightcaret mt-2"></b></a>
					<ul class="dropdown-menu">
					   
					  <li><a href="#">English</a></li>
					  <li><a href="#">Indonesia</a></li>
					   <li><a href="#">Malaysia</a></li>
					</ul>
				  </li>		  
				  			  
				 
				   <li><a href="#">Login</a></li>	
			 <li><div style="float:none;margin-top:7px;width:95%">
 <input type="text" class="form-control" placeholder="Search">
 </div>
 </li>
				 
			</ul>
				 
			  
				<ul class="nav navbar-nav navbar-right">
				 
		
				 
					
				</ul>
			  </div>
			  
			   
			  
			  <!-- /Navigation-->			  
			</div>
		
        </div>
		
      </div><div style="background-color:#b30;border-bottom:1px inset #b30;"> 
			  </div>
    </div>
	<!-- /Top wrapper -->

	
	<div class="container breadcrub">
	    <div>
			<a class="homebtn left" href="#"></a>
			<div class="left">
				<ul class="bcrumbs">
					<li>/</li>
					<li><a href="#">Hotel</a></li>
					<li>/</li>
					<li><a href="#">Jawa Timur</a></li>
					<li>/</li>	
                 					
					<li><a href="#" class="active">Malang Kab</a></li>					
				</ul>				
			</div>
			<a class="backbtn right" href="#"></a>
		</div>
		<div class="clearfix"></div>
		<div class="brlines"></div>
	</div>	

	<!-- CONTENT -->
	<div class="container">
		<div class="container pagecontainer offset-0">	

			<!-- FILTERS -->
			<div class="col-md-3 filters offset-0">
			
				
				<!-- TOP TIP -->
				<div class="filtertip">
					<div class="padding20">
						<p class="size13"><span class="size18 bold counthotel">53</span> Hotels starting at</p>
						<p class="size30 bold">$<span class="countprice"></span></p>
						<p class="size13">Narrow results or <a href="#">view all</a></p>
					</div>
					<div class="tip-arrow"></div>
				</div>
				
				 	
				<div class="padding20title"><h3 class="opensans dark">Type</h3></div>
				<div class="line2"></div>
				
				<div class="hpadding20">
						<div class="radio">
						  <label>
							<input type="radio" name="optionsRadios2" id="Acomodation1" value="option1" checked>
							All
						  </label>
						</div>
						<div class="radio">
						  <label>
							<input type="radio" name="optionsRadios2" id="Acomodation2" value="option2">
							Hotel Berbintang
						  </label>
						</div>
						<div class="radio">
						  <label>
							<input type="radio" name="optionsRadios2" id="Acomodation3" value="option3">
							Hotel Murah
						  </label>
						</div>
						<div class="radio">
						  <label>
							<input type="radio" name="optionsRadios2" id="Acomodation4" value="option4">
							Guest House
						  </label>
						</div>
						<div class="radio">
						  <label>
							<input type="radio" name="optionsRadios2" id="Acomodation5" value="option5">
							Villa
						  </label>
						</div>
 
					</div>

					<div class="padding20title"><h3 class="opensans dark">Area</h3></div>
				<div class="line2"></div>
<br>
					<div class="hpadding20"> 
						 	<select class="form-control mySelectBoxClass ">
									  <option selected>All Region</option>
									  <option>5 stars</option>
									  <option>4 stars</option>
									  <option>3 stars</option>
									  <option>2 stars</option>
									  <option>1 stars</option>
									</select>
					</div>
					<div class="clearfix"></div>
				  
				 
				 <br>
				 					<div class="hpadding20"> 
						 	<select class="form-control mySelectBoxClass ">
									  <option selected>All City</option>
									  <option>5 stars</option>
									  <option>4 stars</option>
									  <option>3 stars</option>
									  <option>2 stars</option>
									  <option>1 stars</option>
									</select>
					</div>
			
				 
				 
				 		<div class="padding20title"><h3 class="opensans dark">Star</h3></div>
				<div class="line2"></div>
<br>
					<div class="hpadding20"> 
						 	<select class="form-control mySelectBoxClass ">
									  <option selected>All Region</option>
									  <option>5 stars</option>
									  <option>4 stars</option>
									  <option>3 stars</option>
									  <option>2 stars</option>
									  <option>1 stars</option>
									</select>
					</div>
					<div class="clearfix"></div>
				  	 <br>
				 
				 
				<!-- End of Star ratings -->								
 
 
				<div class="line2"></div>
				
				
				<!-- Price range -->					
				<button type="button" class="collapsebtn" data-toggle="collapse" data-target="#collapse2">
				  Price range <span class="collapsearrow"></span>
				</button>
					
				<div id="collapse2" class="collapse in">
					<div class="padding20">
						<div class="layout-slider wh100percent">
						<span class="cstyle09"><input id="Slider1" type="slider" name="price" value="400;700" /></span>
						</div>
						<script type="text/javascript" >
						  jQuery("#Slider1").slider({ from: 5, to: 2000, step: 5, smooth: true, round: 0, dimension: "&nbsp;$", skin: "round" });
						</script>
					</div>
				</div>
				<!-- End of Price range -->	
				
				<div class="line2"></div>
				
				<!-- Hotel Preferences -->
				<button type="button" class="collapsebtn last" data-toggle="collapse" data-target="#collapse4">
				  Fasilities <span class="collapsearrow"></span>
				</button>	
				<div id="collapse4" class="collapse in">
					<div class="hpadding20">
						<div class="checkbox">
							<label>
							  <input type="checkbox">High-speed Internet (41)
							</label>
						</div>
						<div class="checkbox">
							<label>
							  <input type="checkbox">Air conditioning (52)
							</label>
						</div>
						<div class="checkbox">
							<label>
							  <input type="checkbox">Swimming pool (55)
							</label>
						</div>
						<div class="checkbox">
							<label>
							  <input type="checkbox">Childcare (12)
							</label>
						</div>
						<div class="checkbox">
							<label>
							  <input type="checkbox">Fitness equipment (49)
							</label>
						</div>	
						<div class="checkbox">
							<label>
							  <input type="checkbox">Free breakfast (14)
							</label>
						</div>	
						<div class="checkbox">
							<label>
							  <input type="checkbox">Free parking (11)
							</label>
						</div>	
						<div class="checkbox">
							<label>
							  <input type="checkbox">Hair dryer (48)
							</label>
						</div>	
						<div class="checkbox">
							<label>
							  <input type="checkbox">Pets allowed (16)
							</label>
						</div>	
						<div class="checkbox">
							<label>
							  <input type="checkbox">Restaurant in hotel (47)
							</label>
						</div>	
						<div class="checkbox">
							<label>
							  <input type="checkbox">Room service (38)
							</label>
						</div>	
						<div class="checkbox">
							<label>
							  <input type="checkbox">Spa services on site (57) 
							</label>
						</div>	

					</div>
					 						
				</div>	
				<!-- End of Hotel Preferences -->
				
				<div class="line2"></div>
				<div class="clearfix"></div>
			 
					<div class="padding20title"><h3 class="opensans dark">Tags</h3></div>
				<div class="line2"></div>
<br>
					<div class="hpadding20"> 
						 	<label>
							 <a href="#"> Batu Night Spektaculer (12) <a>
							</label>
							<div class="clearfix"></div>
							<label>
							  <a href="#"> Batu Mosque (10) <a>
							</label>
					</div>
					<div class="clearfix"></div>
				  
				<br/>
				<br><br>
				
			</div>
			<!-- END OF FILTERS -->
			<!-- END OF FILTERS -->
			
			<!-- LIST CONTENT-->
			<div class="rightcontent col-md-9 offset-0">
			
				<div class="hpadding20">
					<!-- Top filters -->
					<div class="topsortby">
						<div class="col-md-4 offset-0">
								
								<div class="left mt7"><b>Sort by:</b></div>
								
								<div class="right wh70percent">
									<select class="form-control mySelectBoxClass ">
                                      <option>All</option>  									  
									  <option>Promo</option>
									  <option>A to Z</option>
									  <option>Z to A</option>
									  <option>Top Review</option>
									</select>
								</div>
								

						</div>	
	                   <div class="col-md-4">
								
								<div class="left mt7"><b>Show:</b></div>
								
								<div class="right wh70percent">
									<select class="form-control mySelectBoxClass ">
                                       <option>10</option>
									  <option>20</option>
									  <option>30</option>
									   <option>40</option>
									    <option>50</option>
									</select>
								</div>
								

						</div>						
						 
						 
					</div>
					<!-- End of topfilters-->
				</div>
				<!-- End of padding -->
				
				<br/><br/>
				<div class="clearfix"></div>
				

				<div class="itemscontainer offset-1">

				
					<div class="col-md-4">
						<div class="listitem">
							<img src="http://www.baligetaway.co.id/images/uploads/BALI_GETAWAY-KUTA_CENTRAL_PARK_HOTEL_01.jpg" alt=""/>
						 
						</div>
						<div class="itemlabel2">
							<div class="labelright">
								<img src="static/theme/forest/images/filter-rating-5.png" width="60" alt=""/><br/><br/><br/>
							<br/>
								<span class="size11 grey"> PROMO</span><br/><br/>
							 
								<button class="bookbtn mt1">View</button>		
							</div>
							<div class="labelleft">			
								<b>Hotel Tugu </b><br/><br/><br/>
								<p class="grey"><b>Desc hotel Tugu di potong </b>Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br/><br/>
								Vestibulum vel risus at lectus rhoncus mattis. Sed id enim eu or</p>
							</div>
						</div>
					</div>
					<div class="col-md-4">
											<div class="listitem">
							<img src="http://www.baligetaway.co.id/images/uploads/BALI_GETAWAY-KUTA_CENTRAL_PARK_HOTEL_01.jpg" alt=""/>
						 
						</div>
						<div class="itemlabel2">
							<div class="labelright">
								<!-- Kosong --><br/><br/><br/>
								<img src="static/theme/forest/images/user-rating-5.png" width="60" alt=""/><br/>
								<span class="size11 grey">18 Reviews</span><br/><br/>
								 
								<button class="bookbtn mt1">View</button>		
							</div>
							<div class="labelleft">			
								<b>Mabely Grand Hotel</b><br/><br/><br/>
								<p class="grey">Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br/><br/>
								Vestibulum vel risus at lectus rhoncus mattis. Sed id enim eu orci rhoncus malesuada.</p>
							</div>
						</div>
					</div>
					<div class="col-md-4">
											<div class="listitem">
							<img src="http://www.baligetaway.co.id/images/uploads/BALI_GETAWAY-KUTA_CENTRAL_PARK_HOTEL_01.jpg" alt=""/>
						 
						</div>
						<div class="itemlabel2">
							<div class="labelright">
								<!-- Kosong --><br/><br/><br/>
								<img src="static/theme/forest/images/user-rating-5.png" width="60" alt=""/><br/>
								<span class="size11 grey">18 Reviews</span><br/><br/>
							 
								<button class="bookbtn mt1">View</button>		
							</div>
							<div class="labelleft">			
								<b>Mabely Grand Hotel</b><br/><br/><br/>
								<p class="grey">Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br/><br/>
								Vestibulum vel risus at lectus rhoncus mattis. Sed id enim eu orci rhoncus malesuada.</p>
							</div>
						</div>				
					</div>

					<div class="clearfix"></div>
					<div class="offset-2"><hr class="featurette-divider3"></div>
					
					<div class="col-md-4">
												<div class="listitem">
							<img src="http://www.baligetaway.co.id/images/uploads/BALI_GETAWAY-KUTA_CENTRAL_PARK_HOTEL_01.jpg" alt=""/>
						 
						</div>
						<div class="itemlabel2">
							<div class="labelright">
								<!-- Kosong --><br/><br/><br/>
								<img src="static/theme/forest/images/user-rating-5.png" width="60" alt=""/><br/>
								 
								<span class="size11 grey">avg/night</span><br/><br/><br/>
								<button class="bookbtn mt1">View</button>		
							</div>
							<div class="labelleft">			
								<b>Mabely Grand Hotel</b><br/><br/><br/>
								<p class="grey">Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br/><br/>
								Vestibulum vel risus at lectus rhoncus mattis. Sed id enim eu orci rhoncus malesuada.</p>
							</div>
						</div>
					</div>
					<div class="col-md-4">
												<div class="listitem">
							<img src="http://www.baligetaway.co.id/images/uploads/BALI_GETAWAY-KUTA_CENTRAL_PARK_HOTEL_01.jpg" alt=""/>
						 
						</div>
						<div class="itemlabel2">
							<div class="labelright">
								<!-- Kosong --><br/><br/><br/>
								<img src="static/theme/forest/images/user-rating-5.png" width="60" alt=""/><br/>
								<span class="size11 grey">18 Reviews</span><br/><br/>
								 
								<button class="bookbtn mt1">View</button>		
							</div>
							<div class="labelleft">			
								<b>Mabely Grand Hotel</b><br/><br/><br/>
								<p class="grey">Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br/><br/>
								Vestibulum vel risus at lectus rhoncus mattis. Sed id enim eu orci rhoncus malesuada.</p>
							</div>
						</div>
					</div>
					<div class="col-md-4">
											<div class="listitem">
							<img src="http://www.baligetaway.co.id/images/uploads/BALI_GETAWAY-KUTA_CENTRAL_PARK_HOTEL_01.jpg" alt=""/>
						 
						</div>
						<div class="itemlabel2">
							<div class="labelright">
								<!-- Kosong --><br/><br/><br/>
								<img src="static/theme/forest/images/user-rating-5.png" width="60" alt=""/><br/>
								<span class="size11 grey">18 Reviews</span><br/><br/>
								 
								<button class="bookbtn mt1">View</button>		
							</div>
							<div class="labelleft">			
								<b>Mabely Grand Hotel</b><br/><br/><br/>
								<p class="grey">Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br/><br/>
								Vestibulum vel risus at lectus rhoncus mattis. Sed id enim eu orci rhoncus malesuada.</p>
							</div>
						</div>				
					</div>
					
					<div class="clearfix"></div>
					<div class="offset-2"><hr class="featurette-divider3"></div>
					
					<div class="col-md-4">
												<div class="listitem">
							<img src="http://www.baligetaway.co.id/images/uploads/BALI_GETAWAY-KUTA_CENTRAL_PARK_HOTEL_01.jpg" alt=""/>
						 
						</div>
						<div class="itemlabel2">
							<div class="labelright">
								<!-- Kosong --><br/><br/><br/>
								<img src="static/theme/forest/images/user-rating-5.png" width="60" alt=""/><br/>
								<span class="size11 grey">18 Reviews</span><br/><br/>
								 
								<button class="bookbtn mt1">View</button>		
							</div>
							<div class="labelleft">			
								<b>Mabely Grand Hotel</b><br/><br/><br/>
								<p class="grey">Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br/><br/>
								Vestibulum vel risus at lectus rhoncus mattis. Sed id enim eu orci rhoncus malesuada.</p>
							</div>
						</div>
					</div>
					<div class="col-md-4">
												<div class="listitem">
							<img src="http://www.baligetaway.co.id/images/uploads/BALI_GETAWAY-KUTA_CENTRAL_PARK_HOTEL_01.jpg" alt=""/>
						 
						</div>
						<div class="itemlabel2">
							<div class="labelright">
								<!-- Kosong --><br/><br/><br/>
								<img src="static/theme/forest/images/user-rating-5.png" width="60" alt=""/><br/>
								<span class="size11 grey">18 Reviews</span><br/><br/>
								 
								<button class="bookbtn mt1">View</button>		
							</div>
							<div class="labelleft">			
								<b>Mabely Grand Hotel</b><br/><br/><br/>
								<p class="grey">Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br/><br/>
								Vestibulum vel risus at lectus rhoncus mattis. Sed id enim eu orci rhoncus malesuada.</p>
							</div>
						</div>
					</div>
					<div class="col-md-4">
												<div class="listitem">
							<img src="http://www.baligetaway.co.id/images/uploads/BALI_GETAWAY-KUTA_CENTRAL_PARK_HOTEL_01.jpg" alt=""/>
						 
						</div>
						<div class="itemlabel2">
							<div class="labelright">
								<!-- Kosong --><br/><br/><br/>
								<img src="static/theme/forest/images/user-rating-5.png" width="60" alt=""/><br/>
								<span class="size11 grey">18 Reviews</span><br/><br/>
								 
								<button class="bookbtn mt1">View</button>		
							</div>
							<div class="labelleft">			
								<b>Mabely Grand Hotel</b><br/><br/><br/>
								<p class="grey">Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br/><br/>
								Vestibulum vel risus at lectus rhoncus mattis. Sed id enim eu orci rhoncus malesuada.</p>
							</div>
						</div>				
					</div>
					
					<div class="clearfix"></div>
					<div class="offset-2"><hr class="featurette-divider3"></div>

				</div>	
				<!-- End of offset1-->		

				<div class="hpadding20">
				
					<ul class="pagination right paddingbtm20">
					  <li class="disabled"><a href="#">&laquo;</a></li>
					  <li><a href="#">1</a></li>
					  <li><a href="#">2</a></li>
					  <li><a href="#">3</a></li>
					  <li><a href="#">4</a></li>
					  <li><a href="#">5</a></li>
					  <li><a href="#">&raquo;</a></li>
					</ul>

				</div>

			</div>
			<!-- END OF LIST CONTENT-->
			
		

		</div>
		<!-- END OF container-->
		
	</div>
	<!-- END OF CONTENT -->
	


	
	
	<!-- FOOTER -->

	<div class="footerbgblack">
		<div class="container">		
			
			<div class="col-md-3">
				<span class="ftitleblack">Let's socialize</span>
				<div class="scont">
					<a href="#" class="social1b"><img src="static/theme/forest/images/icon-facebook.png" alt=""/></a>
					<a href="#" class="social2b"><img src="static/theme/forest/images/icon-twitter.png" alt=""/></a>
					<a href="#" class="social3b"><img src="static/theme/forest/images/icon-gplus.png" alt=""/></a>
					<a href="#" class="social4b"><img src="static/theme/forest/images/icon-youtube.png" alt=""/></a>
					<br/><br/><br/>
					<a href="#"><img src="static/theme/forest/images/logosmal2.png" alt="" /></a><br/>
					<span class="grey2">&copy; 2013  |  <a href="#">Privacy Policy</a><br/>
					All Rights Reserved </span>
					<br/><br/>
					
				</div>
			</div>
			<!-- End of column 1-->
			
			<div class="col-md-3">
				<span class="ftitleblack">Travel Specialists</span>
				<br/><br/>
				<ul class="footerlistblack">
					<li><a href="#">Golf Vacations</a></li>
					<li><a href="#">Ski & Snowboarding</a></li>
					<li><a href="#">Disney Parks Vacations</a></li>
					<li><a href="#">Disneyland Vacations</a></li>
					<li><a href="#">Disney World Vacations</a></li>
					<li><a href="#">Vacations As Advertised</a></li>
				</ul>
			</div>
			<!-- End of column 2-->		
			
			<div class="col-md-3">
				<span class="ftitleblack">Travel Specialists</span>
				<br/><br/>
				<ul class="footerlistblack">
					<li><a href="#">Weddings</a></li>
					<li><a href="#">Accessible Travel</a></li>
					<li><a href="#">Disney Parks</a></li>
					<li><a href="#">Cruises</a></li>
					<li><a href="#">Round the World</a></li>
					<li><a href="#">First Class Flights</a></li>
				</ul>				
			</div>
			<!-- End of column 3-->		
			
			<div class="col-md-3 grey">
				<span class="ftitleblack">Newsletter</span>
				<div class="relative">
					<input type="email" class="form-control fccustom2black" id="exampleInputEmail1" placeholder="Enter email">
					<button type="submit" class="btn btn-default btncustom">Submit<img src="static/theme/forest/images/arrow.png" alt=""/></button>
				</div>
				<br/><br/>
				<span class="ftitleblack">Customer support</span><br/>
				<span class="pnr">1-866-599-6674</span><br/>
				<span class="grey2">office@travel.com</span>
			</div>			
			<!-- End of column 4-->			
		
			
		</div>	
	</div>
	
	<div class="footerbg3black">
		<div class="container center grey"> 
		<a href="#">Home</a> | 
		<a href="#">About</a> | 
		<a href="#">Last minute</a> | 
		<a href="#">Early booking</a> | 
		<a href="#">Special offers</a> | 
		<a href="#">Blog</a> | 
		<a href="#">Contact</a>
		<a href="#top" class="gotop scroll"><img src="static/theme/forest/images/spacer.png" alt=""/></a>
		</div>
	</div>
	
	<?php $this->load->view( 'website/common/library', array( 'js_add' => array( 'js-list3.js', 'counter.js' ) ) ); ?>
</body>
</html>