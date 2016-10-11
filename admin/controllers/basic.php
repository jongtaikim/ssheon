<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Basic extends CI_Controller {

	function __construct() {
		parent::__construct();

		$this->load->model(array('Usersclass'));
		//레이아웃 파일 설정
		$this->layout = 'default';
		$this->yield = true;
		$this->type = "admin" ;
		check_session();
//		$this->left = 'left1' ;	
		
		$this->param = $this->input->post(NULL, true);

	}

	
	function index() {						
		$this->yield = true;
		$this->load->view($this->type."/Basic/index" , $data);				
	}

	
	function common() {						
		$this->yield = true;
		$this->load->view($this->type."/Basic/common" , $data);				
	}

	function passwd() {						
		$this->yield = true;
		$this->load->view($this->type."/Basic/passwd" , $data);				
	}

	function pra() {						
		$this->yield = true;
		$this->load->view($this->type."/Basic/pra" , $data);				
	}

	function popup() {						
		$this->yield = true;
		$this->load->view($this->type."/Basic/popup" , $data);				
	}

	function tests() {
		$this->yield = false;
		echo "<pre>" ;
			print_r ( $_SERVER ) ;
		echo "</pre>" ;
		$loop['conntent'] = "aaa123123" ;
		$this->template_->define("test", "admin/views/basic/test.php");
		$this->template_->assign('rows', $loop); 
		$this->template_->print_("test");

		exit;


	}

	

}

 