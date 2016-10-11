	<!-- //subTitle -->
	<div id="title-area">근태 관리</div>	
	
		<!-- Contents -->
		<div id="Contents" style="width:1300px;">
		
			<div>
			<form id="FrmInoutInputr" name="FrmInoutInputr"  method="post"  enctype="multipart/form-data">
				<input type="hi1dden" name="todate" id="todate" value="<?=$row['todate']?>">
				<input type="hid1den" name="uprinc" id="uprinc" value="<?=$row['uprinc']?>">
				<input type="hid1den" name="lastdate" id="lastdate" value="<?=$row['lastdate']?>">
				<input type="hid1den" name="lastprinc" id="lastprinc" value="0" >		

				<input type="hid1den" name="totallastprinc" id="totallastprinc" value=0 >		
				<input type="hid1den" name="totalimsiprinc" id="totalimsiprinc" value=0 >		

				<input type="hid1den" name="imsiprinc0" id="imsiprinc0" value=0 >		
				<input type="hid1den" name="imsiprinc1" id="imsiprinc1" value=0 >		
				<input type="hid1den" name="imsiprinc2" id="imsiprinc2" value=0 >		
				<input type="hid1den" name="imsiprinc3" id="imsiprinc3" value=0 >		
				<input type="hid1den" name="imsiprinc4" id="imsiprinc4" value=0 >		
				<input type="hid1den" name="imsiprinc5" id="imsiprinc5" value=0 >		
				<input type="hid1den" name="imsiprinc6" id="imsiprinc6" value=0 >		
				<input type="hid1den" name="imsiprinc7" id="imsiprinc7" value=0 >		
				<input type="hid1den" name="imsiprinc8" id="imsiprinc8" value=0 >		
				
				<input type="hid1den" name="totalcnrkprinc" id="totalcnrkprinc" value=0 >		


				<h3> 기본정보 </h3>
				<table class="table table-bordered table-form">
					<colgroup>
						<col width="120px">
						<col>
						<col width="120px">
						<col>
					</colgroup>
					<tbody>
						<tr>
							<th>객실명</th>
							<td>
								<input type="text" name="guestroom" id="guestroom" style="width:200px;" value="<?=$row['guestroom']?>"   />
							</td>		
							<th>기준인원</th>
							<td >
								<input type="text" name="rownumber" id="rownumber" style="width:98%;" value="<?=$row['rownumber']?>"   />
							</td>								
						</tr>
						<tr>
							<th>기준인원</th>
							<td>
								<input type="text" name="rownumber" id="rownumber" style="width:98%;" value="<?=$row['rownumber']?>"   />
							</td>
							<th>기준인원</th>
							<td>
								<input type="text" name="rownumber" id="rownumber" style="width:98%;" value="<?=$row['rownumber']?>"   />
							</td>							
						</tr>
					</tbody>
				</table>

				<h3 class="area-title">
					<span class="f-bold"> 부대시설 관리</span>
				</h3>

				<table class="table table-bordered table-list table-striped table-hover">
					<colgroup>
						<col>
						<col>
						<col>
						<col>
						<col>
						<col>
					</colgroup>
					<thead>
						<tr>
							<th style="height:38px;">객실명</th>
							<th>기준/최대</th>
							<th>추가인원</th>
							<th>숙박일</th>
							<th>숙박기간</th>
							<th>이용요금</th>
						</th>
					</thead>
					<tbody>				
						<tr>
							<td style="height:38px;"><?=$row['name']?></td>
							<td style="height:38px;text-align:left;word-wrap:break-word;word-break:break-all;"><?=$row['content']?></td>
							<td style="height:38px;text-align:left;word-wrap:break-word;word-break:break-all;">
							
								성인 <select name="seongin_val" id="seongin_val" onchange="cnrkchanges();">
										<option value="0" selected>0
										<? for ( $ii=1 ; $ii<=20 ; $ii++ ) :?>
										<option value="<?=$ii?>" ><?=$ii?>
										<? endfor; ?>
									 </select>							

								아동 <select name="adong_val" id="adong_val" onchange="cnrkchanges();">
										<option value="0" selected>0
										<? for ( $ii=1 ; $ii<=20 ; $ii++ ) :?>
										<option value="<?=$ii?>" ><?=$ii?>
										<? endfor; ?>
									 </select>							

								유아 <select name="yua_val" id="yua_val" onchange="cnrkchanges();">
										<option value="0" selected>0
										<? for ( $ii=1 ; $ii<=20 ; $ii++ ) :?>
										<option value="<?=$ii?>" ><?=$ii?>
										<? endfor; ?>
									 </select>			
									 
							</td>
							<td style="height:38px;text-align:left;word-wrap:break-word;word-break:break-all;"><div id="totaldate"></div></td>
							<td>
								<select name="pperiodofuse" id="pperiodofuse" onchange="changprinc(this.value);">
									<option value="1" selected>1

									<? for ( $ii=2 ; $ii<=10 ; $ii++ ) :?>
									<option value="<?=$ii?>" ><?=$ii?>
									<? endfor; ?>

								</select>
							</td>
							<td><?=$row['uprinc']?></td>
						</tr>	
					</tbody>
				</table>

				<h3> 기본정보 </h3>
				<table class="table table-bordered table-form">
					<colgroup>
						<col width="120px">
						<col>
						<col width="120px">
						<col>
					</colgroup>
					<tbody>
						<tr>
							<th>객실명</th>
							<td>
							   <?foreach($loop as $kk=>$row): ?>		
								
									<?=$row['name'] ?>&nbsp;&nbsp;&nbsp;&nbsp;<?=$row['sprinc']?>&nbsp;&nbsp;&nbsp;&nbsp;<select name="realpan_princ" id="realpan_princ" onchange="tot_princ<?=$kk?>(this.value);">
											<option value=0||0>선택<?=$kk?>
										<? for ( $ii=1 ; $ii<=8 ; $ii++ ) :?>
											<option value="<?=$row['sprinc']?>||<?=$ii?>"><?=$ii?>
										<? endfor;?>
									</select><br>

									<script type="text/javascript">
									<!--
										function tot_princ<?=$kk?>( vals ) {
											var strarray = vals.split('||');
											var strplues = ( strarray[0] * strarray[1] )  ;
											$("#imsiprinc<?=$kk?>").val(Number(strplues));

											var totstrplues = parseInt($("#imsiprinc0").val())+ parseInt($("#imsiprinc1").val())+ parseInt($("#imsiprinc2").val())+ parseInt($("#imsiprinc3").val())+ parseInt($("#imsiprinc4").val())+ parseInt($("#imsiprinc5").val())+ parseInt($("#imsiprinc6").val())+ parseInt($("#imsiprinc7").val())+ parseInt($("#imsiprinc8").val());

											$("#totalimsiprinc").val(Number(totstrplues));			
											
											$("#name_totalimsiprinc").html(totstrplues) ;	

											var ttprc = Number($("#lastprinc").val()) + totstrplues + Number($("#totalcnrkprinc").val()) ;
											$("#totallastprinc").val(ttprc);	
											$("#totalprinc").html(ttprc) ; 											
										}										
									//-->
									</script>

							   <? endforeach; ?>								
							</td>		
							<th>기준인원</th>
							<td >
								객실금액: <span id="name_totallastprinc"></span><br>
								인원추가금액: <span id="name_totalcnrkprinc"></span><br>
								옵션금액:  <span id="name_totalimsiprinc"></span><br><br>

								<div id="totalprinc"></div><br>
							</td>								
						</tr>
					</tbody>
				</table>

			</form>

				<div class="area-button">
					<button class="btn btn-lg btn-flat-blue" onclick="WriteInList.check_wndqhr()"><i class="fa fa-search"></i> 등록하기</button>
					<!--button class="btn btn-lg btn-gray" onclick="InoutInList.lodeindex()">처음으로</button-->
				</div>

			</div>
			
		</div>

</div>
		<div id="showdatevie"></div>
<script type="text/javascript">
<!--
	 

	function changprinc ( vals ) {

		var juprinc = $("#uprinc").val() ;
		var jtodate = $("#todate").val() ;

		var teppps = date_add(jtodate,vals) ;			
		var totaldaate = jtodate +"~"+teppps ; 
		var totalprc = juprinc * vals ;		

		$("#lastdate").val(teppps) ;
		$("#totaldate").html(totaldaate) ;

		$("#lastprinc").val(totalprc) ;
		
		var totstrplues = parseInt($("#imsiprinc0").val())+ parseInt($("#imsiprinc1").val())+ parseInt($("#imsiprinc2").val())+ parseInt($("#imsiprinc3").val())+ parseInt($("#imsiprinc4").val())+ parseInt($("#imsiprinc5").val())+ parseInt($("#imsiprinc6").val())+ parseInt($("#imsiprinc7").val())+ parseInt($("#imsiprinc8").val());
		$("#totalimsiprinc").val(Number(totstrplues));	

		$("#name_totallastprinc").html(totalprc);		

		var ttprc = Number($("#totalimsiprinc").val()) + totalprc + Number($("#totalcnrkprinc").val()) ;
		$("#totallastprinc").val(ttprc);

		$("#totalprinc").html(ttprc) ;		

	};

    //추가인원
	function cnrkchanges() {
		var temp1 = Number($("#seongin_val").val()) * 30000 ;
		var temp2 = Number($("#adong_val").val()) * 20000 ;
		var temp3 = Number($("#yua_val").val()) * 10000 ; 

		var total = temp1 + temp2 + temp3  ;

		$("#totalcnrkprinc").val(total);			
		$("#name_totalcnrkprinc").html(total);			
		

		var ttprc = Number($("#totalimsiprinc").val()) + total + Number($("#lastprinc").val()) ;
		$("#totallastprinc").val(ttprc);
		$("#totalprinc").html(ttprc) ;			
//	totalcnrkprinc
	};

	function date_add(strDate1, nDays) {

		var strDate1 ;
		var arr1 = strDate1.split('-');
		var dat1 = new Date(arr1[0], arr1[1], arr1[2]);

		dat1.setDate(dat1.getDate() + Number(nDays) ) ;

		var totaldate =  dat1.getFullYear() + "-" + pad(dat1.getMonth(),2) + "-" + pad(dat1.getDate(),2)  ;
		return totaldate ;
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

				var teppps = date_add(jtodate,1) ;			
				var totaldaate = jtodate +"~"+teppps ; 
				var totalprc = juprinc * 1 ;		

				$("#lastdate").val(teppps) ;
				$("#totaldate").html(totaldaate) ;
				$("#totalprinc").html(totalprc) ;
				$("#name_totallastprinc").html(totalprc);		
				$("#lastprinc").val(totalprc) ;				
			},
			check_wndqhr: function () {

				var me = this;
				var formdata = $('#FrmInoutInputr').serialize();
				$.ajax({
					url:'/admin/calendar/write_check',
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
					url:'/admin/calendar/write_act',
					data:formdata, 
					dataType:'html',
					type:'POST',
					success: function(r){		
//						alert ( r) ;
						$("#search_result").html( r ) ;
						return;
					}
				})
			}
		}

		$(function() {
			WriteInList.init();
		})
		</script>



