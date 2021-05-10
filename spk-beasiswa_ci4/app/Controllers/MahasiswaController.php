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

    public function index(){
        echo view('mahasiswa/home_mhs');
    }

    public function createDataPribadi(){
        $data = [
            'validation' => null,
            'pesan' => 'Error! Data Anda tidak ditemukan, harap hubungi Admin jika ini suatu kesalahan.',
        ];

        echo view('mahasiswa/verifikasi', $data);
    }

    public function viewDataPribadi(){
        $data = [
            'validation' => $this->form_validation,
            'nim' => $this->request->getPost('nim'),
            'nama_ibu' => $this->request->getPost('nama_ibu'),
            'tgl_lahir' => $this->request->getPost('tgl_lahir'),
        ];

        if($this->form_validation->run($data, 'verifikasi') == FALSE){
            $data = [
                'validation' => $this->form_validation,
                'pesan' => 'Error! Harap isi seluruh identitas yang diminta.'
            ];

            echo view('mahasiswa/verifikasi', $data);
        }
        else {
            $mhs = $this->mahasiswa->getMahasiswaByVerif($data);
           
            if($mhs != null) {
                $data['mhs'] = $mhs[0];
                echo view('mahasiswa/detail_mhs', $data);
            }
            else {
                $this->session->setFlashData('danger', "Error");
                // redirect ke tampilan tabel mahasiswa
                return redirect()->to(base_url().'/mhs/verifikasi');
            }
        }
    }

    public function viewPengumumanBeasiswa(){
        $beasiswa = $this->beasiswa->getBeasiswaForPengumuman();
        
        $data = [
            'beasiswa' => $beasiswa,
        ];

        echo view('mahasiswa/beasiswa', $data);
    }

    public function cariPengumumanBeasiswa(){
        $katakunci = $this->request->getGet('searchBeasiswa');
        
        $beasiswa = $this->beasiswa->getBeasiswaForSearchPengumuman($katakunci);

        $data = [
            'beasiswa' => $beasiswa,
        ];

        echo view('mahasiswa/beasiswa', $data);
    }

    public function viewMahasiswaLolos($id_beasiswa){
        $hasil = $this->hasil->getHasilForPengumuman($id_beasiswa);

        $data = [
            'hasil' => $hasil,
        ];

        echo view ('mahasiswa/lolos', $data);
    }
}