<?php

namespace App\Models;
use CodeIgniter\Model;

class KecocokanModel extends Model
{
    protected $table = 'tb_kecocokan';
    protected $primaryKey = 'id_kecocokan';
    protected $allowedFields = ['nilai', 'id_beasiswa', 'id_mahasiswa', 'id_kriteria'];

    // public function getKecocokan

    // public function getBobotByKriteria($id_kriteria){
    //     return $this->db->query("SELECT * FROM $this->table WHERE id_kriteria=$id_kriteria")
    //     ->getResultArray();
    // }

    // public function getBobotById($id_bobot){
    //     return $this->getWhere(['id_bobot' => $id_bobot])->getRowArray();
    // }

    // public function getBobotForInsertKecocokan($id_beasiswa, $id_kriteria){
    //     return $this->db->table($this->table)
    //     ->select('keterangan', 'value')
    //     ->where(['id_beasiswa' => $id_beasiswa, 'id_kriteria' => $id_kriteria])->get()
    //     ->getResultArray();
    // }

    // public function insertDataBobot($data){
    //     return $this->db->table($this->table)->insert($data);
    // }

    // public function updateDataBobot($id_bobot, $data){
    //     return $this->db->table($this->table)->update($data, ['id_bobot' => $id_bobot]);
    // }

    // public function deleteDataBobot($id_bobot){
    //     return $this->table($this->table)->delete(['id_bobot' => $id_bobot]);
    // }
}