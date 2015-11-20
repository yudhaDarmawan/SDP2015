<?php
	class Matakuliah_model extends CI_Model{
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
		Mengambil data matakuliah di tabel matakuliah
		Input: -
		Output: Array Raw Matakuliah
		----------------------------------------------------- */
		public function getAllCourses(){
			$sql = $this->db->get('mata_kuliah');
			return $sql->result();
		}
		/* -----------------------------------------------------
		Function isStudent
		Mengecek apakah nrp sekian merupakan mahasiswa dari tabel mahasiswa
		Input: nrp mahasiswa
		Output: jika benar maka bernilai true, jika salah false
		----------------------------------------------------- */
		public function getSKS($name){
			$sql = $this->db->get_where('mata_kuliah',array('nama'=>$name));
			return $sql->row();
		}
		
		public function createFRS($studentID){
			$this->db->select('mata_kuliah.id, mata_kuliah.nama, mata_kuliah.semester,mata_kuliah.jumlah_sks,kelas.hari, kelas.jam_mulai, getgrade.nilai_grade');
			$this->db->from('mata_kuliah');
			$this->db->join('kelas', 'mata_kuliah.id = kelas.mata_kuliah_id', 'left');
			$this->db->join('getgrade','mata_kuliah.nama = getgrade.nama and getgrade.mahasiswa_nrp = ' . $studentID,'left');
			$this->db->group_by('mata_kuliah.id');
			$sql = $this->db->get();
			return $sql->result();
		}
		
		public function getClassSemesterOpen(){
			$this->db->select('mata_kuliah.semester')->from('mata_kuliah, kelas')->where('kelas.mata_kuliah_id = mata_kuliah.id')->group_by('mata_kuliah.semester');
			$query = $this->db->get();
			return $query->result();
		}
	}
?>