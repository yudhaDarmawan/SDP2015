<?php 

/**
 * Class Grade
 * Nama   				: grade.php
 * Pembuat 			    : Stefanie Tanujaya
 * Tanggal Pembuatan 	: 6 November 2015
 * Version Control		:
 * v0.1 - 7 November 2015
 * Menambahkan fungsi all, ajax_class, dan view.
 * v0.2 - 11 November 2015
 * Menambah fungsi ajax_totalSKS, ajax_grade, saveGrade
 * v0.3 - 18 Novemeber 2015
 * Menambah fungsi ajax_percentage, saveAllGrade
 * v0.4 - 20 November 2015
 * Menambah fungsi printPdf dan perbaikan pada view
 * v0.5 - 27 November 2015
 * Menambhankan fungsi printPdf dengan pilihan
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @property m_pdf $m_pdf
 *
 * Add additional libraries you wish
 * to use in your controllers here
 *
 * @property Class_model $class_model
 * @property Grade_model $grade_model
 * @property Revision_model $revision_model
 *
 */
class Grade extends CI_Controller {

    /**
     * Function : __construct()
     * dipanggil saat setiap kali inisialisasi controller Grade
     */
	public function __construct(){
		parent::__construct();
		$this->load->model('class_model');
        $this->load->model('grade_model');
		$this->load->helper('url');
		$this->load->library('session');

        if($this->session->userdata('user_role') != 'dosen' && $this->session->userdata('user_role') != 'kajur'){
            redirect('/');
        }

	}
    public function index(){
        redirect('grade/all');
    }
    /**
     * Function : ajax_class()
     * Digunakan untuk menghasilkan data JSON kelas berdasarkan
     * lecturer_login [session]
     * @param null $yearNow (string)  Semester dan Tahun_Ajaran
     * yang ingin dilihat
     * @return JSON
     */
    public function ajax_totalSKS($yearNow=null){
        //Mengambil Lecturer Login dari Session yang Ada sekaligus pengecekan
        $lecturer_login = $this->session->userdata('username');

        if ($yearNow == null){
            $yearNow  = $this->data_umum_model->getSemester();
        }
        else {
            $yearNow  = str_replace('_',' ',$yearNow);
            $yearNow  = str_replace('-','/',$yearNow);
        }
        echo $this->class_model->getTotalSKSForLecturer($lecturer_login,$yearNow);
    }

    /**
     * Ajax method
     * Untuk melakukan ajax data kelas yang di ajar oleh dosen tertentu
     * @param null $yearNow
     */
    public function ajax_class($yearNow =null)
    {
		// Mengambil Lecturer Login dari Session Yang Ada
        $lecturer_login = $this->session->userdata('username');
		if ($yearNow == null){
			$yearNow  = $this->data_umum_model->getSemester();
		}
		else {
			$yearNow  = str_replace('_',' ',$yearNow);
			$yearNow  = str_replace('-','/',$yearNow);
		}
		// Load Data Kelas
		if(isset($_POST['order'])){
			$column = [ "nama_mk","jurusan", "sks","nama_kelas", "hari", "nama_ruang", "status_k"];
			$orders = array ($column[$_POST['order']['0']['column']] => $_POST['order']['0']['dir']);
        }
		else {
			$orders = null;
		}
		$classes = $this->class_model->getDataTableByLecturer($lecturer_login, $orders, $yearNow ); 
        $output = array("recordsTotal" => $this->class_model->countAll($lecturer_login), 
						"recordsFiltered" => $this->class_model->countFiltered($lecturer_login, $orders , $yearNow),
						"data" => $classes);
		
        // Print Output Berupa JSON
        echo json_encode($output);
    }

    /**
     * Untuk mengajax ulang persentase kelas
     * @param $classId kelas_id dari kelas tersebut
     */
    public function ajax_percentage($classId){
        $percentage =$this->grade_model->getPercentageClass($classId);
        echo $percentage["A"].' '.$percentage["B"].' '.$percentage["C"].' '.$percentage["D"].' '.$percentage["E"].' '.$percentage["IP Dosen"];
    }

    /**
     * Ajax method
     * Untuk mengajax ulang nilai dan mahasiswa dari suatu kelas
     * @param $classId kelas_id dari kelas yang ingin diketahuo
     */
    public function ajax_grade($classId){

        // Load Data Kelas
        if(isset($_POST['order'])){
            $column = ["nrp","nrp","nama","uts","tugas","uas","nilai_akhir","nilai_akhir_grade","nilai_grade"];
            $orders = array ($column[$_POST['order']['0']['column']] => $_POST['order']['0']['dir']);
        }
        else {
            $orders = null;
        }
        $students = $this->grade_model->getDatatableGradeOfClass($classId,$orders);
        $output = array("recordsTotal" => $this->grade_model->countAllStudentInClass($classId),
            "recordsFiltered" => $this->grade_model->countAllStudentInClass($classId),
            "data" => $students);

        // Print Output Berupa JSON
        echo json_encode($output);
    }

    /**
     * Ajax method
     * Untuk menyimpan nilai dari semua mahasiswa
     * Menerima parameter Post berupa
     * nrp, uts, uas, tugas, log
     */
    public function saveAllGrade(){
        if ($this->input->post('nrp')) {
            $midTerm = $this->input->post('uts');
            $finalTerm = $this->input->post('uas');
            $homework = $this->input->post('tugas');
            $nrp = $this->input->post('nrp');
            $log = $this->input->post('log');
            for ($ctr = 0; $ctr < count($midTerm); $ctr++) {
                $log = $this->grade_model->updateStudentGrade($this->input->post('class_id'),
                    $nrp[$ctr],
                    $midTerm[$ctr],
                    $finalTerm[$ctr],
                    $homework[$ctr], $log);
            }
            $this->session->set_userdata('logClass', $this->input->post('class_id'));
            $this->session->set_userdata('logGrade', $log);
            echo $log;
        }
    }

    /**
     * Ajax method
     * Untuk menyimpan nilai dari seorang mahasiswa
     * menerima parameter post berupa nrp, uts, uas tugas, log
     */
    public function saveGrade(){
        if($this->input->post('nrp')) {
            $log = $this->input->post('log');
            $log = $this->grade_model->updateStudentGrade($this->input->post('class_id'),
                $this->input->post('nrp'),
                $this->input->post('uts'),
                $this->input->post('uas'),
                $this->input->post('tugas'), $log);
            $this->session->set_userdata('logClass', $this->input->post('class_id'));
            $this->session->set_userdata('logGrade', $log);
            echo $log;
        }
    }
    /**
     * Function : all()
     * Mengeload Halaman Mata Kuliah Yang Diajar milik Dosen
     */
    public function all(){
		$data['title'] = "Mata Kuliah yang Diajar";
		$this->load->helper('form');
		$data['ddYear'] = $this->class_model->getComboBoxAllYear();
		$data['selectedDdYear'] = str_replace('/','-',str_replace(' ','_',$this->data_umum_model->getSemester()));
		$this->load->view('includes/header',$data);
		$this->load->view('grade/grade_view', $data);
		$this->load->view('includes/footer');
	}

    /**
     * Function : view()
     * Mengeload Halaman Detail Kelas Yang Diajar
     * @param $classId (string) ID dari Kelas yang ingin dilihat.
     */
    public function view($classId){

		$this->load->helper('form');
		$this->load->library('table');
		
		// Cek SESSION lecturer_login dengan pemilik kelas
		$lecturer_login = $this->session->userdata('username');
		$class = $this->class_model->getClassInfoById($classId, $lecturer_login);
		
		// Jika tidak cocok dengan lecturer_login atau tidak ditemukan class_id
		// maka user akan diredirect ke halaman /grade/all
		if ($class == false){
			$this->session->set_flashdata('alert_level','danger');
			$this->session->set_flashdata('alert','Tidak ditemukan kelas dengan ID tersebut!');
			redirect('grade/all');
		}
	    if($this->input->post('btnRevisi')){
	    	$array_items = array('class_id' => $classId, 'lecturer_login' => $lecturer_login);
	    	$this->session->set_userdata('to_revision', $array_items);
            redirect('revision/revisi/');
        }
        if ($this->input->post('btnSend')){
            $success = $this->grade_model->changeConfirmationStatus($classId,'1');
            if ($success) {
                $this->session->set_flashdata('alert_level', 'success');
                $this->session->set_flashdata('alert', 'Berhasil Mengirim Data Nilai ke kajur!');
                $kajur_id = $this->dosen_model->getKajurId($classId);
                $this->notifikasi_model->sendNotification($this->session->userdata('username'),$kajur_id, $class[7]." telah menyelesaikan penilaian ".$class[0].' / '.$class[3]);
                redirect('grade/view/'.$classId);
            }
            else {
                $this->session->set_flashdata('alert_level','danger');
                $this->session->set_flashdata('alert','Tidak bisa mengirim data nilai ke kajur.');
                redirect('grade/view/'.$classId);
            }
        }
		
		$data['title'] = "Detail ".$class[0];
		$data['class'] = $class;
        if ($class[10] == "3") {
            $this->load->model('revision_model');
            $data['revisions'] = $this->revision_model->getRevisionByClass($classId);
        }
        $data['classId'] = $classId;
		
		// Jika Button Update Grade ditekan
		if ($this->input->post('btnInputGrade')){
			$success = $this->grade_model->updateAdditionalGrade($classId, $this->input->post('inputGrade'));
			if ($success){
				$this->session->set_flashdata('alert_level','success');
				$this->session->set_flashdata('alert','Berhasil Mengupdate Tambahan Grade!');
			}
			else {
				$this->session->set_flashdata('alert_level','danger');
				$this->session->set_flashdata('alert','Gagal Mengupdate Tambahan Grade!');
			}
			redirect('grade/view/'.$classId);
		}
		// Jika Button Update Prosentase Nilai ditekan
		else if ($this->input->post('btnInputPercentage')){
			$sumOfAll = $this->input->post('inputUTS')+$this->input->post('inputUAS')+$this->input->post('inputHomework');
			if ($sumOfAll > 100){
				$this->session->set_flashdata('alert_level','warning');
				$this->session->set_flashdata('alert','Total Prosentase tidak boleh lebih dari 100%!');
			}
			else {

				$success = $this->grade_model->updateGradePercentage($classId, $this->input->post('inputUTS'),$this->input->post('inputUAS'),$this->input->post('inputHomework'));
				
				if ($success){
					$this->session->set_flashdata('alert_level','success');
					$this->session->set_flashdata('alert','Berhasil Mengupdate Prosentase Nilai!');
                    if($sumOfAll < 100){
                        $this->session->set_flashdata('alert_level','warning');
                        $this->session->set_flashdata('alert','Berhasil mengupdate prosentase nilai tetapi jumlah prosentase tidak sampai 100.');
                    }
				}
				else {
					$this->session->set_flashdata('alert_level','danger');
					$this->session->set_flashdata('alert','Gagal Mengupdate Prosentase Nilai!');
				}

			}
			redirect('grade/view/'.$classId);
		}
		
		// Siapkan Data Kelas
        $this->table->add_row('Mata Kuliah / Kelas / SKS :&nbsp;&nbsp;',':',$class[0].' / '.$class[3].' / '. $class[8].' SKS');
        $this->table->add_row('Jurusan / Semester &nbsp;&nbsp;',':', $class[1].' / '. $class[9]);
        $this->table->add_row('Ruang / Hari, Jam  ',':', $class[5].' / '.$class[4]);
        $this->table->add_row('Dosen  ',':', $class[7]);
        $this->table->add_row('Tahun Ajaran  ',':', $class[11]);
        $this->table->add_row('Status Penilaian ',':', $class[6]);
        $this->table->add_row('Terakhir Update ',':', $class[16]);
		$this->load->view('includes/header', $data);
		$this->load->view('grade/detail_grade_view', $data);
		$this->load->view('includes/footer');
	}

    /**
     * Untuk mengeprint data nilai kelas berdasarkan kriteria tertentu
     * @param $classId kelas_id
     */
    public function printPdf($classId){
		$this->load->library('table');
        // Cek Berdasarkan session
		$lecturer_login = $this->class_model->getLecturerIdByClass($classId);
		$class = $this->class_model->getClassInfoById($classId, $lecturer_login);
		$data['title'] = "Penilaian ".$class[0].' / '.$class[3];
		$data['class'] = $class;
		//this data will be passed on to the view
        $this->table->add_row('Mata Kuliah / Kelas / SKS :&nbsp;&nbsp;',':',$class[0].' / '.$class[3].' / '. $class[8].' SKS');
        $this->table->add_row('Jurusan / Semester &nbsp;&nbsp;',':', $class[1].' / '. $class[9]);
        $this->table->add_row('Ruang / Hari, Jam  ',':', $class[5].' / '.$class[4]);
        $this->table->add_row('Dosen  ',':', $class[7]);
        $this->table->add_row('Tahun Ajaran  ',':', $class[11]);
        $this->table->add_row('Status Penilaian ',':', $class[6]);
        $this->table->add_row('Terakhir Update ',':', $class[16]);

        $allow_print = ['uts' => true,'uas' => true, 'tugas' => true, 'nilai_akhir' => true, 'nilai_akhir_grade' => true, 'nilai_grade' => true];
		$data['students'] = $this->grade_model->getDatatableScoreOfClass($classId);
        $data['minGrade'] = $class[18];
        $data['percentage'] = $this->grade_model->getPercentageClass($classId);
        $data['tahun_ajaran']= $class[11];

        if ($this->input->post('btnCetak')){
            if (!$this->input->post('uts')){
               $allow_print['uts'] = false;
            }
            if (!$this->input->post('uas')){
               $allow_print['uas'] = false;
            }
            if (!$this->input->post('tugas')){
               $allow_print['tugas'] = false;
            }
            if (!$this->input->post('nilai_akhir')){
               $allow_print['nilai_akhir'] = false;
            }
            if (!$this->input->post('nilai_akhir_grade')){
               $allow_print['nilai_akhir_grade'] = false;
            }
            if (!$this->input->post('nilai_grade')){
               $allow_print['nilai_grade'] = false;
            }
        }
        $data['allow_data'] = $allow_print;
		$html=$this->load->view('report/report_grade', $data, true);
		$pdfFilePath = "print".$classId.".pdf";
		$this->load->library('m_pdf');
		//actually, you can pass mPDF parameter on this load() function
		$pdf = $this->m_pdf->load();
		$header =$this->load->view('report/includes/headerReport',$data,true);
		//generate the PDF!
		$pdf->WriteHTML($header.$html);
		$pdf->Output($pdfFilePath, "I");
	}

}