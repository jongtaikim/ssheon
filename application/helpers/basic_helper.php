<?php
	@Header('Content-Type: text/html; charset=UTF-8'); 
	function printr ( $val ) {

		echo "<pre>" ;
		print_r ( $val ) ;
		echo "</pre>" ;
		
		return ;
	}
	
	function set_special_char($str, $char) {
		if (trim( $str ) == "") return $char;
		else return $str;
	}
	
	/*-----------------------------------------------------------------------
	 | SELECT 박스 만들기
	------------------------------------------------------------------------*/
	function make_select($select_array, $name, $selected="", $event="", $class="", $id="") {
	
		if(!$id)
		{
			$id = $name ;
		}
	
		$viewSelect = "<select name='".$name."' id='".$id."' class='".$class."' ".$event.">" ;
		$viewSelect .= "<option value=''>선택</opiton>" ;
	
	
		if(is_array($select_array))
		{
			foreach($select_array as $key=>$value)
			{
				if ($selected == $key)
				{
					$sel = "selected" ;
				}
				else
				{
					$sel = "" ;
				}
				$viewSelect .= "<option value='".$key."' ".$sel.">".$value."</option>" ;
			}
		}
		$viewSelect .= "</select>" ;
	
		return $viewSelect ;
	}
	
	/*####################################
	에러 메시지 띄우기
	인수1 - 메세지, 인수2 - 방식, 인수3 - 주소
	#####################################*/
	function alertMove($msg,$target,$url='')
	{
		echo "<script type='text/javascript'>";
		if($msg!="") echo "alert('$msg');";
		if($target == "back")
		{
			echo "history.back();";
		}
		else if($target=="href")
		{
			echo "location.href='$url';";
		}
		else if($target=="replace")
		{
			echo "location.href='$url';";

		}
		else if($target=="top.replace")
		{
			echo "top.location.replace='$url';";
		}
		echo "</script>";
		
		if($target == "href2")
		{
			echo "<meta http-equiv='refresh' content='0; url=".$url."'>";
		}
		exit;
	}

	function set_encodes($pwd) {
		$tmp = $pwd;
		$data = "";
		$tmp1 = "";
		$tmp2 = "";
		$Dcdata = "L/Q~W`!@dO#$%e^P&f*G(lN)b_-hY+8=Mw4|Zgc<a>J?I[2{C]6}0i,AF.;p:BVu";
		$pdata = "1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_-";
		$dedata = "";
		for($i = 0; $i < strlen( $tmp ); $i ++) {
			$tmp1 = substr( $tmp, $i, 1 );
			for($k = 0; $k < 64; $k ++) {
				$tmp2 = substr( $pdata, $k, 1 );
				if ($tmp1 == $tmp2) $dedata = $dedata . substr( $Dcdata, $k, 1 );
			}
		}
	
		return $dedata;
	}
	
	/*
	 * 암호화된 스트링을 해독하여 리턴
	*/
	function set_decodes($pwd) {
		$tmp = $pwd;
		$tmp1 = "";
		$tmp2 = "";
		$endata = "";
		$Dcdata = "L/Q~W`!@dO#$%e^P&f*G(lN)b_-hY+8=Mw4|Zgc<a>J?I[2{C]6}0i,AF.;p:BVu";
		$pdata = "1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_-";
		$endata = "";
		for($i = 0; $i < strlen( $tmp ); $i ++) {
			$tmp1 = substr( $tmp, $i, 1 );
			for($k = 0; $k < 64; $k ++) {
				$tmp2 = substr( $Dcdata, $k, 1 );
				if ($tmp1 == $tmp2) $endata = $endata . substr( $pdata, $k, 1 );
			}
		}
		return $endata;
	}	
	
	function check_session() {
		$CI =& get_instance();

		if ($CI->session->userdata('ss_user_id') == "") {
			$redirect_url = $CI->config->item('base_url')."/admin/login";
			alertMove('로그인 해주세요.','href',$redirect_url);

		}
	}
	
	function check_session_front() {
		$CI =& get_instance();

		if ($CI->session->userdata('fr_user_id') == "") {
			$redirect_url = $CI->config->item('base_url')."/front/join/login";
			alertMove('로그인 해주세요.','href',$redirect_url);
		}
	}
	
	function mob_check_session_front() {
		$CI =& get_instance();

		if ($CI->session->userdata('fr_user_id') == "") {
			alertMove('로그인 해주세요.','href','/fronts/login/index');
		}
	}

	function check_level_val (  ){ 
		$CI =& get_instance();		

		$levelval = $CI->session->userdata('fr_level') ;

		if ( $levelval =="user" ) {
			$vals = "U" ;
		} else if ( in_array($levelval, array( "affiliate" , "merchant", "manager", "administrator" ))  ) {
			$vals = "S" ;
		} else {
			$vals = "G" ;			
		}
	
		return $vals ;
	}
	/**
	 * HTTP의 URL을 "/"를 Delimiter로 사용하여 배열로 바꾸어 리턴한다.
	 *
	 * @param	string	대상이 되는 문자열
	 * @return	string[]
	 */
	function segment_explode($seg)
	{
		//세크먼트 앞뒤 '/' 제거후 uri를 배열로 반환
		$len = strlen($seg);
		if(substr($seg, 0, 1) == '/')
		{
			$seg = substr($seg, 1, $len);
		}
		$len = strlen($seg);
	
		if(substr($seg, -1) == '/')
		{
			$seg = substr($seg, 0, $len-1);
		}
		$seg_exp = explode("/", $seg);
	
		return $seg_exp;
	}
	
	/**
	 * url중 키값을 구분하여 값을 가져오도록.
	 *
	 * @param Array $url : segment_explode 한 url값
	 * @param String $key : 가져오려는 값의 key
	 * @return String $url[$k] : 리턴값
	 */
	function url_explode($url, $key)
	{
		$cnt = count($url);
		for($i=0; $cnt>$i; $i++ )
		{
			if($url[$i] ==$key)
			{
				$k = $i+1;
				return $url[$k];
			}
		}
	}	

	function isMobile() {
		return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
	}


	function sub_string($string,$start,$length,$charset=NULL) {     
	if($charset==NULL) {
			$charset='UTF-8';
		  }
	/* 정확한 문자열의 길이를 계산하기 위해, mb_strlen 함수를 이용 */
		   $str_len=mb_strlen($string,'UTF-8'); 
		   if($str_len>$length) {   
	 /* mb_substr  PHP 4.0 이상, iconv_substr PHP 5.0 이상 */
			$string=mb_substr($string,$start,$length,'UTF-8');   
			$string.="..";
			}         
			  return $string;             
		}



?>