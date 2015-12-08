<?php

/**
 * @property CI_DB_active_record $db
 * @property CI_DB_forge $dbforge
 * @property CI_Benchmark $benchmark
 * @property CI_Calendar $calendar
 * @property CI_Cart $cart
 * @property CI_Config $config
 * @property CI_Controller $controller
 * @property CI_Email $email
 * @property CI_Encrypt $encrypt
 * @property CI_Exceptions $exceptions
 * @property CI_Form_validation $form_validation
 * @property CI_Ftp $ftp
 * @property CI_Hooks $hooks
 * @property CI_Image_lib $image_lib
 * @property CI_Input $input
 * @property CI_Loader $load
 * @property CI_Log $log
 * @property CI_Model $model
 * @property CI_Output $output
 * @property CI_Pagination $pagination
 * @property CI_Parser $parser
 * @property CI_Profiler $profiler
 * @property CI_Router $router
 * @property CI_Session $session
 * @property CI_Sha1 $sha1
 * @property CI_Table $table
 * @property CI_Trackback $trackback
 * @property CI_Typography $typography
 * @property CI_Unit_test $unit_test
 * @property CI_Upload $upload
 * @property CI_URI $uri
 * @property CI_User_agent $user_agent
 * @property CI_Xmlrpc $xmlrpc
 * @property CI_Xmlrpcs $xmlrpcs
 * @property CI_Zip $zip
 *
 * Add additional libraries you wish
 * to use in your controllers here
 *
 * @property Class_model $class_model
 * @property Grade_model $grade_model
 *
 */
	class Kelas_Mahasiswa_Model extends CI_Model
	{
		/* -----------------------------------------------------
		Function __construct()
		Mengeload Inisialisasi Awal Model class_model
		Input/Output : -
		----------------------------------------------------- */
		public function __construct()
		{
			parent::__construct();
			$this->load->database();
		}
		
		public function insert($studentID,$classID,$courseID,$status,$scoreID)
		{
			$data = array('mahasiswa_nrp'=>$studentID, 'kelas_id'=>$classID, 'mata_kuliah_id'=>$courseID,'status_ambil'=>$status,'nilai_id'=>$scoreID);
			$this->db->insert('kelas_mahasiswa',$data);
			return $this->db->affected_rows();
		}
		
		public function search($courseID)
		{
			$nrp = $this->session->userdata('username');
			$this->db->select('nilai.nilai_grade, mata_kuliah.lulus_minimal');
			$this->db->from('mata_kuliah,kelas_mahasiswa,nilai');
			$this->db->where('mata_kuliah.id','kelas_mahasiswa.mata_kuliah_id');
			$this->db->where('nilai.id','kelas_mahasiswa.nilai_id');
			$this->db->where('kelas_mahasiswa.mahasiswa_nrp',$nrp);
			$this->db->where('kelas_mahasiswa.mata_kuliah_id',$courseID);
			$result = $this->db->get()->row();
			if($this->db->affected_rows() > 0)
			{
				if(strcmp(strtoupper($result->nilai_grade),strtoupper($result->lulus_minimal)) >= 0 )
				{
					return 'true';
				}				
			}
			return 'false';
		}
		
		public function getSchedule($studentID)
		{
			$nowSemester = $this->Data_Umum_Model->getSemester();
			//echo $studentID;
			//$this->db->select('mata_kuliah.id, mata_kuliah.nama , kelas.hari, kelas.jam_mulai, dosen.nama as dosen, ruangan.nama as ruangan');
			//$this->db->from('kelas, kelas_mahasiswa');
			//$this->db->from('kelas, kelas_mahasiswa, dosen, ruangan, mata_kuliah');
			//$this->db->where('kelas_mahasiswa.kelas_id','kelas.id');
			//$this->db->where('kelas.id','kelas_mahasiswa.kelas_id');
			//$this->db->where('kelas.dosen_nip','dosen.nip');
			//$this->db->where('kelas.ruangan_id','ruangan.id');
			//$this->db->where('mata_kuliah.id','kelas.mata_kuliah_id');
			//$this->db->where('kelas_mahasiswa.mahasiswa_nrp',$studentID);
			//$this->db->like('kelas.tahun_ajaran',$nowSemester);
			$this->db->select('mata_kuliah.id,mata_kuliah.berpraktikum, mata_kuliah.nama,kelas.hari, kelas.jam_mulai, dosen.nama as dosen, ruangan.nama as ruangan');
			$this->db->from('kelas, kelas_mahasiswa, dosen, ruangan, mata_kuliah');
			$this->db->where('kelas.id = kelas_mahasiswa.kelas_id');
			$this->db->where('kelas.ruangan_id = ruangan.id');
			$this->db->where('kelas.dosen_nip = dosen.nip');
			$this->db->where('mata_kuliah.id = kelas.mata_kuliah_id');
			$this->db->where('kelas_mahasiswa.mahasiswa_nrp',$studentID);
			$this->db->where('kelas.tahun_ajaran',$nowSemester);
			$result = $this->db->get();
			return $result->result();
		}
		
		public function select($nrp){
			return $this
			->db
			->get_where('kelas_mahasiswa',array('mahasiswa_nrp' => $nrp))
			->result_array();
		}
	}
?>