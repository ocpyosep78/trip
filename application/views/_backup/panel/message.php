<?php $this->load->view( 'panel/common/meta' ); ?>
<body>
<section class="vbox">
	<div class="modal fade" id="modal-contact">
		<div class="modal-dialog">
			<div class="modal-content">
				<form data-validate="parsley">
					<input type="hidden" name="action" value="sent_reply" />
					<input type="hidden" name="id" value="0" />
					
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Reply Form</h4>
					</div>
					<div class="modal-body">
						<section class="panel panel-default">
							<div class="panel-body">
								<div class="form-group">
									<label>Title</label>
									<input type="text" class="form-control" name="title" data-required="true" />
								</div>
								<div class="form-group">
									<label>Content</label>
									<textarea name="content" class="form-control" data-required="true"></textarea>
								</div>
							</div>
						</section>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-info">Save changes</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	
    <?php $this->load->view( 'panel/common/header' ); ?>
	
	<section>
		<section class="hbox stretch">
			<?php $this->load->view( 'panel/common/sidebar' ); ?>
			
			<section id="content">
				<section class="hbox stretch">
					<aside class="bg-light lter b-l" id="email-list">
						<input type="hidden" name="start" value="0" />
						<input type="hidden" name="is_read" value="x" />
						
						<section class="vbox">
							<header class="bg-light dk header clearfix">
								<div class="btn-group pull-right">
									<button type="button" class="btn btn-sm btn-default btn-page-prev"><i class="fa fa-chevron-left"></i></button>
									<button type="button" class="btn btn-sm btn-default btn-page-next"><i class="fa fa-chevron-right"></i></button>
								</div>
								<div class="btn-toolbar">
									<div class="btn-group select">
										<button class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
											<span class="dropdown-label" style="width: 65px;">Filter</span>
											<span class="caret"></span>
										</button>
										<ul class="dropdown-menu text-left text-sm filter-is-read">
											<li><a href="#" data-is_read="x">All</a></li>
											<li><a href="#" data-is_read="1">Read</a></li>
											<li><a href="#" data-is_read="0">Unread</a></li>
										</ul>
									</div>
									<div class="btn-group">
										<button class="btn btn-sm btn-default btn-refresh" data-toggle="tooltip" data-placement="bottom" data-title="Refresh"><i class="fa fa-refresh"></i></button>
									</div>
								</div>
							</header>
							<section class="scrollable hover cnt-message-list"></section>
							<footer class="footer b-t bg-white-only">
								<form class="m-t-sm">
									<div class="input-group">
										<input type="text" class="input-sm form-control input-s-sm" placeholder="Search" name="namelike" />
										<div class="input-group-btn">
											<button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
										</div>
									</div>
								</form>
							</footer>
						</section>
					</aside>
					<aside class="bg-white b-l" id="email-content" style="display: none;">
						<section class="vbox">
							<section class="scrollable">
								<div class="wrapper b-b b-light">
									<!-- <a href="#" data-toggle="class" class="pull-left m-r-sm"><i class="fa fa-star-o fa-1x text"></i><i class="fa fa-star text-warning fa-1x text-active"></i></a>	-->
									<a href="#" class="pull-right text">
										<i class="fa fa-trash-o btn-delete"></i>
									</a>
									<h4 class="m-n message-title">&nbsp;</h4>
								</div>
								<div class="text-sm padder m-t">
									<div class="block clearfix m-b">
										<a href="#" class="thumb-xs inline"><img src="" class="img-circle message-sender-thumbnail"></a> 
										<span class="inline m-t-xs message-fullname">Nama domain &lt;system@inidomain.com&gt; to me</span>
										<div class="pull-right inline">
											<em class="message-post-time-text">&nbsp;</em>
											<div class="btn-group">
												<button class="btn btn-default btn-xs show-list" data-toggle="tooltip" data-title="Back"><i class="fa fa-backward"></i></button>
												<button class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
												<ul class="dropdown-menu pull-right">
													<li><a href="#" class="btn-reply"><i class="fa fa-reply"></i> Reply</a></li>
													<!--
													<li><a href="#"><i class="fa fa-mail-forward"></i> Forward</a></li>
													<li><a href="#"><i class="fa fa-envelope"></i> Mark as unread</a></li>
													<li class="divider"></li>
													<li><a href="#">Delete this message</a></li>
													<li><a href="#">Report spam</a></li>
													-->
												</ul>
											</div>
										</div>
									</div>
									<div class="line pull-in"></div>
									<p>
										Hai anda menerima pesan dari pengunjung pada iklan 
										<p class="message-advert-link">&nbsp;</p>
									</p>
									<blockquote class="message-content"></blockquote>
									<div class="show">
										<p>Here detail who contact you</p>
										<p>Nama lengkap : <span class="message-fullname-only">&nbsp;</span></p>
										<p>Phone : <span class="message-phone">&nbsp;</span></p>
										<p>Email : <span class="message-email">&nbsp;</span></p>
									</div>
									<br/>
								</div>
								<div class="padder">
									<div class="panel text-sm bg-light">
										<div class="panel-body">
											Click here to <a class="cursor btn-reply" data-user-contact-id="0">Reply</a>
										</div>
									</div>
								</div>
							</section>
						</section>
					</aside>
				</section>
				
				<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
			</section>
		</section>
	</section>
</section>

<?php $this->load->view( 'panel/common/footer'); ?>

<script>
$(document).ready(function() {
	var page = {
		show_message: function() {
			$('#email-list').hide();
			$('#email-content').show();
		},
		show_listing: function() {
			$('#email-list').show();
			$('#email-content').hide();
		},
		
		// listing
		item_limit: 25,
		listing_start: function() {
			$('#email-list .filter-is-read a').click(function() {
				var is_read = $(this).data('is_read');
				$('#email-list [name="is_read"]').val(is_read);
				page.load_list();
			});
			$('#email-list .btn-refresh').click(function() {
				page.load_list();
			});
			$('#email-list form').submit(function(e) {
				e.preventDefault();
				page.load_list();
			});
			$('#email-list .btn-page-prev').click(function() {
				var start = parseInt($('#email-list [name="start"]').val(), 10);
				start = start - page.item_limit;
				start = (start < 0) ? 0 : start;
				$('#email-list [name="start"]').val(start);
				page.load_list();
			});
			$('#email-list .btn-page-next').click(function() {
				var count = $('#email-list ul.list-group').data('count');
				var start = parseInt($('#email-list [name="start"]').val(), 10);
				var start_temp = start + page.item_limit;
				start = (start_temp > count) ? start : start_temp;
				$('#email-list [name="start"]').val(start);
				page.load_list();
			});
			
			page.load_list();
		},
		load_list: function() {
			var is_read = $('#email-list [name="is_read"]').val();
			
			// generate param
			var param = {
				template: 'message_list',
				start: $('#email-list [name="start"]').val(),
				namelike: $('#email-list [name="namelike"]').val()
			}
			if (is_read != 'x') {
				param.is_read = is_read;
			}
			
			// request ajax
			Func.ajax({ url: web.base + 'panel/message/view', param: param, is_json: 0, callback: function(result) {
				$('#email-list .cnt-message-list').html(result);
				page.init_list_button();
			}});
		},
		init_list_button: function() {
			$('.list-group li a').click(function() {
				var raw = $(this).parents('li').find('.record').html();
				eval('var record = ' + raw);
				
				$('#email-content .message-title').text(record.title);
				$('#email-content .message-post-time-text').text(record.post_time_text);
				$('#email-content .message-fullname').text(record.name + ' <' + record.email + '> to me');
				$('#email-content .message-sender-thumbnail').attr('src', record.sender_thumbnail_profile_link);
				$('#email-content .message-content').html('<em>' + record.message.replace(/\n/g, '<br />') + '</em>');
				$('#email-content .message-fullname-only').text(record.name);
				$('#email-content .message-phone').text(record.phone);
				$('#email-content .message-email').text(record.email);
				$('#email-content .message-advert-link').html('<a href="' + record.advert_link + '" target="_blank">' + record.advert_link + '</a>');
				$('#email-content .btn-reply').data('user-contact-id', record.id);
				
				// update read
				if (record.is_read == 0) {
					Func.ajax({ url: web.base + 'panel/message/action', param: { action: 'update', id: record.id, is_read: 1 }});
				}
				
				// show message
				page.show_message();
			});
		}
	}
	page.listing_start();
	
	// form
	var form = $('#modal-contact form').parsley();
	$('#email-content .btn-reply').click(function() {
		var user_contact_id = $('#email-content .btn-reply').data('user-contact-id');
		
		// set data
		$('#modal-contact [name="id"]').val(user_contact_id);
		$('#modal-contact').modal();
	});
	$('#email-content .btn-delete').click(function() {
		var user_contact_id = $('#email-content .btn-reply').data('user-contact-id');
		var param = Site.Form.GetValue('modal-contact form');
		Func.update({
			param: { action: 'delete', id: user_contact_id },
			link: web.base + 'panel/message/action',
			callback: function() {
				page.show_listing();
				$('#user-contact-' + user_contact_id).remove();
			}
		});
	});
	$('#modal-contact form').submit(function(e) {
		e.preventDefault();
		if (! form.isValid()) {
			return false;
		}
		
		var param = Site.Form.GetValue('modal-contact form');
		Func.update({
			param: param,
			link: web.base + 'panel/message/action',
			callback: function() {
				$('#modal-contact').modal('hide');
			}
		});
	});
	
	// helper
	$('.show-list').click(function() {
		page.show_listing();
	});
});
</script>