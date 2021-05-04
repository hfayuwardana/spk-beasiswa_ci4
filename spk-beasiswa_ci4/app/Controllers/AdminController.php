<?php

namespace App\Controllers;
use App\Models\AkunModel;
use App\Models\MahasiswaModel;
use App\Models\BeasiswaModel;

class AdminController extends BaseController
{
	protected $helpers = ['form', 'url'];
	protected $akun;

	public function __construct()
	{
		$this->form_validation = \Config\Services::validation();
		$this->session = session();

		$this->akun = new AkunModel();
		$this->mahasiswa = new MahasiswaModel();
		$this->beasiswa = new BeasiswaModel();
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
			return redirect()->to(base_url());
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
			return redirect()->to(base_url());
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
		// jika user belum login
		else {
			// redirect ke halaman login
			return redirect()->to(base_url().'/authenticate');
		}
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
			'password' => $password,
		];
	
		// jika isian form TIDAK sesuai dengan persyaratan
		if ($this->form_validation->run($data, 'insertAkun') == FALSE) {
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
				'password' => $password,
			];

			// jika isian form TIDAK sesuai dengan persyaratan
			if ($this->form_validation->run($data, 'updateAkun') == FALSE) {
				$data = [
					'method' => 'edit',
					'title' => "Ubah Data Admin",
					'validation' => $this->form_validation,
					'user' => $this->akun->getAkunById($id_akun),
				];
				// tampilkan kembali form akun tersebut
				echo view('templates/header');
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
		$data = [
			'mahasiswa' => $this->mahasiswa->getAllMahasiswa(),
		];
		echo view('templates/header');
		echo view('templates/nav_admin');
		echo view('admin/mahasiswa', $data);
		echo view('templates/footer');
	}

	public function createMahasiswa(){
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
				$data = [
					'method' => 'edit',
					'title' => "Ubah Data Mahasiswa",
					'validation' => $this->form_validation,
					'mhs' => $this->mahasiswa->getMahasiswaById($id_mahasiswa),
				];
				// tampilkan kembali form akun tersebut
				echo view('templates/header');
				echo view('templates/nav_admin');
				echo view('admin/form_mahasiswa', $data);
				echo view('templates/footer');
			}
			// jika isian form sesuai dengan persyaratan
			else{
				if($this->mahasiswa->updateDataMahasiswa($id_mahasiswa, $data)){
					$this->session->setFlashData('success', "Berhasil mengubah data mahasiswa!");
					// redirect ke tampilan tabel akun mahasiswa
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
		// redirect ke tampilan tabel akun admin
		return redirect()->to(base_url().'/mahasiswa');
	}

	public function viewMahasiswa($id_mahasiswa){
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
		$data = [
			'beasiswa' => $this->beasiswa->getAllBeasiswa(),
		];
		echo view('templates/header');
		echo view('templates/nav_admin');
		echo view('admin/beasiswa', $data);
		echo view('templates/footer');
	}

	public function createBeasiswa(){
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
}