<br><br>

<form id="FrmInoutInput" name="FrmInoutInput" method="post"  enctype="multipart/form-data" onsubmit="return false">
<input type="hidden" name="mode" id="mode" value="<?=$mode?>" />
<input type="hidden" name="inout_no" value="<?=$row['idx']?>" />
<input type="hidden" name="code" value="<?=$this->uri->segment(4)?>" />

<table class="table table-bordered table-form">
	<colgroup>
		<col width="120px">
		<col>
		<col width="120px">
		<col>
	</colgroup>
	<tbody>
		<tr>
			<th>이름</th>
			<td colspan="3"><input type="text" id="name" name="name" value="<?=$row['name']?>" /></td>
		</tr>			
		<tr>
			<th>제목</th>
			<td colspan="3"><input type="text" id="title" name="title" style="width:320px;" value="<?=$row['title']?>" /></td>
		</tr>
		<tr>
			<th>공지글</th>
			<td colspan="3">
				<label class="hmis"><input type="radio"  name="notice" value="N" class="hmis validate[required]" <? if ( $row['notice'] == "N" ) echo "checked" ; ?> /><span class="lbl"> 미사용</span></label>
				<label class="hmis"><input type="radio"  name="notice" value="Y" class="hmis validate[required]" <? if ( $row['notice'] == "Y" ) echo "checked" ; ?> /><span class="lbl"> 사용</span></label>
			</td>
		</tr>
		<tr>
			<td colspan="4" height="200px;">
				<textarea name="editor1"><?=$row['content']?></textarea>						
			</td>
		</tr>

		<? if ( $this->uri->segment(4) == 'faq' && $mode=='M' ) : ?>
		<tr>
			<td colspan="4" height="200px;">
				<textarea name="editor2"><?=$row['recontent']?></textarea>						
			</td>
		</tr>

		<? endif; ?>

	</tbody>
</table>

<div class="area-button">
	<button type="button" class="btn btn-theme btn-lg" id="setting_button" onclick="InoutInput.save()"><?=$nameval?></button>
	<button type="button" onclick="go_url('/admin/board/lists/<?=$this->uri->segment(4)?>?page=<?=$page?>');" class="btn btn-gray btn-lg modal-close">목록</button>
</div>
</form>
<div id="adfdssdfs"></div>
   
<script src="/asset/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?=ADMIN_JS_DIR?>/jquery.MultiFile.pack.js"></script>
<script src="<?=ADMIN_JS_DIR?>/jquery.form.js"></script> 

<script type="text/javascript">
var InoutInput = {
	init : function() {
		this.createFile();
		/*
		HmisCommon.createDatepicker();

		var me = this;
		var option = $.extend({},validation_option, {
			promptPosition:'centerRight',
			onValidationComplete: function(form, status){
				if(status) me.save();
			}
		});

		$("#FrmInoutInput").validationEngine('attach',option);
		*/
	},
	createFile : function() {
		var me = this;
		this.msgFile();

		$('#attach').MultiFile({ 
			list: '#file_list',
			STRING:{
				remove:"<i class='fa fa-remove' style='color:#FF4040'></i>",
				duplicate:'이미 등록된 파일입니다.'
			},
			afterFileAppend: function() {
				me.msgFile();
			},
			afterFileRemove: function() {
				me.msgFile();
			}
		});
	},
	msgFile : function() {
		var count = $('#file_list > div.MultiFile-label');
		if(count.length<1) {
			$('#file_msg').html('파일을 첨부해 주세요.');
		}
		if(count.length>0) {
			$('#file_msg').html('');
		}
	},
	removeFile : function(file_no) {
		$('#FrmInoutInput').append('<input type="hidden" name="settle_file_remove[]" value="'+file_no+'" />');
		$('#file_'+file_no).remove();
		this.msgFile();
	},
	save: function() {

		var codes = '<?=$this->uri->segment(4)?>' ;
		var modes = '<?=$mode?>' ;

		var textbox= CKEDITOR.instances.editor1.getData();
		if ( codes == 'faq' && modes=='M')
		{
			var textbox2= CKEDITOR.instances.editor2.getData();
		}

		$("#FrmInoutInput").ajaxSubmit({
					dataType: 'html',         
					url : "/admin/board/board_act", 
					data: { content: textbox , recontent: textbox2 },	             	         
					success: function(data){
						location.href="/admin/board/lists/"+'<?=$this->uri->segment(4)?>';
					}
		});
	}
}

$(function() {
	InoutInput.init();
})
</script>

<?
	//	'enterMode'              => 'CKEDITOR.ENTER_BR',	
	//	'shiftEnterMode'              => 'CKEDITOR.CKEDITOR.ENTER_P',		
	//툴바, textarea name, 에디터 폭, 에디터 높이
	//툴바를 빈칸으로 하면 FULL 툴바가 나옵니다.
	//현재 선언해놓은 것은 reply와 basic인데 입맛에 맞게 선언하여 사용하면 됩니다.
	echo form_ckeditor(array(
		'toolbar'        => 'reply',
		'id'              => 'editor1',
		'width'           => '100%',
		'height'          => '300'
	));


	echo form_ckeditor(array(
		'toolbar'        => 'reply',
		'id'              => 'editor2',
		'width'           => '100%',
		'height'          => '300'
	));


?>