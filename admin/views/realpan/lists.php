<br><br><br>
<h3 class="area-title">
	<span class="f-bold"><?=$datevalues?></span>
	<span class="f-bold f-blue"><?=$maeche_code_name?> <?=$pcm_code_name?></span>

	<div class="button-box">
		<!--button class="btn btn-flat-purple" onclick="output_excel('<?=$duty_codeser?>','<?=$codevalval?>')"><i class="fa fa-cog fa-file-excel-o"></i> Excel 다운로드</button-->
		<!--button class="btn btn-flat-blue" onclick="InoutInList.openexlInput()"><i class="fa fa-cog fa-file"></i> 등록하기</button-->
	</div>
</h3>

<table class="table table-bordered table-list table-striped table-hover">
	<colgroup>
		<!--col width="40px"-->
		<col width="130px">
		<col width="70px">
		<col width="70px">
		<col width="90px">
		<col width="90px">
		<col width="90px">
		<col width="90px">
		<col width="90px">
		<col width="90px">
		<col width="90px">
		<col width="90px">
		<col width="100px">
		<col >
	</colgroup>
	<thead>
		<tr>
			<th rowspan="2">객실명</th>
			<th rowspan="2">년도</th>
			<th rowspan="2">기준/최대</th>
			<th rowspan="2">이용기간</th>
			<th colspan="3">비수기비용</th>
			<th colspan="3">준성수기비용 ( 4~5월/ 9~10월 )</th>
			<th colspan="3">성수기비용 ( 7~8월 )</th>
			<th rowspan="2">상태</th>
		</th>
		<tr>
			<th>평일</th>
			<th>금요일</th>
			<th>주말</th>
			<th>평일</th>
			<th>금요일</th>
			<th>주말</th>
			<th>평일</th>
			<th>금요일</th>
			<th>주말</th>
		</th>
	</thead>
	<tbody>
	<? if(is_array($loop)): ?>
	   <?foreach($loop as $row): ?>	
		<tr>
			<td style="height:38px;"><?=$row['guestroom']?> </td>		
			<td><?=$row['year']?>년</td>
			<td><?=$row['rownumber']?></td>
			<td><?=$row['hinumber']?></td>

			<td><?=number_format($row['dweekday'])?> </td>		
			<td><?=number_format($row['dfriday'])?></td>
			<td><?=number_format($row['dweekend'])?></td>

			<td><?=number_format($row['aweekday'])?> </td>		
			<td><?=number_format($row['afriday'])?></td>
			<td><?=number_format($row['aweekend'])?></td>

			<td><?=number_format($row['pweekday'])?> </td>		
			<td><?=number_format($row['pfriday'])?></td>
			<td><?=number_format($row['pweekend'])?></td>
			<td>
				<button type="button" class="btn btn-onlyicon" onclick="InoutInList.openexlInput('<?=$row[idx]?>')"><i class="fa fa-pencil fa-1 f-blue" data-role="tooltip" title="기본정보 수정"></i> 정보수정 </button>				
			</td>
		</tr>
		<?endforeach;?>
	<? endif;?>
	</tbody>
</table>

