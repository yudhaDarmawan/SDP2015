<?php
/* -----------------------------------------------------
Nama   				: confirmation.php
Pembuat 			: Nancy Yonata
Tanggal Pembuatan 	: 16 November 2015
Edit 				: 27 November 2015

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
            $column = ["nrp","nrp","nama","uts","uas","tugas","nilai_akhir","nilai_akhir_grade","nilai_grade"];
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
		$data['title'] = "Konfirmasi Penilaian";
		$this->load->helper('form');
		$data['ddYear'] = $this->class_model->getComboBoxAllYear();
		$data['selectedDdYear'] = str_replace('/','-',str_replace(' ','_',$this->class_model->getActiveTermYear()));
        $this->load->view('includes/headerdosen', $data);
        $this->load->view('nav/navbardosen');
		$this->load->view('confirmation/confirmation_portal_view', $data);
		$this->load->view('includes/footer');
	}
	
    /**
     * Function : view()
     * Mengeload Halaman Detail Kelas Yang Diajar
     * @param $class_id (string) ID dari Kelas yang ingin dilihat.
     */
    public function view($class_id, $lecturer_login){
		$this->load->helper('form');
		$this->load->library('table');

        if (!$this->class_model->isClassExist($class_id)){
            $this->session->set_flashdata('alert_level','danger');
            $this->session->set_flashdata('alert','Tidak ditemukan kelas dengan ID tersebut!');
            redirect('confirmation/all');
        }

		$class = $this->class_model->getClassInfoById($class_id, $lecturer_login);
		$data['title'] = "Konfirmasi Nilai ".$class[0];
		$data['class'] = $class;
        $this->load->model('revision_model');
        if ($class[10] == "3") {
            $this->load->model('revision_model');
            $data['revisions'] = $this->revision_model->getRevisionByClass($class_id);
        }
        $data['classId'] = $class_id;
		$data['tahun_ajaran'] = $class[11];
		// untuk isi tabel data mata kuliah

        if ($this->input->post('btnAcceptRevision')){
            $this->confirmation_model->approveRevision($this->input->post('revision_id'), $class_id);
            $this->confirmation_model->IPSCounting($class_id, $class[11]);
            $this->confirmation_model->IPKCounting($class_id);
            $this->session->set_flashdata('alert_level','success');
            $this->session->set_flashdata('alert','Berhasil Menyetujui Revisi');
            redirect('confirmation/view/'.$class_id.'/'.$lecturer_login);
        }
        if ($this->input->post('btnRejectRevision')){
            $this->confirmation_model->rejectRevision($this->input->post('revision_id'));
            $this->session->set_flashdata('alert_level','success');
            $this->session->set_flashdata('alert','Berhasil Menolak Revisi');
            redirect('confirmation/view/'.$class_id.'/'.$lecturer_login);
        }
		$this->table->add_row('Mata Kuliah / Kelas / SKS :&nbsp;&nbsp;',':',$class[0].' / '.$class[3].' / '. $class[8].' SKS');
        $this->table->add_row('Jurusan / Semester &nbsp;&nbsp;',':', $class[1].' / '. $class[9]);
        $this->table->add_row('Ruang / Hari, Jam  ',':', $class[5].' / '.$class[4]);
        $this->table->add_row('Dosen  ',':', $class[7]);
        $this->table->add_row('Tahun Ajaran  ',':', $class[11]);
        $this->table->add_row('Status Penilaian ',':', $class[6]);
        $this->table->add_row('Terakhir Update ',':', $class[16]);
		$this->load->view('includes/headerdosen', $data);
        $this->load->view('nav/navbardosen');
		$this->load->view('confirmation/confirmation_detail_view', $data);
		$this->load->view('includes/footer');
	}
	
	public function sendComment(){
		/*
		kalau klik button konfirmasi:
		update di table kelas status_conf, komen_kajur
		status : 0 not complete
				 1 waiting
				 2 need revision	: jika kajur tidak setuju dengan nilai mata kuliah tersebut
				 3 complete  		: jika kajur sudah konfirmasi nilai mata kuliah tersebut
		*/
		$comments =  $this->input->post('comment_kajur');
		$classID = $this->input->post('hidden_classId');
		$termYear = $this->input->post('hidden_tahunAjaran');
		
		if($this->input->post('btnKonfirmasi') == true){
			$statusConf = 3;
			$this->confirmation_model->IPSCounting($classID, $termYear);
			$this->confirmation_model->IPKCounting($classID);
		}
		else if($this->input->post('btnTidakSetuju') == true){
			$statusConf = 2;
		}
		//menyimpan commentar kajur ke database
		$this->confirmation_model->sendComment($classID, $comments, $statusConf);
		
		// kembali ke page confirmation_portal_view
		redirect('confirmation/index');
	}
}
?>