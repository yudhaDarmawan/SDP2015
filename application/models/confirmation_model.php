<?php
/* -----------------------------------------------------
Nama   				: confirmation_model.php
Pembuat 			: Nancy Yonata
Tanggal Pembuatan 	: 16 November 2015
Edit 				: 27 November 2015

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
	
	public function getNamaDosen($id){
		$this->db->select('nama');
		$this->db->from('dosen');
		$this->db->where('nip', $id);
		$result = $this->db->get()->row()->nama;
		return $result;
	}
	
	
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
	
	public function getDataTableForAllMatkul($orders, $yearNow){
		$this->db->select('k.id as id, mk.id as kode_mk,mk.jumlah_sks as sks, mk.nama as nama_mk ');
		$this->db->from('mata_kuliah mk, kelas k, dosen d, informasi_kurikulum ik');
		$this->db->where('k.tahun_ajaran',$yearNow);
		$this->db->where('d.nip = k.dosen_nip');
		$this->db->where('mk.id = k.mata_kuliah_id');
		$this->db->where('ik.id = mk.informasi_kurikulum_id');
		$this->db->join('ruangan r', 'r.id = k.ruangan_id','left');
		$this->db->where('k.status',1);		
		$this->db->group_by('kode_mk');
		if ($orders != null){
			foreach ($orders as $key => $value){
				$this->db->order_by($key, $value);
			}
		}
		$results = $this->db->get()->result();
		$classes = [];
		foreach ($results as $result){
			$class = [];
			$class[] = $result->kode_mk;
			$class[] = $result->sks;
			$class[] = $result->nama_mk;
			$percentage = $this->getPercentageClass($result->id);
			
			$class[] = $percentage["A"];
			$class[] = $percentage["B"];
			$class[] = $percentage["C"];
			$class[] = $percentage["D"];
			$class[] = $percentage["E"];
			$classes[] = $class;
		}
		return $classes;
	}
	
	public function getDataTableReportByLecturer($idDosen, $orders, $yearNow ){
		// Mengambil Data Kelas yang di ajar oleh lecturer
		$this->db->select('k.id as id, mk.id as kode_mk, mk.nama as nama_mk, mk.jumlah_sks as sks');
		$this->db->from('mata_kuliah mk, kelas k,informasi_kurikulum ik');
		$this->db->where('k.dosen_nip',$idDosen);
		$this->db->where('k.tahun_ajaran',$yearNow);
		$this->db->where('mk.id = k.mata_kuliah_id');
		$this->db->where('mk.informasi_kurikulum_id = ik.id');
		$this->db->join('ruangan r', 'r.id = k.ruangan_id','left');
		$this->db->where('k.status',1);
		
		foreach ($orders as $key => $value){
			$this->db->order_by($key, $value);
		}
		$results = $this->db->get()->result();
		$classes = [];
		foreach ($results as $result){
			$class = [];
			$class[] = $result->kode_mk;
			$class[] = $result->sks;
			$class[] = $result->nama_mk;
			$percentage = $this->getPercentageClass($result->id);
			
			$class[] = $percentage["A"];
			$class[] = $percentage["B"];
			$class[] = $percentage["C"];
			$class[] = $percentage["D"];
			$class[] = $percentage["E"];
			$classes[] = $class;
		}
		return $classes;
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
	
	public function sendComment($classID, $comments, $statusConf){
		/*
		update di table kelas status_conf, komen_kajur
		0 not complete
		1 waiting
		2 need revision
		3 complete
		*/
		$data= array(
			'status_konfirmasi'=>$statusConf,
			'komentar_kajur' => $comments	
		);
		$this->db->where('id', $classID);
		$this->db->update('kelas', $data);
		
	}
	
	
	/*======================================================
	function insertStudentScore :
	untuk melakukan convert grade nilai setiap mahasiswa
	untuk matkul yang telah di konfirmasi oleh kajur
	lalu akan melakukan perhitungan ulang nilai ips 
	setiap suatu nilai matkul di konfirmasi oleh kajur
	dan akan melakukan update pada tabel nilai_semester
	=========================================================*/
	public function IPSCounting($classId, $termYear){
		//select jumlah SKS nya dulu
		echo "classId: ".$classId."<br>";
		
		//select id mata kuliah
		$this->db->select('mata_kuliah_id');
		$this->db->from('kelas');
		$this->db->where('id', $classId);
		$resultMatkulId = $this->db->get()->result();
		
		foreach($resultMatkulId as $rowId){
			$matkulId = $rowId->mata_kuliah_id;
		}
		//ambil jumlah sks matkul itu
		$this->db->select('jumlah_sks');
		$this->db->from('mata_kuliah');
		$this->db->where('id', $matkulId);
		$resultJumlahSks = $this->db->get()->result();
		foreach($resultJumlahSks as $jml){
			$jumlahSks = $jml->jumlah_sks;
		}
		// mengambil semua nrp mahasiswa dan semester nya pada kelas tersebut
		$class = $this->class_model->getAllClassConnected($classId);
		$this->db->select('mahasiswa_nrp, semester');
		$this->db->from('kelas_mahasiswa');
		$this->db->where_in('kelas_id',$class);
		$resultAllNrp = $this->db->get()->result_array();
		
		foreach($resultAllNrp as $rowNrp){
			// memproses nilai untuk setiap mahasiswa yg ada
			$nrp = $rowNrp['mahasiswa_nrp'];
			$semester = $rowNrp['semester'];
			
			echo "NRP: ".$nrp."<br>"; 
			//select nilai id sesuai dengan semester saat ini	
			$this->db->select('nilai_id');
			$this->db->from('kelas_mahasiswa');
			$this->db->where('mahasiswa_nrp', $nrp);
			$this->db->where('semester', $semester);
			$this->db->where('kelas_id', $classId);
			$resultNilaiId = $this->db->get()->result();
			
			foreach($resultNilaiId as $row){
				$nilai_id = $row->nilai_id;
			}
			echo "nilai_id:".$nilai_id."<br>";
			
			$this->db->select('nilai_grade');
			$this->db->from('nilai n, kelas_mahasiswa km');
			$this->db->where('km.nilai_id = n.id');
			$this->db->where('km.mahasiswa_nrp', $nrp);
			$this->db->where('km.semester', $semester);
			$this->db->where('n.id', $nilai_id);
			$this->db->where('km.kelas_id', $classId);
			$resultNilaiGrade = $this->db->get()->result();
			
			foreach($resultNilaiGrade as $row){
				$nilaiGrade = $row->nilai_grade;
				echo "nilaiGrade: ".$nilaiGrade."<br>";
				 
				if($nilaiGrade == "A"){
					$selectIndex = "valnilai_A_to_IPK";
				}
				else if($nilaiGrade == "B+"){
					$selectIndex = "valnilai_B+_to_IPK";
				}
				else if($nilaiGrade == "B"){
					$selectIndex = "valnilai_B_to_IPK";
				}
				else if($nilaiGrade == "C+"){
					$selectIndex = "valnilai_C+_to_IPK";
				}
				else if($nilaiGrade == "C"){
					$selectIndex = "valnilai_C_to_IPK";
				}
				else if($nilaiGrade == "D"){
					$selectIndex = "valnilai_D_to_IPK";
				}
				else if($nilaiGrade == "E"){
					$selectIndex = "valnilai_E_to_IPK";
				}
				
				echo "selectIndex: ".$selectIndex; 
				$this->db->select('value');
				$this->db->from('data_umum');
				$this->db->where('index', $selectIndex);
				$resultValueNilaiGrade = $this->db->get()->result();
				
				//hitung hasil nilai u. grade nilai yg didapat dri suatu matkul (Convert nilai_grade)
				foreach($resultValueNilaiGrade as $row){
					$value = $row->value;
					echo "value: ".$value."<br>";
					
					if($value == "4.00"){
						$countValueGradeSubject = 4 * $jumlahSks;
					}
					else if($value == "3.75"){
						$countValueGradeSubject = 3.75 *$jumlahSks;

					}
					else if($value == "3.50"){
						$countValueGradeSubject = 3.5 *$jumlahSks;

					}
					else if($value == "3.25"){
						$countValueGradeSubject = 3.25 *$jumlahSks;

					}
					else if($value == "3.00"){
						$countValueGradeSubject = 3 *$jumlahSks;
					}
					else if($value == "2.00"){
						$countValueGradeSubject = 2 *$jumlahSks;
					}
					else if($value == "1.00"){
						$countValueGradeSubject = 1 *$jumlahSks;
					}
					echo "countValueGradeSubject:".$countValueGradeSubject."<br>";
					
					$dataNilai = array(
						'value_nilai_grade' => $countValueGradeSubject
					);
					
					$this->db->where('id', $nilai_id);
					$this->db->update('nilai', $dataNilai);
					
					//hitung nilai ips mahasiswa
					//ambil semua nilai_id dri tabel kelas_mahasiswa
					$this->db->select('nilai_id, mata_kuliah_id');
					$this->db->from('kelas_mahasiswa');
					$this->db->where('mahasiswa_nrp', $nrp);
					$this->db->where('semester', $semester);
					$resultAllNilaiId = $this->db->get()->result_array();
					
					//hitung total sks yanng diambil mahasiswa tsb
					$countTotalSks = 0;
					foreach($resultAllNilaiId as $row){
						$mk_id = $row['mata_kuliah_id'];
						$this->db->select('jumlah_sks');
						$this->db->from('mata_kuliah');
						$this->db->where('id', $mk_id);
						$result = $this->db->get()->result();
						foreach($result as $row){
							$countTotalSks += $row->jumlah_sks;
						}
					}

					
					echo "jumlah sks : ".$countTotalSks."<br>";
					// hitung penjumlahan total value_nilai_grade dari semua matkul yang diambil ank tsb
					/* =========================================
						rumus perhitungan ips =  
						total value_nilai_grade : total jumlah sks yg diambil
					=============================================*/
					$total_value_nilai_grade = 0;
					foreach($resultAllNilaiId as $row){
						$this->db->select('value_nilai_grade');
						$this->db->from('nilai');
						$this->db->where('id', $row['nilai_id']);
						$result = $this->db->get()->result();
						foreach($result as $value){
							$total_value_nilai_grade += $value->value_nilai_grade;
						}	
					}
					
					echo "total_value_nilai_grade: ".$total_value_nilai_grade."<br>";
					// hitung IPS 
					$IPS = $total_value_nilai_grade/$countTotalSks;
					echo "IPS: ".$IPS."<br>";
					// insert IPS ke tabel nilai_semester
					// kalau sudah ada datanya lakukan update nilai IPS
					
					//cek apakah data nilai_semester mahasiswa tsb sdh ada / belum di tabel nilai_semester
					$this->db->select('*');
					$this->db->from('nilai_semester');
					$this->db->where('mahasiswa_nrp', $nrp);
					$this->db->where('semester', $semester);
					$this->db->where('tahun_ajaran', $termYear);
					$resultNilaiSemester = $this->db->get()->row();
					
					if($resultNilaiSemester != null){
						// kalau ada datanya lakukan update
						$data = array(
							'ips'=>$IPS
						);
						
						$this->db->where('mahasiswa_nrp', $nrp);
						$this->db->where('semester', $semester);
						$this->db->where('tahun_ajaran', $termYear);
						$this->db->update('nilai_semester', $data);
					}
					else{
						// kalau tidak lakukan insert ke tabel nilai_semester
						$data= array(
							'mahasiswa_nrp' => $nrp,
							'semester' => $semester,
							'ips' => $IPS,
							'tahun_ajaran'=>$termYear
						);
						$this->db->insert('nilai_semester', $data);
					}
				}
				
			}
		}
	}
  /*==================================================
	function IPKCounting :
	digunakan untuk menghitung nilai IPK mahasiswa 
	rumus perhitungan IPK :
		
		jumlah total value_nilai_grade / total jumlah sks
		untuk semua semester yang sudah dilalui oleh mahasiswa tersebut	
		
		field value_nilai_grade di dpt dri jumlah sks matkul * bobot nilai_grade
			value_nilai_grade dihitung pada saat perhitungan IPS
			dapat dilihat pada function IPSCounting
  =============================================================================*/
	public function IPKCounting($classId){
		//ambil semua data mahasiswa yang ada di kelas tersebut
		$class = $this->class_model->getAllClassConnected($classId);
		$this->db->select('mahasiswa_nrp');
		$this->db->from('kelas_mahasiswa');
		$this->db->where_in('kelas_id',$class);
		$resultAllNrp = $this->db->get()->result_array();
		
		foreach($resultAllNrp as $row){
			$nrp = $row['mahasiswa_nrp']; 
			
			// ambil semua nilai_id yg dimiliki oleh mahasiswa tsb dri semester awal
			$this->db->select('nilai_id');
			$this->db->from('kelas_mahasiswa');
			$this->db->where('mahasiswa_nrp', $nrp);
			$resultAllNilaiId = $this->db->get()->result_array();
			
			//hitung total value_nilai_grade yang dimiliki oleh mahasiswa tsb
			$totalValueNilaiGrade = 0;
			foreach($resultAllNilaiId as $row){
				$this->db->select('value_nilai_grade');
				$this->db->from('nilai');
				$this->db->where('id', $row['nilai_id']);
				$resultValueNilaiGrade = $this->db->get()->row()->value_nilai_grade;
				
				$totalValueNilaiGrade += $resultValueNilaiGrade;
			}
			
			echo "totalValueNilaiGrade: ".$totalValueNilaiGrade."<br>";
			// hitung total jumlah SKS yang telah diambil oleh mahasiswa tsb
			
			$this->db->select('mata_kuliah_id');
			$this->db->from('kelas_mahasiswa');
			$this->db->where('mahasiswa_nrp', $nrp);
			$resultAllMataKuliahId = $this->db->get()->result_array();
			
			$totalJumlahSKS = 0;
			foreach($resultAllMataKuliahId as $row){
					$this->db->select('jumlah_sks');
					$this->db->from('mata_kuliah');
					$this->db->where('id', $row['mata_kuliah_id']);
					$result = $this->db->get()->row()->jumlah_sks;
					$totalJumlahSKS += $result;	
			}
			
			echo "Total jumlah sks yg telah diambil:".$totalJumlahSKS."<br>";
			
			// hitung IPK
			$IPK = $totalValueNilaiGrade / $totalJumlahSKS;
			echo "IPK: ".$IPK;
			// update field IPK pada tabel mahasiswa
			$dataIPK = array(
				'ipk' => $IPK
			);
			
			$this->db->where('nrp', $nrp);
			$this->db->update('mahasiswa', $dataIPK);
		}
		
	}
    public function rejectRevision($revision_id){
        $this->db->set('tanggal_update', 'now()', false);
        $this->db->where('id', $kelasId);
        $this->db->update('kelas');

        $this->db->set('status_revisi','1'); // ditolak
        $this->db->where('id',$revision_id);
        $this->db->update('hrevisi_penilaian');

        return $this->db->affected_rows();
    }
    public function approveRevision($revision_id, $class_id){
        $this->load->model('grade_model');
        $this->db->set('status_revisi','2'); // ditolak
        $this->db->where('id',$revision_id);
        $this->db->update('hrevisi_penilaian');

        $classes = $this->class_model->getAllClassConnected($class_id);

        $this->db->select('mahasiswa_nrp, nilai_akhir_sesudah');
        $this->db->where('hrevisi_penilaian_id',$revision_id);
        $students = $this->db->get('drevisi_penilaian')->result();
        foreach ($students as $student){
            $this->db->select('nilai_id');
            $this->db->from('kelas_mahasiswa');
            $this->db->where('mahasiswa_nrp', $student->mahasiswa_nrp);
            $this->db->where_in('kelas_id', $classes);
            $nilai_id = $this->db->get()->row()->nilai_id;


            $update_grade = $this->grade_model->countGrade($student->nilai_akhir_sesudah);
            $data = ['nilai_grade' => $update_grade, 'nilai_akhir_grade' => $student->nilai_akhir_sesudah];
            $this->db->where('id',$nilai_id);
            $this->db->update('nilai',$data);
        }

        $this->db->set('tanggal_update', 'now()', false);
        $this->db->where('id', $kelasId);
        $this->db->update('kelas');
    }
	
	public function allDosen(){
		$this->db->select('*');
		$this->db->from('dosen');
		return $this->db->get()->result_array();
	}
	public function getDosenId($ddDosen){
		$this->db->select('nip');
		$this->db->from('dosen');
		$this->db->where('nama', $ddDosen);
		$result = $this->db->get()->row()->nip;
		return $result;
	}
	
	 public function getPercentageClass($classId){

        $this->db->where('kelas_id',$classId);
        $total = $this->db->get('kelas_mahasiswa')->num_rows();
        $totalIPS = 0;
        $percentage = [];
        $percentage["A"] = 0;
        $percentage["B"] = 0;
        $percentage["C"] = 0;
        $percentage["D"] = 0;
        $percentage["E"] = 0;
        $ipdosen = 0;
        foreach ($percentage as $key => $value){
            $this->db->from('kelas_mahasiswa km , nilai  n');
            $this->db->where('km.kelas_id',$classId);
            $this->db->where('km.nilai_id = n.id');
            $this->db->like('n.nilai_grade',$key);
            $num = $this->db->get()->num_rows();

            $this->db->select('value as nilai');
            $this->db->where('index','valnilai_'.$key.'_to_IPK');
            $this->db->from('data_umum');
            $convert = $this->db->get()->row()->nilai;
            if ($num != 0) {
                $percentage[$key] = round($num / $total * 100, 1);
            }
            $ipdosen += $num * $convert;
        }
        if($ipdosen != 0) {
            $ipdosen = round($ipdosen / $total, 2);
        }
       //$percentage["IP Dosen"] = $ipdosen;
        return $percentage;
    }
	
	
	
	
}