<?php
class Boardclass extends CI_Model {

	function __construct() {
		parent::__construct();
		$this->bbs_code = "iiop_board" ;
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

	function bbs_list($where, $first, $limit, $order_field='', $order_format='') {


		if (is_array($where)) {
			$where_option = $this->db->set_where_option($where);
			$this->db->where($where_option, null, false);
		}
	
		if ($order_field != "" && $order_format != "")  :			
			$this->db->order_by($order_field, $order_format);
		else :
			$this->db->order_by("idx", "desc");
		endif;

		$this->db->select('*');

		if ($limit > 0) {
			$query = $this->db->get($this->bbs_code, $limit, $first);
		} else {
			$query = $this->db->get($this->bbs_code);
		}
			
		$result = $query->result_array();

		return $result;
	}

	function indexref ( ) {

		$this->db->select('max(ref) as ref ');
		$query = $this->db->get($this->bbs_code);
		$row = $query->row();
		$this->ref = $row->ref;

		return $row->ref;
	}

	function insert($input) {
		$this->db->insert($this->bbs_code, $input);
		return $this->db->insert_id() ;	
	}

	function update($input, $seqno) {
		$this->db->update($this->bbs_code, $input, array('idx' => $seqno));
	}

	function get_view($seqno) {
		$this->db->select('*');
		$this->db->where('idx', $seqno);
		$query = $this->db->get($this->bbs_code);
		$row = $query->row_array();
		return $row;
	}

	function deletes($where) {
		if (is_array($where)) {
			$where_option = $this->db->set_where_option($where);
			$this->db->where($where_option, null, false);
		}
		$this->db->delete($this->bbs_code);
	}	

	public function assessment_file_insert($input) {
	    $this->db->insert( 'iiop_board_file', $input );
	}

	public function assessment_file_del( $file_cancel_no ){
	    $sql = "
		DELETE FROM iiop_board_file
        WHERE
	        no in (".$file_cancel_no.")
        ";
	     
	    $query = $this->db->query($sql);
	}

	function get_assessment_file( $settle_no ) {

	    $this->db->select( 'file_name, ori_name, no' );	
	    $this->db->where( 'settle_no', $settle_no );
	    $query = $this->db->get( 'iiop_board_file' );	
	    $res = $query->result_array();
	    return $res;
	}

	function get_assessment_file_no( $settle_no ) {
		$this->db->select('*');
		$this->db->where('no', $settle_no);
		$query = $this->db->get('iiop_board_file');
		$row = $query->row_array();
		return $row;
	}

	function update_hit($seqno) {
		$this->db->set('hits', 'hits + 1', false);
		$this->db->update($this->bbs_code, null, array('idx' => $seqno));
	}
}