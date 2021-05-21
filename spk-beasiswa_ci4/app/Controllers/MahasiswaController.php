<?php

namespace App\Controllers;

use App\Models\BeasiswaModel;
use App\Models\MahasiswaModel;
use App\Models\HasilModel;

class MahasiswaController extends BaseController
{
	protected $helpers = ['form', 'url'];

	public function __construct()
	{
		$this->form_validation = \Config\Services::validation();
        $this->session = session();
        
		$this->mahasiswa = new MahasiswaModel();
        $this->beasiswa = new BeasiswaModel();
		$this->hasil = new HasilModel();
	}

    /* function menampilkan home mahasiswa */
    public function index(){
        echo view('mahasiswa/home_mhs');
    }

    /* function menampilkan form cari data pribadi untuk pengisian nim, nama ibu, dan tgl lahir */
    public function cariDataPribadi(){
        $data = [
            'validation' => null,
            // menampilkan pesan error khusus ketika terjadi error
            'pesan' => 'Error! Data Anda tidak ditemukan, harap hubungi Admin jika ini suatu kesalahan.',
        ];
        
        echo view('mahasiswa/verifikasi', $data);
    }

    /* function logika untuk mengecek isian form cari data pribadi, dan menampilkan detail data pribadi mahasiswa ketika isian form sesuai */
    public function viewDataPribadi(){
        $data = [
            'validation' => $this->form_validation,
            'nim' => $this->request->getPost('nim'),
            'nama_ibu' => $this->request->getPost('nama_ibu'),
            'tgl_lahir' => $this->request->getPost('tgl_lahir'),
        ];

        // jika isian form tidak lengkap
        if($this->form_validation->run($data, 'verifikasi') == FALSE){
            $data = [
                'validation' => $this->form_validation,
                // tampilkan pesan untuk meminta user mengisi isian yang kosong
                'pesan' => 'Error! Harap isi seluruh identitas yang diminta.'
            ];

            echo view('mahasiswa/verifikasi', $data);
        }
        // jika isian form lengkap
        else {
            $mhs = $this->mahasiswa->getMahasiswaByVerif($data);
           
            // jika isian form match dengan data mahasiswa di database
            if($mhs != null) {
                $data['mhs'] = $mhs[0];
                echo view('mahasiswa/detail_mhs', $data);
            }
            // jika isian form TIDAK match dengan data mahasiswa di database
            else {
                // pesan danger
                $this->session->setFlashData('danger', "Error");
                // redirect ke tampilan form cari data pribadi
                return redirect()->to(base_url().'/mhs/verifikasi');
            }
        }
    }

    /* function menampilkan nama-nama beasiswa yang sudah pengumuman */
    public function viewPengumumanBeasiswa(){
        $beasiswa = $this->beasiswa->getBeasiswaForPengumuman();
        
        $data = [
            'beasiswa' => $beasiswa,
        ];

        echo view('mahasiswa/beasiswa', $data);
    }

    /* function logika untuk memfilter nama beasiswa melalui box pencarian */
    public function cariPengumumanBeasiswa(){
        $katakunci = $this->request->getGet('searchBeasiswa');
        
        $beasiswa = $this->beasiswa->getBeasiswaForSearchPengumuman($katakunci);

        $data = [
            'beasiswa' => $beasiswa,
        ];

        echo view('mahasiswa/beasiswa', $data);
    }

    /* function menampilkan nama-nama mahasiswa yang lolos beasiswa tertentu */
    public function viewMahasiswaLolos($id_beasiswa){
        $kuota = $this->beasiswa->getKuotaByBeasiswa($id_beasiswa);
        $k = $kuota[0]['kuota'];
        $hasil = $this->hasil->getHasilForPengumuman($id_beasiswa, $k);

        $data = [
            'hasil' => $hasil,
        ];

        echo view ('mahasiswa/lolos', $data);
    }
}