<?php

/**
 * Class Revision_model
 * Nama   				: revision_model.php
 * Pembuat 				: Melania Laniwati
 * Tanggal Pembuatan 	: 20 November 2015
 * Version Control		:
 * v0.1 - 20 November 2015
 * - Menambahkan fungsi getComboBoxStudents untuk generate isi combobox nrp-nama pada view revisi
 * v0.2 - 21 November 2015
 * - Menambahkan fungsi-fungsi yang berkaitan dengan tabel hrevisi_penilaian
 * 		- insertDataToHrevisi
 * 		- generateNewIdForHrevisi
 * 		- getLatestIdOfHrevisi
 * - Menambahkan fungsi-fungsi yang berkaitan dengan tabel drevisi_penilaian
 * 		- insertDataToDrevisi
 * 		- getLatestIdOfDrevisi
 * - Menambahkan fungsi-fungsi yang berkaitan dengan tabel notifikasi
 * 		- insertDataToNotifikasi
 * 		- getLatestIdOfNotifikasi
 * v0.3 - 22 November 2015
 * - Menambahkan fungsi-fungsi yang berkaitan dengan lihat transkrip nilai mahasiswa
 * 		- getTakenClasses
 * 		- getTakenClassesForSemester
 * 		- getCurrentSchoolYear
 * 		- getStudentYear
 * 		- getStudentCourse
 * 		- getStudentIPK
 * 		- getStudentIPK
 * v0.4 - 24 November 2015
 * - Menambahkan fungsi 
 */
 
Class Revision_model extends CI_Model {
	
	public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->model('Class_model');
    }
    
    /**
	* Get all students that are currently taking the said class
	* 
	* @param string $class_id
	* 
	* @return
	*/
    public function getComboBoxStudents($class_id){
        $this->load->model('grade_model');
        $results = $this->grade_model->getAllGradeOfClass($class_id, NULL);
		
		return $results;
	}
    
    /**
	* Insert data into table hrevisi_penilaian 
	* 
	* @param string $kelas_id
	* @param string $catatan
	* 
	* @return
	*/
	public function insertDataToHrevisi($id, $kelas_id, $catatan){
		
        $myArr = array(
        	'id' => $id,
        	'kelas_id' => $kelas_id,
        	'catatan' => $catatan,
        	'status_revisi' => '2',
        	'tanggal_create' => date('Y-m-d')
        );
        
        $this->db->insert('hrevisi_penilaian', $myArr);
        
        return $this->db->affected_rows();
	}
	
	/**
	* Generate new id for table hrevisi_penilaian
	* 
	* @return string $id
	*/
	public function generateNewIdForHrevisi(){
		// ambil nilai urutan terakhir dari table hrevisi
        $id = $this->getLatestIdOfHrevisi() + 1;
        
        // generate id and adds zero (if necessary) before the number
        if ($id < 10) $id = "NR" . date('y') . date('m') . "00" . $id;
        else if ($id < 100 && $id > 9) $id = "NR" . date('y') . date('m') . "0" . $id;
        else $id = "NR" . date('y') . date('m') . $id;
		
		return $id;
	}
	
	/**
	* Get latest id (the last xxx digit of id) from table hrevisi_penilaian 
	* 
	* @return number
	*/
	public function getLatestIdOfHrevisi(){
		$this->db->select('MAX(RIGHT(id, 3)) as id', FALSE); 
		$hasil = $this->db->get('hrevisi_penilaian')->row_array();
		return $hasil['id'];
	}
    
	/**
	* Insert data into table drevisi_penilaian 
	* 
	* @param string $hrevisi_penilaian_id
	* @param string $mahasiswa_nrp
	* @param int $nilai_akhir_sebelum
	* @param int $nilai_akhir_sesudah
	* 
	* @return
	*/
	public function insertDataToDrevisi($hrevisi_penilaian_id, $mahasiswa_nrp, $nilai_akhir_sebelum, $nilai_akhir_sesudah){
        // ambil nilai urutan terakhir dari table drevisi
        $id = $this->getLatestIdOfDrevisi() + 1;
        
        // generate id and adds zero (if necessary) before the number
        if ($id < 10) $id = "DNR" . date('y') . date('m') . "00" . $id;
        else if ($id < 100 && $id > 9) $id = "DNR" . date('y') . date('m') . "0" . $id;
        else $id = "DNR" . date('y') . date('m') . $id;
        
        $myArr = array(
        	'id' => $id,
        	'hrevisi_penilaian_id' => $hrevisi_penilaian_id,
        	'mahasiswa_nrp' => $mahasiswa_nrp,
        	'nilai_akhir_sebelum' => $nilai_akhir_sebelum,
        	'nilai_akhir_sesudah' => $nilai_akhir_sesudah
        );
        
        $this->db->insert('drevisi_penilaian', $myArr);
        
        return $this->db->affected_rows();
	}
	
	/**
	* Get latest id (the last xxx digit of id) from table drevisi_penilaian 
	* 
	* @return number 
	*/
	private function getLatestIdOfDrevisi(){
		$this->db->select('MAX(RIGHT(id, 3)) as id', FALSE); 
		$hasil = $this->db->get('drevisi_penilaian')->row_array();
		return $hasil['id'];
	}
	
	/**
	* Insert data into table notifikasi
	* 
	* @param string $class_id
	* @param string $nip_dosen
	* 
	* @return
	*/
	public function insertDataToNotifikasi($class_id, $nip_dosen){
		$id = $this->getLatestIdOfNotifikasi() + 1;
		$isi = 'Terdapat revisi penilaian pada kelas dengan id ' . $class_id;
		
        $myArr = array(
        	'id' => $id,
        	'dosen_nip' => $nip_dosen,
        	'judul' => 'Revisi Penilaian',
        	'isi' => $isi
        );
        
        $this->db->insert('notifikasi', $myArr);
        
        return $this->db->affected_rows();
	}
	
	/**
	* Get latest id from table notifikasi 
	* 
	* @return number 
	*/
	private function getLatestIdOfNotifikasi(){
		$this->db->select_max('id');
		$hasil = $this->db->get('notifikasi')->row_array();
		return $hasil['id'];
	}
	
	/**
	* Ambil semua mata kuliah yang sudah pernah diambil oleh mahasiswa 
	* 
	* @param string $nrp
	* 
	* @return
	*/
	public function getTakenClasses($nrp){
		// what fields to get
		$this->db->select('mk.id as id, mk.nama as nama, mk.semester as semester, mk.jumlah_sks as jumlah_sks, mk.lulus_minimal as lulus_minimal, k.tahun_ajaran as tahun_ajaran, n.uts as uts, n.uas as uas, n.nilai_akhir_grade as nilai_akhir_grade, n.nilai_grade as nilai_grade');
		
		// connects the table
		$this->db->where('km.nilai_id = n.id');
		$this->db->where('km.kelas_id = k.id');
		$this->db->where('k.mata_kuliah_id = mk.id');
		
		// additional conditions
		$this->db->where('km.mahasiswa_nrp', $nrp);
		$this->db->where('(km.status_ambil = "A" or km.status_ambil = "r")');
		
		// the tables and their nickname
		$this->db->from('nilai n, mata_kuliah mk, kelas k, kelas_mahasiswa km');
		
        return $this->db->get()->result_array();
    }
    
    /**
	* Kembalikan list mata kuliah yang diambil pada periode tahun ajaran tertentu
	* 
	* @param string $tahun_ajaran -> contoh: GASAL 2012/2013
	* 
	* @return
	*/
    public function getTakenClassesForSemester($nrp, $tahun_ajaran){
		// what fields to get
		$this->db->select('mk.id as id, mk.nama as nama, mk.semester as semester, mk.jumlah_sks as jumlah_sks, mk.lulus_minimal as lulus_minimal, k.tahun_ajaran as tahun_ajaran, n.uts as uts, n.uas as uas, n.nilai_akhir_grade as nilai_akhir_grade, n.nilai_grade as nilai_grade');
		
		// connects the table
		$this->db->where('km.nilai_id = n.id');
		$this->db->where('km.kelas_id = k.id');
		$this->db->where('k.mata_kuliah_id = mk.id');
		
		// additional conditions
		$this->db->where('km.mahasiswa_nrp', $nrp);
		$this->db->where('k.tahun_ajaran', $tahun_ajaran);
		$this->db->where('(km.status_ambil = "A" or km.status_ambil = "r")');
		
		// the tables and their nickname
		$this->db->from('nilai n, mata_kuliah mk, kelas k, kelas_mahasiswa km');
		
        return $this->db->get()->result_array();
    }
    
    /**
	* Ambil tahun ajaran sekarang di tabel data_umum
	* 
	* @return string tahun_ajaran_sekarang
	*/
    public function getCurrentSchoolYear(){
    	$this->db->select('value');
    	$this->db->where('index', 'tahun_ajaran_sekarang');
		$hasil = $this->db->get('data_umum')->row_array();
		return $hasil['value']; // example returns: GASAL 2014/2015
	}
	
	/**
	* Ambil tahun angkatan dari tabel mahasiswa
	* 
	* @return 
	*/
    public function getStudentYear($nrp){
    	$this->db->select('informasi_kurikulum_id');
    	$this->db->where('nrp', $nrp);
		$hasil = $this->db->get('mahasiswa')->row_array();
		
		$tahun = substr($hasil['informasi_kurikulum_id'], 5, 2);
		$tahun = "20" . $tahun;
		
		return $tahun;
	}
	
	/**
	* Ambil jurusan dari tabel mahasiswa
	* 
	* @return 
	*/
    public function getStudentCourse($nrp){
    	$this->db->select('informasi_kurikulum_id');
    	$this->db->where('nrp', $nrp);
		$hasil = $this->db->get('mahasiswa')->row_array();
		
		$jurusan = substr($hasil['informasi_kurikulum_id'], 2, 3);
		
		if ($jurusan == "INF") $jurusan = "S1-TEKNIK INFORMATIKA";
		else if ($jurusan == "SIB") $jurusan = "S1-SISTEM INFORMASI BISNIS";
		else if ($jurusan == "DKV") $jurusan = "S1-DESAIN KOMUNIKASI VISUAL";
		else if ($jurusan == "DSP") $jurusan = "S1-DESAIN PRODUK";
		else if ($jurusan == "IND") $jurusan = "S1-TEKNIK INDUSTRI";
		
		return $jurusan;
	}
	
	/**
	* Ambil ipk dari tabel mahasiswa
	* 
	* @return 
	*/
    public function getStudentIPK($nrp){
    	$this->db->select('ipk');
    	$this->db->where('nrp', $nrp);
		$hasil = $this->db->get('mahasiswa')->row_array();
		
		return $hasil['ipk'];
	}
	
	/**
	* Ambil banyak sks dari tabel mahasiswa
	* 
	* @return 
	*/
    public function getStudentSKS($nrp){
    	$this->db->select('sks');
    	$this->db->where('nrp', $nrp);
		$hasil = $this->db->get('mahasiswa')->row_array();
		
		return $hasil['sks'];
	}
	
	/**
	* Ambil informasi kelas berdasarkan id nya
	* 
	* @param string $class_id
	* @param string $lecturer_id
	* 
	* @return
	*/
	public function getClassInfoById($class_id, $lecturer_id){
		$this->db->select('k.id as id, mk.id as kode_mk, mk.nama as nama_mk, k.hari as hari, k.jam_mulai as jam, r.nama as nama_ruang, k.status_konfirmasi as status_k, mk.jumlah_sks as sks, k.nama as nama_kelas, d.nama as nama_dosen, mk.semester as semester, k.tahun_ajaran as tahun_ajaran, k.tambahan_grade as grade, k.persentase_uas as persen_uas, k.persentase_uts as persen_uts, k.persentase_tugas as persen_tugas, k.tanggal_update as tanggal_update, ik.jurusan, mk.lulus_minimal as lulus_minimal, k.komentar_kajur as komentar_kajur');
		$this->db->from('mata_kuliah mk, kelas k, dosen d,informasi_kurikulum ik');
		$this->db->where('mk.id = k.mata_kuliah_id');
		$this->db->where('d.nip = k.dosen_nip');
		$this->db->where('mk.informasi_kurikulum_id = ik.id');
		$this->db->where('k.status',1);
		$this->db->where('k.dosen_nip',$lecturer_id);
		$this->db->where('k.id',$class_id);
		$this->db->join('ruangan r', 'r.id = k.ruangan_id','left');
		$result = $this->db->get()->row();
		if ($this->db->affected_rows() > 0){
			$class = $this->Class_model->processClassData($result);
			$class[] = $result->nama_dosen;
			$class[] = $result->sks;
			$class[] = $result->semester;
			$class[] = $result->status_k;
			$class[] = $result->tahun_ajaran;
			$class[] = $result->grade;
			$class[] = $result->persen_uts;
			$class[] = $result->persen_uas;
			$class[] = $result->persen_tugas;
			$class[] = $result->tanggal_update;
            $class[] = $result->id;
            $class[] = $result->lulus_minimal;
            $class[] = $result->komentar_kajur;
			return $class;
		}
		return false;
	}
}

?>