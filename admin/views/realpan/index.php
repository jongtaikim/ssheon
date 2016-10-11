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
	<div id="title-area">객실 관리</div>	
	
		<!-- Contents -->
		<div id="Contents" style="width:1300px;">
		
			<form id="FrmAttendanceSearch"  onsubmit='return false;'>

			</form>

			<!-- -->			
			<div id="search_result"></div>
			<div id="research_result"></div>

		</div>
		<!-- Contents -->

		<script type="text/javascript" src="<?=ADMIN_JS_DIR?>/jquery.MultiFile.pack.js"></script>
		<script type="text/javascript" src="<?=ADMIN_JS_DIR?>/jquery.form.js"></script>

		<script type="text/javascript">
		var InoutInList = {
			page:1,
			init: function() {
				InoutInList.lodeindex();
				InoutInList.relodeindex();
			},
			openexlInput: function(seqidx) {

				var title = (seqidx)?'객실 관리':'객실 관리';
				var modal = new HmisModal('inout_input', {width:850, top:200});
				modal.open(title,'/admin/realpan/modinsert',{seqidx:seqidx});
			},
			reload : function() {
				this.load(this.page);
			},
			relodeindex: function() {

				var _data = $('#FrmAttendanceSearch').serialize() ; 

				$.ajax({
						 type: 'POST',
						 url: '/admin/realpan/reindex',
						 data : _data,
						 dataType : "html", //전송받을 데이터의 타입
						 success : function(jsondata) {
							$('#research_result').html(jsondata) ;
						}
				 });
			},
			lodeindex: function(pageNo) {

				var pageNo = ( pageNo ? pageNo : 1) ;  
				var _data = $('#FrmAttendanceSearch').serialize()+"&page="+pageNo ; 

				$.ajax({
						 type: 'POST',
						 url: '/admin/realpan/lists',
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


