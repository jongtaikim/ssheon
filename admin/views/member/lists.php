<br>
<br>
<br>
<h3 class="area-title">
	<!--span id="cnt_total"class="f-bold"><strong><?=$total_record?></strong></span>건</span-->
	<div class="button-box">
		<button class="btn btn-flat-blue" onclick="InoutInList.openInput('')"><i class="fa fa-user-plus fa-1"></i> 관리자 등록</button>
	</div>
</h3>

<table class="table table-bordered table-list table-striped table-hover">
	<colgroup>
		<col width="40px">
		<col width="100px">
		<col>
		<col width="140px">
		<col width="200px">
		<col width="120px">
	</colgroup>
	<thead>
		<tr>
			<th style="height:38px;">번호</th>
			<th>이름</th>
			<th>아이디</th>
			<th>전화번호</th>
			<th>E-mail</th>
			<th>상태</th>
		</th>
	</thead>
	<tbody>
	<? if(is_array($loop)): ?>
	   <?foreach($loop as $row): ?>							
		<tr>
			<td><?=$row['listNo']?></td>
			<td style="height:38px;"><?=$row['name']?></td>
			<td class="left"><?=$row['userid']?></td>
			<td><?=$row['phone']?></td>
			<td class="left"><?=$row['emails']?></td>
			<td>
				<button type="button" class="btn btn-onlyicon" onclick="InoutInList.openInput('<?=$row[idx]?>')"><i class="fa fa-pencil fa-1 f-blue" data-role="tooltip" title="기본정보 수정"></i> 수정</button>		
				<button type="button" class="btn btn-onlyicon" onclick="InoutInList.delete_all('<?=$row[idx]?>')"><i class="fa fa-pencil fa-1 f-blue" data-role="tooltip" title="기본정보 수정"></i> 삭제</button>		
			</td>
		</tr>
	   <? endforeach; ?>
	<? endif; ?>			
	</tbody>
</table>
