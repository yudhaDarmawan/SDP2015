<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_dkeuangan extends CI_Model {
	public function getDFinanceDatum($field, $where, $whereValue){
		$select = $this->db->select($field)
						   ->from('dkeuangan')
						   ->where($where, $whereValue)
						   ->get()->result_array();
		return $select[0][$field];
	}
	
	public function insert($data){
		for($a = 0; $a < count($data['arrMatriculantId']); $a++){
			$arrInsert = array(
				'id' => $data['arrDK'][$a],
				'jumlah' => $data['arrUSPs'][$a],
				'tanggal_batas' => date('Y-m-d', strtotime('+1 month')),
				'tanggal_created' => date('Y').date('m').date('d')			
			);
			$this->db->insert('dkeuangan', $arrInsert);
		}
	}
	
	public function insertUPP($arr){
		$arrInsert = array(
			'id' => $arr['arrDK'][0],
			'periode' => 1,
			'jumlah' => 2*$arr['harga_spp'] + 6*$arr['harga_sks'],
			'tanggal_batas' => date('Y').'-'.(date('m') > 7 ? '08' : '02').'-10',
			'tanggal_created' => date('Y').date('m').date('d')
		); $this->db->insert('dkeuangan', $arrInsert);
		$arrInsert = array(
			'id' => $arr['arrDK'][1],
			'periode' => 2,
			'jumlah' => 2*$arr['harga_spp'] + 6*$arr['harga_sks'],
			'tanggal_batas' => date('Y').'-'.(date('m') > 7 ? '10' : '04').'-10',
			'tanggal_created' => date('Y').date('m').date('d')
		); $this->db->insert('dkeuangan', $arrInsert);
		$arrInsert = array(
			'id' => $arr['arrDK'][2],
			'periode' => 3,
			'jumlah' => 2*$arr['harga_spp'] + ($arr['sks'] - 12)*$arr['harga_sks'],
			'tanggal_batas' => date('Y').'-'.(date('m') > 7 ? '12' : '06').'-10',
			'tanggal_created' => date('Y').date('m').date('d')
		); $this->db->insert('dkeuangan', $arrInsert);
		
	}
	
	public function getDFinanceFromHFinance($field, $where, $whereValue){
		$select = $this->db->select($field)
						   ->from('dkeuangan')
						   ->like($where, $whereValue)
						   ->get()->result_array();
		if(count($select) > 1) return $select;
		else return $select[0][$field];
	}
	
}
