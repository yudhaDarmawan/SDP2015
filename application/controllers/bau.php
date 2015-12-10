<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/******************************************************************************************************
file    : bau.php
creator : Raymond Wongso 
location: application/controllers/bau.php
usage   : controller awal untuk bau. tempat login untuk bau.
function: index => sebagai default function yang dipanggil, menampilkan home login bau.
          userLogin => function yang dipanggil saat user telah memasukkan username dan password, mengolah data dan meredirect
                        user berdasrkan user role.
          userLogout => function yang dipanggil saat logout, menghapus semua session dan cookie.
*****************************************************************************************************/
class Bau extends CI_Controller {
	function __construct()
    {
		parent::__construct();
	}
    /******************************************************************************************************
    fungsi getVariable().
    usage   : mengambil variable-variable untuk pengaturan view (footer view, overflow untuk Y-Axis) yang dipengaruhi
              oleh currentPage.
              mengambil variable-variable login, dari session atau cookie. (id user yang login, role user yang login)
              yang akan menentukan redirect page.
              semua variable-variable tersebut disimpan pada array $data, yang nanti akan di returnkan ke function yang membutuhkan.
    param   : {}
    variable: isFooterFixed = true jika footer di fix, false jika footer tidak fixed.
              isOverflowHidden = true jika Y-Axis overflow di ignore, false jika tidak di ignore.
    infos   : untuk controller `bau`, belum ada data data login karena memang belum login.
              pada function-function lain, akan terdapat variable array $data juga, variable itu akan diisi oleh returnan function ini.
              SELALU PANGGIL FUNCTION INI DULU PADA AWAL SETIAP FUNCTION, karena nanti akan ada variable tambahan untuk $data dan jika
                function ini dipanggil terakhir, variable tambahan tersebut akan di hapus.
    *****************************************************************************************************/
	public function getVariable()
    {
		// global variable fungsi.
		$data = [];
		// boolean untuk atur footer fixed. true jika di fix, false jika tidak fix.
		$data['isFooterFixed'] = true;
		// boolean untuk atur overflow hidden. true jika di hidden, false jika tidak hidden.
		$data['isOverflowHidden'] = true;
		
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
	public function index()
    {
		// global variable fungsi.
		$data = [];
		// ambil value untuk variable view.
		$data = $this->getVariable();
		// jika data login sudah ada. redirect lgsg.
        $userRole = '';
        // ambil peran user dulu.
        if($this->session->userdata('userLogin') != '')
        {
            $userRole = $this->model_user->getUserDatum('peran', 'id', $this->session->userdata('userLogin'));
        }
        else if(get_cookie('userLogin', true) != '')
        {
            $userRole = $this->model_user->getUserDatum('peran', 'id', get_cookie('userLogin', true));
        }
        // jika peran user adalah admin.
        if($userRole == 'admin_bau')
        {
            redirect('keuangan');
        }
        // jika peran user adalah chief.
        else if($userRole == 'dosen_chiefbau')
        {
            redirect('laporan');
        }
		// load view.
		$this->load->view('includes/header_bau', $data);
		$this->load->view('nav/navbar_bau');
		$this->load->view('bau_placeholder');
		$this->load->view('includes/footer_bau', $data);
	}
	
    /******************************************************************************************************
    fungsi userLogin().
    usage   : mengambil variable untuk view.
              set rules untuk textbox user dan password.
              ambil data user dan password dari view.
              pengecekan apakah user ada atau tidak.
              pengecekan password.
              initiate session atau cookie.
              pengecekan user role, jika role bukan yang berhubungan dengan bau, ditolak.
              redirect ke controller masing2. (laporan untuk chief bau, keuangan untuk admin bau).
    param   : {}
    variable: $data = global variable untuk semua variable.
    infos   : pastikan untuk memanggil function getVariable() sebelum load view.
    *****************************************************************************************************/
	public function userLogin()
    {
		// global variable fungsi.
		$data = [];
		// ambil value untuk variable view.
		$data = $this->getVariable();
		
		// jika button login ditekan.
		if($this->input->post('btnLogin') == true)
        {
			// set rules untuk form.
			$this->form_validation->set_rules('txtUsername', 'Username', 'required');
			$this->form_validation->set_rules('txtPassword', 'Password', 'required');
			// jika rules dipenuhi.
			if($this->form_validation->run() == true)
            {
				// ambil data login dari view.
				$data['username'] = $this->input->post('txtUsername', true);
				$data['password'] = $this->input->post('txtPassword', true);
				$data['isRemember'] = $this->input->post('cbRemember', true);
				// cek apakah user sudah terdaftar.
				$isUserExist = $this->model_user->isUserExist($data['username']);
				// jika user memang exist.
				if($isUserExist == true)
                {
					// ambil dulu password yang benar.
					$supposedPassword = $this->model_user->getUserDatum('password', 'id', $data['username']);
					// jika password cocok.
					if($data['password'] == $supposedPassword)
                    {
						// simpan dulu id login ke session / cookie.
						if($data['isRemember'] == false)
                        { // session.
                            $this->session->set_userdata('userLogin', $data['username']);
						}
                        else 
                        { // cookie.
							$arrayCookie = array(
										'name' => 'userLogin',
										'value' => $data['username'],
										'expire' => 24*60*60
							);
							set_cookie($arrayCookie);
						}
						
						// ambil peran dari user tersebut.
						$userRole = $this->model_user->getUserDatum('peran', 'id', $data['username']);
						// jika peran user adalah admin.
						if($userRole == 'admin_bau')
                        {
							redirect('keuangan');
						}
						// jika peran user adalah chief.
						else if($userRole == 'dosen_chiefbau')
                        {
							redirect('laporan');
						}
                        else
                        {
                            $this->session->set_flashdata('error_login', 'User tidak diijinkan mengakses page BAU');
                            redirect('bau');
                        }
					}
					// jika password tidak cocok.
					else
                    {
						$this->session->set_flashdata('error_login', 'Password salah!');
						redirect('bau');
					}
				}
				// jika user tidak exist, maka arahkan login lagi.
				else
                {
					$this->session->set_flashdata('error_login', 'Username tidak terdaftar!');
					redirect('bau');
				}
			}
			// jika rules tidak dipenuhi.
			else
            {
				$this->session->set_flashdata('error_login', 'Username atau Password tidak boleh kosong!');
				redirect('bau');
			}
		}
	}
	
     /******************************************************************************************************
    fungsi userLogout().
    usage   : menghapus semua session dan cookie.
              redirect kembali ke halaman utama bau.
    param   : {}
    variable: $data = global variable untuk semua variable.
    infos   : -
    *****************************************************************************************************/
	public function userLogout()
    {
		// hapus session dan cookie.
		$this->session->unset_userdata('userLogin');
		delete_cookie('userLogin');
		// redirect ke login.
		redirect('bau');
	}
}
