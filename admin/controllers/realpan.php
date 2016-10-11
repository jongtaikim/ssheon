<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Realpan extends CI_Controller {

	function __construct() {
		parent::__construct();

		$this->load->model(array('Realpanclass'));
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
		$this->load->view($this->type."/realpan/index" , $data);
	}

	function reindex() {
		$this->yield = false;
		$this->load->view($this->type."/realpan/reindex" , $data);
	}

	function lists() {
		$this->yield = false;

		$where = null ;
		$result = $this->Realpanclass->realpan_list( $where );

		$listNo = $total_record - $offset ;

		$loop = array();
		foreach ($result as $i=>$row) {
			$loop[] = $row;
			$listNo = $listNo - 1 ;
		}

		$data = array('loop'=>$loop );
		$this->load->view($this->type."/realpan/lists" , $data);
	}

	function relists() {
		$this->yield = false;

		$where = null ;
		$result = $this->Realpanclass->re_realpan_list( $where );

		$listNo = $total_record - $offset ;

		$loop = array();
		foreach ($result as $i=>$row) {
			$loop[] = $row;
			$listNo = $listNo - 1 ;
		}

		$data = array('loop'=>$loop );
		$this->load->view($this->type."/realpan/relists" , $data);
	}

	function modinsert() {

		$this->yield = false;
		/*
		echo "<pre>" ;
			print_r ( $_REQUEST ) ;
		echo "</pre>" ;
		*/
		if ( $this->param['seqidx'] ) :
			$row = $this->Realpanclass->realpan_view( $this->param['seqidx'] ) ;
			$modes =  'M' ;
			$modesname =  '수정' ;

		else:
			$modes =  'W' ;
			$modesname =  '저장' ;
		endif;

		$data = array( 'row'=>$row ,'mode'=>$modes ,'modesname'=>$modesname );

		$this->load->view($this->type."/realpan/writes" , $data);
	}

	function remodinsert() {

		$this->yield = false;
		/*
		echo "<pre>" ;
			print_r ( $_REQUEST ) ;
		echo "</pre>" ;
		*/
		if ( $this->param['seqidx'] ) :
			$row = $this->Realpanclass->re_realpan_view( $this->param['seqidx'] ) ;
			$modes =  'M' ;
		else:
			$modes =  'W' ;
		endif;

		$data = array( 'row'=>$row ,'mode'=>$modes );

		$this->load->view($this->type."/realpan/rewrites" , $data);
	}

	function redeltform() {
		$this->yield = false;

		$sqlQ1 ="DELETE FROM iiop_realpan_re where idx ='".$this->param['reidx']."'" ;
		mysql_query ( $sqlQ1 ) ;
		exit;
	}

	function rerealpan_act() {

		$this->yield = false;

		echo "<pre>" ;
			print_r ( $_REQUEST ) ;
		echo "</pre>" ;

		$input['name'] = $this->param['name'] ;
		$input['content'] = $this->param['content'] ;
		$input['sprinc'] = $this->param['sprinc'] ;
		$input['translate'] = $this->param['translate'] ;

		if ( $this->param['mode'] =='M' ) :
			$inout_no = $this->Realpanclass->re_update($input , $this->param['inout_no']);
		else:
			$input['regdate'] = date("Y-m-d H:i:s") ;
			$result = $this->Realpanclass->reinsert( $input );
		endif;

		exit;
	}

	function realpan_act( ) {
		$this->yield = false;

		echo "<pre>" ;
			print_r ( $_REQUEST ) ;
		echo "</pre>" ;

		$input['guestroom'] = $this->param['guestroom'] ;
		$input['rownumber'] = $this->param['rownumber'] ;
		$input['hinumber'] = $this->param['hinumber'] ;
		$input['periodofuse'] = $this->param['periodofuse'] ;
		$input['dweekday'] = $this->param['dweekday'] ;
		$input['dfriday'] = $this->param['dfriday'] ;
		$input['dweekend'] = $this->param['dweekend'] ;
		$input['aweekday'] = $this->param['aweekday'] ;
		$input['afriday'] = $this->param['afriday'] ;
		$input['aweekend'] = $this->param['aweekend'] ;
		$input['pweekday'] = $this->param['pweekday'] ;
		$input['pfriday'] = $this->param['pfriday'] ;
		$input['pweekend'] = $this->param['pweekend'] ;


		if ( $this->param['mode'] =='M' ) :
			$inout_no = $this->Realpanclass->update($input , $this->param['inout_no']);
		else:
			$input['regdate'] = date("Y-m-d H:i:s") ;
			$result = $this->Realpanclass->insert( $input );
		endif;
	}



}

 