<form id="ReFormInoutInput" onsubmit="return false">
<input type="hidden" name="mode" id="mode" value="<?=$mode?>" />
<input type="hidden" name="inout_no" value="<?=$row['idx']?>" />
<h3> 기본정보 </h3>

<table class="table table-bordered table-form">
	<colgroup>
		<col width="120px">
		<col>
		<col width="120px">
		<col>
	</colgroup>
	<tbody>
		<tr>
			<th>부대시설명</th>
			<td >
				<input type="text" name="name" id="name" style="width:97%;" value="<?=$row['name']?>"   />
			</td>	
			<th>설명</th>
			<td>
				<input type="text" name="content" id="content" style="width:97%;" value="<?=$row['content']?>"   />
			</td>
		</tr>
		<tr>
			<th>이용요금</th>
			<td >
				<input type="text" name="sprinc" id="sprinc" style="width:97%;" value="<?=$row['sprinc']?>"   />
			</td>	
			<th>부과단위</th>
			<td>
				<input type="text" name="translate" id="translate" style="width:97%;" value="<?=$row['translate']?>"   />
			</td>
		</tr>
	</tbody>
</table>

<div id="reeeshowdatevie"></div>

<!--div class="well" style="margin-top:5px">
	<span class="label label-error">도움말</span>
	<div class="dashed" style="margin:7px 0px"></div>
	<div>
		<ul>
			<li style="margin-bottom:3px"><b class="" style="margin-right:10px">광고주코드</b>규칙에 따라 자동생성됩니다. (AD+입사년월+순번, 예시: AD15101201 ,AD15101202 )</li>
		</ul>
	</div>
</div-->

<div class="area-button">
	<button type="submit" class="btn btn-theme btn-lg" id="setting_button" onclick="InoutInput.setSaveMode()">저장</button>
	<button type="button" class="btn btn-gray btn-lg modal-close">닫기</button>
</div>
</form>

<script type="text/javascript">
var InoutInput = {
	saveMode:'continue',
	init : function() {
		HmisCommon.createDatepicker();

		var me = this;
		var option = $.extend({},validation_option, {
			promptPosition:'centerRight',
			onValidationComplete: function(form, status){
				if(status) me.save();
			}
		});

		$("#ReFormInoutInput").validationEngine('attach',option);
	},
	setSaveMode: function(mode) {
		this.saveMode = mode;
	},
	save: function() {
		// if(!confirm('저장하시겠습니까?')) return false;
		var me = this;
		var formdata = $('#ReFormInoutInput').serialize();
		$.ajax({
			url:'/admin/realpan/rerealpan_act',
			data:formdata, 
			dataType:'html',
			type:'POST',
			success: function(r){		
				$('.modal-close').trigger('click');				
				InoutReInList.relodeindex();
			}
		})
	}
}

$(function() {
	InoutInput.init();
})
</script>