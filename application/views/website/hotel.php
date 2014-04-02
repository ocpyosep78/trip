<?php
	// master
	$array_country = $this->country_model->get_array();
	$array_category_sub = $this->category_sub_model->get_array(array( 'category_id' => CATEGORY_HOTEL ));
	$array_hotel_star = $this->hotel_star_model->get_array();
	
	// rate
	$rate_min = $this->hotel_detail_model->get_rate_min();
	
	// hotel count
	$hotel_count = $this->post_model->get_count(array( 'query' => true, 'category_id' => CATEGORY_HOTEL ));
	
	// hotel facility
	$param_facility['searchable'] = 1;
	$param_facility['category_id'] = CATEGORY_HOTEL;
	$array_facility = $this->category_facility_model->get_array($param_facility);
	
	// category tag
	$array_tag = $this->category_tag_model->get_array(array( 'category_id' => CATEGORY_HOTEL ));
	
	// breadcrub
	$array_breadcrub = array(
		array( 'link' => '#', 'title' => 'Hotel' ),
		array( 'link' => '#', 'title' => 'Jawa Timur' ),
		array( 'link' => '#', 'title' => 'Malang Kab' )
	);
?>

<?php $this->load->view( 'website/common/meta' ); ?>
<body id="top" class="thebg">
	<?php $this->load->view( 'website/common/header_menu' ); ?>
	<?php $this->load->view( 'website/common/breadcrub', array( 'array' => $array_breadcrub ) ); ?>
	
	<div class="container"><div class="container pagecontainer offset-0">
		<div class="col-md-3 filters offset-0">
			<div class="filtertip">
				<div class="padding20">
					<p class="size13"><span class="size18 bold hotel-count"><?php echo $hotel_count; ?></span> Hotels starting at</p>
					<p class="size30 bold">$ <span class="price-count"><?php echo $rate_min['rate_per_night']; ?></span></p>
					<p class="size13">Narrow results or <a href="#">view all</a></p>
				</div>
				<div class="tip-arrow"></div>
			</div>
			
			<div class="padding20title"><h3 class="opensans dark">Type</h3></div>
			<div class="line2"></div>
			<div class="hpadding20">
				<div class="radio">
					<label><input type="radio" name="category_sub_id" value="0" checked /> All</label>
				</div>
				<?php foreach($array_category_sub as $row) { ?>
				<div class="radio">
					<label><input type="radio" name="category_sub_id" value="<?php echo $row['id']; ?>" /> <?php echo $row['title']; ?></label>
				</div>
				<?php } ?>
			</div>
			
			<div class="padding20title"><h3 class="opensans dark">Area</h3></div>
			<div class="line2"></div><br />
			<div class="hpadding20">
				<select name="country_id" class="form-control mySelectBoxClass">
					<?php echo ShowOption(array( 'Array' => $array_country, 'LabelEmptySelect' => 'All Country' )); ?>
				</select>
			</div>
			<div class="clearfix"></div><br />
			<div class="hpadding20">
				<select name="region_id" class="form-control mySelectBoxClass">
					<option value="" selected>All Region</option>
				</select>
			</div>
			<div class="clearfix"></div><br />
			<div class="hpadding20">
				<select name="city_id" class="form-control mySelectBoxClass">
					<option value="" selected>All City</option>
				</select>
			</div>
			
			<div class="padding20title"><h3 class="opensans dark">Star</h3></div>
			<div class="line2"></div><br />
			<div class="hpadding20"> 
				<select name="star" class="form-control mySelectBoxClass">
					<?php echo ShowOption(array( 'Array' => $array_hotel_star, 'LabelEmptySelect' => 'All Star' )); ?>
				</select>
			</div>
			<div class="clearfix"></div><br />
			<div class="line2"></div>
			
			<!-- Price range -->
			<button type="button" class="collapsebtn" data-toggle="collapse" data-target="#collapse2">
				Price range
				<span class="collapsearrow"></span>
			</button>
			<div id="collapse2" class="collapse in">
				<div class="padding20">
					<div class="layout-slider wh100percent">
						<span class="cstyle09"><input id="bar-slider" type="slider" name="price" value="5;2000" /></span>
					</div>
					<script type="text/javascript">
						$("#bar-slider").slider({ from: 5, to: 2000, step: 5, smooth: true, round: 0, dimension: "&nbsp;$", skin: "round" });
					</script>
				</div>
			</div>
			<div class="line2"></div>
			<!-- End of Price range -->	
			
			<button type="button" class="collapsebtn last" data-toggle="collapse" data-target="#collapse4">
				Fasilities
				<span class="collapsearrow"></span>
			</button>	
			<div id="collapse4" class="collapse in">
				<div class="hpadding20">
					<?php foreach ($array_facility as $row) { ?>
					<div class="checkbox">
						<label><input type="checkbox" value="<?php echo $row['facility_id']; ?>" /> <?php echo $row['facility_text']; ?></label>
					</div>
					<?php } ?>
				</div>
			</div>	
			<div class="line2"></div>
			<div class="clearfix"></div>
			
			<div class="padding20title"><h3 class="opensans dark">Tags</h3></div>
			<div class="line2"></div><br />
			<div class="hpadding20"> 
				<?php foreach ($array_tag as $key => $row) { ?>
				<?php if (!empty($key)) { ?>
				<div class="clearfix"></div>
				<?php } ?>
				<label><a href="<?php echo $row['tag_link']; ?>"><?php echo $row['tag_title']; ?></a></label>
				<?php } ?>
			</div>
			<div class="clearfix"></div><br /><br /><br />
		</div>
		
		<div class="rightcontent col-md-9 offset-0">
			<div class="hpadding20">
				<div class="topsortby">
					<div class="col-md-4 offset-0">
						<div class="left mt7"><b>Sort by:</b></div>
						<div class="right wh70percent">
							<select class="form-control mySelectBoxClass">			  
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
							<select class="form-control mySelectBoxClass">
								<option>10</option>
								<option>20</option>
								<option>30</option>
								<option>40</option>
								<option>50</option>
							</select>
						</div>
					</div>
				</div>
			</div><br /><br />
			<div class="clearfix"></div>
			
			<div class="itemscontainer offset-1">
				<div class="col-md-4">
					<div class="listitem">
						<img src="http://www.baligetaway.co.id/images/uploads/BALI_GETAWAY-KUTA_CENTRAL_PARK_HOTEL_01.jpg" alt="" />
					</div>
					<div class="itemlabel2">
						<div class="labelright">
							<img src="static/theme/forest/images/filter-rating-5.png" width="60" alt=""/><br /><br /><br /><br />
							<span class="size11 grey">PROMO</span><br /><br />
							<button class="bookbtn mt1">View</button>
						</div>
						<div class="labelleft">			
							<b>Hotel Tugu </b><br /><br /><br />
							<p class="grey"><b>Desc hotel Tugu di potong </b>Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br /><br />
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
							<!-- Kosong --><br /><br /><br />
							<img src="static/theme/forest/images/user-rating-5.png" width="60" alt=""/><br />
							<span class="size11 grey">18 Reviews</span><br /><br />
							 
							<button class="bookbtn mt1">View</button>		
						</div>
						<div class="labelleft">			
							<b>Mabely Grand Hotel</b><br /><br /><br />
							<p class="grey">Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br /><br />
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
							<!-- Kosong --><br /><br /><br />
							<img src="static/theme/forest/images/user-rating-5.png" width="60" alt=""/><br />
							<span class="size11 grey">18 Reviews</span><br /><br />
						 
							<button class="bookbtn mt1">View</button>		
						</div>
						<div class="labelleft">			
							<b>Mabely Grand Hotel</b><br /><br /><br />
							<p class="grey">Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br /><br />
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
							<!-- Kosong --><br /><br /><br />
							<img src="static/theme/forest/images/user-rating-5.png" width="60" alt=""/><br />
							 
							<span class="size11 grey">avg/night</span><br /><br /><br />
							<button class="bookbtn mt1">View</button>		
						</div>
						<div class="labelleft">			
							<b>Mabely Grand Hotel</b><br /><br /><br />
							<p class="grey">Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br /><br />
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
							<!-- Kosong --><br /><br /><br />
							<img src="static/theme/forest/images/user-rating-5.png" width="60" alt=""/><br />
							<span class="size11 grey">18 Reviews</span><br /><br />
							 
							<button class="bookbtn mt1">View</button>		
						</div>
						<div class="labelleft">			
							<b>Mabely Grand Hotel</b><br /><br /><br />
							<p class="grey">Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br /><br />
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
							<!-- Kosong --><br /><br /><br />
							<img src="static/theme/forest/images/user-rating-5.png" width="60" alt=""/><br />
							<span class="size11 grey">18 Reviews</span><br /><br />
							 
							<button class="bookbtn mt1">View</button>		
						</div>
						<div class="labelleft">			
							<b>Mabely Grand Hotel</b><br /><br /><br />
							<p class="grey">Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br /><br />
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
							<!-- Kosong --><br /><br /><br />
							<img src="static/theme/forest/images/user-rating-5.png" width="60" alt=""/><br />
							<span class="size11 grey">18 Reviews</span><br /><br />
							 
							<button class="bookbtn mt1">View</button>		
						</div>
						<div class="labelleft">			
							<b>Mabely Grand Hotel</b><br /><br /><br />
							<p class="grey">Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br /><br />
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
							<!-- Kosong --><br /><br /><br />
							<img src="static/theme/forest/images/user-rating-5.png" width="60" alt=""/><br />
							<span class="size11 grey">18 Reviews</span><br /><br />
							 
							<button class="bookbtn mt1">View</button>		
						</div>
						<div class="labelleft">			
							<b>Mabely Grand Hotel</b><br /><br /><br />
							<p class="grey">Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br /><br />
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
							<!-- Kosong --><br /><br /><br />
							<img src="static/theme/forest/images/user-rating-5.png" width="60" alt=""/><br />
							<span class="size11 grey">18 Reviews</span><br /><br />
							 
							<button class="bookbtn mt1">View</button>		
						</div>
						<div class="labelleft">			
							<b>Mabely Grand Hotel</b><br /><br /><br />
							<p class="grey">Lorem ipsum dolor sit amet, consectetur adipiscing elit.<br /><br />
							Vestibulum vel risus at lectus rhoncus mattis. Sed id enim eu orci rhoncus malesuada.</p>
						</div>
					</div>				
				</div>
				
				<div class="clearfix"></div>
				<div class="offset-2"><hr class="featurette-divider3"></div>

			</div>	
			
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
	</div></div>
	
	<?php $this->load->view( 'website/common/footer' ); ?>
	<?php $this->load->view( 'website/common/library', array( 'js_add' => array( 'js-list3.js' ) ) ); ?>
	
<script>
jQuery(function($) {
	// count number
	$('.hotel-count').countTo({ from: 1, to: parseInt($('.hotel-count').text(), 10), speed: 2000, refreshInterval: 50 });
	$('.price-count').countTo({ from: 5, to: parseInt($('.price-count').text(), 10), speed: 1000, refreshInterval: 50 });
	
	// filter
	$('[name="country_id"]').change(function(){
		combo.region({ country_id: $(this).val(), target: $('[name="region_id"]'), label_empty_select: 'All Region' });
	});
	$('[name="region_id"]').change(function(){
		combo.city({ region_id: $(this).val(), target: $('[name="city_id"]'), label_empty_select: 'All City' });
	});
	
	// slider
	// jQuery("#bar-slider").val();
});
</script>
	
</body>
</html>