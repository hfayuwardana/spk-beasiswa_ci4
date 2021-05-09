<?php

namespace App\Controllers;
use App\Models\MahasiswaModel;
use App\Models\HasilModel;

class MahasiswaController extends BaseController
{
	protected $helpers = ['form', 'url'];

	public function __construct()
	{
		$this->form_validation = \Config\Services::validation();

		$this->mahasiswa = new MahasiswaModel();
		$this->hasil = new HasilModel();
	}

    public function index(){
        echo view('mahasiswa/home_mhs');
    }

    public function createDataPribadi(){
        $data = [
            'validation' => null,
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
            ];

            echo view('mahasiswa/verifikasi', $data);
        }
        else {
            $mhs = $this->mahasiswa->getMahasiswaByVerif($data);
            $sialan = "SIALAN";
            $data = [
                'sialan' => $sialan,
            ];
            
            echo view('mahasiswa/detail_mhs', $data);
        }
    }

    public function viewPengumumanBeasiswa(){

    }

    public function viewMahasiswaLolos(){

    }
}