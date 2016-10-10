            <!-- 3단계 최종확인 -->
            <div class="section">
			<form id="FrmInoutLastInputr" name="FrmInoutLastInputr"  method="post"  enctype="multipart/form-data">
				<input type="hidden" name="todate" id="todate" value="<?=$row['todate']?>">
				<input type="hidden" name="uprinc" id="uprinc" value="<?=$row['uprinc']?>">
				<input type="hidden" name="lastdate" id="lastdate" value="<?=$row['lastdate']?>">
				<input type="hidden" name="lastprinc" id="lastprinc" value="<?=$row['lastprinc']?>" >		

				<input type="hidden" name="totallastprinc" id="totallastprinc" value="<?=$row['totallastprinc']?>" >	
				<input type="hidden" name="totalimsiprinc" id="totalimsiprinc" value="<?=$row['totalimsiprinc']?>" >		
				<input type="hidden" name="imsiprinc0" id="imsiprinc0" value="<?=$row['imsiprinc0']?>" >		
				<input type="hidden" name="imsiprinc1" id="imsiprinc1" value="<?=$row['imsiprinc1']?>" >		
				<input type="hidden" name="imsiprinc2" id="imsiprinc2" value="<?=$row['imsiprinc2']?>" >		
				<input type="hidden" name="imsiprinc3" id="imsiprinc3" value="<?=$row['imsiprinc3']?>" >		
				<input type="hidden" name="imsiprinc4" id="imsiprinc4" value="<?=$row['imsiprinc5']?>" >		
				<input type="hidden" name="imsiprinc5" id="imsiprinc5" value="<?=$row['imsiprinc5']?>" >		
				<input type="hidden" name="imsiprinc6" id="imsiprinc6" value="<?=$row['imsiprinc6']?>" >		
				<input type="hidden" name="imsiprinc7" id="imsiprinc7" value="<?=$row['imsiprinc7']?>" >		
				<input type="hidden" name="imsiprinc8" id="imsiprinc8" value="<?=$row['imsiprinc8']?>" >		

				<input type="hidden" name="imsitext" id="imsitext" value='<?=$row['imsi_separated']?>' >		

				<input type="hidden" name="guestroom" id="guestroom" value="<?=$row['guestroom']?>" >		
				<input type="hidden" name="rownumber" id="rownumber" value="<?=$row['rownumber']?>" >		
				<input type="hidden" name="seongin_val" id="seongin_val" value="<?=$row['seongin_val']?>" >		
				<input type="hidden" name="adong_val" id="adong_val" value="<?=$row['adong_val']?>" >		
				<input type="hidden" name="yua_val" id="yua_val" value="<?=$row['yua_val']?>" >		
				<input type="hidden" name="pperiodofuse" id="pperiodofuse" value="<?=$row['pperiodofuse']?>" >		
				<input type="hidden" name="totalcnrkprinc" id="totalcnrkprinc" value="<?=$row['totalcnrkprinc']?>" >		                
				<div class="last">
                    <div class="tit"><img src="<?=FRONT_IMG_DIR?>/sub/no_01.jpg">선택사항 확인</div>
                    <div class="check">
                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                            <colgroup>
                                <col width="17%">
                                <col width="83%">
                            </colgroup>
                            <tbody>
                                <tr>
                                    <td class="sero">객실명</td>
                                    <td>프라이빗 힐링하우스</td>
                                </tr>
                                <tr>
                                    <td class="sero">날짜</td>
                                    <td><?=$row['todate']?> ~ <?=$row['lastdate']?></td>
                                </tr>
                                <tr>
                                    <td class="sero">숙박인원</td>
                                    <td>기준인원 
										<? if ( $row['seongin_val'] != 0 ) :?>
										+ 성인 <?=$row['seongin_val']?> 명 
										<? endif;?>
										<? if ( $row['adong_val'] != 0 ) :?>
										+ 아동 <?=$row['adong_val']?> 명 
										<? endif;?>
										<? if ( $row['yua_val'] != 0 ) :?>
										+ 유아 <?=$row['yua_val']?> 명
										<? endif;?>
									</td>
                                </tr>
                                <tr>
                                    <td class="sero">옵션</td>
                                    <td><?=$row['imsi_separated']?></td>
                                </tr>
                                <tr>
                                    <td class="sero">가격</td>
                                    <td>
										객실금액 : <?=$row['uprinc']?> 원
										<? if ( $row['totalcnrkprinc'] ) : ?>
										+ 인원추가금액 : <?=number_format($row['totalcnrkprinc'])?> 원
										<? endif; ?>
										<? if ( $row['totalimsiprinc'] ) : ?>
										+ 옵션추가금액 : <?=number_format($row['totalimsiprinc'])?> 원  
										<? endif; ?><br>								
										총금액 <span><?=number_format($row['totallastprinc'])?></span> 원

									</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="tit"><img src="<?=FRONT_IMG_DIR?>/sub/no_02.jpg">개인정보입력</div>
                    <div class="data">
                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                            <colgroup>
                                <col width="17%">
                                <col width="83%">
                            </colgroup>
                            <tbody>
                                <tr>
                                    <td class="sero">이름</td>
                                    <td><input type="text" name="name" id="name"  value="<?=$row['name']?>"></td>
                                </tr>
                                <tr>
                                    <td class="sero">연락처</td>
                                    <td><input type="text" name="phone" id="phone"  value="<?=$row['phone']?>"  data-mask="phone" ></td>
                                </tr>
                                <tr>
                                    <td class="sero">도착예정시간</td>
                                    <td>
                                        <select name="ptime" id="ptime">
											<option value="">선택</option>
											<option  value="3시">3시</option>
											<option  value="4시">4시</option>
											<option  value="5시">5시</option>
											<option  value="6시이후">6시이후</option>
                                        </select>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="tit"><img src="<?=FRONT_IMG_DIR?>/sub/no_03.jpg">환불규정 확인</div>
                    <div class="refund">
                        <p>
                        * 예약신청 후 12시간의 입금대기 시간이 있으며, 대기시간 중 입금을 하지 않으시면 자동 취소됩니다.<br>
                        * 입금 후 예약 취소 시 수수헌으로 연락을 하셔서 환불 안내를 받으시기를 바랍니다.<br>
                        * 환불 기준은 아래와 같으므로 예약 시 이용안내 및 환불규정을 숙지하시고 예약하시기 바랍니다.<br>  
                        </p>
                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                            <colgroup>
                                <col width="25%">
                                <col width="25%">
                                <col width="25%">
                                <col width="25%">
                            </colgroup>
                            <tbody>
                                <tr>
                                    <td class="garo">숙박 1일전</td>
                                    <td class="garo">숙박 7일전</td>
                                    <td class="garo">숙박 15일전</td>
                                    <td class="garo">숙박 30일전</td>
                                </tr>
                                <tr>
                                    <td>환불불가</td>
                                    <td>50% 환불</td>
                                    <td>80% 환불</td>
                                    <td>100% 환불</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="tit"><img src="<?=FRONT_IMG_DIR?>/sub/no_04.jpg">유의사항 및 개인정보 취급방침</div>
                    <div class="policy">
                        <p>
                        <b>유의사항</b><br>
                        * 입실시간 오후 3시부터, 퇴실시간은 익일 오전 11시 입니다. <br>
                        * 미성년자는 보호자 동반 없이 이용하실 수 없습니다. <br>
                        * 기준인원 및 추가인원 규정을 준수해 주시기 바랍니다. <br> 
                        * 예약신청 후 12시간 내로 전액을 입금하셔야 예약이 완료되며, (12시간이 경과되면 예약신청이 자동 취소됩니다.) 단, 당일 예약과 하루 전 예약은 예약 후 3시간 내에 결재를 완료해주셔야 합니다. <br>
                        * 입금 시 반드시 예약자명으로 해주시고 이름이 다른 경우 수수헌으로 연락을 주셔야 합니다.<br>
                        * 수수헌의 모든 실내공간에서는 금연입니다. 흡연 시에는 정해진 흡연 장소를 이용해 주시기 바랍니다. <br>
                        * 객실 정리가 끝나시면 수수헌에 연락하시어 퇴실점검을 받으시기 바랍니다. <br>
                        * 객실 내 기물파손 등은(퇴실 전 객실점검)이용일 고객께 일부분 또는 전액 배상책임이 있습니다. <br>
                        * 화재 및 냄새로 인해 객실 내 돼지고기, 생선의 조리를 금하오니 실외 지정된 장소 및 자연과 벗한 바비큐장을 이용하시길 부탁드립니다. <br>
                        * 퇴실 시 음식물을 비롯한 모든 쓰레기는 분리수거해 주시고, 사용하신 주방기구는 세척해 주시기 바랍니다. <br>
                        * 애완동물과 함께 입실하실 수 없습니다.<br><br> 

                        <b>수집하는 개인정보 항목</b><br>
                        수수헌은 실시간예약 시 아래와 같은 개인정보를 수집하고 있습니다.<br>
                        * 수집항목 : 이름, 연락처, 도착예정시간, IP<br>
                        * 개인정보 수집방법 : 실시간 예약 시<br><br>
                        <b>개인정보의 수집 및 이용목적</b><br>
                        수수헌은 수집한 개인정보를 다음의 목적을 위해 활용합니다.<br>
                        * 성인 인증 및 원활한 의사소통 경로의 확보<br><br>
                        <b>개인정보의 보유 및 이용기간</b><br>
                        * 귀하의 개인정보는 개인정보의 수집목적 또는 제공받은 목적이 달성되면 파기하는 것을 원칙으로 합니다.<br>
                        &nbsp;&nbsp;&nbsp;그리고 상법, 전자상거래 등에서의 소비자보호에 관한 법률 등 관계법령의 규정에 의하여 보존할 필요가 있는 경우 관계법령에서 정한 일정한 기간 동안 회원정보를 보관합니다.<br>&nbsp;&nbsp;&nbsp;그 보관의 목적으로만 이용하며 보존기간은 아래와 같습니다.<br>
                        &nbsp;- 계약 또는 청약철회 등에 관한 기록 : 5년<br>
                        &nbsp;- 대금결제 및 재화 등의 공급에 관한 기록 : 5년<br>
                        &nbsp;- 소비자의 불만 또는 분쟁처리에 관한 기록 : 3년
                        </p>
                       	<div class="policy_check"><input type="checkbox" id="termsdf">위 유의사항,환불기준,개인정보취급방침에 동의하시면 체크하신 후 객실예약을 진행해 주세요!</div>
                    </div>



                </div>
				</form>

                <div class="nextbtn"><button type="button"  onclick="WriteLastInList.check_wndqhr()">객실예약</button></div>
            </div>


		<div id="showdatevie"></div>
		<script type="text/javascript">
		var WriteLastInList = {
			init: function() {
				$('input[data-mask="phone"]').mask('999-9999-9999');						
			},
			check_wndqhr: function () {

				if ($("input[name=name]").val()==""){
					alert("이름을 입력해주세요");
					$("input[name=name]").focus();
					return false ;
				}	

				if ($("input[name=phone]").val()==""){
					alert("휴대폰번호를 입력해주세요");
					$("input[name=phone]").focus();
					return false ;
				}	

				if ( ! $("#termsdf").is(":checked") ) {
					alert("약관에 동의 해주세요");
					return false ;
				}

				var me = this;
				var formdata = $('#FrmInoutLastInputr').serialize();
				$.ajax({
					url:'/front/reserve/write_check',
					data:formdata, 
					dataType:'html',
					type:'POST',
					success: function(r){		

						var obj = $.parseJSON(r);
						if (obj.is_valid == "0") {
							alert ( '예약 진행중입니다.') ;
							return;
						} else {
							WriteLastInList.save();
						}
						
						return;
					}
				})				

			},
			save: function() {
				var me = this;
				var formdata = $('#FrmInoutLastInputr').serialize();
				$.ajax({
					url:'/front/reserve/calendar_act',
					data:formdata, 
					dataType:'html',
					type:'POST',
					success: function(r){				

						alert ( '예약완료되었습니다.' ) ;
						location.href='/front/reserve/index'
						return;

					}
				})
			}
		}

		$(function() {
			WriteLastInList.init();
		})
		</script>

