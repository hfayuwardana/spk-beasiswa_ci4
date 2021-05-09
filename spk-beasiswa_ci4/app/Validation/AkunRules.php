<?php 
namespace App\Validation;
use App\Models\AkunModel;

class AkunRules{
    public function validateAkun(string $str, string $fields, array $data){
		$model = new AkunModel();
		$akun = $model->getAkunByUsername($data['username']);

		// Jika akun yang dicari tidak ditemukan di database
		if(!$akun){
			return false;
		}
		// return password verify dari password input user dan hased password di db
        // var_dump(password_verify($data['password'], $akun['password']));
		// return password_verify($data['password'], $akun['password']);
        return $data['password']=== $akun['password'];
	}
}

?>