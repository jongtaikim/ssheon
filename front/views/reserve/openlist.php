

<style>

#container2 #contents2 .confirm{ position:absolute; right:0;left:0; top:0; width:566px; height:470px; background-color:#fff; }
#container2 #contents2 .confirm .form{ background-color:#fff; padding:16px 46px 0 46px;}
#container2 #contents2 .confirm .form ul{ padding:20px 0 30px 0; border-bottom:1px solid #999;}
#container2 #contents2 .confirm .form ul li{ height:40px; vertical-align:middle;}
#container2 #contents2 .confirm .form ul li p{ width:130px;height:34px; text-align:right; float:left;vertical-align:middle; font-size:1.1em; padding:6px 10px 0 0;}
#container2 #contents2 .confirm .form ul li input{ border:1px solid #ccc; width:200px; height:28px;}
#container2 #contents2 .confirm .tit{ margin:76px 46px 0 46px; padding:0 0 16px 0; border-bottom:1px solid #333;}
#container2 #contents2 .confirm .form2{ padding:0 46px 0 46px;}
#container2 #contents2 .confirm .sero{height:38px; text-align:center; background-color:#eee; color:#333;}
#container2 #contents2 .confirm .form2 table{width:100%; border:1px solid #ccc;border-left:none; border-bottom:none}
#container2 #contents2 .confirm .form2 table td{border-left:1px solid #ccc; border-bottom:1px solid #ccc;height:38px; padding:0 10px 0 10px; }
#container2 #contents2 .confirm .button{height:32px; margin-top:14px; text-align:center;}
#container2 #contents2 .confirm .button button{height:32px; width:100px; color:#fff; background-color:#333; border:0; cursor:pointer}

</style>
    <div id="container2" style="margin:auto; position:relative;height:480px;">
        <div id="contents2">
			<form id="FrmOpenInputr" name="FrmOpenInputr"  method="post"  enctype="multipart/form-data">
			<div class="confirm">
                <div class="tit"><img src="<?=FRONT_IMG_DIR?>/sub/tt_reserve_01.jpg"></div>
                <div class="form">
                    <ul>
                        <li><p>예약자명</p><input type="text" name="names_p" id="names_p" class="userid validate[required]" ></li>
                        <li><p>예약자 연락처</p><input type="tel" name="phones_p" id="phones_p" data-mask="phones_p"  class="userid validate[required]" ></li>
                    </ul>
                </div>
                <div class="button"><button type="button" onclick="conforsave();" >예약확인</button> <button type="button" onclick="$('.modal-close').trigger('click');" >닫기</button></div>
            </div>
			</form>
        </div>
    </div> 



<script type="text/javascript">
<!--


	$(function() {
		$('input[data-mask="phones_p"]').mask('999-9999-9999');
	})

	function conforsave() {

		if ($("input[name=names_p]").val()==""){
			alert("이름을 입력해주세요");
			$("input[name=names_p]").focus();
			return false ;
		}	

		if ($("input[name=phones_p]").val()==""){
			alert("휴대폰번호를 입력해주세요");
			$("input[name=phones_p]").focus();
			return false ;
		}	


		var formdata = $('#FrmOpenInputr').serialize();
		$.ajax({
			url:'/front/reserve/reserve_check',
			data:formdata, 
			dataType:'html',
			type:'POST',
			success: function(r){	
				/*
				$("#contents2").html( r ) ;
				return;
				*/

				var obj = $.parseJSON(r);
				if (obj.is_valid == "SSS") {
					alert ( '정보가 없습니다.') ;
					return;
				} else {
					foremchecksave(obj.is_valid);
				}

			}
		})
	}
	
	function foremchecksave( seqno ){
		var seqno ;
		$.ajax({
			url:'/front/reserve/reserve_actok',
			data: { seqno: seqno },	
			dataType:'html',
			type:'POST',
			success: function(r){	
				$("#contents2").html( r ) ;
				return;

			}
		})

	}
//-->
</script>