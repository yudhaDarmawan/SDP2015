<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Keuangan extends CI_Controller {
	function __construct(){
		parent::__construct();
	}
	
	public function getVariable(){
		// global variable fungsi.
		$data = [];
		// variable userLoginName untuk nama yang login.
		$data['userLoginName'] = '';
		// boolean untuk atur footer fixed. true jika di fix, false jika tidak fix.
		$data['isFooterFixed'] = true;
		// boolean untuk atur overflow hidden. true jika di hidden, false jika tidak hidden.
		$data['isOverflowHidden'] = true;
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
		$data = $this->getVariable();
		// jika belum login redirect ke page login.
        if($data['userLoginName'] == ''){
            $this->session->set_flashdata('error_access', 'Login terlebih dahulu!');
            redirect('bau');
        }
		// load view.
		$this->load->view('includes/header_bau', $data);
		$this->load->view('nav/navbar_keuangan', $data);
		$this->load->view('keuangan_placeholder');
		$this->load->view('includes/footer_bau', $data);
	}
}