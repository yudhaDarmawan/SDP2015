<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_informasi_dispensasi extends CI_Model {
	public function getDispensationDatum($field, $where, $whereValue){
		$select = $this->db->select($field)
						   ->from('informasi_dispensasi')
						   ->where($where, $whereValue)
						   ->get()->result_array();
		return $select[0][$select];
	}
	
}
