<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $id = $this->session->userdata('id');
        $this->load->model('User_model', 'User');
        $this->User->CekSession($id);
        // $this->User->CekRole1_5($id);
        $this->User->CekRole6($id);
        $this->User->CekRole7_10($id);
        // $this->User->CekRole11($id);
    }

    public function index()
    {

        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['title'] = 'Dashboard';

        // $DataMos = "SELECT * FROM peserta p, pembayaran_kat pk, sertifikasi_kat sk
        //             WHERE p.id_sertifikasi = sk.id
        //             AND p.status_pembayaran = pk.id 
        //             AND p.id_sertifikasi = 1
        //             AND p.status_pembayaran = 1";

        // $DataMta = "SELECT * FROM peserta p, pembayaran_kat pk, sertifikasi_kat sk
        //             WHERE p.id_sertifikasi = sk.id
        //             AND p.status_pembayaran = pk.id 
        //             AND p.id_sertifikasi = 2
        //             AND p.status_pembayaran = 1";

        // $DataMce = "SELECT * FROM peserta p, pembayaran_kat pk, sertifikasi_kat sk
        //             WHERE p.id_sertifikasi = sk.id
        //             AND p.status_pembayaran = pk.id 
        //             AND p.id_sertifikasi = 3
        //             AND p.status_pembayaran = 1";

        // $DataMtc = "SELECT * FROM peserta p, pembayaran_kat pk, sertifikasi_kat sk
        //             WHERE p.id_sertifikasi = sk.id
        //             AND p.status_pembayaran = pk.id 
        //             AND p.id_sertifikasi = 4
        //             AND p.status_pembayaran = 1";

        // $data['mos'] = $this->db->query($DataMos)->result_array();
        // $data['mta'] = $this->db->query($DataMta)->result_array();
        // $data['mce'] = $this->db->query($DataMce)->result_array();
        // $data['mtc'] = $this->db->query($DataMtc)->result_array();


        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/admin_sidebar', $data);
        $this->load->view('templates/admin_topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/admin_footer');
    }

    public function kelas()
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['proctor'] = $this->db->get_where('user', ['role' => 7])->result_array();

        $data['title'] = 'Kelas';
        $data['akun_user'] = $this->db->get_where(
            'user',
            ['email' => $this->session->userdata('email')]
        )->row_array();
        $data['kelas'] = $this->db->get('kelas')->result_array();

        $this->form_validation->set_rules('nama_kelas', 'Nama Kelas', 'required');
        $this->form_validation->set_rules('nama_ruangan', 'Nama ruangan', 'required');
        $this->form_validation->set_rules('lokasi', 'Lokasi', 'required');
        $this->form_validation->set_rules('kuota', 'Kuota', 'required');
        $this->form_validation->set_rules('tanggal_ujian', 'Tanggal Ujian', 'required');
        $this->form_validation->set_rules('status_kelas', 'Status Kelas', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/admin_header', $data);
            $this->load->view('templates/admin_sidebar', $data);
            $this->load->view('templates/admin_topbar', $data);
            $this->load->view('admin/kelas', $data);
            $this->load->view('templates/admin_footer');
        } else {
            $this->db->insert('kelas', [
                'nama' => $this->input->post('nama_kelas'),
                'ruangan' => $this->input->post('nama_ruangan'),
                'lokasi' => $this->input->post('lokasi'),
                'kuota' => $this->input->post('kuota'),
                'sisa_kuota' => $this->input->post('kuota'),
                'tanggal' => strtotime($this->input->post('tanggal_ujian')),
                'status' => $this->input->post('status_kelas')

            ]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Kelas berhasil ditambahan ! </div>');
            redirect('admin/kelas');
        }
    }

    public function hapus_kelas($id)
    {
        $this->load->model('M_admin');
        $where = ['id' => $id];
        $this->M_admin->hapus_kelas($where, 'kelas');
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
					Kelas berhasil dihapus !
					  </div>');
        redirect('admin/kelas');
    }

    public function edit_kelas()
    {
        $id = $this->input->post('id');
        $nama_kelas = $this->input->post('nama_kelas');
        $tanggal_ujian = strtotime($this->input->post('tanggal_ujian'));
        $kuota = $this->input->post('kuota');
        $sisa_kuota = $this->input->post('sisa_kuota');
        $status_kelas = $this->input->post('status_kelas');
        $proctor = $this->input->post('proctor');

        $data = [
            'nama' => $nama_kelas,
            'tanggal' => $tanggal_ujian,
            'kuota' => $kuota,
            'sisa_kuota' => $sisa_kuota,
            'status' => $status_kelas,
            'id_proctor' => $proctor
        ];

        $this->db->where('id', $id);
        $update = $this->db->update('kelas', $data);

        if ($update) :
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Edit kelas berhasil  </div>');
        endif;

        redirect('admin/kelas');
    }

    public function verifikasi_pembayaran()
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();

        $data['title'] = 'Verifikasi Pembayaran';
        $data['akun_user'] = $this->db->get_where(
            'user',
            ['email' => $this->session->userdata('email')]
        )->row_array();
        $buka = "Buka";

        $query = "SELECT * FROM kelas
		--  WHERE kelas.`status_kelas` ='$buka'
		ORDER BY kelas.`tanggal` ASC";
        $data['verifikasi_pembayaran'] = $this->db->query($query)->result_array();

        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/admin_sidebar', $data);
        $this->load->view('templates/admin_topbar', $data);
        $this->load->view('admin/verifikasi_pembayaran', $data);
        $this->load->view('templates/admin_footer');
    }

    public function data_peserta($id)
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();

        // var_dump($id);
        // die;
        $data['title'] = 'Data Peserta';
        $data['akun_user'] = $this->db->get_where(
            'user',
            ['email' => $this->session->userdata('email')]
        )->row_array();
        $id_kelas = $id;
        $data['id_kelas'] = $id_kelas;

        $query = "SELECT peserta.*, user.`nama_lengkap`,user.`no_identitas`, kelas.`nama`, jenis_ujian.`id_ujian`
					FROM peserta, user, kelas, boking_kelas, jenis_ujian
					WHERE peserta.`id_akun_user`= user.`id`
					AND peserta.`id_boking` = boking_kelas.`id`
					AND boking_kelas.`id_kelas` = kelas.`id`
					AND boking_kelas.`id_ujian` = jenis_ujian.`id_ujian`
					AND kelas.id = $id_kelas
				    GROUP BY peserta.`id`";

        $data['data_peserta'] = $this->db->query($query)->result_array();

        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/admin_sidebar', $data);
        $this->load->view('templates/admin_topbar', $data);
        $this->load->view('admin/data_peserta', $data);
        $this->load->view('templates/admin_footer');
    }

    public function verifikasi($id, $id_kelas)
    {
        $data['akun_user'] = $this->db->get_where(
            'user',
            ['email' => $this->session->userdata('email')]
        )->row_array();

        $id_peserta = $id;
        $query = "SELECT peserta.`status`
					FROM peserta
					WHERE peserta.`id`=$id_peserta";
        $status = $this->db->query($query)->row();
        $status = $status->status;
        $status = "Terverifikasi";

        $this->db->set('status', $status);
        $this->db->where('id', $id_peserta);
        $this->db->update('peserta');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			Peserta Berhasil Di Verifikasi !
		  </div>');
        redirect("admin/data_peserta/$id_kelas");
    }

    public function batalkan($id, $id_kelas)
    {
        $data['akun_user'] = $this->db->get_where(
            'user',
            ['email' => $this->session->userdata('email')]
        )->row_array();

        $id_peserta = $id;
        $query = "SELECT peserta.`status`
					FROM peserta
					WHERE peserta.`id`=$id_peserta";
        $status = $this->db->query($query)->row();
        $status = $status->status;
        $status = "Pending";

        $this->db->set('status', $status);
        $this->db->where('id', $id_peserta);
        $this->db->update('peserta');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			Verifikasi Dibatalkan !
		  </div>');
        redirect("admin/data_peserta/$id_kelas");
    }

    public function tarif()
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();

        $data['title'] = 'Tarif';
        $data['akun_user'] = $this->db->get_where(
            'user',
            ['email' => $this->session->userdata('email')]
        )->row_array();
        $this->load->helper('rupiah_helper');

        $data['jenis_pendaftar'] = $this->db->get('jenis_pendaftar')->result_array();
        $data['jenis_ujian'] = $this->db->get('jenis_ujian')->result_array();
        $data['peserta'] = $this->db->get('peserta')->result_array();

        $query = "SELECT tarif.*,jenis_pendaftar.`nama_jenis` , jenis_ujian.jenis_sertifikasi
					FROM jenis_pendaftar, tarif , jenis_ujian
					WHERE jenis_pendaftar.`id`=tarif.`id_jenis`
					and jenis_ujian.id_ujian = tarif.id_ujian
					ORDER BY tarif.`id_jenis` ASC";
        $data['tarif'] = $this->db->query($query)->result_array();
        // var_dump($data['tarif']);
        // die;

        $this->form_validation->set_rules('tarif', 'Tarif', 'required');
        $this->form_validation->set_rules('id_jenis', 'Jenis Pendaftar', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/admin_header', $data);
            $this->load->view('templates/admin_sidebar', $data);
            $this->load->view('templates/admin_topbar', $data);
            $this->load->view('admin/tarif', $data);
            $this->load->view('templates/admin_footer');
        } else {
            $this->db->insert('tarif', [
                'tarif' => $this->input->post('tarif'),
                'id_jenis' => $this->input->post('id_jenis'),
                'id_ujian' => $this->input->post('id_ujian')
            ]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Tarif berhasil ditambahan ! </div>');
            redirect('admin/tarif');
        }
    }

    public function edit_tarif($id = null)
    {
        $id = $this->input->post('id');
        $tarif = $this->input->post('tarif');
        $id_jenis = $this->input->post('id_jenis');
        $id_ujian = $this->input->post('id_ujian');

        $data = [
            'tarif' => $tarif,
            'id_jenis' => $id_jenis,
            'id_ujian' => $id_ujian,
        ];
        $this->db->where('id', $id);
        $update = $this->db->update('tarif', $data);

        if ($update) :
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Edit tarif berhasil  </div>');
        endif;

        redirect('admin/tarif');
    }

    public function hapus_tarif($id)
    {
        $this->load->model('M_admin');
        $where = ['id' => $id];
        $this->M_admin->hapus_tarif($where, 'tarif');
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
					Tarif berhasil dihapus !
					  </div>');
        redirect('admin/tarif');
    }
}
