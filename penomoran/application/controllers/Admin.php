<?php

use function Complex\exp;

defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    // //user acces
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'PUSDIKLAT UTY';
        $data['aktif'] = 'Pengajuan Nomor';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->load->model('m_penomoran');

        $data['penomoran']  = $this->db->where('status', 1)->or_where('status', 4)->get('pengajuan')->result();
        $data['jenis']      = $this->db->get('jenis_kegiatan')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }

    public function detail($id)
    {
        $data['title'] = 'PUSDIKLAT UTY';
        $data['aktif'] = 'Pengajuan Nomor';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->load->model('m_penomoran');

        $detail = $this->m_penomoran->detail_data($id);
        $data['detail'] = $detail;

        $id_user = $detail->id_user;
        $data['id_user'] = $this->db->where('id', $id_user)->get('user')->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/detail', $data);
        $this->load->view('templates/footer');
    }

    public function rekap()
    {
        $data['title'] = 'PUSDIKLAT UTY';
        $data['aktif'] = 'Rekap Nomor Sertifikat';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->db->select('p.*, dp.id_pengajuan, dp.tgl_terbit, dp.id_kegiatan, dp.ket');
        $this->db->from('pengajuan p');
        $this->db->join('detail_penerbitan dp', 'dp.id_pengajuan = p.id');
        $this->db->where('p.status', 2);
        $query = $this->db->get()->result();

        $data['penomoran'] = $query;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/rekap', $data);
        $this->load->view('templates/footer');
    }

    public function detail_rekap($id)
    {
        $data['title'] = 'PUSDIKLAT UTY';
        $data['aktif'] = 'Rekap Nomor Sertifikat';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->load->model('m_penomoran');

        $detail = $this->m_penomoran->detail_data($id);
        $data['detail'] = $detail;

        $id_user = $detail->id_user;
        $data['id_user'] = $this->db->where('id', $id_user)->get('user')->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/detail_rekap', $data);
        $this->load->view('templates/footer');
    }

    public function detail_penerima($id)
    {
        $data['title'] = 'PUSDIKLAT UTY';
        $data['aktif'] = 'Pengajuan Nomor';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->load->model('m_penomoran');

        $detail = $this->m_penomoran->detail_data($id);
        $data['coba'] = $detail;

        $data['detail'] = $this->db->where('id_pengajuan', $id)->get('detail_penerima')->result();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/detail_penerima', $data);
        $this->load->view('templates/footer');
    }

    public function detail_rekap_penerima($id)
    {
        $data['title'] = 'PUSDIKLAT UTY';
        $data['aktif'] = 'Rekap Nomor Sertifikat';
        $data['user']  = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->load->model('m_penomoran');

        $detail = $this->m_penomoran->detail_data($id);
        $data['coba'] = $detail;

        $data['detail'] = $this->db->where('id_pengajuan', $id)->get('detail_penerima')->result();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/detail_rekap_penerima', $data);
        $this->load->view('templates/footer');
    }

    public function download2($id)
    {
        $data = $this->db->where('id', $id)->get('pengajuan')->row_array();

        force_download(FCPATH . 'assets/file/desain/' . $data['desain'], null);
        redirect('admin/detail_rekap/' . $id);
    }

    public function download3($id)
    {
        $data = $this->db->where('id', $id)->get('pengajuan')->row_array();

        force_download(FCPATH . 'assets/file/scan_formulir/' . $data['scan_formulir'], null);
        redirect('admin/detail_rekap/' . $id);
    }

    public function revisi()
    {
        $this->load->model('m_penomoran');
        $status = 3;
        $id     = $this->input->post('id');
        $pesan  = $this->input->post('pesan');

        $data['pengajuan'] = $this->db->get_where('pengajuan', ['id' => $id])->row_array();

        $data = array(
            'status' => $status,
            'pesan'  => $pesan
        );

        $where =  array(
            'id' => $id
        );

        $this->load->database();
        $this->db->trans_begin();

        $this->db->where($where);
        $this->db->update('pengajuan', $data);
        $this->hapus_penerima($id);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            echo 'gagal input data';
        } else {
            $this->db->trans_commit();
            echo 'berhasil';
        }

        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Pengajuan telah dikembalikan kepada pemohon</div>');
        redirect('admin');
    }

    private function hapus_penerima($id)
    {
        $this->load->model('m_penomoran');
        $where = array('id_pengajuan' => $id);

        $this->m_penomoran->hapus_penerima($where, 'detail_penerima');
    }


    public function terbit()
    {
        $tahun = date("Y");

        $id          = $this->input->post('id');  //id pengajuan
        $pengajuan   = $this->db->select('penyelenggara')->where('id', $id)->get('pengajuan')->row();
        $status_awal = $this->db->select('status')->where('id', $id)->get('pengajuan')->row();
        $user        = $this->db->select('kode_naungan', 'status')->where('name', $pengajuan->penyelenggara)->get('user')->row();
        $terbit      = $this->db->select('p.id')->from('pengajuan as p')->join('detail_penerbitan as dp', 'p.id = dp.id_pengajuan')->where('p.status', 2)->where('YEAR(dp.tgl_terbit)', $tahun)->count_all_results();
        $data        = $this->db->where('id_pengajuan', $id)->get('detail_penerima')->result();

        $satu  = 9;
        $dua   = $user->kode_naungan;
        $tiga  = date('y');
        $empat = $terbit + 1;
        $lima  = 1;

        $status = 2;
        $pesan  = "Nomor sertifikat telah terbit";

        $tgl_terbit     = $this->input->post('tanggal_terbit');
        $tgl_terbit     = date('Y-m-d', strtotime($tgl_terbit));
        $jenis_kegiatan = $this->input->post('jenis');
        $keterangan     = $this->input->post('keterangan');
        $penerbit       = $this->input->post('penerbit');
        $pola           = $satu  . $dua  . $tiga  . sprintf("%03s", $empat);

        $data1 = array(
            'status' => $status,
            'pesan'  => $pesan
        );

        $data2 = array(
            'id_pengajuan' => $id,
            'id_penerbit'  => $penerbit,
            'tgl_terbit'   => $tgl_terbit,
            'id_kegiatan'  => $jenis_kegiatan,
            'ket'          => $keterangan,
            'pola'         => $pola
        );

        $data3 = array(
            'id_penerbit' => $penerbit,
            'tgl_terbit'  => $tgl_terbit,
            'id_kegiatan' => $jenis_kegiatan,
            'ket'         => $keterangan
        );

        $where =  array(
            'id' => $id
        );

        $where2 =  array(
            'id_pengajuan' => $id
        );

        $this->load->database();
        $this->db->trans_begin();

        $this->db->where($where);
        $this->db->update('pengajuan', $data1);

        if ($status_awal->status == 1) {
            $this->db->insert('detail_penerbitan', $data2);

            foreach ($data as $dt) :
                $nomor = $satu  . $dua . $tiga  . sprintf("%03s", $empat) . sprintf("%04s", $lima);
                $lima++;

                $this->db->set('no_sertifikat', $nomor)->where('id', $dt->id)->update('detail_penerima');
            endforeach;
        }

        if ($status_awal->status == 4) {
            $data    = $this->db->where('id_pengajuan', $id)->where('no_sertifikat IS NULL')->get('detail_penerima')->result();
            $jumlah  = $this->db->select('id')->from('detail_penerima')->where('id_pengajuan', $id)->where('no_sertifikat IS NOT NULL')->count_all_results();
            $jumlah += 1;

            $pola_terbit = $this->db->select('pola')->where('id_pengajuan', $id)->get('detail_penerbitan')->row(); //masih object
            $pola_terbit = $pola_terbit->pola; //sudah string

            foreach ($data as $dt) :
                $nomor = $pola_terbit . '/' . sprintf("%04s", $jumlah);
                $jumlah++;

                $this->db->set('no_sertifikat', $nomor)->where('id', $dt->id)->update('detail_penerima');
            endforeach;

            $this->db->where($where2);
            $this->db->update('detail_penerbitan', $data3);
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            echo 'gagal input data';
        } else {
            $this->db->trans_commit();
            echo 'berhasil';
        }

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pengajuan Nomor Telah diterbitkan</div>');
        redirect('admin/');
    }

    public function cari()
    {
        $data['title'] = 'PUSDIKLAT UTY';
        $data['aktif'] = 'Pencarian Data';
        $data['user']  = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->load->model('m_penomoran');

        $this->db->select('p.*, dp.nama, dp.no_sertifikat');
        $this->db->from('pengajuan p');
        $this->db->join('detail_penerima dp', 'dp.id_pengajuan = p.id');
        $this->db->where('p.status', 2);
        $query = $this->db->get()->result();

        $data['penerima'] = $query;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/cari');
        $this->load->view('templates/footer');
    }

    public function detail_cari($id)
    {
        $data['title'] = 'PUSDIKLAT UTY';
        $data['aktif'] = 'Pencarian Data';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->load->model('m_penomoran');

        $detail = $this->m_penomoran->detail_data($id);
        $data['detail'] = $detail;

        $id_user = $detail->id_user;
        $data['id_user'] = $this->db->where('id', $id_user)->get('user')->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/detail_cari', $data);
        $this->load->view('templates/footer');
    }

    public function detail_cari_penerima($id)
    {
        $data['title'] = 'PUSDIKLAT UTY';
        $data['aktif'] = 'Pencarian Data';
        $data['user']  = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->load->model('m_penomoran');

        $detail = $this->m_penomoran->detail_data($id);
        $data['coba'] = $detail;

        $data['detail'] = $this->db->where('id_pengajuan', $id)->get('detail_penerima')->result();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/detail_cari_penerima', $data);
        $this->load->view('templates/footer');
    }

    public function rekap_admin()
    {
        $this->load->library('dompdf_gen');

        $awal  = $this->input->post('awal');
        $awal  = date('Y-m-d', strtotime($awal));
        $akhir = $this->input->post('akhir');
        $akhir = date('Y-m-d', strtotime($akhir));

        $query = "SELECT tgl_terbit, tanggal_kegiatan,nama_kegiatan, penyelenggara, jenis_penyelenggara,
        jenis_kegiatan, pihak_satu, pihak_dua, pihak_tiga, ket, no_sertifikat,max(no_sertifikat) as maks 
        FROM detail_penerbitan dp, pengajuan p, user u, jenis_penyelenggara jp, jenis_kegiatan jk, detail_penerima dpe 
        WHERE p.id= dp.id_pengajuan 
        AND p.id = dpe.id_pengajuan 
        AND u.id = p.id_user 
        AND jp.id = u.kode_penyelenggara 
        AND jk.id = dp.id_kegiatan 
        AND dp.tgl_terbit BETWEEN '$awal' AND '$akhir'
        group by dp.id_pengajuan";

        $rekap = $this->db->query($query)->result_array();
        $data['tampil']    = $rekap;

        $this->load->view('laporan_admin', $data);

        $paper_size = 'A4';
        $orientation = 'landscape';
        $html = $this->output->get_output();
        $this->dompdf->set_paper($paper_size, $orientation);

        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream("Nomor Sertifikat.pdf", array('attachement' => 0));
    }

    public function rekap_admin2($id)
    {
        $this->load->library('dompdf_gen');

        $jumlah = $this->db->where('id_pengajuan', $id)->from('detail_penerima')->count_all_results();

        $data['detail']    = $this->db->where('id_pengajuan', $id)->get('detail_penerima')->result();
        $data['pengajuan'] = $this->db->where('id', $id)->get('pengajuan')->result();
        $data['penerbitan'] = $this->db->where('id_pengajuan', $id)->get('detail_penerbitan')->result();
        $data['jumlah']    = $jumlah;

        $this->load->view('laporan_admin2', $data);

        $paper_size = 'A4';
        $orientation = 'portrait';
        $html = $this->output->get_output();
        $this->dompdf->set_paper($paper_size, $orientation);

        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream("Nomor Sertifikat.pdf", array('attachement' => 0));
    }

    public function pdf($id)
    {
        $this->load->model('m_penomoran');
        $this->load->library('dompdf_gen');

        $jumlah = $this->db->where('id_pengajuan', $id)->from('detail_penerima')->count_all_results();

        $data['detail']    = $this->db->where('id_pengajuan', $id)->get('detail_penerima')->result();;
        $data['pengajuan'] = $this->db->where('id', $id)->get('pengajuan')->result();;
        $data['jumlah']    = $jumlah;

        // var_dump($data);
        // exit;
        $this->load->view('laporan', $data);

        $paper_size = 'A4';
        $orientation = 'portrait';
        $html = $this->output->get_output();
        $this->dompdf->set_paper($paper_size, 'portrait');

        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream("Nomor Sertifikat.pdf", array('attachement' => 0));
    }

    // public function laporan_pdf()
    // {
    //     $this->load->library('pdf');

    //     $data = array(
    //         "dataku" => array(
    //             "nama" => "Petani Kode",
    //             "url" => "http://petanikode.com"
    //         )
    //     );

    //     $this->load->library('pdf');

    //     $this->pdf->set_paper('A4', 'potrait');
    //     $this->pdf->filename = "laporan-petanikode.pdf";
    //     $this->pdf->load_view('laporan_pdf', $data);
    // }


    public function profile()
    {
        $data['title'] = 'PUSDIKLAT UTY';
        $data['aktif'] = 'Profil';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('profil', $data);
        $this->load->view('templates/footer');
    }

    public function edit_profile()
    {
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $email = $this->input->post('email');

        $upload_image = $_FILES['image'];

        if ($upload_image) {
            $config['upload_path'] = './assets/img/profile/';
            $config['allowed_types'] = 'jpg|jpeg|png';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $old_image = $data['user']['image'];

                if ($old_image != 'default.jpg') {
                    unlink(FCPATH . './assets/img/profile/' . $old_image);
                }

                $new_image = $this->upload->data('file_name');
                $this->db->set('image', $new_image)->where('email', $email)->update('user');

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Telah Diedit</div>');
                redirect('admin/profile');
            } else {
                echo $this->upload->display_errors();
            }
        }
    }

    public function pesan()
    {
        $data['title'] = 'PUSDIKLAT UTY';
        $data['aktif'] = 'Pesan';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        // $data['pesan'] = $this->db->get('pesan')->result();

        $query = "SELECT*FROM user, pesan psn WHERE psn.pengirim = user.id AND 
                    waktu = (SELECT MAX(waktu) FROM pesan WHERE psn.pengirim = pesan.pengirim) 
                    ORDER BY waktu DESC";

        $pesan = $this->db->query($query)->result();

        $data['pesan']    = $pesan;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/pesan', $data);
        $this->load->view('templates/footer');
    }

    public function balas()
    {
        $penerima = $this->input->post('pengirim');
        $pengirim = 2;
        $isi_pesan = $this->input->post('balasan');

        $data = array(
            'pengirim' => $pengirim,
            'penerima'   => $penerima,
            'isi_pesan'  => $isi_pesan
        );

        $this->db->insert('pesan', $data);

        $query = "UPDATE pesan psn SET status = 0 WHERE pengirim = $penerima AND 
                waktu = (SELECT MAX(waktu) FROM pesan WHERE psn.pengirim = pesan.pengirim)";

        $this->db->query($query);

        // $this->db->set('status', 0)->where('pengirim', $penerima)->update('pesan');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pesan Telah Dibalas</div>');
        redirect('admin/riwayat_pesan');
    }

    public function riwayat_pesan()
    {
        $data['title'] = 'PUSDIKLAT UTY';
        $data['aktif'] = 'Riwayat Pesan';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['pesan'] = $this->db->get('pesan')->result();

        $query = "SELECT*FROM user, pesan psn WHERE psn.pengirim = user.id AND 
                    waktu = (SELECT MAX(waktu) FROM pesan WHERE psn.pengirim = pesan.pengirim) 
                    ORDER BY waktu DESC";

        $pesan = $this->db->query($query)->result();

        $data['pesan']    = $pesan;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/riwayat_pesan', $data);
        $this->load->view('templates/footer');
    }
}
