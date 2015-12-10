<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_mahasiswa extends CI_Model {
	public function getStudentDatum($field, $where, $whereValue){
		$select = $this->db->select($field)
						   ->from('mahasiswa')
						   ->where($where, $whereValue)
						   ->get()->result_array();
		return $select[0][$field];
	}
	
	public function countAll(){
		$select = $this->db->get('mahasiswa')->result_array();
		return count($select);
	}
	
	public function getStudentIds(){
		$select = $this->db->select('nrp')
						   ->from('mahasiswa')
						   ->get()->result_array();
		return $select;
	}
	
	public function getCurriculumIds($arrStudentId){
		$select =  $this->db->select('informasi_kurikulum_id')
						    ->from('mahasiswa')
						    ->or_where_in('nrp', $arrStudentId)
						    ->get()->result_array();
		return $select;						    
	}
	
	public function getSKStaken($nrp){
		$totalSKS = 0;
		$select = $this->db->select('mata_kuliah_id')
						   ->from('kelas_mahasiswa')
						   ->where('mahasiswa_nrp', $nrp)
						   ->get()->result_array();
		foreach($select as $row){
			$totalSKS = $totalSKS + $this->model_mata_kuliah->getCourseDatum('jumlah_sks', 'id', $row['mata_kuliah_id']);
		}
		return $totalSKS;
	}
	
	public function getStudentId($arr){
		$select = [];
		if(count($arr) > 0){
			$select = $this->db->select('nrp')
						   ->from('mahasiswa')
						   ->where_in('informasi_kurikulum_id', $arr)
						   ->get()->result_array();
		}
		
		return $select;
	}
	
}
