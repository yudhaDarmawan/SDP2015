<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_mata_kuliah extends CI_Model {
	public function getCourseDatum($field, $where, $whereValue){
		$select = $this->db->select($field)
						   ->from('mata_kuliah')
						   ->where($where, $whereValue)
						   ->get()->result_array();
		return $select[0][$field];
	}
	
}
