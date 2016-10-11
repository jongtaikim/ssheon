<script>
		$(document).ready(function(){
			$('input:radio[name="month"]').on('change',function() {
				var varindex  = $("input:radio[name='month']").index(this) ;
				$('#month_css label').removeClass("active");
				$('#month_css label').eq(varindex).addClass("active");
			});
		});
</script>
	<!-- //subTitle -->
	<div id="title-area">관리자 정보</div>		
		<!-- Contents -->
		<div id="Contents" style="width:1000px;">
		

			<h3 class="area-title">검색</h3>
			<form id="sform"  onsubmit='return false;'>
			<table class="table table-bordered table-form">
				<colgroup>
					<col width="120px">
					<col>
					<col width="120px">
					<col>
					<col width="120px">
					<col>
				</colgroup>

				<tbody>
					<tr>
						<th>달력</th>
						<td  colspan="5">
							<select name="year" id="year" onclick="InoutInList.lodeindex();">
								<option value="2016" <? if ( date("Y") == '2016' ) echo "selected"  ?>>2016년
								<option value="2017" <? if ( date("Y") == '2017' ) echo "selected"  ?>>2017년
								<option value="2018" <? if ( date("Y") == '2018' ) echo "selected"  ?>>2018년
								<option value="2019" <? if ( date("Y") == '2019' ) echo "selected"  ?>>2019년
								<option value="2020" <? if ( date("Y") == '2020' ) echo "selected"  ?>>2020년
							</select>

							<div id="month_css" class="btn-group blss"  data-toggle="buttons">						
								<? for ( $ii=1 ; $ii<=12 ; $ii++ ) { 
									$ii = str_pad( $ii ,"2","0",STR_PAD_LEFT) ;
								?>
								<label class="btn <? if ( date('m') == $ii ) echo "active"  ?>" style="font-size:12px;">
									<input type="radio" name="month" <? if ( date('m') == $ii ) echo "checked"  ?> value="<?=$ii?>"  onclick="InoutInList.lodeindex();"> <?=$ii?> 월
								</label>
								<? } ?>
							</div>		
						</td>
					</tr>
					<? if ( in_array($this->session->userdata('position_code'), array( "99","98","97","96","96" )) || $this->session->userdata('ss_user_id')=='parkhun200@hanaad.net' ) { ?>
					<tr>
						<th>이름</th>
						<td  colspan="5">
							<select name="namecheck" onclick="InoutInList.lodeindex();">
								<option value="">::::::
								<? 
									$sql ="SELECT * FROM `iiop_users` where user_code=1 AND position_code not in ('99') order by name asc " ;
									$rs = mysql_query ( $sql ) ;
									while ( $row = mysql_fetch_array ( $rs ) ) :
								?>
								<option value="<?=$row['userid']?>"><?=$row['name']?>
								<?
									endwhile;
								?>
							</select>
						</td>
					</tr>
					<? } ?>
				</tbody>
			</table>
			</form>

			<div class="area-button">
				<button class="btn btn-lg btn-theme" onclick="InoutInList.lodeindex()"><i class="fa fa-search"></i> 검색</button>
				<!--button class="btn btn-lg btn-gray" onclick="InoutInList.lodeindex()">처음으로</button-->
			</div>			
		   			   	
			<!-- //boardUp -->													
			<div id="search_result"></div>	
		</div>
		<!-- Contents -->
	</div>

		<!--div id="suar_name"></div-->

		<script type="text/javascript">
		var InoutInList = {
			page:1,
			init: function() {
				this.lodeindex();
			},
			reload : function(page) {
				InoutInList.lodeindex(page);
			},
			openInput: function(inout_no) {
				var title = (inout_no)?'예약 상태':'예약 상태';
				var modal = new HmisModal('inout_input', {width:650, top:200});
				modal.open(title,'/admin/calendar/openpopup',{inout_no:inout_no});
			},
			delete_all: function(seqno) {

				var seqno ;
		        var ans = confirm("삭제를 진행하시겠습니까?");
		        if (ans == false) {
		            return ;
		        }
		        $.ajax({
		            type: "POST",
		            url: "/admin/calendar/view_delete_all/",
			        data: { seqno: seqno },	
		            success: function(result_data){
						alert ( "삭제하였습니다." ) ;
						$('.modal-close').trigger('click');		
						InoutInList.lodeindex();
		            }
		        });
			},
			lodeindex: function(pageNo) {
				var pageNo = ( pageNo ? pageNo : 1) ;  
				var _data = $('#sform').serialize()+"&page="+pageNo ; 

				$.ajax({
						 type: 'POST',
						 url: '/admin/calendar/lists',
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







