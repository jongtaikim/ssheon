<?php
class Logincheck extends CI_Model {

/*
	public $bbs_code = "";
	public $total = 0;
	public $list_limit = 10;
	public $page_limit = 5;
*/
	function __construct() {
		parent::__construct();
//		$DB1 = $this->load->database('DB', TRUE);

		$this->bbs_code = "iiop_users" ;
	}

	function bbs_total( $where ) {

		$this->db->select('COUNT(idx) as total');

		if (is_array($where)) {
			$where_option = $this->set_where_option($where);
			$this->db->where($where_option, null, false);
		}

		$query = $this->db->get($this->bbs_code);
		$row = $query->row();
		$this->total = $row->total;

		return $row->total;
	}

	function get_view( $where ) {

		if (is_array($where)) {
			$where_option = $this->set_where_option($where);
			$this->db->where($where_option, null, false);
		}
		
		$this->db->select('*');

		$query = $this->db->get($this->bbs_code);
		$row = $query->row_array();
		return $row;
	}
		
	function update($input, $seqno) {
		$this->db->update($this->bbs_code, $input, array('userid' => $seqno));
	}
		
	/**
	 * 배열의 where 절을 모두 뭉침 
	 * @param $where_option
	 * @param $type
	 * @return unknown_type
	 */	
	function set_where_option($where_option="", $type=0) {

		if(is_array($where_option)) {

			if($type == 0) {
				$type_str = "and";
			} else if($type == 1) {
				$type_str = "or";
			}

			$where_option_size = count($where_option);

			for($i=0; $i<$where_option_size; $i++) {
				if($i == 0) {
					$where_str = "$where_option[$i]";
				} else {
					$where_str .= " $type_str $where_option[$i]";
				}
			}

		}
		return $where_str;

	}

	
}