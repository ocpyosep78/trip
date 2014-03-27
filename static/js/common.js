var DATE_FORMAT = 'dd-mm-yyyy';
var NO_IMAGE = web.base + 'static/img/no-images.jpg';
// var TIME_FORMAT = 'H:i';

String.prototype.strpad = function str_pad(pad_length, pad_string, pad_type) {
	var input = this;
	if (pad_type == undefined) pad_type = STR_PAD_RIGHT;
	if (pad_string == undefined) pad_string = ' ';
	
	switch(pad_type) {
		case 'STR_PAD_RIGHT':
				if(input.length > pad_length) return input;
				fillnum = pad_length - input.length;
				fillstring = new Array(fillnum + 1).join(pad_string).substr(0, fillnum);
				return input + fillstring;
		break;
		case 'STR_PAD_LEFT':
				if(input.length > pad_length) return input;
				fillnum = pad_length - input.length;
				fillstring = new Array(fillnum + 1).join(pad_string).substr(0, fillnum);
				return fillstring + input;
		break;
		case 'STR_PAD_BOTH':
				if(input.length > pad_length) return input;
				fillnum = pad_length - input.length;
				fillnum_right = Math.ceil(fillnum / 2);
				fillnum_left = Math.floor(fillnum / 2);
				fillstring_left = new Array(fillnum_left + 1).join(pad_string).substr(0, fillnum_left);
				fillstring_right = new Array(fillnum_right + 1).join(pad_string).substr(0, fillnum_right);
				return fillstring_left + input + fillstring_right;
		break;
	}
}
function str_pad(input, pad_length, pad_string, pad_type) {
	input = input.toString();
	return input.strpad(pad_length, pad_string, pad_type);
}

// formatMoney('1500000', 0, ',', '.')
Number.prototype.formatMoney = function(c, d, t) {
var n = this, 
	c = isNaN(c = Math.abs(c)) ? 2 : c, 
	d = d == undefined ? "." : d, 
	t = t == undefined ? "," : t, 
	s = n < 0 ? "-" : "", 
	i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", 
	j = (j = i.length) > 3 ? j % 3 : 0;
	return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
};
function formatMoney(value, c, d, t) {
	value = value.replace(/[^0-9]+/g, '');
	value = parseInt(value, 10);
	return value.formatMoney(c, d, t);
}

var Site = {
    Host: web.base,
    IsValidEmail: function (Email) {
        var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
        return emailPattern.test(Email);  
    },
    IsValidYear: function(Value) {
        var Result = true;
        
        Value = Value + '';
        Value = Value.replace(new RegExp('[^0-9]', 'gi'), '');
        
        if (Value.length != 4) {
            Result = false;
        }
        
        return Result;
    },
    IsValidPostalCode: function(Value) {
        var Result = true;
        
        Value = Value + '';
        Value = Value.replace(new RegExp('[^0-9]', 'gi'), '');
        
        if (Value.length != 5) {
            Result = false;
        }
        
        return Result;
    },
    GetTimeFromString: function(String) {
        String = $.trim(String);
        if (String == '') {
            return new Date();
        }
        
        var Data = new Date();
        var ArrayData = String.split('-');
        if (ArrayData[2] != null && ArrayData[2].length == 4) {
            Data = new Date(ArrayData[2] + '-' + ArrayData[1] + '-' + ArrayData[0]);
        }
        
        return Data;
    },
	SwapYearDay: function(String) {
		var Temp = Site.GetTimeFromString(String);
		var Result = Temp.getFullYear() + '-' + Temp.getMonth() + '-' + Temp.getDate();
		return Result;
	},
    Form: {
		InlineWarning: function(Input) {
			Input.parent('td').append('<div class="CntWarning">' + Input.attr('alt') + '</div>');
		},
        Start: function(Container) {
            var Input = jQuery('#' + Container + ' input');
            for (var i = 0; i < Input.length; i++) {
                if (Input.eq(i).hasClass('datepicker')) {
                    Input.eq(i).datepicker({ dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true, yearRange: 'c-20:c+10' });
                }
                else if (Input.eq(i).hasClass('integer') || Input.eq(i).hasClass('postalcode')) {
                    Input.eq(i).keyup(function(Param) {
						var Value = jQuery(this).val();
                        Value = Value.replace(new RegExp('[^0-9\.]', 'gi'), '');
						
						if (Param.keyCode == 16 || Param.keyCode == 17 || Param.keyCode == 18 || Param.ctrlKey || Param.shiftKey) {
							return true;
						}
						
						jQuery(this).val(Value);
                    });
                }
				else if (Input.eq(i).hasClass('alphabet')) {
					Input.eq(i).keyup(function(Param) {
						var Value = jQuery(this).val();
						Value = Value.replace(new RegExp('[^a-z\ ]', 'gi'), '');
						
						if (Param.keyCode == 16 || Param.keyCode == 17 || Param.keyCode == 18 || Param.ctrlKey || Param.shiftKey) {
							return true;
						}
						
						jQuery(this).val(Value);
					});
				}
				else if (Input.eq(i).hasClass('float')) {
					Input.eq(i).keyup(function(Param) {
						var Value = jQuery(this).val();
						Value = Value.replace(new RegExp('[^0-9\.]', 'gi'), '');
						
						if (Param.keyCode == 16 || Param.keyCode == 17 || Param.keyCode == 18 || Param.ctrlKey || Param.shiftKey) {
							return true;
						}
						
						jQuery(this).val(Value);
					});
				}
            }
        },
        Validation: function(Container, Param) {
			Param.Inline = (Param.Inline == null) ? false : Param.Inline;
			
            var ArrayError = [];
			jQuery('.CntWarning').remove();
            
            var Input = jQuery('#' + Container + ' input');
            for (var i = 0; i < Input.length; i++) {
                Input.eq(i).removeClass('ui-state-highlight');
                
                if (Input.eq(i).hasClass('required')) {
                    var Value = jQuery.trim(Input.eq(i).val());
                    
                    if (Value == '') {
                        Input.eq(i).addClass('ui-state-highlight');
                        ArrayError[ArrayError.length] = Input.eq(i).attr('alt');
						if (Param.Inline) Site.Form.InlineWarning(Input.eq(i));
                    }
                }
                if (Input.eq(i).hasClass('integer') || Input.eq(i).hasClass('datepicker')) {
                    var Value = jQuery.trim(Input.eq(i).val());
                    var ValueResult = Value.replace(new RegExp('[^0-9\-]', 'gi'), '');
                    
                    if (Value != ValueResult) {
                        Input.eq(i).addClass('ui-state-highlight');
                        ArrayError[ArrayError.length] = Input.eq(i).attr('alt');
						if (Param.Inline) Site.Form.InlineWarning(Input.eq(i));
                    }
                }
                if (Input.eq(i).hasClass('datepicker')) {
                    var Result = true;
                    var Value = jQuery.trim(Input.eq(i).val());
                    var ArrayValue = Value.split('-');
                    
                    if (Value.length == 0) {
                        Result = true;
                    } else if (ArrayValue.length != 3) {
                        Result = false;
                    } else if (ArrayValue[0] == '' || ArrayValue[1] == '' || ArrayValue[2] == '') {
                        Result = false;
                    }
                    
                    if (!Result) {
                        Input.eq(i).addClass('ui-state-highlight');
						if (Param.Inline) Site.Form.InlineWarning(Input.eq(i));
                        ArrayError[ArrayError.length] = Input.eq(i).attr('alt');
                    }
                }
                if (Input.eq(i).hasClass('email') && ! Site.IsValidEmail(Input.eq(i).val())) {
					if (Input.eq(i).val() != '') {
						Input.eq(i).addClass('ui-state-highlight');
						ArrayError[ArrayError.length] = Input.eq(i).attr('alt');
						if (Param.Inline) Site.Form.InlineWarning(Input.eq(i));
					}
                }
                if (Input.eq(i).hasClass('postalcode') && (Input.eq(i).val().length != 0 && Input.eq(i).val().length != 5)) {
                    Input.eq(i).addClass('ui-state-highlight');
                    ArrayError[ArrayError.length] = Input.eq(i).attr('alt');
					if (Param.Inline) Site.Form.InlineWarning(Input.eq(i));
                }
                if (Input.eq(i).hasClass('year') && (Input.eq(i).val().length != 0 && Input.eq(i).val().length != 4)) {
                    Input.eq(i).addClass('ui-state-highlight');
                    ArrayError[ArrayError.length] = Input.eq(i).attr('alt');
					if (Param.Inline) Site.Form.InlineWarning(Input.eq(i));
                }
            }
            
            var Select = jQuery('#' + Container +' select');
            for (var i = 0; i < Select.length; i++) {
                if (Select.eq(i).hasClass('required') && (Select.eq(i).val() == '' || Select.eq(i).val() == '-')) {
                    Select.eq(i).addClass('ui-state-highlight');
                    ArrayError[ArrayError.length] = Select.eq(i).attr('alt');
					if (Param.Inline) Site.Form.InlineWarning(Select.eq(i));
                } else {
                    Select.eq(i).removeClass('ui-state-highlight');
                }
            }
            
            var TextArea = jQuery('#' + Container +' textarea');
            for (var i = 0; i < TextArea.length; i++) {
                var Value = TextArea.eq(i).val();
                Value = jQuery.trim(Value);
                
                if (TextArea.eq(i).hasClass('required') && TextArea.eq(i).val() == '') {
                    TextArea.eq(i).addClass('ui-state-highlight');
                    ArrayError[ArrayError.length] = TextArea.eq(i).attr('alt');
                } else {
                    TextArea.eq(i).removeClass('ui-state-highlight');
                }
            }
            
            return ArrayError;
        },
        GetValue: function(container) {
			var PrefixCheck = container.substr(0, 1);
			if (! Func.InArray(PrefixCheck, ['.', '#'])) {
				container = '#' + container;
			}
			
            var data = Object();
			var set_value = function(obj, name, value, code) {
				if (typeof(name) == 'undefined') {
					return obj;
				} else if (name.length < 3) {
					obj[name] = value;
					return obj;
				}
				
				var endfix = name.substr(name.length - 2, 2);
				if (endfix == '[]') {
					var name_valid = name.replace(endfix, '');
					if (obj[name_valid] == null) {
						obj[name_valid] = [];
					}
					obj[name_valid].push(value);
				} else if (typeof(code) != 'undefined') {
					if (obj[name] == null) {
						obj[name] = {};
					}
					
					obj[name][code] = value;
				} else {
					obj[name] = value;
				}
				
				return obj;
			}
            
            var Input = jQuery(container + ' input, ' + container + ' select, ' + container + ' textarea, ' + container + ' .input-tinymce');
            for (var i = 0; i < Input.length; i++) {
				var name = Input.eq(i).attr('name');
				var code = Input.eq(i).attr('data-code');
				
				// get value
				var value = Input.eq(i).val();
				if (Input.eq(i).hasClass('input-tinymce')) {
					value = Input.eq(i).html();
				}
				
				if (Input.eq(i).attr('type') == 'checkbox') {
					if (Input.eq(i).is(':checked')) {
						data = set_value(data, name, value, code);
					} else {
						data = set_value(data, name, 0, code);
					}
				} else if (Input.eq(i).attr('type') == 'radio') {
					value = $(container + ' [name="' + name + '"]:checked').val();
					data = set_value(data, name, value, code);
				} else if (Input.eq(i).hasClass('datepicker-input')) {
					data = set_value(data, name, Func.SwapDate(value), code);
				} else {
					data = set_value(data, name, value, code);
				}
            }
			
			// retrieve language value
			for (var p in data) {
				if (data.hasOwnProperty(p)) {
					if (Func.InArray(typeof(data[p]), [ 'object' ])) {
						data[p] = Func.ObjectToJson(data[p]);
					}
				}
			}
			
            return data;
        }
    }
}

var Func = {
	ArrayToJson: function(Data) {
		var Temp = '';
		for (var i = 0; i < Data.length; i++) {
			Temp = (Temp.length == 0) ? Func.ObjectToJson(Data[i]) : Temp + ',' + Func.ObjectToJson(Data[i]);
		}
		return '[' + Temp + ']';
	},
	InArray: function(Value, Array) {
		var Result = false;
		for (var i = 0; i < Array.length; i++) {
			if (Value == Array[i]) {
				Result = true;
				break
			}
		}
		return Result;
	},
	IsEmpty: function(value) {
		var Result = false;
		if (value == null || value == 0) {
			Result = true;
		} else if (typeof(value) == 'string') {
			value = Func.Trim(value);
			if (value.length == 0) {
				Result = true;
			}
		}
		
		return Result;
	},
	ObjectToJson: function(obj) {
		var str = '';
		for (var p in obj) {
			if (obj.hasOwnProperty(p)) {
				if (obj[p] != null) {
					str += (str.length == 0) ? str : ',';
					str += '"' + p + '":"' + obj[p] + '"';
				}
			}
		}
		str = '{' + str + '}';
		return str;
	},
	SwapDate: function(Value) {
		if (Value == null) {
			return '';
		}
		
		var ArrayValue = Value.split('-');
		if (ArrayValue.length != 3) {
			return '';
		}
		
		return ArrayValue[2] + '-' + ArrayValue[1] + '-' + ArrayValue[0];
	},
	Trim: function(value) {
		return value.replace(/^\s+|\s+$/g,'');
	},
	GetName: function(value) {
		var result = value.trim().replace(new RegExp(/[^0-9a-z]+/gi), '-').toLowerCase();
		result = result.replace(new RegExp(/^-/gi), '').toLowerCase();
		result = result.replace(new RegExp(/-$/gi), '').toLowerCase();
		return result;
	},
	GetStringFromDate: function(Value) {
		if (Value == null) {
			return '';
		} else if (typeof(Value) == 'string') {
			return Value;
		}
		
		var Day = Value.getDate();
		var DayText = (Day.toString().length == 1) ? '0' + Day : Day;
		var Month = Value.getMonth() + 1;
		var MonthText = (Month.toString().length == 1) ? '0' + Month : Month;
		var Date = DayText + '-' + MonthText + '-' + Value.getFullYear();
		return Date;
	},
	InitForm: function(p) {
		// Date Picker
		$(p.Container + ' .datepicker').datepicker({ format: DATE_FORMAT });
		
		$(p.Container + ' .tinymce').tinymce({
			// Location of TinyMCE script
			script_url : '../../../static/lib/tinymce/jscripts/tiny_mce/tiny_mce.js',

			// General options
			theme : "advanced",
			plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist",

			// Theme options
			theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,sub,sup,|,charmap,iespell,media,advhr,|,fullscreen",
			theme_advanced_buttons2 : "cut,copy,paste,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,image,code,|,forecolor,backcolor",
			theme_advanced_toolbar_location : "top",
			theme_advanced_toolbar_align : "left",
			theme_advanced_statusbar_location : "bottom",
			theme_advanced_resizing : true,
			
//			plugins 							: "autoresize,style,table,advhr,advimage,advlink,emotions,inlinepopups,preview,media,contextmenu,paste,fullscreen,noneditable,xhtmlxtras,template,advlist",
			// Theme options
//			theme_advanced_buttons1 			: "undo,redo,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,fontselect,fontsizeselect",
//			theme_advanced_buttons2 			: "forecolor,backcolor,|,cut,copy,paste,pastetext,|,bullist,numlist,link,image,media,|,code,preview,fullscreen",

			// Example content CSS (should be your site CSS)
//			content_css : "css/content.css",

			// Drop lists for link/image/media/template dialogs
			template_external_list_url : "lists/template_list.js",
			external_link_list_url : "lists/link_list.js",
			external_image_list_url : "lists/image_list.js",
			media_external_list_url : "lists/media_list.js",

			// Replace values for the template plugin
			template_replace_values : {
				username : "Some User",
				staffid : "991234"
			}
		});
		
		/*
		$(p.Container + ' .tinymce').tinymce({
			// Location of TinyMCE script
			script_url 							: '../../../static/lib/tiny_mce/tiny_mce.js',
			// General options
			theme 								: "advanced",
			plugins 							: "autoresize,style,table,advhr,advimage,advlink,emotions,inlinepopups,preview,media,contextmenu,paste,fullscreen,noneditable,xhtmlxtras,template,advlist",
			// Theme options
			theme_advanced_buttons1 			: "undo,redo,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,fontselect,fontsizeselect",
			theme_advanced_buttons2 			: "forecolor,backcolor,|,cut,copy,paste,pastetext,|,bullist,numlist,link,image,media,|,code,preview,fullscreen",
			theme_advanced_buttons3 			: "",
			theme_advanced_toolbar_location 	: "top",
			theme_advanced_toolbar_align 		: "left",
			theme_advanced_statusbar_location 	: "bottom",
			theme_advanced_resizing 			: false,
			font_size_style_values 				: "8pt,10px,12pt,14pt,18pt,24pt,36pt",
			init_instance_callback				: function(){
				function resizeWidth() {
					document.getElementById(tinyMCE.activeEditor.id+'_tbl').style.width='100%';
				}
				resizeWidth();
				$(window).resize(function() {
					resizeWidth();
				})
			}
		});
		/*	*/
		
		// Validation
		$(p.Container + ' form').validate({
			onkeyup: false, errorClass: 'error', validClass: 'valid',
			highlight: function(element) { $(element).closest('div').addClass("f_error"); },
			unhighlight: function(element) { $(element).closest('div').removeClass("f_error"); },
			errorPlacement: function(error, element) { $(element).closest('div').append(error); },
			rules: p.rule
		});
		
		// Twipsy
		$(p.Container + ' [rel=twipsy]').focus(function() {
			if ($(this).data('placement') == null) {
				$(this).attr('data-placement', 'right');
			}
			if ($(this).data('original-title') == null) {
				$(this).attr('data-original-title', $(this).attr('placeholder'));
			}
			
			$(this).twipsy('show');
		});
		$(p.Container + ' [rel=twipsy]').blur(function() { $(this).twipsy('hide'); });
	},
	ajax: function(p) {
		p.is_json = (p.is_json == null) ? 1 : p.is_json;
		p.callback = (p.callback == null) ? function() {} : p.callback;
		
		$.ajax({ type: 'POST', url: p.url, data: p.param, success: function(data) {
			if (p.is_json == 1) {
				eval('var result = ' + data);
				p.callback(result);
			} else {
				p.callback(data);
			}
		} });
	},
	show_notice: function(p) {
		p.title = (p.title == null) ? 'Message' : p.title;
		p.text = (p.text == null) ? '-' : p.text;
		
		$('.gritter-close').click();
		$.gritter.add({ title: p.title, text: p.text, sticky: true, time: 3000 });
		
		// close glitter
		setTimeout(function() {
			var id = $('.gritter-item-wrapper').last().attr('id');
			$('#' + id).find('.gritter-close').click();
		}, 3000);
	},
	confirm_delete: function(p) {
		var cnt_modal = '';
		cnt_modal += '<div id="cnt-confirm" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
		cnt_modal += '<div class="modal-dialog">';
		cnt_modal += '<div class="modal-content">';
		cnt_modal += '<div class="modal-header">';
		cnt_modal += '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
		cnt_modal += '<h4 class="modal-title">Delete Confirmation !!</h4>';
		cnt_modal += '</div>';
		cnt_modal += '<div class="modal-body">';
		cnt_modal += '<p>Are you sure ?</p>';
		cnt_modal += '</div>';
		cnt_modal += '<div class="modal-footer">';
		cnt_modal += '<button type="button" class="btn btn-close btn-default" data-dismiss="modal" aria-hidden="true">Cancel</button>';
		cnt_modal += '<button type="button" class="btn btn-primary">Yes</button>';
		cnt_modal += '</div>';
		cnt_modal += '</div>';
		cnt_modal += '</div>';
		cnt_modal += '</div>';
		$('#cnt-temp').html(cnt_modal);
		$('#cnt-confirm').modal();
		
		$('#cnt-confirm .btn-primary').click(function() {
			$.ajax({ type: "POST", url: p.url, data: p.data }).done(function( RawResult ) {
				eval('var result = ' + RawResult);
				
				$('#cnt-confirm .btn-close').click();
				$.notify(result.message, "success");
				
				if (p.callback != null) {
					p.callback();
				}
			});
		});
	},
	init_datatable: function(p) {
		var cnt_id = '#' + p.id;
		
		var dt_param = {
			"aoColumns": p.column,
			"sAjaxSource": p.source,
			"bProcessing": true, "bServerSide": true, "sServerMethod": "POST", "sPaginationType": "full_numbers",
			"oLanguage": {
				"sSearch": "<span>Search:</span> ",
				"sInfo": "Showing <span>_START_</span> to <span>_END_</span> of <span>_TOTAL_</span> entries",
				"sLengthMenu": "_MENU_ <span>entries per page</span>"
			},
			"fnDrawCallback": function (oSettings) {
				// init tooltips
				$(cnt_id + ' .tool-tip').tooltip({ placement: 'top' });
				
				if (p.callback != null) {
					p.callback();
				}
			}
		}
		if (p.fnServerParams != null) {
			dt_param.fnServerParams = p.fnServerParams;
		}
		if (p.aaSorting != null) {
			dt_param.aaSorting = p.aaSorting;
		}
		if (p.bPaginate != null) {
			dt_param.bPaginate = p.bPaginate;
		}
		
		var table = $(cnt_id).dataTable(dt_param);
		
		// initiate
		if (p.init != null) {
			p.init();
		}
		
		var dt = {
			table: table,
			reload: function() {
				if ($(cnt_id + '_paginate .paginate_active').length > 0) {
					$(cnt_id + '_paginate .paginate_active').click();
				} else {
					$(cnt_id + '_length select').change();
				}
			}
		}
		
		// init search
		$(cnt_id).parents('.panel-table').find('.btn-search').click(function() {
			var value = $(cnt_id).parents('.panel-table').find('.input-keyword').val();
			dt.table.fnFilter( value );
		});
		
		return dt;
	},
	populate: function(p) {
		for (var form_name in p.record) {
			if (p.record.hasOwnProperty(form_name)) {
				var input = $(p.cnt + ' [name="' + form_name + '"]');
				var value = p.record[form_name];
				
				try {
					var json = JSON.parse(value);
				} catch(e) {
					var json = null;
				}
				
				if (typeof(json) == 'object' && json != null) {
					for (var code in json) {
						if (json.hasOwnProperty(code)) {
							for (var i = 0; i < input.length; i++) {
								// input, select, textarea
								if (input.eq(i).attr('data-code') == code) {
									input.eq(i).val(json[code]);
								}
								
								// wysiwyg
								var selector = '#' + form_name + '-' + code;
								if ($(selector).length == 1) {
									$(selector).html(json[code]);
								}
							}
						}
					}
				} else if (input.attr('type') == 'checkbox') {
					input.prop('checked', false);
					if (value == 1) {
						input.prop('checked', true);
					}
				} else if (input.hasClass('datepicker-input')) {
					input.val(Func.SwapDate(value));
				} else {
					input.val(value);
				}
			}
		}
	},
	update: function(p) {
		Func.ajax({ url: p.link, param: p.param, callback: function(result) {
			if (result.status == 1) {
				if (typeof(p.callback) != 'undefined') {
					p.callback(result);
				}
				
				$.notify(result.message, "success");
			} else {
				$.notify(result.message, "error");
			}
		} });
	},
	language: function() {
		// ini fungsi untuk multi language
		$("[id^=language-]").html($('.form-language').html());
		
		// input tab
		for (var i = 0; i < $("[id^=language-]").length; i++) {
			var code = $("[id^=language-]").eq(i).data('code');
			
			// input
			$("[id^=language-]").eq(i).find('input,select,textarea').attr('data-code', code);
			
			// wysiwyg
			$("[id^=language-]").eq(i).find('.input-tinymce').each(function() {
				$(this).attr('data-code', code);
				
				// id
				var id = $(this).attr('name') + '-' + code;
				$(this).attr('id', id);
				
				// generate editor
				set_wysiwyg({ id: id });
				
				// design
				$(this).addClass('form-control');
			});
		}
	},
	
	combo: function(p) {
		// default value
		if (typeof(p.category_combo) == 'undefined') {
			p.category_combo = '.group-category .select-category';
		}
		if (typeof(p.category_sub_combo) == 'undefined') {
			p.category_sub_combo = '.group-category-sub .select-category-sub';
		}
		if (typeof(p.category_sub_option) == 'undefined') {
			p.category_sub_option = '.group-category-sub .dropdown-menu';
		}
		if (typeof(p.advert_type_sub_combo) == 'undefined') {
			p.advert_type_sub_combo = '.group-advert-type-sub .select-advert-type-sub';
		}
		if (typeof(p.advert_type_sub_option) == 'undefined') {
			p.advert_type_sub_option = '.group-advert-type-sub .dropdown-menu';
		}
		
		$(p.category_combo).click(function() {
			var category = $(this).data('row');
			
			// category change
			if (typeof(p.category_change) != 'undefined') {
				p.category_change(category);
			}
			
			// load category sub
			Func.ajax({ url: web.base + 'panel/dropdown', param: { action: 'category_sub', category_id: category.id }, is_json: 0, callback: function(result) {
				$(p.category_sub_option).html(result);
				
				$(p.category_sub_combo).click(function() {
					var category_sub = $(this).data('row');
					
					// category sub change
					if (typeof(p.category_sub_change) != 'undefined') {
						p.category_sub_change(category_sub);
					}
					
					// load advert type sub
					Func.ajax({ url: web.base + 'panel/dropdown', param: { action: 'advert_type_sub', category_sub_id: category_sub.id }, is_json: 0, callback: function(result) {
						$(p.advert_type_sub_option).html(result);
						
						$(p.advert_type_sub_combo).click(function() {
							var advert_type_sub = $(this).data('row');
							
							// advert type sub change
							if (typeof(p.advert_type_sub_change) != 'undefined') {
								p.advert_type_sub_change(advert_type_sub);
							}
						});
					} });
				});
			} });
		});
	},
	init_tree: function(p) {
		$(p.cnt + ' .tree li:has(ul)').addClass('parent_li').find(' > span').attr('title', 'Collapse this branch');
		$(p.cnt + ' .tree li.parent_li > span').on('click', function (e) {
			var children = $(this).parent('li.parent_li').find(' > ul > li');
			if (children.is(":visible")) {
				children.hide('fast');
				$(this).attr('title', 'Expand this branch').find(' > i').addClass('fa-plus').removeClass('fa-minus-circle');
			} else {
				children.show('fast');
				$(this).attr('title', 'Collapse this branch').find(' > i').addClass('fa-minus-circle').removeClass('fa-plus');
			}
			e.stopPropagation();
		});
	},
	get_date_time: function(value, default_value) {
		if (value == null) {
			var t = new Date();
			var month = str_pad(t.getMonth() + 1, 2, '0', 'STR_PAD_LEFT');
			var tgl = str_pad(t.getDate(), 2, '0', 'STR_PAD_LEFT');
			var hour = str_pad(t.getHours(), 2, '0', 'STR_PAD_LEFT');
			var minute = str_pad(t.getMinutes(), 2, '0', 'STR_PAD_LEFT');
			var second = str_pad(t.getSeconds(), 2, '0', 'STR_PAD_LEFT');
			
			var date = (default_value == 1) ? tgl + '-' + month + '-' + t.getFullYear() : '';
			var time = (default_value == 1) ? hour + ':' + minute + ':' + second : '';
			return { date: date, time: time };
		}
		
		var array_value = value.split(' ');
		if (array_value.length == 2) {
			return { date: Func.SwapDate(array_value[0]), time: array_value[1] };
			
		}
	},
	get_config: function() {
		var raw = $('.cnt-page').html();
		eval('var config = ' + raw);
		
		return config;
	}
}

var combo = {
	category_sub: function(p) {
		p.category_id = (p.category_id == null) ? 0 : p.category_id;
		
		var ajax_param = {
			is_json: 0, url: web.base + 'panel/combo',
			param: { action: 'category_sub', category_id: p.category_id },
			callback: function(option) {
				p.target.html(option);
				
				// set value
				if (typeof(p.value) != 'undefined') {
					p.target.val(p.value);
				}
				
				if (p.callback != null) {
					p.callback();
				}
			}
		}
		Func.ajax(ajax_param);
	},
	city: function(p) {
		p.region_id = (p.region_id == null) ? 0 : p.region_id;
		p.label_empty_select = (p.label_empty_select == null) ? '-' : p.label_empty_select;
		
		var ajax_param = {
			is_json: 0, url: web.base + 'panel/combo',
			param: { action: 'city', region_id: p.region_id, label_empty_select: p.label_empty_select },
			callback: function(option) {
				p.target.html(option);
				
				// set value
				if (typeof(p.value) != 'undefined') {
					p.target.val(p.value);
				}
				
				if (p.callback != null) {
					p.callback();
				}
			}
		}
		Func.ajax(ajax_param);
	},
	region: function(p) {
		p.country_id = (p.country_id == null) ? 0 : p.country_id;
		p.label_empty_select = (p.label_empty_select == null) ? '-' : p.label_empty_select;
		
		var ajax_param = {
			is_json: 0, url: web.base + 'panel/combo',
			param: { action: 'region', country_id: p.country_id, label_empty_select: p.label_empty_select },
			callback: function(option) {
				p.target.html(option);
				
				// set value
				if (typeof(p.value) != 'undefined') {
					p.target.val(p.value);
				}
				
				if (p.callback != null) {
					p.callback();
				}
			}
		}
		Func.ajax(ajax_param);
	},
	
	kota: function(p) {
		p.propinsi_id = (p.propinsi_id == null) ? 0 : p.propinsi_id;
		
		var ajax_param = {
			is_json: 0, url: web.base + 'panel/combo',
			param: { action: 'kota', propinsi_id: p.propinsi_id },
			callback: function(option) {
				p.target.html(option);
				
				if (p.callback != null) {
					p.callback();
				}
			}
		}
		Func.ajax(ajax_param);
	},
	subkategori: function(p) {
		p.kategori_id = (p.kategori_id == null) ? 0 : p.kategori_id;
		
		var ajax_param = {
			is_json: 0, url: web.base + 'panel/combo',
			param: { action: 'subkategori', kategori_id: p.kategori_id },
			callback: function(option) {
				p.target.html(option);
				
				if (p.callback != null) {
					p.callback();
				}
			}
		}
		Func.ajax(ajax_param);
	}
}

function display_item(view) {
	if (view == 'list') {
		$('.product-grid').attr('class', 'product-list');
		$('.products-block .product-block').each(function(index, element) {
			$(element).parent().addClass("col-fullwidth");
			$(element).parent().removeClass("col-fullgrid");
		});
		
		$('.product-filter .list').addClass('active');
		$('.product-filter .grid').removeClass('active');
	} else {
		$('.product-list').attr('class', 'product-grid');
		$('.products-block .product-block').each(function(index, element) {
			$(element).parent().addClass("col-fullgrid");
			$(element).parent().removeClass("col-fullwidth");
		});
		
		$('.product-filter .grid').addClass('active');
		$('.product-filter .list').removeClass('active');
	}
	
	set_local('view_type', view);
}

function get_local(name) {
	var result = '';
	
	if (typeof(localStorage) != 'undefined') {
		if (typeof(localStorage[name]) == 'undefined') {
			if (name == 'view_type') {
				localStorage[name] = 'list';
			} else {
				localStorage[name] = '';
			}
		}
		
		result = localStorage[name];
	}
	
	return result;
}

function set_local(name, value) {
	if (typeof(localStorage) != 'undefined') {
		localStorage[name] = value;
	}
}
