<?php if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Sub extends CI_Controller {

	function __construct() {
		parent::__construct();

		$this->layout = 'maindefault';
		$this->type = "front";
	}


	function bbq() {		
		$this->yield = true;	
		$this->load->view($this->type.'/sub/bbq', $data);
	}

	function campfire() {		
		$this->yield = true;	
		$this->load->view($this->type.'/sub/campfire', $data);
	}

	function outdoor() {		
		$this->yield = true;	
		$this->load->view($this->type.'/sub/outdoor', $data);
	}


	function presentation() {		
		$this->yield = true;	
		$this->load->view($this->type.'/sub/presentation', $data);
	}


	function extarior() {		
		$this->yield = true;	
		$this->load->view($this->type.'/sub/extarior', $data);
	}

	function extarior_ss() {		
		$this->yield = false;	
		$this->load->view($this->type.'/sub/extarior_ss', $data);
	}



	function location() {		
		$this->yield = true;	
		$this->load->view($this->type.'/sub/location', $data);
	}


	function reserve() {		
		$this->yield = true;	
		$this->load->view($this->type.'/sub/reserve', $data);
	}



	function guide() {		
		$this->yield = true;	
		$this->load->view($this->type.'/sub/guide', $data);
	}

	function room() {		
		$this->yield = true;	
		$this->load->view($this->type.'/sub/room', $data);
	}


	function room_ss() {		
		$this->yield = false;	
		$this->load->view($this->type.'/sub/room_ss', $data);
	}


	function ssheon() {		
		$this->yield = true;	
		$this->load->view($this->type.'/sub/ssheon', $data);
	}

	function tea() {		
		$this->yield = true;	
		$this->load->view($this->type.'/sub/tea', $data);
	}


}
