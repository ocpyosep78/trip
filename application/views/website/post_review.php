<?php
	// post
	$post = $this->post_model->get_by_id(array( 'city_alias' => $this->uri->segments[3], 'alias' => $this->uri->segments[4] ));
	
	// master
	$array_language = $this->language_model->get_array();
	
	// breadcrub
	$array_breadcrub = array(
		array( 'link' => '#', 'title' => $post['category_title'] ),
		array( 'link' => '#', 'title' => $post['region_title'] ),
		array( 'link' => '#', 'title' => $post['city_title'] ),
		array( 'link' => $post['link_post'], 'title' => $post['title_select'] ),
		array( 'link' => '#', 'title' => 'Review' )
	);
?>

<?php $this->load->view( 'website/common/meta' ); ?>
<body id="top" class="thebg">
	<?php $this->load->view( 'website/common/header_menu' ); ?>
	<?php $this->load->view( 'website/common/breadcrub', array( 'array' => $array_breadcrub ) ); ?>
	
	<div class="container">
		<div class="container mt25 offset-0">
			<div class="col-md-8 pagecontainer2 offset-0">
				<br />	<br /><h2 class="opensans slim green2">
					<div style="margin-left:20px;">Review | <?php echo $post['title_select']; ?></div></h2><br />
						<p class="hpadding20"><?php echo get_length_char($post['desc_01_select'], 600, ' ...'); ?></p>
						<div class="hpadding20">
							<br /><br />
							<span class="opensans dark size16 bold">Reviews</span>
							<div style="width:40%;float:right;margin-top:-15px;">
								<select class="form-control mySelectBoxClass margtop10" name="language_id">
									<?php echo ShowOption(array( 'Array' => $array_language, 'LabelEmptySelect' => 'Sort Language' )); ?>
								</select>
							</div>
						</div>
						<div class="line2"></div>
						
						<div class="hpadding20">							
							<div class="col-md-4 offset-0 center">
								<div class="padding20">
									<div class="bordertype5">
										<div class="circlewrap">
											<img src="<?php echo base_url('static/theme/forest/images/user-avatar.jpg'); ?>" class="circleimg" alt=""/>
											
										</div>
										<span class="dark">by Ridwan Amir</span><br />
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
						
						<div style="padding: 15px 15px 0 0;">
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
						<div class="clearfix"></div>
						
						<div id="cnt-review">
							<div class="hpadding20">
								<span class="opensans dark size16 bold">Reviews</span>
							</div>
							<div class="line2"></div>
							<form class="form-class" style="padding: 15px 0 0 0;">
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
						
						<div class="wh33percent left center">
							<br />
							<ul class="jslidetext2">
								<li>Username</li>
								<li>Evaluation</li>
								<li>My Language</li>
								<li>When did you visit? </li>
								<li>Title</li>
								<li>Your Review</li>
							</ul>
						</div>
						<div class="wh66percent right offset-0">
						 
							<div class="padding20 relative wh70percent">
								 
								
								<input type="text" class="form-control margtop10" placeholder="">
								<select class="form-control mySelectBoxClass margtop10">
								  <option selected>Select</option>
								  <option>Wonderful!</option>
								  <option>Recommended for Everyone</option>
								  <option>Nice</option>
								  <option>Neutral</option>
								  <option>Don't recommend</option>
								</select>
								<select class="form-control mySelectBoxClass margtop10">
								  <option selected>Select</option>
								  <option>English</option>
								  <option>Indonesia</option>
								   
								</select>	
								<select class="form-control mySelectBoxClass margtop10">
								  <option selected>Select</option>
								  <option>April 2013</option>
								  <option>Mei 2013</option>
								   <option>April 2014</option>
								</select>								
								<input type="text" class="form-control margtop10" placeholder="">
								
								<textarea class="form-control margtop10" rows="3"></textarea>
								
								<br />
								I certify that this review is based on my own experience and is my genuine opinion of this restaurant, and that I have no personal or business relationship with this establishment, and have not been offered any incentive or payment originating from the establishment to write this review. I understand that TripAdvisor has a zero-tolerance policy on fake reviews.
								
								<div class="clearfix"></div>
								
								<button type="submit" class="btn-search4 margtop20">Submit</button>	

								<br />
								<br />
								<br />
								<br />
								
							</div>							
						</div>
						<div class="clearfix"></div>
			</div>
			
			<div class="col-md-4">
				<?php $this->load->view( 'website/common/side_upload' ); ?>
				<?php $this->load->view( 'website/common/random_post', array( 'class_style' => 'mt20 alsolikebox' ) ); ?>
			</div>
		</div>
	</div>
	
	<?php $this->load->view( 'website/common/footer' ); ?>
	<?php $this->load->view( 'website/common/library', array( 'js_add' => array( 'js-details.js', 'counter.js' ) ) ); ?>
</body>
</html>
