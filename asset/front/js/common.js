	//url 이동
	go_url = function ( url) {			
			var url ;			
			location.href= url ;
	}	


var datepicker_option = {
	defaultDate : "+w",
	changeMonth : true,
	numberOfMonths : 1,
	dateFormat : 'yy-mm-dd',
	dayNamesMin : [ '일', '월', '화', '수', '목', '금','토' ],
	monthNames : [ '1월', '2월', '3월', '4월', '5월','6월', '7월', '8월', '9월', '10월', '11월','12월' ],
	monthNamesShort : [ '1월', '2월', '3월', '4월','5월', '6월', '7월', '8월', '9월', '10월','11월', '12월' ],
	// showOn : "button",
	// buttonImage : "/images/layout/calendar.gif",
	buttonImageOnly : false,
};

var ckeditor_option = {
	
}

var validation_option = {
	promptPosition:'topLeft',
	scroll:false
}

var require = {
	baseUrl: '/js'
};

var HmisCommon = {
	numberFormat: function( number ) {
		if(number==0) return 0;
		number = number.toString().replace(/[^0-9]/gi,'');
		number = Number(number);
		var reg = /(^[+-]?\d+)(\d{3})/;
		var n = (number + '');

		while (reg.test(n)) n = n.replace(reg, '$1' + ',' + '$2');

		return n;
	},
	getZindex: function() {
		var elements = document.getElementsByTagName("*");
		var highest_zindex = 0;

		for (var i = 0; i < elements.length - 1; i++) {
			if (parseInt(elements[i].style.zIndex) > highest_zindex) {
				highest_zindex = parseInt(elements[i].style.zIndex);
			}
		}
		return highest_zindex;
	},
	toggleCheck: function(e, el_name) {
		if($(e).prop('checked')) {
			this.checkAll(el_name);
		}
		else {
			this.uncheckAll(el_name);
		}
	},
	checkAll: function(el_name) {
		$('input:checkbox[name="'+el_name+'"]').not(':disabled').prop('checked',true);
	},
	uncheckAll : function(el_name) {
		$('input:checkbox[name="'+el_name+'"]').not(':disabled').prop('checked',false);
	},
	getChecked: function(el_name) {
		var checked = $('input:checkbox[name="'+el_name+'"]:checked');
		return checked;
	},
	setDate: function(ds,de, target_ds, target_de) {
		var target_ds = target_ds || 'sdate_s';
		var target_de = target_de || 'sdate_e';

		$('#'+target_ds).val(ds);
		$('#'+target_de).val(de);
	// 	var date = new Date();
	// 	$('#'+el_end).val(date.toISOString().substring(0,10));
	// 	date.setDate(date.getDate()-parseInt(day));
	// 	$('#'+el_start).val(date.toISOString().substring(0,10));
	},
	createDatepicker : function(){
		$(".datepicker").datepicker(datepicker_option);
	},
	formReset: function(form_id) {
		var form = $('#'+form_id);

		form[0].reset();
		form.find('.btn-group > label').removeClass('active');
		form.find('.btn-group > label > input:radio:checked').parent('label').addClass('active');
	}
}


var HmisModal = function(modal_id, settings) {
	this.modal_id = 'RUModal_'+modal_id;
	this.tpl = '<div id="'+this.modal_id+'" class="modal" ><div class="modal-content" ><span class="btn modal-close close"><i class="fa fa-times"></i></span><div class="modal-body"></div><div class="modal-footer"></div></div></div><div id="'+this.modal_id+'_backdrop" class="modal-backdrop"></div>';
	var zIndex = HmisCommon.getZindex();

	this.settings = settings || {zIndex:(zIndex+10), location:document};
	this.init();
};

HmisModal.prototype = {
	modal:'',
	duration:200,
	settings:{},
	init:function() {
		if(!$('#'+this.modal_id, top.document).length) {
			$("body", this.settings.location).append(this.tpl);
		}
		this.modal = $('#'+this.modal_id, top.document);
		this.modal.find('button.modal-close').click(this.close.bind(this));
		this.backdrop = $('#'+this.modal_id+'_backdrop', this.settings.location);
	},
	open:function(title, url, param, callback) {

		if(this.settings.zIndex) {
			this.backdrop.css('z-index', this.settings.zIndex);
			$('#'+this.modal_id).css('z-index', this.settings.zIndex+1);
			$('#'+this.modal_id).css('z-index');
		}
		$('#'+this.modal_id).css('z-index',"10001");
		if(this.settings.width) this.setSize(this.settings.width);
		if(this.settings.height) this.setSize(null, this.settings.height);
		//
		this.backdrop.fadeIn(this.duration);
		this.title(title);
		this._load(url, param, callback);
		this.modal.draggable();
	},
	close: function() {
		var me = this;
		this.modal.fadeOut(this.duration, function() {
			$(this).remove();
		});
		this.backdrop.fadeOut(this.duration, function() {
			$(this).remove();

			if($.isFunction(me.settings.close)) {
				me.settings.close();
			}
		});
	},
	html:function(html) {
		var spot = this.modal.find('.modal-body');
		spot.html(html);
	},
	show:function() {
		this._center();
		this.backdrop.fadeIn(this.duration);
	},
	hide: function() {
		this.modal.addClass('hide');
		this.backdrop.addClass('hide');
	},
	remove: function() {

	},
	setSize: function(width, height) {
		var body = this.modal.find('.modal-body');
		if(width) body.css('width', width+'px');
		if(height) body.css('height', height+'px');
	},
	title:function(title) {
		this.modal.find('.modal-title').html(title||'modal');
	},
	_load:function(url, param, callback) {
		var self = this;
		var spot = this.modal.find('.modal-body');
		$.ajax({
			url:url,
			data:param,
			dataType:'html',
			type:'POST',
			success: function(r) {
				spot.html(r);
				self._center();
				self.modal.find('.modal-close').click(self.close.bind(self)); //모달창 안에 있는 닫기 버튼
				if($.isFunction(callback)) callback();
			}
		});
	},
	_center:function(){
   	 	var self = this;
   	 	this._position();
  	 	$(window).resize(function() { self._position() });
	},
	_position: function() {
		var e = this.modal;
   	 	var half = {width: e.outerWidth() / 2, height: e.outerHeight() / 2}
   	 	//
		if(this.settings.top) e.css({top: this.settings.top+'px', left: '50%', marginTop:0, marginLeft: -(half.width)+'px'});
		else e.css({top: '50%', left: '50%', marginTop: -(half.height)+'px', marginLeft: -(half.width)+'px'});
		//
		var pos = e.position();
		if(pos.left<half.width) e.css({left:0, marginLeft:0});
		if(!this.settings.top && pos.top<half.height) e.css({top:0, marginTop:0});
	}
}



Number.prototype.number_format = function(round_decimal) {
	return this.toFixed(round_decimal).replace(/(\d)(?=(\d{3})+$)/g, "$1,");
};


function bbs_input(bbs_code) {
	document.location = "/bbs_input/" + bbs_code;
}

function bbs_view(bbs_code, id) {
	document.location = "/bbs_view/" + bbs_code + "/" + id;
}
	
function open_bbs(bbs_code) {
	window.open("/bbs/"+bbs_code, "sms_popup", "toolbar=no, scrollbars=yes, resizable=no, top=0, left=0, width=850, height=650"); 		   
}


function is_checked(parent_id) {

	parent_id = "#" + parent_id;
	var checked_num = 0;
	
	for ( var i = 0; i < $(parent_id).find("input:checkbox[name='chk[]']").length; i++) {
		if ($(parent_id).find("input:checkbox[name='chk[]']")[i].checked) checked_num++;
	}

	return checked_num;

}



function select_all(parent_id, check_id) {
	parent_id = "#" + parent_id;
	check_id = "#" + check_id;

	var checkValue = true;
	if ($(check_id).is(":checked") == false) {
		checkValue = false;
	}
	for ( var i = 0; i < $(parent_id).find("input:checkbox").length; i++) {		
		if ($(parent_id).find("input:checkbox")[i].checked != checkValue) {
			if ($(parent_id).find("input:checkbox")[i].disabled == false) $(parent_id).find("input:checkbox")[i].checked = checkValue;
		}
	}
}


function zero_fill(str, cnt) { 
	str = '0000000000000000000'+str; 
    return str.substr(str.length-cnt, cnt); 
} 



function display_list() {

	var data = $('#srch-frm').serialize();
	var url = $('#list-url').val();
	$.ajax({
		type : "GET",
		url : url,
		data : data,
		success : function(result_data) {
			$('#list-area').html(result_data);
			$("#list-area").fadeIn();
		}
	});

}
	
	

function open_sms(MODE) {
   var url = "/sms/main";
   window.open(url, "sms_popup", "toolbar=no, scrollbars=yes, resizable=no, top=0, left=0, width=920, height=580"); 
   
   if (MODE == "LIST") {
	   $("#list-frm").attr("target", "sms_popup");
	   $("#list-frm").attr("action", url);
	   $("#list-frm").attr("method", "POST");
	   $("#list-frm").submit();
   }
}

	
$(document).ready(function() {
    
    if($('body').find('.countdown').length > 0) {
        setInterval(function() {
            $.each($('body').find('.countdown'), function() {
                t = $(this);                
                h = t.text().substr(0,2) * 1;
                m = t.text().substr(3,2) * 1;
                s = t.text().substr(6,2) * 1;
                if(h > 0 || (h == 0 && m > 0) || (h == 0 && m == 0 && s > 0)) {
                    if(s == 0) {
                        s = 59;
                        if(m == 0) {
                            m = 59;
                            if(h == 0) {
                                h = 24;
                            } else {
                                h = h - 1;
                            } 
                        } else {
                            m = m - 1;
                        } 
                    } else {
                        s = s - 1;
                    } 
                }

            	var str = 2; 
                t.text(zero_fill(h, 2)+ ':' +zero_fill(m, 2)+ ':' + zero_fill(s, 2));
            })
        }, 1000);
    }
});    



function add_favorites(url, title){
	var url = "http://"+url;
	
	if(document.all){ // IE
		window.external.AddFavorite(url, title);
	}else if(window.chrome){ // Google Chrome
		alert("Ctrl+D키를 누르시면 즐겨찾기에 추가하실 수 있습니다.");
	}else if (window.sidebar && window.sidebar.addPanel){ // Firefox
		window.sidebar.addPanel(title, url,"");
	}else{ // Opera
		var elem = document.createElement('a'); 
		elem.setAttribute('href',url); 
		elem.setAttribute('title',title); 
		elem.setAttribute('rel','sidebar'); 
		elem.click(); 
	}
	
}


function disableSelection(target) {
	if (typeof target.onselectstart != "undefined") {
		target.onselectstart = function() {
			return false
		}

	} else if (typeof target.style.MozUserSelect != "undefined") {
		target.style.MozUserSelect = "none"

	} else {
		target.onmousedown = function() {
			return false
		}
		target.style.cursor = "default";
	}
}


function print_contents() {
	window.print();
}
