<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_karyawan extends CI_Model {
	public function getEmployeeDatum($field, $where, $whereValue){
		$select = $this->db->select($field)
						   ->from('karyawan')
						   ->where($where, $whereValue)
						   ->get()->result_array();
		return $select[0][$field];
	}
	
}
