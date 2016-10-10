        <div id="contents">
			<div class="title"><img src="<?=FRONT_IMG_DIR?>/sub/tt_reserve.jpg"></div>

			<!-- 1단계 달력 요금정보 및 예약 -->
			<div class="section">
				<div class="start">
					<div class="icon">
						<ul>
							<li><img src="<?=FRONT_IMG_DIR?>/sub/icon_01.jpg"></li>
							<li><img src="<?=FRONT_IMG_DIR?>/sub/icon_02.jpg"></li>
						</ul>
					</div>
					<div class="button"><button type="button" onclick="InoutInList.openInput('');">예약확인</button></div>
				</div>
				<div class="calendar" style="padding-bottom:30px;">
					<form id="FrmAttendanceSearchs"  onsubmit='return false;'>
					<input type="hidden" name="leavedate" id="leavedate" value="<?=date('Y-m-d')?>" class=" datepicker"  />

					<input type="hidden" name="str_year" id="str_year" value="<?=date('Y')?>" />
					<input type="hidden" name="str_month" id="str_month" value="<?=date('m')?>" />
					<input type="hidden" name="str_day" id="str_day" value="<?=date('d')?>" />

					<div class="month">
						<img src="<?=FRONT_IMG_DIR?>/sub/prev.jpg" onclick="InoutInList.leftdates()" style="cursor:pointer;" >
							<span id="temp_year"><?=date('Y')?></span>.<span id="temp_month"><?=date('m')?></span>
						<img src="<?=FRONT_IMG_DIR?>/sub/next.jpg" onclick="InoutInList.rightdates()" style="cursor:pointer;">
					</div>
					</form>
						<div id="search_result" ></div>

				</div>
			</div>

			<div id="search_result_wr" ></div>

			</div>

			<script language="javascript" src="<?=ADMIN_JS_DIR?>/jquery.maskedinput.min.js"></script>

			<script type="text/javascript">
			var InoutInList = {
				page:1,
				init: function() {
					this.lodeindex();
				},
				reload : function(page) {
					InoutInList.lodeindex(page);
				},
				leftdates: function() {
//					var date = $("#str_year").val()+"-"+$("#str_month").val()+"-"+$("#str_day").val();
					var date = $("#str_year").val()+"-"+$("#str_month").val()+"-01";
					var newDt = new Date(date);
					newDt.setMonth( newDt.getMonth() - 1 );
					newDt.setDate(1);
//					var resultDate = InoutInList.converDateString(newDt) ;

					var tty = newDt.getFullYear() ;
					var ttm = InoutInList.addZero(eval(newDt.getMonth()+1)) ;

					$("#str_year").val(tty) ;
					$("#str_month").val(ttm) ;

					$("#temp_year").html(tty) ;
					$("#temp_month").html(ttm) ;

//					$("#leavedate").val(resultDate);
					InoutInList.lodeindex()
				},
				converDateString : function(dt) {
					return dt.getFullYear() + "-" + InoutInList.addZero(eval(dt.getMonth()+1)) + "-" + InoutInList.addZero(dt.getDate());
				},
				addZero : function(i) {
					var rtn = i + 100;
					return rtn.toString().substring(1,3);
				},
				rightdates: function() {
//					var dt = $("#str_year").val()+"-"+$("#str_month").val()+"-"+$("#str_day").val();
					var dt = $("#str_year").val()+"-"+$("#str_month").val()+"-01";
					var newDt = new Date(dt);
					newDt.setMonth( newDt.getMonth() + 1 );
					newDt.setDate(1);

					var tty = newDt.getFullYear() ;
					var ttm = InoutInList.addZero(eval(newDt.getMonth()+1)) ;
				
				
					$("#str_year").val(tty) ;
					$("#str_month").val(ttm) ;

					$("#temp_year").html(tty) ;
					$("#temp_month").html(ttm) ;

					InoutInList.lodeindex()
				},
				openInput: function(inout_no) {
					var title = (inout_no)?'asd':'asdas';
					var modal = new HmisModal('inout_input', {width:575, top:206});
					modal.open(title,'/front/reserve/openlist_ser',{inout_no:inout_no});
				},
				readlodeview: function(temp1,temp2) {


					var _data = "&temp1="+temp1+"&temp2="+temp2 ; 
					$.ajax({
							 type: 'POST',
							 url: '/front/reserve/writepage',
							 data : _data,
							 dataType : "html", //전송받을 데이터의 타입
							 success : function(jsondata) {

								$('#search_result_wr').html(jsondata) ;
								$('html, body').scrollTop( $(document).height() );
							}
					 });
				},
				delete_all: function(seqno) {
					var seqno ;
					var ans = confirm("삭제를 진행하시겠습니까?");
					if (ans == false) {
						return ;
					}
					$.ajax({
						type: "POST",
						url: "/front/reserve/delete_all/",
						data: { seqno: seqno },	
						success: function(result_data){
	//						$("#suar_name").html(result_data) ;
							InoutInList.lodeindex();
						}
					});
				},
				lodeindex: function() {

					var _data = $('#FrmAttendanceSearchs').serialize()  ; 

					$.ajax({
							 type: 'POST',
							 url: '/front/reserve/lists',
							 data : _data,
							 dataType : "html", //전송받을 데이터의 타입
							 success : function(jsondata) {
								$('#search_result').html(jsondata) ;
							}
					 });
				}
			}

			$(function() {
				InoutInList.init();
			})
			</script>







