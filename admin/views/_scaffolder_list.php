<?
foreach( $_GET as $val => $value )
{

    if(substr($val,0,3) == 'sch' || $val == 'limit'){
        $sch_text .= "&".$val."=".$value;
        if(substr($val,0,3) == 'sch'){
            $sch_text_info .= $value." > ";
        }
    }

}
$sch_text_info = substr($sch_text_info,0,strlen($sch_text_info)-3);
?>
<script type="text/javascript">

    var table_list_data = '';

    function tableListCtrl($scope, $http) {
        $scope.init = function(id) {

            $http.get('/admin/'+id + '/list_json?per_page=<?=$_GET['per_page']?>&keyword=<?=$_GET['keyword']?>&config_id=<?=$_GET['config_id']?><?=$sch_text?>')
                .then(function(res){


                    $scope.items = res.data.items;
                    //$scope.pagehtml = res.data.pagehtml;
                    table_list_data =  res.data;
                    try{
                        page_init(table_list_data);

                        $('#loading2').hide();

                    }catch (e){

                    }
                });
        };
    }
</script>
<div id="title-area" class="" style="width:100%;"><?=$schema['name']?> 목록</div>


<div class=" pos_a" style="right:40px;top:20px">
    <div class="clearfix">


        <div class="w480 " style="float: right">
            <div class="f_l w80">

            </div>
            <div class="input-group f_r w700" style="margin-top:-4px">

                <? if($one_page) : ?>
                    <? if($enable_add) : ?>
                        <div class="form-group l-h m-a-0  col-sm-4 f_r  text-right" >

                            <a href="#" onclick="page_view('/admin/<?=$schema['id']?>/add')" class="btn btn-sm btn-success " style="width:90%;color:#fff" >+ 새 <?=$schema['name']?></a>

                        </div>
                    <? endif; ?>
                    <div class="form-group l-h m-a-0 col-sm-4 f_r text-right " style="margin-right:0px;padding-right:0px">
                        <div class="input-group input-group-sm f_r">
                            <input type="text" class="form-control p-x b-a rounded" style="background-color: #fff"   type="text" id="keyword" value="<?=$_GET['keyword']?>" placeholder="검색..."><span class="input-group-btn"><button type="button" class="btn white b-a rounded no-shadow search-btn"><i class="fa fa-search"></i></button></span>
                        </div>
                    </div>

                <? endif; ?>

            </div>
        </div>

    </div>

</div>

<script src="/asset/js/angular.min.js" type="text/javascript"></script>

<div class="padding <? if(!$_GET['ajax']){?>hide<?}?>  fadeInDown" id="data_body" style="<? if($width){?>width:<?=$width?>;<?=$style?><?}?>">


        <?if($total_box){?>
            <div class="clearfix m-t10 p-l10">
                <div class="row-col box-shadow2 text-center gray m-b20 b-b b-l b-r b-t " >

                    <? for($ii=0; $ii<count($total_box); $ii++) {?>
                        <div class="row-cell p-a b-r">
                            <div class="m-b10"><?=$total_box[$ii]['title']?></div>
                            <h4 class="m-a-0 text-md _600"><?=$total_box[$ii]['cu']?></h4>
                        </div>
                    <? } ?>

                </div>
            </div>
        <?}?>






        <div class=" ft12 " ng-app="myapp" ng-controller='tableListCtrl' ng-init="init('<?=$schema['id']?>')" >



            <? if($top_text){?>
                <div class="box m-b20 box-shadow" style="border:1px solid #f4f4f4;margin:0 auto;width:<?=$top_text_width?>">
                    <?if($top_text_subject){?><div class="box-header ft14"><strong><?=$top_text_subject?></strong></div><?}?>
                    <div class="box-body b-t"><?=$top_text?></div>
                </div>
                <br>
            <?}?>

            <table class="table box  table-bordered b-b b-l b-t b-r ft12 box-shadow" style="margin:10px auto;min-width:700px;">

                <!-- Table Header -->
                <thead>
                <tr  >
                    <? $i=0;?>
                    <? foreach ($fields as $key => $val) : ?>

                        <? if($i==0){?>
                            <? if(!$no_hidden){ ?>
                                <th class="text-center" style="background-color: #f3f3f3;width:100px">번호</th>
                            <?}?>
                        <?}?>

                        <? if($val['list_hide']) continue; ?>
                        <? if($key=="no" && !$enable_add) continue ?>
                        <? if($key=="no") : ?>
                            <th class="text-center" style="background-color: #f3f3f3"><?=$edit_btn_name?></th>
                        <? else : ?>
                            <th ng-click="predicate = '<?=$key?>'; reverse=!reverse" class="text-center" style="background-color: #f3f3f3"><?=$fields[$key]['title']?></th>
                        <? endif; ?>


                        <? $i++;?>
                    <? endforeach; ?>

                </tr>
                </thead>
                <!-- Table Header -->

                <? if($one_page) : ?>
                    <!-- Table Body -->
                    <tbody class="items" id="items_tbody">
                    <tr ng-repeat="item in items | filter:query " >
                        <? $i=0;?>
                        <? foreach ($fields as $key => $val) : ?>

                            <? if($i==0){?>
                                <? if(!$no_hidden){ ?>
                                    <td class="text-center">{{item.no}}</td>
                                <?}?>
                            <?}?>

                            <? if($val['list_hide']) continue; ?>

                            <? if($key=="no" && !$enable_add) continue ?>


                            <td style="max-width:300px;;<?=$val['list_style']?>"  class="<? if($key=="no") {?> text-center <?}?>"><span style="width:100%;word-break:break-all;;<?=$val['sub_style']?>" class="" <? if($key=="no" && $val['html']) { ?>ng-bind-html-unsafe="item.<?=$key?>"<?}?> >

                                <? if($val['nghref']) : ?>
                                    <a href="#<?=$schema['id']?>/edit/no{{item.no}}">
                                <? endif; ?>

                                        <? if($key=="no") : ?>
                                            <a href="#" onclick="page_view('/admin/<?=$schema['id']?>/edit/no{{item.no}}');"  class=" btn btn-default btn-xs" style="<?=$val['sub_style']?>"><?=$edit_btn_name?></a>

                                        <? elseif($val['image']) : ?>
                                            <img src="{{item.<?=$key?>}}" <?if($val['img_w']){?>width="<?=$val['img_w']?>"<?}?> <?if($val['img_h']){?>height="<?=$val['img_h']?>"<?}?> style="<?=$val['sub_style']?>" class="<?=$val['sub_class']?>"/>
                                        <? else : ?>
                                            {{item.<?=$key?>}}<?=$val['label']?>
                                        <? endif; ?>

                                        <? if($val['nghref']) : ?></a><? endif; ?>


                            </span></td>
                            <? $i++;?>
                        <? endforeach; ?>
                    </tr>
                    </tbody>
                    <!-- Table Body -->

                <? else : ?>
                <? endif; ?>


            </table>

            <div class="text-center" id="pagehtml">

            </div>
        </div>

</div>

<script type="text/javascript">
    function page_view(url){
        //encodeURIComponent()
        $.ajax({
        type: 'GET',
        url: url,

        dataType: 'html',
        	success: function(html, status) {
                bootbox.alert(html);
                $('.modal-footer ').remove();
        	},
        	error: function(request,status,error) {
        		alert(request.responseText);
        	}
        });
    }

    function list_page_view(url) {
        //encodeURIComponent()
        $.ajax({
        type: 'GET',
        url: url,
        data:'&ajax=y',
        dataType: 'html',
        	success: function(html, status) {
                $('#content_body').html(html);
        	},
        	error: function(request,status,error) {
        		alert(request.responseText);
        	}
        });
    }

    function page_init(data) {

        if(data.total >0) {
            $('#pagehtml').html(data.pagehtml);
            $('#page_sub_title').html("총 " + number_format(data.total) + '건의 데이터가 검색되었습니다.');



            $('.pagination > li > a').each(function () {
                if ($(this).attr('href')) {
                    var ast = explode("?", location.hash);
                    $(this).attr('href', "javascript:list_page_view('"+ast[0] + "?" + str_replace("?", "", $(this).attr('href'))+"');");
                }
            });




        }else{

            $('#items_tbody').html('<tr><td colspan="<?=count($fields)+1?>" class="text-center">데이터가 없습니다.</td></tr>');
        }



    }



    $(document).ready(function(){
        setTimeout(function () {

            $('#keyword').focus();

            $('#loading2').hide();
            $('#data_body').show().removeClass('hide');

            $('.search-btn').click(function(){
                var ast = explode("?",location.hash);
                location.href=ast[0]+"?keyword="+$('#keyword').val();

            });

            $('#keyword').keyup(function(evert){
                if(evert.keyCode == 13) {
                    var ast = explode("?", location.hash);
                    location.href = ast[0] + "?keyword=" + $('#keyword').val();

                }
            });

        },300);
    });


    function balert(url) {
        //encodeURIComponent()
        $.ajax({
            type: 'GET',
            url: url,

            dataType: 'json',
            success: function(data, status) {
                if(data){
                    if(data.result.html){
                        bootbox.alert(data.result.html);
                    }
                }
            },
            error: function(request,status,error) {
                alert(request.responseText);
            }
        });
    }


</script>