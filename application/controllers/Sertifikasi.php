<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sertifikasi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // is_logged_in();
        // $this->hapus_otomatis($id_kelas);
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('M_sertifikasi');
        $this->M_sertifikasi->hapus_otomatis();
        $this->load->model('User_model', 'User');

        $id = $this->session->userdata('id');
        $this->User->CekRole1_5($id);
        // $this->User->CekRole6($id);
        $this->User->CekRole7_10($id);
        $this->User->CekRole11($id);
    }


    public function ujian_sertifikasi()
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();

        $data['title'] = 'Ujian Sertifikasi';
        $data['akun_user'] = $this->db->get_where(
            'user',
            ['email' => $this->session->userdata('email')]
        )->row_array();

        $id_user = $data['akun_user']['id'];
        $query = "SELECT boking_kelas.*, user.`nama_lengkap`, user.`no_identitas`, kelas.`nama`,tarif.`tarif`,jenis_ujian.*
					FROM user, boking_kelas, kelas, tarif, jenis_ujian
					WHERE boking_kelas.`id_akun_user` = user.`id`
					AND boking_kelas.`id_kelas`	=kelas.`id`
					AND user.`id_jenis` = tarif.`id_jenis`
					AND boking_kelas.`id_tarif`= tarif.`id`	
					AND boking_kelas.`id_ujian`= jenis_ujian.`id_ujian`	
					AND user.`id` = $id_user
					-- GROUP BY boking_kelas.`id`";

        $data['boking_kelas']  = $this->db->query($query)->result_array();

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/admin_header', $data);
            $this->load->view('templates/admin_sidebar', $data);
            $this->load->view('templates/admin_topbar', $data);
            $this->load->view('sertifikasi/ujian_sertifikasi', $data);
            $this->load->view('templates/admin_footer');
        }
    }

    public function daftar_kelas()
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();

        $data['title'] = 'Daftar Kelas';
        $data['akun_user'] = $this->db->get_where(
            'user',
            ['email' => $this->session->userdata('email')]
        )->row_array();
        // $data['kelas'] = $this->db->get_where('kelas', ['status_kelas' => 'Buka'])->result_array();
        // $id_user = $data['akun_user']['id'];

        // $sql = "SELECT COUNT(boking_kelas.`id_kelas`)
        // 			FROM boking_kelas, kelas
        // 			WHERE kelas.`id`=boking_kelas.`id_kelas`
        // 		GROUP BY kelas.`id`";
        // $sisa = $this->db->query($sql)->result_array();
        $id_akun_user = $data['akun_user']['id'];
        $query = "SELECT  kelas.*
					FROM kelas
				GROUP BY   kelas.`id`";
        $data['jenis_ujian'] = $this->db->get('jenis_ujian')->result_array();
        $data['kelas'] = $this->db->query($query)->result_array();

        // $sql = "SELECT kelas.`tanggal_ujian`, kelas.`id`
        // 		FROM kelas, boking_kelas
        // 		WHERE kelas.`id`=boking_kelas.`id_kelas`
        // 		AND boking_kelas.`id_akun_user`=$id_akun_user
        // 		GROUP BY kelas.`id`";		
        $sql = "SELECT `user`.id, kelas.`id` as id_kelas,jenis_ujian.* 
		FROM user, boking_kelas, kelas, jenis_ujian
		WHERE user.`id`=boking_kelas.`id_akun_user`
		AND boking_kelas.`id_kelas`=kelas.`id`
		AND boking_kelas.`id_ujian`=jenis_ujian.`id_ujian`
		AND `user`.`id`=$id_akun_user";
        $data['boking'] = $this->db->query($sql)->result_array();
        // var_dump($data['boking']);
        // die;
        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/admin_sidebar', $data);
        $this->load->view('templates/admin_topbar', $data);
        $this->load->view('sertifikasi/daftar_kelas', $data);
        $this->load->view('templates/admin_footer');
    }

    public function bo_kelas($id)
    {
        $data['akun_user'] = $this->db->get_where(
            'user',
            ['email' => $this->session->userdata('email')]
        )->row_array();
        $id_akun_user = $data['akun_user']['id'];

        $cek_pendaftaran = "SELECT COUNT(`user`.id) AS jumlah
		FROM user, boking_kelas, kelas
		WHERE user.id = boking_kelas.`id_akun_user`
		AND boking_kelas.`id_kelas` = kelas.`id`
		AND user.`id` = $id_akun_user
		AND kelas.`id` = $id";

        $pendaftaran = $this->db->query($cek_pendaftaran)->row();
        $pendaftaran = $pendaftaran->jumlah;

        if ($pendaftaran > 0) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Anda Telah Terdaftar Dikelas ini sebelumnya! </div>');
            redirect('sertifikasi/ujian_sertifikasi');
        } else {

            $query = "SELECT  tarif.`id`
					FROM user, jenis_pendaftar, tarif
					WHERE  user.`id_jenis`= jenis_pendaftar.`id`
					AND	jenis_pendaftar.`id`=tarif.`id_jenis`
					AND user.`id`= $id_akun_user";

            $id_tarif = $this->db->query($query)->row();
            $id_kelas = $id;
            $id_tarif = $id_tarif->id;
            $id_ujian = $this->input->post('id_ujian');
            $tanggal_pesan = date("Y/m/d");
            $status_boking = "Terboking";
            $is_active = 1;
            $date_created = time();

            $data = [
                'id_akun_user' => $id_akun_user,
                'id_kelas' => $id_kelas,
                'id_tarif' => $id_tarif,
                'id_ujian' => $id_ujian,
                'tanggal_pesan' => $tanggal_pesan,
                'status_boking' => $status_boking,
                'is_active' => $is_active,
                'date_created' => $date_created
            ];

            $sql = "SELECT sisa_kuota
					FROM kelas
					WHERE id=$id_kelas";
            $sisa = $this->db->query($sql)->row();
            $sisa = $sisa->sisa_kuota;
            $sisa = $sisa - 1;
            $habis = "Tutup";
            $query = "UPDATE kelas 
						SET kelas.`status_kelas` = '$habis' 
						WHERE kelas.`id` = $id_kelas";

            $this->db->insert('boking_kelas', $data);
            $this->hapus_otomatis($id_kelas);
            $this->db->set('sisa_kuota', $sisa)->where('id', $id_kelas)->update('kelas');
            if ($sisa < 1) {
                $this->db->query($query);
            }


            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Kelas Berhasil Dipesan ! </div>');
            redirect('sertifikasi/ujian_sertifikasi');
        }
    }

    public function hapus_otomatis($id_kelas)
    {
        $data['akun_user'] = $this->db->get_where(
            'user',
            ['email' => $this->session->userdata('email')]
        )->row_array();
        $id_akun_user = $data['akun_user']['id'];
        $time = time();
        $lama = 60;
        $sql = "SELECT sisa_kuota
					FROM kelas
					WHERE id=$id_kelas";
        $sisa = $this->db->query($sql)->row();
        $sisa = $sisa->sisa_kuota;
        $sisa = $sisa + 1;
        $hapus = "DELETE FROM boking_kelas
							WHERE ($time - boking_kelas.`date_created`) > $lama
							  AND boking_kelas.`id_akun_user` = $id_akun_user
							  AND boking_kelas.`is_active` = 1 ";
        // if (time() - $date_created > (60 * 60)) {
        $this->db->query($hapus);
        if ($hapus) {
            $this->db->set('sisa_kuota', $sisa)->where('id', $id_kelas)->update('kelas');
        }
        // }
    }

    public function konfirmasi($id, $id_kelas, $id_ujian)
    {
        $data['title'] = 'Daftar Kelas';
        $data['akun_user'] = $this->db->get_where(
            'user',
            ['email' => $this->session->userdata('email')]
        )->row_array();

        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('kelas', 'Kelas', 'required');
        $this->form_validation->set_rules('no_slip', 'No Slip', 'required');
        $this->form_validation->set_rules('bukti_bayar', 'Bukti Bayar', 'required');

        $id_akun_user = $data['akun_user']['id'];
        $id_boking = $id;
        $no_slip = $this->input->post('no_slip');
        $bukti_bayar = $_FILES['bukti_bayar'];
        $query = "SELECT COUNT(*)
					FROM peserta
					WHERE peserta.`no_slip`=$no_slip
					GROUP BY peserta.id ";
        $slip = $this->db->query($query)->row();
        // var_dump($slip);
        // die;

        if ($slip > 0) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">No slip sudah digunakan</div>');
            redirect('sertifikasi/ujian_sertifikasi');
        }
        if ($bukti_bayar = '') {
        } else {
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '2048';
            $config['upload_path'] = './assets/img/slip';
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('bukti_bayar')) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data Belum Lengkap, Harap upload foto slip pembayaran</div>');
                redirect('sertifikasi/ujian_sertifikasi');
            } else {
                $bukti_bayar = $this->upload->data('file_name');
            }
        }

        $data = [
            'id_akun_user' => $id_akun_user,
            'id_kelas' => $id_kelas,
            'id_boking' => $id_boking,
            'id_ujian' => $id_ujian,
            'no_slip' => $no_slip,
            'tanggal_bayar' => date("Y/m/d"),
            'bukti_bayar' => $bukti_bayar
        ];
        $active = 0;
        $query = "UPDATE boking_kelas 
					SET boking_kelas.`is_active` = $active 
					WHERE boking_kelas.`id` = $id_boking";
        $this->db->insert('peserta', $data);

        $this->db->query($query);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			Pendaftaran Berhasil Dikonfirmasi !!!
		  </div>');
        redirect('sertifikasi/status_pendaftaran');
    }

    public function status_pendaftaran()
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();

        $data['title'] = 'Status Pendaftaran';
        $data['akun_user'] = $this->db->get_where(
            'user',
            ['email' => $this->session->userdata('email')]
        )->row_array();
        $id_user = $data['akun_user']['id'];
        $query = "SELECT peserta.*, user.`nama_lengkap`,user.`no_identitas`, kelas.`nama`
		FROM peserta, user, kelas, boking_kelas
		WHERE peserta.`id_akun_user`=user.`id`
		AND peserta.`id_boking` = boking_kelas.`id`
		AND boking_kelas.`id_kelas` = kelas.`id`
		AND user.`id` = $id_user
		-- GROUP BY peserta.`id`";

        $data['status_pendaftaran'] = $this->db->query($query)->result_array();

        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/admin_sidebar', $data);
        $this->load->view('templates/admin_topbar', $data);
        $this->load->view('sertifikasi/status_pendaftaran', $data);
        $this->load->view('templates/admin_footer');
    }
    public function kartu_ujian($id)
    {

        $data['akun_user'] = $this->db->get_where(
            'user',
            ['email' => $this->session->userdata('email')]
        )->row_array();
        $id_peserta = $id;
        $id_akun_user = $data['akun_user']['id'];


        $query = "SELECT peserta.`id`, user.`nama_lengkap`,user.`no_identitas`, user.`image`, user.`tgl_lahir`, kelas.`nama`,kelas.`lokasi`, kelas.`tanggal`, jenis_ujian.* , jenis_sertifikasi.*
		FROM peserta, user, kelas, boking_kelas, jenis_ujian, jenis_sertifikasi
		WHERE peserta.`id_akun_user`= user.`id`
		AND peserta.`id_boking`= boking_kelas.`id`
		AND boking_kelas.`id_kelas`= kelas.`id`
		AND boking_kelas.`id_ujian`= jenis_ujian.`id_ujian`
		AND jenis_ujian.`id_sertifikasi` = jenis_sertifikasi.`id_sertifikasi`
		AND user.`id`= $id_akun_user
		AND $id_peserta";

        $data['kartu_ujian'] = $this->db->query($query)->row_array();

        $this->load->library('pdf');
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = "kartu_ujian.pdf";
        $this->pdf->load_view('sertifikasi/kartu_ujian', $data);
    }
}
