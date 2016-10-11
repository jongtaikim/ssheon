<script type="text/javascript">
	// 값을 입력하고 엔터를 쳤을 경우, 로그인 시도함. login_loading() 함수 호출
	function enterLogin(e) {
		if(e.keyCode == 13) {
			document.FrmAttendanceSearch.submit();
		} 
	}
	sform_submit = function () {
//				alert ("1") ;
	//	location = sform.URL.value + "?key=" + sform.key.value + '&value=' + sform.value.value + '&code=' + sform.code.value;
		document.FrmAttendanceSearch.submit() ;                                     
	}
</script>
<?
	echo $code ;
?>
<h3 class="area-title" >검색</h3>
<form id="FrmAttendanceSearch" name="FrmAttendanceSearch" onsubmit='return false;' action="/admin/board/lists/<?=$this->uri->segment(4)?>" method="get">
<input type="hidden" name="page" value="<?=$page?>">
<input type="hidden" name="code" value="<?=$code?>">

<table class="table table-bordered table-form">
	<colgroup>
		<col width="120px">
		<col>
	</colgroup>
	<tbody>
		<tr>
			<th>제목</th>
			<td>
				<input type="text"  name="title" id="title" onKeyDown="enterLogin(event)" value="<?=$title?>" style=" font-size: 14px;width:99%;height: 28px; padding: 6px 12px;background-color: #fff;border: 1px solid #ccc;" />
			</td>
		</tr>
	</tbody>
</table>
</form>
<div class="area-button">
	<button  class="btn btn-lg btn-theme_bu"  onclick="sform_submit();"><i class="fa fa-search"></i> 검색</button>
	<!--button class="btn btn-lg btn-gray" onclick="InoutInList.lodeindex()">처음으로</button-->
</div>

<h3 class="area-title">
	Total : 
	<span id="cnt_total"class="f-bold"><strong><?=$total_record?></strong></span>건</span>
	<div class="button-box">
		<button class="btn btn-flat-blue" onclick="go_url('/admin/board/write/<?=$this->uri->segment(4)?>');" ><i class="fa fa-cog fa-file"></i> 게시물 등록</button>
	</div>
</h3>
<table class="table table-bordered table-list table-striped table-hover">
	<colgroup>
		<col width="40px">
		<col >
		<col width="130px">
		<col width="100px">
		<? if ( $this->uri->segment(4) == 'faq' ) : ?>
		<col width="100px">
		<? endif;?>
		<col width="120px">
	</colgroup>
	<thead>
		<tr>
			<th style="height:38px;">번호</th>
			<th>제목</th>
			<th>작성자</th>
			<th>작성일</th>
			<? if ( $this->uri->segment(4) == 'faq' ) : ?>
			<th>답변</th>
			<? endif;?>
			<th>관리</th>
		</th>
	</thead>
	<tbody>
	<? if(is_array($loopno)): ?>
	   <?foreach($loopno as $rowno): ?>							
		<tr>
			<td><b>공지</b></td>
			<td class="left" style="height:38px;cursor:pointer;" onclick="go_url('/admin/board/v/<?=$rowno['code']?>?page=<?=$page?>&idx=<?=$rowno[idx]?>');" >
			<? if ( $this->uri->segment(4) == 'faq' ) : ?>		
				<? if ( $row['secret'] =='Y' ) : ?>
				<img src="<?=FRONT_IMG_DIR?>/lock.png" style="padding:2px 2px 0 0;">
				<? endif; ?>
			<? endif;?>					
			<?=$rowno['title']?></td>
			<td class="left"><?=$rowno['name']?></td>
			<td><?=substr( $rowno['udate'] , 0 , 10)?></td>
			<? if ( $this->uri->segment(4) == 'faq' ) : ?>
			<td class="left">
				<?
					if ( $row['recontent'] == '' ) {
						echo "미답변" ;
					} else {
						echo "완료" ;
					}
				?>		
			</td>
			<? endif;?>
			<td>
				<button type="button" class="btn btn-onlyicon" onclick="go_url('/admin/board/write/<?=$rowno['code']?>?page=<?=$page?>&idx=<?=$rowno[idx]?>');"><i class="fa fa-pencil fa-1 f-blue" data-role="tooltip" title="기본정보 수정"></i> 수정</button>
				<button type="button" class="btn btn-onlyicon" onclick="InoutInList.delete_all('<?=$rowno[idx]?>')"><i class="fa fa-pencil fa-1 f-blue" data-role="tooltip" title="기본정보 수정"></i> 삭제</button>		
			</td>
		</tr>
	   <? endforeach; ?>
	<? endif; ?>
	<? if(is_array($loop)): ?>
	   <?foreach($loop as $row): ?>							
		<tr>
			<td><?=$row['listNo']?></td>
			<td class="left" style="height:38px;cursor:pointer;" onclick="go_url('/admin/board/v/<?=$row['code']?>?page=<?=$page?>&idx=<?=$row[idx]?>');" >
			<? if ( $this->uri->segment(4) == 'faq' ) : ?>		
				<? if ( $row['secret'] =='Y' ) : ?>
				<img src="<?=FRONT_IMG_DIR?>/lock.png" style="padding:2px 2px 0 0;">
				<? endif; ?>
			<? endif;?>					
			<?=$row['title']?></td>
			<td class="left"><?=$row['name']?></td>
			<td><?=substr( $row['udate'] , 0 , 10)?></td>
			<? if ( $this->uri->segment(4) == 'faq' ) : ?>
			<td class="left">
				<?
					if ( $row['recontent'] == '' ) {
						echo "미답변" ;
					} else {
						echo "완료" ;
					}
				?>
			</td>
			<? endif;?>
			<td>
				<button type="button" class="btn btn-onlyicon" onclick="go_url('/admin/board/write/<?=$row['code']?>?page=<?=$page?>&idx=<?=$row[idx]?>');"><i class="fa fa-pencil fa-1 f-blue" data-role="tooltip" title="기본정보 수정"></i> 수정</button>	
				<button type="button" class="btn btn-onlyicon" onclick="InoutInList.delete_all('<?=$row[idx]?>')"><i class="fa fa-pencil fa-1 f-blue" data-role="tooltip" title="기본정보 수정"></i> 삭제</button>		
			</td>
		</tr>
	   <? endforeach; ?>
	<? endif; ?>			
	</tbody>
</table>

<!-- //Pagination -->
<div style="text-align:center;">
	<ul class="pagination">
		<li><a href="javascript:;" onclick="go_url('/admin/board/lists/<?=$this->uri->segment(4)?>?page=<?=$paging['first']?>&title=<?=$title?>');" ><i class="fa fa-angle-double-left"></i></a></li>
		<li><a href="javascript:;" onclick="go_url('/admin/board/lists/<?=$this->uri->segment(4)?>?page=<?=$paging['prev']?>&title=<?=$title?>');" ><i class="fa fa-angle-left"></i></a></li>
	    <?foreach($paging['block'] as $rows): ?>
		<li class="<? if ( $rows['equal']==1 ) { ?> active <? } ?>"><a href="javascript:;" onclick="go_url('/admin/board/lists/<?=$this->uri->segment(4)?>?page=<?=$rows['num']?>&title=<?=$title?>');" ><?=$rows['num']?></a></li>
		<!-- <li><a href="javascript:;">2</a></li> -->
		<? endforeach;?>
		<li><a href="javascript:;" onclick="go_url('/admin/board/lists/<?=$this->uri->segment(4)?>?page=<?=$paging['next']?>&title=<?=$title?>');" ><i class="fa fa-angle-right"></i></a></li>
		<li><a href="javascript:;" onclick="go_url('/admin/board/lists/<?=$this->uri->segment(4)?>?page=<?=$paging['last']?>&title=<?=$title?>');"><i class="fa fa-angle-double-right"></i></a></li>
	</ul>				
</div>

<script type="text/javascript">
var InoutInList = {
	delete_all: function(seqno) {
		var seqno ;
		var ans = confirm("삭제를 진행하시겠습니까?");
		if (ans == false) {
			return ;
		}
		$.ajax({
			type: "POST",
			url: "/admin/board/delete_all/",
			data: { seqno: seqno },	
			success: function(result_data){	
				alert ( "삭제하였습니다." ) ;
				location.href="/admin/board/lists/"+'<?=$this->uri->segment(4)?>';						
			}
		});
	}
}
</script>