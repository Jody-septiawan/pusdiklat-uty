<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Presensi_nilai extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Tgl_model', 'tgl');
        $this->load->model('Method_model', 'Method');
        $id = $this->session->userdata('id');
        $this->User->CekSession($id);
        $this->User->CekRole1_5($id);
        $this->User->CekRole6($id);
        // $this->User->CekRole7_10($id);
        $this->User->CekRole11($id);
    }

    public function index()
    {
        $id_proctor = $this->session->userdata('id');
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['title'] = "Presensi & nilai";

        $queryKelas = "SELECT k.id, k.nama, k.tanggal, COUNT(k.id) as peserta FROM kelas k, peserta p
                            WHERE k.id = p.kelas_id
                            AND k.status = 1
                            AND k.id_proctor = $id_proctor
                            GROUP BY k.id ASC";

        $kelas = $this->db->query($queryKelas)->result_array();
        $data['kelas'] = $kelas;

        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/admin_sidebar');
        $this->load->view('templates/admin_topbar');
        $this->load->view('presensi_nilai/index');
        $this->load->view('templates/admin_footer');
    }

    public function detailkelas($kelas_id = null)
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['title'] = "Presensi & nilai";

        $queryPeserta = "SELECT p.*,k.nama as kelas, k.tanggal as tanggal,sk.alias as sertifikasi, sp.spesifikasi FROM peserta p, kelas k, sertifikasi_kat sk, spesifikasi sp
                            WHERE p.kelas_id = k.id
                            AND p.id_sertifikasi = sk.id
                            AND p.id_spesifikasi = sp.id
                            AND p.kelas_id = $kelas_id";

        $peserta = $this->db->query($queryPeserta)->result_array();
        $data['peserta'] = $peserta;

        $Totalpeserta = 0;
        $hadir = 0;
        $belumhadir = 0;
        $beluminputnilai = 0;

        foreach ($peserta as $p) :
            $Totalpeserta += 1;
            if ($p['presensi'] == 1) :
                $hadir += 1;
            else :
                $belumhadir += 1;
            endif;
            if ($p['keterangan'] == null) :
                $beluminputnilai += 1;
            endif;
        endforeach;

        $data['totalpeserta'] = $Totalpeserta;
        $data['hadir'] = $hadir;
        $data['belumhadir'] = $belumhadir;
        $data['beluminputnilai'] = $beluminputnilai;


        $data['kelas_id'] = $kelas_id;

        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/admin_sidebar');
        $this->load->view('templates/admin_topbar');
        $this->load->view('presensi_nilai/kelas');
        $this->load->view('templates/admin_footer');
    }

    public function hadir($id = null, $kelas_id = null)
    {
        $this->db->where('id', $id);
        $this->db->update('peserta', ['presensi' => 1]);
        redirect("presensi_nilai/detailkelas/$kelas_id");
    }

    public function belumhadir($id = null, $kelas_id = null)
    {
        $this->db->where('id', $id);
        $this->db->update('peserta', ['presensi' => 0]);
        redirect("presensi_nilai/detailkelas/$kelas_id");
    }

    public function inputnilai()
    {
        $id = $this->input->post('id');
        $nilai = $this->input->post('nilai');
        $kelas_id = $this->input->post('kelas_id');
        $sert_id = $this->input->post('sert_id');

        $this->db->where('id', $sert_id);
        $sertif = $this->db->get('sertifikasi_kat')->row_array();

        if ($nilai >= $sertif['std_nilai']) :
            $ket = "Lulus";
        else :
            $ket = "Tidak lulus";
        endif;


        $data = [
            'nilai' => $nilai,
            'keterangan' => $ket
        ];

        $this->db->where('id', $id);
        $this->db->update('peserta', $data);

        redirect("presensi_nilai/detailkelas/$kelas_id");
    }

    public function hapusnilai($id = null, $kelas_id = null)
    {
        $this->db->where('id', $id);
        $data = [
            'nilai' => 0,
            'keterangan' => ''
        ];
        $this->db->update('peserta', $data);
        redirect("presensi_nilai/detailkelas/$kelas_id");
    }
}
