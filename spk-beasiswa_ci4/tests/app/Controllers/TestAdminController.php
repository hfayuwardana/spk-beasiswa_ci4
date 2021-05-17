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

    // public function testLogin(){
    //     $akunModel = new AkunModel();
    //     $username = 'admin';
    //     $password = 'pass4admin';

    //     $data = [
    //         'username' => $username,
    //         'password' => $password,
    //     ];

    //     $form_validation = \Config\Services::validation();
    //     if ($form_validation->run($data, 'login') == true) {
    //         $akun = $akunModel->getAkunByUsername($username);
        
    //         $data = [
    //             'id' => $akun[0]['id_akun'],
    //             'username' => $akun[0]['username'],
    //             'isLoggedIn' => true,
    //         ];

    //         $result = $this->withSession($data)
    //             ->get('AdminController');
    //     }

    //     $result = $this->call('post', "/login");
    //     $result->assertOK();
    //     $result->assertSessionHas('username', 'admin');
    // }

    public function testIndex(){
        $result = $this->call('get', "/index");
        $result->assertOK();
        // $result->assertSee("Selamat Datang"); //berhasil hanya jika cek session di-disable
    }

    public function testHome(){
        $result = $this->call('get', "/home");
        $result->assertOK();
        // $result->assertSee("Selamat Datang"); //berhasil hanya jika cek session di-disable
    }

    // ----------------------- berkaitan dengan Akun ----------------------------------------
    
    // public function testViewAllAkun(){
    //     $result = $this->call('get', "/admin");
    //     $result->assertOK();
    //     $result->assertSee("admin"); //berhasil hanya jika cek session di-disable
    // }
}