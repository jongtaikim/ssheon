<?php
class Usersclass extends CI_Model {

	function __construct() {
		parent::__construct();
		$this->bbs_code = "iiop_users" ;
	}

	function get_view($seqno) {
		$this->db->select('*');
		$this->db->where('idx', $seqno);
		$query = $this->db->get($this->bbs_code);
		$row = $query->row_array();
		return $row;
	}

	function bbs_total($where) {

		$this->db->select('COUNT(idx) as total');

		if (is_array($where)) {
			$where_option = $this->db->set_where_option($where);
			$this->db->where($where_option, null, false);
		}

		$query = $this->db->get($this->bbs_code);
		$row = $query->row();
		$this->total = $row->total;

		return $row->total;
	}

	function bbs_list( $where ) {

		if (is_array($where)) {
			$where_option = $this->db->set_where_option($where);
			$this->db->where($where_option, null, false);
		}

		$this->db->order_by("idx", "asc");
		$this->db->select('*');
		$query = $this->db->get($this->bbs_code);			
		$result = $query->result_array();

		return $result;
	}
	
	function deletes($where) {
		if (is_array($where)) {
			$where_option = $this->db->set_where_option($where);
			$this->db->where($where_option, null, false);
		}
		$this->db->delete($this->bbs_code);
	}	

	function insert($input) {
		$this->db->insert($this->bbs_code, $input);
	}	
	
	function update($input, $seqno) {
		$this->db->update($this->bbs_code, $input, array('idx' => $seqno));
	}

	//
	function password_check($val) {
		$this->db->select('COUNT(idx) as total');
		$this->db->where('userid', $val);
		$query = $this->db->get($this->bbs_code);
		$row = $query->row();
		$this->total = $row->total;

		return $row->total;
	}


}