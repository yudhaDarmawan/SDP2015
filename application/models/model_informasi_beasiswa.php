<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_informasi_beasiswa extends CI_Model {
	public function getScholarshipDatum($field, $where, $whereValue){
		$select = $this->db->select($field)
						   ->from('informasi_beasiswa')
						   ->where($where, $whereValue)
						   ->get()->result_array();
		return $select[0][$select];
	}
	
    public function getAllScholarship(){
        $select = '';
        $select = $this->db->select('*')
                           ->from('informasi_beasiswa')
                           ->get()->result();
        if(count($select) > 0) return $select;
        else return [];
    }
    
    public function countAllScholarship(){
        $select = $this->db->get('informasi_beasiswa');
        if(count($select) < 10) return '00'.(count($select)+1);
        else if(count($select) < 100) return '0'.(count($select)+1);
        else if(count($select) < 1000) return (count($select)+1);
    }
    
    public function insertScholarship($data){
        $arrInsert = array(
            'id' => $data['id'],
            'nama_beasiswa' => $data['newScholarship'],
            'aspek_dipotong' => $data['newAspect'],
            'berapa_dipotong' => $data['newSum'],
            'tanggal_created' => date('Y').date('m').date('d')
        );
        $this->db->insert('informasi_beasiswa', $arrInsert);
    }
    
    public function updateScholarship($data){
        $this->db->where('id', $data['selectedScholarship']);
        $arrUpdate = array(
            'aspek_dipotong' => $data['selectedAspect'],
            'berapa_dipotong' => $data['sum']
        );
        $this->db->update('informasi_beasiswa', $arrUpdate);
    }
}
