<?php
	class Mahasiswa_model extends CI_Model{
		/* -----------------------------------------------------
		Function __construct()
		Mengeload Inisialisasi Awal Model class_model
		Input/Output : -
		----------------------------------------------------- */
		public function __construct(){
			parent::__construct();
		}
		/* -----------------------------------------------------
		Function getAllStudent
		Mengambil data mahasiswa di tabel mahasiswa
		Input: -
		Output: Array Raw Mahasiswa
		----------------------------------------------------- */
		public function getAllStudent(){
			$sql = $this->db->get('mahasiswa');
			return $sql->result();
		}
		
		/* -----------------------------------------------------
		Function isStudent
		Mengecek apakah nrp sekian merupakan mahasiswa dari tabel mahasiswa
		Input: nrp mahasiswa
		Output: jika benar maka bernilai true, jika salah false
		----------------------------------------------------- */
		
		public function isStudent($nrp){
			$this->db->get_where('mahasiswa',array('nrp'=>$nrp));
			if($this->db->affected_rows()>0){
				return true;
			}
			else{
				return false;
			}
		}
		
		/* -----------------------------------------------------
		Function isPassword
		Mengecek apakah nrp sekian dengan password sekian apakah sama
		di tabel mahasiswa
		Input: nrp mahasiswa, pass mahasiswa
		Output: jika benar maka bernilai true, jika salah false
		----------------------------------------------------- */
		public function isPassword($nrp,$pass)
		{
			$result = $this->db->get_where('mahasiswa',array('nrp'=>$nrp));
			$row = $result->row();
			if($this->db->affected_rows()>0){
				if($row->password == $pass)
				{
					return true;
				}
				else
				{
					return false;
				}
			}
			else
			{
				return false;
			}
		}
		
		
		public function getDetailStudent($nrp)
		{
			$this->db->select('nama,nrp,sks,ipk');
			$result = $this->db->get_where('mahasiswa',array('nrp'=>$nrp));
			return $result->row();
		}
	}
?>