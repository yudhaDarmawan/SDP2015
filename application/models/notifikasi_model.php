<?php
	class Notifikasi_Model extends CI_Model{
		/* -----------------------------------------------------
		Function __construct()
		Mengeload Inisialisasi Awal Model class_model
		Input/Output : -
		----------------------------------------------------- */
		public function __construct(){
			parent::__construct();
		}
		
		
		public function getNotification()
		{
			$name = $this->session->userdata('username');
			$this->db->limit(5);
			$result = $this->db->get_where('notifikasi',array('mahasiswa_nrp'=>$name));
			return $result->result();
		}
		
		public function getCountNotification()
		{
			$name = $this->session->userdata('username');
			$this->db->where('mahasiswa_nrp',$name);
			$this->db->where('status_baca = 0');
			$result = $this->db->get('notifikasi');
			return $this->db->affected_rows();
		}
		
		public function readAll()
		{
			$this->db->update('notifikasi',array('status_baca'=>1));
		}
		
		public function sendNotif()
		{
			$lectureId = $this->Mahasiswa_Model->getLecture();
			$studentId = $this->session->userdata('username');
			$isi = $this->Mahasiswa_Model->getNameStudent($studentId) . ' telah melakukan perwalian';
			$data = array('mahasiswa_nrp'=>$studentId, 'dosen_nip'=>$lectureId,'judul'=>'Konfirmasi Perwalian','isi'=>$isi);
			$this->db->insert('notifikasi',$data);
		}
	}
?>