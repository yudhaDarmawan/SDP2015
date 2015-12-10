<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_hkeuangan extends CI_Model {
	public function getHFinanceDatum($field, $where, $whereValue){
		$select = $this->db->select($field)
						   ->from('hkeuangan')
						   ->where($where, $whereValue)
						   ->get()->result_array();
		return $select[0][$field];
	}
	
	public function insert($data){
		for($a = 0; $a < count($data['arrMatriculantId']); $a++){
			$arrInsert = array(
				'id' => $data['arrHK'][$a],
				'user_id' => $data['arrMatriculantId'][$a],
				'jumlah' => $data['arrUSPs'][$a],
				'tanggal_created' => date('Y').date('m').date('d'),				
			);
			$this->db->insert('hkeuangan', $arrInsert);
		}
	}
	
	public function insertUPP($data){
		for($a = 0; $a < count($data['arrStudentId']); $a++){
			$arrInsert = array(
				'id' => $data['arrHK'][$a],
				'user_id' => $data['arrStudentId'][$a],
				'jumlah' => $data['arrSKStaken'][$a] * $data['arrSKSs'][$a] + 6 * $data['arrSPPs'][$a],
				'tanggal_created' => date('Y').date('m').date('d'),				
			);
			$this->db->insert('hkeuangan', $arrInsert);
		}
	}
	
	public function getIdMatriculantUSP($arr, $bl, $l){
		$select = [];
		if(count($arr) > 0){
			if($bl == true AND $l == false){
				$select = $this->db->select('id')
						   ->from('hkeuangan')
						   ->where_in('user_id', $arr)
						   ->like('id', 'USP')
						   ->where('status', 1)
						   ->get()->result_array();
			}else if($bl == false AND $l == true){
				$select = $this->db->select('id')
						   ->from('hkeuangan')
						   ->where_in('user_id', $arr)
						   ->like('id', 'USP')
						   ->where('status', 0)
						   ->get()->result_array();
			}else if($bl == true AND $l == true){
				$select = $this->db->select('id')
						   ->from('hkeuangan')
						   ->where_in('user_id', $arr)
						   ->like('id', 'USP')
						   ->get()->result_array();
			}
		}
		return $select;
	}
	
	public function getIdStudentUPP($arr){
		$select = [];
		if(count($arr) > 0){
			$select = $this->db->select('id')
							   ->from('hkeuangan')
							   ->where_in('user_id', $arr)
							   ->like('id', 'UPP')
							   ->get()->result_array();
		}
		return $select;
	}
}
