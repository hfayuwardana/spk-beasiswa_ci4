<?php

namespace App\Models;
use CodeIgniter\Model;

class BeasiswaModel extends Model
{
    protected $table = 'tb_beasiswa';
    protected $primaryKey = 'id_beasiswa';
    protected $allowedFields = ['nama_beasiswa', 'nama_penyelenggara', 'tahun', 'kuota', 'status'];

    public function getAllBeasiswa(){
        // return $this->findAll();

        return $this->db->query("SELECT * FROM $this->table a WHERE a.status NOT IN ('Deleted')")
        ->getResultArray();
    }

    public function getBeasiswaById($id_beasiswa){
        return $this->getWhere(['id_beasiswa' => $id_beasiswa])->getRowArray();
    }

    public function getBeasiswaForInsertKecocokan(){
        return $this->db->query("SELECT id_beasiswa, nama_beasiswa, nama_penyelenggara, tahun from $this->table WHERE status='Belum'")
        ->getResultArray();
    }

    public function getBeasiswaForKecocokan(){
        return $this->db->query("SELECT DISTINCT a.id_beasiswa, a.nama_beasiswa, a.nama_penyelenggara, a.tahun, a.kuota, a.status from $this->table a JOIN tb_kecocokan b ON a.id_beasiswa = b.id_beasiswa")
        ->getResultArray();
    }

    public function getBeasiswaForHasil(){
        return $this->db->query("SELECT id_beasiswa, nama_beasiswa, nama_penyelenggara, tahun, kuota, status from $this->table")
        ->getResultArray();
    }

    public function getBeasiswaForPengumuman(){
        return $this->db->query("SELECT id_beasiswa, nama_beasiswa, nama_penyelenggara, tahun, kuota from $this->table WHERE status = 'Selesai'")
        ->getResultArray();
    }

    public function getBeasiswaForSearchPengumuman($nama_beasiswa){
        return $this->db->query("SELECT id_beasiswa, nama_beasiswa, nama_penyelenggara, tahun, kuota from $this->table WHERE status = 'Selesai' AND nama_beasiswa LIKE '%$nama_beasiswa%'")
        ->getResultArray();
    }

    public function cekStatus($id_beasiswa){
        return $this->db->query("SELECT status from $this->table WHERE id_beasiswa=$id_beasiswa")
        ->getResultArray();
    }

    public function getKuotaByBeasiswa($id_beasiswa){
        return $this->db->query("SELECT kuota from $this->table WHERE id_beasiswa = $id_beasiswa")
        ->getResultArray();
    }

    public function insertDataBeasiswa($data){
        return $this->db->table($this->table)->insert($data);
    }

    public function updateDataBeasiswa($id_beasiswa, $data){
        return $this->db->table($this->table)->update($data, ['id_beasiswa' => $id_beasiswa]);
    }

    public function deleteDataBeasiswa($id_beasiswa){
        return $this->table($this->table)->delete(['id_beasiswa' => $id_beasiswa]);
    }
}