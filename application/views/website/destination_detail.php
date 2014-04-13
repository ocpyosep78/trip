akan dihapus

<?php
	// post
	$post = $this->post_model->get_by_id(array( 'city_alias' => $this->uri->segments[3], 'alias' => $this->uri->segments[4] ));
	
	// post galery
	$array_gallery = $this->post_gallery_model->get_array(array( 'post_id' => $post['id'] ));
	
	// post facility
	$array_facility = $this->post_facility_model->get_array(array( 'post_id' => $post['id'] ));
	
	// breadcrub
	$array_breadcrub = array(
		array( 'link' => '#', 'title' => $post['category_title'] ),
		array( 'link' => '#', 'title' => $post['region_title'] ),
		array( 'link' => '#', 'title' => $post['city_title'] ),
		array( 'link' => '#', 'title' => $post['title_select'] )
	);
?>
<?php $this->load->view( 'website/common/meta' ); ?>
<body id="top" class="thebg" >
	<?php $this->load->view( 'website/common/header_menu' ); ?>
	<?php $this->load->view( 'website/common/breadcrub', array( 'array' => $array_breadcrub ) ); ?>
	
	<div class="container">
		<div class="container pagecontainer offset-0">	
			<?php if (count($array_gallery) == 0) { ?>
			<div class="col-md-8 details-slider"><div id="c-carousel"><div id="wrapper">
				<div id="inner">
					<div id="caroufredsel_wrapper2">
						<div id="carousel">
							<img src="<?php echo base_url('static/theme/forest/images/details-slider/slide1.jpg'); ?>" alt=""/>					
						</div>
					</div>
					<div id="pager-wrapper">
						<div id="pager">
							<img src="<?php echo base_url('static/theme/forest/images/details-slider/slide1.jpg" width="120" height="68'); ?>" alt=""/>				
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
				<button id="prev_btn2" class="prev2"><img src="<?php echo base_url('static/theme/forest/images/spacer.png'); ?>" alt=""/></button>
				<button id="next_btn2" class="next2"><img src="<?php echo base_url('static/theme/forest/images/spacer.png'); ?>" alt=""/></button>
			</div></div></div>
			<?php } else { ?>
			<div class="col-md-8 details-slider"><div id="c-carousel"><div id="wrapper">
				<div id="inner">
					<div id="caroufredsel_wrapper2">
						<div id="carousel">
							<img src="../static/theme/forest/images/details-slider/slide1.jpg" alt=""/>
							<img src="../static/theme/forest/images/details-slider/slide2.jpg" alt=""/>
							<img src="../static/theme/forest/images/details-slider/slide3.jpg" alt=""/>
							<img src="../static/theme/forest/images/details-slider/slide4.jpg" alt=""/>
							<img src="../static/theme/forest/images/details-slider/slide5.jpg" alt=""/>
							<img src="../static/theme/forest/images/details-slider/slide6.jpg" alt=""/>						
						</div>
					</div>
					<div id="pager-wrapper">
						<div id="pager">
							<img src="../static/theme/forest/images/details-slider/slide1.jpg" width="120" height="68" alt=""/>
							<img src="../static/theme/forest/images/details-slider/slide2.jpg" width="120" height="68" alt=""/>
							<img src="../static/theme/forest/images/details-slider/slide3.jpg" width="120" height="68" alt=""/>
							<img src="../static/theme/forest/images/details-slider/slide4.jpg" width="120" height="68" alt=""/>
							<img src="../static/theme/forest/images/details-slider/slide5.jpg" width="120" height="68" alt=""/>
							<img src="../static/theme/forest/images/details-slider/slide6.jpg" width="120" height="68" alt=""/>						
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
				<button id="prev_btn2" class="prev2"><img src="<?php echo base_url('static/theme/forest/images/spacer.png'); ?>" alt=""/></button>
				<button id="next_btn2" class="next2"><img src="<?php echo base_url('static/theme/forest/images/spacer.png'); ?>" alt=""/></button>
			</div></div></div>
			<?php } ?>
			
			<div class="col-md-4 detailsright offset-0">
				<div class="padding20">
					<h4 class="lh1"><?php echo $post['title_select']; ?></h4>
					<?php echo nl2br($post['address']); ?>
				</div>
				<div class="line3"></div>
				
				<?php if (!empty($post['field_01_select'])) { ?>
				<div class="hpadding20">
					<h2 class="opensans slim green2"><?php echo $post['field_01_select']; ?>!</h2>
				</div>
				<div class="line3 margtop20"></div>
				<?php } ?>
				
				<div class="col-md-6 bordertype3">
					<img src="<?php echo base_url('static/theme/forest/images/user-rating-4.png'); ?>" alt=""/><br />
					18 reviews
				</div>
				<div class="col-md-6 bordertype3">
					<a href="#" class="grey">+Add review</a>
				</div>
				<div class="clearfix"></div><br />
				
			 	<div class="hpadding20">
					<!--   <a href="#" class="add2fav margtop5">Add to favourite</a>   -->
					<a href="#" class="booknow margtop20 btnmarg">Upload Your Photo</a>
				</div>  
			</div>
		</div>
		
		<div class="container mt25 offset-0">
			<div class="col-md-8 pagecontainer2 offset-0">
				<div class="cstyle10"></div>
				<ul class="nav nav-tabs" id="myTab">
					<li class="active"><a data-toggle="tab" href="#summary"><span class="summary"></span><span class="hidetext">Summary</span>&nbsp;</a></li>
					<li class=""><a data-toggle="tab" href="#reviews"><span class="reviews"></span><span class="hidetext">Reviews</span>&nbsp;</a></li>
				</ul>			
				<div class="tab-content4" >	
					<div id="summary" class="tab-pane fade active in">
						<?php if (!empty($post['desc_01_select'])) { ?>
						<p class="hpadding20"><?php echo $post['desc_01_select']; ?></p>
						<div class="line4"></div>
						<?php } ?>
						
						<?php if (!empty($post['desc_02_select'])) { ?>
						<button type="button" class="collapsebtn2" data-toggle="collapse" data-target="#collapse1">
							Description <span class="collapsearrow"></span>
						</button>
						<div id="collapse1" class="collapse in">
							<div class="hpadding20"><?php echo $post['desc_02_select']; ?></div>
							<div class="clearfix"></div>
						</div>
						<div class="line4"></div>
						<?php } ?>
					</div>
					<div id="reviews" class="tab-pane fade">
						<div class="hpadding20"><br />
							<span class="opensans dark size16 bold">Reviews</span>
						</div>
						<div class="line2"></div>
						
						<div class="hpadding20">							
							<div class="col-md-4 offset-0 center">
								<div class="padding20">
									<div class="bordertype5">
										<div class="circlewrap">
											<img src="<?php echo base_url('static/theme/forest/images/user-avatar.jpg'); ?>" class="circleimg" alt=""/>
											
										</div>
										<span class="dark">by Sena</span><br />
										from London, UK<br />
										<img src="<?php echo base_url('static/theme/forest/images/check.png'); ?>" alt=""/><br />
										<span class="orange">Wonderful!</span>
									</div>
									
								</div>
							</div>
							<div class="col-md-8 offset-0">
								<div class="padding20">
									<span class="opensans size16 dark">Rondo!!.. pokoke muantap bro..</span><br />
									<span class="opensans size13 lgrey">Posted Jun 02, 2013</span><br />
									<p>Excellent hotel, friendly staff would def go there again</p>	
									 
								</div>
							</div>
							<div class="clearfix"></div>
						</div>
						<div class="line2"></div>
						
						<div class="hpadding20">	
							<div class="col-md-4 offset-0 center">
								<div class="padding20">
									<div class="bordertype5">
										<div class="circlewrap">
											<img src="<?php echo base_url('static/theme/forest/images/user-avatar.jpg'); ?>" class="circleimg" alt=""/>
											
										</div>
										<span class="dark">by Sena</span><br />
										from London, UK<br />
										<img src="<?php echo base_url('static/theme/forest/images/check.png'); ?>" alt=""/><br />
										<span class="orange">Recommended<br />for Everyone</span>
									</div>
									
								</div>
							</div>
							<div class="col-md-8 offset-0">
								<div class="padding20">
									<span class="opensans size16 dark">Great experience</span><br />
									<span class="opensans size13 lgrey">Posted Jun 02, 2013</span><br />
									<p>The view from our balcony in room # 409, was terrific. It was centrally located to everything on and around the port area. Wonderful service and everything was very clean. The breakfast was below average, although not bad. If back in Zante Town we would stay there again.</p>	
									 
								</div>
							</div>
							<div class="clearfix"></div>
						</div>
						<div class="line2"></div>
						
						<div class="hpadding20">	
							<div class="col-md-4 offset-0 center">
								<div class="padding20">
									<div class="bordertype5">
										<div class="circlewrap">
											<img src="<?php echo base_url('static/theme/forest/images/user-avatar.jpg'); ?>" class="circleimg" alt=""/>
											
										</div>
										<span class="dark">by Sena</span><br />
										from London, UK<br />
										<img src="<?php echo base_url('static/theme/forest/images/check.png'); ?>" alt=""/><br />
										<span class="orange">Recommended<br />for Everyone</span>
									</div>
									
								</div>
							</div>
							<div class="col-md-8 offset-0">
								<div class="padding20">
									<span class="opensans size16 dark">Great experience</span><br />
									<span class="opensans size13 lgrey">Posted Jun 02, 2013</span><br />
									<p>It is close to everything but if you go in the lower season the pool won't be ready even though the temperature was quiet high already.</p>	
									 
								</div>
							</div>
							<div class="clearfix"></div>							
						</div>	
						<div class="line2"></div>
						<br /><br />
						
						<div class="wh33percent left center">
							<br />
						</div>
						<div class="wh66percent right offset-0">
							<div class="padding20 relative wh70percent">
								<div class="clearfix"></div>
								<button type="submit" class="btn-search4 margtop20">Submit Your Review</button>	
								<br /><br /><br /><br />
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
			
			<div class="col-md-4">
				<?php $this->load->view( 'website/common/widget_02' ); ?>
				<?php $this->load->view( 'website/common/random_post', array( 'class_style' => 'mt20 alsolikebox' ) ); ?>
			</div>
		</div>
	</div>
	
	<?php $this->load->view( 'website/common/footer' ); ?>
	<?php $this->load->view( 'website/common/library', array( 'js_add' => array( 'js-details.js', 'counter.js', 'initialize-carousel-detailspage.js' ) ) ); ?>
  </body>
</html>
