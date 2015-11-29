<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Revision
 * Nama   				: revision.php
 * Pembuat 				: Melania Laniwati
 * Tanggal Pembuatan 	: 20 November 2015
 * Version Control		:
 * v0.1 - 20 November 2015
 * - Menambahkan fungsi revisi
 * v0.2 - 22 November 2015
 * - Menambahkan fungsi student_transcript untuk mahasiswa lihat transkrip nilai
 * - Menambahkan fungsi student_grade untuk mahasiswa lihat nilai per semester
 */

Class Revision extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		
		$this->load->helper('form');
		$this->load->helper('cookie');
		$this->load->helper('url');
		
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->library('table');
		$this->load->library('m_pdf');
		
		$this->load->model('class_model');
		$this->load->model('grade_model');
		$this->load->model('revision_model');
	}
	
	public function index(){
		//$this->revisi('K15001');
		//$this->student_transcript('213116256');
		//$this->student_grade('213116256');
	}
	
	public function revisi(){
		// to indicate if revision is done and you should move to other page
		$done = FALSE;
		
		$data['title'] = "Revisi Penilaian";
		
		$data['class_id'] = $this->session->userdata('class_id');
		
		// get data from form
		$data['how_many'] = $this->input->post('how_many');
		$data['comment'] = $this->input->post('comment');
		
		// get all students
		$data['students'] = $this->revision_model->getComboBoxStudents($data['class_id']);
		
		// Cek SESSION lecturer_login dengan pemilik kelas
		$data['lecturer_login'] = $this->input->post('lecturer_login');
		
		// get class' information from database
        $this->load->model('class_model');
		$data['class'] = $this->class_model->getClassInfoById($data['class_id'], $data['lecturer_login']);
		// insert input from dosen (from form) into variables
		for ($i = 0; $i < $data['how_many']; $i++){
			$nrp = "combo_nrp_" . $i;
			$old_score = "old_score_" . $i;
			$new_score = "new_score_" . $i;
			
			$data['input'][$nrp] = $this->input->post($nrp); 
			$data['input'][$old_score] = $this->input->post($old_score);
			$data['input'][$new_score] = $this->input->post($new_score);
		}
		
		if ($this->input->post('add_row')){
			$data['how_many']++;
			
			// set defualt value for the added new row
			$nrp = "combo_nrp_" . ($data['how_many'] - 1);
			$old_score = "old_score_" . ($data['how_many'] - 1);
			$new_score = "new_score_" . ($data['how_many'] - 1);
			
			$data['input'][$nrp] = NULL;
			$data['input'][$old_score] = NULL;
			$data['input'][$new_score] = NULL;
		} 
		
		else if ($this->input->post('send_revision')){
			// generate new id for new data that is going to be inserted into HRevisi and DRevisi
			$hrevisi_id = $this->revision_model->generateNewIdForHrevisi();
			
			// insert into HRevisi
			$this->revision_model->insertDataToHrevisi($hrevisi_id, $data['class_id'], $data['comment']);
			
			for ($i = 0; $i < $data['how_many']; $i++) {
				$nrp = "combo_nrp_" . $i;
				$old_score = "old_score_" . $i;
				$new_score = "new_score_" . $i;
				
				// insert into DRevisi (for every nrp)
				if ($data['input'][$nrp] != "") $this->revision_model->insertDataToDrevisi($hrevisi_id, $data['input'][$nrp], $data['input'][$old_score], $data['input'][$new_score]);
			}
			
			// change class' status into waiting -> 2
			$this->grade_model->changeConfirmationStatus($data['class_id'], '2');
			
			// send notification to kajur -> insert into table notification
			//$this->revision_model->insertDataToNotifikasi($data['class_id'], $data['lecturer_login']);
			
			$done = TRUE;
		} 
		
		else if ($this->input->post('print')){
			//load the view, pass the variable and do not show it but "save" the output into variable
			$html = $this->load->view('report/report_revision', $data, TRUE);
			$header =$this->load->view('report/includes/headerReport', $data, TRUE);
			
			// you can pass mPDF parameter on this load() function
			$pdf = $this->m_pdf->load();
			
			// generate the PDF
			$pdf->WriteHTML($header.$html);
			
			// this the the PDF filename that user will get to download
			$pdf_filename = "Revisi Penilaian " . $data['class_id'] . ".pdf";
			
			// offer to user via browser download (PDF won't be saved on your server)
			$pdf->Output($pdf_filename, "I");
		}
		
		// the controller loads for the first time
		else {
			// set default value
			$data['how_many'] = 3;
			$data['comment'] = NULL;
			$data['input'] = NULL;
			$data['lecturer_login'] = 'DO001';
		}
		
		if (!$done){
			// load views
			$this->load->view('includes/headerdosen', $data);
	        $this->load->view('nav/navbardosen');
			$this->load->view('grade/grade_revision', $data);
			$this->load->view('includes/footer');
		} else {
			$this->success();
		}
	}
	
	public function success() {
		$data['title'] = "Success";
		
		$this->load->view('includes/headerdosen', $data);
        $this->load->view('nav/navbardosen');
		$this->load->view('grade/success');
		$this->load->view('includes/footer');
	}
	
	public function student_transcript($nrp){
		$data['title'] = "Transkrip nilai sementara";
		
		$data['nrp'] = $nrp;
		$data['nama'] = "Raymond Wongso Hartanto";
		
		$data['ipk'] = $this->revision_model->getStudentIPK($data['nrp']);
		$data['total_sks'] = $this->revision_model->getStudentSKS($data['nrp']);
		
		$data['angkatan'] = $this->revision_model->getStudentYear($data['nrp']);
		$data['tahun_ajaran_sekarang'] = $this->revision_model->getCurrentSchoolYear();
		
		$data['jumlah_semester'] = $this->get_jumlah_semester($data['angkatan']);
		
		$taken_classes = $this->revision_model->getTakenClasses($data['nrp']);
		
		for ($i = 1; $i <= $data['jumlah_semester']; $i++){
			$data['semester'][$i] = NULL;
			
			// isi variable data untuk tiap semester-nya
			for ($j = 0; $j < count($taken_classes); $j++){
				// cek data di taken_classes, apakah semester-nya sesuai
				if ($taken_classes[$j]['semester'] == $i){
					$data['semester'][$i]['data']['id'] = $taken_classes[$j]['id'];
					$data['semester'][$i]['data']['nama'] = $taken_classes[$j]['nama'];
					$data['semester'][$i]['data']['jumlah_sks'] = $taken_classes[$j]['jumlah_sks'];
					$data['semester'][$i]['data']['nilai_grade'] = $taken_classes[$j]['nilai_grade'];
				}
			}
		}
		
		$this->load->view('includes/header', $data);
        $this->load->view('nav/navbarmahasiswa');
		$this->load->view('grade/student_transcript', $data);
		$this->load->view('includes/footer');
	}
	
	public function student_grade($nrp){
		$data['title'] = "Nilai Semester";
		
		$data['nrp'] = $nrp;
		$data['nama'] = "Raymond Wongso Hartanto";
		
		$data['ipk'] = $this->revision_model->getStudentIPK($data['nrp']);
		$data['total_sks'] = $this->revision_model->getStudentSKS($data['nrp']);
		
		$data['angkatan'] = $this->revision_model->getStudentYear($data['nrp']);
		$data['tahun_ajaran_sekarang'] = substr($this->revision_model->getCurrentSchoolYear(), 11, 4);
		
		$data['jurusan'] = $this->revision_model->getStudentCourse($data['nrp']);
		$data['jumlah_semester'] = $this->get_jumlah_semester($data['angkatan']);
		
		$taken_classes = $this->revision_model->getTakenClasses($data['nrp']);
		
		for ($i = 1; $i <= $data['jumlah_semester']; $i++){
			$data['semester'][$i] = NULL;
			
			// isi variable data untuk tiap semester-nya
			for ($j = 0; $j < count($taken_classes); $j++){
				// cek data di taken_classes, apakah semester-nya sesuai
				if ($taken_classes[$j]['semester'] == $i){
					$data['semester'][$i]['data']['id'] = $taken_classes[$j]['id'];
					$data['semester'][$i]['data']['nama'] = $taken_classes[$j]['nama'];
					$data['semester'][$i]['data']['uts'] = $taken_classes[$j]['uts'];
					$data['semester'][$i]['data']['uas'] = $taken_classes[$j]['uas'];
					$data['semester'][$i]['data']['tugas'] = $taken_classes[$j]['nilai_grade'];
					$data['semester'][$i]['data']['nilai_akhir_grade'] = $taken_classes[$j]['nilai_grade'];
					$data['semester'][$i]['data']['nilai_grade'] = $taken_classes[$j]['nilai_grade'];
				}
			}
		}
		
		$this->load->view('includes/header', $data);
        $this->load->view('nav/navbarmahasiswa');
		$this->load->view('grade/student_grade', $data);
		$this->load->view('includes/footer');
	}
	
	private function get_jumlah_semester($angkatan){
		$selisih_tahun = date('Y') - $angkatan + 1;
		
		$jumlah_semester = $selisih_tahun * 2;
		
		if (date('n') < 8){
			// sekarang masih semester gasal
			$jumlah_semester -= 1;
		}
		
		return $jumlah_semester;
	}
}

?>