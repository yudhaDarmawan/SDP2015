<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_kelas_mahasiswa extends CI_Model {
	public function getClassStudentDatum($field, $where, $whereValue){
		$select = $this->db->select($field)
						   ->from('kelas_mahasiswa')
						   ->where($where, $whereValue)
						   ->get()->result_array();
		return $select[0][$select];
	}
	
}
