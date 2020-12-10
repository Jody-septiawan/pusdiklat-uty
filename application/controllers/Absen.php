<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Absen extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $id = $this->session->userdata('id');
        $this->load->model('User_model', 'User');
        $this->load->model('Method_model', 'Method');

        $this->User->CekSession($id);
        $this->User->CekRole1_5($id);
        $this->User->CekRole6($id);
        // $this->User->CekRole7_10($id);
        $this->User->CekRole11($id);
    }

    public function index()
    {
        redirect('admin');
    }

    public function resetKehadiran($id)
    {
        $this->db->where('id_sertifikasi', $id);
        $this->db->update('peserta', ['presensi' => 0]);

        $method = $this->Method->CekMethod($id);
        redirect("absen/$method");
    }

    public function resetNilai($id)
    {
        $this->db->where('id_sertifikasi', $id);
        $this->db->update('peserta', ['nilai' => 0, 'keterangan' => '-']);

        $method = $this->Method->CekMethod($id);
        redirect("absen/$method");
    }

    public function mos()
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['title'] = 'Absen Ujian Sertifikasi MOS';
        $data['id_sertifikasi'] = 1;

        $QueryAbsen = " SELECT * FROM peserta p, pembayaran_kat pk, sertifikasi_kat sk
                            WHERE p.id_sertifikasi = sk.id
                            AND p.id_status_pembayaran = pk.id 
                            AND p.id_sertifikasi = 1
                            AND p.id_status_pembayaran = 1";
        $data['Absen'] = $this->db->query($QueryAbsen)->result_array();

        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/admin_sidebar', $data);
        $this->load->view('templates/admin_topbar', $data);
        $this->load->view('absen/sertifikasi', $data);
        $this->load->view('templates/admin_footer');
    }

    public function mta()
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['title'] = 'Absen Ujian Sertifikasi MTA';
        $data['id_sertifikasi'] = 2;

        $QueryAbsen = " SELECT * FROM peserta p, pembayaran_kat pk, sertifikasi_kat sk
                            WHERE p.id_sertifikasi = sk.id
                            AND p.id_status_pembayaran = pk.id 
                            AND p.id_sertifikasi = 2
                            AND p.id_status_pembayaran = 1";
        $data['Absen'] = $this->db->query($QueryAbsen)->result_array();

        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/admin_sidebar', $data);
        $this->load->view('templates/admin_topbar', $data);
        $this->load->view('absen/sertifikasi', $data);
        $this->load->view('templates/admin_footer');
    }

    public function mce()
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['title'] = 'Absen Ujian Sertifikasi MCE';
        $data['id_sertifikasi'] = 3;

        $QueryAbsen = " SELECT * FROM peserta p, pembayaran_kat pk, sertifikasi_kat sk
                            WHERE p.id_sertifikasi = sk.id
                            AND p.id_status_pembayaran = pk.id 
                            AND p.id_sertifikasi = 3
                            AND p.id_status_pembayaran = 1";
        $data['Absen'] = $this->db->query($QueryAbsen)->result_array();

        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/admin_sidebar', $data);
        $this->load->view('templates/admin_topbar', $data);
        $this->load->view('absen/sertifikasi', $data);
        $this->load->view('templates/admin_footer');
    }

    public function mtc()
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['title'] = 'Absen Ujian Sertifikasi MTC';
        $data['id_sertifikasi'] = 4;

        $QueryAbsen = " SELECT * FROM peserta p, pembayaran_kat pk, sertifikasi_kat sk
                            WHERE p.id_sertifikasi = sk.id
                            AND p.id_status_pembayaran = pk.id 
                            AND p.id_sertifikasi = 4
                            AND p.id_status_pembayaran = 1";
        $data['Absen'] = $this->db->query($QueryAbsen)->result_array();

        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/admin_sidebar', $data);
        $this->load->view('templates/admin_topbar', $data);
        $this->load->view('absen/sertifikasi', $data);
        $this->load->view('templates/admin_footer');
    }
}
