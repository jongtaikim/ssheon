<br><br>

<table class="table table-bordered table-form">
	<colgroup>
		<col width="120px">
		<col>
		<col width="120px">
		<col>
	</colgroup>
	<tbody>
		<tr>
			<th>제목</th>
			<td colspan="3"><?=$row['title']?></td>
		</tr>
		<tr>
			<th>이름</th>
			<td><?=$row['name']?></td>
			<th>등록일</th>
			<td><?=substr( $row['udate'],0,10)?></td>
		</tr>	
		<tr>
			<th>조회수</th>
			<td colspan="3"><?=$row['hits']?></td>
		</tr>	



		<tr>
			<td colspan="4" style="vertical-align: text-top;height:150px;line-height:15px;padding:10 10 10 10;word-wrap:break-word;word-break:break-all">
				<?=$row['content']?>				
			</td>
		</tr>

		<? if ( $row['code'] == 'faq' ) : ?>
			<? if ( $row['recontent'] !="" ) :?>	
		<tr>
			<td colspan="4" style="vertical-align: text-top;height:150px;line-height:15px;padding:10 10 10 10;word-wrap:break-word;word-break:break-all">
				<?=$row['recontent']?>				
			</td>
		</tr>
			<? endif; ?>
		<? endif;?>
	</tbody>
</table>

<div class="area-button">
	<button type="button" onclick="go_url('/admin/board/lists/<?=$row['code']?>?page=<?=$page?>');" class="btn btn-gray btn-lg modal-close">목록</button>
</div>
