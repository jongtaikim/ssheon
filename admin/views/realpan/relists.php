
<h3 class="area-title">

	<div class="button-box">
		<!--button class="btn btn-flat-purple" onclick="output_excel('<?=$duty_codeser?>','<?=$codevalval?>')"><i class="fa fa-cog fa-file-excel-o"></i> Excel 다운로드</button-->
		<button class="btn btn-flat-blue" onclick="InoutReInList.reopenexlInput()"><i class="fa fa-cog fa-file"></i> 등록하기</button>
	</div>
</h3>

<table class="table table-bordered table-list table-striped table-hover">
	<colgroup>
		<col width="70px">
		<col>
		<col>
		<col>
		<col>
		<col>
	</colgroup>
	<thead>
		<tr>
			<th style="height:38px;">번호</th>
			<th>부대시설명</th>
			<th>설명</th>
			<th>이용요금</th>
			<th>부과단위</th>
			<th>상태</th>
		</th>
	</thead>
	<tbody>
	<? if(is_array($loop)): ?>
	   <?
		$ii = 1 ;
	   foreach($loop as $row): ?>							
		<tr>
			<td><?=$ii?></td>
			<td style="height:38px;text-align:left;"><?=$row['name']?></td>
			<td style="height:38px;text-align:left;word-wrap:break-word;word-break:break-all;"><?=$row['content']?></td>
			<td style="height:38px;text-align:left;word-wrap:break-word;word-break:break-all;"><?=number_format($row['sprinc'])?></td>
			<td style="height:38px;text-align:left;word-wrap:break-word;word-break:break-all;"><?=$row['translate']?></td>
			<td>
				<button type="button" class="btn btn-onlyicon" onclick="InoutReInList.reopenexlInput('<?=$row[idx]?>')"><i class="fa fa-pencil fa-1 f-blue" data-role="tooltip" title="기본정보 수정"></i> 수정 </button>				
				<button type="button" class="btn btn-onlyicon" onclick="InoutReInList.redeletes('<?=$row[idx]?>')"><i class="fa fa-pencil fa-1 f-blue" data-role="tooltip" title="기본정보 수정"></i> 삭제 </button>				
			</td>
		</tr>
	   <? 
		$ii ++ ;	   
	   endforeach; ?>
	<? endif; ?>			
	</tbody>
</table>
