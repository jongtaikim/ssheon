<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member extends CI_Controller {

	function __construct() {
		parent::__construct();

		$this->load->model(array('Usersclass'));
		//레이아웃 파일 설정
		$this->layout = 'default';
		$this->yield = true;
		$this->type = "admin" ;
		check_session();
		$this->left = 'left1' ;	
		
		$this->param = $this->input->post(NULL, true);

	}
	
	function index() {		
				
		$this->yield = true;
		$this->load->view($this->type."/member/index" , $data);				
	}

	function lists() {

		$this->yield = false;

		foreach( $_POST as $key => $val ) :
		$$key = $val  ;
		endforeach;
	
		$where = null ;
		$result = $this->Usersclass->bbs_list( $where  );
		
		$listNo = 1 ;
			
		$loop = array();
		foreach ($result as $i=>$row) {

			$row['listNo'] = $listNo;
			$loop[] = $row;
			$listNo++ ;
		}

		$data = array('loop'=>$loop , 'total_record'=>$total_record  );
		$this->load->view($this->type."/member/lists" , $data);				
	}

	function openpopup(){
		$this->yield = false;
		/*
		echo "<pre>" ;
		print_r ( $_REQUEST ) ;
		echo "</pre>" ;
		*/
		if ( $this->param['inout_no'] ) {
			$MODE =  'M' ;
			$row = $this->Usersclass->get_view( $this->param['inout_no'] ) ;		
		} else { 
			$MODE =  'W' ;
		}

		$data = array('row'=>$row ,'mode'=>$MODE  );
		if ( $MODE == "M" ) :
			$this->load->view($this->type."/member/edits" , $data);						
		else:
			$this->load->view($this->type."/member/writes" , $data);				
		endif;

	}

	function check_duplicate(){
		$this->yield = false;

		$total = $this->Usersclass->password_check( $this->param['value'] ) ;
		$json = null;
		$json['is_valid'] = $total;		
		echo json_encode( $json );
		exit;
	}

	function delete_all() {
		$this->yield = false;
		if ( $this->param['seqno'] ) :									
			$where = null;
			$where[] = "idx=".$this->param['seqno'];
			print_r ( $where ) ;
			$this->Usersclass->deletes($where);
		endif;
		exit;
	}

	function bbs_act() {

		$this->yield = false;

		$input['name'] =  $this->param['name'] ;	
		$input['passwd'] =  md5($this->param['password']) ;	
		$input['phone'] =  $this->param['phone'] ;	
		$input['emails'] =  $this->param['emails'] ;	

		if ( $this->param['mode'] == 'M' ) :	

			$this->Usersclass->update($input , $this->param['inout_no']);		
		else:
			$input['userid'] =  $this->param['user_id'] ;	
			$input['regdate'] = date("Y-m-d H:i:s") ;
			$input['br_ip'] =  $_SERVER[REMOTE_ADDR] ;			
			/*
			echo "<pre>" ;
			print_r ( $input ) ;
			echo "</pre>" ;
			*/
			$this->Usersclass->insert($input);		
		endif;

		exit;
	}

}

 