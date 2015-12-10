<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_dosen extends CI_Model {
	public function getLecturerDatum($field, $where, $whereValue){
		$select = $this->db->select($field)
						   ->from('dosen')
						   ->where($where, $whereValue)
						   ->get()->result_array();
		return $select[0][$field];
	}
	
}
