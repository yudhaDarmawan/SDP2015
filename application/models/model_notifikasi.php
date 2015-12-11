<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_notifikasi extends CI_Model {
	public function getNotificationDatum($field, $where, $whereValue){
		$select = $this->db->select($field)
						   ->from('notifikasi')
						   ->where($where, $whereValue)
						   ->get()->result_array();
		return $select[0][$field];
	}
	
	public function countNewMatriculant(){
        $select = $this->db->select('id')
                           ->from('notifikasi')
                           ->like('id', 'BAU')
                           ->where('status_baca', '1')
                           ->where('mahasiswa_nrp is null')
                           ->get()->result();
        return count($select);
    }
    
    public function countNewStudent(){
        $select = $this->db->select('id')
                           ->from('notifikasi')
                           ->like('id', 'BAUUPP')
                           ->where('status_baca', '1')
                           ->get()->result();
        return count($select);
    }
	
    public function getNewMatriculant(){
        $arrReturn = [];
        $select = $this->db->select('id')
                           ->from('notifikasi')
                           ->like('id','BAU')
                           ->where('status_baca', '1')
                           ->where('mahasiswa_nrp is null')
                           ->get()->result();
        foreach($select as $r){
            $arrReturn[] = substr($r->id, 3);
        }
        return $arrReturn;
    }
    
    public function getNotifMatriculant(){
        $select = $this->db->select('id')
                           ->from('notifikasi')
                           ->like('id','BAU')
                           ->where('status_baca', '1')
                           ->where('mahasiswa_nrp is null')
                           ->get()->result_array();
        return $select;
    }
    
    public function getNewStudent(){
        $arrReturn = [];
        $select = $this->db->select('mahasiswa_nrp')
                           ->from('notifikasi')
                           ->like('id','BAUUPP')
                           ->where('status_baca', '1')
                           ->get()->result();
        foreach($select as $r){
            $arrReturn[] = $r->mahasiswa_nrp;
        }
        return $arrReturn;
    }
    
    public function getNotifStudent(){
        $select = $this->db->select('id')
                           ->from('notifikasi')
                           ->like('id','BAUUPP')
                           ->where('status_baca', '1')
                           ->get()->result_array();
        return $select;
    }
    
    public function setReadStatus($arr){
        $this->db->where_in('id', $arr);
        $arrUpdate = array(
            'status_baca' => '0'
        );
        $this->db->update('notifikasi', $arrUpdate);
    }
}
