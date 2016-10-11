<?php
class Realpanclass extends CI_Model {

	function __construct() {
		parent::__construct();
		$this->bbs_code = "iiop_realpan" ;
	}

	function realpan_list($where) {


		if (is_array($where)) {
			$where_option = $this->db->set_where_option($where);
			$this->db->where($where_option, null, false);
		}
	
		$this->db->order_by("idx", "desc");
		$this->db->select('*');
		$query = $this->db->get($this->bbs_code);
		$result = $query->result_array();

		return $result;
	}


	function re_realpan_list($where) {

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

	function realpan_view($seqno) {
		$this->db->select('*');
		$this->db->where('idx', $seqno);
		$query = $this->db->get($this->bbs_code);
		$row = $query->row_array();
		return $row;
	}

	function re_realpan_view($seqno) {
		$this->db->select('*');
		$this->db->where('idx', $seqno);
		$query = $this->db->get('iiop_realpan_re');
		$row = $query->row_array();
		return $row;
	}

	function re_update($input, $seqno) {
		$this->db->update('iiop_realpan_re', $input, array('idx' => $seqno));
	}

	function insert($input) {
		$this->db->insert($this->bbs_code, $input);
		return $this->db->insert_id() ;	
	}

	function update($input, $seqno) {
		$this->db->update('iiop_realpan', $input, array('idx' => $seqno));
	}


	function reinsert($input) {
		$this->db->insert('iiop_realpan_re', $input);
		return $this->db->insert_id() ;	
	}

}