<?php
/* -----------------------------------------------------
Nama   				: confirmation_model.php
Pembuat 			: Nancy Yonata
Tanggal Pembuatan 	: 16 November 2015
Version Control		:
v0.1 - 7 Januari 2015
	
----------------------------------------------------- */
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
class Confirmation_model extends CI_Model {
	/* -----------------------------------------------------
	Function __construct()
	Mengeload Inisialisasi Awal Model class_model
	Input/Output : -
	----------------------------------------------------- */
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model('class_model');
		// Pengecekkan Session
	}
	
	/* -----------------------------------------------------
	Function getAllClassByLecturer
	Mengambil data kelas yang diajar oleh lecturer tertentu 
	berdasarkan order_by, dan tahun_ajaran tertentu.
	Input: 
		[1] lecturer_id = (string) NIP dari Dosen yang dicari.
		[2] $orders = (assoc array) $nama_kolom => 'asc/desc'
		[3] $yearNow = (string) tahun ajaran yang ingin dioutputkan
	Output: Array Raw Kelas
	----------------------------------------------------- */
	
	public function getAllClass($orders , $yearNow, $limit, $start){				
		// Mengambil Data Kelas yang di ajar oleh lecturer
		$this->db->select('k.id as id, mk.id as kode_mk,mk.jumlah_sks as sks, mk.nama as nama_mk, d.nama as nama_dosen, k.hari as hari, k.jam_mulai as jam, r.nama as nama_ruang, k.status_konfirmasi as status_k,d.nip as dosen_nip, ik.jurusan as jurusan, k.nama as nama_kelas, k.tanggal_update as tanggal_update');
		$this->db->from('mata_kuliah mk, kelas k, dosen d, informasi_kurikulum ik');
		$this->db->where('k.tahun_ajaran',$yearNow);
		$this->db->where('d.nip = k.dosen_nip');
		$this->db->where('mk.id = k.mata_kuliah_id');
		$this->db->where('ik.id = mk.informasi_kurikulum_id');
		$this->db->join('ruangan r', 'r.id = k.ruangan_id','left');
		$this->db->where('k.status',1);		
		$this->db->limit($limit,$start);
		foreach ($orders as $key => $value){
			$this->db->order_by($key, $value);
		}
		$results = $this->db->get()->result();
		return $results;
	}
	
	/* -----------------------------------------------------
	Function countAll()
	Menunjukkan banyaknya row yang ada tabel Kelas berdasarkan
	lecturer tertentu.
	Input: (string) lecturer_id = NIP Dosen
	Output :  (integer) banyak row pada tabel
	----------------------------------------------------- */
    public function countAll($yearNow) {
        $this->db->from('kelas');
		$this->db->where('tahun_ajaran',$yearNow);
        return $this->db->count_all_results();
    }
	/* -----------------------------------------------------
	Function getDataTableByLecturer
	Mendapatkan data kelas berdasarkan parameter berikut:
	Input:
		[1] lecturer_id = (string) NIP dari Dosen yang dicari.
		[2] $orders = (assoc array) $nama_kolom => 'asc/desc'
		[3] $yearNow = (string) tahun ajaran yang ingin dioutputkan
	Output : ARRAY[2] [0]array data kelas yang sudah diFilter dan Translate, [1] JUMLAH sks
	----------------------------------------------------- */
	public function getDataTableByLecturer($orders = null, $yearNow = null,$limit,$start){
		$this->load->helper('url');
		if ($orders == null){
			$orders =['hari' => 'asc', 'jam_mulai' => 'asc'];
		}		
		if($yearNow == null){
			// Mengambil Tahun Ajaran Sekarang
			$yearNow = $this->class_model->getActiveTermYear();
		}
		
		//Mengambil Data Berdasarkan Lecturer
		$results = $this->getAllClass($orders, $yearNow,$limit, $start);

		// Memproses data yang akan dikembalikan
		$classes = [];
		foreach ($results as $result){
			$class = $this->class_model->processClassData($result);
			//menambah isi array class
			$class[1] = $result->nama_dosen;
			//$class[3] = $result->tanggal_update;
		
			array_splice($class, 3, 1);
			$class[] = $result->tanggal_update;
			$class[] = anchor('confirmation/view/'.$result->id.'/'.$result->dosen_nip,'Lihat Detail', 'class="btn btn-primary btn-sm"');
			$classes[] = $class;
		}
		return $classes;
	}
  
    
}