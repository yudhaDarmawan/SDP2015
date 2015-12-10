<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Keuangan extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->helper('cookie');
		$this->load->library('session');
		$this->load->library('table');
		$this->load->model('model_tagihan');
		$this->load->model('model_tagihan_join');
		$this->load->model('model_dosen');
		$this->load->model('model_notifikasi');
		$this->load->model('model_calon_mahasiswa');
	}
	
	public function getViewVariable($bol1, $bol2){
		// global variable fungsi.
		$data = [];
		// variable userLoginName untuk nama yang login.
		$data['userLoginName'] = '';
		// boolean untuk atur footer fixed. true jika di fix, false jika tidak fix.
		$data['isFooterFixed'] = $bol1;
		// boolean untuk atur overflow hidden. true jika di hidden, false jika tidak hidden.
		$data['isOverflowHidden'] = $bol2 ;
		// cek jika cookie.
		if($this->input->cookie('userLogin') != ''){
			$data['userLoginName'] = $this->model_karyawan->getEmployeeDatum('nama', 'id', $this->input->cookie('userLogin', true));
		}
		// cek jika session.
		else if($this->session->userdata('userLogin') != ''){
			$data['userLoginName'] = $this->model_karyawan->getEmployeeDatum('nama', 'id', $this->session->userdata('userLogin'));
		}
		
		return $data;
	}
	
	public function index()
	{
		// global variable fungsi.
		$data = [];
		// ambil value untuk variable view.
		$data = $this->getViewVariable(true,true);
		
		// load view.
		$data['currentTab'] = 'awal';
		$this->load->view('header', $data);
		$this->load->view('navbar_keuangan', $data);
		$this->load->view('keuangan_placeholder');
		$this->load->view('footer', $data);
	}
	
	public function pembayaran_upp(){
		// global variable fungsi.
		$data = [];
		// ambil value untuk variable view, parameter 1 footerfixed, parameter 2 overflowhidden.
		$data = $this->getViewVariable(false, false);
		// siapkan table dulu.
		$data['table'] = [];
		// variable
		$data['isPeriode1'] = false;
		$data['isPeriode2'] = false;
		$data['isPeriode3'] = false;
		if($this->input->post('btnSubmit') == true){
			// set rules.
			$this->form_validation->set_rules('cbTahun', 'Tahun Ajaran', 'required');
			$this->form_validation->set_rules('cbJurusan', 'Jurusan', 'required');
			// jika validation berhasil, proses.
			if($this->form_validation->run() == true){
				// ambil data data input.
				$data['tahun'] = $this->input->post('cbTahun', true);
				$data['jurusan'] = $this->input->post('cbJurusan', true);
				$data['isPeriode1'] = $this->input->post('cbPeriode1', true);
				$data['isPeriode2'] = $this->input->post('cbPeriode2', true);
				$data['isPeriode3'] = $this->input->post('cbPeriode3', true);
				$data['isBL'] = $this->input->post('cbBelumLunas', true);
				$data['isL'] = $this->input->post('cbLunas', true);
				// variable variable nya.
				$data['arrCurriculumId'] = [];
				$data['arrStudentId'] = [];
				$data['arrStudentDepartment'] = [];
				$data['arrStudent1stPeriod'] = [];
				$data['arrStudent2ndPeriod'] = [];
				$data['arrStudent3rdPeriod'] = [];
				$data['arrStudentName'] = [];
				// ambil jurusan yang memenuhi.
				$tempCurriculumId = $this->model_informasi_kurikulum->getCurriculumId($data['jurusan'], $data['tahun']);
				foreach($tempCurriculumId as $row){
					$data['arrCurriculumId'][] = $row['id'];
				}
				// ambil mahasiswa yang memenuhi. ***
				$tempStudentId = $this->model_mahasiswa->getStudentId($data['arrCurriculumId']);
				foreach($tempStudentId as $row){
					$data['arrStudentId'][] = $row['nrp'];
				}
				// ambil nama maha yang memenuhi. ***
				foreach($tempStudentId as $row){
					$data['arrStudentDepartment'][] = $this->model_mahasiswa->getStudentDatum('informasi_kurikulum_id', 'nrp', $row['nrp']);
					$data['arrStudentName'][] = $this->model_mahasiswa->getStudentDatum('nama', 'nrp', $row['nrp']);
				}
				// ambil hkeuangan sesuai matriculant.
				$tempHKid = $this->model_hkeuangan->getIdStudentUPP($data['arrStudentId']);
				foreach($tempHKid as $row){
					$data['arrHKid'][] = $row['id'];
				}
				// ambil jumlah, batas tanggal, dan status nya ***
				foreach($tempHKid as $row){
					$tempPeriod = $this->model_dkeuangan->getDFinanceFromHFinance('jumlah', 'id', $row['id']);
					$data['arrStudent1stPeriod'][] = $tempPeriod[0]['jumlah'];
					$data['arrStudent2ndPeriod'][] = $tempPeriod[1]['jumlah'];
					$data['arrStudent3rdPeriod'][] = $tempPeriod[2]['jumlah'];
					$data['arrJumlahUPP'][] = $this->model_hkeuangan->getHFinanceDatum('jumlah', 'id', $row['id']);
					//$data['arrTBT'][] = $this->model_dkeuangan->getDFinanceFromHFinance('tanggal_batas', 'id', $row['id']);
					$data['arrStatus'][] = $this->model_hkeuangan->getHFinanceDatum('status', 'id', $row['id']);
				}
				// masukin ke table.
				for($a = 0; $a < count($data['arrStudentId']); $a++){
					$data['table'][] = array(
						'noreg' => $data['arrStudentId'][$a],
						'nama' => $data['arrStudentName'][$a],
						'1stPeriode' => $data['arrStudent1stPeriod'][$a],
						'2ndPeriode' => $data['arrStudent2ndPeriod'][$a],
						'3rdPeriode' => $data['arrStudent3rdPeriod'][$a],
						'jumlah' => $data['arrJumlahUPP'][$a],
						//'tanggal_batas' => $data['arrTBT'][$a],
						'status' => $data['arrStatus'][$a]
					);
				}
			}
			// jika gagal, redirect.
			else{
				$this->session->set_flashdata('error_laporan_upp', 'Ada field yang kosong!');
				redirect('laporan/laporan_usp');
			}
		}
		// current tab.
		$data['currentTab'] = 'pembayaran_upp';
		// load view.
		$this->load->view('header', $data);
		$this->load->view('navbar_keuangan');
		$this->load->view('pembayaran_upp', $data);
		$this->load->view('footer', $data);
	}
	
	public function pembayaran_usp(){
		// global variable fungsi.
		$data = [];
		// ambil value untuk variable view, parameter 1 footerfixed, parameter 2 overflowhidden.
		$data = $this->getViewVariable(false, false);
		// siapkan table dulu.
		$data['table'] = [];
		
		// jika submit ditekan.
		if($this->input->post('btnSubmit') == true){
			// set rules.
			$this->form_validation->set_rules('cbTahun', 'Tahun Ajaran', 'required');
			$this->form_validation->set_rules('cbJurusan', 'Jurusan', 'required');
			$this->form_validation->set_rules('dtpAwal', 'Tanggal Awal', 'required');
			$this->form_validation->set_rules('dtpAkhir', 'Tanggal Akhir', 'required');
			// jika validation berhasil, proses.
			if($this->form_validation->run() == true){
				// ambil data data input.
				$data['tahun'] = $this->input->post('cbTahun', true);
				$data['jurusan'] = $this->input->post('cbJurusan', true);
				$data['tanggalAwal'] = $this->input->post('dtpAwal', true);
				$data['tanggalAkhir'] = $this->input->post('dtpAkhir', true);
				$data['isBL'] = $this->input->post('cbBelumLunas');
				$data['isL'] = $this->input->post('cbLunas');
				// variable variable nya.
				$data['arrCurriculumId'] = [];
				$data['arrMatriculantId'] = [];
				$data['arrMatriculantDepartment'] = [];
				$data['arrMatriculantName'] = [];
				// ambil jurusan yang memenuhi.
				$tempCurriculumId = $this->model_informasi_kurikulum->getCurriculumId($data['jurusan'], $data['tahun']);
				foreach($tempCurriculumId as $row){
					$data['arrCurriculumId'][] = $row['id'];
				}
				
				// ambil calon mahasiswa yang memenuhi. ***
				$tempMatriculantId = $this->model_calon_mahasiswa->getMatriculantId($data['arrCurriculumId']);
				foreach($tempMatriculantId as $row){
					$data['arrMatriculantId'][] = $row['nomor_registrasi_id'];
				}
				// ambil nama cama yang memenuhi. ***
				foreach($tempMatriculantId as $row){
					$data['arrMatriculantDepartment'][] = $this->model_calon_mahasiswa->getMatriculantDatum('informasi_kurikulum_id', 'nomor_registrasi_id', $row['nomor_registrasi_id']);
					$data['arrMatriculantName'][] = $this->model_calon_mahasiswa->getMatriculantDatum('nama', 'nomor_registrasi_id', $row['nomor_registrasi_id']);
				}
				//variable
				$data['arrHKid'] = [];
				// ambil hkeuangan sesuai matriculant.
				$tempHKid = $this->model_hkeuangan->getIdMatriculantUSP($data['arrMatriculantId'], $data['isBL'], $data['isL']);
				foreach($tempHKid as $row){
					$data['arrHKid'][] = $row['id'];
				}
				//variable
				$data['arrJumlahUSP'] = [];
				$data['arrTBT'] = [];
				$data['arrStatus'] = [];
				// ambil jumlah, batas tanggal, dan status nya ***
				foreach($tempHKid as $row){
					$data['arrJumlahUSP'][] = $this->model_hkeuangan->getHFinanceDatum('jumlah', 'id', $row['id']);
					$data['arrTBT'][] = $this->model_dkeuangan->getDFinanceFromHFinance('tanggal_batas', 'id', $row['id']);
					$data['arrStatus'][] = $this->model_hkeuangan->getHFinanceDatum('status', 'id', $row['id']);
				}
				// masukin ke table.
				for($a = 0; $a < count($data['arrHKid']); $a++){
					$data['table'][] = array(
						'noreg' => $data['arrMatriculantId'][$a],
						'jurusan' => $data['arrMatriculantDepartment'][$a],
						'nama' => $data['arrMatriculantName'][$a],
						'jumlah' => $data['arrJumlahUSP'][$a],
						'tanggal_batas' => $data['arrTBT'][$a],
						'status' => $data['arrStatus'][$a]
					);
				}
			}
			// jika gagal, redirect.
			else{
				$this->session->set_flashdata('error_laporan_usp', 'Ada field yang kosong!');
				redirect('laporan/laporan_usp');
			}
		}
		// jika button search ditekan.
		else if($this->input->post('btnSearch') == true){
			// ambil data input search.
			$data['search'] = $this->input->post('txtSearch');
			$data['isBL'] = $this->input->post('cbBelumLunas');
			$data['isL'] = $this->input->post('cbLunas');
			// tanggal awal dan batas dfault.
			$data['tanggalAwal'] = '1990-00-00';
			$data['tanggalAkhir'] = '2200-00-00';
			// variable variable nya.
			$data['arrCurriculumId'] = [];
			$data['arrMatriculantId'] = [];
			$data['arrMatriculantDepartment'] = [];
			$data['arrMatriculantName'] = [];
			// ambil nama calon mahasiswa yang mirip. ***
			$tempMatriculantName = $this->model_calon_mahasiswa->getMatriculantNameSearch($data['search']);
			foreach($tempMatriculantName as $row){
				$data['arrMatriculantName'][] = $row['nama'];
			}
			// ambil noreg milik cama2 tersebut. ***
			foreach($tempMatriculantName as $row){
				$data['arrMatriculantDepartment'][] = $this->model_calon_mahasiswa->getMatriculantDatum('informasi_kurikulum_id', 'nama', $row['nama']);
				$data['arrMatriculantId'][] = $this->model_calon_mahasiswa->getMatriculantDatum('nomor_registrasi_id', 'nama', $row['nama']);
			}
			// ambil hkeuangan sesuai matriculant.
			$tempHKid =  $this->model_hkeuangan->getIdMatriculantUSP($data['arrMatriculantId'], $data['isBL'], $data['isL']);
			foreach($tempHKid as $row){
				$data['arrHKid'][] = $row['id'];
			}
			// ambil jumlah, batas tanggal, dan status nya ***
			foreach($tempHKid as $row){
				$data['arrJumlahUSP'][] = $this->model_hkeuangan->getHFinanceDatum('jumlah', 'id', $row['id']);
				$data['arrTBT'][] = $this->model_dkeuangan->getDFinanceFromHFinance('tanggal_batas', 'id', $row['id']);
				$data['arrStatus'][] = $this->model_hkeuangan->getHFinanceDatum('status', 'id', $row['id']);
			}
			// masukin ke table.
			for($a = 0; $a < count($data['arrMatriculantId']); $a++){
				$data['table'][] = array(
					'noreg' => $data['arrMatriculantId'][$a],
					'jurusan' => $data['arrMatriculantDepartment'][$a],
					'nama' => $data['arrMatriculantName'][$a],
					'jumlah' => $data['arrJumlahUSP'][$a],
					'tanggal_batas' => $data['arrTBT'][$a],
					'status' => $data['arrStatus'][$a]
				);
			}
			
		}
		// current tab.
		$data['currentTab'] = 'pembayaran_usp';
		// load view.
		$this->load->view('header', $data);
		$this->load->view('navbar_keuangan', $data);
		$this->load->view('pembayaran_usp', $data);
		$this->load->view('footer', $data);
	}
}