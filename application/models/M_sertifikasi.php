<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_sertifikasi extends CI_Model
{
    public function hapus_otomatis()
    {
        date_default_timezone_set('Asia/Jakarta');

        $time = time();
        $lama = 86400;
        $hapus = "SELECT * FROM boking_kelas
							WHERE ($time - boking_kelas.`date_created`) > $lama
							AND boking_kelas.`is_active` = 1 ";
        $hapus = $this->db->query($hapus)->result_array();
        if ($hapus) {
            foreach ($hapus as $h) {
                $this->db->where('id', $h['id']);
                $this->db->delete('boking_kelas');

                $id_kelas = $h['id_kelas'];
                $sql = "SELECT sisa_kuota
							FROM kelas
							WHERE id= $id_kelas";
                $sisa = $this->db->query($sql)->row();
                $sisa = $sisa->sisa_kuota;
                $sisa = $sisa + 1;

                $this->db->where('id', $h['id_kelas']);
                $this->db->update('kelas', ['sisa_kuota' => $sisa]);
            }
        } else {
            // $hapus = "Tidak ada";
        }
        return $hapus;
    }
}
