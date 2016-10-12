

<div id="title-area" class="m-t10" style="margin-top:10px"><?=$schema['name']?> <?=$is_edit?"수정":"생성"?></div>

<script>
small_menu='';
var word = '<?=$is_edit?"수정":"생성"?>';
$(document).ready(function (){
	$('#act-button').click(function() {


			var url = '/admin/<?=$schema['id']?>/<?=$is_edit?"edit_action":"add_action"?>';
			$.ajax({
				type: 'post',
				url: url,
				data: $('#item-form').serialize(),
				dataType:"html",
				error: function(xhr, e){

					alert('이미 등록되어있는 날짜 이거나 형식에 맞지 않는 날짜입니다.');
					console.log(xhr.responseText);
				},
				success: function(result) {


					if(result.error) {
						alert(result.messages);
					} else {
						alert(word+"하였습니다.");


                       location.reload();

					}
				}
			});


	});

	$('#del-button').click(function() {
		if(confirm("정말로 이 <?=$schema['name']?>(을)를 삭제하시겠습니까?")) {
			var url = '/admin/<?=$schema['id']?>/delete_action';
			$.ajax({
				type: 'post',
				url: url,
				data: $('#item-form').serialize(),
				dataType: 'json',
				error: function(xhr, e){
					showAlert(word+' 페이지에 접속할 수 없습니다.', 'error', 3000);
					console.log(xhr.responseText);
				},
				success: function(result) {
					if(result.error) {
						alert(result.messages);
					} else {
						alert("삭제하였습니다.");


                        location.reload();

					}
				}
			});
		}
	});

	$('.multiselect_uncheck_btn').click(function(){
		$(this).closest('.control-group').find('.controls').find('select option:selected').prop('selected',false);
	});
});
</script>

<div class="   pos_r" id="in_add_form" >
    <form id="item-form" class="form-horizontal">
    <div class="    " style="">

        <div class="box-body">


            <form id="item-form" class="form-horizontal">
                


                <?php $is_focused = false; ?>
                <? $ii=0;?>
                <?php foreach($fields as $key => $val) : ?>

                    <div class="form-group

                    "

                        <?php if($val['is_key'] || $val['type']=='now' || $val['edit_hide']==true) echo "style='display:none'"; ?>>
                        <label class="control-label m-b5" for="<?=$key?>"><?=$val['title']?></label>
                        <div class="controls">


                            <? if($val['type'] == 'date'){?>

                            <input type="date" name="<?=$key?>" value="<?=$val['value']?$val['value']:$rows[$key]?>" id="<?=$key?>" maxlength="<?=$val['max_length']?>" style="<?=$val['style']?>;height:34px" onfocus="this.select()" class="form-control has-value" <? if($is_edit && $val['uneditable']){echo 'readonly';}?> />

                            <?}else if($val['type'] == 'number'){?>

                                <input type="number" name="<?=$key?>" value="<?=$val['value']?$val['value']:$rows[$key]?>" id="<?=$key?>" maxlength="<?=$val['max_length']?>" style="<?=$val['style']?>;height:34px" onfocus="this.select()" class="form-control has-value" <? if($is_edit && $val['uneditable']){echo 'readonly';}?> />



                            <?}else{?>

                            <?=field_to_html($key,
                                    $val['value']?$val['value']:$rows[$key],
                                    $val['type'],
                                    $val['max_length'],
                                    $val['options'],
                                    $val['selects'],
                                    $val['style'],

                                    (($is_edit && $val['uneditable'])?'readonly':''),
                                    (($is_edit && $val['value']==$rows[$key])?true:false), // checked
                                    $val['placeholder']
                                )?>

                            <?}?>

                            <? if($val['memo']){ ?>
                            <div class="m-t5 text-muted ft12"><?=$val['memo']?></div>
                            <?}?>


                        </div>
                    </div>
                <?php if(!$is_focused) : ?>
                    <script>$('#<?=$key?>').focus();</script>
                    <?php $is_focused = true; ?>
                <?php endif; ?>

                <? if($schema['id'] != 'user' ){ ?>
                    <? if(($ii+1) %10 == 0){ ?>
                        </div>
                    </div>

                    <div class="box  box-shadow <? if($schema['id'] === 'item' ){ ?>m-l10 col-md-3<?}?>" style="overflow:auto;<? if($schema['id'] === 'item' ){ ?><?}else{?>width:600px;<?}?>">
                        <div class="box-body">

                    <?}?>
                <?}?>

                    <? $ii++; ?>

                <?php endforeach; ?>

                <div class="clearfix">
                <div class="control-group clearfix ">

                    <div class="controls text-right col-md-12 b-t p-t15 m-t5">
                        <button type="button" id="act-button" class="btn btn-primary"><?=$is_edit?"수정":"생성"?></button>
                        <a href="" class="btn btn-default bootbox-close-button ">취소</a>
                    </div>
                </div>
                <hr/>

                <div class="control-group col-md-12" <?=$is_edit?"":"style='display:none'"?>>
                    <div class="controls text-right">
                        <button type="button" id="del-button" class="btn btn-danger"><i class="icon-warning-sign"></i> 삭제하기</button>



                    </div>
                </div>

                </div>




        </div>
    </div>
    </form>

</div>

<script type="text/javascript">

    
    $(document).ready(function(){

       $('input[type="text"],input[type="password"], select').addClass('form-control');
       $('textarea').addClass('form-control');
       $('input[type="checkbox"]').each(function(){
           var def_chk = $(this).parent().html();
           $(this).parent().html('<label class="ui-switch ui-switch-md info m-t-xs">'+def_chk+' <i></i></label>')
       });



        $("#in_add_form").find('select').each(function(){
            if($(this).children().length > 5){
                if($(this).attr('multiple') !="multiple") {
                    $(this).select2({'theme': "bootstrap"})
                }
            }
        });

        $("#in_add_form").find("select[multiple=multiple]").each(function(){
            <? if($schema['id'] != 'user'){?>
              //$(this).select2({'theme': "bootstrap"}).css('width','100%');
            <?}?>
        });

        $('.select2').css('width','100%');
    });
</script>


