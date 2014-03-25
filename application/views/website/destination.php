<?php $this->load->view( 'website/common/meta' ); ?>
<body id="top" class="thebg" >
	<?php $this->load->view( 'website/common/header_menu' ); ?>
	
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
			
	
					<div class="offset-2">
						<div class="col-md-4 offset-0">
							<div class="listitem2">
								<a href="static/theme/forest/images/items/item7.jpg">
								<img src="static/theme/forest/images/items/item7.jpg" alt=""/></a>
								 
							</div>
						</div>
						<div class="col-md-8 offset-0">
							<div class="itemlabel3">
								<div class="labelright">
								<!--	<img src="static/theme/forest/images/filter-rating-5.png" width="60" alt=""/>--><br/><br/><br/>
									<img src="static/theme/forest/images/user-rating-5.png" width="60" alt=""/><br/>
									<span class="size11 grey">18 Reviews</span><br/><br/>
								<!--	<span class="green size18"><b>$36.00</b></span>--><br/>
										<!--<span class="size11 grey">avg/night</span>--><br/><br/><br/>
									<form action="details.html">
									 <button class="bookbtn mt1" type="submit">Book</button>	
									</form>			
								</div>
								<div class="labelleft2">			
									<b>Air Terjun Coban Rais</b><br/><br/><br/>
									<p class="grey">
									Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum nec semper lectus. Suspendisse placerat enim mauris, eget lobortis nisi egestas et.
									Donec elementum metus et mi aliquam eleifend. Suspendisse volutpat egestas rhoncus.</p><br/>
									
								</div>
							</div>
						</div>
					</div>

					<div class="clearfix"></div>
					<div class="offset-2"><hr class="featurette-divider3"></div>
					
					<div class="offset-2">
						<div class="col-md-4 offset-0">
							<div class="listitem2">
								<a href="static/theme/forest/images/items/item7.jpg">
								<img src="static/theme/forest/images/items/item7.jpg" alt=""/></a>
								 
							</div>
						</div>
						<div class="col-md-8 offset-0">
							<div class="itemlabel3">
								<div class="labelright">
								<!--	<img src="static/theme/forest/images/filter-rating-5.png" width="60" alt=""/>--><br/><br/><br/>
									<img src="static/theme/forest/images/user-rating-5.png" width="60" alt=""/><br/>
									<span class="size11 grey">18 Reviews</span><br/><br/>
								<!--	<span class="green size18"><b>$36.00</b></span>--><br/>
										<!--<span class="size11 grey">avg/night</span>--><br/><br/><br/>
									<form action="details.html">
									 <button class="bookbtn mt1" type="submit">Book</button>	
									</form>			
								</div>
								<div class="labelleft2">			
									<b>Mabely Grand Hotel</b><br/><br/><br/>
									<p class="grey">
									Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum nec semper lectus. Suspendisse placerat enim mauris, eget lobortis nisi egestas et.
									Donec elementum metus et mi aliquam eleifend. Suspendisse volutpat egestas rhoncus.</p><br/>
									
								</div>
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
	
	<?php $this->load->view( 'website/common/footer' ); ?>
	
	<?php $this->load->view( 'website/common/library', array( 'js_add' => array( 'js-list3.js', 'counter.js' ) ) ); ?>
</body>
</html>
