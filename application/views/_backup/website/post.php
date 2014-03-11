<?php
	// user
	$is_login = $this->User_model->is_login();
	
	// default data
	$array_category = $this->Category_model->get_array();
	$array_condition = $this->Condition_model->get_array();
	$array_region = $this->Region_model->get_array();
	
	// advert
	preg_match('/post\/(\d+)$/i', $_SERVER['REQUEST_URI'], $match);
	$advert_id = (!empty($match[1])) ? $match[1] : 0;
	$advert = $this->Advert_model->get_by_id(array( 'id' => $advert_id ));
	$advert['advert_pic'] = $this->Advert_Pic_model->get_array(array( 'advert_id' => $advert_id ));
?>
<?php $this->load->view('website/common/meta'); ?>
<body id="offcanvas-container" class="offcanvas-container layout-fullwidth fs12 page-product">
<section id="page" class="offcanvas-pusher" role="main">
	<?php $this->load->view('website/common/header'); ?>
	
	<section id="columns" class="offcanvas-siderbars">
		<?php $this->load->view('website/common/breadcrumb'); ?>
		<div class="hide">
			<div class="advert-record"><?php echo json_encode($advert); ?></div>
			<iframe name="iframe_thumbnail_advert" src="<?php echo base_url('panel/upload?callback_name=set_thumbnail_advert'); ?>"></iframe>
		</div>
		
		<div class="container"><div class="row">
			<section class="col-lg-99 col-md-9 col-sm-12 col-xs-12 main-column">
				<div id="content">
					<form class="sky-form hide" id="form-advert">
						<input type="hidden" name="id" value="0" />
						<input type="hidden" name="action" value="update" />
						
						<fieldset>
							<section>
								<label class="label">Select Category (statis)</label>
								<label class="select">
									<select name="category_id" class="required">
										<?php echo ShowOption(array( 'Array' => $array_category, 'ArrayID' => 'id', 'ArrayTitle' => 'name' )); ?>
									</select>
									<i></i>
								</label>
							</section>
							<section class="cnt-category-sub hide">
								<label class="label">Select Sub Category (statis)</label>
								<label class="select">
									<select name="category_sub_id" class="required">
										<option value="">-</option>
									</select>
									<i></i>
								</label>
							</section>
							<section class="cnt-advert-type hide">
								<label class="label">Ad Type (dinamis)</label>
								<div class="inline-group"></div>
							</section>
							<section>
								<label class="label">Region (statis)</label>
								<label class="select">
									<select name="region_id" class="required">
										<?php echo ShowOption(array( 'Array' => $array_region, 'ArrayID' => 'id', 'ArrayTitle' => 'name' )); ?>
									</select>
									<i></i>
								</label>
							</section>
							<section class="cnt-city hide">
								<label class="label">City (statis)</label>
								<label class="select">
									<select name="city_id" class="required">
										<option value="">-</option>
									</select>
									<i></i>
								</label>
							</section>
							<section class="hide">
								<label class="label">Address (statis)</label>
								<label class="textarea textarea-resizable">
									<textarea rows="2" cols="60" name="address" placeholder="Ad address"></textarea>
								</label>
							</section>
							<section class="non-debug">
								<label class="label">Title Ad (statis)</label>
								<label class="input">
									<input type="text" name="name" placeholder="Title Ad" class="required" />
								</label>
							</section>
							<section class="non-debug">
								<label class="label">Price</label>
								<label class="input">
									<input type="text" name="price" placeholder="Price" />
								</label>
							</section>
							<section class="non-debug">
								<div class="row">
									<div class="col col-4">
										<label class="checkbox"><input name="negotiable" type="checkbox" value="1" /><i></i>Negotiable</label>
									</div>
								</div>
							</section>
						</fieldset>
						
						<fieldset class="non-debug">
							<section>
								<label class="label">Ad Desc (statis)</label>
								<label class="textarea textarea-resizable">
									<textarea rows="3" name="content" placeholder="Desc your ad here"></textarea>
								</label>
							</section>
							<section>
								<label class="label">Image (statis)</label>
								<label class="input input-file">
									<div class="button browse-thumbnail-advert">Browse</div>
									<input readonly="readonly" type="text" name="thumbnail" />
								</label>
							</section>	
							<div class="cnt-list-thumbnail"></div>
						</fieldset>
						
						<fieldset id="cnt-form-add"></fieldset>
						<br/><br/>
						
						<?php if (! $is_login) { ?>
						<fieldset>
							<section>
								<h3>DATA ANDA</h3><br />
								<div class="inline-group">
									<label class="radio"><input name="user_action" type="radio" value="member_register" checked="checked" /><i></i>New Member</label>
									<label class="radio"><input name="user_action" type="radio" value="member_login" /><i></i>Registered Member</label>
								</div>
							</section>
							<section class="cnt-fullname">
								<label class="label">Your Name</label>
								<label class="input">
									<input type="text" name="fullname" class="required" placeholder="Your Name" maxlength="30" />
								</label>
							</section>
							<section class="cnt-email">
								<label class="label">Email</label>
								<label class="input">
									<input type="text" name="email" class="required email" placeholder="Email" />
								</label>
							</section>
							<section class="cnt-alias">
								<label class="label">URL Name / Alias</label>
								<label class="input">
									<input type="text" name="alias" class="required no_special_char" placeholder="URL Name / Alias" />
								</label>
							</section>
							<section class="cnt-password">
								<label class="label">Password</label>
								<label class="input">
									<input type="password" name="passwd" class="required" placeholder="Password" />
								</label>
							</section>
							<section class="cnt-id-number">
								<div class="row">
									<div class="col col-8">
										<label class="checkbox">
											<input name="is_ic_number" type="checkbox" value="1" /><i></i>
											Check this box if you are a Foreigner / Army / Police
										</label>
									</div>
								</div>
							</section>
							<section class="cnt-id-number" id="cnt-ic-number">
								<label class="label">IC Number</label>
								<label class="input">
									<input type="text" name="ic_number" class="required" placeholder="IC Number" />
								</label>
							</section>
							<section class="cnt-phone">
								<label class="label">Phone Number</label>
								<label class="input">
									<input type="text" name="phone" class="required digits no_special_char" placeholder="Phone Number" maxlength="14" />
								</label>
							</section>		
							<section class="cnt-bb-pin">
								<label class="label">Blackberry (Optional)</label>
								<label class="input">
									<input type="text" name="bb_pin" class="no_special_char" placeholder="Blackberry Pin" maxlength="9" />
								</label>
							</section>
						</fieldset>
						<?php } ?>
						
						<footer>
							<button type="submit" class="button">Submit</button>
							<button type="button" class="button button-secondary" onclick="window.history.back();">Cancel</button>
							<button type="button" class="button button-red btn-panel" style="display:none;" >Panel</button>
						</footer>
					</form>
					
					<noscript class="js-warning">
						<div class="wrapper underline no-margin">
							<h2>Please activate your javascript</h2>
						</div>
					</noscript>
				</div>
			</section>
			
			<aside id="oc-column-right" class="col-lg-3 col-md-3 col-sm-12 col-xs-12 offcanvas-sidebar">
				<div id="column-right" class="sidebar">
					<?php $this->load->view('website/common/widget_section'); ?>
				</div>
			</aside>
		</div></div>
	</section>
	
	<?php $this->load->view('website/common/footer'); ?>
</section>

<?php $this->load->view('website/common/menu_canvas'); ?>

<script>
	// check js browser
	$('#content .sky-form').show();
	$('#content .js-warning').hide();
	
	var is_debug = false;
	if (is_debug) {
		$('.non-debug').hide();
	}
	
	// page
	var page = {
		init: function() {
			// populate data
			page.populate();
			
			// form non login
			if ($('#form-advert [name="user_action"]').length > 0) {
				$('#form-advert [name="user_action"]').eq(0).click();
			}
		},
		load_input: function(p) {
			p.category_id = (p.category_id != null) ? p.category_id : $('#form-advert [name="category_id"]').val();
			p.category_sub_id = (p.category_sub_id != null) ? p.category_sub_id : $('#form-advert [name="category_sub_id"]').val();
			p.advert_type_sub_id = (p.advert_type_sub_id != null) ? p.advert_type_sub_id : $('#form-advert [name="advert_type_id"]:checked').data('advert_type_sub_id');
			
			var input_param = {
				action: 'get_category_input',
				category_id: p.category_id,
				category_sub_id: p.category_sub_id,
				advert_type_sub_id: p.advert_type_sub_id
			}
			Func.ajax({
				url: web.base + 'post/action',
				param: input_param,
				callback: function(result) {
					$('#cnt-form-add').html('');
					page.build_input(result, { append: true });
				}
			});
		},
		build_input: function(array_input, config) {
			// set config
			config.append = (typeof(config.append) != 'undefined') ? config.append : false;
			
			for (var i = 0; i < array_input.length; i++) {
				var template = '';
				if (array_input[i].input_type_name == 'text') {
					var name = Func.GetName(array_input[i].title);
					var value = (page.advert[name] != null) ? page.advert[name] : array_input[i].value;
					var value = 'value="' + value + '"';
					var max_length = (array_input[i].max_length == 0) ? '' : 'maxlength="' + array_input[i].max_length + '"';
					var required = (array_input[i].is_required == 0) ? '' : 'required';
					
					// generate class
					var class_attr = '';
					if (array_input[i].is_numeric == 1) {
						class_attr += ' digits';
					}
					if (array_input[i].is_letter == 1) {
						class_attr += ' letter_only';
					}
					if (array_input[i].no_uppercase == 1) {
						class_attr += ' no_uppercase';
					}
					if (array_input[i].no_special_char == 1) {
						class_attr += ' no_special_char';
					}
					class_attr = (class_attr == '') ? class_attr : 'class="' + class_attr + '"';
					
					template += '<section>';
					template += '<label class="label">' + array_input[i].label + '</label>';
					template += '<label class="input">';
					template += '<input type="text" name="' + name + '" placeholder="' + array_input[i].label + '" ' + class_attr + value + ' ' + max_length + ' ' + required + ' />';
					template += '</label>';
					template += '</section>';
				}
				else if (array_input[i].input_type_name == 'select') {
					var name = Func.GetName(array_input[i].title);
					var value = (page.advert[name] != null) ? page.advert[name] : '';
					var required = (array_input[i].is_required == 0) ? '' : 'required';
					
					// generate option
					var selected = '';
					var cnt_option = '';
					var display_value = '';
					var array_value = array_input[i].value.split(',');
					for (var j = 0; j < array_value.length; j++) {
						selected = (array_value[j] == value) ? 'selected' : '';
						display_value = (array_value[j] == '') ? '-' : array_value[j];
						cnt_option += '<option value="' + array_value[j] + '" ' + selected + '>' + display_value + '</option>';
					}
					
					template += '<section>';
					template += '<label class="label">' + array_input[i].label + '</label>';
					template += '<label class="select">';
					template += '<select name="' + name + '" ' + required + '>';
					template += cnt_option;
					template += '</select>';
					template += '<i></i>';
					template += '</label>';
					template += '</section>';
				}
				else if (array_input[i].input_type_name == 'checkbox') {
					var name = Func.GetName(array_input[i].title);
					var array_check = (page.advert[name] != null) ? page.advert[name] : [];
					
					// generate option
					var cnt_option = '';
					var array_value = array_input[i].value.split(',');
					for (var j = 0; j < array_value.length; j++) {
						var checked = (Func.InArray(array_value[j], array_check)) ? 'checked' : '';
						cnt_option += '<div class="col col-4"><label class="checkbox"><input name="' + name + '[]" type="checkbox" value="' + array_value[j] + '" ' + checked + ' /><i></i>' + array_value[j] + '</label></div>';
					}
					
					template += '<section>';
					template += '<label class="label"><div>' + array_input[i].label + '</div></label>';
					template += '<div class="row">';
					template += cnt_option;
					template += '</div>';
					template += '</section>';
				}
				else if (array_input[i].input_type_name == 'textarea') {
					var name = Func.GetName(array_input[i].title);
					var value = (page.advert[name] != null) ? page.advert[name] : array_input[i].value;
					var max_length = (array_input[i].max_length == 0) ? '' : 'maxlength="' + array_input[i].max_length + '"';
					var required = (array_input[i].is_required == 0) ? '' : 'required';
					
					template += '<section>';
					template += '<label class="label">' + array_input[i].label + '</label>';
					template += '<label class="textarea textarea-resizable">';
					template += '<textarea rows="3" name="' + name + '" placeholder="' + array_input[i].label + '" ' + max_length + ' ' + required + '>' + value + '</textarea>';
					template += '</label>';
					template += '</section>';
				}
				else if (array_input[i].input_type_name == 'parent') {
					var content = '';
					if (typeof(array_input[i].child) != 'undefined') {
						if (array_input[i].child.length > 0) {
							content = page.build_input(array_input[i].child, { append: false });
						}
					}
					
					template += '<section class="parent">';
					template += '<h4>' + array_input[i].label + '</h4>';
					template += content;
					template += '</section>';
				}
				else if (array_input[i].input_type_name == 'car') {
					var alias = array_input[i].input_type_name;
					
					template += '<div id="cnt-' + alias + '" class="center">';
					template += '<div><img style="width: 60px;" src="' + web.base + 'static/img/ajax-loader.gif" /></div>';
					template += '</div>';
					Func.ajax({ url: web.base + 'post/action', param: { action: 'get_template_input', alias: alias }, is_json: 0, callback: function(result) {
						// render entry
						$('#cnt-' + alias).html(result);
						
						// init entry
						form_post[alias](page.advert);
					} });
				}
				else {
					console.log('did not match : ' + array_input[i].input_type_name);
				}
				
				if (config.append) {
					$('#cnt-form-add').append(template);
				}
			}
			
			// result
			if (! config.append) {
				return template;
			}
		},
		populate: function() {
			var raw_advert = $('.advert-record').html();
			eval('var advert = ' + raw_advert);
			page.advert = advert;
			if (advert.length == 0 || advert.id == null) {
				return;
			}
			
			// common entry
			Func.populate({ cnt: '#form-advert', record: advert });
			combo.city({ region_id: advert.region_id, target: $('#form-advert [name="city_id"]'), value: advert.city_id });
			$('#form-advert [name="price"]').blur();
			
			// ajax entry
			$('.cnt-advert-type').show();
			$('.cnt-category-sub').show();
			combo.category_sub({ category_id: advert.category_id, target: $('#form-advert [name="category_sub_id"]'), value: advert.category_sub_id });
			radio.advert_type_sub({
				value: advert.advert_type_id,
				category_sub_id: advert.category_sub_id,
				target: '.cnt-advert-type .inline-group',
				callback: function() {
					$('#form-advert [name="advert_type_id"]').click(function() { page.load_input({}); });
				}
			});
			
			// category input
			page.load_input({ category_id: advert.category_id, category_sub_id: advert.category_sub_id, advert_type_sub_id: advert.advert_type_sub_id });
			
			// thumbnail
			if (page.advert.advert_pic != null) {
				for (var i = 0; i < page.advert.advert_pic.length; i++) {
					page.advert.advert_pic[i]
					var row = { file_name: page.advert.advert_pic[i].thumbnail, file_link: page.advert.advert_pic[i].thumbnail_link, is_reset: false }
					page.generate_thumbnail(row);
				}
			}
		},
		generate_thumbnail: function(p) {
			p.is_reset = (typeof(p.is_reset) == 'undefined') ? true : p.is_reset;
			
			// data
			var thumbnail_active = $('#form-advert [name="thumbnail"]').val();
			var record = Func.ObjectToJson({ file_name: p.file_name, file_link: p.file_link });
			
			// reset element
			if (p.is_reset) {
				$('.cnt-list-thumbnail').find('.active').removeClass('active');
			}
			
			var content = '';
			var class_active = (thumbnail_active == p.file_name) ? 'active' : '';
			content += '<div class="photo">';
			content += '<input type="hidden" name="list_thumbnail[]" value="' + p.file_name + '" />';
			content += '<span class="hide record-thumbnail">' + record + '</span>';
			content += '<div class="border ' + class_active + '"><img src="' + p.file_link + '" /></div>';
			content += '<div class="btn-delete"><i class="fa icon-remove"></i></div>';
			content += '</div>';
			$('#form-advert .cnt-list-thumbnail').append(content);
			
			// init button
			$('.cnt-list-thumbnail .btn-delete').last().click(function() {
				$(this).parent('div.photo').remove();
			});
			$('.cnt-list-thumbnail .border img').last().click(function() {
				var raw = $(this).parents('div.photo').find('.record-thumbnail').text();
				eval('var thumbnail = ' + raw);
				$('#form-advert [name="thumbnail"]').val(thumbnail.file_name);
				
				// border
				$('.cnt-list-thumbnail').find('.active').removeClass('active');
				$(this).parents('div.photo').find('.border').addClass('active');
			});
		},
		ic_number: function() {
			var param = Site.Form.GetValue('#form-advert');
			if (param.is_ic_number == 1) {
				$('#cnt-ic-number .label').text('Other ID Number');
				$('#cnt-ic-number input').attr('placeholder', 'Other ID Number');
			} else {
				$('#cnt-ic-number .label').text('IC Number');
				$('#cnt-ic-number input').attr('placeholder', 'IC Number');
			}
		},
		show_button_panel: function() {
			$('#content footer .btn-panel').attr('style', '');
		}
	}
	
	// form
	$('#form-advert [name="category_id"]').change(function() {
		combo.category_sub({
			category_id: $(this).val(),
			target: $('#form-advert [name="category_sub_id"]'),
			callback: function() {
				$('.cnt-category-sub').show();
			}
		});
	});
	$('#form-advert [name="category_sub_id"]').change(function() {
		radio.advert_type_sub({
			category_sub_id: $(this).val(),
			target: '.cnt-advert-type .inline-group',
			callback: function() {
				$('#form-advert [name="advert_type_id"]').click(function() { page.load_input({}); });
				$('#form-advert [name="advert_type_id"]').eq(0).click();
				$('.cnt-advert-type').show();
			}
		});
	});
	$('#form-advert [name="region_id"]').change(function() {
		combo.city({
			region_id: $(this).val(),
			target: $('#form-advert [name="city_id"]'),
			callback: function() {
				$('.cnt-city').show();
			}
		});
	});
	$('#form-advert [name="price"]').blur(function() {
		var value = $('#form-advert [name="price"]').val();
		$('#form-advert [name="price"]').val(formatMoney(value, 0, ',', '.'));
	});
	$('#form-advert [name="is_ic_number"]').click(function() {
		page.ic_number();
	});
	$('#form-advert [name="user_action"]').click(function() {
		var value = $(this).val();
		
		if (value == 'member_login') {
			// container
			$('#form-advert .cnt-fullname').hide();
			$('#form-advert .cnt-email').show();
			$('#form-advert .cnt-alias').hide();
			$('#form-advert .cnt-password').show();
			$('#form-advert .cnt-id-number').hide();
			$('#form-advert .cnt-phone').hide();
			$('#form-advert .cnt-bb-pin').hide();
			
			// input
			$('#form-advert [name="fullname"]').removeClass('required');
			$('#form-advert [name="email"]').addClass('required');
			$('#form-advert [name="passwd"]').addClass('required');
			$('#form-advert [name="ic_number"]').removeClass('required');
			$('#form-advert [name="phone"]').removeClass('required');
		} else if (value == 'member_register') {
			// container
			$('#form-advert .cnt-fullname').show();
			$('#form-advert .cnt-email').show();
			$('#form-advert .cnt-alias').show();
			$('#form-advert .cnt-password').show();
			$('#form-advert .cnt-id-number').show();
			$('#form-advert .cnt-phone').show();
			$('#form-advert .cnt-bb-pin').show();
			
			// input
			$('#form-advert [name="fullname"]').addClass('required');
			$('#form-advert [name="email"]').addClass('required');
			$('#form-advert [name="passwd"]').removeClass('required');
			$('#form-advert [name="ic_number"]').addClass('required');
			$('#form-advert [name="phone"]').addClass('required');
		}
	});
	$('#form-advert').submit(function(e) {
		e.preventDefault();
		if (! $('#form-advert').valid()) {
			return;
		}
		
		var param = Site.Form.GetValue('#form-advert');
		Func.update({
			param: param,
			link: web.base + 'post/action',
			callback: function(result) {
				$('.cnt-city').hide();
				$('.cnt-advert-type').hide();
				$('.cnt-category-sub').hide();
				$('#form-advert #cnt-form-add').html('');
				$('#form-advert .cnt-list-thumbnail').html('');
				
				$('#form-advert')[0].reset();
				$('#form-advert [name="id"]').val(0);
				$('#form-advert [name="user_action"]').eq(0).click();
				
				if (result.show_panel) {
					page.show_button_panel();
				}
			}
		});
	});
	
	// helper
	$('.btn-panel').click(function() {
		window.location = web.base + 'panel';
	});
	
	// upload
	$('.browse-thumbnail-advert').click(function() {
		var param = Site.Form.GetValue('#form-advert');
		param.list_thumbnail = (param.list_thumbnail == null) ? [] : param.list_thumbnail;
		if (param.list_thumbnail.length < 6) {
			window.iframe_thumbnail_advert.browse();
		} else {
			$.notify( 'You have reach maximum image', "warn" );
		}
	});
	set_thumbnail_advert = function(p) {
		if (p.file_name == '') {
			$.notify( p.message, "warn" );
			return;
		}
		
		// set value
		$('#form-advert [name="thumbnail"]').val(p.file_name);
		
		page.generate_thumbnail(p);
	}
	
	// init page
	page.init();
</script>

</body>
</html>