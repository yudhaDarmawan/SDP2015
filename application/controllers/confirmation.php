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
        if($this->session->userdata('user_role') != 'kajur'){
            redirect('/');
        }
	}
	public function index(){
		redirect('confirmation/all');
    }
	
	public function page_prosentase(){
		$data['pilihan'] = ['Prosentase Nilai Setiap Dosen', 'Prosentase Nilai Semua Mata Kuliah'];
		$data['ddYear'] = $this->class_model->getComboBoxAllYear();
		$data['selectedDdYear'] = str_replace('/','-',str_replace(' ','_',$this->class_model->getActiveTermYear()));
        
		$this->load->view('includes/header', $data);
		$this->load->view('report/portal_printProsentase', $data);
		$this->load->view('includes/footer');

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
	public function ajax_prosentaseDosen($idDosen){
		//$this->session->set_userdata('namaDosen', $ddDosen);
		$yearNow = $this->session->userdata('year');
		
		// Load Data Kelas
		if(isset($_POST['order'])){
			$column = ["kode_mk","sks","nama_mk", "A", "B", "C", "D", "E"];
			$orders = array ($column[$_POST['order']['0']['column']] => $_POST['order']['0']['dir']);
        }
		else {
			$orders = null;
		}
		
		$classes = $this->confirmation_model->getDataTableReportByLecturer($idDosen, $orders, $yearNow );
		
		// sampai sini benar
		$output = array("recordsTotal" => $this->class_model->countAll($idDosen), 
						"recordsFiltered" => $this->class_model->countFiltered($idDosen, $orders , $yearNow),
						"data" => $classes);
		
        // Print Output Berupa JSON
        echo json_encode($output);		
		
	}
	
	public function ajax_prosentaseMatkul()
    {
		$yearNow = $this->session->userdata('year');
		// Load Data Kelas
		if(isset($_POST['order'])){
			$column = ["kode_mk","sks","nama_mk", "A", "B", "C", "D", "E"];
			$orders = array ($column[$_POST['order']['0']['column']] => $_POST['order']['0']['dir']);
        }
		else {
			$orders = null;
		}
		$classes = $this->confirmation_model->getDataTableForAllMatkul($orders, $yearNow);
		
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
        $this->load->view('includes/header', $data);
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
		$this->load->view('includes/header', $data);
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
	
	public function reportProsentase(){
		//echo $this->input->post('pilihan');
		
		if($this->input->post('pilihan') == "0"){
			$year  = str_replace('_',' ',$this->input->post('ddYear'));
			$yearNow  = str_replace('-','/',$year);
			$this->session->set_userdata('year', $yearNow);
			
			$arrDosen = [];
			$allDosen = $this->confirmation_model->allDosen();
			foreach($allDosen as $row){
				$arrDosen [$row['nip']] = $row['nama'];
			}
			
			//coba kluarkan isi data
			//$this->ajax_prosentaseDosen($arrDosen[]);
			
			$data['Dosen'] = $arrDosen;
			$data['selectedDosen'] = '';
			$this->load->view('includes/header', $data);
			$this->load->view('report/reportProsentaseDosen_view', $data);
			$this->load->view('includes/footer');
			
		}
		else if($this->input->post('pilihan') == "1"){ 
			// prosentase semua nilai matkul
			$year  = str_replace('_',' ',$this->input->post('ddYear'));
			$yearNow  = str_replace('-','/',$year);
			$this->session->set_userdata('year', $yearNow);
			
			$this->load->view('includes/header');
			$this->load->view('report/reportProsentaseMatkul_view');
			$this->load->view('includes/footer');
			
		}
		
		
	}
	public function printToPDFPercentageDosen(){
		
		$idDosen = $this->input->post('ddDosen');
		$data['title'] = "Report Prosentase Penilaian Dosen";
		$data['namaDosen'] = $this->confirmation_model->getNamaDosen($this->input->post('ddDosen'));
		$data['year'] = $this->session->userdata('year');
		
		// Load Data Kelas
		if(isset($_POST['order'])){
			$column = ["kode_mk","sks","nama_mk", "A", "B", "C", "D", "E"];
			$orders = array ($column[$_POST['order']['0']['column']] => $_POST['order']['0']['dir']);
		}
		else {
			$orders = null;
		}
		$allDataTable =  $this->confirmation_model->getDataTableReportByLecturer($idDosen, $orders, $data['year']);
		$table = "<table autosize='1.6' border='1' cellspacing='0' width='100%' cellpadding='5'>";
		$table.= "<thead>
					<tr style='background:yellow'>
						<td>KODE MK</td>
						<td>SKS</td>
						<td>NAMA MATA KULIAH</td>
						<td>A</td>
						<td>B</td>
						<td>C</td>
						<td>D</td>
						<td>E</td>
					</tr>
				  </thead>";
		foreach($allDataTable as $row){
			$table .= "<tr>";
			$table .= "<td>".$row[0]."</td>";
			$table .= "<td>".$row[1]."</td>";
			$table .= "<td>".$row[2]."</td>";
			$table .= "<td>".$row[3]."%</td>";
			$table .= "<td>".$row[4]."%</td>";
			$table .= "<td>".$row[5]."%</td>";
			$table .= "<td>".$row[6]."%</td>";
			$table .= "<td>".$row[7]."%</td>";
			$table .= "</tr>";
		}
		$table .= "</table>";
		
		$data['dataTable'] = $table;
		$pdfFilePath = "print_report_prosentase_nilai_dosen.pdf";
		$this->load->library('m_pdf');
	
		$pdf = $this->m_pdf->load();

		//generate the PDF!
		$html = $this->load->view('report/report_prosentaseLecture',$data,true);
		$header =$this->load->view('report/includes/headerReport',$data,true);
		$pdf->WriteHTML($header.$html);
		$pdf->Output($pdfFilePath, "I");
	}
	public function printToPDF_PercentageMatkul(){
		$yearNow = $this->session->userdata('year');
		$data['title'] = "Report Prosentase Nilai Mata Kuliah";
		$data['year'] = $yearNow;
		// Load Data Kelas
		if(isset($_POST['order'])){
			$column = ["kode_mk","sks","nama_mk", "A", "B", "C", "D", "E"];
			$orders = array ($column[$_POST['order']['0']['column']] => $_POST['order']['0']['dir']);
        }
		else {
			$orders = null;
		}
		
		$allDataTable = $this->confirmation_model->getDataTableForAllMatkul($orders, $yearNow);
		$table = "<table autosize='1.6' border='1' cellspacing='0' width='100%' cellpadding='5'>";
		$table.= "<thead>
					<tr style='background:yellow'>
						<td>KODE MK</td>
						<td>SKS</td>
						<td>NAMA MATA KULIAH</td>
						<td>A</td>
						<td>B</td>
						<td>C</td>
						<td>D</td>
						<td>E</td>
					</tr>
				  </thead>";
		foreach($allDataTable as $row){
			$table .= "<tr>";
			$table .= "<td>".$row[0]."</td>";
			$table .= "<td>".$row[1]."</td>";
			$table .= "<td>".$row[2]."</td>";
			$table .= "<td>".$row[3]."%</td>";
			$table .= "<td>".$row[4]."%</td>";
			$table .= "<td>".$row[5]."%</td>";
			$table .= "<td>".$row[6]."%</td>";
			$table .= "<td>".$row[7]."%</td>";
			$table .= "</tr>";
		}
		$table .= "</table>";
		
		$data['dataTable'] = $table;
		$pdfFilePath = "print_report_prosentase_nilai_matkul.pdf";
		$this->load->library('m_pdf');
	
		$pdf = $this->m_pdf->load();

		//generate the PDF!
		$html = $this->load->view('report/report_prosentaseMatkul',$data,true);
		$header =$this->load->view('report/includes/headerReport',$data,true);
		$pdf->WriteHTML($header.$html);
		$pdf->Output($pdfFilePath, "I");
		
	}
	
}
?>