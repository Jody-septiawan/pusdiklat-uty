<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Presensi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('id')) {
            redirect('auth');
        }
        $this->load->model('Tgl_model', 'tgl');
        $this->load->model('Method_model', 'Method');
    }

    public function saran_add()
    {
        $id = $this->session->userdata('id');
        $data['user'] = $this->db->get_where('user', ['id' => $id])->row_array();
        $data['title'] = "Presensi Ujian - saran";
        $content = $this->input->post('content');

        date_default_timezone_set('Asia/Jakarta');
        $time = time();


        $data = array(
            'id_user' => $id,
            'content' => $content,
            'time' => $time
        );

        $this->db->insert('saran', $data);

        redirect('presensi/saran');
    }

    public function saran()
    {
        $id = $this->session->userdata('id');
        $data['user'] = $this->db->get_where('user', ['id' => $id])->row_array();
        $data['title'] = "Presensi Ujian - saran";

        $this->load->view('templates/p_header', $data);
        $this->load->view('presensi/sidebar', $data);
        $this->load->view('presensi/saran', $data);
        $this->load->view('templates/p_footer');
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['title'] = "Presensi Ujian";
        $data['judul'] = "SELAMAT DATANG DI PRESENSI ONLINE UJIAN SERTIFIKASI";

        $this->load->view('templates/p_header', $data);
        $this->load->view('presensi/sidebar', $data);
        $this->load->view('presensi/index', $data);
        $this->load->view('templates/p_footer');
    }


    public function InputPresensi($id = null, $id_sert = null, $kloter = null)
    {
        // Cek variabel
        if ($id == null || $id_sert == null || $kloter == null) {
            redirect('presensi');
        }
        date_default_timezone_set('Asia/Jakarta');
        $time = time();

        $DataInputPresensi = [
            'presensi' => 1,
            'waktu_hadir' => $time
        ];

        $this->db->where('id', $id);
        $this->db->update('peserta', $DataInputPresensi);

        $this->session->set_flashdata('flash', 'Hadir');

        $method = $this->Method->CekMethod($id_sert);
        redirect("presensi/$method/$kloter");
    }

    public function HapusPresensi($id = null, $id_sert = null, $kloter = null)
    {
        $this->db->where('id', $id);
        $this->db->where('id_sertifikasi', $id_sert);
        $this->db->update('peserta', ['presensi' => 0]);

        $method = $this->Method->CekMethod($id_sert);
        redirect("presensi/$method/$kloter");
    }


    public function InputNilai()
    {
        $id = $this->input->post('id');
        $id_sert = $this->input->post('id_sert');
        $nilai = intval($this->input->post('nilai'));
        $kloter = $this->input->post('kloter');

        $ket = "Tidak lulus";
        if ($id_sert == 1) {
            if ($nilai >= 700) {
                $ket = "Lulus";
            }
        } else {
            if ($nilai >= 70) {
                $ket = "Lulus";
            }
        }

        $DataInputNilai = [
            'nilai' => $nilai,
            'keterangan' => $ket
        ];

        $this->db->where('id', $id);
        $this->db->where('id_sertifikasi', $id_sert);
        $this->db->update('peserta', $DataInputNilai);

        $method = $this->Method->CekMethod($id_sert);
        redirect("presensi/$method/$kloter");
    }

    public function HapusNilai($id = null, $id_sert = null, $kloter = null)
    {
        $this->db->where('id', $id);
        $this->db->where('id_sertifikasi', $id_sert);
        $this->db->update('peserta', ['nilai' => 0]);
        $this->db->where('id', $id);
        $this->db->where('id_sertifikasi', $id_sert);
        $this->db->update('peserta', ['keterangan' => '-']);

        $method = $this->Method->CekMethod($id_sert);
        redirect("presensi/$method/$kloter");
    }

    public function mos($kloter = null)
    {
        date_default_timezone_set('Asia/Jakarta');
        $timeNow = time();
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $timeNow = date('Y-m-d', $timeNow);
        $id_sert = 1;
        $data['nama_sert'] = 'mos';

        $data['tglSekarang'] = $this->tgl->tglSekarang();
        $data['title'] = "Presensi Ujian - MOS";
        $data['judul'] = "Presensi Online Ujian Sertifikasi <br><b> MICROSOFT OFFICE SPECIALIST (MOS)</b>";

        $data['kloter'] = [
            ['id' => null, 'nama' => 'All kloter'],
            ['id' => 1, 'nama' => 'Kloter 1'],
            ['id' => 2, 'nama' => 'Kloter 2'],
            ['id' => 3, 'nama' => 'Kloter 3'],
        ];

        if ($kloter == null) {
            $kloter = 0;
        }

        if ($kloter == 0) {
            // Tampil semua peserta pada hari sekarang
            $this->db->select('*');
            $this->db->from('peserta');
            $this->db->where('id_sertifikasi', $id_sert);
            $this->db->where('id_status_pembayaran', 1);
            // $this->db->where('tgl_ujian', $timeNow);
            $data['peserta'] = $this->db->get()->result_array();

            // Jumlah peserta
            $data['JumlahPeserta'] = count($data['peserta']);

            // Hadir
            $this->db->select('*');
            $this->db->from('peserta');
            $this->db->where('id_sertifikasi', $id_sert);
            $this->db->where('id_status_pembayaran', 1);
            $this->db->where('presensi', 1);
            // $this->db->where('tgl_ujian', $timeNow);
            $data['hadir'] = count($this->db->get()->result_array());

            // Belum Hadir
            $this->db->select('*');
            $this->db->from('peserta');
            $this->db->where('id_sertifikasi', $id_sert);
            $this->db->where('id_status_pembayaran', 1);
            $this->db->where('presensi', 0);
            // $this->db->where('tgl_ujian', $timeNow);
            $data['BelumHadir'] = count($this->db->get()->result_array());

            $data['id_kloter'] = $kloter;
            // var_dump($data['id_kloter']);

            $this->load->view('templates/p_header', $data);
            $this->load->view('presensi/sidebar');
            $this->load->view('presensi/absen', $data);
            $this->load->view('templates/p_footer');
        } elseif ($kloter == 1) {
            // Tampil semua peserta pada hari sekarang
            $this->db->select('*');
            $this->db->from('peserta');
            $this->db->where('id_sertifikasi', $id_sert);
            $this->db->where('id_status_pembayaran', 1);
            $this->db->where('kloter', $kloter);
            // $this->db->where('tgl_ujian', $timeNow);
            $data['peserta'] = $this->db->get()->result_array();

            // Jumlah peserta
            $data['JumlahPeserta'] = count($data['peserta']);

            // Hadir
            $this->db->select('*');
            $this->db->from('peserta');
            $this->db->where('id_sertifikasi', $id_sert);
            $this->db->where('id_status_pembayaran', 1);
            $this->db->where('presensi', 1);
            $this->db->where('kloter', $kloter);
            // $this->db->where('tgl_ujian', $timeNow);
            $data['hadir'] = count($this->db->get()->result_array());

            // Belum Hadir
            $this->db->select('*');
            $this->db->from('peserta');
            $this->db->where('id_sertifikasi', $id_sert);
            $this->db->where('id_status_pembayaran', 1);
            $this->db->where('presensi', 0);
            $this->db->where('kloter', $kloter);
            // $this->db->where('tgl_ujian', $timeNow);
            $data['BelumHadir'] = count($this->db->get()->result_array());

            $data['id_kloter'] = $kloter;

            $this->load->view('templates/p_header', $data);
            $this->load->view('presensi/sidebar');
            $this->load->view('presensi/absen');
            $this->load->view('templates/p_footer');
        } elseif ($kloter == 2) {
            // Tampil semua peserta pada hari sekarang
            $this->db->select('*');
            $this->db->from('peserta');
            $this->db->where('id_sertifikasi', $id_sert);
            $this->db->where('id_status_pembayaran', 1);
            $this->db->where('kloter', $kloter);
            // $this->db->where('tgl_ujian', $timeNow);
            $data['peserta'] = $this->db->get()->result_array();

            // Jumlah peserta
            $data['JumlahPeserta'] = count($data['peserta']);

            // Hadir
            $this->db->select('*');
            $this->db->from('peserta');
            $this->db->where('id_sertifikasi', $id_sert);
            $this->db->where('id_status_pembayaran', 1);
            $this->db->where('presensi', 1);
            $this->db->where('kloter', $kloter);
            // $this->db->where('tgl_ujian', $timeNow);
            $data['hadir'] = count($this->db->get()->result_array());

            // Belum Hadir
            $this->db->select('*');
            $this->db->from('peserta');
            $this->db->where('id_sertifikasi', $id_sert);
            $this->db->where('id_status_pembayaran', 1);
            $this->db->where('presensi', 0);
            $this->db->where('kloter', $kloter);
            // $this->db->where('tgl_ujian', $timeNow);
            $data['BelumHadir'] = count($this->db->get()->result_array());
            $data['id_kloter'] = $kloter;

            $this->load->view('templates/p_header', $data);
            $this->load->view('presensi/sidebar');
            $this->load->view('presensi/absen');
            $this->load->view('templates/p_footer');
        } elseif ($kloter == 3) {
            // Tampil semua peserta pada hari sekarang
            $this->db->select('*');
            $this->db->from('peserta');
            $this->db->where('id_sertifikasi', $id_sert);
            $this->db->where('id_status_pembayaran', 1);
            $this->db->where('kloter', $kloter);
            // $this->db->where('tgl_ujian', $timeNow);
            $data['peserta'] = $this->db->get()->result_array();

            // Jumlah peserta
            $data['JumlahPeserta'] = count($data['peserta']);

            // Hadir
            $this->db->select('*');
            $this->db->from('peserta');
            $this->db->where('id_sertifikasi', $id_sert);
            $this->db->where('id_status_pembayaran', 1);
            $this->db->where('presensi', 1);
            $this->db->where('kloter', $kloter);
            // $this->db->where('tgl_ujian', $timeNow);
            $data['hadir'] = count($this->db->get()->result_array());

            // Belum Hadir
            $this->db->select('*');
            $this->db->from('peserta');
            $this->db->where('id_sertifikasi', $id_sert);
            $this->db->where('id_status_pembayaran', 1);
            $this->db->where('presensi', 0);
            $this->db->where('kloter', $kloter);
            // $this->db->where('tgl_ujian', $timeNow);
            $data['BelumHadir'] = count($this->db->get()->result_array());
            $data['id_kloter'] = $kloter;

            $this->load->view('templates/p_header', $data);
            $this->load->view('presensi/sidebar');
            $this->load->view('presensi/absen');
            $this->load->view('templates/p_footer');
        } else {
            $kloter = 0;
            // Tampil semua peserta pada hari sekarang
            $this->db->select('*');
            $this->db->from('peserta');
            $this->db->where('id_sertifikasi', $id_sert);
            $this->db->where('id_status_pembayaran', 1);
            $this->db->where('kloter', $kloter);
            // $this->db->where('tgl_ujian', $timeNow);
            $data['peserta'] = $this->db->get()->result_array();

            // Jumlah peserta
            $data['JumlahPeserta'] = count($data['peserta']);

            // Hadir
            $this->db->select('*');
            $this->db->from('peserta');
            $this->db->where('id_sertifikasi', $id_sert);
            $this->db->where('id_status_pembayaran', 1);
            $this->db->where('presensi', 1);
            $this->db->where('kloter', $kloter);
            // $this->db->where('tgl_ujian', $timeNow);
            $data['hadir'] = count($this->db->get()->result_array());

            // Belum Hadir
            $this->db->select('*');
            $this->db->from('peserta');
            $this->db->where('id_sertifikasi', $id_sert);
            $this->db->where('id_status_pembayaran', 1);
            $this->db->where('presensi', 0);
            $this->db->where('kloter', $kloter);
            // $this->db->where('tgl_ujian', $timeNow);
            $data['BelumHadir'] = count($this->db->get()->result_array());
            $data['id_kloter'] = $kloter;

            $this->load->view('templates/p_header', $data);
            $this->load->view('presensi/sidebar');
            $this->load->view('presensi/absen');
            $this->load->view('templates/p_footer');
        }
    }

    public function mta($kloter = null)
    {
        date_default_timezone_set('Asia/Jakarta');
        $timeNow = time();
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $timeNow = date('Y-m-d', $timeNow);
        $id_sert = 2;
        $data['nama_sert'] = 'mta';

        $data['tglSekarang'] = $this->tgl->tglSekarang();
        $data['title'] = "Presensi Ujian - MTA";
        $data['judul'] = "Presensi Online Ujian Sertifikasi <br><b> MICROSOFT TECHNOLOGY ASSOCIATE (MTA)</b>";

        $data['kloter'] = [
            ['id' => null, 'nama' => 'All kloter'],
            ['id' => 1, 'nama' => 'Kloter 1'],
            ['id' => 2, 'nama' => 'Kloter 2'],
            ['id' => 3, 'nama' => 'Kloter 3'],
        ];

        if ($kloter == null) {
            $kloter = 0;
        }

        if ($kloter == 0) {
            // Tampil semua peserta pada hari sekarang
            $this->db->select('*');
            $this->db->from('peserta');
            $this->db->where('id_sertifikasi', $id_sert);
            $this->db->where('id_status_pembayaran', 1);
            // $this->db->where('tgl_ujian', $timeNow);
            $data['peserta'] = $this->db->get()->result_array();

            // Jumlah peserta
            $data['JumlahPeserta'] = count($data['peserta']);

            // Hadir
            $this->db->select('*');
            $this->db->from('peserta');
            $this->db->where('id_sertifikasi', $id_sert);
            $this->db->where('id_status_pembayaran', 1);
            $this->db->where('presensi', 1);
            // $this->db->where('tgl_ujian', $timeNow);
            $data['hadir'] = count($this->db->get()->result_array());

            // Belum Hadir
            $this->db->select('*');
            $this->db->from('peserta');
            $this->db->where('id_sertifikasi', $id_sert);
            $this->db->where('id_status_pembayaran', 1);
            $this->db->where('presensi', 0);
            // $this->db->where('tgl_ujian', $timeNow);
            $data['BelumHadir'] = count($this->db->get()->result_array());

            $data['id_kloter'] = $kloter;
            // var_dump($data['id_kloter']);

            $this->load->view('templates/p_header', $data);
            $this->load->view('presensi/sidebar');
            $this->load->view('presensi/absen', $data);
            $this->load->view('templates/p_footer');
        } elseif ($kloter == 1) {
            // Tampil semua peserta pada hari sekarang
            $this->db->select('*');
            $this->db->from('peserta');
            $this->db->where('id_sertifikasi', $id_sert);
            $this->db->where('id_status_pembayaran', 1);
            $this->db->where('kloter', $kloter);
            // $this->db->where('tgl_ujian', $timeNow);
            $data['peserta'] = $this->db->get()->result_array();

            // Jumlah peserta
            $data['JumlahPeserta'] = count($data['peserta']);

            // Hadir
            $this->db->select('*');
            $this->db->from('peserta');
            $this->db->where('id_sertifikasi', $id_sert);
            $this->db->where('id_status_pembayaran', 1);
            $this->db->where('presensi', 1);
            $this->db->where('kloter', $kloter);
            // $this->db->where('tgl_ujian', $timeNow);
            $data['hadir'] = count($this->db->get()->result_array());

            // Belum Hadir
            $this->db->select('*');
            $this->db->from('peserta');
            $this->db->where('id_sertifikasi', $id_sert);
            $this->db->where('id_status_pembayaran', 1);
            $this->db->where('presensi', 0);
            $this->db->where('kloter', $kloter);
            // $this->db->where('tgl_ujian', $timeNow);
            $data['BelumHadir'] = count($this->db->get()->result_array());

            $data['id_kloter'] = $kloter;

            $this->load->view('templates/p_header', $data);
            $this->load->view('presensi/sidebar');
            $this->load->view('presensi/absen');
            $this->load->view('templates/p_footer');
        } elseif ($kloter == 2) {
            // Tampil semua peserta pada hari sekarang
            $this->db->select('*');
            $this->db->from('peserta');
            $this->db->where('id_sertifikasi', $id_sert);
            $this->db->where('id_status_pembayaran', 1);
            $this->db->where('kloter', $kloter);
            // $this->db->where('tgl_ujian', $timeNow);
            $data['peserta'] = $this->db->get()->result_array();

            // Jumlah peserta
            $data['JumlahPeserta'] = count($data['peserta']);

            // Hadir
            $this->db->select('*');
            $this->db->from('peserta');
            $this->db->where('id_sertifikasi', $id_sert);
            $this->db->where('id_status_pembayaran', 1);
            $this->db->where('presensi', 1);
            $this->db->where('kloter', $kloter);
            // $this->db->where('tgl_ujian', $timeNow);
            $data['hadir'] = count($this->db->get()->result_array());

            // Belum Hadir
            $this->db->select('*');
            $this->db->from('peserta');
            $this->db->where('id_sertifikasi', $id_sert);
            $this->db->where('id_status_pembayaran', 1);
            $this->db->where('presensi', 0);
            $this->db->where('kloter', $kloter);
            // $this->db->where('tgl_ujian', $timeNow);
            $data['BelumHadir'] = count($this->db->get()->result_array());
            $data['id_kloter'] = $kloter;

            $this->load->view('templates/p_header', $data);
            $this->load->view('presensi/sidebar');
            $this->load->view('presensi/absen');
            $this->load->view('templates/p_footer');
        } elseif ($kloter == 3) {
            // Tampil semua peserta pada hari sekarang
            $this->db->select('*');
            $this->db->from('peserta');
            $this->db->where('id_sertifikasi', $id_sert);
            $this->db->where('id_status_pembayaran', 1);
            $this->db->where('kloter', $kloter);
            // $this->db->where('tgl_ujian', $timeNow);
            $data['peserta'] = $this->db->get()->result_array();

            // Jumlah peserta
            $data['JumlahPeserta'] = count($data['peserta']);

            // Hadir
            $this->db->select('*');
            $this->db->from('peserta');
            $this->db->where('id_sertifikasi', $id_sert);
            $this->db->where('id_status_pembayaran', 1);
            $this->db->where('presensi', 1);
            $this->db->where('kloter', $kloter);
            // $this->db->where('tgl_ujian', $timeNow);
            $data['hadir'] = count($this->db->get()->result_array());

            // Belum Hadir
            $this->db->select('*');
            $this->db->from('peserta');
            $this->db->where('id_sertifikasi', $id_sert);
            $this->db->where('id_status_pembayaran', 1);
            $this->db->where('presensi', 0);
            $this->db->where('kloter', $kloter);
            // $this->db->where('tgl_ujian', $timeNow);
            $data['BelumHadir'] = count($this->db->get()->result_array());
            $data['id_kloter'] = $kloter;

            $this->load->view('templates/p_header', $data);
            $this->load->view('presensi/sidebar');
            $this->load->view('presensi/absen');
            $this->load->view('templates/p_footer');
        } else {
            $kloter = 0;
            // Tampil semua peserta pada hari sekarang
            $this->db->select('*');
            $this->db->from('peserta');
            $this->db->where('id_sertifikasi', $id_sert);
            $this->db->where('id_status_pembayaran', 1);
            $this->db->where('kloter', $kloter);
            // $this->db->where('tgl_ujian', $timeNow);
            $data['peserta'] = $this->db->get()->result_array();

            // Jumlah peserta
            $data['JumlahPeserta'] = count($data['peserta']);

            // Hadir
            $this->db->select('*');
            $this->db->from('peserta');
            $this->db->where('id_sertifikasi', $id_sert);
            $this->db->where('id_status_pembayaran', 1);
            $this->db->where('presensi', 1);
            $this->db->where('kloter', $kloter);
            // $this->db->where('tgl_ujian', $timeNow);
            $data['hadir'] = count($this->db->get()->result_array());

            // Belum Hadir
            $this->db->select('*');
            $this->db->from('peserta');
            $this->db->where('id_sertifikasi', $id_sert);
            $this->db->where('id_status_pembayaran', 1);
            $this->db->where('presensi', 0);
            $this->db->where('kloter', $kloter);
            // $this->db->where('tgl_ujian', $timeNow);
            $data['BelumHadir'] = count($this->db->get()->result_array());
            $data['id_kloter'] = $kloter;

            $this->load->view('templates/p_header', $data);
            $this->load->view('presensi/sidebar');
            $this->load->view('presensi/absen');
            $this->load->view('templates/p_footer');
        }
    }

    public function mce($kloter = null)
    {
        date_default_timezone_set('Asia/Jakarta');
        $timeNow = time();
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $timeNow = date('Y-m-d', $timeNow);
        $id_sert = 3;
        $data['nama_sert'] = 'mce';

        $data['tglSekarang'] = $this->tgl->tglSekarang();
        $data['title'] = "Presensi Ujian - MCE";
        $data['judul'] = "Presensi Online Ujian Sertifikasi <br><b> MICROSOFT CERTIFIED EDUCATOR (MCE)</b>";

        $data['kloter'] = [
            ['id' => null, 'nama' => 'All kloter'],
            ['id' => 1, 'nama' => 'Kloter 1'],
            ['id' => 2, 'nama' => 'Kloter 2'],
            ['id' => 3, 'nama' => 'Kloter 3'],
        ];

        if ($kloter == null) {
            $kloter = 0;
        }

        if ($kloter == 0) {
            // Tampil semua peserta pada hari sekarang
            $this->db->select('*');
            $this->db->from('peserta');
            $this->db->where('id_sertifikasi', $id_sert);
            $this->db->where('id_status_pembayaran', 1);
            // $this->db->where('tgl_ujian', $timeNow);
            $data['peserta'] = $this->db->get()->result_array();

            // Jumlah peserta
            $data['JumlahPeserta'] = count($data['peserta']);

            // Hadir
            $this->db->select('*');
            $this->db->from('peserta');
            $this->db->where('id_sertifikasi', $id_sert);
            $this->db->where('id_status_pembayaran', 1);
            $this->db->where('presensi', 1);
            // $this->db->where('tgl_ujian', $timeNow);
            $data['hadir'] = count($this->db->get()->result_array());

            // Belum Hadir
            $this->db->select('*');
            $this->db->from('peserta');
            $this->db->where('id_sertifikasi', $id_sert);
            $this->db->where('id_status_pembayaran', 1);
            $this->db->where('presensi', 0);
            // $this->db->where('tgl_ujian', $timeNow);
            $data['BelumHadir'] = count($this->db->get()->result_array());

            $data['id_kloter'] = $kloter;
            // var_dump($data['id_kloter']);

            $this->load->view('templates/p_header', $data);
            $this->load->view('presensi/sidebar');
            $this->load->view('presensi/absen', $data);
            $this->load->view('templates/p_footer');
        } elseif ($kloter == 1) {
            // Tampil semua peserta pada hari sekarang
            $this->db->select('*');
            $this->db->from('peserta');
            $this->db->where('id_sertifikasi', $id_sert);
            $this->db->where('id_status_pembayaran', 1);
            $this->db->where('kloter', $kloter);
            // $this->db->where('tgl_ujian', $timeNow);
            $data['peserta'] = $this->db->get()->result_array();

            // Jumlah peserta
            $data['JumlahPeserta'] = count($data['peserta']);

            // Hadir
            $this->db->select('*');
            $this->db->from('peserta');
            $this->db->where('id_sertifikasi', $id_sert);
            $this->db->where('id_status_pembayaran', 1);
            $this->db->where('presensi', 1);
            $this->db->where('kloter', $kloter);
            // $this->db->where('tgl_ujian', $timeNow);
            $data['hadir'] = count($this->db->get()->result_array());

            // Belum Hadir
            $this->db->select('*');
            $this->db->from('peserta');
            $this->db->where('id_sertifikasi', $id_sert);
            $this->db->where('id_status_pembayaran', 1);
            $this->db->where('presensi', 0);
            $this->db->where('kloter', $kloter);
            // $this->db->where('tgl_ujian', $timeNow);
            $data['BelumHadir'] = count($this->db->get()->result_array());

            $data['id_kloter'] = $kloter;

            $this->load->view('templates/p_header', $data);
            $this->load->view('presensi/sidebar');
            $this->load->view('presensi/absen');
            $this->load->view('templates/p_footer');
        } elseif ($kloter == 2) {
            // Tampil semua peserta pada hari sekarang
            $this->db->select('*');
            $this->db->from('peserta');
            $this->db->where('id_sertifikasi', $id_sert);
            $this->db->where('id_status_pembayaran', 1);
            $this->db->where('kloter', $kloter);
            // $this->db->where('tgl_ujian', $timeNow);
            $data['peserta'] = $this->db->get()->result_array();

            // Jumlah peserta
            $data['JumlahPeserta'] = count($data['peserta']);

            // Hadir
            $this->db->select('*');
            $this->db->from('peserta');
            $this->db->where('id_sertifikasi', $id_sert);
            $this->db->where('id_status_pembayaran', 1);
            $this->db->where('presensi', 1);
            $this->db->where('kloter', $kloter);
            // $this->db->where('tgl_ujian', $timeNow);
            $data['hadir'] = count($this->db->get()->result_array());

            // Belum Hadir
            $this->db->select('*');
            $this->db->from('peserta');
            $this->db->where('id_sertifikasi', $id_sert);
            $this->db->where('id_status_pembayaran', 1);
            $this->db->where('presensi', 0);
            $this->db->where('kloter', $kloter);
            // $this->db->where('tgl_ujian', $timeNow);
            $data['BelumHadir'] = count($this->db->get()->result_array());
            $data['id_kloter'] = $kloter;

            $this->load->view('templates/p_header', $data);
            $this->load->view('presensi/sidebar');
            $this->load->view('presensi/absen');
            $this->load->view('templates/p_footer');
        } elseif ($kloter == 3) {
            // Tampil semua peserta pada hari sekarang
            $this->db->select('*');
            $this->db->from('peserta');
            $this->db->where('id_sertifikasi', $id_sert);
            $this->db->where('id_status_pembayaran', 1);
            $this->db->where('kloter', $kloter);
            // $this->db->where('tgl_ujian', $timeNow);
            $data['peserta'] = $this->db->get()->result_array();

            // Jumlah peserta
            $data['JumlahPeserta'] = count($data['peserta']);

            // Hadir
            $this->db->select('*');
            $this->db->from('peserta');
            $this->db->where('id_sertifikasi', $id_sert);
            $this->db->where('id_status_pembayaran', 1);
            $this->db->where('presensi', 1);
            $this->db->where('kloter', $kloter);
            // $this->db->where('tgl_ujian', $timeNow);
            $data['hadir'] = count($this->db->get()->result_array());

            // Belum Hadir
            $this->db->select('*');
            $this->db->from('peserta');
            $this->db->where('id_sertifikasi', $id_sert);
            $this->db->where('id_status_pembayaran', 1);
            $this->db->where('presensi', 0);
            $this->db->where('kloter', $kloter);
            // $this->db->where('tgl_ujian', $timeNow);
            $data['BelumHadir'] = count($this->db->get()->result_array());
            $data['id_kloter'] = $kloter;

            $this->load->view('templates/p_header', $data);
            $this->load->view('presensi/sidebar');
            $this->load->view('presensi/absen');
            $this->load->view('templates/p_footer');
        } else {
            $kloter = 0;
            // Tampil semua peserta pada hari sekarang
            $this->db->select('*');
            $this->db->from('peserta');
            $this->db->where('id_sertifikasi', $id_sert);
            $this->db->where('id_status_pembayaran', 1);
            $this->db->where('kloter', $kloter);
            // $this->db->where('tgl_ujian', $timeNow);
            $data['peserta'] = $this->db->get()->result_array();

            // Jumlah peserta
            $data['JumlahPeserta'] = count($data['peserta']);

            // Hadir
            $this->db->select('*');
            $this->db->from('peserta');
            $this->db->where('id_sertifikasi', $id_sert);
            $this->db->where('id_status_pembayaran', 1);
            $this->db->where('presensi', 1);
            $this->db->where('kloter', $kloter);
            // $this->db->where('tgl_ujian', $timeNow);
            $data['hadir'] = count($this->db->get()->result_array());

            // Belum Hadir
            $this->db->select('*');
            $this->db->from('peserta');
            $this->db->where('id_sertifikasi', $id_sert);
            $this->db->where('id_status_pembayaran', 1);
            $this->db->where('presensi', 0);
            $this->db->where('kloter', $kloter);
            // $this->db->where('tgl_ujian', $timeNow);
            $data['BelumHadir'] = count($this->db->get()->result_array());
            $data['id_kloter'] = $kloter;

            $this->load->view('templates/p_header', $data);
            $this->load->view('presensi/sidebar');
            $this->load->view('presensi/absen');
            $this->load->view('templates/p_footer');
        }
    }

    public function mtc($kloter = null)
    {
        date_default_timezone_set('Asia/Jakarta');
        $timeNow = time();
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $timeNow = date('Y-m-d', $timeNow);
        $id_sert = 4;
        $data['nama_sert'] = 'mtc';

        $data['tglSekarang'] = $this->tgl->tglSekarang();
        $data['title'] = "Presensi Ujian - mtc";
        $data['judul'] = "Presensi Online Ujian Sertifikasi <br><b> MICROSOFT TECHNICAL CERTIFICATIONS (MTC)</b>";

        $data['kloter'] = [
            ['id' => null, 'nama' => 'All kloter'],
            ['id' => 1, 'nama' => 'Kloter 1'],
            ['id' => 2, 'nama' => 'Kloter 2'],
            ['id' => 3, 'nama' => 'Kloter 3'],
        ];

        if ($kloter == null) {
            $kloter = 0;
        }

        if ($kloter == 0) {
            // Tampil semua peserta pada hari sekarang
            $this->db->select('*');
            $this->db->from('peserta');
            $this->db->where('id_sertifikasi', $id_sert);
            $this->db->where('id_status_pembayaran', 1);
            // $this->db->where('tgl_ujian', $timeNow);
            $data['peserta'] = $this->db->get()->result_array();

            // Jumlah peserta
            $data['JumlahPeserta'] = count($data['peserta']);

            // Hadir
            $this->db->select('*');
            $this->db->from('peserta');
            $this->db->where('id_sertifikasi', $id_sert);
            $this->db->where('id_status_pembayaran', 1);
            $this->db->where('presensi', 1);
            // $this->db->where('tgl_ujian', $timeNow);
            $data['hadir'] = count($this->db->get()->result_array());

            // Belum Hadir
            $this->db->select('*');
            $this->db->from('peserta');
            $this->db->where('id_sertifikasi', $id_sert);
            $this->db->where('id_status_pembayaran', 1);
            $this->db->where('presensi', 0);
            // $this->db->where('tgl_ujian', $timeNow);
            $data['BelumHadir'] = count($this->db->get()->result_array());

            $data['id_kloter'] = $kloter;
            // var_dump($data['id_kloter']);

            $this->load->view('templates/p_header', $data);
            $this->load->view('presensi/sidebar');
            $this->load->view('presensi/absen', $data);
            $this->load->view('templates/p_footer');
        } elseif ($kloter == 1) {
            // Tampil semua peserta pada hari sekarang
            $this->db->select('*');
            $this->db->from('peserta');
            $this->db->where('id_sertifikasi', $id_sert);
            $this->db->where('id_status_pembayaran', 1);
            $this->db->where('kloter', $kloter);
            // $this->db->where('tgl_ujian', $timeNow);
            $data['peserta'] = $this->db->get()->result_array();

            // Jumlah peserta
            $data['JumlahPeserta'] = count($data['peserta']);

            // Hadir
            $this->db->select('*');
            $this->db->from('peserta');
            $this->db->where('id_sertifikasi', $id_sert);
            $this->db->where('id_status_pembayaran', 1);
            $this->db->where('presensi', 1);
            $this->db->where('kloter', $kloter);
            // $this->db->where('tgl_ujian', $timeNow);
            $data['hadir'] = count($this->db->get()->result_array());

            // Belum Hadir
            $this->db->select('*');
            $this->db->from('peserta');
            $this->db->where('id_sertifikasi', $id_sert);
            $this->db->where('id_status_pembayaran', 1);
            $this->db->where('presensi', 0);
            $this->db->where('kloter', $kloter);
            // $this->db->where('tgl_ujian', $timeNow);
            $data['BelumHadir'] = count($this->db->get()->result_array());

            $data['id_kloter'] = $kloter;

            $this->load->view('templates/p_header', $data);
            $this->load->view('presensi/sidebar');
            $this->load->view('presensi/absen');
            $this->load->view('templates/p_footer');
        } elseif ($kloter == 2) {
            // Tampil semua peserta pada hari sekarang
            $this->db->select('*');
            $this->db->from('peserta');
            $this->db->where('id_sertifikasi', $id_sert);
            $this->db->where('id_status_pembayaran', 1);
            $this->db->where('kloter', $kloter);
            // $this->db->where('tgl_ujian', $timeNow);
            $data['peserta'] = $this->db->get()->result_array();

            // Jumlah peserta
            $data['JumlahPeserta'] = count($data['peserta']);

            // Hadir
            $this->db->select('*');
            $this->db->from('peserta');
            $this->db->where('id_sertifikasi', $id_sert);
            $this->db->where('id_status_pembayaran', 1);
            $this->db->where('presensi', 1);
            $this->db->where('kloter', $kloter);
            // $this->db->where('tgl_ujian', $timeNow);
            $data['hadir'] = count($this->db->get()->result_array());

            // Belum Hadir
            $this->db->select('*');
            $this->db->from('peserta');
            $this->db->where('id_sertifikasi', $id_sert);
            $this->db->where('id_status_pembayaran', 1);
            $this->db->where('presensi', 0);
            $this->db->where('kloter', $kloter);
            // $this->db->where('tgl_ujian', $timeNow);
            $data['BelumHadir'] = count($this->db->get()->result_array());
            $data['id_kloter'] = $kloter;

            $this->load->view('templates/p_header', $data);
            $this->load->view('presensi/sidebar');
            $this->load->view('presensi/absen');
            $this->load->view('templates/p_footer');
        } elseif ($kloter == 3) {
            // Tampil semua peserta pada hari sekarang
            $this->db->select('*');
            $this->db->from('peserta');
            $this->db->where('id_sertifikasi', $id_sert);
            $this->db->where('id_status_pembayaran', 1);
            $this->db->where('kloter', $kloter);
            // $this->db->where('tgl_ujian', $timeNow);
            $data['peserta'] = $this->db->get()->result_array();

            // Jumlah peserta
            $data['JumlahPeserta'] = count($data['peserta']);

            // Hadir
            $this->db->select('*');
            $this->db->from('peserta');
            $this->db->where('id_sertifikasi', $id_sert);
            $this->db->where('id_status_pembayaran', 1);
            $this->db->where('presensi', 1);
            $this->db->where('kloter', $kloter);
            // $this->db->where('tgl_ujian', $timeNow);
            $data['hadir'] = count($this->db->get()->result_array());

            // Belum Hadir
            $this->db->select('*');
            $this->db->from('peserta');
            $this->db->where('id_sertifikasi', $id_sert);
            $this->db->where('id_status_pembayaran', 1);
            $this->db->where('presensi', 0);
            $this->db->where('kloter', $kloter);
            // $this->db->where('tgl_ujian', $timeNow);
            $data['BelumHadir'] = count($this->db->get()->result_array());
            $data['id_kloter'] = $kloter;

            $this->load->view('templates/p_header', $data);
            $this->load->view('presensi/sidebar');
            $this->load->view('presensi/absen');
            $this->load->view('templates/p_footer');
        } else {
            $kloter = 0;
            // Tampil semua peserta pada hari sekarang
            $this->db->select('*');
            $this->db->from('peserta');
            $this->db->where('id_sertifikasi', $id_sert);
            $this->db->where('id_status_pembayaran', 1);
            $this->db->where('kloter', $kloter);
            // $this->db->where('tgl_ujian', $timeNow);
            $data['peserta'] = $this->db->get()->result_array();

            // Jumlah peserta
            $data['JumlahPeserta'] = count($data['peserta']);

            // Hadir
            $this->db->select('*');
            $this->db->from('peserta');
            $this->db->where('id_sertifikasi', $id_sert);
            $this->db->where('id_status_pembayaran', 1);
            $this->db->where('presensi', 1);
            $this->db->where('kloter', $kloter);
            // $this->db->where('tgl_ujian', $timeNow);
            $data['hadir'] = count($this->db->get()->result_array());

            // Belum Hadir
            $this->db->select('*');
            $this->db->from('peserta');
            $this->db->where('id_sertifikasi', $id_sert);
            $this->db->where('id_status_pembayaran', 1);
            $this->db->where('presensi', 0);
            $this->db->where('kloter', $kloter);
            // $this->db->where('tgl_ujian', $timeNow);
            $data['BelumHadir'] = count($this->db->get()->result_array());
            $data['id_kloter'] = $kloter;

            $this->load->view('templates/p_header', $data);
            $this->load->view('presensi/sidebar');
            $this->load->view('presensi/absen');
            $this->load->view('templates/p_footer');
        }
    }
}
