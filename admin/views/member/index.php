
	<!-- //subTitle -->
	<div id="title-area">관리자 정보</div>		
		<!-- Contents -->
		<div id="Contents" style="width:900px;">
		
			<!-- path -->
			<form id="sform" onsubmit='return false;' >				
			<!-- boardUp -->
			<div class="boardUp" >			
				 <!-- 게시판 검색 -->
				<div class="search_bbs">							
					<!-- h4 class="search_bbs_title">----</h4 -->
					<!--input type="text"  name="pname" id="pname" />
					<button class="button"  style='font-size:15px;' onclick="lodebbslist();">검색</button-->					
				</div>
				
				<!-- div class="clear"></div -->
			</div>
		   	</form>				
		   			   	
			<!-- //boardUp -->													
			<div id="search_result" style="padding-left:15px;"></div>	
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
				var title = (inout_no)?'관리자 수정':'관리자 등록';
				var modal = new HmisModal('inout_input', {width:750, top:200});
				modal.open(title,'/admin/member/openpopup',{inout_no:inout_no});
			},
			delete_all: function(seqno) {
				var seqno ;
		        var ans = confirm("삭제를 진행하시겠습니까?");
		        if (ans == false) {
		            return ;
		        }
		        $.ajax({
		            type: "POST",
		            url: "/admin/member/delete_all/",
			        data: { seqno: seqno },	
		            success: function(result_data){
//						$("#suar_name").html(result_data) ;
						InoutInList.lodeindex();
		            }
		        });
			},
			lodeindex: function(pageNo) {
				var pageNo = ( pageNo ? pageNo : 1) ;  
				var _data = $('#sform').serialize()+"&page="+pageNo ; 

				$.ajax({
						 type: 'POST',
						 url: '/admin/member/lists',
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







