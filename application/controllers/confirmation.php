<?php
/* -----------------------------------------------------
Nama   				: confirmation.php
Pembuat 			: Nancy Yonata
Tanggal Pembuatan 	: 16 November 2015
Version Control		:
v0.1 - 7 Januari 2015
	
----------------------------------------------------- */
class Confirmation extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('confirmation_model');
		$this->load->model('class_model');
		$this->load->helper('url');
		$this->load->library('session');
		
		// Mengecek session kalau yang bisa akses hanya login
	}
	public function index(){
	
        redirect('confirmation/all');
    }
    public function ajax_class($yearNow =null)
    {
		
		if ($yearNow == null){
			$yearNow  = $this->class_model->getActiveTermYear();
		}
		else {
			$yearNow  = str_replace('_',' ',$yearNow);
			$yearNow  = str_replace('-','/',$yearNow);
		}
		// Load Data Kelas
		if(isset($_POST['order'])){
			$column = ["nama_mk","nama_dosen", "sks", "hari", "nama_ruang", "status_k", "tanggal_update"];
			$orders = array ($column[$_POST['order']['0']['column']] => $_POST['order']['0']['dir']);
        }
		else {
			$orders = null;
		}
		
		$limit = $this->input->post('length');
		$start = $this->input->post('start');
		$classes = $this->confirmation_model->getDataTableByLecturer($orders, $yearNow,$limit,$start);
		
        $output = array("recordsTotal" => $this->confirmation_model->countAll($yearNow), 
						"recordsFiltered" => $this->confirmation_model->countAll($yearNow),
						"data" => $classes);
		
        // Print Output Berupa JSON
        echo json_encode($output);
    }
	
    public function ajax_score($classId){

        // Load Data Kelas
        if(isset($_POST['order'])){
            $column = ["nrp","nama","uts","uas","tugas","nilai_akhir","nilai_akhir_grade","nilai_grade"];
            $orders = array ($column[$_POST['order']['0']['column']] => $_POST['order']['0']['dir']);
        }
        else {
            $orders = null;
        }
        $this->load->model('grade_model');
        
		$students = $this->grade_model->getDatatableScoreOfClass($classId,$orders);
        
		$output = array("recordsTotal" => $this->grade_model->countAllStudentInClass($classId),
            "recordsFiltered" => $this->grade_model->countAllStudentInClass($classId),
            "data" => $students);

        // Print Output Berupa JSON
        echo json_encode($output);
    }
	
    /**
     * Function : all()
     * Mengeload Halaman Mata Kuliah Yang Diajar milik Dosen
     */
    public function all(){
		$data['title'] = "Mata Kuliah yang Diajar";
		$this->load->helper('form');
		$data['ddYear'] = $this->class_model->getComboBoxAllYear();
		$data['selectedDdYear'] = str_replace('/','-',str_replace(' ','_',$this->class_model->getActiveTermYear()));
		$this->load->view('header',$data);
		$this->load->view('confirmation/confirmation_portal_view', $data);
		$this->load->view('footer');
	}
	
	
	
	

    /**
     * Function : view()
     * Mengeload Halaman Detail Kelas Yang Diajar
     * @param $class_id (string) ID dari Kelas yang ingin dilihat.
     */
    public function view($class_id, $lecturer_login){

		$this->load->helper('form');
		$this->load->library('table');
		
		$class = $this->class_model->getClassInfoById($class_id, $lecturer_login);
		
		
		$data['title'] = "Detail ".$class[0];
		$data['class'] = $class;
        $data['classId'] = $class_id;
		// Siapkan Data Kelas
		/*
		$ctr =0;
		foreach($class as $kelas){
			echo "class[".$ctr."]:".$kelas."<br>";
			$ctr += 1;
		}*/
		
		/*
		contoh isi data array class :
		class[0]:MK003
		class[1]:3
		class[2]:Internet dan World Wide Web
		class[3]:Stefanie
		class[4]:Senin
		class[5]:10:30 - 13:00
		class[6]:B302
		class[7]:Not Completed
		class[8]:-
		class[9]:Stefanie
		class[10]:3
		class[11]:1
		class[12]:0
		class[13]:GASAL 2014/2015
		class[14]:0
		class[15]:30
		class[16]:30
		class[17]:40
		class[18]:2015-11-12 21:56:58
		*/

        $this->table->add_row('Mata Kuliah / Kelas / SKS :&nbsp;&nbsp;',':',$class[0].' / '.$class[3].' / '. $class[8].' SKS');
        $this->table->add_row('Jurusan / Semester &nbsp;&nbsp;',':', $class[1].' / '. $class[9]);
        $this->table->add_row('Ruang / Hari, Jam  ',':', $class[5].' / '.$class[4]);
        $this->table->add_row('Dosen  ',':', $class[7]);
        $this->table->add_row('Tahun Ajaran  ',':', $class[11]);
        $this->table->add_row('Status Penilaian ',':', $class[6]);
        $this->table->add_row('Terakhir Update ',':', $class[16]);
		$this->load->view('header', $data);
		$this->load->view('confirmation/confirmation_detail_view', $data);
		$this->load->view('footer');
		
	}

	
}
?>