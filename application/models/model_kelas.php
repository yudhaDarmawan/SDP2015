<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_kelas extends CI_Model {
	public function getClassDatum($field, $where, $whereValue){
		$select = $this->db->select($field)
						   ->from('kelas')
						   ->where($where, $whereValue)
						   ->get()->result_array();
		return $select[0][$select];
	}
	
}
