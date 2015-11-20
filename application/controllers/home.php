<?php
	class Home extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
		}
		
		public function index()
		{
			if($this->session->userdata('username')){
				if($this->Mahasiswa_model->isStudent($this->session->userdata('username')))
				{
					redirect('perwalian/mahasiswa');
				}
				else if($this->Dosen_model->isLecture($this->session->userdata('username')))
				{
					redirect('perwalian/dosen');
				}
			}
			else if(get_cookie('username')){
				if($this->Mahasiswa_model->isStudent(get_cookie('username')))
				{
					redirect('perwalian/mahasiswa');	
				}
				else if(  $this->Dosen_model->isLecture(get_cookie('username')))
				{
					redirect('perwalian/dosen');
				}				
			}
			else{
				$this->login();
			}
		}
		
		public function login()
		{
			//MENGECEK APAKAH USER PERNAH LOGIN ATAU TIDAK
			//JIKA PERNAH MAKA AKAN TERDAPAT DISESSION
			if($this->session->userdata('username')){
				if($this->Mahasiswa_model->isStudent($this->session->userdata('username')))
				{
					redirect('perwalian/mahasiswa');
				}
				else if($this->Dosen_model->isLecture($this->session->userdata('username')))
				{
					redirect('perwalian/dosen');
				}
			}
			else if(get_cookie('username')){
				//MENGECEK APAKAH USER PERNAH MENGGUNAKAN FITUR REMEMBER ME
				//JIKA PERNAH MAKA AKAN TERDAPAT DISESSION
				if($this->Mahasiswa_model->isStudent(get_cookie('username')))
				{
					redirect('perwalian/mahasiswa');	
				}
				else if(  $this->Dosen_model->isLecture(get_cookie('username')))
				{
					redirect('perwalian/dosen');
				}				
			}
			//UNTUK MENGECEK VALIDASI INPUT USER, JIKA KOSONG MENGGUNAKAN GETCUSTOMREQUIRED DAN MENGECEK APAKAH ID SUDAH ADA ATAU BELUM
			$this->form_validation->set_rules('username','Username','callback_getCustomRequired[name]|callback_getId[username]');
			//UNTUK MENGECEK VALIDASU INPUT PASSWORD, JIKA KOSONG MENGGUNAKAN GETCUSTOMREQUIRED DAN MENGENGECEK APAKAH PASSWORD SUDAH BENAR ATAU TIDAK
			$this->form_validation->set_rules('pass','Password','callback_getCustomRequired[pass]|callback_getPass[pass]');
			
			//JIKA VALIDASI SUDAH BENAR SEMUA MAKA MASUK KE IF INI
			if($this->form_validation->run() == true){
				//MAKA DIKELUARKAN MESSEGEBOX BAHWA LOGIN SUKSES
				//echo '<script>alert("You Have Successfully updated this Record!");</script>';
				//MENGECEK LAGI APAKAH YG LOGIN ADALAH DOSEN
				if($this->Dosen_model->isLecture($this->input->post('username')))
				{
					//DAN DILOMPATKAN KE DOSEN
					//MENYIMPAN DATA LOGIN KE SESSION
					$this->session->set_userdata('user',$this->input->post('username'));
					//JIKA MEMILIH FITUR REMEMBER ME
					//MAKA USER LOGIN AKAN DISIMPAN KE COOKIE DENGAN LAMA 1 HARI
					if($this->input->post('remember')){
						$cookie = array('name'=>'username','value'=>$this->input->post('username'),'expire'=>60*60*24);
					}
					set_cookie($cookie);
					redirect('');
				}
				else
				{
					//JIKA YANG LOGIN MAHASISWA MAKA DILOMPATKAN KEMAHASISWA
					//MENYIMPAN DATA LOGIN KE SESSION
					//MEMBUAT MENU YANG AKAN DITAMPILKAN
					$this->session->set_userdata('currentPage','home');
					$this->session->set_userdata('username',$this->input->post('username'));
					//JIKA MEMILIH FITUR REMEMBER ME
					//MAKA USER LOGIN AKAN DISIMPAN KE COOKIE DENGAN LAMA 1 HARI
					if($this->input->post('remember')){
						$cookie = array('name'=>'username','value'=>$this->input->post('username'),'expire'=>60*60*24);
					}
					set_cookie($cookie);
					redirect('perwalian/mahasiswa');
				}
			}
			else
			{
				//UNTUK MENGLOAD HEADER LOGO STTS DEFAULT
				$data['title'] = 'Sistem Informasi Mahasiswa STTS';
				$this->load->view('includes/header',$data);
				
				//MENDAPATKAN USER DAN PASSWORD DARI INPUT USER
				$user = $this->input->post('username');
				$pass = $this->input->post('pass');
				
				//CLASS YANG AKAN DIGUNAKAN UNTUK FORM INPUT, JIKA ERROR NANTI AKAN BERUBAH MERAH
				$styleErrorUser='form-group';
				$styleErrorPass='form-group';
				
				//MENGESET TIDAK MENAMPILKAN POPUP LOGIN 
				$data['showModal'] = false;
				
				//JIKA BUTTON LOGIN DI TEKAN MAKA MASUK KE IF INI
				if($this->input->post('btnLogin'))
				{
					//MENAMPILKAN POPUP LOGIN
					$data['showModal']=true;
					
					//DICEK APAKAH USERNAME TIDAK ADA DALAM DATABASE, JIKA TIDAK ADA, MAKA FORM INPUT AKAN BERWARNA MERAH
					if($this->Mahasiswa_model->isStudent($this->input->post('username')) == false and $this->Dosen_model->isLecture($this->input->post('username')) == false){
						$styleErrorUser = 'form-group has-error';
					}
					//DICEK APAKAH PASSWORD SALAH ATAU TIDAK, JIKA SALAH, MAKA FORM INPUT AKAN BERWARNA MERAH
					if($this->Mahasiswa_model->isPassword($this->input->post('username'), $this->input->post('pass')) == false and $this->Dosen_model->isPassword($this->input->post('username'),$this->input->post('pass')) == false){
						$styleErrorPass = 'form-group has-error';
					}
				}else if($this->input->post('close')){
					$user = "";
					$pass = "";
				}
				//USERCONFIG DIGUNAKAN UNTUK MENGSET TEXTBOX DI VIEW NAVBARDEFAULT
				//YANG NANTI AKAN DIGUNAKAN UNTUK MENGISI NRP ATAU NIP
				//DIMANA NAME NYA USERNAME, CLASSNYA DARI BOOTSTRAP, DIMANA DIGUNAKAN UNTUK MENGAKTIFKAN CSS DARI BOOTSTRAP
				//PLACEHOLDER BERISI NRP/NIP, YANG DIGUNAKAN UNTUK MENAMPILKAN TULISAN DIDALAM TEXTBOX
				//AUTOFOCUS DIGUANAKAN JIKA LOGIN TERBUKA, DAN LANGSUNG MENGARAH KE TEXTBOX USER
				//DAN ISI DARI TEXTBOXT DIBIARKAN KOSONG
				$data['userConfig'] = array('name'=>'username','class'=>'form-control', 'placeholder'=>'NRP/NIP', 'autofocus'=>'', 'value'=>$user);
				
				//PASSCONFIG DIGUNAKAN UNTUK MENGSET TEXTBOX DI VIEW NAVBARDEFAULT
				//YANG NANTI AKAN DIGUNAKAN UNTUK MENGISI PASSWORD
				//DIMANA NAME NYA PASS, CLASSNYA DARI BOOTSTRAP, DIMANA DIGUNAKAN UNTUK MENGAKTIFKAN CSS DARI BOOTSTRAP
				//PLACEHOLDER BERISI PASSWORD, YANG DIGUNAKAN UNTUK MENAMPILKAN TULISAN DIDALAM TEXTBOX
				//DAN ISI DARI TEXTBOXT DIBIARKAN KOSONG
				$data['passConfig'] = array('name'=>'pass','type'=>'password','class'=>'form-control', 'placeholder'=>'Password', 'value'=>$pass);
				
				//ERRORUSER DIGUNAKAN UNTUK MENAMPILKAN ERROR YANG TERJADI JIKA LOGIN TELAH DITEKAN
				$data['errorUser']= "";
				
				//ERRORPASS DIGUNAKAN UNTUK MENAMPILKAN ERROR YANG TERJADI JIKA LOGIN TELAH DITEKAN
				$data['errorPass']= "";
				
				//DIGUNAKAN UNTUK MEMBUAT DIV BARU, JIKA ADA ERROR MAKA AKAN MENGGANTI CSSNYA
				//INI MENGGUNAKAN FUNCTION DIVOPEN YANG SUDAH DIBUAT DIBAWAH
				//DENGAN PARAMETER CLASS, DAN MENGGUNAKAN CLASS DARI BOOTSTRAP
				//FORM GROUP DIGUNAKAN UNTUK MENGRUPKAN KOMPONEN DIDALAMNYA
				//INI UNUK MENGGABUNGKAN ANTARA ICON USER DAN TEXTBOX
				$data['divUsername']= $this->divOpen($styleErrorUser);
				
				//DIGUNAKAN UNTUK MEMBUAT DIV BARU, JIKA ADA ERROR MAKA AKAN MENGGANTI CSSNYA
				//INI MENGGUNAKAN FUNCTION DIVOPEN YANG SUDAH DIBUAT DIBAWAH
				//DENGAN PARAMETER CLASS, DAN MENGGUNAKAN CLASS DARI BOOTSTRAP
				//FORM GROUP DIGUNAKAN UNTUK MENGRUPKAN KOMPONEN DIDALAMNYA
				//INI UNUK MENGGABUNGKAN ANTARA ICON PASS DAN TEXTBOX
				$data['divPass']= $this->divOpen($styleErrorPass);
				
				//BTNLOGIN UNTUK MEMBUAT STYLE BUTTON YANG AKAN DITAMPILKAN DI LOGIN
				//CLASS BTN BTN-PRIMARY  BERARTI MEMANGGIL STYLE MILIK BOOTSTRAP YANG AKAN MENJADIKAN BUTTON BERWARNA BIRU
				//NAME BUTTON NANTI AKAN DI SET LOGIN
				//DAN BUTTON TERSEBUT MENAMPILKAN TULISAN LOGIN
				$data['btnLogin']=array('class'=>'btn btn-primary','name'=>'btnLogin','value'=>'Login');
				
				//BTNLOGIN UNTUK MEMBUAT STYLE BUTTON YANG AKAN DITAMPILKAN DI LOGIN
				//CLASS BTN BTN-DEFAULT  BERARTI MEMANGGIL STYLE MILIK BOOTSTRAP YANG AKAN MENJADIKAN BUTTON BERWARNA PUTIH ATAU STANDART
				//NAME BUTTON NANTI AKAN DI SET CLOSE
				//DAN BUTTON TERSEBUT MENAMPILKAN TULISAN CLOSE
				$data['btnClose']=array('class'=>'btn btn-default','name'=>'close','data-dismiss'=>'modal','value'=>'Close');
				
				
				//UNTUK MENGLOAD NAVBAR UNTUK USER YANG BELUM LOGIN
				$this->load->view('nav/navbardefault',$data);
				
				//UNTUK MENGLOAD CONTENT DARI WEB
				$this->load->view('contentdefault');
				
				//DIGUNAKAN UNTUK MENGLOAD FOOTER
				$this->load->view('includes/footer');
			}
		}
		
		
		
		function divOpen($class = NULL, $id = NULL)
		{
			$code   = '<div ';
			$code   .= ( $class != NULL )   ? 'class="'. $class .'" '   : '';
			$code   .= ( $id != NULL )      ? 'id="'. $id .'" '         : '';
			$code   .= '>';
			return $code;
		}
		
		function getCustomRequired($str, $func)
		{
			switch($func)
			{
				case 'name':
					$this->form_validation->set_message('getCustomRequired', 'Enter your ID');
					return (trim($str) == '') ? FALSE : TRUE;
					break;
				case 'pass':
					$this->form_validation->set_message('getCustomRequired', 'Enter your password');
					return (trim($str) == '') ? FALSE : TRUE;
					break;
			}
		}
		
		function getId($str)
		{
			if($this->Dosen_model->isLecture($str))
			{
				return true;
			}
			else if($this->Mahasiswa_model->isStudent($str))
			{
				return true;
			}
			else
			{
				$this->form_validation->set_message('getId','ID tidak terdaftar');
				return false;
			}
		}
		
		function getPass($str)
		{
			if($this->Dosen_model->isPassword($this->input->post('username'), $str))
			{
				return true;
			}
			else if($this->Mahasiswa_model->isPassword($this->input->post('username'),$str))
			{
				return true;
			}
			else
			{
				$this->form_validation->set_message('getPass','Password salah');
				return false;
			}
		}
		
	}

?>