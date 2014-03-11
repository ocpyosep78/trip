<?php
	foreach ($this->uri->segments as $value) {
		if ($value == 'user') {
			continue;
		}
		
		$user = $this->User_model->get_by_id(array( 'alias' => $value ));
		if (count($user) > 0) {
			break;
		}
	}
	
	// no user found
	if (count($user) == 0) {
		header("HTTP/1.1 301 Moved Permanently");
		header('Location: '.base_url());
		exit;
	}
	
	// build breadcrumb
	$param_breadcrumb['title_list'][] = array( 'link' => base_url(), 'title' => 'Home', 'class' => 'first' );
	$param_breadcrumb['title_list'][] = array( 'link' => $user['user_link'], 'title' => $user['fullname'] );
	
	// advert
	$param_advert = array(
		'user_id' => $user['id'],
		'advert_status_id' => ADVERT_STATUS_APPROVE,
		'sort' => '[{"property":"post_time","direction":"DESC"},{"property":"Advert.id","direction":"DESC"}]',
		'limit' => 10
	);
	$array_advert = $this->Advert_model->get_array($param_advert);
	
	/* region seo */
	
	$user_address = (empty($user['address'])) ? $user['fullname'].' Address' : $user['address'];
	$user_about = (empty($user['user_about'])) ? $user['fullname'].' About' : get_length_char($user['user_about'], 200, '');
	$keyword = $user['fullname'].', '.$user['alias'];
	$image_src = base_url(WEBSITE_LOGO);
	
	// page has advert
	if (count($array_advert) > 0) {
		$keyword .= ', '.$array_advert[0]['name'];
		
		$image_src = '';
		$array_check = array();
		foreach ($array_advert as $row) {
			if (! in_array($row['thumbnail_link'], $array_check)) {
				$array_check[] = $row['thumbnail_link'];
				$image_src .= (empty($image_src)) ? $row['thumbnail_link'] : ', '.$row['thumbnail_link'];
			}
		}
	}
	
	// meta
	$param_meta = array(
		'title' => $user['fullname'].' - '.WEBSITE_DOMAIN,
		'array_meta' => array(
			array( 'name' => 'Description', 'content' => $user_about.', '.$user_address ),
			array( 'name' => 'Keywords', 'content' => $keyword )
		),
		'array_link' => array(
			array( 'rel' => 'canonical', 'href' => $user['user_link'] ),
			array( 'rel' => 'image_src', 'href' => $image_src ),
			array( 'rel' => 'citation_authors', 'content' => $user['fullname'] )
		)
	);
	
	/* end region seo */
?>
<?php $this->load->view( 'website/common/meta', $param_meta ); ?>
<body id="offcanvas-container" class="offcanvas-container layout-fullwidth fs12 page-product">
<section id="page" class="offcanvas-pusher" role="main">
	<?php $this->load->view('website/common/header'); ?>
	
	<section id="columns" class="offcanvas-siderbars">
		<?php $this->load->view( 'website/common/breadcrumb', $param_breadcrumb ); ?>
		
		<div class="container">
			<div class="row">
				<section class="col-lg-99 col-md-9 col-sm-12 col-xs-12 main-column">
					<div class="description">
						<div class="wrapper underline no-margin">
							<h2><?php echo $user['first_name']; ?>'s Profile</h2>
							<p>-</p>
							<form method="post" id="form-register">
								<input type="hidden" name="action" value="update" />
								
								<h3>Your Personal Details</h3>
								<div class="content">
									<table class="form"><tbody>
									<tr>
										<td>Fullname</td>
										<td><?php echo $user['fullname']; ?></td></tr>
									<tr>
										<td>Email</td>
										<td><?php echo $user['email']; ?></td></tr>
									<tr>
										<td>Alias</td>
										<td><?php echo $user['alias']; ?></td></tr>
									</tr>
									<tr>
										<td>Address</td>
										<td><?php echo $user['address']; ?></td></tr>
									</tr>
									<tr>
										<td>Telp</td>
										<td><?php echo $user['phone']; ?></td></tr>
									</tr>
									<tr>
										<td>BB PIN</td>
										<td><?php echo $user['bb_pin']; ?></td></tr>
									</tr>
									<tr>
										<td>About</td>
										<td><?php echo $user['user_about']; ?></td></tr>
									</tr>
									<tr>
										<td>Info</td>
										<td><?php echo $user['user_info']; ?></td></tr>
									</tr>
									<tr>
										<td>Avatar</td>
										<td><img src="<?php echo $user['thumbnail_profile_link']; ?>" style="width: 100px;" /></td></tr>
									</tr>
									</tbody></table>
								</div>
							</form>
						</div>
					</div>
					
					<?php foreach ($array_advert as $row) { ?>
					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 col-fullwidth">
						<div class="product-block">
							<div class="image">
								<a title="<?php echo $row['name']; ?>" rel="colorbox" class="info-view colorbox product-zoom cboxElement" href="<?php echo $row['advert_link']; ?>">
									<i class="fa fa-search-plus"></i>
								</a>
								<div class="image_container">
									<a class="img front" href="<?php echo $row['advert_link']; ?>"><img class="img-responsive" alt="<?php echo $row['name']; ?>" title="<?php echo $row['name']; ?>" src="<?php echo $row['thumbnail_link']; ?>"></a>
								</div>
								<div class="img-overlay"></div>
							</div>
							<div class="product-meta">
								<div class="left">
									<h3 class="name"><a href="<?php echo $row['advert_link']; ?>"><?php echo get_length_char($row['name'], 40, ' ...'); ?></a></h3>						  
									<p class="description"><?php echo get_length_char($row['content'], 80, ' ...'); ?></p>
								</div>
								<div class="right">
									<div class="price">
										<span class="price-tax">Price : <?php echo $row['price_text']; ?></span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php } ?>
				</section>
				
				<aside id="oc-column-right" class="col-lg-3 col-md-3 col-sm-12 col-xs-12 offcanvas-sidebar">
					<div id="column-right" class="sidebar">
			 			<?php $this->load->view('website/common/widget_section'); ?>
					</div>
				</aside>
			</div>
		</div>
	</section>
	
	<?php $this->load->view('website/common/footer'); ?>
</section>

<?php $this->load->view('website/common/menu_canvas'); ?>

</body></html>