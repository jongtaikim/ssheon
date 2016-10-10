<?php if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Main extends CI_Controller {

	function __construct() {
		parent::__construct();

		$this->layout = 'maindefault';
		$this->type = "front";
	}

	function index() {		
	
		$this->yield = true;	
		$this->load->view($this->type.'/index.html', $data);
	}

	function index_old() {		
	
		$this->yield = false;	
		$this->load->view($this->type.'/index2.html', $data);
	}

	function faq() {		
		$this->yield = true;	
		$this->load->view($this->type.'/bbs/faq', $data);
	}



}
