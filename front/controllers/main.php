<?php if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Main extends CI_Controller {

    var $layout_mode = "";
	function __construct() {
		parent::__construct();
        
        if(MobileCheck()){
            $this->yield = false;
            $this->layout_mobile = true;
        }else{
            $this->layout = 'maindefault';
            $this->type = "front";
        }
	}

	function index() {


        if( $this->layout_mobile){

            $this->load->library('Display');
            $this->display->setLayout('main');
            $this->display->assign('MAIN',true);
          
            $this->display->define('CONTENT', $this->display->getTemplate('/index.html'));
            $content = $this->display->fetch('LAYOUT');
           echo $content;

        }else{
            $this->yield = true;
            $data['main'] = true;
            $this->load->view($this->type.'/index.html', $data);
        }

	}
    
    function doc($page_name=''){
        if( $this->layout_mobile){

            $this->load->library('Display');
            $this->display->setLayout('main');

            $this->display->define('CONTENT', $this->display->getTemplate('/'.$page_name.'.html'));
            $content = $this->display->fetch('LAYOUT');
            echo $content;

        }
    }

	function index_old() {

		$this->yield = false;
		$this->load->view($this->type.'/index2.html', $data);
	}

	function faq() {

        if( $this->layout_mobile){
            $this->yield = false;
            $this->load->library('Display');
            $this->display->setLayout('main');
          

            $this->display->define('CONTENT', $this->display->getTemplate('/faq.html'));
            $content = $this->display->fetch('LAYOUT');
            echo $content;

        }else {
            $this->yield = true;
            $this->load->view($this->type . '/bbs/faq', $data);
        }
	}



}
