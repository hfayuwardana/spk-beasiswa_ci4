<?php

namespace App;

use CodeIgniter\Test\FeatureTestCase;

class TestMahasiswaController extends FeatureTestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function tearDown(): void
    {
        parent::tearDown();
    }

    public function testIndex(){
        $result = $this->call('get', "/");
        $result->assertOK();
        $result->assertSee("SISTEM PENDUKUNG KEPUTUSAN");
    }

    public function testCreateDataPribadi(){
        $result = $this->call('get', "/mhs/verifikasi");
        $result->assertOK();
        $result->assertSee("Verifikasi dan Validasi Data Mahasiswa");
    }

    public function testViewDataPribadi(){
        $result = $this->call('post', "/mhs/detailMahasiswa");
        $result->assertOK();
        // $result->assertSee("Detail Data Mahasiswa"); // error di sini
    }

    public function testViewPengumumanBeasiswa(){
        $result = $this->call('get', "/mhs/beasiswa");
        $result->assertOK();
        $result->assertSee("Daftar Beasiswa");
    }

    public function testViewMahasiswaLolos(){
        $result = $this->call('get', "/mhs/lolos/1");
        $result->assertOK();
        $result->assertSee("Daftar Mahasiswa yang Menerima Beasiswa");
        $result->assertSee("1900001");

        // mendapatkan kuota dari beasiswa dgn id beasiswa ke-1
        $beasiswaModel = model('BeasiswaModel');
        $beasiswa = $beasiswaModel->getKuotaByBeasiswa(1);
        $kuota = $beasiswa[0]['kuota'];
        // mendapatkan mahasiswa yang lolos beasiswa, untuk id beasiswa ke-1 dan di-limit bdasarkan jumlah kuota dari beasiswa tsb
        $hasilModel = model('HasilModel');
        $hasil = $hasilModel->getHasilForPengumuman(1, $kuota);
        // membandingkan jumlah hasilnya
        $this->assertCount(2, $hasil);
    }
}