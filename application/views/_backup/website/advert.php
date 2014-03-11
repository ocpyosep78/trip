<?php
	preg_match('/\/advert\/([a-z0-9\-]+)\/?/i', $_SERVER['REQUEST_URI'], $match);
	$advert_alias = (isset($match[1])) ? $match[1] : 0;
	
	// get from alias
	$advert = $this->Advert_model->get_by_id(array( 'alias' => $advert_alias ));
	
	// get form code
	if (count($advert) == 0) {
		$advert = $this->Advert_model->get_by_id(array( 'code' => $advert_alias ));
	}
	
	// get from id
	if (count($advert) == 0) {
		$advert = $this->Advert_model->get_by_id(array( 'id' => $advert_alias ));
	}
	
	// redirect for deleted advert or advert not found
	if (count($advert) == 0 || $advert['is_delete'] == 1) {
		header("HTTP/1.1 301 Moved Permanently");
		header('Location: '.base_url());
		exit;
	}
	
	// user
	$is_login = $this->User_model->is_login();
	$user = $this->User_model->get_session();
	
	// update view count
	$update_param['id'] = $advert['id'];
	$update_param['view_count'] = $advert['view_count'] + 1;
	$this->Advert_model->update($update_param);
	
	// advert detail
	$advert_pic = $this->Advert_Pic_model->get_array(array( 'advert_id' => $advert['id'] ));
	$category_input = $this->Category_Input_model->get_tree(array( 'advert_type_sub_id' => $advert['advert_type_sub_id'] ));
	$report_type = $this->Report_Type_model->get_array();
	
	// build breadcrumb
	$param_breadcrumb['title_list'][] = array( 'link' => base_url(), 'title' => 'Home', 'class' => 'first' );
	$param_breadcrumb['title_list'][] = array( 'link' => $advert['category_link'], 'title' => $advert['category_name'] );
	$param_breadcrumb['title_list'][] = array( 'link' => $advert['category_sub_link'], 'title' => $advert['category_sub_name'] );
	$param_breadcrumb['title_list'][] = array( 'link' => $advert['advert_link'], 'title' => $advert['name'] );
	
	// meta
	$param_meta = array(
		'title' => $advert['name'].' - '.$advert['price_text'],
		'array_meta' => array(
			array( 'name' => 'Title', 'content' => $advert['name'].', '.$advert['address'] ),
			array( 'name' => 'Description', 'content' => get_length_char($advert['content'], 200, ' ...') ),
			array( 'name' => 'Keywords', 'content' => $advert['city_name'].', '.$advert['region_name'].', '.$advert['advert_link'] )
		),
		'array_link' => array(
			array( 'rel' => 'canonical', 'href' => $advert['advert_link'] ),
			array( 'rel' => 'image_src', 'href' => $advert['thumbnail_link'] ),
			array( 'rel' => 'citation_authors', 'content' => $advert['fullname'] )
		)
	);
?>
<?php $this->load->view( 'website/common/meta', $param_meta ); ?>
<body id="offcanvas-container" class="offcanvas-container layout-fullwidth fs12 page-product">
<section id="page" class="offcanvas-pusher" role="main">
	<?php $this->load->view('website/common/header'); ?>
	<div class="hide">
		<div class="cnt-advert"><?php echo json_encode($advert); ?></div>
		<div class="cnt-category-input"><?php echo json_encode($category_input); ?></div>
	</div>
	
	<section id="columns" class="offcanvas-siderbars">
		<?php $this->load->view( 'website/common/breadcrumb', $param_breadcrumb ); ?>
		
		<div class="container">
			<div class="category-description wrapper">
				<div class="pagination">
					<div class="links">
						<h2><?php echo $advert['name']; ?></h2>
					</div>
					<div class="results">Share</div>
				</div>
			</div>
			<div class="row">
				<section class="col-lg-99 col-md-9 col-sm-12 col-xs-12 main-column">
					<div id="content" class="product-detail">
						<div class="product-info">
							<div class="pagination">
								<div class="links">
									<?php echo $advert['post_time_text']; ?>
									| <?php echo $advert['advert_type_name']; ?>
									
								<!--	<?php if (isset($advert['condition'])) { ?>| <?php echo $advert['condition']; ?><?php } ?> -->
								</div>
								<div class="results" style="padding-top: 0px;">List-ID: <?php echo $advert['code']; ?> | Dilihat: <?php echo $advert['view_count']; ?> kali</div>
							</div>
							<div class="row">
								<div class="col-lg-7-single col-sm-7-gambar col-xs-12">
									<div class="description" style="position: relative;" id="advert-pic">
										<?php if (count($advert_pic) > 0) { ?>
											<div class="image">
												<?php foreach ($advert_pic as $key => $row) { ?>
												<?php $class_name = ($key == 0) ? 'show' : 'hide'; ?>
												<img src="<?php echo $row['thumbnail_link_show']; ?>" class="<?php echo $class_name; ?>" />
												<?php } ?>
											</div>
											
											<?php if (count($advert_pic) > 1) { ?>
											<div style="position: absolute; top: 200px; left: 0px;">
												<i class="fa icon-arrow-left cursor" style="font-size: 22px; background: #CCCCCC; padding: 5px;"></i>
											</div>
											<div style="position: absolute; top: 200px; right: 0px;">
												<i class="fa icon-arrow-right cursor" style="font-size: 22px; background: #CCCCCC; padding: 5px;"></i>
											</div>
											<?php } ?>
										<?php } ?>
										
										<p>
											<b>Price:</b>
											<span class="availability"><?php echo $advert['price_text']; ?></span>
											<?php if (!empty($advert['sold_time'])) { ?>
												<span style="color: #d95750;">sold</span>
											<?php } ?>
										</p>
									</div>
									
									<?php if (isset($advert['address'])) { ?>Address : <?php echo $advert['address']; ?><?php } ?> 
									<br>Location : <?php echo $advert['city_name']; ?> - <?php echo $advert['region_name']; ?>
									<br><br>
									<div class="cnt-metadata"></div><br> <br> 
									
									<div>Description :<hr><?php echo nl2br($advert['content']); ?></div>
									
								<br> <br> <br> 
								</div>
							</div>
						</div>
						
						<div class="tabs-group box">
							<div id="tabs" class="htabs">
								<ul class="nav nav-tabs box-heading clearfix">
									<li><a class="selected"  href="#"></a></li>
									<li class="first"><a href="#tab-share">Send To Friends</a></li>
									<li><a href="#tab-report">Laporkan</a></li>
									<li><a href="#tab-advertiser">Contact Advertiser</a></li>
								</ul>
							</div>
							<div id="tab-share" class="tab-content"><form method="post">
								<input type="hidden" name="action" value="sent_to_friend" />
								<input type="hidden" name="advert_id" value="<?php echo $advert['id']; ?>" />
								
								<label>Email Teman</label>
								<div class="kir"><input type="text" name="email_to" /></div>
								<div class="clr"></div>
								<div class="top10"></div>
								<br />
								
								<label>Pesan Anda</label>
								<div class="kir"><textarea rows="5" cols="60" name="message" maxlength="200"></textarea></div>
								<div class="clr"></div>
								<div class="top10"></div>
								<br />
								
								<?php if (! $is_login) { ?>
								<label>Email Anda</label>
								<div class="kir"><input type="text" name="email_from" /></div>
								<div class="clr"></div>
								<div class="top10"></div>
								<br />
								<?php } ?>
								
								<input type="submit" class="readmore button" value="Kirim" name="submit" />
								<input type="reset" value="Batal" class="readmore button" />
							</form></div>
							<div id="tab-report" class="tab-content no-margin">
								<h2 id="review-title">Laporkan</h2>
								<p>
									Gunakan formulir dibawah ini untuk melaporkan komplain anda mengenai iklan ini. Harap hubungi Live Support untuk bertanya mengenai iklan anda atau hal umum lainnya.
									<br /><br />
									Laporkan karena :
								</p>
								<form>
									<input type="hidden" name="action" value="advert_report" />
									<input type="hidden" name="advert_id" value="<?php echo $advert['id']; ?>" />
									<span>
										<?php foreach ($report_type as $key => $row) { ?>
										<?php $check = ($key == (count($report_type) - 1)) ? 'checked="checked"' : ''; ?>
										<p><label><input type="radio" name="report_type_id" value="<?php echo $row['id']; ?>" <?php echo $check; ?>> <?php echo $row['name']; ?></label></p>
										<?php } ?>
									</span>
									<div class="clr"></div>
									<div class="top10"></div>
									
									<label>Detail</label>
									<div class="kir"><textarea rows="5" cols="60" name="detail"></textarea></div>
									<div class="clr"></div>
									<div class="top10"></div>
									<br />
									
									<?php if ($is_login) { ?>
									<input type="hidden" name="user_id" value="<?php echo $user['id']; ?>" />
									<input type="hidden" name="email" value="<?php echo $user['email']; ?>" />
									<?php } else { ?>
									<label>Email</label>
									<div class="kir"><input type="text" name="email" /></div>
									<div class="clr"></div>
									<div class="top10"></div>
									<br />
									<?php } ?>
									
									<p><strong>Enter the code in the box below:</strong></p>
									<img src="<?php echo base_url('static/img/captcha/?rand=0'); ?>" class="img-captcha" />
									<p><input name="captcha" type="text" /></p>
									<br />
									
									<input type="submit" class="readmore button" value="Kirim" name="submit" />
									<input type="reset" value="Batal" class="readmore button" />
								</form>
							</div>
							<div id="tab-advertiser" class="tab-content"><form method="post">
								<input type="hidden" name="action" value="contact_advertiser" />
								<input type="hidden" name="advert_id" value="<?php echo $advert['id']; ?>" />
								
								<?php if ($is_login) { ?>
								<input type="hidden" name="sender_id" value="<?php echo $user['id']; ?>" />
								<input type="hidden" name="name" value="<?php echo $user['fullname']; ?>" />
								<input type="hidden" name="email" value="<?php echo $user['email']; ?>" />
								<?php } else { ?>
								<label>Your Name</label>
								<div class="kir"><input type="text" name="name" /></div>
								<br />
								<label>Your Email</label>
								<div class="kir"><input type="text" name="email" /></div>
								<br />
								<?php } ?>
								
								<label>Your Phone (optional)</label>
								<div class="kir"><input type="text" name="phone" /></div>
								<br />
								
								<label>Title</label>
								<div class="kir"><input type="text" name="title" style="width: 75%;" /></div>
								<br />
								
								<label>Pesan Anda</label>
								<div class="kir"><textarea rows="5" cols="60" name="message" maxlength="200"></textarea></div>
								<div class="clr"></div>
								<br />
								
								<input type="submit" class="readmore button" value="Kirim" name="submit" />
								<input type="reset" value="Batal" class="readmore button" />
							</form></div>
						</div>
					</div>
				</section>
				
				<aside id="oc-column-right" class="col-lg-3 col-md-3 col-sm-12 col-xs-12 offcanvas-sidebar">
					<div id="column-right" class="sidebar">
						<?php $this->load->view( 'website/common/profile', array( 'user_id' => $advert['user_id'] ) ); ?>
						<?php $this->load->view( 'website/common/widget_section' ); ?>
						<?php $this->load->view( 'website/common/advert_related', array( 'category_sub_id' => $advert['category_sub_id'] ) ); ?>
					</div>
				</aside>
			</div>
		</div>
	</section>
	
	<?php $this->load->view('website/common/footer'); ?>
</section>

<?php $this->load->view('website/common/menu_canvas'); ?>

<script type="text/javascript">
	var page = {
		init: function() {
			var raw_advert = $('.cnt-advert').html();
			eval('var advert = ' + raw_advert);
			page.advert = advert;
			
			var raw_category_input = $('.cnt-category-input').html();
			eval('var category_input = ' + raw_category_input);
			
 			page.build(category_input, { append: true });
		},
		build: function(array_input, config) {
			// set config
			config.append = (typeof(config.append) != 'undefined') ? config.append : false;
			
			var template = '';
			for (var i = 0; i < array_input.length; i++) {
				var name = Func.GetName(array_input[i].title);
				var label = array_input[i].label;
				var value = page.advert[name];
				
				if (Func.InArray(array_input[i].input_type_name, ['text', 'select'])) {
					template += '<div style="margin: 8px 0;"><b>' + label + ' : </b>' + value + '</div>';
				} else if (Func.InArray(array_input[i].input_type_name, ['checkbox'])) {
					// generate option
					var cnt_option = '';
					var array_value = array_input[i].value.split(',');
					for (var j = 0; j < array_value.length; j++) {
						if (Func.InArray(array_value[j], page.advert[name])) {
							cnt_option += '<li>' + array_value[j] + '</li>';
						}
					}
					
					template += '<br><div style="padding: 20px 0 0 0;">' + label + '<hr /><div class="text-wrap"><ul class="three-col">';
					template += cnt_option;
					template += '</ul></div><br /></div>';
				}
				else if (array_input[i].input_type_name == 'parent') {
					var content = '';
					if (typeof(array_input[i].child) != 'undefined') {
						if (array_input[i].child.length > 0) {
							content = page.build(array_input[i].child, { append: false });
						}
					}
					
					template += '<div style="border: 1px solid #CCCCCC; padding: 10px;">';
					template += '<h5 style="margin: 0px; padding: 0px;">' + label + '</h5>';
					template += content;
					template += '</div>';
				}
				else if (array_input[i].input_type_name == 'car') {
					var alias = array_input[i].input_type_name;
					template += '<div id="cnt-' + alias + '">';
					template += '<div class="center"><img style="width: 60px;" src="' + web.base + 'static/img/ajax-loader.gif" /></div>';
					template += '</div>';
					
					setTimeout(function() { template_advert[alias](page.advert, alias) }, 500);
				}
			}
			
			// result
			if (config.append) {
				$('.cnt-metadata').append(template);
			} else {
				return template;
			}		
		}
	}
	page.init();
	
	// advert
	$('#advert-pic .icon-arrow-left').click(function() {
		var current = $('#advert-pic .image').find('.show');
		current.addClass('hide');
		current.removeClass('show');
		
		if (current.prev().length == 1) {
			current.prev().addClass('show');
			current.prev().removeClass('hide');
		} else {
			var length = $('#advert-pic .image img').length;
			$('#advert-pic .image img').eq(length - 1).addClass('show').removeClass('hide');
		}
	});
	$('#advert-pic .icon-arrow-right').click(function() {
		var current = $('#advert-pic .image').find('.show');
		current.addClass('hide');
		current.removeClass('show');
		
		if (current.next().length == 1) {
			current.next().addClass('show');
			current.next().removeClass('hide');
		} else {
			$('#advert-pic .image img').eq(0).addClass('show').removeClass('hide');
		}
	});
	
	// feature
	$('#tabs a').tabs();
	
	// sent to friend
	$('#tab-share form').validate({
		rules: {
			email_to: { required: true, email: true },
			message: { required: true }
		}
	});
	$('#tab-share form').submit(function(e) {
		e.preventDefault();
		if (! $('#tab-share form').valid()) {
			return false;
		}
		
		var param = Site.Form.GetValue('#tab-share form');
		Func.ajax({ url: web.base + 'advert/action', param: param, callback: function(result) {
			if (result.status == 1) {
				$.notify(result.message, "success");
				$('#tab-share form')[0].reset();
			} else {
				$.notify(result.message, "warn");
			}
		} });
	});
	
	// report
	$('#tab-report form').validate({
		rules: {
			email: { required: true, email: true },
			detail: { required: true },
			captcha: { required: true }
		}
	});
	$('#tab-report form').submit(function(e) {
		e.preventDefault();
		if (! $('#tab-report form').valid()) {
			return false;
		}
		
		var param = Site.Form.GetValue('#tab-report form');
		Func.ajax({ url: web.base + 'advert/action', param: param, callback: function(result) {
			if (result.status == 1) {
				$.notify(result.message, "success");
				$('#tab-report form')[0].reset();
			} else {
				$('.img-captcha').attr('src', $('.img-captcha').attr('src') + '/?rand=' + Math.random());
				$.notify(result.message, "warn");
			}
		} });
	});
	
	// contact advertiser
	$('#tab-advertiser form').validate({
		rules: {
			name: { required: true },
			title: { required: true },
			email: { required: true, email: true },
			message: { required: true }
		}
	});
	$('#tab-advertiser form').submit(function(e) {
		e.preventDefault();
		if (! $('#tab-advertiser form').valid()) {
			return false;
		}
		
		var param = Site.Form.GetValue('#tab-advertiser form');
		Func.ajax({ url: web.base + 'advert/action', param: param, callback: function(result) {
			if (result.status == 1) {
				$.notify(result.message, "success");
				$('#tab-advertiser form')[0].reset();
			} else {
				$.notify(result.message, "warn");
			}
		} });
	});
</script>

</body>
</html>