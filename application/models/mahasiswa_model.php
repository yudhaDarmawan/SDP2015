<?php
	class Mahasiswa_Model extends CI_Model
	{
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
			$result = $this->db->get_where('user',array('id'=>$nrp));
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
		
		/* -----------------------------------------------------
		Function getDetailStudent
		Digunakan untuk mendapatkan detail mahasiswa
		Input: nrp mahasiswa
		Output: data detail mahasiswa
		----------------------------------------------------- */
		public function getDetailStudent($nrp)
		{
			$this->db->select('nama,nrp,sks,ipk');
			$result = $this->db->get_where('mahasiswa',array('nrp'=>$nrp));
			return $result->row();
		}
		
		/* -----------------------------------------------------
		Function getNameStudent
		Digunakan untuk mendapatkan nama mahasiswa
		Input: nrp mahasiswa
		Output: nama mahasiswa
		----------------------------------------------------- */
		public function getNameStudent($nrp)
		{
			$result = $this->db->get_where('mahasiswa',array('nrp'=>$nrp))->row();
			return $result->nama;
		}
		
		/* -----------------------------------------------------
		Function getStatusConfirm
		Digunakan untuk mendapatkan apakah mahasiswa 
		sudah perwalian belum
		Input: -
		Output: true jika belum, sedangkan jika sudah maka false
		----------------------------------------------------- */
		public function getStatusConfirm()
		{
			$studentID = $this->session->userdata('username');
			$result = $this->db->get_where('mahasiswa',array('nrp'=>$studentID))->row();
			if($result->status_perwalian == 0){
				return true;
			}else{
				return false;
			}
		}
		
		/* -----------------------------------------------------
		Function setAfterStudyPlan
		Digunakan untuk mengset mahasiswa sudah melakukan perwalian
		Input: -
		Output: -
		----------------------------------------------------- */
		public function setAfterStudyPlan()
		{
			$studentID = $this->session->userdata('username');
			$data=array('status_perwalian'=>1);
			$this->db->where('nrp',$studentID);
			$this->db->update('mahasiswa',$data);
			return $this->db->affected_rows();
		}
		
		/* -----------------------------------------------------
		Function getLecture
		Digunakan untuk mendapatkan nip dosen wali
		Input: -
		Output: nip dosenwali
		----------------------------------------------------- */
		public function getLecture()
		{
			$studentID = $this->session->userdata('username');
			$this->db->where('nrp',$studentID);
			$result = $this->db->get('mahasiswa')->row();
			return $result->nip_dosen;
		}
		/****
		Function getStatusPerwalian
		Digunakan untuk mendapatkan status perwalian dari Table Mahasiswa
		Input : nrp
		Output : status_perwalian
		****/
		public function getStatusPerwalian($nrp){
			$this->db->select('status_perwalian');
			$query = $this->db->get_where('mahasiswa',array('nrp' => $nrp));
			return $query->row_array();
		}
		/****
		Function getDataMahasiswa
		Digunakan untuk mendapatkan Informasi Mahasiswa dari Table Mahasiswa
		Input : nrp
		Output : Array dari semua field dari table mahasiswa
		****/
		public function getDataMahasiswa($nrp){
			return $this->db->get_where("mahasiswa",array("nrp" => $nrp))->row_array();
		}
		
	}
?>