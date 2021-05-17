<?php

namespace App\Models;
use CodeIgniter\Model;

class KriteriaModel extends Model
{
    protected $table = 'tb_kriteria';
    protected $primaryKey = 'id_kriteria';
    protected $allowedFields = ['nama_kriteria', 'sifat', 'bobot', 'id_beasiswa'];

    public function getKriteriaByBeasiswa($id_beasiswa){
        return $this->db->query("SELECT * FROM $this->table WHERE id_beasiswa=$id_beasiswa")
        ->getResultArray();
    }

    public function getKriteriaById($id_kriteria){
        return $this->getWhere(['id_kriteria' => $id_kriteria])->getRowArray();
    }

    // public function getKriteriaForInsertKecocokan($id_beasiswa){
    //     return $this->db->table($this->table)
    //     ->select('id_kriteria', 'nama_kriteria', 'bobot', 'sifat')
    //     ->where(['id_beasiswa' => $id_beasiswa])->get()
    //     ->getResultArray();
    // }

    public function insertDataKriteria($data){
        return $this->db->table($this->table)->insert($data);
    }

    public function updateDataKriteria($id_kriteria, $data){
        return $this->db->table($this->table)->update($data, ['id_kriteria' => $id_kriteria]);
    }

    public function deleteDataKriteria($id_kriteria){
        return $this->table($this->table)->delete(['id_kriteria' => $id_kriteria]);
    }
}