<?php 
namespace App\Validation;
use App\Models\KecocokanModel;

class KecocokanRules{
    public function validateValue($str = null, string $fields, array $data){
        // jika ada nilai yg diisi
        if(isset($data['nilai']) ){
            // jika nilai yang diisi tidak lengkap (alias tidak seluruhnya)
            if(sizeof($data['nilai']) != sizeof($data['id_kriteria'])){
                return false;
            }
        // jika tidak ada satupun nilai yg diisi
        }else{
            return false;
        }
        // jika seluruh nilai lengkap diisi 
        return true;
	}
    
    public function cekUniqueMahasiswa($str = null, string $fields, array $data){
        $model = new KecocokanModel();
        $mhs = $model->getMahasiswaInKecocokan($data['id_beasiswa'], $data['id_mahasiswa']);
        
        // jika mahasiswa tersebut sebelumnya sudah pernah dicocokkan untuk beasiswa yg ingin dicocokkan
        if($mhs){
			return false;
		}
        //jika mahasiswa tersebut belum pernah dicocokkan untuk beasiswa yg ingin dicocokkan
        return true;
    }
}

?>