<?php
	class Dosen_model extends CI_Model
	{
		/* -----------------------------------------------------
		Function __construct()
		Mengeload Inisialisasi Awal Model class_model
		Input/Output : -
		----------------------------------------------------- */
		public function __construct()
		{
			parent::__construct();
		}
		/* -----------------------------------------------------
		Function getAllStudent
		Mengambil data mahasiswa di tabel mahasiswa
		Input: -
		Output: Array Raw Mahasiswa
		----------------------------------------------------- */
		public function getAllLecture()
		{
			$sql = $this->db->get('dosen');
			return $sql->result;
		}
		/* -----------------------------------------------------
		Function isStudent
		Mengecek apakah nrp sekian merupakan mahasiswa dari tabel mahasiswa
		Input: nrp mahasiswa
		Output: jika benar maka bernilai true, jika salah false
		----------------------------------------------------- */
		public function isLecture($nip)
		{
			$this->db->get_where('dosen',array('nip'=>$nip));
			if($this->db->affected_rows()>0){
				return true;
			}
			else{
				return false;
			}
		}
		
		public function isPassword($nip,$pass)
		{
			$result = $this->db->get_where('dosen',array('nip'=>$nip));
			$row = $result->row();
			if($this->db->affected_rows()>0)
			{
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
	}
?>