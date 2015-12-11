<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Masterbau extends CI_Controller {
	function __construct(){
		parent::__construct();
	}
    /******************************************************************************************************
    fungsi getVariable().
    usage   : mengambil variable-variable untuk pengaturan view (footer view, overflow untuk Y-Axis) yang dipengaruhi
              oleh currentPage.
              mengambil variable-variable login, dari session atau cookie. (id user yang login, role user yang login)
              yang akan menentukan redirect page.
              semua variable-variable tersebut disimpan pada array $data, yang nanti akan di returnkan ke function yang membutuhkan.
    param   :   { 
                footerFixed = mengatur boolean isFooterFixed,
                overflowHidden = mengatur boolean isOverflowHidden 
                }
    variable: isFooterFixed = true jika footer di fix, false jika footer tidak fixed.
              isOverflowHidden = true jika Y-Axis overflow di ignore, false jika tidak di ignore.
    infos   : pada function-function lain, akan terdapat variable array $data juga, variable itu akan diisi oleh returnan function ini.
              pada controller`laporan`, user yang berhasil masuk pasti dosen.
              SELALU PANGGIL FUNCTION INI DULU PADA AWAL SETIAP FUNCTION, karena nanti akan ada variable tambahan untuk $data dan jika
                function ini dipanggil terakhir, variable tambahan tersebut akan di hapus.
    *****************************************************************************************************/
	public function getVariable($footerFixed, $overflowHidden){
		// global variable fungsi.
		$data = [];
		// variable userLoginName untuk nama yang login.
		$data['userLoginName'] = '';
		// boolean untuk atur footer fixed. true jika di fix, false jika tidak fix.
		$data['isFooterFixed'] = $footerFixed;
		// boolean untuk atur overflow hidden. true jika di hidden, false jika tidak hidden.
		$data['isOverflowHidden'] = $overflowHidden;
		// cek jika cookie.
		if($this->input->cookie('userLogin') != ''){
			$data['userLoginName'] = $this->model_dosen->getLecturerDatum('nama', 'nip', $this->input->cookie('userLogin', true));
		}
		// cek jika session.
		else if($this->session->userdata('userLogin') != ''){
			$data['userLoginName'] = $this->model_dosen->getLecturerDatum('nama', 'nip', $this->session->userdata('userLogin'));
		}
		
		return $data;
	}
	
    /******************************************************************************************************
    fungsi index().
    usage   : mengambil variable untuk view.
              load tampilan awal login bau.
    param   : {}
    variable: $data = global variable untuk semua variable.
    infos   : pastikan untuk memanggil function getVariable() sebelum load view.
    *****************************************************************************************************/
	public function index(){
		// global variable fungsi.
		$data = [];
		// ambil value untuk variable view, parameter 1 footerfixed, parameter 2 overflowhidden.
		$data = $this->getVariable(true, true);
		// current tab.
		$data['currentTab'] = '';
		// load view.
		$this->load->view('includes/header_bau', $data);
		$this->load->view('nav/navbar_laporan', $data);
		$this->load->view('laporan_placeholder');
		$this->load->view('includes/footer_bau', $data);
	}
	
	public function master_biaya(){
		// global variable fungsi.
		$data = [];
		// ambil value untuk variable view, parameter 1 footerfixed, parameter 2 overflowhidden.
		$data = $this->getVariable(false, false);
		// table untuk tampilin kurikulum yang sudah ada.
		$data['table'] = [];
		
		if($this->input->post('btnSubmit') == true){
			// setu rules dulu untuk input.
			$this->form_validation->set_rules('cbJurusan', 'Jurusan', 'required');
			$this->form_validation->set_rules('cbTahun', 'Tahun Ajaran', 'required');
			$this->form_validation->set_rules('cbKategori', 'Kategori', 'required');
			$this->form_validation->set_rules('txtUSP', 'Harga USP', 'required');
			$this->form_validation->set_rules('txtSPP', 'Harga SPP', 'required');
			$this->form_validation->set_rules('txtSKS', 'Harga SKS', 'required');
			// jika validation run berhasil baru proses.
			if($this->form_validation->run() == true){
				// ambil id yang dipilih.
				$tempId = $this->input->post('cbJurusan'). $this->input->post('cbTahun'). $this->input->post('cbKategori');
				// cek apakah id sudah ada atau belum.
				$isCurriculumIdExist = $this->model_informasi_kurikulum->isCurriculumIdExist($tempId);
				// ambil data data yang diperlukan.
				$data['jurusan'] = $this->input->post('cbJurusan', true);
				$data['tahun'] = $this->input->post('cbTahun', true);
				$data['kategori'] = $this->input->post('cbKategori', true);
				$data['usp'] = $this->input->post('txtUSP', true);
				$data['spp'] = $this->input->post('txtSPP', true);
				$data['sks'] = $this->input->post('txtSKS', true);
				
				// jika sudah ada, maka update.
				if($isCurriculumIdExist == true){
					$this->model_informasi_kurikulum->updateCurriculum($tempId, $data);
					$this->session->set_flashdata('update_master_biaya', 'Record berhasil diupdate!');
					redirect('masterbau/master_biaya');
				}
				// jika belum ada, maka insert.
				else{
					$this->model_informasi_kurikulum->insertCurriculum($tempId, $data);
					$this->session->set_flashdata('insert_master_biaya', 'Insert berhasil!');
					redirect('masterbau/master_biaya');
				}
			}
			// jika validation gagal, redirect masterbau/master_biaya.
			else{
				$this->session->set_flashdata('error_master_biaya', 'Ada field yang kosong!');
				redirect('masterbau/master_biaya');
			}
			
		}
        //load isi table.
		$data['table'] = $this->model_informasi_kurikulum->getAllCurriculum();
		// current tab.
		$data['currentTab'] = 'master_biaya';
		// load view.
		$this->load->view('includes/header_bau', $data);
		$this->load->view('nav/navbar_chief');
		$this->load->view('master_biaya', $data);
		$this->load->view('includes/footer_bau', $data);
	}
	
	public function master_keuangan(){
		// global variable fungsi.
		$data = [];
		// ambil value untuk variable view, parameter 1 footerfixed, parameter 2 overflowhidden.
		$data = $this->getVariable(false, false);
        // ambil notifikasinya.
        $tempArrNotifMatriculant = $this->model_notifikasi->getNotifMatriculant();
        foreach($tempArrNotifMatriculant as $r){
            $data['arrNotifMatriculant'][] = $r['id'];
        }
        $tempArrNotifStudent = $this->model_notifikasi->getNotifStudent();
        foreach($tempArrNotifStudent as $r){
            $data['arrNotifStudent'][] = $r['id'];
        }
        /////
        
        // ambil cama nya sapa saja.
        $data['newMatriculant'] = $this->model_notifikasi->getNewMatriculant();
        // ambil mahasiswanya sapa saja.
        $data['newStudent'] = $this->model_notifikasi->getNewStudent();
		// jika button generate usp ditekan.
		if($this->input->post('btnSubmitUSP') == true){
			// ambil dulu noreg calon mahasiswa.
			foreach($data['newMatriculant'] as $row){
				$data['arrMatriculantId'][] = $row;
			}
			// ambil kurikulum id untuk cama itu.
			$tempArrCurriculumId = $this->model_calon_mahasiswa->getCurriculumIds($data['arrMatriculantId']);
			foreach($tempArrCurriculumId as $row){
				$data['arrCurriculumId'][] = $row['informasi_kurikulum_id'];
			}
			// ambil biaya USP untuk cama itu.
			$data['arrUSPs'] = [];
			foreach($tempArrCurriculumId as $row){
				$data['arrUSPs'][] = $this->model_informasi_kurikulum->getCurriculumDatum('harga_usp', 'id', $row['informasi_kurikulum_id']);
			}
			// generate id untuk hkeuangan berdasarkan jumlah cama.
			$data['arrHK'] = []; $counter = 0;
			foreach($data['arrMatriculantId'] as $row){
				$tempCounter = '';
				if($counter < 10) $tempCounter = '000'.$counter;
				else if($counter < 100) $tempCounter = '00'.$counter;
				else if($counter < 1000) $tempCounter = '0'.$counter;
				else $tempCounter = $counter;
				$data['arrHK'][] = 'USP'.date('Y').date('m').date('d').$tempCounter;
				$counter++;
			}
			// generate id untuk dkeuangan berdasarkna jumlah hkeuangan.
			$data['arrDK'] = [];
			foreach($data['arrHK'] as $row){
				$data['arrDK'][] = $row.'0';
				$counter++;
			}
			// insert ke hkeuangan.
			$this->model_hkeuangan->insert($data);
			// insert ke dkeuangan.
			$this->model_dkeuangan->insert($data);
			
            // ubah status notifikasi cama ke sudah baca (0)
            $this->model_notifikasi->setReadStatus($data['arrNotifMatriculant']);
		}
		// jika button generate upp ditekan.
		else if($this->input->post('btnSubmitUPP') == true){
			// ambil dulu nrp mahasiswa.
			foreach($data['newStudent'] as $row){
				$data['arrStudentId'][] = $row;
			}
			// ambil kurikulum id untuk cama itu.
			$tempArrCurriculumId = $this->model_mahasiswa->getCurriculumIds($data['arrStudentId']);
			foreach($tempArrCurriculumId as $row){
				$data['arrCurriculumId'][] = $row['informasi_kurikulum_id'];
			}
			// ambil biaya SPP untuk mahasiswa itu.
			$data['arrSPPs'] = [];
			foreach($tempArrCurriculumId as $row){
				$data['arrSPPs'][] = $this->model_informasi_kurikulum->getCurriculumDatum('harga_spp', 'id', $row['informasi_kurikulum_id']);
			}
			// ambil biaya SKS untuk mahasiswa itu.
			$data['arrSKSs'] = [];
			foreach($tempArrCurriculumId as $row){
				$data['arrSKSs'][] = $this->model_informasi_kurikulum->getCurriculumDatum('harga_sks', 'id', $row['informasi_kurikulum_id']);
			}
			// ambil berapa sks yang diambil untuk tiap mahasiswa.
			$data['arrSKStaken'] = [];
			foreach($data['newStudent'] as $row){
				$data['arrSKStaken'][] = $this->model_mahasiswa->getSKStaken($row);
			}
			
			// generate id untuk hkeuangan berdasarkan jumlah cama.
			$data['arrHK'] = []; $counter = 0;
			foreach($data['arrStudentId'] as $row){
				$tempCounter = '';
				if($counter < 10) $tempCounter = '000'.$counter;
				else if($counter < 100) $tempCounter = '00'.$counter;
				else if($counter < 1000) $tempCounter = '0'.$counter;
				else $tempCounter = $counter;
				$data['arrHK'][] = 'UPP'.date('Y').date('m').date('d').$tempCounter;
				$counter++;
			}
			
			// insert ke hkeuangan.
			$this->model_hkeuangan->insertUPP($data);
			// generate id untuk dkeuangan berdasarkna jumlah hkeuangan.
			for($a = 0; $a < count($data['arrHK']); $a++){
				$arr = [];
				$arr['sks'] = $data['arrSKStaken'][$a];
				$arr['harga_sks'] = $data['arrSKSs'][$a];
				$arr['harga_spp'] = $data['arrSPPs'][$a];
				$arr['user_id'] = $data['arrStudentId'][$a];
				$arr['arrDK'] = [];
				$arr['arrDK'][] = $data['arrHK'][$a].'1';
				$arr['arrDK'][] = $data['arrHK'][$a].'2';
				$arr['arrDK'][] = $data['arrHK'][$a].'3';
				// insert ke dkeuangan.
				$this->model_dkeuangan->insertUPP($arr);
			}
			// ubah status notifikasi mahasiswa ke sudah baca (0)
            $this->model_notifikasi->setReadStatus($data['arrNotifStudent']);
		}
        // ambil jumlah cama dan mahasiswa.
		$data['countMatriculant'] = $this->model_notifikasi->countNewMatriculant();
		$data['countStudent'] = $this->model_notifikasi->countNewStudent();
		// current tab.
		$data['currentTab'] = 'master_keuangan';
		// load view.
		$this->load->view('includes/header_bau', $data);
		$this->load->view('nav/navbar_chief');
		$this->load->view('master_keuangan', $data);
		$this->load->view('includes/footer_bau', $data);
	}
    
    public function master_beasiswa(){
		// global variable fungsi.
		$data = [];
		// ambil value untuk variable view, parameter 1 footerfixed, parameter 2 overflowhidden.
		$data = $this->getVariable(false, false);
		// table untuk tampilin kurikulum yang sudah ada.
		$data['table'] = [];
        // ambil beasiswa yang sudah ada dan tampilkan di combobox.
        $tempBeasiswa = $this->model_informasi_beasiswa->getAllScholarship();
		$data['arrayBeasiswa'] = [];
        // isi combobox, jika kosong, isikan kosong.
        if(count($tempBeasiswa) == 0){
            $data['arrayBeasiswa']['null'] = '*Belum ada beasiswa*';
        }else{
            foreach($tempBeasiswa as $r){
                $data['arrayBeasiswa'][$r->id] = $r->nama_beasiswa;
            }
        }
        if($this->input->post('btnSubmit1') == true){
            $this->form_validation->set_rules('cbBeasiswa', 'Nama Beasiswa', 'required');
			$this->form_validation->set_rules('cbAspek1', 'Aspek', 'required');
			$this->form_validation->set_rules('txtBerapa1', 'Berapa Dipotong', 'required');
            
            if($this->form_validation->run() == true){
                $data['selectedScholarship'] = $this->input->post('cbBeasiswa', true);
                $data['selectedAspect'] = $this->input->post('cbAspek1', true);
                $data['sum'] = $this->input->post('txtBerapa1', true);
                
                $this->model_informasi_beasiswa->updateScholarship($data);
                $this->session->set_flashdata('update_master_beasiswa', 'Semua field harus diisi.');
                redirect('masterbau/master_beasiswa');
            }else{
                $this->session->set_flashdata('error_master_beasiswa', 'Semua field harus diisi.');
                redirect('masterbau/master_beasiswa');
            }
        }
        
        if($this->input->post('btnSubmit2') == true){
            $this->form_validation->set_rules('txtNewBeasiswa', 'Nama Beasiswa', 'required');
			$this->form_validation->set_rules('cbAspek2', 'Aspek', 'required');
			$this->form_validation->set_rules('txtBerapa2', 'Berapa Dipotong', 'required');
            
            if($this->form_validation->run() == true){
                $data['newScholarship'] = $this->input->post('txtNewBeasiswa', true);
                $data['newAspect'] = $this->input->post('cbAspek2', true);
                $data['newSum'] = $this->input->post('txtBerapa2', true);
                
                $data['id'] = 'BEA' . $this->model_informasi_beasiswa->countAllScholarship();
                $this->model_informasi_beasiswa->insertScholarship($data);
                $this->session->set_flashdata('insert_master_beasiswa', 'Semua field harus diisi.');
                redirect('masterbau/master_beasiswa');
            }else{
                $this->session->set_flashdata('error_master_beasiswa', 'Semua field harus diisi.');
                redirect('masterbau/master_beasiswa');
            }
        }
        
        //load isi table.
		$data['table'] = $this->model_informasi_beasiswa->getAllScholarship();
		// current tab.
		$data['currentTab'] = 'master_beasiswa';
		// load view.
		$this->load->view('includes/header_bau', $data);
		$this->load->view('nav/navbar_chief');
		$this->load->view('master_beasiswa', $data);
		$this->load->view('includes/footer_bau', $data);
	}
 
}