<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Calendar extends CI_Controller {

	function __construct() {
		parent::__construct();

		$this->load->model(array('Calendarclass'));
		//레이아웃 파일 설정
		$this->layout = 'default';
		$this->yield = true;
		$this->type = "admin" ;
		check_session();
		$this->left = 'left3' ;

		$this->param = $this->input->post(NULL, true);
	}

	function index() {
		$this->yield = true;
		$this->load->view($this->type."/calendar/index" , $data);
	}

	function lists() {
		$this->yield = false;

		foreach( $_POST as $key => $val ) :
		$$key = $val  ;
		endforeach;

		if ( $this->param['syear'] )  $year = $this->param['syear'] ;
		if ( $this->param['smos'] )  $month = $this->param['smos'] ;

		$time = strtotime($year.'-'.$month.'-01');
		$time2 = strtotime($year.'-'.$month.'-31');
		list($tday, $sweek) = explode('-', date('t-w', $time));  // 총 일수, 시작요일
		$tweek = ceil(($tday + $sweek) / 7);  // 총 주차
		$lweek = date('w', strtotime($year.'-'.$month.'-'.$tday));  // 마지막요일

        $varprice_row = $this->db->where('date >= ',date("Y-m-d",$time))->where('date <= ',date("Y-m-d",$time2))->get('iiop_varprice')->result_array();

        $i = 0;
        for($ii=0; $ii<count($varprice_row); $ii++) {
            if($varprice_row[$ii]['date']) {
                $vrow[$varprice_row[$ii]['date']]['name'] = $varprice_row[$ii]['price_name'];
                $vrow[$varprice_row[$ii]['date']]['price'] = $varprice_row[$ii]['price'];
                $i++;
            }
        }




		$caltemp = '
		<table class="table table-bordered table-list "   >
			<tr bgcolor="#f5f5f5">
				<th><font color=red>일</font></th>
				<th>월</th>
				<th>화</th>
				<th>수</th>
				<th>목</th>
				<th>금</th>
				<th><font color=blue>토</font></th>
			</tr>	
		' ;
		for ($n=1,$i=0; $i<$tweek; $i++):
		//	 	if ($tweek == 0  ) { $ncolor = "color:blue";  }
		$caltemp .= "<tr>" ;
		for ($k=0; $k<7; $k++):

			switch (  $k ) {
				case 6 :
					$ncolor = "blue";
					$ncolor = "";
				break ;
				case 0 :
					$ncolor = "red";
					$ncolor = "";
				break ;
				default :
					$ncolor = "";
				break;
			}

			$int = sprintf("%02d", $n);
			$radate = $year."-".$month."-".$int ;



            
//			echo $int ."<br>";
			$caltemp .=  '<td width="300" height="100">' ;
			if (($i == 0 && $k < $sweek) || ($i == $tweek-1 && $k > $lweek)) {
				$caltemp .=    "</td>";
				continue;
			}

			$tt = sprintf("%02d", $n++) ;
			$udate = $year."-".$month."-".$tt ;

                unset($varprinc);
                unset($varprincname);
                if($vrow[$udate]){
                    $varprinc =  $vrow[$udate]['price'] ;
                    $varprincname =  $vrow[$udate]['name'] ;
                }

				$sqlS =  "select * from iiop_realpan_cate where todate ='".$udate."'" ;
				$rsS = mysql_query ( $sqlS ) ;
				$rowS = mysql_fetch_array ( $rsS );

					if ( $rowS[tcate] == 'Y' ) :
						$tcodename = '예약완료' ;
						$ncolortt = "#a16e6e";
					elseif (  $rowS[tcate] == 'N'  ) :
						$tcodename = '입금대기중' ;
						$ncolortt = "#6e8aa1";
					else :
						$tcodename = '' ;
						$ncolortt = "";
					endif;


			if ( $rowS[idx] ) :
				$caltemp .= "<div style=text-align:left;cursor:pointer; onclick=InoutInList.openInput('".$rowS[idx]."') >" ;
			else:
				$caltemp .= "<div style=text-align:left;cursor:pointer;  >" ;
			endif;

				$caltemp .= $tt."<br>".$rowS['name']."<br><font color=".$ncolortt.">".$tcodename."</font><br>" ;
			$caltemp .= '</div>' ;
                
                if($varprinc) {
                    $caltemp .= '<div style="color:blue">';
                    $caltemp .= $varprincname;
                    $caltemp .= "<br>" . number_format($varprinc) . "원";
                    $caltemp .= '</div>';
                }

//			$caltemp .= $row['minetime'] ."<br>". $row['maxetime']."<br>". $n++ ;

			$caltemp .=   '</td>' ;

		endfor;
			$caltemp .=   '</tr>' ;
		endfor;

			$caltemp .=   '</table>' ;

		$data = array( "caltemp"=>$caltemp , "where"=>$where , "str_syear"=>$year , "str_smos"=>$month );

		$this->load->view($this->type."/calendar/lists" , $data);
	}

	function openpopup() {
		$this->yield = false;


			$sqlS =  "select * from iiop_realpan_cate where idx ='".$this->param['inout_no'] ."'" ;
			$rsS = mysql_query ( $sqlS ) ;
			$rowS = mysql_fetch_array ( $rsS );


			$data = array( "row"=>$rowS );

		$this->load->view($this->type."/calendar/openpopups" , $data);
	}

	function view_delete_all(){

		$this->yield = false;

		if ( $this->param['seqno'] ) {

			$sqlQ = "DELETE FROM `iiop_realpan_cate` where code='".$this->param['seqno']."'  " ;
			mysql_query ( $sqlQ ) ;
		}

		exit;
	}


	function vview_act() {

		$this->yield = false;

		$input['tcate'] = $this->param['str_tcode'];
		$this->Calendarclass->view_update($input , $this->param['tcode'] );
	}

	function userindex() {
		$this->yield = true;
		$this->load->view($this->type."/calendar/userindex" , $data);
	}


	function dateweeks( $srt_date , $end_date ) {

		// 하루에 타임 스테프 값을 선언한다.
		$oneDayTimeStamp = 86400;


		// 담을 배열을 선언한다.
		$dayList = array();

		// for문을 돌려 체크 하고 조건에 충족하면 배열에 돌린다.
		for ( $i = 0 ; strtotime($srt_date)+($oneDayTimeStamp*$i) < strtotime($end_date) ; $i++){
			$yyyyMMdd = date("Y-m-d",strtotime($srt_date)+($oneDayTimeStamp*$i));
			array_push($dayList, $yyyyMMdd);
		}

		return $dayList ;
	}

	//사용자
	function userlists() {
		$this->yield = false;

		foreach( $_POST as $key => $val ) :
		$$key = $val  ;
		endforeach;

		$this->param['syear'] = '2016' ;
		$this->param['smos'] = '06' ;

		if ( $this->param['syear'] )  $year = $this->param['syear'] ;
		if ( $this->param['smos'] )  $month = $this->param['smos'] ;

		$time = strtotime($year.'-'.$month.'-01');
		$time2 = strtotime($year.'-'.$month.'-31');
		list($tday, $sweek) = explode('-', date('t-w', $time));  // 총 일수, 시작요일
		$tweek = ceil(($tday + $sweek) / 7);  // 총 주차
		$lweek = date('w', strtotime($year.'-'.$month.'-'.$tday));  // 마지막요일

        $varprice_row = $this->db->where('date >= ',date("Y-m-d",$time))->where('date <= ',date("Y-m-d",$time2))->get('iiop_varprice')->result_array();

		$sqlR = " select * from iiop_realpan where idx=1 " ;
		$rsR = mysql_query ( $sqlR ) ;
		$rowR = mysql_fetch_array ( $rsR ) ;

		$caltemp = '
		<table class="table table-bordered table-list " style="width:1000px;"  >
			<tr bgcolor="#f5f5f5">
				<th><font color=red>일</font></th>
				<th>월</th>
				<th>화</th>
				<th>수</th>
				<th>목</th>
				<th>금</th>
				<th><font color=blue>토</font></th>
			</tr>	
		' ;
		for ($n=1,$i=0; $i<$tweek; $i++):
		//	 	if ($tweek == 0  ) { $ncolor = "color:blue";  }
		$caltemp .= "<tr>" ;
		for ($k=0; $k<7; $k++):

// 0월 1 2 3 4 금 5 토  6 일

			if ( $month == '04' || $month == '05' || $month == '09' || $month == '10') {
				switch ( $k ) {
					case 5 :
						$varprinc =  $rowR['afriday'] ;
					break ;
					case 6 :
						$varprinc =  $rowR['aweekend'] ;
					break ;
					case 0 :
						$varprinc =  $rowR['aweekend'] ;
					break ;
					default :
						$varprinc =  $rowR['aweekday'] ;
					break;
				}
			} else if ( $month == '07' || $month == '08' ) {
				switch ( $k ) {
					case 5 :
						$varprinc =  $rowR['pfriday'] ;
					break ;
					case 6 :
						$varprinc =  $rowR['pweekend'] ;
					break ;
					case 0 :
						$varprinc =  $rowR['pweekend'] ;
					break ;
					default :
						$varprinc =  $rowR['pweekday'] ;
					break;
				}
			} else {
				switch ( $k ) {
					case 5 :
						$varprinc =  $rowR['dfriday'] ;
					break ;
					case 6 :
						$varprinc =  $rowR['dweekend'] ;
					break ;
					case 0 :
						$varprinc =  $rowR['dweekend'] ;
					break ;
					default :
						$varprinc =  $rowR['dweekday'] ;
					break;
				}
			}

			switch (  $k ) {
				case 6 :
					$ncolor = "color:blue";
				break ;
				case 0 :
					$ncolor = "color:red";
				break ;
				default :
					$ncolor = "";
				break;
			}

			$int = sprintf("%02d", $n);
			$radate = $year."-".$month."-".$int ;

//			echo $int ."<br>";
			$caltemp .=  '<td width="300" height="100" style='.$ncolor.'>' ;
			if (($i == 0 && $k < $sweek) || ($i == $tweek-1 && $k > $lweek)) {
				$caltemp .=    "</td>";
				continue;
			}

			$tt = sprintf("%02d", $n++) ;
			$udate = $year."-".$month."-".$tt ;



                if($vrow[$udate]){
                    $varprinc =  $vrow[$udate]['price'] ;
                    $varprincname =  $vrow[$udate]['name'] ;
                }



				$sqlS =  "select * from iiop_realpan_cate where todate ='".$udate."'" ;
				$rsS = mysql_query ( $sqlS ) ;
				$rowS = mysql_fetch_array ( $rsS );

					if ( $rowS[tcate] == 'Y' ) :
						$tcodename = '예약완료' ;
					elseif (  $rowS[tcate] == 'N'  ) :
						$tcodename = '예약진행중' ;
					else :
						$tcodename = '' ;
					endif;

			if ( !$rowS[idx] ) :
				$caltemp .= "<div style=text-align:left;cursor:pointer; onclick=InoutInList.readlodeview('".$udate."',".$varprinc.") >" ;
			else:
				$caltemp .= "<div style=text-align:left;  >" ;
			endif;
				$caltemp .= $tt."<br><br>".number_format($varprinc)."원<br>".$tcodename."<br>";
				$caltemp .= $rowS['code']  ;


			$caltemp .= '</div>' ;
			$caltemp .= '<div>' ;

			$caltemp .= '</div>' ;

//			$caltemp .= $row['minetime'] ."<br>". $row['maxetime']."<br>". $n++ ;

			$caltemp .=   '<div>' ;
			$caltemp .=   $varprincname ;
			$caltemp .=   '</div>' ;
			$caltemp .=   '</td>' ;

		endfor;
			$caltemp .=   '</tr>' ;
		endfor;

			$caltemp .=   '</table>' ;

		$data = array( "caltemp"=>$caltemp , "where"=>$where );

		$this->load->view($this->type."/calendar/userlists" , $data);
	}


	function writepage() {
		$this->yield = false;


		echo "<pre>" ;
			print_r ( $_REQUEST ) ;
		echo "</pre>" ;

		$sqlR = " select * from iiop_realpan where idx=1 " ;
		$rsR = mysql_query ( $sqlR ) ;
		$row = mysql_fetch_array ( $rsR ) ;

		$row['todate'] = $this->param['temp1'] ;
		$row['uprinc'] = $this->param['temp2'] ;



		$result = $this->Calendarclass->re_bbs_list( $where );
		$loop = array();
		foreach ($result as $i=>$rowre) {
			$loop[] = $rowre;
		}

		$data = array( "row"=>$row , "loop"=>$loop );

		$this->load->view($this->type."/calendar/write" , $data);
	}

	function write_check() {

		$this->yield = false;

		/************************/
		$dayLists = $this->dateweeks ( $this->param['todate'] , $this->param['lastdate'] ) ;

		// 날짜리스트가 들어 있는 배열을 출력한다.
		$tempvar = " todate in (" ;

		foreach($dayLists as $value){
				$tempvar .= "'".$value."'," ;
		}
		$tempvar = substr($tempvar, 0, -1);
		$tempvar .= ") " ;


		/************************/

		$sqlQ = " select count(*) as total from iiop_realpan_cate WHERE ".$tempvar ;
		$rsQ = mysql_query ( $sqlQ ) ;
		$rowQ = mysql_fetch_array ( $rsQ ) ;

		if ( $rowQ['total'] == 0 ) :
			$is_valid = '1';
		else:
			$is_valid = '0';
		endif;
			$this->_call_json( $is_valid );
		exit;
	}

	function write_act() {

		$this->yield = false;

		/************************/
		$dayLists = $this->dateweeks ( $this->param['todate'] , $this->param['lastdate'] ) ;

		// 날짜리스트가 들어 있는 배열을 출력한다.
		$tempvar = " todate in (" ;

		foreach($dayLists as $value){
				$tempvar .= "'".$value."'," ;
		}
		$tempvar = substr($tempvar, 0, -1);
		$tempvar .= ") " ;

		/************************/

		$sqlQ = " select count(*) as total from iiop_realpan_cate WHERE ".$tempvar ;
		$rsQ = mysql_query ( $sqlQ ) ;
		$rowQ = mysql_fetch_array ( $rsQ ) ;

		if ( $rowQ['total'] == 0 ) :

			$row['todate'] = $this->param['todate'] ;
			$row['uprinc'] = $this->param['uprinc'] ;

			$row['lastdate'] = $this->param['lastdate'] ;
			$row['lastprinc'] = $this->param['lastprinc'] ;
			$row['totallastprinc'] = $this->param['totallastprinc'] ;
			$row['totalimsiprinc'] = $this->param['totalimsiprinc'] ;
			$row['imsiprinc0'] = $this->param['imsiprinc0'] ;
			$row['imsiprinc1'] = $this->param['imsiprinc1'] ;
			$row['imsiprinc2'] = $this->param['imsiprinc2'] ;
			$row['imsiprinc3'] = $this->param['imsiprinc3'] ;
			$row['imsiprinc4'] = $this->param['imsiprinc4'] ;
			$row['imsiprinc5'] = $this->param['imsiprinc5'] ;
			$row['imsiprinc6'] = $this->param['imsiprinc6'] ;
			$row['imsiprinc7'] = $this->param['imsiprinc7'] ;
			$row['imsiprinc8'] = $this->param['imsiprinc8'] ;
			$row['totalcnrkprinc'] = $this->param['totalcnrkprinc'] ;


			$row['guestroom'] = $this->param['guestroom'] ;
			$row['rownumber'] = $this->param['rownumber'] ;
			$row['seongin_val'] = $this->param['seongin_val'] ;
			$row['adong_val'] = $this->param['adong_val'] ;
			$row['yua_val'] = $this->param['yua_val'] ;
			$row['pperiodofuse'] = $this->param['pperiodofuse'] ;

			$hour_list = $minute_list = array();
			foreach(range(0,23) as $val) { $hour_list[] = str_pad($val, 2, '0', str_pad_left);}
			foreach(range(0,50,10) as $val) { $minute_list[] = str_pad($val, 2, '0', str_pad_left);}

		else:
			echo "Check" ;
			exit;
		endif;

		$data = array( "row"=>$row , "hour"=>$hour_list , "minute"=>$minute_list );
		$this->load->view($this->type."/calendar/write_back" , $data);
	}

	function calendar_act() {

		$this->yield = false;

		/*
		echo "<pre>" ;
		print_r ( $_REQUEST ) ;
		echo "</pre>" ;
		*/
		/************************/

		$dayLists = $this->dateweeks ( $this->param['todate'] , $this->param['lastdate'] ) ;

		// 날짜리스트가 들어 있는 배열을 출력한다.
		$tempvar = " todate in (" ;

		foreach($dayLists as $value){
				$tempvar .= "'".$value."'," ;
		}
		$tempvar = substr($tempvar, 0, -1);
		$tempvar .= ") " ;
		echo $tempvar ;

		echo "<br>" ;
		/************************/

		$sqlQ = " select count(*) as total from iiop_realpan_cate WHERE ".$tempvar ;
		echo $sqlQ ;
		$rsQ = mysql_query ( $sqlQ ) ;
		$rowQ = mysql_fetch_array ( $rsQ ) ;

		if ( $rowQ['total'] == 0 ) :

			$tcode = 'PEN'.date('His').str_pad(mt_rand(0,99),2,'0').str_pad(mt_rand(0,9999999),7,'0');

			foreach($dayLists as $value){
				$input['code'] = $tcode ;
				$input['todate'] = $value ;

				$input['lastdate'] = $this->param['lastdate'] ;
				$input['name'] = $this->param['name'] ;
				$input['phone'] = $this->param['phone'] ;
				$input['ptime'] = $this->param['hour_val'].":".$this->param['minute_val'] ;

				$input['totalprinc'] = $this->param['lastprinc'] ;
				$input['totalimsiprinc'] = $this->param['totalimsiprinc'] ;
				$input['totallastprinc'] = $this->param['totallastprinc'] ;
				$input['totalcnrkprinc'] = $this->param['totalcnrkprinc'] ;

				$inout_no = $this->Calendarclass->insert($input);
			}
			$is_valid = '1';
		else:
			$is_valid = '0';
		endif;

		$this->_call_json( $is_valid );
	}

	private function _call_json($is_valid) {
		$json = null;
		$json['is_valid'] = $is_valid;

		echo json_encode( $json );
	}


}

