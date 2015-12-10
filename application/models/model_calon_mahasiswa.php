<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_calon_mahasiswa extends CI_Model {
	public function getMatriculantDatum($field, $where, $whereValue){
		$select = $this->db->select($field)
						   ->from('calon_mahasiswa')
						   ->where($where, $whereValue)
						   ->get()->result_array();
		return $select[0][$field];
	}
	
	public function countAll(){
		$select = $this->db->get('calon_mahasiswa')->result_array();
		return count($select);
	}
	
	public function getMatriculantIds(){
		$select = $this->db->select('nomor_registrasi_id')
						   ->from('calon_mahasiswa')
						   ->get()->result_array();
		return $select;
	}
	
	public function getCurriculumIds($arrMatriculantId){
		$select =  $this->db->select('informasi_kurikulum_id')
						    ->from('calon_mahasiswa')
						    ->or_where_in('nomor_registrasi_id', $arrMatriculantId)
						    ->get()->result_array();
		return $select;						    
	}
	
	public function getMatriculantId($arr){
		$select = [];
		if(count($arr) > 0){
			$select = $this->db->select('nomor_registrasi_id')
						   ->from('calon_mahasiswa')
						   ->where_in('informasi_kurikulum_id', $arr)
						   ->get()->result_array();
		}
		
		return $select;
	}
	
	public function getMatriculantNameSearch($search){
		$select = $this->db->select('nama')
						   ->from('calon_mahasiswa')
						   ->like('nama', $search)
						   ->get()->result_array();
		return $select;
	}
	
}
