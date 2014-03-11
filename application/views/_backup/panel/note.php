<?php $this->load->view( 'panel/common/meta' ); ?>
<body>
<section class="vbox">
    <?php $this->load->view( 'panel/common/header' ); ?>
	
	<section><section class="hbox stretch">
        <?php $this->load->view( 'panel/common/sidebar' ); ?>
		
        <section id="content">
			<section class="hbox stretch">
				<aside class="aside-xl b-l b-r" id="note-list">
					<section class="vbox flex">
						<form method="post" id="form-note-search">
							<header class="header clearfix">
								<span class="pull-right m-t">
									<button type="button" class="btn btn-dark btn-sm btn-icon btn-note-add" data-toggle="tooltip" data-placement="right" title="New"><i class="fa fa-plus"></i></button>
								</span>
								<p class="h3">Notebook</p>
								<div class="input-group m-t-sm m-b-sm">
									<input type="text" class="form-control input-sm" placeholder="search" name="namelike" />
									<span class="input-group-addon input-sm btn-search cursor"><i class="fa fa-search"></i></span>
								</div>
							</header>
						</form>
						<section><section><section>
							<div class="padder">
								<ul id="note-items" class="list-group list-group-sp"></ul>
								<p class="text-center">&nbsp;</p>
							</div>
						</section></section></section>
					</section>
				</aside>
				
				<aside id="note-detail">
					<section class="vbox">
						<header class="header bg-light lter bg-gradient b-b">
							<div class="pull-right" id="form-btn">
								<div style="padding: 10px 0;">
									<a class="btn btn-sm btn-info btn-save">Save</a>
									<a class="btn btn-sm btn-default btn-reset">Reset</a>
								</div>
							</div>
							<p id="note-date">Created on ......</p>
						</header>
						<section class="bg-light lter" id="form-note">
							<input type="hidden" name="action" value="update" />
							<section class="hbox stretch">
								<aside>
									<section class="vbox b-b">
										<section class="paper">
											<input type="hidden" name="id" value="0" />
											<textarea type="text" name="content" class="form-control scrollable" placeholder="Type your note here" maxlength="1000"></textarea>
										</section>
									</section>
								</aside>
							</section>
						</section>
					</section>
				</aside>
			</section>
			<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
	</section></section>
</section>

<script>
$(document).ready(function() {
	var page = {
		init: function() {
			page.init_editor();
			page.init_listing();
			page.load_listing();
		},
		
		// listing
		init_listing: function() {
			$('#form-note-search').submit(function(e) {
				e.preventDefault();
				page.load_listing();
			});
			
			$('#form-note-search .btn-search').click(function() {
				page.load_listing();
			});
			
			$('#form-note-search .btn-note-add').click(function() {
				page.new_note({ id: 0, title: 'Note Name', content_short: 'Note Description', note_update_text: 'now', is_active: true });
				$('#note-items li.active').click();
			});
		},
		load_listing: function() {
			$('#note-items').html('');
			Func.ajax({
				url: web.base + 'panel/note/action',
				param: {
					action: 'get_array',
					namelike: $('#form-note-search [name="namelike"]').val()
				},
				callback: function(result) {
					for (var i = 0; i < result.array.length; i++) {
						page.new_note(result.array[i]);
					}
				}
			});
		},
		new_note: function(p) {
			var current_id = $('#form-note [name="id"]').val();
			p.is_active = (p.is_active == null) ? false : p.is_active;
			var class_active = (p.is_active) ? 'active' : '';
			class_active = (current_id == p.id) ? 'active' : class_active;
			
			var template = '';
			template += '<li class="list-group-item hover ' + class_active + '">';
			template += '<div class="hide record">{id:' + p.id + '}</div>';
			template += '<div class="view">';
			template += '<button class="destroy close hover-action">&times;</button>';
			template += '<div class="note-name">';
			template += '<strong>' + p.title + '</strong>';
			template += '</div>';
			template += '<div class="note-desc">' + p.content_short + '</div>';
			template += '<span class="text-xs text-muted">Time Update : ' + p.note_update_text + '</span>';
			template += '</div>';
			template += '</li>';
			
			if (p.is_active) {
				$('#note-items').find('.active').removeClass('active');
			}
			$('#note-items').append(template);
			
			// init
			$('#note-items li').last().click(function() {
				$('#note-items').find('.active').removeClass('active');
				$(this).addClass('active');
				
				// populate record
				var raw = $(this).find('.record').html();
				eval('var record = ' + raw);
				if (record.id == 0) {
					$('#note-date').html('now');
					$('#form-note [name="id"]').val(0);
					$('#form-note [name="content"]').val('');
				} else {
					Func.ajax({ url: web.base + 'panel/note/action', param: { action: 'get_by_id', id: record.id }, callback: function(result) {
						$('#note-date').html(result.note_update_date_only);
						$('#form-note [name="id"]').val(result.id);
						$('#form-note [name="content"]').val(result.content);
					} });
				}
			});
			$('#note-items li .destroy').last().click(function() {
				var raw = $(this).parents('li').find('.record').html();
				eval('var record = ' + raw);
				
				Func.ajax({ url: web.base + 'panel/note/action', param: { action: 'delete', id: record.id }, callback: function(result) {
					$(this).parents('li').remove();
					page.load_listing();
				} });
			});
		},
		
		// editor
		init_editor: function() {
			$('#form-btn .btn-save').click(function() {
				var param = Site.Form.GetValue('form-note');
				Func.update({
					param: param,
					link: web.base + 'panel/note/action',
					callback: function(result) {
						$('#form-note [name="id"]').val(result.id);
						page.load_listing();
					}
				});
			});
			$('#form-btn .btn-reset').click(function() {
				$('#note-items li.active').click();
			});
		}
	}
	page.init();
});
</script>

<?php $this->load->view( 'panel/common/footer'); ?>