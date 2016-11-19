<?php if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 *
 * @property CI_DB_active_record $db
 * @property CI_DB_forge $dbforge
 * @property CI_Benchmark $benchmark
 * @property CI_Calendar $calendar
 * @property CI_Cart $cart
 * @property CI_Config $config
 * @property CI_Controller $controller
 * @property CI_Email $email
 * @property CI_Encrypt $encrypt
 * @property CI_Exceptions $exceptions
 * @property CI_Form_validation $form_validation
 * @property CI_Ftp $ftp
 * @property CI_Hooks $hooks
 * @property CI_Image_lib $image_lib
 * @property CI_Input $input
 * @property CI_Language $language
 * @property CI_Loader $load
 * @property CI_Log $log
 * @property CI_Model $model
 * @property CI_Output $output
 * @property CI_Pagination $pagination
 * @property CI_Parser $parser
 * @property CI_Profiler $profiler
 * @property CI_Router $router
 * @property CI_Session $session
 * @property CI_Sha1 $sha1
 * @property CI_Table $table
 * @property CI_Trackback $trackback
 * @property CI_Typography $typography
 * @property CI_Unit_test $unit_test
 * @property CI_Upload $upload
 * @property CI_URI $uri
 * @property CI_User_agent $user_agent
 * @property CI_Validation $validation
 * @property CI_Xmlrpc $xmlrpc
 * @property CI_Xmlrpcs $xmlrpcs
 * @property CI_Zip $zip
 *
 * Add additional libraries you wish
 * to use in your controllers here
 *
 * @property Accounts_model $Accounts_model
 * @property auth $auth
 *
 */
class Reserve extends CI_Controller {
    
    var $layout_mobile='';
	
    function __construct() {
		parent::__construct();

		$this->load->model(array('../../admin/models/Calendarclass'));

		
		$this->param = $this->input->post(NULL, true);

        if(MobileCheck()){
            $this->yield = false;
            $this->layout_mobile = true;
        }else{
            $this->layout = 'maindefault';
            $this->type = "front";
        }
	}

	function index_old() {

        if( $this->layout_mobile){

            $this->load->library('Display');
            $this->display->setLayout('main');

            $this->display->define('CONTENT', $this->display->getTemplate('/index_old.html'));
            $content = $this->display->fetch('LAYOUT');
            echo $content;

        }else {
            $this->yield = true;

            $this->load->view($this->type . '/reserve/index_old.php', $data);

        }
	}

	function index() {

        if( $this->layout_mobile){

            $this->load->library('Display');
            $this->display->setLayout('main');

            $this->display->define('CONTENT', $this->display->getTemplate('/reserve/index.html'));
            $content = $this->display->fetch('LAYOUT');
            echo $content;

        }else {

            $this->yield = true;

            $this->load->view($this->type . '/reserve/index.php', $data);
        }
	}



	//사용자 
	function lists() {						
		$this->yield = false;

		foreach( $_POST as $key => $val ) :
		$$key = $val  ;
		endforeach;
		
		/*
		echo "<pre>" ;
			print_r  ( $_REQUEST ) ;
		echo "</pre>" ;
		*/

		if ( $this->param['str_year'] )  $year = $this->param['str_year'] ;
		if ( $this->param['str_month'] )  $month = $this->param['str_month'] ;



		$time = strtotime($year.'-'.$month.'-01');
		$time2 = strtotime($year.'-'.$month.'-31');
		list($tday, $sweek) = explode('-', date('t-w', $time));  // 총 일수, 시작요일
		$tweek = ceil(($tday + $sweek) / 7);  // 총 주차from
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




		$sqlR = " select * from iiop_realpan where year = '$year'  " ;

		$rsR = mysql_query ( $sqlR ) ;
		$rowR = mysql_fetch_array ( $rsR ) ;
		
		$caltemp = '
		<table  width="100%" border="0" cellpadding="0" cellspacing="0"  >
			<thead>
				<tr>
					<th class="sun">SUN</th>
					<th>MON</th>
					<th>TUE</th>
					<th>WED</th>
					<th>THU</th>
					<th>FRI</th>
					<th class="sat">SAT</th>
				</tr>
			</thead>
            <tbody>
		' ;		
		for ($n=1,$i=0; $i<$tweek; $i++):
		//	 	if ($tweek == 0  ) { $ncolor = "color:blue";  }
		$caltemp .= "<tr>" ; 
		for ($k=0; $k<7; $k++): 

// 0월 1 2 3 4 금 5 토  6 일
            

                $varprice_month = $this->db->where('year',$year)->where('month',$month)->get('iiop_varprice_month')->row_array();
                if($varprice_month) {
                    switch ($k) {
                        case 5 :
                            $varprinc = $varprice_month['price2'];
                            $varprincname = $varprice_month['price_name'] . "-금요일";
                            break;
                        case 6 :
                            $varprinc = $varprice_month['price2'];
                            $varprincname = $varprice_month['price_name'] . "-주말";

                            break;
                        case 0 :
                            $varprinc = $varprice_month['price'];
                            $varprincname = $varprice_month['price_name'] . "-평일";
                            break;
                        default :
                            $varprinc = $varprice_month['price'];
                            $varprincname = $varprice_month['price_name'] . "-평일";
                            break;
                    }
                }else{

                    if ($month == '04' || $month == '05' || $month == '09' || $month == '10') {
                        switch ($k) {
                            case 5 :
                                $varprinc = $rowR['afriday'];
                                $varprincname = "준성수기-금요일";
                                break;
                            case 6 :
                                $varprinc = $rowR['aweekend'];
                                $varprincname = "준성수기-주말";
                                break;
                            case 0 :
                                $varprinc = $rowR['aweekday'];
                                $varprincname = "준성수기-평일";
                                break;
                            default :
                                $varprinc = $rowR['aweekday'];
                                $varprincname = "준성수기-평일";
                                break;
                        }
                    } else if ($month == '07' || $month == '08') {
                        switch ($k) {
                            case 5 :
                                $varprinc = $rowR['pfriday'];
                                $varprincname = "성수기-금요일";
                                break;
                            case 6 :
                                $varprinc = $rowR['pweekend'];
                                $varprincname = "성수기-주말";
                                break;
                            case 0 :
                                $varprinc = $rowR['pweekday'];
                                $varprincname = "성수기-평일";
                                break;
                            default :
                                $varprinc = $rowR['pweekday'];
                                $varprincname = "성수기-평일";
                                break;
                        }
                    } else {
                        switch ($k) {
                            case 5 :
                                $varprinc = $rowR['dfriday'];
                                $varprincname = "비수기-금요일";
                                break;
                            case 6 :
                                $varprinc = $rowR['dweekend'];
                                $varprincname = "비수기-주말";
                                break;
                            case 0 :
                                $varprinc = $rowR['dweekday'];
                                $varprincname = "비수기-평일";
                                break;
                            default :
                                $varprinc = $rowR['dweekday'];
                                $varprincname = "비수기-평일";
                                break;
                        }
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
			$caltemp .=  '<td>' ;
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

				$caltemp .= '<div class="day">'.$tt.'</div>';
				if ( !$rowS[idx] ) :								
					$caltemp .= '<div>'.$varprincname.'<br>'.number_format($varprinc).'원<br>';
					$caltemp .= "<button type='button' onclick=InoutInList.readlodeview('".$udate."',".$varprinc.")>예약가능</button>";
				else:
						if ( $rowS[tcate] == 'N' ){
							$caltemp .= '<div class="wait">입금대기</div>';					
						} else if ( $rowS[tcate] == 'Y' ) {
							$caltemp .= '<div class="finish">예약완료</div>';							
						}
				endif; 

				$caltemp .= '</div>';

						
//			$caltemp .= $row['minetime'] ."<br>". $row['maxetime']."<br>". $n++ ;
	
			$caltemp .=   '</td>' ; 
				
		endfor;		 
			$caltemp .=   '</tr>' ;				 
		endfor;
			
			$caltemp .=   '</tbody>' ;						
			$caltemp .=   '</table>' ;		

		$data = array( "caltemp"=>$caltemp , "where"=>$where );

		$this->load->view($this->type."/reserve/lists" , $data);				
	}

	function writepage()
    {
        $this->yield = false;

        $sqlR = " select * from iiop_realpan where idx=1 ";
        $rsR = mysql_query($sqlR);
        $row = mysql_fetch_array($rsR);

        $row['todate'] = $this->param['temp1'];
        $row['uprinc'] = $this->param['temp2'];

        $result = $this->Calendarclass->re_bbs_list($where);
        $loop = array();
        foreach ($result as $i => $rowre) {
            $loop[] = $rowre;
        }


        $data = array("row" => $row, "loop" => $loop);

        if ($this->layout_mobile) {

            $this->load->library('Display');

            $this->display->assign($data);
            $this->display->define('CONTENT', $this->display->getTemplate('/reserve/write.html'));
            $content = $this->display->fetch('CONTENT');
            echo $content;

        } else {
            $this->load->view($this->type . "/reserve/write", $data);

        }
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

			$row['imsival0'] = $this->param['imsival0'] ;
			$row['imsival1'] = $this->param['imsival1'] ;
			$row['imsival2'] = $this->param['imsival2'] ;
			$row['imsival3'] = $this->param['imsival3'] ;
			$row['imsival4'] = $this->param['imsival4'] ;
			$row['imsival5'] = $this->param['imsival5'] ;
			$row['imsival6'] = $this->param['imsival6'] ;
			$row['imsival7'] = $this->param['imsival7'] ;
			$row['imsival8'] = $this->param['imsival8'] ;

			$row['guestroom'] = $this->param['guestroom'] ;
			$row['rownumber'] = $this->param['rownumber'] ;
			$row['seongin_val'] = $this->param['seongin_val'] ;
			$row['adong_val'] = $this->param['adong_val'] ;
			$row['yua_val'] = $this->param['yua_val'] ;
			$row['pperiodofuse'] = $this->param['pperiodofuse'] ;


			if ( $this->param['imsival0'] != 0||0 || $this->param['imsival0'] != '' ) :
				$imsivalue = explode ( "||", $this->param['imsival0'] ) ;
				$imsi[] = $imsivalue[1] ;				
			endif;
			if ( $this->param['imsival1'] != 0||0 || $this->param['imsival1'] != '' ) :
				$imsivalue1 = explode ( "||", $this->param['imsival1'] ) ;
				$imsi[] = $imsivalue1[1]  ;				
			endif;
			if ( $this->param['imsival2'] != 0||0 || $this->param['imsival2'] != '' ) :
				$imsivalue2 = explode ( "||", $this->param['imsival2'] ) ;
				$imsi[] = $imsivalue2[1] ;				
			endif;
			if ( $this->param['imsival3'] != 0||0 || $this->param['imsival3'] != '' ) :
				$imsivalue3 = explode ( "||", $this->param['imsival3'] ) ;
				$imsi[] = $imsivalue3[1] ;				
			endif;
			if ( $this->param['imsival4'] != 0||0 || $this->param['imsival4'] != '' ) :
				$imsivalue4 = explode ( "||", $this->param['imsival4'] ) ;
				$imsi[] = $imsivalue4[1] ;				
			endif;
			if ( $this->param['imsival5'] != 0||0 || $this->param['imsival5'] != '' ) :
				$imsivalue5 = explode ( "||", $this->param['imsival5'] ) ;
				$imsi[] = $imsivalue5[1] ;				
			endif;
			if ( $this->param['imsival6'] != 0||0 || $this->param['imsival6'] != '' ) :
				$imsivalue6 = explode ( "||", $this->param['imsival6'] ) ;
				$imsi[] = $imsivalue6[1] ;				
			endif;

			if ( $this->param['imsival7'] != 0||0 || $this->param['imsival7'] != '' ) :
				$imsivalue7 = explode ( "||", $this->param['imsival7'] ) ;
				$imsi[] = $imsivalue7[1] ;				
			endif;

			if ( $this->param['imsival8'] != 0||0 || $this->param['imsival8'] != '' ) :
				$imsivalue8 = explode ( "||", $this->param['imsival8'] ) ;
				$imsi[] = $imsivalue8[1] ;				
			endif;

			
//			print_r ( $imsi ) ;
			$row['imsi_separated'] = implode(",", $imsi);

			$hour_list = $minute_list = array();
			foreach(range(0,23) as $val) { $hour_list[] = str_pad($val, 2, '0', str_pad_left);}
			foreach(range(0,50,10) as $val) { $minute_list[] = str_pad($val, 2, '0', str_pad_left);}

		else:
			echo "Check" ;
			exit;
		endif;

		$data = array( "row"=>$row , "hour"=>$hour_list , "minute"=>$minute_list );

        if ($this->layout_mobile) {

            $this->load->library('Display');

            $this->display->assign($data);
            $this->display->define('CONTENT', $this->display->getTemplate('/reserve/write_back.html'));
            $content = $this->display->fetch('CONTENT');
            echo $content;

        } else {
            $this->load->view($this->type . "/reserve/write_back", $data);
        }
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
				$input['ptime'] = $this->param['ptime'] ;
				$input['totalprinc'] = $this->param['lastprinc'] ;
				$input['totalimsiprinc'] = $this->param['totalimsiprinc'] ;
				$input['totallastprinc'] = $this->param['totallastprinc'] ;
				$input['totalcnrkprinc'] = $this->param['totalcnrkprinc'] ;

				$input['seongin_val'] = $this->param['seongin_val'] ;
				$input['adong_val'] = $this->param['adong_val'] ;
				$input['yua_val'] = $this->param['yua_val'] ;
				$input['imsitext'] = $this->param['imsitext'] ;
				$input['regdate'] = date("Y-m-d H:i:s") ;	

				$inout_no = $this->Calendarclass->insert($input);	
			}
			$is_valid = '1';
		else:
			$is_valid = '0';			
		endif;	

		$this->_call_json( $is_valid );
	}


	function openlist_ser() {
		$this->yield = false;
		$this->load->view($this->type."/reserve/openlist" , $data);			
	}

	function reserve_check( ) {
		$this->yield = false;


			$sqlS =  "select * from iiop_realpan_cate where name ='".$this->param['names_p']."' AND phone ='".$this->param['phones_p']."' group by code " ;

			$rsS = mysql_query ( $sqlS ) ;
			$rowS = mysql_fetch_array ( $rsS );

			if ( $rowS['idx'] ) :
				$is_valid = $rowS['idx'] ;
			else:
				$is_valid = 'SSS';
			endif;

			$this->_call_json( $is_valid );
			exit;
	}

	function reserve_actok( ) {
		$this->yield = false;

		$sqlS =  "select * from iiop_realpan_cate where idx ='".$this->param['seqno'] ."'" ;
		$rsS = mysql_query ( $sqlS ) ;
		$rowS = mysql_fetch_array ( $rsS );

		$data = array( "row"=>$rowS );		

		$this->load->view($this->type."/reserve/openview" , $data);			
	}

	private function _call_json($is_valid) {
		$json = null;
		$json['is_valid'] = $is_valid;
		
		echo json_encode( $json );
	}


	function view_delete_all(){

		$this->yield = false;

		if ( $this->param['seqno'] ) {

			$sqlQ = "DELETE FROM `iiop_realpan_cate` where code='".$this->param['seqno']."'  " ;
			mysql_query ( $sqlQ ) ;
		}
			
		exit;
	}
    
    function day_plus($sdate,$pday){
        //echo $sdate."/".$pday;

        $json['totaldate'] = date("Y-m-d",strtotime($sdate."+".$pday."days"));
        echo json_encode($json);
        exit;
    }
}
