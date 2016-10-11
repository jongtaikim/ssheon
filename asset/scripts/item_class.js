/**
 * Created by now17 on 2016-08-22.
 */
var load_data ='';
var tie  = Array('primary','info','warn','dark','danger','success','light' ,'default');
var p_item_category='';
var p_item_list='';
var p_title='';
var select_config_id = '';
var p_master_yn = '';
var ing_type = '';
var ing_val = '';
var p_param = '';
var p_param2 = '';
var this_view = '';


var item_class = {
    load:function(item_category,item_list,title,config_id,master_yn){

        if(ing_type !='' && ing_val !='') {
            bootbox.alert('아직 반영되지 않은 데이터가 있습니다. <br><br>먼저 저장해주시기 바랍니다.');
            return false;
        }else {

            p_item_category = item_category;
            p_item_list = item_list;
            p_title = title;
            select_config_id = config_id;
            p_master_yn = master_yn;


            $.cookie('p_item_category',p_item_category);
            $.cookie('p_item_list',p_item_list);
            $.cookie('p_title',p_title);
            $.cookie('select_config_id',select_config_id);
            $.cookie('p_master_yn',p_master_yn);

            if (master_yn != 'Y') {
                $('#master_set_btn').show();
                $('#master_del_btn').show();
                $('#master_info').hide();
            } else {
                $('#master_set_btn').hide();
                $('#master_del_btn').hide();
                $('#master_info').show();

            }

            if (title) {
                $('.config_list').removeClass('active');
                $('.p' + md5(title)).addClass('active');
                $('.config_label').html(title);
            }
            if (item_category) {
                $('#data_view_body').html('');
                $('#left_menu').html('');
                $.ajax({
                    type: 'GET',
                    url: '/admin/item_cate/category_list?no=' + item_category,
                    dataType: 'json',
                    success: function (data, status) {
                        load_data = data;

                        //item_class.list_tpl(data.zone_list,'zone_list');
                        $('.op_ties').remove();
                        $('.select_ui').val('');
                        item_class.view_assets();

                        setTimeout(function(){
                            item_class.set_box('zone', '영역 리스트', 40,'hide');
                            item_class.list_tpl(data.zone_list, 'zone');

                            item_class.set_box('idc', 'IDC 리스트', 40, 'hide');
                            item_class.list_tpl(data.idc_list, 'idc');

                            item_class.set_box('vendor', 'Vendor 리스트', 40, 'hide');
                            item_class.list_tpl(data.vendor_list, 'vendor');

                            item_class.set_box('license', 'License 리스트', 40, 'hide');
                            item_class.list_tpl(data.license_list, 'license');

                            item_class.set_box('os', 'OS 리스트', 40, 'hide');
                            item_class.list_tpl(data.os_list, 'os');

                            item_class.set_box('rack', 'Rack 리스트', 40, 'hide');
                            item_class.list_tpl(data.rack_list, 'rack');

                            item_class.set_box('ptype', '장비구분 리스트', 40, 'hide');
                            item_class.list_tpl(data.ptype_list, 'ptype');

                        },200);


                    },
                    error: function (request, status, error) {
                        alert(request.responseText);
                    }
                });
            }
        }
    }, //
    list_tpl:function(row_data,target_id){
        var html = '';

        if(row_data) {
            data = explode(",", row_data);

            for (i = 0; i < data.length; i++) {
                if (data[i]) {
                    item_class.make_list_item(data[i],target_id);
                    $('#'+target_id+'_select_box').append('<option value="'+data[i]+'" class="op_ties">'+data[i]+'</option>');
                }

            }
            $('#'+target_id+'_list').find('.total_counter').html('').html(data.length);
            $('.'+target_id+'_total_counter').html('').html(data.length);
        }else{
            $('#'+target_id+'_list').find('.total_counter').html('0');
            $('.'+target_id+'_total_counter').html('0');
        }

    },//
    make_list_item:function (title,target_id,add_style) {
        var html='';
        var idx = $('#' + target_id + '_list').children().length;
        if(title) {

            html += '<li class="list-item2 b-b " id="'+target_id+'_item_'+idx+'" style=";'+add_style+';" tid="'+target_id+'">';
            html+='  <input type="hidden" name="item[]" class="'+target_id+'_hidden" value="'+title+'" />';
            html += '     <div class="">';
            html += '     <div class="m-y-sm pull-right">';
            html += '             <a href="javascript:item_class.modify_item(\''+idx+'\',\''+title+'\',\''+target_id+'\')" class="btn btn-xs white btn-icon"><i class="fa fa-pencil"></i></a>';
            html += '             <a href="javascript:item_class.del_item(\''+idx+'\',\''+title+'\',\''+target_id+'\')" class="btn btn-xs white btn-icon"><i class="fa fa-times"></i></a>';
            html += '     </div>';
            html += '     <div style="padding-top:12px" class="ft16 item_name">' + title + '</div>';
            html += ' </div>';
            html += '</div>';
            html += '</li>';

            $('#' + target_id + '_list').append(html);
        }
    },//
    set_box:function (id,title,w,classp) {
        if(!w) w = '40';
        var html = '';
        html+='<div class="animated fadeInUp body_item '+classp+' " id="'+id+'_body">';
        html+='<div class="" style="width:'+w+'%"><form id="'+id+'_form">';


        html+='<div class="box">';
        html+='<div class="box-header b-b clearfix">';
        html+='<div class="f_l p-t5">';
        html+='<h3>'+title+' <span class="label warning '+id+'_total_counter" ></span></h3>';
        html+='</div>';
        html+='<div class="f_r"><a  class="btn btn-xs btn-default '+id+'_add_btn" href="javascript:item_class.add_item(\''+id+'\');"><i class="fa fa-plus"></i> 항목추가</a></div>';
        html+='</div>';
        html+='<ul class="list inset" id="'+id+'_list"></ul>';
        html+='</div>';
        html+='<div class="text-center"><input type="button" id="" value="저장하기" onclick="item_class.item_update(\''+id+'\');" class="btn btn-sm btn-info"></div>';
        html+='</div>';

        html+='</div></form>';

        $('#data_view_body').append(html);

        item_class.make_left_menu(id,title);


    },//
    make_left_menu:function (id,title) {
        var html ='';
        var idx = $('#left_menu').children().length;
        var classp = '';
        if(!idx){
            idx = 0;
            classp = 'active';
        }
        html +='<li class="nav-item">';
        html +='<a class="nav-link left_menu '+classp+'" id="'+id+'_left_menu" href="javascript:item_class.select_leftmenu(\''+id+'\')">';

        html +='<i class="fa m-r-sm fa-circle text-'+tie[idx]+'"></i>';
        html +=title;
        html +='</a></li>';

        $('#left_menu').append(html);

    },//


    select_leftmenu:function(id){

        if(ing_type !='' && ing_val !='') {
            bootbox.alert('아직 반영되지 않은 데이터가 있습니다. <br><br>먼저 저장해주시기 바랍니다.');
            return false;
        }else {
            $('#data_view_body').show();
            $('#data_view_list').hide();

            $('.body_item').hide().removeClass('hide');
            $('#' + id + '_body').show();
            $('.left_menu').removeClass('active');
            $('#' + id + '_left_menu').addClass('active');
        }
    },//
    add_item:function (id) {
        if(ing_type !='' && ing_val !='') {
            bootbox.alert('아직 반영되지 않은 데이터가 있습니다. <br><br>먼저 저장해주시기 바랍니다.');
            return false;
        }else {
            var nos = '';
            bootbox.prompt("추가할 항목을 입력해주세요.", function (result) {
                if (result === null) {

                } else {
                    $('#' + id + '_form').find('input[type=hidden]').each(function () {
                        if ($(this).val() == result) {


                            alert('이미 추가되어있는 항목입니다.');
                            nos = 'y';
                            return false;
                        }
                    });

                    if (!nos) {
                        //중복
                        item_class.make_list_item(result, id,' border: 1px dashed #898994; ');
                        ing_type = id;
                        ing_val = result;

                    } else {
                        //item_class.add_item(id);
                    }
                }
            });
        }
    },//


    modify_item:function (id,val,target_id) {
        if(ing_type !='' && ing_val !='' && ing_val != val) {
            bootbox.alert('아직 반영되지 않은 데이터가 있습니다. <br><br>먼저 저장해주시기 바랍니다.');
            return false;
        }else {



            var re_val = '';
            $.ajax({
                type: 'GET',
                url: '/admin/item_cate/chk_values?cum='+encodeURIComponent(target_id)+'&val='+encodeURIComponent(val)+'&item_list_no='+p_item_list,

                dataType: 'json',
                success: function(data, status) {

                   if(data.state == "ok"){
                       bootbox.prompt({
                           title: "내용을 변경합니다.",
                           value: val,
                           callback: function (result) {
                               if (result === null) {

                               } else {
                                   if (result != val && val != '') {

                                       $('#'+target_id+'_item_' + id).find('input[type=hidden]').val(result);
                                       $('#'+target_id+'_item_' + id).find('.item_name').html(result);

                                       ing_type = id;
                                       ing_val = result;
                                   }
                               }
                           }
                       });
                   }else{
                       bootbox.alert('이미 사용하고 있는 항목입니다.<br>수정/삭제 불가합니다.');
                   }

                }
            });



        }
    },//

    del_item:function (id,val,target_id) {

        if(ing_type !='' && ing_val !='' && ing_val != $('#'+target_id+'_item_' + id).find('input[type=hidden]').val()) {
            bootbox.alert('아직 반영되지 않은 데이터가 있습니다. <br><br>먼저 저장해주시기 바랍니다.');
            return false;
        }else {
            var re_val = '';
            $.ajax({
                    type: 'GET',
                    url: '/admin/item_cate/chk_values?cum='+encodeURIComponent(target_id)+'&val='+encodeURIComponent(val)+'&item_list_no='+p_item_list,

                    dataType: 'json',
                    success: function(data, status) {

                        if(data.state == "ok"){
                            bootbox.confirm("정말 삭제하시겠습니까?", function (result) {
                                if (result) {

                                    if(ing_val == $('#'+target_id+'_item_' + id).find('input[type=hidden]').val()){
                                        ing_type = '';
                                        ing_val = '';

                                    }else {
                                        ing_type = id;
                                        ing_val = $('#'+target_id+'_item_' + id).find('input[type=hidden]').val();
                                    }
                                    $('#'+target_id+'_item_' + id).remove();

                                }
                            });
            }else{
                bootbox.alert('이미 사용하고 있는 항목입니다.<br>수정/삭제 불가합니다.');
            }

                    }
            });
        }
    },//
    item_update:function (id,msg) {
        var items = '';
        $('#'+id+'_form').find('input[type=hidden]').each(function(){
            items+=$(this).val()+',';
        });

        //if(items) {

        $.ajax({
            type: 'GET',
            url: '/admin/item_cate/category_update?type='+id+'&no=' + select_config_id+'&val='+encodeURIComponent(items),
            dataType: 'json',
            success: function (data, status) {

                if(data.state=='ok'){
                    if(msg){
                        bootbox.alert(msg);
                    }else{
                        bootbox.alert('변경되었습니다.');
                    }
                    ing_type='';
                    ing_val='';

                }

            },
            error: function (request, status, error) {
                alert(request.responseText);
            }
        });
        //}

    },//
    set_master:function(master_id){
        if(ing_type !='' && ing_val !='') {
            bootbox.alert('아직 반영되지 않은 데이터가 있습니다. <br><br>먼저 저장해주시기 바랍니다.');
            return false;
        }else {
            bootbox.confirm("이 버전을 MASTER로 설정하시겠습니까?", function (result) {
                if (result) {
                    //encodeURIComponent()
                    $.ajax({
                        type: 'GET',
                        url: '/admin/item_cate/set_master?set_master_id=' + master_id,
                        data: '',
                        dataType: 'json',
                        success: function (data, status) {
                            if (data.state == 'ok') {
                                bootbox.alert('변경되었습니다.');
                                location.reload();
                            }
                        },
                        error: function (request, status, error) {
                            alert(request.responseText);
                        }
                    });

                }
            });
        }
    },//
    new_master:function () {
        if(ing_type !='' && ing_val !='') {
            bootbox.alert('아직 반영되지 않은 데이터가 있습니다. <br><br>먼저 저장해주시기 바랍니다.');
            return false;
        }else {
            bootbox.prompt({
                title: "신규버전을 추가합니다. 이름을 입력해주세요.",
                callback: function (result) {
                    if (result === null) {

                    } else {
                        //encodeURIComponent()
                        $.ajax({
                            type: 'GET',
                            url: '/admin/item_cate/new_master?title=' + encodeURIComponent(result),
                            dataType: 'json',
                            success: function (data, status) {
                                var html = '';
                                if (data.state == 'ok') {
                                    console.log(data);

                                    html = '<a class="nav-link config_list p' + md5(data.item_config_name) + '" href="javascript:item_class.load(\'' + data.item_category_ver_no + '\',\'' + data.item_list_ver_no + '\',\'' + data.item_config_name + '\',\'' + data.no + '\',\'' + data.item_use + '\');">' + data.item_config_name + ' ('+data.item_assets_count +')</a>';

                                    $('#ver_list').append(html);

                                    item_class.load(data.item_category_ver_no, data.item_list_ver_no, data.item_config_name, data.no, 'N');
                                }
                            },
                            error: function (request, status, error) {
                                alert(request.responseText);
                            }
                        });
                    }
                }
            });
        }
    },//
    copy_master:function () {
        if(ing_type !='' && ing_val !='') {
            bootbox.alert('아직 반영되지 않은 데이터가 있습니다. <br><br>먼저 저장해주시기 바랍니다.');
            return false;
        }else {
            bootbox.prompt({
                title: "버전을 복사합니다. 이름을 입력해주세요.",
                value: p_title + ' - '+date('Ymd'),
                callback: function (result) {
                    if (result === null) {

                    } else {
                        //encodeURIComponent()
                        //var p_item_category='';
                        //var p_item_list='';

                        $('#loading').show();
                        $.ajax({
                            type: 'GET',
                            url: '/admin/item_cate/copy_master?title=' + encodeURIComponent(result) + '&cate_no=' + p_item_category + '&list_no=' + p_item_list,
                            dataType: 'json',
                            success: function (data, status) {
                                var html = '';
                                if (data.state == 'ok') {
                                    console.log(data);

                                    html = '<a class="nav-link config_list p' + md5(data.item_config_name) + '" href="javascript:item_class.load(\'' + data.item_category_ver_no + '\',\'' + data.item_list_ver_no + '\',\'' + data.item_config_name + '\',\'' + data.no + '\',\'' + data.item_use + '\');">' + data.item_config_name + ' ('+data.item_assets_count +')</a>';

                                    $('#ver_list').append(html);

                                    item_class.load(data.item_category_ver_no, data.item_list_ver_no, data.item_config_name, data.no, 'N');
                                    $('#loading').hide();
                                }
                            },
                            error: function (request, status, error) {
                                alert(request.responseText);
                            }
                        });
                    }
                }
            });
        }
    },//

    del_master:function () {
        if(ing_type !='' && ing_val !='') {
            bootbox.alert('아직 반영되지 않은 데이터가 있습니다. <br><br>먼저 저장해주시기 바랍니다.');
            return false;
        }else {
            bootbox.prompt({
                title: "선택한 버전을 삭제합니다. ",
                placeholder: "버전을 삭제를 원하시면 해당 버전 이름을 적어주세요.",
                callback: function (result) {
                    if (result == p_title) {

                        bootbox.confirm("정말 삭제하시겠습니까?", function (result) {
                            if (result) {


                                $('#loading').show();
                                $.ajax({
                                    type: 'GET',
                                    url: '/admin/item_cate/delete_master?set_master_id=' + select_config_id,
                                    dataType: 'json',
                                    success: function (data, status) {
                                        var html = '';
                                        if (data.state == 'ok') {

                                            location.reload();
                                        }
                                    },
                                    error: function (request, status, error) {
                                        alert(request.responseText);
                                    }
                                });


                            }
                        });
                    }
                }
            });
        }
    },//

    view_assets:function (param) {
        if(ing_type !='' && ing_val !='') {
            bootbox.alert('아직 반영되지 않은 데이터가 있습니다. <br><br>먼저 저장해주시기 바랍니다.');
            return false;
        }else {

            if(!param) param = '';
            if(!param && p_param) param = p_param;

            $.ajax({
                type: 'GET',
                url: '/admin/item/index?no_head=y&config_id=' + select_config_id + '&' + param,
                data: '',
                dataType: 'html',
                success: function (html, status) {
                    $('#data_view_body').hide();
                    $('#data_view_list').show();
                    $('#data_view_list').html(html);
                    $('.left_menu').removeClass('active');
                    $('#zone1_left_menu').addClass('active');
                    p_param = param;

                    this_view = 'view_assets';

                },
                error: function (request, status, error) {
                    alert(request.responseText);
                }
            });

        }
    },//
    add_assets:function (param) {
        if(ing_type !='' && ing_val !='') {
            bootbox.alert('아직 반영되지 않은 데이터가 있습니다. <br><br>먼저 저장해주시기 바랍니다.');
            return false;
        }else {
            //encodeURIComponent()
            if(!param) param = '';



            $.ajax({
                type: 'GET',
                url: '/admin/item/add?no_head=y&config_id=' + select_config_id + '&' + param,
                data: '',
                dataType: 'html',
                success: function (html, status) {
                    $('#data_view_body').hide();
                    $('#data_view_list').show();
                    $('#data_view_list').html(html);
                    $('.left_menu').removeClass('active');
                    $('#zone2_left_menu').addClass('active');

                },
                error: function (request, status, error) {
                    alert(request.responseText);
                }
            });

        }
    },//
    edit_assets:function (param) {
        if(ing_type !='' && ing_val !='') {
            bootbox.alert('아직 반영되지 않은 데이터가 있습니다. <br><br>먼저 저장해주시기 바랍니다.');
            return false;
        }else {
            //encodeURIComponent()

            if(!param) param = '';

            $.ajax({
                type: 'GET',
                url: '/admin/item/edit/no'+param+'?no_head=y&config_id=' + select_config_id+'&no='+param,
                data: '',
                dataType: 'html',
                success: function (html, status) {
                    if(html){


                    $('#data_view_body').hide();
                    $('#data_view_list').show();
                    $('#data_view_list').html(html);
                    $('.left_menu').removeClass('active');
                    $('#zone1_left_menu').addClass('active');

                    }else{
                        bootbox.alert('삭제되었거나 변경된 데이터입니다.');
                    }

                },
                error: function (request, status, error) {
                    alert(request.responseText);
                }
            });

        }
    },//
    view_assets_history:function (param) {
        if(ing_type !='' && ing_val !='') {
            bootbox.alert('아직 반영되지 않은 데이터가 있습니다. <br><br>먼저 저장해주시기 바랍니다.');
            return false;
        }else {
            //encodeURIComponent()
            if(!param) param = '';
            if(!param && p_param2) param = p_param2;
            //if(!param && !p_param2 && p_param) param = p_param;

            $.ajax({
                type: 'GET',
                url: '/admin/item_history/index?no_head=y&config_id=' + select_config_id + '&' + param,
                data: '',
                dataType: 'html',
                success: function (html, status) {

                    $('#data_view_body').hide();
                    $('#data_view_list').show();
                    $('#data_view_list').html(html);
                    $('.left_menu').removeClass('active');
                    $('#zone3_left_menu').addClass('active');
                    p_param2 = param;

                    this_view = 'view_assets_history';

                },
                error: function (request, status, error) {
                    alert(request.responseText);
                }
            });

        }
    },//
    rollback_assets:function (tid,oid) {
        if(ing_type !='' && ing_val !='') {
            bootbox.alert('아직 반영되지 않은 데이터가 있습니다. <br><br>먼저 저장해주시기 바랍니다.');
            return false;
        }else {
            //encodeURIComponent()


                        bootbox.confirm("정말 데이터를 롤백 하시겠습니까?", function (result) {
                            if (result) {


                                $('#loading').show();
                                $.ajax({
                                    type: 'GET',
                                    url: '/admin/item_history/roll_back?set_master_id=' + select_config_id+"&tid="+tid+"&oid="+oid,
                                    dataType: 'json',
                                    success: function (data, status) {
                                        var html = '';
                                        if (data.state == 'ok') {

                                            location.reload();
                                        }
                                    },
                                    error: function (request, status, error) {
                                        alert(request.responseText);
                                    }
                                });


                            }
                        });



        }
    },//


};
