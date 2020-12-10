<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_admin extends CI_Model
{
    public function edit_kelas($data, $where)
    {

        $this->db->set($data);
        $this->db->where($where);
    }
    public function edit_ujian($data, $where)
    {

        $this->db->set($data);
        $this->db->where($where);
    }
    public function hapus_kelas($where)
    {
        $this->db->where($where);
        $this->db->delete('kelas');
    }
    public function hapus_pendaftar($where)
    {
        $this->db->where($where);
        $this->db->delete('jenis_pendaftar');
    }
    public function hapus_ujian($where)
    {
        $this->db->where($where);
        $this->db->delete('jenis_ujian');
    }
    public function getTarif()
    {
        $query = "SELECT `tarif`.*, `jenis_pendaftar`.`nama_jenis`
				FROM `tarif` JOIN `jenis_pendaftar`
				ON `tarif`.`id_jenis` = `jenis_pendaftar`.`id`
				";
        return $this->db->query($query)->result_array();
    }

    // public function edit_tarif($data, $where)
    // {
    // 	$this->db->where($where);
    // 	$this->db->update('tarif', $data);
    // }

    public function hapus_tarif($where)
    {
        $this->db->where($where);
        $this->db->delete('tarif');
    }
}
