<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct() {
		parent::__construct();

		$this->load->model(array('Logincheck'));

		//레이아웃 파일 설정
		$this->layout = 'default';
		$this->yield = false;

//		$this->output->enable_profiler(false) ;		
	}

	function index() {
		$this->load->view("admin/login/index.php" );
	}
	
	function login_process() {
							
		$where = null ;
		$where[] = "userid ='".$_POST['user_id']."'" ;
		$where[] = "passwd ='".md5($_POST['passwd'])."'" ;

		$total = $this->Logincheck->bbs_total( $where );

		if  ( $total > 0 ) :
		
			$row = $this->Logincheck->get_view( $where ) ;

			$data = array (
					'ss_seq'=>$row['idx'],				
					'ss_user_id'=>$row['userid'],
					'ss_name'=>$row['name'],
					'logged_in'=>TRUE
			);
							
			$this->session->set_userdata( $data );
			
				$input['br_ip'] = $_SERVER[REMOTE_ADDR] ;
				$input['last_login'] = date("Y-m-d H:i:s")  ;													
				$userid = $row['userid'] ;
				
				$this->Logincheck->update(  $input , $userid ) ;			
			
			$is_useremail_valid = $row['userid'];					
			$is_valid = '1';					
		else :
			$is_valid = '0';
		endif;		

		$this->_call_json( $is_valid , $is_useremail_valid );
	}

	private function _call_json($is_valid , $is_useremail_valid) {
		$json = null;
		$json['is_valid'] = $is_valid;
		$json['is_useremail_valid'] = $is_useremail_valid;
		
		echo json_encode( $json );
	}

	function logout() {
		$this->session->sess_destroy();
		alertMove ('',"replace","/admin/login") ;		
	}	

}