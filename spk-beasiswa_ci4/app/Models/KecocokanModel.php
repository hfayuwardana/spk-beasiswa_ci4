<?php

namespace App\Models;
use CodeIgniter\Model;

class KecocokanModel extends Model
{
    protected $table = 'tb_kecocokan';
    protected $primaryKey = 'id_kecocokan';
    protected $allowedFields = ['nilai', 'id_beasiswa', 'id_mahasiswa', 'id_kriteria'];

    public function getKecocokan($id_beasiswa, $id_mahasiswa){
        return $this->db->query("SELECT b.nama_kriteria, a.nilai FROM $this->table a JOIN tb_kriteria b ON a.id_kriteria = b.id_kriteria
        WHERE a.id_beasiswa = $id_beasiswa AND a.id_mahasiswa = $id_mahasiswa")
        ->getResultArray();
    }

    public function getMahasiswaInKecocokan($id_beasiswa, $id_mahasiswa){
        return $this->db->query("SELECT id_mahasiswa FROM $this->table WHERE id_beasiswa=$id_beasiswa AND id_mahasiswa=$id_mahasiswa")
        ->getResultArray();
    }

    public function insertDataKecocokan($data){
        $i = 0;
        $query = "INSERT INTO $this->table VALUES ";
        foreach($data['nilai'] as $nl) {
            $id_bsw = $data['id_beasiswa'];
            $id_kriteria = $data['id_kriteria'][$i++];
            $id_mhs = $data['id_mahasiswa'];
            $query .= "(NULL, $id_bsw, $id_kriteria, $id_mhs, $nl),";
        }
        $sql = rtrim($query, ',');
        return $this->db->query($sql);
    }
}