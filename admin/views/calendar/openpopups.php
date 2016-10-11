	<!-- //subTitle -->
	<!--div id="title-area">예약 상태</div-->	
	
		<!-- Contents -->
		<div id="Contents">
		
			<div>
			<form id="ViewFrmInoutInputr" name="ViewFrmInoutInputr"  method="post"  enctype="multipart/form-data">
				<input type="hidden" name="tcode" id="tcode" value="<?=$row['code']?>">

				<h3> 기본정보 </h3>
				<table class="table table-bordered table-form">
					<colgroup>
						<col width="120px">
						<col>
					</colgroup>
					<tbody>
						<tr >
							<th>예약상태</th>
							<td>
								<select name="str_tcode" id="str_tcode">
									<option value="N" <? if ( $row['tcate'] == 'N' ) echo "selected"  ?>>입금대기
									<option value="Y" <? if ( $row['tcate'] == 'Y' ) echo "selected"  ?>>예약완료
								</select>
							</td>						
						</tr>
						<tr>
							<th>예약금액</th>
							<td>
								<?=number_format($row['totalprinc'])?>원
							</td>							
						</tr>

						<tr>
							<th>예약자</th>
							<td>
								<?=$row['name']?>
							</td>							
						</tr>

						<tr>
							<th>연락처</th>
							<td>
								<?=$row['phone']?>
							</td>							
						</tr>
						<tr>
							<th>옵션</th>
							<td><?=$row['imsitext']?></td>
						</tr>
						<tr>
							<th style="height:33px;">예약내용</th>
							<td>
								
								객실금액 : <?=$row['totalprinc']?> 원
								<? if ( $row['totalcnrkprinc'] ) : ?>
								+ 인원추가금액 : <?=number_format($row['totalcnrkprinc'])?> 원
								<? endif; ?>
								<? if ( $row['totalimsiprinc'] ) : ?>
								+ 옵션추가금액 : <?=number_format($row['totalimsiprinc'])?> 원  
								<? endif; ?><br>								
								합계 <font color=red><?=number_format($row['totallastprinc'])?></font> 원

							</td>							
						</tr>

						<tr>
							<th>도착예정시간</th>
							<td>
								<?=$row['ptime']?>
							</td>							
						</tr>

						<tr>
							<th>예약일</th>
							<td>
								<?=$row['todate']?>~<?=$row['lastdate']?>
							</td>							
						</tr>

						<tr>
							<th>예약등록일</th>
							<td>
								<?=substr($row['regdate'],0,10)?>
							</td>							
						</tr>

					</tbody>
				</table>



			</form>

				<div class="area-button">
					<button type="button" class="btn btn-gray btn-lg modal-close">닫기</button>
					<button class="btn btn-lg btn-flat-blue" onclick="InoutInList.delete_all('<?=$row[code]?>')"><i class="fa fa-search"></i> 삭제</button>
					<button class="btn btn-lg btn-gray" onclick="ViewInList.save()"><i class="fa fa-search"></i> 예약설정</button>
					<!--button class="btn btn-lg btn-gray" onclick="InoutInList.lodeindex()">처음으로</button-->
				</div>

			</div>
			
		</div>

</div>
		<div id="showdatevie"></div>

		<script type="text/javascript">
		var ViewInList = {
			page:1,
			init: function() {
				
			},
			save: function() {
				var me = this;
				var formdata = $('#ViewFrmInoutInputr').serialize();
				$.ajax({
					url:'/admin/calendar/vview_act',
					data:formdata, 
					dataType:'html',
					type:'POST',
					success: function(r){				

						alert ( "업데이트 했습니다." ) ;
						$('.modal-close').trigger('click');		
						InoutInList.lodeindex();
					}
				})
			}
		}

		$(function() {
			ViewInList.init();
		})
		</script>



