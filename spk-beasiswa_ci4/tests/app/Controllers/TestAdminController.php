<?php

namespace App;

use CodeIgniter\Test\FeatureTestCase;

use App\Models\AkunModel;

class TestAdminController extends FeatureTestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function tearDown(): void
    {
        parent::tearDown();
    }

    // --------------------------- berkaitan dengan login dan session ------------------------

    public function testAuthenticate(){
        $result = $this->call('get', "/authenticate");
        $result->assertOK();
        $result->assertSee("Login Admin");
    }

    public function testLogin(){
        $akunModel = new AkunModel();
        $username = 'admin';
        $password = 'pass4admin';

        $data = [
            'username' => $username,
            'password' => $password,
        ];

        $form_validation = \Config\Services::validation();
        if ($form_validation->run($data, 'login') == true) {
            $akun = $akunModel->getAkunByUsername($username);
        
            $data = [
                'id' => $akun['id_akun'],
                'username' => $akun['username'],
                'isLoggedIn' => true,
            ];

            $result = $this->withSession($data)
                ->get('AdminController');
        }

        $result = $this->call('post', "/login");
        $result->assertOK();
        $result->assertSessionHas('username', 'admin');
    }

    public function testIndex(){
        $result = $this->call('get', "/index");
        $result->assertOK();
        $result->assertSee("Selamat Datang"); //berhasil hanya jika cek session di-disable
    }

    public function testHome(){
        $result = $this->call('get', "/home");
        $result->assertOK();
        $result->assertSee("Selamat Datang"); //berhasil hanya jika cek session di-disable
    }

    // ----------------------- berkaitan dengan Akun ----------------------------------------
    
    public function testViewAllAkun(){
        $result = $this->call('get', "/admin");
        $result->assertOK();
        $result->assertSee("1"); //berhasil hanya jika cek session di-disable
    }

    public function testCreateAkun(){
        $result = $this->call('get', "/admin/createAkun");
        $result->assertOK();
        $result->assertSee("Tambah Data Admin"); //berhasil hanya jika cek session di-disable
    }

    public function testInsertAkun(){
        $result = $this->call('post', "/admin/insertAkun");
        $result->assertOK();
    }

    public function testEditAkun(){
        $result = $this->call('get', "/admin/editAkun/1");
        $result->assertOK();
        $result->assertSee("Ubah Data Admin"); //berhasil hanya jika cek session di-disable
    }

    public function testUpdateAkun(){
        $result = $this->call('put', "/AdminController/updateAkun/1");
        $result->assertOK();
    }

    // public function testDeleteAkun(){
    //     $result = $this->call('delete', "/AdminController/deleteAkun/1");
    //     $result->assertOK();
    // }

    // ----------------------- berkaitan dengan Mahasiswa ----------------------------------------
    public function testViewAllMahasiswa(){
        $result = $this->call('get', "/mahasiswa");
        $result->assertOK();
        $result->assertSee("1"); //berhasil hanya jika cek session di-disable
    }

    public function testCreateMahasiswa(){
        $result = $this->call('get', "/mahasiswa/createMahasiswa");
        $result->assertOK();
        $result->assertSee("Tambah Data Mahasiswa"); //berhasil hanya jika cek session di-disable
    }

    public function testInsertMahasiswa(){
        $result = $this->call('post', "/mahasiswa/insertMahasiswa");
        $result->assertOK();
    }

    public function testEditMahasiswa(){
        $result = $this->call('get', "/mahasiswa/editMahasiswa/1");
        $result->assertOK();
        $result->assertSee("Ubah Data Mahasiswa"); //berhasil hanya jika cek session di-disable
    }

    public function testUpdateMahasiswa(){
        $result = $this->call('put', "/AdminController/updateMahasiswa/1");
        $result->assertOK();
    }

    // public function testDeleteMahasiswa(){
    //     $result = $this->call('delete', "/AdminController/deleteMahasiswa/10");
    //     $result->assertOK();
    // }

    public function testViewMahasiswa(){
        $result = $this->call('get', "/mahasiswa/detailMahasiswa/1");
        $result->assertOK();
        $result->assertSee("Golongan Darah"); //berhasil hanya jika cek session di-disable
    }

    // ----------------------- berkaitan dengan Beasiswa ----------------------------------------
    public function testViewAllBeasiswa(){
        $result = $this->call('get', "/beasiswa");
        $result->assertOK();
        $result->assertSee("1"); //berhasil hanya jika cek session di-disable
    }

    public function testCreateBeasiswa(){
        $result = $this->call('get', "/beasiswa/createBeasiswa");
        $result->assertOK();
        $result->assertSee("Tambah Data Beasiswa"); //berhasil hanya jika cek session di-disable
    }

    public function testInsertBeasiswa(){
        $result = $this->call('post', "/beasiswa/insertBeasiswa");
        $result->assertOK();
    }

    public function testEditBeasiswa(){
        $result = $this->call('get', "/beasiswa/editBeasiswa/1");
        $result->assertOK();
        $result->assertSee("Ubah Data Beasiswa"); //berhasil hanya jika cek session di-disable
    }

    public function testUpdateBeasiswa(){
        $result = $this->call('put', "/AdminController/updateBeasiswa/1");
        $result->assertOK();
    }

    // public function testDeleteBeasiswa(){
    //     $result = $this->call('delete', "/AdminController/deleteBeasiswa/9");
    //     $result->assertOK();
    // }

    public function testViewBeasiswa(){
        $result = $this->call('get', "/beasiswa/detailBeasiswa/1");
        $result->assertOK();
        $result->assertSee("Penyelenggara"); //berhasil hanya jika cek session di-disable
    }
    
    public function testFinishBeasiswa(){
        $result = $this->call('post', "/beasiswa/finishBeasiswa/1");
        $result->assertOK();
    }

    // ----------------------- berkaitan dengan Kriteria ----------------------------------------
    public function testViewAllKriteria(){
        $result = $this->call('get', "/kriteria/9");
        $result->assertOK();
        $result->assertSee("1"); //berhasil hanya jika cek session di-disable
    }

    public function testCreateKriteria(){
        $result = $this->call('get', "/kriteria/createKriteria/9");
        $result->assertOK();
        $result->assertSee("Tambah Data Kriteria"); //berhasil hanya jika cek session di-disable
    }

    public function testInsertKriteria(){
        $result = $this->call('post', "/kriteria/insertKriteria/9");
        $result->assertOK();
    }

    public function testEditKriteria(){
        $result = $this->call('get', "/kriteria/editKriteria/9/23");
        $result->assertOK();
        $result->assertSee("Ubah Data Kriteria"); //berhasil hanya jika cek session di-disable
    }

    public function testUpdateKriteria(){
        $result = $this->call('put', "/AdminController/updateKriteria/9/23");
        $result->assertOK();
    }

    // public function testDeleteKriteria(){
    //     $result = $this->call('delete', "/AdminController/deleteKriteria/9/23");
    //     $result->assertOK();
    // }

    // ----------------------- berkaitan dengan Bobot ----------------------------------------
    public function testViewAllBobot(){
        $result = $this->call('get', "/bobot/9/23");
        $result->assertOK();
        $result->assertSee("1"); //berhasil hanya jika cek session di-disable
    }

    public function testCreateBobot(){
        $result = $this->call('get', "/bobot/createBobot/9/23");
        $result->assertOK();
        $result->assertSee("Tambah Data Bobot"); //berhasil hanya jika cek session di-disable
    }

    public function testInsertBobot(){
        $result = $this->call('post', "/bobot/insertBobot/9/23");
        $result->assertOK();
    }

    public function testEditBobot(){
        $result = $this->call('get', "/bobot/editBobot/9/23/69");
        $result->assertOK();
        $result->assertSee("Ubah Data Bobot"); //berhasil hanya jika cek session di-disable
    }

    public function testUpdateBobot(){
        $result = $this->call('put', "/AdminController/updateBobot/9/23/69");
        $result->assertOK();
    }

    // public function testDeleteBobot(){
    //     $result = $this->call('delete', "/AdminController/deleteBobot/9/23/69");
    //     $result->assertOK();
    // }

    // ----------------------- berkaitan dengan Kecocokan ----------------------------------------
    public function testViewBeasiswaPadaKecocokan(){
        $result = $this->call('get', "/kecocokan/beasiswa");
        $result->assertOK();
        $result->assertSee("Data Beasiswa pada Kecocokan"); //berhasil hanya jika cek session di-disable

        $beasiswaModel = model('BeasiswaModel');
        $beasiswa = $beasiswaModel->getBeasiswaForKecocokan();
        // membandingkan jumlah hasilnya, dimana minimal ada 1 record beasiswa di tabel hasil
        $this->assertGreaterThan(1, sizeof($beasiswa));
    }

    public function testViewMahasiswaPadaKecocokan(){
        $result = $this->call('get', "/kecocokan/mahasiswa/4");
        $result->assertOK();
        $result->assertSee("Data Mahasiswa pada Kecocokan"); //berhasil hanya jika cek session di-disable
    }

    public function testViewKecocokan(){
        $result = $this->call('get', "/kecocokan/4/5");
        $result->assertOK();
        $result->assertSee("Data Kriteria Mahasiswa pada Kecocokan"); //berhasil hanya jika cek session di-disable
    }

    public function testCreateKecocokan(){
        $result = $this->call('get', "/kecocokan/createKecocokan");
        $result->assertOK();
        $result->assertSee("Tambah Data Kecocokan"); //berhasil hanya jika cek session di-disable
    }

    public function testInsertKecocokan(){
        $result = $this->call('post', "/kecocokan/insertKecocokan/tampil");
        $result->assertOK();
    }
    
    // ----------------------- berkaitan dengan Perhitungan Hasil ----------------------------------------
    public function testViewBeasiswaPadaHasil(){
        $result = $this->call('get', "/hasil/beasiswa");
        $result->assertOK();
        $result->assertSee("Data Beasiswa pada Hasil"); //berhasil hanya jika cek session di-disable

        $beasiswaModel = model('BeasiswaModel');
        $beasiswa = $beasiswaModel->getBeasiswaForHasil();
        // membandingkan jumlah hasilnya, dimana minimal ada 1 record beasiswa di tabel hasil
        $this->assertGreaterThan(1, sizeof($beasiswa));
    }

    public function testViewHasilByBeasiswa(){
        $result = $this->call('get', "/hasil/1");
        $result->assertOK();
        $result->assertSee("Data Mahasiswa pada Hasil"); //berhasil hanya jika cek session di-disable

        $hasilModel = model('HasilModel');
		$hasil = $hasilModel->doHitung(1);

        $arr_mhs = [
            'id_mahasiswa' => [
                0 => 2,
                1 => 3,
                2 => 1,
            ],
        ];
        $i = 0;
		foreach($hasil as $hsl){
			$mhs = $hasilModel->cekMahasiswa(1, $hsl['id_mahasiswa']);
			
			if(sizeof($mhs) == 0) {
				$data = [
					'id_beasiswa' => 1,
					'id_mahasiswa' => $hsl['id_mahasiswa'],
					'nilai' => $hsl['ranking'],
				];
                // jika id_mahasiswa dari data mahasiswa yg muncul di tabel sesuai dgn id_mahasiswa di db
				$this->assertEquals($arr_mhs['id_mahasiswa'][$i++], $data['id_mahasiswa']);
			}
		}
    }
}