<?php
	class Dosen_Model extends CI_Model
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

		public function getAllLecture()
		{
			$sql = $this->db->get('dosen');
			return $sql->result;
		}

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

        public function isMajorCoordinator($nip){
            $this->db->select('kepala_jurusan_id');
            $id =  $this->db->get_where('dosen',array('nip'=>$nip))->row()->kepala_jurusan_id;
            if ($id != ""){
                return $id;
            }
            return false;
        }
		
		public function isPassword($nip,$pass)
		{
			$result = $this->db->get_where('user',array('id'=>$nip));
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
		
		public function getNameLecture($nip)
		{
			$result = $this->db->get_where('dosen',array('nip'=>$nip))->row();
			return $result->nama;
		}

        public function getKajurId($kelas_id){
            $this->db->select('m.informasi_kurikulum_id as value');
            $this->db->from('mata_kuliah m, kelas k');
            $this->db->where('m.id = k.mata_kuliah_id');
            $this->db->where('k.id',$kelas_id);
            $result = $this->db->get()->row()->value;
            $id = substr($result,0,5);
            $this->db->select('nip');
            $this->db->from('dosen');
            $this->db->like('kepala_jurusan_id',$id);
            $kajur_id = $this->db->get()->row()->nip;
            return $kajur_id;
        }
	}
?>