<?php

namespace App\Models;
use CodeIgniter\Model;

class BeasiswaModel extends Model
{
    protected $table = 'tb_beasiswa';
    protected $primaryKey = 'id_beasiswa';
    protected $allowedFields = ['nama_beasiswa', 'nama_penyelenggara', 'tahun', 'kuota', 'status'];

    public function getAllBeasiswa(){
        return $this->findAll();
    }

    public function getBeasiswaById($id_beasiswa){
        return $this->getWhere(['id_beasiswa' => $id_beasiswa])->getRowArray();
    }

    public function getBeasiswaForKecocokan(){
        return $this->db->table($this->table)
        ->select('tb_beasiswa.nama_beasiswa, tb_beasiswa.nama_penyelenggara, tb_beasiswa.tahun')
        ->join('tb_kecocokan', 'tb_beasiswa.id_beasiswa = tb_kecocokan.id_beasiswa')
        ->where(['tb_beasiswa.status' => 'belum'])->get()
        ->getResultArray();
    }

    public function getBeasiswaForHasil(){
        return $this->db->table($this->table)
        ->select('tb_beasiswa.nama_beasiswa, tb_beasiswa.nama_penyelenggara, tb_beasiswa.tahun')
        ->join('tb_hasil', 'tb_beasiswa.id_beasiswa = tb_hasil.id_beasiswa')->get()
        ->getResultArray();
    }

    public function getBeasiswaForPengumuman(){
        return $this->db->table($this->table)
        ->select('tb_beasiswa.nama_beasiswa, tb_beasiswa.nama_penyelenggara, tb_beasiswa.tahun')
        ->join('tb_hasil', 'tb_beasiswa.id_beasiswa = tb_hasil.id_beasiswa')
        ->where(['tb_beasiswa.status' => 'selesai'])->get()
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