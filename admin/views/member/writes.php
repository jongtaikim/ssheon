<form id="FrmWriteForm" onsubmit="return false">
<input type="hidden" name="mode" id="mode" value="<?=$mode?>" />
<input type="hidden" name="inout_no" value="<?=$row['idx']?>" />
<input type="hidden" id="user_id" value="" /><!-- 아이디 중복체크 -->
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
				<input type="text" name="user_id" onkeyup="InoutInput.checkuserid();" class="validate[required,custom[userid],equals[user_id]] required" data-errormessage-pattern-mismatch="이미 존재하는 아이디(ID)입니다." />
				<span id="uservalue"></span>
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
	<button type="submit" class="btn btn-theme btn-lg">저장</button>
	<button type="button" class="btn btn-gray btn-lg modal-close">닫기</button>
</div>
</form>

<div id="qweasa1234"></div>

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
	checkuserid: function() {
		var el = $('input[name="user_id"]');
		var value = el.val();
		if(!value) {
			HmisAlert.alert('ID를 입력하세요.');
			return false;
		}
		$.ajax({
			url:'/admin/member/check_duplicate',
			data:{
				field:'user_id',
				value:value
			},
			type:'POST',
			success: function(result_data) {
				var obj = $.parseJSON(result_data);	
				if (obj.is_valid == "1") {
					$("#uservalue").html('<font color=red>사용불가능</font>');
					$('#user_id').val('');
				} else {
					$("#uservalue").html('<font color=blue>사용가능</font>');
					$('#user_id').val(value);
				}
			}
		})
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