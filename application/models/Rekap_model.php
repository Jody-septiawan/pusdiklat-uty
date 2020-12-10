<?php

class Rekap_model extends CI_Model
{
    public function CariDataKelas($awal, $akhir)
    {
        $query = "SELECT k.*, COUNT(k.id) as peserta 
                    FROM kelas k, peserta p
                    WHERE k.id = p.id_kelas 
                    AND k.status = 'Tutup'
                    GROUP BY k.id
                    ORDER BY id ASC";

        $data = $this->db->query($query)->result_array();

        return $data;
    }

    public function getDetailKelasByIdKelas($id_kelas)
    {

        $query = "SELECT count(p.id_sertifikasi) as peserta, sk.* 
        FROM peserta p, sertifikasi_kat sk, kelas k
        WHERE p.id_sertifikasi = sk.id
        AND p.kelas_id = k.id
        AND k.id = $id_kelas
        GROUP BY p.id_sertifikasi";

        $data = $this->db->query($query)->result_array();

        return $data;
    }

    public function CariData($awal, $akhir)
    {
        $query = "SELECT s.alias, count(p.id_sertifikasi) as peserta 
        FROM sertifikasi_kat s, peserta p 
        AND p.id_sertifikasi = s.id
        AND p.nilai > 0
        AND p.presensi = 1
        GROUP BY s.alias";
        $data = $this->db->query($query)->result_array();

        $query2 = "SELECT * FROM peserta p, sertifikasi_kat s
            AND s.id = p.id_sertifikasi";
        $hasil = $this->db->query($query2)->result_array();

        $lulus = [
            [
                'index' => 0,
                'id' => 1,
                'nama' => 'MOS',
                'jumlah' => 0
            ],
            [
                'index' => 1,
                'id' => 2,
                'nama' => 'MTA',
                'jumlah' => 0
            ],
            [
                'index' => 2,
                'id' => 3,
                'nama' => 'MCE',
                'jumlah' => 0
            ],
            [
                'index' => 3,
                'id' => 4,
                'nama' => 'MTC',
                'jumlah' => 0
            ],

        ];


        // HITUNG PESERTA LULUS
        foreach ($hasil as $h) :
            foreach ($lulus as $l) :
                if ($h['id_sertifikasi'] == $l['id']) {
                    if ($h['keterangan'] == "Lulus") {
                        $lulus[$l['index']]['jumlah'] += 1;
                    }
                }
            endforeach;
        endforeach;

        $urut = 0;
        foreach ($data as $h) :
            foreach ($lulus as $l) :
                if ($h['alias'] == $l['nama']) {
                    $data[$urut]['lulus'] = $l['jumlah'];
                    $data[$urut]['id'] = $l['id'];
                }
            endforeach;
            $urut++;
        endforeach;

        return $data;
    }

    public function DataDetail($id, $awal, $akhir)
    {
        $result = [];
        // nama sertifikasi
        $this->db->select('nama_sertifikasi as sertifikasi');
        $this->db->where('id', $id);
        $result['sertifikasi'] = $this->db->get('sertifikasi_kat')->row_array();

        // Jumlah peserta
        $query_jumlah_pserta = "SELECT count(id) as jum_peserta FROM peserta
        WHERE tgl_ujian >= $awal
        AND tgl_ujian <= $akhir
        AND id_sertifikasi = $id
        AND status_pembayaran = 1";
        $result['jum_peserta'] = $this->db->query($query_jumlah_pserta)->row_array();

        // Peserta lulus
        $query_peserta_lulus = "SELECT count(id) as lulus FROM peserta
        WHERE tgl_ujian >= $awal
        AND tgl_ujian <= $akhir
        AND id_sertifikasi = $id
        AND keterangan = 'Lulus'
        AND nilai > 0
        AND presensi = 1";
        $result['lulus'] = $this->db->query($query_peserta_lulus)->row_array();


        return $result;
    }

    public function DataDetailUser($id, $awal, $akhir)
    {
        // All peserta
        $query1 = "SELECT * FROM sertifikasi_kat s, peserta p 
        WHERE p.tgl_ujian >= $awal
        AND p.tgl_ujian <= $akhir
        AND p.id_sertifikasi = s.id
        AND p.id_sertifikasi = $id";

        $result = $this->db->query($query1)->result_array();

        return $result;
    }
}
