<?php
	class Informasi_Kurikulum_Model extends CI_Model
	{
		/****
		Function getDataKurikulum
		Mengambil Informasi kurikulum yang dijalani oleh Mahasiswa saat ini
		Input : informasi_kurikulum_id
		Output : Array of Data Kurikulum dari table informasi_kurikulum
		****/
		public function getDataKurikulum($informasi_kurikulum_id){
			return $this->db->get_where("informasi_kurikulum",array("id" => $informasi_kurikulum_id))->row_array();
		}
	}
?>