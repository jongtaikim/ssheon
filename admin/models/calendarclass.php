<?php
class Calendarclass extends CI_Model {

	function __construct() {
		parent::__construct();
//		$this->bbs_code = "iiop_board" ;
	}

	function insert($input) {
		$this->db->insert('iiop_realpan_cate', $input);
		return $this->db->insert_id() ;	
	}


	function view_update( $input , $temp1) {
		$this->db->update('iiop_realpan_cate', $input, array('code' => $temp1 ));
	}


	function re_bbs_list($where) {


		if (is_array($where)) {
			$where_option = $this->db->set_where_option($where);
			$this->db->where($where_option, null, false);
		}
	
		$this->db->order_by("idx", "asc");

		$this->db->select('*');

		$query = $this->db->get('iiop_realpan_re');
			
		$result = $query->result_array();

		return $result;
	}

}