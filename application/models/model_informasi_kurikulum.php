<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_informasi_kurikulum extends CI_Model {
	var $arrayJurusan = array(
			'S1INF' => 'S1-Informatika', 'D3INF' => 'D3-Informatika', 'S1SIB' => 'S1-Sistem Informasi Bisnis',
			'S1IND' => 'S1-Industri', 'S1DKV' => 'S1-Desain Komunikasi Visual', 'S1PRO' => 'S1-Desain Produk',
			'S2INF' => 'S2-Informatika', 'BIT' => 'S1-Informatika'
		);
	
	public function getCurriculumDatum($field, $where, $whereValue){
		$select = $this->db->select($field)
						   ->from('informasi_kurikulum')
						   ->where($where, $whereValue)
						   ->get()->result_array();
		return $select[0][$field];
	}
	
	public function getAllCurriculum(){
		$select = $this->db->select('*')
						   ->from('informasi_kurikulum')
						   ->get()->result_array();
		return $select;
	}
	
	public function isCurriculumIdExist($tempId){
		$select = $this->db->select('id')
						   ->from('informasi_kurikulum')
						   ->where('id', $tempId)
						   ->get()->result_array();
		if(count($select) > 0){
			return true;
		}
		return false;
	}
	
	public function updateCurriculum($id, $data){
		$arrayTahun = array(
			(substr(date('Y')-5, 2, 2)) => (date('Y')-5).'/'.(date('Y')-4), 
			(substr(date('Y')-4, 2, 2)) => (date('Y')-4).'/'.(date('Y')-3), 
			(substr(date('Y')-3, 2, 2)) => (date('Y')-3).'/'.(date('Y')-2), 
			(substr(date('Y')-2, 2, 2)) => (date('Y')-2).'/'.(date('Y')-1), 
			(substr(date('Y')-1, 2, 2)) => (date('Y')-1).'/'.(date('Y')-0), 
			(substr(date('Y')-0, 2, 2)) => (date('Y')-0).'/'.(date('Y')+1), 
			(substr(date('Y')+1, 2, 2)) => (date('Y')+1).'/'.(date('Y')+2), 
			(substr(date('Y')+2, 2, 2)) => (date('Y')+2).'/'.(date('Y')+3), 
			(substr(date('Y')+3, 2, 2)) => (date('Y')+3).'/'.(date('Y')+4), 
			(substr(date('Y')+4, 2, 2)) => (date('Y')+4).'/'.(date('Y')+5), 
			(substr(date('Y')+5, 2, 2)) => (date('Y')+5).'/'.(date('Y')+6)
		);
		$arrUpdate = array(
			'jurusan' => $this->arrayJurusan[$data['jurusan']],
			'tahun_angkatan' =>  $arrayTahun[$data['tahun']],
			'kategori' =>  $data['kategori'],
			'harga_usp' =>  str_replace('.', '', $data['usp']),
			'harga_spp' =>  str_replace('.', '', $data['spp']),
			'harga_sks' =>  str_replace('.', '', $data['sks']),
			'tanggal_created' => date('Y').'-'.date('M').'-'.date('d')
		);
		$this->db->where('id', $id);
		$this->db->update('informasi_kurikulum', $arrUpdate);
	}
	
	public function insertCurriculum($id, $data){
		$arrayTahun = array(
			(substr(date('Y')-5, 2, 2)) => (date('Y')-5).'/'.(date('Y')-4), 
			(substr(date('Y')-4, 2, 2)) => (date('Y')-4).'/'.(date('Y')-3), 
			(substr(date('Y')-3, 2, 2)) => (date('Y')-3).'/'.(date('Y')-2), 
			(substr(date('Y')-2, 2, 2)) => (date('Y')-2).'/'.(date('Y')-1), 
			(substr(date('Y')-1, 2, 2)) => (date('Y')-1).'/'.(date('Y')-0), 
			(substr(date('Y')-0, 2, 2)) => (date('Y')-0).'/'.(date('Y')+1), 
			(substr(date('Y')+1, 2, 2)) => (date('Y')+1).'/'.(date('Y')+2), 
			(substr(date('Y')+2, 2, 2)) => (date('Y')+2).'/'.(date('Y')+3), 
			(substr(date('Y')+3, 2, 2)) => (date('Y')+3).'/'.(date('Y')+4), 
			(substr(date('Y')+4, 2, 2)) => (date('Y')+4).'/'.(date('Y')+5), 
			(substr(date('Y')+5, 2, 2)) => (date('Y')+5).'/'.(date('Y')+6)
		);
		$arrInsert = array(
			'id' => $id,
			'jurusan' => $this->arrayJurusan[$data['jurusan']],
			'tahun_angkatan' =>  $arrayTahun[$data['tahun']],
			'kategori' =>  $data['kategori'],
			'harga_usp' =>  str_replace('.', '', $data['usp']),
			'harga_spp' =>  str_replace('.', '', $data['spp']),
			'harga_sks' =>  str_replace('.', '', $data['sks']),
			'tanggal_created' => strtotime(date('Y').'-'.date('M').'-'.date('d'))
		);
		$this->db->insert('informasi_kurikulum', $arrInsert);
	}
	
	public function getUSPs($arrCurriculumId){
		$select = $this->db->select('harga_usp')
						   ->from('informasi_kurikulum')
						   ->where_in('id', $arrCurriculumId)
						   ->get()->result_array();
		return $select;						   
	}
	
	public function getCurriculumId($jurusan, $tahun){
		$select = '';
		if($jurusan == 'ALLJURUSAN' AND $tahun != 'ALLYEAR'){
			$select = $this->db->select('id')
						   ->from('informasi_kurikulum')
						   ->like('id', $tahun)
						   ->get()->result_array();
		}
		else if($tahun == 'ALLYEAR' AND $jurusan != 'ALLJURUSAN'){
			$select = $this->db->select('id')
						   ->from('informasi_kurikulum')
						   ->like('id', $jurusan)
						   ->get()->result_array();
		}
		else if($jurusan != 'ALLJURUSAN' AND $tahun != 'ALLYEAR'){
			$id = $jurusan.$tahun;
			$select = $this->db->select('id')
						   ->from('informasi_kurikulum')
						   ->like('id', $id)
						   ->get()->result_array();
		}
		else if($jurusan == 'ALLJURUSAN' AND $tahun == 'ALLYEAR'){
			$select = $this->db->select('id')
						   ->from('informasi_kurikulum')
						   ->get()->result_array();
		}
		
		return $select;
	}
	
}
