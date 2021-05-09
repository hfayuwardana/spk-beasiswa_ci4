<?php

namespace App\Models;
use CodeIgniter\Model;

class HasilModel extends Model
{
    protected $table = 'tb_hasil';
    protected $primaryKey = 'id_hasil';
    protected $allowedFields = ['nilai', 'id_beasiswa', 'id_mahasiswa'];

    public function doHitung($id_beasiswa){
        $sqlKriteria = "";
        $namaKriteria = [];
        $queryKriteria = "SELECT id_kriteria, nama_kriteria FROM tb_kriteria WHERE id_beasiswa = $id_beasiswa";

        $query = $this->db->query($queryKriteria);

        foreach($query->getResultArray() as $kr){
            $sqlKriteria .= "SUM(
                IF(
                    c.id_kriteria = ".$kr['id_kriteria'].",
                    IF(c.sifat='max', tb_kecocokan.nilai/c.normalization, c.normalization/tb_kecocokan.nilai), 0
                )
            ) AS ".strtolower(str_replace(" ", "_", $kr['nama_kriteria'])).",";
            $namaKriteria[] = strtolower(str_replace(" ", "_", $kr['nama_kriteria']));
        }
        $sql = "SELECT
            (SELECT nama_mhs FROM tb_mahasiswa WHERE id_mahasiswa=mhs.id_mahasiswa) AS nama_mhs,
            (SELECT nim FROM tb_mahasiswa WHERE id_mahasiswa=mhs.id_mahasiswa) AS nim,
            (SELECT id_mahasiswa FROM tb_mahasiswa WHERE id_mahasiswa=mhs.id_mahasiswa) AS id_mahasiswa,"
            .$sqlKriteria.
            " SUM(
                IF(
                    c.sifat = 'max',
                    tb_kecocokan.nilai / c.normalization,
                    c.normalization / tb_kecocokan.nilai
                )* c.bobot
            )AS ranking
        FROM
            tb_kecocokan
            JOIN tb_mahasiswa mhs USING(id_mahasiswa)
            JOIN (
                SELECT
                        tb_kecocokan.id_kriteria AS id_kriteria,
                        tb_kriteria.sifat AS sifat,
                        tb_kriteria.bobot AS bobot,
                        ROUND(
                            IF(tb_kriteria.sifat='max', MAX(tb_kecocokan.nilai), MIN(tb_kecocokan.nilai)), 1
                        ) AS normalization
                    FROM tb_kecocokan
                    JOIN tb_kriteria USING(id_kriteria)
                    JOIN tb_beasiswa ON tb_kriteria.id_beasiswa = tb_beasiswa.id_beasiswa
                    WHERE tb_beasiswa.id_beasiswa = $id_beasiswa
                GROUP BY tb_kecocokan.id_kriteria
            ) c USING (id_kriteria)
        WHERE id_beasiswa = $id_beasiswa
        GROUP BY tb_kecocokan.id_mahasiswa
        ORDER BY ranking DESC";

        // dd($sql);
        return $this->db->query($sql)->getResultArray();
    }

    public function cekMahasiswa($id_beasiswa, $id_mahasiswa){
        $query = "SELECT id_mahasiswa FROM tb_hasil WHERE id_mahasiswa = $id_mahasiswa AND id_beasiswa = $id_beasiswa";
        
        return $this->db->query($query)->getResultArray();
    }

    public function insertHasil($data){
        // $query = "INSERT INTO $this->table (id_beasiswa, id_mahasiswa, nilai) VALUES ($id_beasiswa, $id_mahasiswa, $ranking)";
        
        // return $this->db->query($query)->getResultArray();

        return $this->db->table($this->table)->insert($data);
    }

    public function getHasilByBeasiswa($id_beasiswa){
        return $this->db->query("SELECT DISTINCT b.nim, b.nama_mhs, a.nilai FROM $this->table a JOIN tb_mahasiswa b 
        ON a.id_mahasiswa = b.id_mahasiswa WHERE id_beasiswa = $id_beasiswa")
        ->getResultArray();
    }

    public function getHasilForPengumuman($id_beasiswa){
        return $this->db->query("SELECT DISTINCT b.nim, b.nama_mhs FROM $this->table a JOIN tb_mahasiswa b 
        ON a.id_mahasiswa = b.id_mahasiswa WHERE id_beasiswa = $id_beasiswa AND tb_beasiswa.status = 'Sudah'")
        ->getResultArray();
    }
}