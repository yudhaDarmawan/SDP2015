<?php
	class Data_Umum_Model extends CI_Model
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->database();
		}
		
		public function getSemester()
		{
			$this->db->select('*');
			$this->db->where('index','tahun_ajaran_sekarang');
			$result = $this->db->get('data_umum')->row();
			return $result->value;
		}
	}
?>