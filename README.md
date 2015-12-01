## Kerja Kelompok SDP ##
----------
 
 1. Sebelum mengerjakan harap baca tutorial :  [Tutorial  SDP by Ste](https://www.dropbox.com/s/jcn2rio9g7rs1pp/Tutorial%20GITHUB%20untuk%20SDP.pdf?dl=0)
 2. SQL silakan update saja. Disana jika ada perubahan.
 

## Untuk Mengabungkan ##
----------

 1. Untuk view kalian loadlah `$this->load->view('includes/header', $data)` dan `$this->load->view('includes/footer')`. 
 2. `$data` merupakan array dengan isi `['title' => 'nama_title_halaman']`
 3. Contoh pemakaian :

```PHP
    $data['title'] = "Sistem Informasi STTS';
    $this->load->view('includes/header', $data);
    $this->load->view('VIEW_MU');
    $this->load->view('includes/footer');
```

Pada header sudah ada bootstrap.min.css dll. Yang dibutuhkan.

## Login Dosen + Kajur ##
----------

 1. Untuk mendapatkan username yang login  :`$this->session->userdata('username')`
 2. Untuk mendapatkan role yang login : $this->session->userdata('user_role')
 3. Berikut merupakan contoh pengecekan yang aku taruh di method `__construct()`


```PHP
public function __construct(){// Jika User bukan Dosen redirect lah ke halaman login
	parent::__construct();
	if($this->session->userdata('user_role') != 'dosen'){
                redirect('/');
    }
	// Kalau iya lanjut ke method lainnya.
}
```

##Edit Link Navigasi ##
----------
Masuk ke folder view/nav/navbar.php. Disana ada file navigasi kalian.
Navigasi tidak perlu di load juga pada controller karena aku sudah include di header.php