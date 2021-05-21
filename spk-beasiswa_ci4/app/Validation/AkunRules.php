<?php 
namespace App\Validation;
use App\Models\AkunModel;

class AkunRules{
    public function validateAkun(string $str, string $fields, array $data){
		$model = new AkunModel();
		$akun = $model->getAkunByUsername($data['username']);

		// Jika akun yang dicari tidak ditemukan di database
		if(!$akun){
			// langsung return false
			return false;
		}
		// return apakah hashed password input user sesuai dengan password yang terdata di db
		// (false: jika tidak sesuai; true: jika sesuai)
        return md5($data['password']) === $akun['password'];
	}
}

?>