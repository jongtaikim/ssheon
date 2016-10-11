<form id="FrmInoutInput" onsubmit="return false">
<input type="hidden" name="mode" id="mode" value="<?=$mode?>" />
<input type="hidden" name="inout_no" value="<?=$row['idx']?>" />
<h3> 기본정보 </h3>
<table class="table table-bordered table-form">
	<colgroup>
		<col width="120px">
		<col>
		<col width="120px">
		<col>
		<col width="120px">
		<col>
	</colgroup>
	<tbody>
		<tr>
			<th>객실명</th>
			<td colspan="5">
				<input type="text" name="guestroom" id="guestroom" style="width:200px;" value="<?=$row['guestroom']?>"   />
			</td>					
		</tr>

		<tr>
			<th>기준인원</th>
			<td >
				<input type="text" name="rownumber" id="rownumber" style="width:98%;" value="<?=$row['rownumber']?>"   />
			</td>	
			<th>최대인원</th>
			<td>
				<input type="text" name="hinumber" id="hinumber" style="width:98%;" value="<?=$row['hinumber']?>"   />
			</td>
			<th>이용기간</th>
			<td>
				<input type="text" name="periodofuse" id="periodofuse" style="width:98%;" value="<?=$row['periodofuse']?>"   />
			</td>				
		</tr>
	</tbody>
</table>
<h3> 비수기비용(주중/금요일/주말) </h3>
<table class="table table-bordered table-form">
	<colgroup>
		<col width="120px">
		<col>
		<col width="120px">
		<col>
		<col width="120px">
		<col>
	</colgroup>
	<tbody>
		<tr>
			<th>평일</th>
			<td >
				<input type="text" name="dweekday" id="dweekday" style="width:98%;" value="<?=$row['dweekday']?>"   />
			</td>	
			<th>금요일</th>
			<td>
				<input type="text" name="dfriday" id="dfriday" style="width:98%;" value="<?=$row['dfriday']?>"   />
			</td>
			<th>주말</th>
			<td>
				<input type="text" name="dweekend" id="dweekend" style="width:98%;" value="<?=$row['dweekend']?>"   />
			</td>				
		</tr>
	</tbody>
</table>

<h3> 준성수기비용(주중/금요일/주말) </h3>
<table class="table table-bordered table-form">
	<colgroup>
		<col width="120px">
		<col>
		<col width="120px">
		<col>
		<col width="120px">
		<col>
	</colgroup>
	<tbody>
		<tr>
			<th>평일</th>
			<td >
				<input type="text" name="aweekday" id="aweekday" style="width:98%;" value="<?=$row['aweekday']?>"   />
			</td>	
			<th>금요일</th>
			<td>
				<input type="text" name="afriday" id="afriday" style="width:98%;" value="<?=$row['afriday']?>"   />
			</td>
			<th>주말</th>
			<td>
				<input type="text" name="aweekend" id="aweekend" style="width:98%;" value="<?=$row['aweekend']?>"   />
			</td>				
		</tr>
	</tbody>
</table>

<h3> 성수기비용(주중/금요일/주말 </h3>
<table class="table table-bordered table-form">
	<colgroup>
		<col width="120px">
		<col>
		<col width="120px">
		<col>
		<col width="120px">
		<col>
	</colgroup>
	<tbody>
		<tr>
			<th>평일</th>
			<td >
				<input type="text" name="pweekday" id="pweekday" style="width:98%;" value="<?=$row['pweekday']?>"   />
			</td>	
			<th>금요일</th>
			<td>
				<input type="text" name="pfriday" id="pfriday" style="width:98%;" value="<?=$row['pfriday']?>"   />
			</td>
			<th>주말</th>
			<td>
				<input type="text" name="pweekend" id="pweekend" style="width:98%;" value="<?=$row['pweekend']?>"   />
			</td>				
		</tr>
	</tbody>
</table>


<div id="showdatevie"></div>

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
	<button type="submit" class="btn btn-theme btn-lg" id="setting_button" onclick="InoutInput.setSaveMode()"><?=$modesname?></button>
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

		$("#FrmInoutInput").validationEngine('attach',option);
	},
	setSaveMode: function(mode) {
		this.saveMode = mode;
	},
	save: function() {
		// if(!confirm('저장하시겠습니까?')) return false;
		var me = this;
		var formdata = $('#FrmInoutInput').serialize();
		$.ajax({
			url:'/admin/realpan/realpan_act',
			data:formdata, 
			dataType:'html',
			type:'POST',
			success: function(r){		
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