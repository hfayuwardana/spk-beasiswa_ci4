<?php

namespace App\Controllers;
use App\Models\AkunModel;
use App\Models\MahasiswaModel;
use App\Models\BeasiswaModel;
use App\Models\KriteriaModel;
use App\Models\BobotModel;
use App\Models\KecocokanModel;
use App\Models\HasilModel;

class AdminController extends BaseController
{
	protected $helpers = ['form', 'url'];

	public function __construct()
	{
		$this->form_validation = \Config\Services::validation();
		$this->session = session();

		$this->akun = new AkunModel();
		$this->mahasiswa = new MahasiswaModel();
		$this->beasiswa = new BeasiswaModel();
		$this->kriteria = new KriteriaModel();
		$this->bobot = new BobotModel();
		$this->kecocokan = new KecocokanModel();
		$this->hasil = new HasilModel();
	}
	
	public function index(){
		// jika user belum login
		if(!isset($_SESSION['isLoggedIn'])) {
			// redirect untuk melakukan login pada form login
			return redirect()->to(base_url().'/authenticate');
		}
		// jika user sudah login
		else {
			$data = [
				'validation' => $this->form_validation,
			];

			echo view('templates/header');
			echo view('templates/nav_admin');
			echo view('admin/home', $data);
			echo view('templates/footer');
		}
	}
	
	public function authenticate(){
		// jika user belum login
		if(!isset($_SESSION['isLoggedIn'])) {
			// user diperkenankan mengisi form login
			$data = [
				'title' => "Login Admin",
				'validation' => NULL,
			];
			
			echo view('admin/login', $data);
			echo view('templates/footer');
		} 
		// jika user sudah login
		else {
			// redirect ke halaman home admin
			return redirect()->to(base_url().'/index');
		}
	} 

	// function logika login
	public function login()
	{
		$username = $this->request->getPost('username');
		$password = $this->request->getPost('password');
		$data = [
			'username' => $username,
			'password' => $password,
		];

		// jika validasi tidak berhasil
		if($this->form_validation->run($data, 'login') == FALSE){
			// jika user sudah login
			if(isset($_SESSION['isLoggedIn'])) {
				// redirect ke home
				return redirect()->to(base_url().'/home');
			}
			$data = [
				'title' => "Login Admin",
				'validation' => $this->form_validation,
			];
			echo view('admin/login', $data);
			echo view('templates/footer');
		} else {
			// membuat session
			$account = $this->akun->getAkunByUsername($username);
			$data = [
				'id' => $account['id_akun'],
				'username' => $account['username'],
				'isLoggedIn' => true,
			];
			session()->set($data);
			
			// redirect ke controller
			$this->session->setFlashData('success', "Berhasil melakukan login!");
			return redirect()->to(base_url().'/index');
		}
	}
	
	public function home(){
		// jika user sudah login
		if(isset($_SESSION['isLoggedIn'])) {
			// tampilkan home admin
			echo view('templates/header');
			echo view('templates/nav_admin');
			echo view('admin/home');
			echo view('templates/footer');
		}
		// redirect ke halaman login
		return redirect()->to(base_url().'/authenticate');
	}

	// function logika logout
	public function logout(){
		$this->session->destroy();
		// redirect ke halaman login
		return redirect()->to(base_url().'/authenticate');
	}

		// ----------------------------------------- Bagian Akun Admin ------------------------------------------
	// function tampil tabel akun admin
	public function viewAllAkun(){
		// jika user belum login
		if(!isset($_SESSION['isLoggedIn'])) {
			// redirect untuk melakukan login pada form login
			return redirect()->to(base_url().'/authenticate');
		}
		
		$data = [
			'users' => $this->akun->getAllAkun(),
        ];
		echo view('templates/header');
		echo view('templates/nav_admin');
		echo view('admin/akun', $data);
		echo view('templates/footer');
	}

	// function tampil form tambah akun admin
	public function createAkun(){
		// jika user belum login
		if(!isset($_SESSION['isLoggedIn'])) {
			// redirect untuk melakukan login pada form login
			return redirect()->to(base_url().'/authenticate');
		}
		$data = [
			'method' => 'create',
			'title' => "Tambah Data Admin",
			'validation' => NULL,
		];

		echo view('templates/header');
		echo view('templates/nav_admin');
		echo view('admin/form_akun', $data);
		echo view('templates/footer');
	}

	// function logika insert akun admin
	public function insertAkun(){
		$username = $this->request->getPost('username');
		$password = $this->request->getPost('password');
	
		$data = [
			'username' => $username,
			'password' => md5($password),
		];
	
		// jika isian form TIDAK sesuai dengan persyaratan
		if ($this->form_validation->run($data, 'insertAkun') == FALSE) {
			// jika user belum login
			if(!isset($_SESSION['isLoggedIn'])) {
				// redirect untuk melakukan login pada form login
				return redirect()->to(base_url().'/authenticate');
			}

			$data = [
				'method' => 'create',
				'title' => "Tambah Data Admin",
				'validation' => $this->form_validation,
			];
			
			echo view('templates/header');
			echo view('templates/nav_admin');
			echo view('admin/form_akun', $data);
			echo view('templates/footer');
		}
		// jika isian form sesuai dengan persyaratan
		else {
			if($this->akun->insertDataAkun($data)){
				$this->session->setFlashData('success', "Berhasil menambahkan data admin!");
				return redirect()->to(base_url().'/admin');
			}
		}
	}

	// function tampil form ubah akun admin
	public function editAkun($id_akun){
		// jika user belum login
		if(!isset($_SESSION['isLoggedIn'])) {
			// redirect untuk melakukan login pada form login
			return redirect()->to(base_url().'/authenticate');
		}
		$data = [
			'method' => 'edit',
			'title' => "Ubah Data Admin",
			'validation' => NULL,
			'user' => $this->akun->getAkunById($id_akun),
		];
		
		echo view('templates/header');
		echo view('templates/nav_admin');
		echo view('admin/form_akun', $data);
		echo view('templates/footer');
	}

	// function logika update akun admin
	public function updateAkun($id_akun){
		$user = $this->akun->getAkunById($id_akun);
		// jika id_akun tidak terdata di database (karena admin mengisi id_akun yang tidak valid via parameter URL)
		if($user == NULL){
			$this->session->setFlashData('danger', "Gagal mengubah data admin!");
			return redirect()->to(base_url().'/admin');
		}
		// jika id_akun terdata di database
		else {
			$password = $this->request->getPost('password');

			$data = [
				'password' => md5($password),
			];

			// jika isian form TIDAK sesuai dengan persyaratan
			if ($this->form_validation->run($data, 'updateAkun') == FALSE) {
				// jika user belum login
				if(!isset($_SESSION['isLoggedIn'])) {
					// redirect untuk melakukan login pada form login
					return redirect()->to(base_url().'/authenticate');
				}

				$data = [
					'method' => 'edit',
					'title' => "Ubah Data Admin",
					'validation' => $this->form_validation,
					'user' => $this->akun->getAkunById($id_akun),
				];
				// tampilkan kembali form akun tersebut
				echo view('templates/header');
				echo view('templates/nav_admin');
				echo view('admin/form_akun', $data);
				echo view('templates/footer');
			}
			// jika isian form sesuai dengan persyaratan
			else{
				if($this->akun->updateDataAkun($data, $id_akun)){
					$this->session->setFlashData('success', "Berhasil mengubah data admin!");
					// redirect ke tampilan tabel akun admin
					return redirect()->to(base_url().'/admin');
				}
			}
		}
	}

	// function logika delete akun admin
	public function deleteAkun($id_akun){
		$user = $this->akun->getAkunById($id_akun);
		// jika id_akun tidak terdata di database (karena admin mengisi id_akun yang tidak valid via parameter URL)
		if($user == NULL){
			$this->session->setFlashData('danger', "Gagal menghapus data admin!");
		}
		// jika id_akun terdata di database
		else {
			if($this->akun->deleteDataAkun($id_akun)){
				$this->session->setFlashData('success', "Berhasil menghapus data admin!");
			}
		}
		// redirect ke tampilan tabel akun admin
		return redirect()->to(base_url().'/admin');
	}

	// ----------------------------------------- Bagian Mahasiswa ------------------------------------------
	public function viewAllMahasiswa(){
		// jika user belum login
		if(!isset($_SESSION['isLoggedIn'])) {
			// redirect untuk melakukan login pada form login
			return redirect()->to(base_url().'/authenticate');
		}

		$data = [
			'mahasiswa' => $this->mahasiswa->getAllMahasiswa(),
		];
		echo view('templates/header');
		echo view('templates/nav_admin');
		echo view('admin/mahasiswa', $data);
		echo view('templates/footer');
	}

	public function createMahasiswa(){
		// jika user belum login
		if(!isset($_SESSION['isLoggedIn'])) {
			// redirect untuk melakukan login pada form login
			return redirect()->to(base_url().'/authenticate');
		}

		$data = [
			'method' => 'create',
			'title' => "Tambah Data Mahasiswa",
			'validation' => NULL,
		];

		echo view('templates/header');
		echo view('templates/nav_admin');
		echo view('admin/form_mahasiswa', $data);
		echo view('templates/footer');
	}

	public function insertMahasiswa(){
		$nama_mhs = $this->request->getPost('nama_mhs');
		$tempat_lahir = $this->request->getPost('tempat_lahir');
		$tgl_lahir = $this->request->getPost('tgl_lahir');
		$alamat = $this->request->getPost('alamat');
		$nim = $this->request->getPost('nim');
		$semester = $this->request->getPost('semester');
		$nama_ibu = $this->request->getPost('nama_ibu');
		$penghasilan_ortu = $this->request->getPost('penghasilan_ortu');
		$gol_darah = $this->request->getPost('gol_darah');
		$jml_saudara = $this->request->getPost('jml_saudara');
		$ipk = $this->request->getPost('ipk');
	
		$data = [
			'nama_mhs' => $nama_mhs,
			'tempat_lahir' => $tempat_lahir,
			'tgl_lahir' => $tgl_lahir,
			'alamat' => $alamat,
			'nim' => $nim,
			'semester' => $semester,
			'nama_ibu' => $nama_ibu,
			'penghasilan_ortu' => $penghasilan_ortu,
			'gol_darah' => $gol_darah,
			'jml_saudara' => $jml_saudara,
			'ipk' => $ipk,
		];
	
		// jika isian form TIDAK sesuai dengan persyaratan
		if ($this->form_validation->run($data, 'insertMahasiswa') == FALSE) {
			// jika user belum login
			if(!isset($_SESSION['isLoggedIn'])) {
				// redirect untuk melakukan login pada form login
				return redirect()->to(base_url().'/authenticate');
			}
		
			$data = [
				'method' => 'create',
				'title' => "Tambah Data Mahasiswa",
				'validation' => $this->form_validation,
			];
			
			echo view('templates/header');
			echo view('templates/nav_admin');
			echo view('admin/form_mahasiswa', $data);
			echo view('templates/footer');
		}
		// jika isian form sesuai dengan persyaratan
		else {
			if($this->mahasiswa->insertDataMahasiswa($data)){
				$this->session->setFlashData('success', "Berhasil menambahkan data mahasiswa!");
				return redirect()->to(base_url().'/mahasiswa');
			}
		}
	}

	public function editMahasiswa($id_mahasiswa){
		// jika user belum login
		if(!isset($_SESSION['isLoggedIn'])) {
			// redirect untuk melakukan login pada form login
			return redirect()->to(base_url().'/authenticate');
		}

		$data = [
			'method' => 'edit',
			'title' => "Ubah Data Mahasiswa",
			'validation' => NULL,
			'mhs' => $this->mahasiswa->getMahasiswaById($id_mahasiswa),
		];

		echo view('templates/header');
		echo view('templates/nav_admin');
		echo view('admin/form_mahasiswa', $data);
		echo view('templates/footer');
	}

	public function updateMahasiswa($id_mahasiswa){
		$mhs = $this->mahasiswa->getMahasiswaById($id_mahasiswa);
		// jika id_mahasiswa tidak terdata di database (karena admin mengisi id_mahasiswa yang tidak valid via parameter URL)
		if($mhs == NULL){
			$this->session->setFlashData('danger', "Gagal mengubah data mahasiswa!");
			return redirect()->to(base_url().'/mahasiswa');
		}
		// jika id_mahasiswa terdata di database
		else {
			$nama_mhs = $this->request->getPost('nama_mhs');
			$tempat_lahir = $this->request->getPost('tempat_lahir');
			$tgl_lahir = $this->request->getPost('tgl_lahir');
			$alamat = $this->request->getPost('alamat');
			$semester = $this->request->getPost('semester');
			$nama_ibu = $this->request->getPost('nama_ibu');
			$penghasilan_ortu = $this->request->getPost('penghasilan_ortu');
			$gol_darah = $this->request->getPost('gol_darah');
			$jml_saudara = $this->request->getPost('jml_saudara');
			$ipk = $this->request->getPost('ipk');

			$data = [
				'nama_mhs' => $nama_mhs,
				'tempat_lahir' => $tempat_lahir,
				'tgl_lahir' => $tgl_lahir,
				'alamat' => $alamat,
				'semester' => $semester,
				'nama_ibu' => $nama_ibu,
				'penghasilan_ortu' => $penghasilan_ortu,
				'gol_darah' => $gol_darah,
				'jml_saudara' => $jml_saudara,
				'ipk' => $ipk,
			];

			// jika isian form TIDAK sesuai dengan persyaratan
			if ($this->form_validation->run($data, 'updateMahasiswa') == FALSE) {
				// jika user belum login
				if(!isset($_SESSION['isLoggedIn'])) {
					// redirect untuk melakukan login pada form login
					return redirect()->to(base_url().'/authenticate');
				}

				$data = [
					'method' => 'edit',
					'title' => "Ubah Data Mahasiswa",
					'validation' => $this->form_validation,
					'mhs' => $this->mahasiswa->getMahasiswaById($id_mahasiswa),
				];
				// tampilkan kembali form mahasiswa tersebut
				echo view('templates/header');
				echo view('templates/nav_admin');
				echo view('admin/form_mahasiswa', $data);
				echo view('templates/footer');
			}
			// jika isian form sesuai dengan persyaratan
			else{
				if($this->mahasiswa->updateDataMahasiswa($id_mahasiswa, $data)){
					$this->session->setFlashData('success', "Berhasil mengubah data mahasiswa!");
					// redirect ke tampilan tabel mahasiswa
					return redirect()->to(base_url().'/mahasiswa');
				}
			}
		}
	}

	// function logika delete akun mahasiswa
	public function deleteMahasiswa($id_mahasiswa){
		$mhs = $this->mahasiswa->getMahasiswaById($id_mahasiswa);
		// jika id_mahasiswa tidak terdata di database (karena admin mengisi id_mahasiswa yang tidak valid via parameter URL)
		if($mhs == NULL){
			$this->session->setFlashData('danger', "Gagal menghapus data mahasiswa!");
		}
		// jika id_mahasiswa terdata di database
		else {
			if($this->mahasiswa->deleteDataMahasiswa($id_mahasiswa)){
				$this->session->setFlashData('success', "Berhasil menghapus data mahasiswa!");
			}
		}
		// redirect ke tampilan tabel mahasiswa
		return redirect()->to(base_url().'/mahasiswa');
	}

	public function viewMahasiswa($id_mahasiswa){
		// jika user belum login
		if(!isset($_SESSION['isLoggedIn'])) {
			// redirect untuk melakukan login pada form login
			return redirect()->to(base_url().'/authenticate');
		}

		$data = [
			'title' => 'Detail Data Mahasiswa',
			'mhs' => $this->mahasiswa->getMahasiswaById($id_mahasiswa),
		];

		echo view('templates/header');
		echo view('templates/nav_admin');
		echo view('admin/mahasiswa_detail', $data);
		echo view('templates/footer');
	}

	// ----------------------------------------- Bagian Beasiswa ------------------------------------------
	public function viewAllBeasiswa(){
		// jika user belum login
		if(!isset($_SESSION['isLoggedIn'])) {
			// redirect untuk melakukan login pada form login
			return redirect()->to(base_url().'/authenticate');
		}

		$data = [
			'beasiswa' => $this->beasiswa->getAllBeasiswa(),
		];
		echo view('templates/header');
		echo view('templates/nav_admin');
		echo view('admin/beasiswa', $data);
		echo view('templates/footer');
	}

	public function createBeasiswa(){
		// jika user belum login
		if(!isset($_SESSION['isLoggedIn'])) {
			// redirect untuk melakukan login pada form login
			return redirect()->to(base_url().'/authenticate');
		}

		$data = [
			'method' => 'create',
			'title' => "Tambah Data Beasiswa",
			'validation' => NULL,
		];

		echo view('templates/header');
		echo view('templates/nav_admin');
		echo view('admin/form_beasiswa', $data);
		echo view('templates/footer');
	}

	public function insertBeasiswa(){
		$nama_beasiswa = $this->request->getPost('nama_beasiswa');
		$nama_penyelenggara = $this->request->getPost('nama_penyelenggara');
		$tahun = $this->request->getPost('tahun');
		$kuota = $this->request->getPost('kuota');
		$status = 'Belum';
	
		$data = [
			'nama_beasiswa' => $nama_beasiswa,
			'nama_penyelenggara' => $nama_penyelenggara,
			'tahun' => $tahun,
			'kuota' => $kuota,
			'status' => $status,
		];
	
		// jika isian form TIDAK sesuai dengan persyaratan
		if ($this->form_validation->run($data, 'insertBeasiswa') == FALSE) {
			// jika user belum login
			if(!isset($_SESSION['isLoggedIn'])) {
				// redirect untuk melakukan login pada form login
				return redirect()->to(base_url().'/authenticate');
			}

			$data = [
				'method' => 'create',
				'title' => "Tambah Data Beasiswa",
				'validation' => $this->form_validation,
			];
			
			echo view('templates/header');
			echo view('templates/nav_admin');
			echo view('admin/form_beasiswa', $data);
			echo view('templates/footer');
		}
		// jika isian form sesuai dengan persyaratan
		else {
			if($this->beasiswa->insertDataBeasiswa($data)){
				$this->session->setFlashData('success', "Berhasil menambahkan data beasiswa!");
				return redirect()->to(base_url().'/beasiswa');
			}
		}
	}

	public function editBeasiswa($id_beasiswa){
		// jika user belum login
		if(!isset($_SESSION['isLoggedIn'])) {
			// redirect untuk melakukan login pada form login
			return redirect()->to(base_url().'/authenticate');
		}

		$data = [
			'method' => 'edit',
			'title' => "Ubah Data Beasiswa",
			'validation' => NULL,
			'bsw' => $this->beasiswa->getBeasiswaById($id_beasiswa),
		];

		echo view('templates/header');
		echo view('templates/nav_admin');
		echo view('admin/form_beasiswa', $data);
		echo view('templates/footer');
	}

	public function updateBeasiswa($id_beasiswa){
		$bsw = $this->beasiswa->getBeasiswaById($id_beasiswa);
		// jika id_beasiswa tidak terdata di database (karena admin mengisi id_beasiswa yang tidak valid via parameter URL)
		if($bsw == NULL){
			$this->session->setFlashData('danger', "Gagal mengubah data beasiswa!");
			return redirect()->to(base_url().'/beasiswa');
		}
		// jika id_beasiswa terdata di database
		else {
			$nama_beasiswa = $this->request->getPost('nama_beasiswa');
			$nama_penyelenggara = $this->request->getPost('nama_penyelenggara');
			$tahun = $this->request->getPost('tahun');
			$kuota = $this->request->getPost('kuota');

			$data = [
				'nama_beasiswa' => $nama_beasiswa,
				'nama_penyelenggara' => $nama_penyelenggara,
				'tahun' => $tahun,
				'kuota' => $kuota,
			];

			// jika isian form TIDAK sesuai dengan persyaratan (catatan: persyaratan insert dan update beasiswa sama saja)
			if ($this->form_validation->run($data, 'insertBeasiswa') == FALSE) {
				// jika user belum login
				if(!isset($_SESSION['isLoggedIn'])) {
					// redirect untuk melakukan login pada form login
					return redirect()->to(base_url().'/authenticate');
				}

				$data = [
					'method' => 'edit',
					'title' => "Ubah Data Beasiswa",
					'validation' => $this->form_validation,
					'bsw' => $this->beasiswa->getBeasiswaById($id_beasiswa),
				];
				// tampilkan kembali form beasiswa tersebut
				echo view('templates/header');
				echo view('templates/nav_admin');
				echo view('admin/form_beasiswa', $data);
				echo view('templates/footer');
			}
			// jika isian form sesuai dengan persyaratan
			else{
				if($this->beasiswa->updateDataBeasiswa($id_beasiswa, $data)){
					$this->session->setFlashData('success', "Berhasil mengubah data beasiswa!");
					// redirect ke tampilan tabel beasiswa
					return redirect()->to(base_url().'/beasiswa');
				}
			}
		}
	}

	// function logika delete beasiswa
	public function deleteBeasiswa($id_beasiswa){
		$bsw = $this->beasiswa->getBeasiswaById($id_beasiswa);
		// jika id_mahasiswa tidak terdata di database (karena admin mengisi id_mahasiswa yang tidak valid via parameter URL)
		if($bsw == NULL){
			$this->session->setFlashData('danger', "Gagal menghapus data beasiswa! Beasiswa tidak terdata pada sistem.");
		}
		// jika id_mahasiswa terdata di database
		else {
			$isBerelasi = $this->kriteria->getKriteriaByBeasiswa($id_beasiswa);
			if($isBerelasi == null){
                if ($this->beasiswa->deleteDataBeasiswa($id_beasiswa)) {
                    $this->session->setFlashData('success', "Berhasil menghapus data beasiswa!");
                }
			}
			else {
				$data = [
					'status' => 'Deleted',
				];
				if($this->beasiswa->updateDataBeasiswa($id_beasiswa, $data)){
					$this->session->setFlashData('success', "Status beasiswa berhasil diubah sebagai terhapus.");
				}
			}
		}
		// redirect ke tampilan tabel beasiswa
		return redirect()->to(base_url().'/beasiswa');
	}
	
	public function finishBeasiswa($id_beasiswa){
		$data = [
			'status' => 'Selesai',
		];

		$this->beasiswa->updateDataBeasiswa($id_beasiswa, $data);
		
		// redirect ke tampilan tabel beasiswa
		return redirect()->to(base_url().'/beasiswa');
	}

	public function viewBeasiswa($id_beasiswa){
		// jika user belum login
		if(!isset($_SESSION['isLoggedIn'])) {
			// redirect untuk melakukan login pada form login
			return redirect()->to(base_url().'/authenticate');
		}

		$data = [
			'title' => 'Detail Data Beasiswa',
			'bsw' => $this->beasiswa->getBeasiswaById($id_beasiswa),
		];

		echo view('templates/header');
		echo view('templates/nav_admin');
		echo view('admin/beasiswa_detail', $data);
		echo view('templates/footer');
	}

	// ----------------------------------------- Bagian Kriteria ------------------------------------------
	public function viewAllKriteria($id_beasiswa){
		// jika user belum login
		if(!isset($_SESSION['isLoggedIn'])) {
			// redirect untuk melakukan login pada form login
			return redirect()->to(base_url().'/authenticate');
		}
		
		$status = $this->beasiswa->cekStatus($id_beasiswa);
		$data = [
			'kriteria' => $this->kriteria->getKriteriaByBeasiswa($id_beasiswa),
			'id_beasiswa' => $id_beasiswa,
			'status' => $status[0]['status'],
		];
		echo view('templates/header');
		echo view('templates/nav_admin');
		echo view('admin/kriteria', $data);
		echo view('templates/footer');
	}

	public function createKriteria($id_beasiswa){
		// jika user belum login
		if(!isset($_SESSION['isLoggedIn'])) {
			// redirect untuk melakukan login pada form login
			return redirect()->to(base_url().'/authenticate');
		}

		$data = [
			'method' => 'create',
			'title' => "Tambah Data Kriteria",
			'validation' => NULL,
			'id_beasiswa' => $id_beasiswa,
		];

		echo view('templates/header');
		echo view('templates/nav_admin');
		echo view('admin/form_kriteria', $data);
		echo view('templates/footer');
	}

	public function insertKriteria($id_beasiswa){
		$nama_kriteria = $this->request->getPost('nama_kriteria');
		$sifat = $this->request->getPost('sifat');
		$bobot = $this->request->getPost('bobot');
	
		$data = [
			'nama_kriteria' => $nama_kriteria,
			'sifat' => $sifat,
			'bobot' => $bobot,
			'id_beasiswa' => $id_beasiswa,
		];
	
		// jika isian form TIDAK sesuai dengan persyaratan
		if ($this->form_validation->run($data, 'insertKriteria') == FALSE) {
			// jika user belum login
			if(!isset($_SESSION['isLoggedIn'])) {
				// redirect untuk melakukan login pada form login
				return redirect()->to(base_url().'/authenticate');
			}

			$data = [
				'method' => 'create',
				'title' => "Tambah Data Kriteria",
				'validation' => $this->form_validation,
				'id_beasiswa' => $id_beasiswa,
			];
			
			echo view('templates/header');
			echo view('templates/nav_admin');
			echo view('admin/form_kriteria', $data);
			echo view('templates/footer');
		}
		// jika isian form sesuai dengan persyaratan
		else {
			if($this->kriteria->insertDataKriteria($data)){
				$this->session->setFlashData('success', "Berhasil menambahkan data kriteria!");
				return redirect()->to(base_url().'/kriteria/'.$id_beasiswa);
			}
		}
	}

	public function editKriteria($id_beasiswa, $id_kriteria){
		// jika user belum login
		if(!isset($_SESSION['isLoggedIn'])) {
			// redirect untuk melakukan login pada form login
			return redirect()->to(base_url().'/authenticate');
		}

		$data = [
			'method' => 'edit',
			'title' => "Ubah Data Kriteria",
			'validation' => NULL,
			'krt' => $this->kriteria->getKriteriaById($id_kriteria),
			'id_beasiswa' => $id_beasiswa,
		];

		echo view('templates/header');
		echo view('templates/nav_admin');
		echo view('admin/form_kriteria', $data);
		echo view('templates/footer');
	}

	public function updateKriteria($id_beasiswa, $id_kriteria){
		$krt = $this->kriteria->getKriteriaById($id_kriteria);
		// jika id_kriteria tidak terdata di database (karena admin mengisi id_kriteria yang tidak valid via parameter URL)
		if($krt == NULL){
			$this->session->setFlashData('danger', "Gagal mengubah data kriteria!");
			return redirect()->to(base_url().'/kriteria/'.$id_beasiswa);
		}
		// jika id_kriteria terdata di database
		else {
			$nama_kriteria = $this->request->getPost('nama_kriteria');
			$sifat = $this->request->getPost('sifat');
			$bobot = $this->request->getPost('bobot');

			$data = [
				'nama_kriteria' => $nama_kriteria,
				'sifat' => $sifat,
				'bobot' => $bobot,
			];

			// jika isian form TIDAK sesuai dengan persyaratan (catatan: persyaratan insert dan update kriteria sama saja)
			if ($this->form_validation->run($data, 'insertKriteria') == FALSE) {
				// jika user belum login
				if(!isset($_SESSION['isLoggedIn'])) {
					// redirect untuk melakukan login pada form login
					return redirect()->to(base_url().'/authenticate');
				}

				$data = [
					'method' => 'edit',
					'title' => "Ubah Data Kriteria",
					'validation' => $this->form_validation,
					'krt' => $this->kriteria->getKriteriaById($id_kriteria),
					'id_beasiswa' => $id_beasiswa,
				];
				// tampilkan kembali form beasiswa tersebut
				echo view('templates/header');
				echo view('templates/nav_admin');
				echo view('admin/form_kriteria', $data);
				echo view('templates/footer');
			}
			// jika isian form sesuai dengan persyaratan
			else{
				if($this->kriteria->updateDataKriteria($id_kriteria, $data)){
					$this->session->setFlashData('success', "Berhasil mengubah data kriteria!");
					// redirect ke tampilan tabel kriteria
					return redirect()->to(base_url().'/kriteria/'.$id_beasiswa);
				}
			}
		}
	}

	// function logika delete beasiswa
	public function deleteKriteria($id_beasiswa, $id_kriteria){
		$krt = $this->kriteria->getKriteriaById($id_kriteria);
		// jika id_kriteria tidak terdata di database (karena admin mengisi id_mahasiswa yang tidak valid via parameter URL)
		if($krt == null){
			$this->session->setFlashData('danger', "Gagal menghapus data kriteria! Kriteria tidak terdata pada sistem.");
		}
		// jika id_kriteria terdata di database
		else {
			$isBerelasi = $this->bobot->getBobotByKriteria($id_kriteria);
			if($isBerelasi == null){
                if ($this->kriteria->deleteDataKriteria($id_kriteria)) {
                    $this->session->setFlashData('success', "Berhasil menghapus data kriteria!");
                }
			}
			else {
				$this->session->setFlashData('danger', "Gagal menghapus data kriteria! Hapus terlebih dahulu bobot untuk kriteria.");
			}
		}
		// redirect ke tampilan tabel kriteria
		return redirect()->to(base_url().'/kriteria/'.$id_beasiswa);
	}

	// ----------------------------------------- Bagian Bobot ------------------------------------------
	public function viewAllBobot($id_beasiswa, $id_kriteria){
		// jika user belum login
		if(!isset($_SESSION['isLoggedIn'])) {
			// redirect untuk melakukan login pada form login
			return redirect()->to(base_url().'/authenticate');
		}

		$status = $this->beasiswa->cekStatus($id_beasiswa);
		$data = [
			'bobot' => $this->bobot->getBobotByKriteria($id_kriteria),
			'id_beasiswa' => $id_beasiswa,
			'id_kriteria' => $id_kriteria,
			'status' => $status[0]['status'],
		];
		echo view('templates/header');
		echo view('templates/nav_admin');
		echo view('admin/bobot', $data);
		echo view('templates/footer');
	}

	public function createBobot($id_beasiswa, $id_kriteria){
		// jika user belum login
		if(!isset($_SESSION['isLoggedIn'])) {
			// redirect untuk melakukan login pada form login
			return redirect()->to(base_url().'/authenticate');
		}

		$data = [
			'method' => 'create',
			'title' => "Tambah Data Bobot",
			'validation' => NULL,
			'id_beasiswa' => $id_beasiswa,
			'id_kriteria' => $id_kriteria,
		];

		echo view('templates/header');
		echo view('templates/nav_admin');
		echo view('admin/form_bobot', $data);
		echo view('templates/footer');
	}

	public function insertBobot($id_beasiswa, $id_kriteria){
		$keterangan = $this->request->getPost('keterangan');
		$value = $this->request->getPost('value');
	
		$data = [
			'keterangan' => $keterangan,
			'value' => $value,
			'id_beasiswa' => $id_beasiswa,
			'id_kriteria' => $id_kriteria,
		];
	
		// jika isian form TIDAK sesuai dengan persyaratan
		if ($this->form_validation->run($data, 'insertBobot') == FALSE) {
			// jika user belum login
			if(!isset($_SESSION['isLoggedIn'])) {
				// redirect untuk melakukan login pada form login
				return redirect()->to(base_url().'/authenticate');
			}

			$data = [
				'method' => 'create',
				'title' => "Tambah Data Bobot",
				'validation' => $this->form_validation,
				'id_beasiswa' => $id_beasiswa,
				'id_kriteria' => $id_kriteria,
			];
			
			echo view('templates/header');
			echo view('templates/nav_admin');
			echo view('admin/form_bobot', $data);
			echo view('templates/footer');
		}
		// jika isian form sesuai dengan persyaratan
		else {
			if($this->bobot->insertDataBobot($data)){
				$this->session->setFlashData('success', "Berhasil menambahkan data bobot!");
				return redirect()->to(base_url().'/bobot/'.$id_beasiswa.'/'.$id_kriteria);
			}
		}
	}

	public function editBobot($id_beasiswa, $id_kriteria, $id_bobot){
		// jika user belum login
		if(!isset($_SESSION['isLoggedIn'])) {
			// redirect untuk melakukan login pada form login
			return redirect()->to(base_url().'/authenticate');
		}

		$data = [
			'method' => 'edit',
			'title' => "Ubah Data Bobot",
			'validation' => NULL,
			'bbt' => $this->bobot->getBobotById($id_bobot),
			'id_beasiswa' => $id_beasiswa,
			'id_kriteria' => $id_kriteria,
		];

		echo view('templates/header');
		echo view('templates/nav_admin');
		echo view('admin/form_bobot', $data);
		echo view('templates/footer');
	}

	public function updateBobot($id_beasiswa, $id_kriteria, $id_bobot){
		$bbt = $this->bobot->getBobotById($id_bobot);
		// jika id_kriteria tidak terdata di database (karena admin mengisi id_kriteria yang tidak valid via parameter URL)
		if($bbt == NULL){
			$this->session->setFlashData('danger', "Gagal mengubah data bobot!");
			return redirect()->to(base_url().'/bobot/'.$id_beasiswa.'/'.$id_kriteria);
		}
		// jika id_kriteria terdata di database
		else {
			$keterangan = $this->request->getPost('keterangan');
			$value = $this->request->getPost('value');

			$data = [
				'keterangan' => $keterangan,
				'value' => $value,
				'id_beasiswa' => $id_beasiswa,
				'id_kriteria' => $id_kriteria,
			];

			// jika isian form TIDAK sesuai dengan persyaratan (catatan: persyaratan insert dan update bobot sama saja)
			if ($this->form_validation->run($data, 'insertBobot') == FALSE) {
				// jika user belum login
				if(!isset($_SESSION['isLoggedIn'])) {
					// redirect untuk melakukan login pada form login
					return redirect()->to(base_url().'/authenticate');
				}

				$data = [
					'method' => 'edit',
					'title' => "Ubah Data Bobot",
					'validation' => $this->form_validation,
					'bbt' => $this->bobot->getBobotById($id_bobot),
					'id_beasiswa' => $id_beasiswa,
					'id_kriteria' => $id_kriteria,
				];
				// tampilkan kembali form beasiswa tersebut
				echo view('templates/header');
				echo view('templates/nav_admin');
				echo view('admin/form_bobot', $data);
				echo view('templates/footer');
			}
			// jika isian form sesuai dengan persyaratan
			else{
				if($this->bobot->updateDataBobot($id_bobot, $data)){
					$this->session->setFlashData('success', "Berhasil mengubah data bobot!");
					// redirect ke tampilan tabel kriteria
					return redirect()->to(base_url().'/bobot/'.$id_beasiswa.'/'.$id_kriteria);
				}
			}
		}
	}

	// function logika delete beasiswa
	public function deleteBobot($id_beasiswa, $id_kriteria, $id_bobot){
		$bbt = $this->bobot->getBobotById($id_bobot);
		// jika id_bobot tidak terdata di database (karena admin mengisi id_bobot yang tidak valid via parameter URL)
		if($bbt == NULL){
			$this->session->setFlashData('danger', "Gagal menghapus data bobot! Bobot tidak terdata pada sistem.");
		}
		// jika id_bobot terdata di database
		else {
			if($this->bobot->deleteDataBobot($id_bobot)){
				$this->session->setFlashData('success', "Berhasil menghapus data bobot!");
			}
		}
		// redirect ke tampilan tabel bobot
		return redirect()->to(base_url().'/bobot/'.$id_beasiswa.'/'.$id_kriteria);
	}

	// ----------------------------------------- Bagian Kecocokan ------------------------------------------
	// menampilkan tabel beasiswa yang sudah dicocokkan
	public function viewBeasiswaPadaKecocokan(){
		// jika user belum login
		if(!isset($_SESSION['isLoggedIn'])) {
			// redirect untuk melakukan login pada form login
			return redirect()->to(base_url().'/authenticate');
		}

		$data = [
			'beasiswa' => $this->beasiswa->getBeasiswaForKecocokan(),
		];
		echo view('templates/header');
		echo view('templates/nav_admin');
		echo view('admin/kecocokan_beasiswa', $data);
		echo view('templates/footer');
	}

	// menampilkan form tambah kecocokan
	public function createKecocokan(){
		// jika user belum login
		if(!isset($_SESSION['isLoggedIn'])) {
			// redirect untuk melakukan login pada form login
			return redirect()->to(base_url().'/authenticate');
		}

		$data = [
			'method' => 'tampil',
			'title' => "Tambah Data Kecocokan",
			'validation' => NULL,
			'beasiswa' => $this->beasiswa->getBeasiswaForInsertKecocokan(),
			'mahasiswa' => $this->mahasiswa->getAllMahasiswa(),
		];

		echo view('templates/header');
		echo view('templates/nav_admin');
		echo view('admin/form_kecocokan', $data);
		echo view('templates/footer');
	}

	public function insertKecocokan($method){
		if($method == 'tampil') {
			$id_mahasiswa = $this->request->getPost('id_mahasiswa');
			$id_beasiswa = $this->request->getPost('id_beasiswa');

			$data = [
				'beasiswa' => $id_mahasiswa,
				'mahasiswa' => $id_beasiswa,
			];

			if($this->form_validation->run($data, 'tampilKecocokan') == FALSE) {
				// jika user belum login
				if(!isset($_SESSION['isLoggedIn'])) {
					// redirect untuk melakukan login pada form login
					return redirect()->to(base_url().'/authenticate');
				}
				
				$data = [
					'method' => 'tampil',
					'title' => "Tambah Data Kecocokan",
					'validation' => $this->form_validation,
					'beasiswa' => $this->beasiswa->getBeasiswaForInsertKecocokan(),
					'mahasiswa' => $this->mahasiswa->getAllMahasiswa(),
				];
			}
			else {
				// ketika Admin memilih untuk menampilkan kriteria yg harus diisi dari mahasiswa tsb
				$data = [
					'method' => 'create',
					'title' => "Tambah Data Kecocokan",
					'validation' => NULL,
					'id_beasiswa' => $id_beasiswa,
					'bsw' => $this->beasiswa->getBeasiswaById($id_beasiswa),
					'id_mahasiswa' => $id_mahasiswa,
					'mhs' => $this->mahasiswa->getMahasiswaById($id_mahasiswa),
					// menampilkan kriteria apa saja yg harus diisi admin
					'kriteria' => $this->kriteria->getKriteriaByBeasiswa($id_beasiswa),
					// get bobot dari beasiswa untuk dilakukan pencocokan nilai bobot yg diperoleh oleh mhs
					'bobot' => $this->bobot->getBobotByBeasiswa($id_beasiswa),
				];
			}
	
			echo view('templates/header');
			echo view('templates/nav_admin');
			echo view('admin/form_kecocokan', $data);
			echo view('templates/footer');
		}
		else {
            $id_mahasiswa = $this->request->getPost('id_mahasiswa');
            $id_beasiswa = $this->request->getPost('id_beasiswa');

			$arr_idKriteria = $this->request->getPost('id_kriteria');
            $arr_nilai = $this->request->getPost('nilai');
			
            $data = [
                'id_mahasiswa' => $id_mahasiswa,
                'id_beasiswa' => $id_beasiswa,
                'id_kriteria' => $arr_idKriteria,
                'nilai' => $arr_nilai,
            ];

            // jika isian form TIDAK sesuai dengan persyaratan
            if ($this->form_validation->run($data, 'insertKecocokan') == false) {
				// jika user belum login
				if(!isset($_SESSION['isLoggedIn'])) {
					// redirect untuk melakukan login pada form login
					return redirect()->to(base_url().'/authenticate');
				}

                $data = [
                    'method' => 'create',
                    'title' => "Tambah Data Kecocokan",
                    'validation' => $this->form_validation,
                    'id_beasiswa' => $id_beasiswa,
                    'bsw' => $this->beasiswa->getBeasiswaById($id_beasiswa),
                    'id_mahasiswa' => $id_mahasiswa,
                    'mhs' => $this->mahasiswa->getMahasiswaById($id_mahasiswa),
                    'kriteria' => $this->kriteria->getKriteriaByBeasiswa($id_beasiswa),
                    'bobot' => $this->bobot->getBobotByBeasiswa($id_beasiswa),
                ];
                
                echo view('templates/header');
                echo view('templates/nav_admin');
                echo view('admin/form_kecocokan', $data);
                echo view('templates/footer');
            }
            // jika isian form sesuai dengan persyaratan
            else {
                if ($this->kecocokan->insertDataKecocokan($data)) {
                    $this->session->setFlashData('success', "Berhasil menambahkan data kecocokan!");
                    return redirect()->to(base_url().'/kecocokan/beasiswa');
                }
            }
        }
	}

	// menampilkan tabel mahasiswa yang sudah dicocokkan
	public function viewMahasiswaPadaKecocokan($id_beasiswa){
		// jika user belum login
		if(!isset($_SESSION['isLoggedIn'])) {
			// redirect untuk melakukan login pada form login
			return redirect()->to(base_url().'/authenticate');
		}

		$data = [
			'mahasiswa' => $this->mahasiswa->getMahasiswaForKecocokan($id_beasiswa),
			'id_beasiswa' => $id_beasiswa,
		];
		echo view('templates/header');
		echo view('templates/nav_admin');
		echo view('admin/kecocokan_mahasiswa', $data);
		echo view('templates/footer');
	}

	// menampilkan tabel kecocokan yg berisi nama kriteria beserta nilai bobot yg diperoleh oleh suatu mahasiswa
	public function viewKecocokan($id_beasiswa, $id_mahasiswa){
		// jika user belum login
		if(!isset($_SESSION['isLoggedIn'])) {
			// redirect untuk melakukan login pada form login
			return redirect()->to(base_url().'/authenticate');
		}

		$data = [
			'kecocokan' => $this->kecocokan->getKecocokan($id_beasiswa, $id_mahasiswa),
		];
		echo view('templates/header');
		echo view('templates/nav_admin');
		echo view('admin/kecocokan', $data);
		echo view('templates/footer');
	}

	// ----------------------------------------- Bagian Hasil Perhitungan ------------------------------------------
	public function viewBeasiswaPadaHasil(){
		// jika user belum login
		if(!isset($_SESSION['isLoggedIn'])) {
			// redirect untuk melakukan login pada form login
			return redirect()->to(base_url().'/authenticate');
		}
		
		$data = [
			'beasiswa' => $this->beasiswa->getBeasiswaForHasil(),
		];
		echo view('templates/header');
		echo view('templates/nav_admin');
		echo view('admin/hasil_beasiswa', $data);
		echo view('templates/footer');
	}

	public function viewHasilByBeasiswa($id_beasiswa){
		$hasil = $this->hasil->doHitung($id_beasiswa);
		foreach($hasil as $hsl){
			$mhs = $this->hasil->cekMahasiswa($id_beasiswa, $hsl['id_mahasiswa']);
			
			if(sizeof($mhs) == 0) {
				$data = [
					'id_beasiswa' => $id_beasiswa,
					'id_mahasiswa' => $hsl['id_mahasiswa'],
					'nilai' => $hsl['ranking'],
				];
				$this->hasil->insertHasil($data);
			}
		}

		// jika user belum login
		if(!isset($_SESSION['isLoggedIn'])) {
			// redirect untuk melakukan login pada form login
			return redirect()->to(base_url().'/authenticate');
		}

		$data = [
			'hasil' => $hasil,
		];
		echo view('templates/header');
		echo view('templates/nav_admin');
		echo view('admin/hasil', $data);
		echo view('templates/footer');
	}
}