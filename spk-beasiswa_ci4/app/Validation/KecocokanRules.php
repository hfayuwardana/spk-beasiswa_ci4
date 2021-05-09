<?php 
namespace App\Validation;
use App\Models\KecocokanModel;

class KecocokanRules{
    public function validateValue($str = null, string $fields, array $data){
        if(isset($data['nilai']) ){
            if(sizeof($data['nilai']) != sizeof($data['id_kriteria'])){
                return false;
            }
        }else{
            return false;
        }
        return true;
	}

    public function cekUniqueMahasiswa($str = null, string $fields, array $data){
        $model = new KecocokanModel();
        $mhs = $model->getMahasiswaInKecocokan($data['id_beasiswa'], $data['id_mahasiswa']);
        
        if($mhs){
			return false;
		}
        return true;
    }
}

?>