
			<form id="FrmInoutLastInputr" name="FrmInoutLastInputr"  method="post"  enctype="multipart/form-data">
				<input type="hi1dden" name="todate" id="todate" value="<?=$row['todate']?>">
				<input type="hid1den" name="uprinc" id="uprinc" value="<?=$row['uprinc']?>">
				<input type="hid1den" name="lastdate" id="lastdate" value="<?=$row['lastdate']?>">
				<input type="hid1den" name="lastprinc" id="lastprinc" value="<?=$row['lastprinc']?>" >		

				<input type="hid1den" name="totallastprinc" id="totallastprinc" value="<?=$row['totallastprinc']?>" >	
				<input type="hid1den" name="totalimsiprinc" id="totalimsiprinc" value="<?=$row['totalimsiprinc']?>" >		
				<input type="hid1den" name="imsiprinc0" id="imsiprinc0" value="<?=$row['imsiprinc0']?>" >		
				<input type="hid1den" name="imsiprinc1" id="imsiprinc1" value="<?=$row['imsiprinc1']?>" >		
				<input type="hid1den" name="imsiprinc2" id="imsiprinc2" value="<?=$row['imsiprinc2']?>" >		
				<input type="hid1den" name="imsiprinc3" id="imsiprinc3" value="<?=$row['imsiprinc3']?>" >		
				<input type="hid1den" name="imsiprinc4" id="imsiprinc4" value="<?=$row['imsiprinc5']?>" >		
				<input type="hid1den" name="imsiprinc5" id="imsiprinc5" value="<?=$row['imsiprinc5']?>" >		
				<input type="hid1den" name="imsiprinc6" id="imsiprinc6" value="<?=$row['imsiprinc6']?>" >		
				<input type="hid1den" name="imsiprinc7" id="imsiprinc7" value="<?=$row['imsiprinc7']?>" >		
				<input type="hid1den" name="imsiprinc8" id="imsiprinc8" value="<?=$row['imsiprinc8']?>" >		

				<input type="hid1den" name="guestroom" id="guestroom" value="<?=$row['guestroom']?>" >		
				<input type="hid1den" name="rownumber" id="rownumber" value="<?=$row['rownumber']?>" >		
				<input type="hid1den" name="seongin_val" id="seongin_val" value="<?=$row['seongin_val']?>" >		
				<input type="hid1den" name="adong_val" id="adong_val" value="<?=$row['adong_val']?>" >		
				<input type="hid1den" name="yua_val" id="yua_val" value="<?=$row['yua_val']?>" >		
				<input type="hid1den" name="pperiodofuse" id="pperiodofuse" value="<?=$row['pperiodofuse']?>" >		
				<input type="hid1den" name="totalcnrkprinc" id="totalcnrkprinc" value="<?=$row['totalcnrkprinc']?>" >		

				
				<br><br><br><br><br><br><br><br>


				이름 <input type="text" name="name" id="name" style="width:100px;" value="<?=$row['name']?>"   /> <br>
				연락처 <input type="text" name="phone" id="phone" style="width:100px;" value="<?=$row['phone']?>"   /><br>
				도착예정시간 <input type="text" name="ptime" id="ptime" style="width:100px;" value="<?=$row['ptime']?>"   /><br>

							<select name="hour_val">
								<option value="00">00</option>
								<? foreach($hour as $hour_val){?>
								<option value="<?=$hour_val?>"><?=$hour_val?></option>
								<? } ?>
							</select> :
							<select name="minute_val">
								<option value="00">00</option>
								<? foreach($minute as $minute_val ){?>
								<option value="<?=$minute_val?>"><?=$minute_val?></option>
								<? } ?>
							</select>

			</form>

				<div class="area-button">
					<button class="btn btn-lg btn-flat-blue" onclick="WriteLastInList.check_wndqhr()"><i class="fa fa-search"></i> 등록하기</button>
					<!--button class="btn btn-lg btn-gray" onclick="InoutInList.lodeindex()">처음으로</button-->
				</div>




		<div id="showdatevie"></div>
		<script type="text/javascript">
		var WriteLastInList = {
			init: function() {
						
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
							alert ( '예약완료되었습니다.' ) ;
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
					url:'/admin/calendar/calendar_act',
					data:formdata, 
					dataType:'html',
					type:'POST',
					success: function(r){				

//						alert ( r) ;

						$("#showdatevie").html( r ) ;
						return;

						var obj = $.parseJSON(r);
						if (obj.is_valid == "0") {
							alert ( '예약 진행중입니다.') ;
						} else {
							//alert ( '다음화면') ;
							$("#search_result").html( r ) ;
						}
							
						return;
						$('.modal-close').trigger('click');				
						InoutInList.lodeindex();
					}
				})
			}
		}

		$(function() {
			WriteLastInList.init();
		})
		</script>

