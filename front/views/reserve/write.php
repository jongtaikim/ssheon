            <!-- 2단계 예약자 정보 및 금액 -->

            <div class="section">
			<form id="FrmInoutInputr" name="FrmInoutInputr"  method="post"  enctype="multipart/form-data">
				<input type="hidden" name="todate" id="todate" value="<?=$row['todate']?>">
				<input type="hidden" name="uprinc" id="uprinc" value="<?=$row['uprinc']?>">
				<input type="hidden" name="lastdate" id="lastdate" value="<?=$row['lastdate']?>">
				<input type="hidden" name="lastprinc" id="lastprinc" value="0" >		

				<input type="hidden" name="totallastprinc" id="totallastprinc" value=0 >		
				<input type="hidden" name="totalimsiprinc" id="totalimsiprinc" value=0 >		

				<input type="hidden" name="imsiprinc0" id="imsiprinc0" value=0 >		
				<input type="hidden" name="imsiprinc1" id="imsiprinc1" value=0 >		
				<input type="hidden" name="imsiprinc2" id="imsiprinc2" value=0 >		
				<input type="hidden" name="imsiprinc3" id="imsiprinc3" value=0 >		
				<input type="hidden" name="imsiprinc4" id="imsiprinc4" value=0 >		
				<input type="hidden" name="imsiprinc5" id="imsiprinc5" value=0 >		
				<input type="hidden" name="imsiprinc6" id="imsiprinc6" value=0 >		
				<input type="hidden" name="imsiprinc7" id="imsiprinc7" value=0 >		
				<input type="hidden" name="imsiprinc8" id="imsiprinc8" value=0 >		
				

				<input type="hidden" name="imsival0" id="imsival0" value='' >		
				<input type="hidden" name="imsival1" id="imsival1" value='' >		
				<input type="hidden" name="imsival2" id="imsival2" value='' >		
				<input type="hidden" name="imsival3" id="imsival3" value='' >		
				<input type="hidden" name="imsival4" id="imsival4" value='' >		
				<input type="hidden" name="imsival5" id="imsival5" value='' >		
				<input type="hidden" name="imsival6" id="imsival6" value='' >		
				<input type="hidden" name="imsival7" id="imsival7" value='' >		
				<input type="hidden" name="imsival8" id="imsival8" value='' >		

				<input type="hidden" name="totalcnrkprinc" id="totalcnrkprinc" value=0 >		
                
				<div class="sum">
                    <div class="info">
                        <table border="0" cellpadding="0" cellspacing="0">
                            <colgroup>
                                <col width="15%">
                                <col width="34%">
                                <col width="2%">
                                <col width="15%">
                                <col width="34%">
                            </colgroup>
                            <tbody>
                                <tr>
                                    <td class="info_tit">문의전화</td>
                                    <td>010-8924-1352</td>
                                    <td class="border_none" rowspan="3"></td>
                                    <td class="info_tit" rowspan="3">요금타입</td>
                                    <td rowspan="3">*성수기 7~8월<br>*준성수기 4~5월/ 9~10월<br>*기준인원 초과시 1인당 성인 20,000원,취학아동 20,000원,<br>&nbsp;&nbsp;미취학아동10,000원이 추가됩니다.</td>
                                </tr>
                                <tr>
                                    <td class="border_none"></td>
                                    <td class="border_none"></td>
                                </tr>
                                <tr>
                                    <td class="info_tit">결제안내</td>
                                    <td>무통장 입금(국민은행/ 702701-01-565940/ 백준(수수헌)</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="guest">
                        <div class="tit">★객실정보 및 예약자정보</div>
                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                            <colgroup>
                                <col width="15%">
                                <col width="15%">
                                <col width="10%">
                                <col width="30%">
                                <col width="20%">
                                <col width="10%">
                            </colgroup>
                            <tbody>
                                <tr>
                                    <td class="garo">객실명</td>
                                    <td class="garo">이용요금</td>
                                    <td class="garo">기준/최대</td>
                                    <td class="garo">추가인원</td>
                                    <td class="garo">숙박일</td>
                                    <td class="garo">숙박기간</td>
                                </tr>
                                <tr>
                                    <td><?=$row['guestroom']?></td>
                                    <td><?=number_format($row['uprinc'])?> 원</td>
                                    <td><?=$row['rownumber']?>/20</td>
                                    <td>
									
										성인 <select name="seongin_val" id="seongin_val" onchange="cnrkchanges();">
												<option value="0" selected>0
												<? for ( $ii=1 ; $ii<=12 ; $ii++ ) :?>
												<option value="<?=$ii?>" ><?=$ii?>
												<? endfor; ?>
											 </select>							

										아동 <select name="adong_val" id="adong_val" onchange="cnrkchanges();">
												<option value="0" selected>0
												<? for ( $ii=1 ; $ii<=12 ; $ii++ ) :?>
												<option value="<?=$ii?>" ><?=$ii?>
												<? endfor; ?>
											 </select>							

										유아 <select name="yua_val" id="yua_val" onchange="cnrkchanges();">
												<option value="0" selected>0
												<? for ( $ii=1 ; $ii<=12 ; $ii++ ) :?>
												<option value="<?=$ii?>" ><?=$ii?>
												<? endfor; ?>
											 </select>	

                                    </td>
                                    <td><div id="totaldate"></div></td>
                                    <td style=" border-right:none">

										<select name="pperiodofuse" id="pperiodofuse" onchange="changprinc(this.value);">
											<option value="1" selected>1박
											<? for ( $ii=2 ; $ii<=4 ; $ii++ ) :?>
											<option value="<?=$ii?>" ><?=$ii?>박
											<? endfor; ?>
										</select>

									</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="choice">
                        <div class="option">
                            <div class="tit">★옵션선택</div>
                            <div class="optionsel">
                                <ul>
									<?foreach($loop as $kk=>$row): ?>	
                                    <li><!--input type="checkbox"-->&nbsp;&nbsp;<!--바비큐 숯그릴(테이블 당 30,000원)--><?=$row['name'] ?>
                                        <div class="sel_right">
									
											<? if ( $row['sprinc'] != 0 ) :?>
											<select name="realpan_princ" id="realpan_princ" onchange="tot_princ<?=$kk?>(this.value);">
												<option value=0||0||0>선택
												<? for ( $ii=1 ; $ii<=20 ; $ii++ ) :?>
												<option value="<?=$row['sprinc']?>||<?=$ii?>||<?=$row['name']?>"><?=$ii?>
												<? endfor;?>
											</select>
											<? endif; ?>
                                        </div>

										<script type="text/javascript">
										<!--
											function tot_princ<?=$kk?>( vals ) {
												var strarray = vals.split('||');
												var strplues = ( strarray[0] * strarray[1] )  ;
												$("#imsiprinc<?=$kk?>").val(Number(strplues));

												var tempsss = strarray[1]+'||'+strarray[2] ;
												if ( tempsss == '0||0' ) {
													tempsss = '' ;
												}
												$("#imsival<?=$kk?>").val(tempsss);

												var totstrplues = parseInt($("#imsiprinc0").val())+ parseInt($("#imsiprinc1").val())+ parseInt($("#imsiprinc2").val())+ parseInt($("#imsiprinc3").val())+ parseInt($("#imsiprinc4").val())+ parseInt($("#imsiprinc5").val())+ parseInt($("#imsiprinc6").val())+ parseInt($("#imsiprinc7").val())+ parseInt($("#imsiprinc8").val());

												$("#totalimsiprinc").val(Number(totstrplues));			
												
												$("#name_totalimsiprinc").html(numberWithCommas(totstrplues)) ;	

												var ttprc = Number($("#lastprinc").val()) + totstrplues + Number($("#totalcnrkprinc").val()) ;
												$("#totallastprinc").val(ttprc);	
												$("#totalprinc").html(numberWithCommas(ttprc)) ; 											
											}										
										//-->
										</script>


                                    </li>
									<? endforeach; ?>
                                    <!--li><input type="checkbox">캠프파이어시설 참나무장작( 1망 10,000원)
                                        <div class="sel_right">
                                        <select>
                                        <option>선택</option>
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        </select>
                                        </div>
                                    </li>
                                    <li><input type="checkbox">Afternoon tea(9월 오픈예정)
                                        <div class="sel_right">
                                        <select>
                                        <option>선택불가</option>
                                        </select>
                                        </div>
                                    </li>
                                    <li><input type="checkbox">다도체험(9월 오픈예정)
                                        <div class="sel_right">
                                        <select>
                                        <option>선택불가</option>
                                        </select>
                                        </div>
                                    </li>
                                    <li><input type="checkbox">천연염색체험(9월 오픈예정)
                                        <div class="sel_right">
                                        <select>
                                        <option>선택불가</option>
                                        </select>
                                        </div>
                                    </li-->
                                </ul>
                            </div>
                        </div>
                        <div class="amount">
                            <div class="tit">★금액</div>
                            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <colgroup>
                                    <col width="40%">
                                    <col width="60%">
                                </colgroup>
                                <tbody>
                                    <tr>
                                        <td class="amount_tit"><!--&middot; 객실금액 : <strong>350,000</strong> 원<br>&middot; 인원추가금액 : <strong>30,000</strong> 원<br>&middot; 옵션금액 : <strong>30.000</strong> 원-->
										
											&middot; 객실금액 : <strong><span id="name_totallastprinc">0</span></strong> 원<br>
											&middot; 인원추가금액 : <strong><span id="name_totalcnrkprinc">0</span></strong> 원<br>
											&middot; 옵션금액 : <strong><span id="name_totalimsiprinc">0</span></strong> 원			

										</td>
                                        <td class="amount_txt"><p>총금액</p><div class="sum_f"><span id="totalprinc">0</span>원</div></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
				</form>
                <div class="nextbtn"><button type="button" onclick="WriteInList.check_wndqhr()">다음단계</button></div>
            </div>       
			

		<script type="text/javascript">
		<!--
			 
			function changprinc ( vals ) {

				var juprinc = $("#uprinc").val() ;
				var jtodate = $("#todate").val() ;

				//var teppps = date_add(jtodate,vals) ;

                $.ajax({
                    type: 'GET',
                    url: '/front/reserve/day_plus/'+jtodate+'/'+vals,
                    data:'',
                    dataType: 'json',
                    success: function(data, status) {
                        console.log(data.totaldate);
                        var teppps =  data.totaldate ;

                        var totaldaate = jtodate +"~"+teppps ;
                        var totalprc = juprinc * vals ;

                        $("#lastdate").val(teppps) ;
                        $("#totaldate").html(totaldaate) ;

                        $("#lastprinc").val(totalprc) ;

                        var totstrplues = parseInt($("#imsiprinc0").val())+ parseInt($("#imsiprinc1").val())+ parseInt($("#imsiprinc2").val())+ parseInt($("#imsiprinc3").val())+ parseInt($("#imsiprinc4").val())+ parseInt($("#imsiprinc5").val())+ parseInt($("#imsiprinc6").val())+ parseInt($("#imsiprinc7").val())+ parseInt($("#imsiprinc8").val());
                        $("#totalimsiprinc").val(Number(totstrplues));

                        $("#name_totallastprinc").html(numberWithCommas(totalprc));

                        var ttprc = Number($("#totalimsiprinc").val()) + totalprc + Number($("#totalcnrkprinc").val()) ;
                        $("#totallastprinc").val(ttprc);

                        $("#totalprinc").html(numberWithCommas(ttprc)) ;

                    },
                    error: function(request,status,error) {
                        alert(request.responseText);
                    }
                });




			};

			function numberWithCommas(x) {
				return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
			}

			//추가인원
			function cnrkchanges() {
				var temp1 = Number($("#seongin_val").val()) * 20000 ;
				var temp2 = Number($("#adong_val").val()) * 20000 ;
				var temp3 = Number($("#yua_val").val()) * 10000 ; 

				var total = temp1 + temp2 + temp3  ;

				$("#totalcnrkprinc").val(total);			
				$("#name_totalcnrkprinc").html(numberWithCommas(total));			
				

				var ttprc = Number($("#totalimsiprinc").val()) + total + Number($("#lastprinc").val()) ;
				$("#totallastprinc").val(ttprc);
				$("#totalprinc").html(numberWithCommas(ttprc)) ;			
		//	totalcnrkprinc
			};

			function date_add(strDate1, nDays) {

			};

			function pad(n, width) {
			  n = n + '';
			  return n.length >= width ? n : new Array(width - n.length + 1).join('0') + n;
			};

		//-->
		</script>

		<script type="text/javascript">
		var WriteInList = {
			page:1,
			init: function() {
				
				var jtodate = $("#todate").val() ;
				var juprinc = $("#uprinc").val() ;

                $.ajax({
                    type: 'GET',
                    url: '/front/reserve/day_plus/'+jtodate+'/1',
                    data:'',
                    dataType: 'json',
                    success: function(data, status) {
                        console.log(data.totaldate);

                        var teppps = data.totaldate ;
                        var totaldaate = jtodate +"~"+teppps ;
                        var totalprc = juprinc * 1 ;



                        $("#lastdate").val(teppps) ;
                        $("#totaldate").html(totaldaate) ;
                        $("#totalprinc").html(numberWithCommas(totalprc)) ;
                        $("#name_totallastprinc").html(numberWithCommas(totalprc));
                        $("#lastprinc").val(totalprc) ;

                    },
                    error: function(request,status,error) {
                        alert(request.responseText);
                    }
                });



			},
			check_wndqhr: function () {

				var me = this;
				var formdata = $('#FrmInoutInputr').serialize();
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
							WriteInList.save();
						}
						
						return;
					}
				})				

			},
			save: function() {
				var me = this;
				var formdata = $('#FrmInoutInputr').serialize();
				$.ajax({
					url:'/front/reserve/write_act',
					data:formdata, 
					dataType:'html',
					type:'POST',
					success: function(r){		
//						alert ( r) ;
						$("#search_result_wr").html( r ) ;
						return;
					}
				})
			}
		}

		$(function() {
			WriteInList.init();
		})
		</script>



