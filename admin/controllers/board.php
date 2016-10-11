<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Board extends CI_Controller {

	function __construct() {
		parent::__construct();

		$this->load->model(array('Boardclass'));
		//레이아웃 파일 설정
		$this->layout = 'default';
		$this->yield = true;
		$this->type = "admin" ;
		check_session();
		$this->left = 'left2' ;	
		
		$this->param = $this->input->post(NULL, true);
		$this->getparam = $this->input->get(NULL, true);
	}
	
	//헤더, 푸터 자동삽입
	public function _remap($method)
	{
		/*
		echo "<pre>" ;
		print_r ( $_REQUEST ) ;
		echo "</pre>" ;
		*/	
//		echo $this->param['title'] ;
		$page = ( $this->getparam['page'] ? $this->getparam['page'] : 1 ) ;
		$data = array('method'=>$method , 'page'=>$page , 'title'=>$this->param['title']  );

		$this->load->view($this->type.'/board/top.php', $data);

		if( method_exists($this, $method) )
		{
			$this->{"{$method}"}();
		}

		$this->load->view($this->type.'/board/bottom.php', $data);
	}

	function lists() {						

		$this->yield = true;		

//		echo $this->param['title'] ;
		/*
		echo "<font color=blue>" ;
		echo "<pre>" ;
			print_r ( $_REQUEST ) ;
		echo "</pre>" ;
		echo "</font>" ;
		*/

//		echo $this->uri->segment(4) ;

//		echo $this->getparam['page'] ;
		$where = null ;
		$where[] = "code = '".$this->uri->segment(4)."' " ;
//		$where[] = "notice = 'N' " ;
		if ( $this->getparam['title'] != "" ) :
			$where[] = "title like '%".$this->getparam['title']."%' " ;		
		endif;
		
//		print_r ( $where) ;

//		$page = $this->input->post('page');
		$page = ( $this->getparam['page'] ? $this->getparam['page'] : 1 ) ;

		$limit = ($this->input->post('limit'))?$this->input->post('limit'):13;
		$offset = ($page-1)*$limit;

		$total_record = $this->Boardclass->bbs_total( $where );				
		$result = $this->Boardclass->bbs_list( $where , $offset , $limit );
		
		$listNo = $total_record - $offset ;
			
		$loop = array();
		foreach ($result as $i=>$row) {
			$row['listNo'] = $listNo ;
			$loop[] = $row;
			$listNo = $listNo - 1 ;
		}

		/// notice
		$whereno = null ;
		$whereno[] = "code = '".$this->uri->segment(4)."' " ;
		$whereno[] = "notice = 'Y' " ;
		$resultno = $this->Boardclass->bbs_list( $whereno );

		$loopno = array();
		foreach ( $resultno as $i=>$rowno ) {
			$loopno[] = $rowno;
		}

		//페이징
		$paging_config = array(
				'total'=>$total_record,
				'block_size'=>10,
				'list_size'=>$limit,
				'page_current'=>$page
		);

		$this->load->library('Pagination_lib', $paging_config, 'pagination');
		$paging = $this->pagination->getPageSet();

		$data = array('loop'=>$loop,'loopno'=>$loopno,'total_record'=>$total_record,'paging'=>$paging,'page'=>$page,'title'=>$this->getparam['title'] );
		$this->load->view($this->type."/board/lists" , $data);				
	}

	function v() {
		$this->yield = true;	
		$row = $this->Boardclass->get_view( $this->getparam['idx'] ) ;			
		// 파일
		$settle_file = $this->Boardclass->get_assessment_file( $this->getparam['idx'] );

		$data = array( 'row'=>$row ,'page'=>$this->getparam['page']  , 'settle_file'=>$settle_file );
		$this->load->view($this->type."/board/view" , $data);	
	}



	function write() {

		$this->yield = true;	
		$this->load->helper('ckeditor');	

		if ( $this->getparam['idx'] != "" ) :
			$MODE =  'M' ;				
			$nameval = "수정" ;
			// 파일
			$settle_file = $this->Boardclass->get_assessment_file( $this->getparam['idx'] );
			
			$row = $this->Boardclass->get_view( $this->getparam['idx'] ) ;	
		else:
			$MODE =  'W' ;
			$row['name'] = $this->session->userdata('ss_name') ;
			$row['notice'] = 'N' ;
			$row['passwd'] ="rhksflwk" ;
			$nameval = "저장" ;
		endif;

		$data = array( 'mode'=>$MODE , 'row'=>$row , 'nameval'=>$nameval  , 'settle_file'=>$settle_file  ,'page'=>$this->getparam['page'] );
		$this->load->view($this->type."/board/write" , $data);	
	}

	function delete_all() {
		$this->yield = false;
		if ( $this->param['seqno'] ) :									
			$where = null;
			$where[] = "idx=".$this->param['seqno'];
			print_r ( $where ) ;
			$this->Boardclass->deletes($where);
		endif;
		exit;
	}
/*
	function filedowns() {
		force_download('/asset/DATA/admanager/7ace765df4a6ca43c79896f8e39798c6.jpg', NULL);
	}
*/	

	function filedown()
	{
		$this->yield = false;				
		// 파일
		$settle_file = $this->Boardclass->get_assessment_file_no( $this->uri->segment(4) );
		$strDirPath = $_SERVER[DOCUMENT_ROOT]."/asset/DATA/admanager/";				 
		$filename =  iconv("UTF-8", "EUC-KR", $settle_file['file_name'] ) ;		
		$strFileName = $strDirPath."/".trim($filename);
		$strFileSize = filesize($strFileName);

		Header("Content-type: file/unknown");
		Header("Content-Length: ".$strFileSize);
		Header("Content-Disposition: attachment; filename=".trim($settle_file['ori_name'])."");
		Header("Content-Description: PHP3 Generated Data");
		header("Pragma: no-cache");
		header("Expires: 0");
		
		if (is_file($strFileName))
		{
			$fp = fopen($strFileName, "r");
			if (!fpassthru($fp))
				fclose($fp);
		}	
	}

	function board_act() {

		$this->yield = false;	

		$input['code'] = $this->param['code'] ;
		$input['name'] = $this->param['name'] ;
		$input['title'] = $this->param['title'] ;
		$input['content'] = urldecode($_POST['content']) ;

		$input['notice'] = $this->param['notice'] ;

		$input['passwd'] = $this->param['passwd'] ; 

		if ( $this->param['mode'] =='M' ) :
			$input['recontent'] = urldecode($_POST['recontent']) ;
			$inout_no = $this->Boardclass->update($input , $this->param['inout_no']);	
		else:

			$input['hits'] = 0 ;
			$input['udate'] = date("Y-m-d H:i:s") ;	
			$input['ip'] =  $_SERVER[REMOTE_ADDR];		

			$MaxRef = $this->Boardclass->indexref();
			($MaxRef == "") ? $w_ref = 1 : $w_ref =  $MaxRef+1 ;

			$input['ref'] = $w_ref ;
			$input['step'] = 0 ;
			$input['re_level'] = 0 ;

			$inout_no = $this->Boardclass->insert($input);	
		endif;


		exit;
	}

}

 