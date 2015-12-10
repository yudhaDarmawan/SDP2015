<?php
	class Matakuliah_Model extends CI_Model{
		/* -----------------------------------------------------
		Function __construct()
		Mengeload Inisialisasi Awal Model class_model
		Input/Output : -
		----------------------------------------------------- */
		public function __construct(){
			parent::__construct();
			//var_dump($this->isEmpty('Database'));
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
		public function getSKS($name)
		{
			$sql = $this->db->get_where('mata_kuliah',array('nama'=>$name));
			return $sql->row();
		}
		
		public function createFRS($studentID)
		{
			$this->db->select('mata_kuliah.id, mata_kuliah.nama, mata_kuliah.semester,mata_kuliah.jumlah_sks,kelas.hari, kelas.jam_mulai, getgrade.nilai_grade, kelas.status,mata_kuliah.berpraktikum,kelas.tahun_ajaran');
			$this->db->from('mata_kuliah');
			$this->db->join('kelas', 'mata_kuliah.id = kelas.mata_kuliah_id', 'left');
			$this->db->join('getgrade','mata_kuliah.nama = getgrade.nama and getgrade.mahasiswa_nrp = ' . $studentID,'left');
			$this->db->group_by('mata_kuliah.id');
			$sql = $this->db->get();
			return $sql->result();
		}
		
		public function getClassSemesterOpen()
		{
			$this->db->select('mata_kuliah.semester')->from('mata_kuliah, kelas')->where('kelas.mata_kuliah_id = mata_kuliah.id')->group_by('mata_kuliah.semester');
			$query = $this->db->get();
			return $query->result();
		}
		
		public function getSchedule($name)
		{
			$this->db->select("k.hari, k.jam_mulai");
			$this->db->from('mata_kuliah m');
			$this->db->from('kelas k');
			$this->db->where('m.id = k.mata_kuliah_id');
			$this->db->where('m.nama',$name);
			$sql = $this->db->get();
			return $sql->row();
		}
		
		public function isEmpty($name)
		{
			$arr = $this->session->userdata('getCourseNow');
			for($i=0;$i<count($arr);$i++)
			{
				$schedule = $this->getSchedule($arr[$i]);
				$choose = $this->getSchedule($name);
				if($schedule != null && $choose != null)
				{
					if($schedule->hari == $choose->hari && $schedule->jam_mulai == $choose->jam_mulai)
					{
						return false;
					}
				}
			}
			return true;
		}
		
		public function insertDummyData(){
			$data = array(
				array('id'=>'MK014','nama'=>'Data Structures','deskripsi'=>'Strukdat','semester'=>'3','jumlah_sks'=>'3','informasi_kurikulum_id'=>'S1INF131','lulus_minimal'=>'C','berpraktikum'=>'0','status'=>'1'),
				array('id'=>'MK015','nama'=>'Internet Application Development','deskripsi'=>'Aplin','semester'=>'3','jumlah_sks'=>'3','informasi_kurikulum_id'=>'S1INF131','lulus_minimal'=>'C','berpraktikum'=>'1','status'=>'1'),
				array('id'=>'MK016','nama'=>'System Analysis and Design','deskripsi'=>'ADS'
				,'semester'=>'3','jumlah_sks'=>'3','informasi_kurikulum_id'=>'S1INF131','lulus_minimal'=>'C','berpraktikum'=>'0','status'=>'1'),
				array('id'=>'MK017','nama'=>'Object-Oriented Programming','deskripsi'=>'OOP','semester'=>'3','jumlah_sks'=>'3','informasi_kurikulum_id'=>'S1INF131','lulus_minimal'=>'C','berpraktikum'=>'1','status'=>'1'),
				array('id'=>'MK018','nama'=>'Graph Theory','deskripsi'=>'Teori Graph','semester'=>'3','jumlah_sks'=>'2','informasi_kurikulum_id'=>'S1INF131','lulus_minimal'=>'C','berpraktikum'=>'0','status'=>'1'),
				array('id'=>'MK019','nama'=>'Mathematics 2','deskripsi'=>'Mat 2','semester'=>'3','jumlah_sks'=>'2','informasi_kurikulum_id'=>'S1INF131','lulus_minimal'=>'C','berpraktikum'=>'0','status'=>'1'),
				array('id'=>'MK020','nama'=>'Client Server Programming','deskripsi'=>'ADS','semester'=>'3','jumlah_sks'=>'4','informasi_kurikulum_id'=>'S1INF131','lulus_minimal'=>'C','berpraktikum'=>'1','status'=>'1'),
				array('id'=>'MK021','nama'=>'Object-Oriented Analysis and Design','deskripsi'=>'adbo','semester'=>'4','jumlah_sks'=>'3','informasi_kurikulum_id'=>'S1INF131','lulus_minimal'=>'C','berpraktikum'=>'0','status'=>'1'),
				array('id'=>'MK022','nama'=>'National Ideology','deskripsi'=>'PKN','semester'=>'4','jumlah_sks'=>'2','informasi_kurikulum_id'=>'S1INF131','lulus_minimal'=>'C','berpraktikum'=>'0','status'=>'1'),
				array('id'=>'MK023','nama'=>'Digital Circuits','deskripsi'=>'RDIG','semester'=>'4','jumlah_sks'=>'3','informasi_kurikulum_id'=>'S1INF131','lulus_minimal'=>'C','berpraktikum'=>'1','status'=>'1'),
				array('id'=>'MK024','nama'=>'Advanced Data Structures','deskripsi'=>'Struktur Data Lanjut','semester'=>'4','jumlah_sks'=>'3','informasi_kurikulum_id'=>'S1INF131','lulus_minimal'=>'C','berpraktikum'=>'0','status'=>'1'),
				array('id'=>'MK025','nama'=>'Digital Image Processing','deskripsi'=>'PCD','semester'=>'4','jumlah_sks'=>'3','informasi_kurikulum_id'=>'S1INF131','lulus_minimal'=>'C','berpraktikum'=>'0','status'=>'1'),
				array('id'=>'MK026','nama'=>'Human Computer Interaction','deskripsi'=>'HCI','semester'=>'5','jumlah_sks'=>'3','informasi_kurikulum_id'=>'S1INF131','lulus_minimal'=>'C','berpraktikum'=>'0','status'=>'1'),
				array('id'=>'MK027','nama'=>'Internet Application Framework','deskripsi'=>'FAI','semester'=>'5','jumlah_sks'=>'3','informasi_kurikulum_id'=>'S1INF131','lulus_minimal'=>'C','berpraktikum'=>'1','status'=>'1'),
				array('id'=>'MK028','nama'=>'Operating System','deskripsi'=>'Sisop','semester'=>'5','jumlah_sks'=>'3','informasi_kurikulum_id'=>'S1INF131','lulus_minimal'=>'C','berpraktikum'=>'0','status'=>'1'),
				array('id'=>'MK029','nama'=>'Artificial Intelligence','deskripsi'=>'AI','semester'=>'5','jumlah_sks'=>'3','informasi_kurikulum_id'=>'S1INF131','lulus_minimal'=>'C','berpraktikum'=>'0','status'=>'1'),
				array('id'=>'MK030','nama'=>'Computer Graphics','deskripsi'=>'Grafkom','semester'=>'5','jumlah_sks'=>'3','informasi_kurikulum_id'=>'S1INF131','lulus_minimal'=>'C','berpraktikum'=>'0','status'=>'1'),
				array('id'=>'MK031','nama'=>'Computer Organization','deskripsi'=>'Orkom','semester'=>'5','jumlah_sks'=>'3','informasi_kurikulum_id'=>'S1INF131','lulus_minimal'=>'C','berpraktikum'=>'0','status'=>'1'),
				array('id'=>'MK032','nama'=>'Software Engineering','deskripsi'=>'SE','semester'=>'6','jumlah_sks'=>'3','informasi_kurikulum_id'=>'S1INF131','lulus_minimal'=>'C','berpraktikum'=>'0','status'=>'1'),
				array('id'=>'MK033','nama'=>'Multimedia','deskripsi'=>'MMI','semester'=>'6','jumlah_sks'=>'3','informasi_kurikulum_id'=>'S1INF131','lulus_minimal'=>'C','berpraktikum'=>'1','status'=>'1'),
				array('id'=>'MK034','nama'=>'Technopreneurship','deskripsi'=>'KWU','semester'=>'6','jumlah_sks'=>'2','informasi_kurikulum_id'=>'S1INF131','lulus_minimal'=>'C','berpraktikum'=>'0','status'=>'1'),
				array('id'=>'MK035','nama'=>'Ethics and Profession','deskripsi'=>'Etika','semester'=>'6','jumlah_sks'=>'2','informasi_kurikulum_id'=>'S1INF131','lulus_minimal'=>'D','berpraktikum'=>'0','status'=>'1'),
				array('id'=>'MK036','nama'=>'Intership','deskripsi'=>'','semester'=>'6','jumlah_sks'=>'2','informasi_kurikulum_id'=>'S1INF131','lulus_minimal'=>'C','berpraktikum'=>'0','status'=>'1'),
				array('id'=>'MK037','nama'=>'Soft Computing','deskripsi'=>'SC','semester'=>'6','jumlah_sks'=>'3','informasi_kurikulum_id'=>'S1INF131','lulus_minimal'=>'C','berpraktikum'=>'0','status'=>'1'),
				array('id'=>'MK038','nama'=>'Select Topics in IT','deskripsi'=>'','semester'=>'6','jumlah_sks'=>'3','informasi_kurikulum_id'=>'S1INF131','lulus_minimal'=>'C','berpraktikum'=>'0','status'=>'1'),
				array('id'=>'MK039','nama'=>'Software Development Project','deskripsi'=>'SDP','semester'=>'7','jumlah_sks'=>'3','informasi_kurikulum_id'=>'S1INF131','lulus_minimal'=>'C','berpraktikum'=>'0','status'=>'1'),
				array('id'=>'MK040','nama'=>'Embedded Systems','deskripsi'=>'ES','semester'=>'7','jumlah_sks'=>'3','informasi_kurikulum_id'=>'S1INF131','lulus_minimal'=>'C','berpraktikum'=>'0','status'=>'1'),
				array('id'=>'MK041','nama'=>'Electives','deskripsi'=>'','semester'=>'7','jumlah_sks'=>'12','informasi_kurikulum_id'=>'S1INF131','lulus_minimal'=>'C','berpraktikum'=>'0','status'=>'1'),
				array('id'=>'MK042','nama'=>'Undergraduate Thesis','deskripsi'=>'TA','semester'=>'7','jumlah_sks'=>'3','informasi_kurikulum_id'=>'S1INF131','lulus_minimal'=>'C','berpraktikum'=>'0','status'=>'1'),
				array('id'=>'MK043','nama'=>'Electives','deskripsi'=>'HCI','semester'=>'7','jumlah_sks'=>'3','informasi_kurikulum_id'=>'S1INF131','lulus_minimal'=>'C','berpraktikum'=>'0','status'=>'1')
				
			);
			
			$this->db->insert_batch('mata_kuliah',$data);
			
			
		}
		
		public function insertSyaratMataKuliah(){
			$data = array(
				array('id_matakuliah'=>'MK014','id_syarat_matakuliah'=>'MK007'),
				array('id_matakuliah'=>'MK017','id_syarat_matakuliah'=>'MK002'),
				array('id_matakuliah'=>'MK015','id_syarat_matakuliah'=>'MK004'),
				array('id_matakuliah'=>'MK019','id_syarat_matakuliah'=>'MK013'),
				array('id_matakuliah'=>'MK016','id_syarat_matakuliah'=>'MK009'),
				array('id_matakuliah'=>'MK024','id_syarat_matakuliah'=>'MK014'),
				array('id_matakuliah'=>'MK021','id_syarat_matakuliah'=>'MK016'),
				array('id_matakuliah'=>'MK020','id_syarat_matakuliah'=>'MK008'),
				array('id_matakuliah'=>'MK020','id_syarat_matakuliah'=>'MK009'),
				array('id_matakuliah'=>'MK029','id_syarat_matakuliah'=>'MK014'),
				array('id_matakuliah'=>'MK029','id_syarat_matakuliah'=>'MK031'),
				array('id_matakuliah'=>'MK032','id_syarat_matakuliah'=>'MK021'),
				array('id_matakuliah'=>'MK037','id_syarat_matakuliah'=>'MK029'),
				array('id_matakuliah'=>'MK039','id_syarat_matakuliah'=>'MK032'),
				array('id_matakuliah'=>'MK040','id_syarat_matakuliah'=>'MK031')
			);
			$this->db->insert_batch('syarat_matakuliah',$data);
		}
		
		public function insertKelas(){
			$data= array(
				array('id'=>'K15099','nama'=>'','mata_kuliah_id'=>'MK021','ruangan_id'=>'R0004','dosen_nip'=>'DO001','hari'=>'3','jam_mulai'=>'08:00:00','persentase_uts'=>'30','persentase_uas'=>'30','persentase_tugas'=>'40','tambahan_grade'=>'0','status_konfirmasi'=>'0','komentar_kajur'=>'','tahun_ajaran'=>'GENAP 2015/2016'),
				array('id'=>'K15014','nama'=>'','mata_kuliah_id'=>'MK022','ruangan_id'=>'R0002','dosen_nip'=>'DO002','hari'=>'2','jam_mulai'=>'10:30:00','persentase_uts'=>'30','persentase_uas'=>'30','persentase_tugas'=>'40','tambahan_grade'=>'0','status_konfirmasi'=>'0','komentar_kajur'=>'','tahun_ajaran'=>'GENAP 2015/2016'),
				array('id'=>'K15015','nama'=>'','mata_kuliah_id'=>'MK023','ruangan_id'=>'R0001','dosen_nip'=>'DO001','hari'=>'4','jam_mulai'=>'08:00:00','persentase_uts'=>'30','persentase_uas'=>'30','persentase_tugas'=>'40','tambahan_grade'=>'0','status_konfirmasi'=>'0','komentar_kajur'=>'','tahun_ajaran'=>'GENAP 2015/2016'),
				
				array('id'=>'K15016','nama'=>'','mata_kuliah_id'=>'MK024','ruangan_id'=>'R0002','dosen_nip'=>'DO003','hari'=>'5','jam_mulai'=>'15:30:00','persentase_uts'=>'30','persentase_uas'=>'30','persentase_tugas'=>'40','tambahan_grade'=>'0','status_konfirmasi'=>'0','komentar_kajur'=>'','tahun_ajaran'=>'GENAP 2015/2016'),
				
				array('id'=>'K15017','nama'=>'','mata_kuliah_id'=>'MK025','ruangan_id'=>'R0003','dosen_nip'=>'DO002','hari'=>'1','jam_mulai'=>'18:00:00','persentase_uts'=>'30','persentase_uas'=>'30','persentase_tugas'=>'40','tambahan_grade'=>'0','status_konfirmasi'=>'0','komentar_kajur'=>'','tahun_ajaran'=>'GENAP 2015/2016'),
				
				array('id'=>'K15018','nama'=>'','mata_kuliah_id'=>'MK032','ruangan_id'=>'R0004','dosen_nip'=>'DO002','hari'=>'4','jam_mulai'=>'13:00:00','persentase_uts'=>'30','persentase_uas'=>'30','persentase_tugas'=>'40','tambahan_grade'=>'0','status_konfirmasi'=>'0','komentar_kajur'=>'','tahun_ajaran'=>'GENAP 2015/2016'),
				
				array('id'=>'K15019','nama'=>'','mata_kuliah_id'=>'MK033','ruangan_id'=>'R0004','dosen_nip'=>'DO001','hari'=>'5','jam_mulai'=>'10:30:00','persentase_uts'=>'30','persentase_uas'=>'30','persentase_tugas'=>'40','tambahan_grade'=>'0','status_konfirmasi'=>'0','komentar_kajur'=>'','tahun_ajaran'=>'GENAP 2015/2016'),
				
				array('id'=>'K15020','nama'=>'','mata_kuliah_id'=>'MK034','ruangan_id'=>'R0008','dosen_nip'=>'DO002','hari'=>'1','jam_mulai'=>'08:00:00','persentase_uts'=>'30','persentase_uas'=>'30','persentase_tugas'=>'40','tambahan_grade'=>'0','status_konfirmasi'=>'0','komentar_kajur'=>'','tahun_ajaran'=>'GENAP 2015/2016'),
				
				array('id'=>'K15021','nama'=>'','mata_kuliah_id'=>'MK035','ruangan_id'=>'R0006','dosen_nip'=>'DO001','hari'=>'3','jam_mulai'=>'13:00:00','persentase_uts'=>'30','persentase_uas'=>'30','persentase_tugas'=>'40','tambahan_grade'=>'0','status_konfirmasi'=>'0','komentar_kajur'=>'','tahun_ajaran'=>'GENAP 2015/2016'),
				
				array('id'=>'K15022','nama'=>'','mata_kuliah_id'=>'MK036','ruangan_id'=>'R0003','dosen_nip'=>'DO003','hari'=>'2','jam_mulai'=>'15:30:00','persentase_uts'=>'30','persentase_uas'=>'30','persentase_tugas'=>'40','tambahan_grade'=>'0','status_konfirmasi'=>'0','komentar_kajur'=>'','tahun_ajaran'=>'GENAP 2015/2016'),
				
				array('id'=>'K15023','nama'=>'','mata_kuliah_id'=>'MK037','ruangan_id'=>'R0004','dosen_nip'=>'DO003','hari'=>'4','persentase_uts'=>'30','jam_mulai'=>'10:30:00','persentase_uas'=>'30','persentase_tugas'=>'40','tambahan_grade'=>'0','status_konfirmasi'=>'0','komentar_kajur'=>'','tahun_ajaran'=>'GENAP 2015/2016'),
				
				array('id'=>'K15024','nama'=>'','mata_kuliah_id'=>'MK038','ruangan_id'=>'R0008','dosen_nip'=>'DO003','hari'=>'5','persentase_uts'=>'30','jam_mulai'=>'13:00:00','persentase_uas'=>'30','persentase_tugas'=>'40','tambahan_grade'=>'0','status_konfirmasi'=>'0','komentar_kajur'=>'','tahun_ajaran'=>'GENAP 2015/2016'),
				
			);
			$this->db->insert_batch('kelas',$data);
		}
		
		/****
		Function selectStatus
		Mengambil data mata_kuliah yang sedang dibuka (Statusnya adalah 1)
		Input : Status = 1 
		Output : Result Array of Mata_Kuliah
		****/
		public function selectStatus($status = 1){
			return $this
			->db
			->get_where('mata_kuliah',array('status' => $status))
			->result_array();
		}
		
		/****
		Function selectMataKuliah
		Mengambil data mata_kuliah Berdasarkan Kode Mata Kuliahnya
		Input : ID_Mata_Kuliah
		Output : Result Array of Mata_Kuliah
		****/
		public function selectMataKuliah($ID_Mata_Kuliah){
			return $this->db->get_where('mata_kuliah', array('id' => $ID_Mata_Kuliah))->result_array();
		}
	}
?>