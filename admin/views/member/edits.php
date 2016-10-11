<form id="FrmWriteForm" onsubmit="return false">
<input type="hidden" name="mode" id="mode" value="<?=$mode?>" />
<input type="hidden" name="inout_no" value="<?=$row['idx']?>" />
<table class="table table-bordered table-form">
	<colgroup>
		<col width="120px">
		<col>
		<col width="120px">
		<col>
	</colgroup>
	<tbody>
		<tr>
			<th>아이디</th>
			<td>
				<?=$row['userid']?>
			</td>			
			<th>이름</th>
			<td>
				<input type="text" name="name" value="<?=$row['name']?>" class="validate[required]"/>
			</td>
		</tr>
		<tr>
			<th>비밀번호</th>
			<td >
				<input type="text" name="password" id="password" value="<?=$row['password']?>" class="validate[required,minSize[4]]" />		
			</td>
			<th>비밀번호확인</th>
			<td>
				<input type="text" name="repassword" id="repassword" value="<?=$row['repassword']?>" class="validate[required,minSize[4],funcCall[InoutInput.check_same]]" />
			</td>
		</tr>
		<tr>
			<th>전화번호</th>
			<td >
				<input type="text" name="phone" value="<?=$row['phone']?>" />		
			</td>
			<th>이메일</th>
			<td>
				<input type="text" name="emails" value="<?=$row['emails']?>" />
			</td>
		</tr>
	</tbody>
</table>

<div class="area-button">
	<button type="submit" class="btn btn-theme btn-lg">수정</button>
	<button type="button" class="btn btn-gray btn-lg modal-close">닫기</button>
</div>
</form>


<script type="text/javascript">

var InoutInput = {
	init : function() {
//		HmisCommon.createDatepicker();
		var me = this;
		var option = $.extend({},validation_option, {
			promptPosition:'centerRight',
			onValidationComplete: function(form, status){
				if(status) me.save();
			}
		});
		$("#FrmWriteForm").validationEngine('attach',option);
	},
	check_same: function(field, rules, i, options) {
		if ( $("#repassword").val() != $("#password").val()) {
			return "새 비밀번호와 확인번호가 일치하지 않습니다.";
		}
	},
	save: function() {
		// if(!confirm('저장하시겠습니까?')) return false;
		var me = this;
		var formdata = $('#FrmWriteForm').serialize();
		$.ajax({
			url:'/admin/member/bbs_act',
			data:formdata, 
			dataType:'html',
			type:'POST',
			success: function(r){
//				$("#qweasa1234").html(r);
//				return;
				$('.modal-close').trigger('click');				
				InoutInList.lodeindex();
			}
		})
	}
}

$(function() {
	InoutInput.init();
})
</script>