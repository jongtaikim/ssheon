            <div class="confirm">
                <div class="tit"><img src="<?=FRONT_IMG_DIR?>/sub/tt_reserve_02.jpg"></div>
                <div class="form2">
                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <colgroup>
                            <col width="20%">
                            <col width="80%">
                        </colgroup>
                        <tbody>
                            <tr>
                                <td class="sero">예약상태</td>
                                <td>
									<? 
										if ( $row['tcate'] == 'N' ) :
											echo "입금대기" ;
										else:
											echo "예약완료" ;
										endif;
									?>
								</td>
                            </tr>
                            <tr>
                                <td class="sero">예약자</td>
                                <td><?=$row['name']?></td>
                            </tr>
                            <tr>
                                <td class="sero">연락처</td>
                                <td><?=$row['phone']?></td>
                            </tr>
                            <tr>
                                <td class="sero">예약내용</td>
                                <td>
									객실금액 : <?=$row['totalprinc']?> 원
									<? if ( $row['totalcnrkprinc'] ) : ?>
									+ 인원추가금액 : <?=number_format($row['totalcnrkprinc'])?> 원
									<? endif; ?>
									<? if ( $row['totalimsiprinc'] ) : ?>
									+ 옵션추가금액 : <?=number_format($row['totalimsiprinc'])?> 원  
									<? endif; ?>								
									<b>합계 <font color=red><?=number_format($row['totallastprinc'])?></font> 원	</b>							
								</td>
                            </tr>
                            <tr>
                                <td class="sero">도착예정시간</td>
                                <td><?=$row['ptime']?></td>
                            </tr>
                            <tr>
                                <td class="sero">예약일</td>
                                <td><?=$row['todate']?>~<?=$row['lastdate']?></td>
                            </tr>
                            <tr>
                                <td class="sero">예약금액</td>
                                <td><?=number_format($row['totalprinc'])?>원</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="button">
					<? if ( $row['tcate'] == 'N' ) :?>
					<button class="btn btn-lg btn-flat-blue" onclick="delete_all('<?=$row[code]?>')"><i class="fa fa-search"></i> 예약취소</button>
					<? endif; ?>
					<button type="button"  onclick="$('.modal-close').trigger('click');">닫기</button>
				</div>
            </div>


<script type="text/javascript">
<!--
			function delete_all(seqno) {
				var seqno ;
		        var ans = confirm("예약취소를 진행하시겠습니까?");
		        if (ans == false) {
		            return ;
		        }
		        $.ajax({
		            type: "POST",
		            url: "/front/reserve/view_delete_all/",
			        data: { seqno: seqno },	
		            success: function(result_data){
						alert ( "예약취소를 했습니다." ) ;
						$('.modal-close').trigger('click');		
						InoutInList.lodeindex();
		            }
		        });
			}
//-->
</script>
