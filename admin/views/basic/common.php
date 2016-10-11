	<div id="title-area">관리자 암호 변경</div>		
		<div id="Contents" style="width:500px;">
		
			<form id="sform" onsubmit='return false;' >				
			<div class="boardUp" >			
				 <!-- 게시판 검색 -->
				<div class="search_bbs">							
					&nbsp;
				</div>
				
			</div>
		   	</form>				
		   			   	
			<div id="search_result" style="padding-left:15px;">
			<!-- -->
							

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
						<td colspan="3"><input type="text" id="name" name="name" value="<?=$row['name']?>" style=" font-size: 14px;width:300px;height: 31px; padding: 6px 12px;background-color: #fff;border: 1px solid #ccc;"/></td>
					</tr>			

					<tr>
						<th>기존암호 입력</th>
						<td colspan="3"><input type="text" id="name" name="name" value="<?=$row['name']?>" style=" font-size: 14px;width:300px;height: 31px; padding: 6px 12px;background-color: #fff;border: 1px solid #ccc;"/></td>
					</tr>			
					<tr>
						<th>새로운 암호입력</th>
						<td colspan="3"><input type="text" id="name" name="name" value="<?=$row['name']?>" style=" font-size: 14px;width:300px;height: 31px; padding: 6px 12px;background-color: #fff;border: 1px solid #ccc;"/></td>
					</tr>			
					<tr>
						<th>새로운 암호 확인</th>
						<td colspan="3"><input type="text" id="name" name="name" value="<?=$row['name']?>" style=" font-size: 14px;width:300px;height: 31px; padding: 6px 12px;background-color: #fff;border: 1px solid #ccc;"/></td>
					</tr>			

				</tbody>
			</table>

			<div class="area-button">
				<button type="button" onclick="go_url('/admin/board/lists/<?=$this->uri->segment(4)?>?page=<?=$page?>');" class="btn btn-gray btn-lg modal-close">저장하기</button>
			</div>
			</form>
			<div id="adfdssdfs"></div>			
						
						
			<!-- -->
			</div>	
		</div>
	</div>




   
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
