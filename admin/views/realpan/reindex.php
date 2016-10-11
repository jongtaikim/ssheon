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
	<div id="title-area">부대시설 관리</div>	
	
		<!-- Contents -->
		<div id="Contents" style="width:1300px;">
		
			<!-- -->
			<form id="ReFrmInsert" name="ReFrmInsert" onsubmit='return false;'>
			<table class="table table-bordered table-form">
				<colgroup>
					<col width="120px">
					<col>
					<col width="120px">
					<col>
				</colgroup>
				<tbody>

				</tbody>
			</table>
			</form>


			<!-- -->			
			<div id="research_lists"></div>
			<div id="asdadadaaaaaa"></div>
		</div>
		<!-- Contents -->

		<div id="showdatevie"></div>
		<script type="text/javascript">
		var InoutReInList = {
			page:1,
			init: function() {
				InoutReInList.relodeindex();
			},
			reload : function() {
				this.load(this.page);
			},
			reopenexlInput: function(seqidx) {
				var title = (seqidx)?'객실 관리':'객실 관리';
				var modal = new HmisModal('inout_input', {width:850, top:200});
				modal.open(title,'/admin/realpan/remodinsert',{seqidx:seqidx});
			},
			redeletes: function( reidx ) {
				if(!confirm('삭제 하시겠습니까?')) return false;
				var me = this;
				var formdata = "&reidx="+reidx ;
				$.ajax({
					url:'/admin/realpan/redeltform',
					data:formdata, 
					dataType:'html',
					type:'POST',
					success: function(r){
						alert ( "완료" ) ;
						InoutReInList.relodeindex();
					}

				})
			},
			relodeindex: function() {

//				var pageNo = ( pageNo ? pageNo : 1) ;  
//				var _data = $('#FrmAttendanceSearch').serialize()+"&page="+pageNo ; 

				$.ajax({
						 type: 'POST',
						 url: '/admin/realpan/relists',
						 dataType : "html", //전송받을 데이터의 타입
						 success : function(jsondata) {
							$('#research_lists').html(jsondata) ;
						}
				 });
			}
		}

		$(function() {
			InoutReInList.init();
		})
		</script>


