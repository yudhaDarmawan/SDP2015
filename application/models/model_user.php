<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_user extends CI_Model {
	public function getUserDatum($field, $where, $whereValue){
		$select = $this->db->select($field)
						   ->from('user')
						   ->where($where, $whereValue)
						   ->get()->result_array();
		return $select[0][$field];
	}
	
	public function isUserExist($userid){
		$select = $this->db->select('id')
						   ->from('user')
						   ->where('id', $userid)
						   ->get()->result_array();
		// jika user ditemukan.
		if(count($select) > 0){
			return true;
		}
		// jika user tidak ditemukan.
		return false;
	}
	
}
