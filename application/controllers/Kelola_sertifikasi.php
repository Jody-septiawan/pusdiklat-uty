<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelola_sertifikasi extends CI_Controller
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
        redirect('kelola_sertifikasi/kelas');
    }

    public function kelas()
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['title'] = 'Jadwal & kelas';

        //Hitung jumlah peserta perkelas
        $queryJumlahPesertaKelas = "select k.id,count(p.kelas_id) as peserta from kelas k, peserta p
                        where k.id = p.kelas_id
                        GROUP BY p.kelas_id";
        $JumPeserta = $this->db->query($queryJumlahPesertaKelas)->result_array();

        //Data kelas & proctor
        $query = "SELECT k.*, u.username AS proctor
                    FROM kelas k
                    LEFT JOIN user u
                    ON u.id = k.id_proctor ORDER BY k.id ASC";
        $Kelas = $this->db->query($query)->result_array();

        //Inisialiasasi array
        $urut = 0;
        foreach ($Kelas as $k) :
            $Kelas[$urut]['peserta'] = [];
            $urut++;
        endforeach;

        //Gabung jumlah peserta per kelas dengan data kelas
        foreach ($JumPeserta as $jp) :
            $urut = 0;
            foreach ($Kelas as $k) :
                if ($k['id'] == $jp['id']) {
                    $Kelas[$urut]['peserta'] = $jp['peserta'];
                }
                $urut++;
                if (!$Kelas[$urut - 1]['peserta']) {
                    $Kelas[$urut - 1]['peserta'] = 0;
                }
            endforeach;
        endforeach;

        $data['kelas'] = $Kelas;

        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/admin_sidebar');
        $this->load->view('templates/admin_topbar');
        $this->load->view('kelola/kelas');
        $this->load->view('templates/admin_footer');
    }

    public function detailkelas($id = null)
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['title'] = 'Jadwal & kelas';

        $queryPeserta = "SELECT p.*,k.nama as kelas, k.tanggal as tanggal,sk.nama_sertifikasi as sertifikasi,sp.spesifikasi FROM peserta p, kelas k, sertifikasi_kat sk,spesifikasi sp
                            WHERE p.kelas_id = k.id
                            AND p.id_sertifikasi = sk.id
                            AND p.id_spesifikasi = sp.id
                            AND p.kelas_id = $id";
        $data['peserta'] = $this->db->query($queryPeserta)->result_array();

        $query = "SELECT k.*, u.username AS proctor
                        FROM kelas k
                        LEFT JOIN user u
                        ON u.id = k.id_proctor
                        WHERE k.id = $id";
        $data['kelas'] = $this->db->query($query)->row_array();

        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/admin_sidebar');
        $this->load->view('templates/admin_topbar');
        $this->load->view('kelola/detailkelas');
        $this->load->view('templates/admin_footer');
    }

    public function addkelas()
    {
        $nama = $this->input->post('nama');
        $waktu = strtotime($this->input->post('waktu'));
        $kuota = $this->input->post('kuota');
        $status = $this->input->post('status');

        echo date('d-M-Y, H:i', $waktu) . "<br>";

        if ($status != 1) {
            $status = 0;
        }

        $data = [
            'nama' => $nama,
            'tanggal' => $waktu,
            'kuota' => $kuota,
            'status' => $status
        ];

        $kelas = $this->db->insert('kelas', $data);

        if ($kelas) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Tambah kelas berhasil  </div>');
            redirect('kelola_sertifikasi/kelas');
        };
    }

    public function deletekelas($id = null)
    {
        if ($id) {
            $this->db->where('id', $id);
            $this->db->delete('kelas');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Hapus kelas berhasil  </div>');
        }
        redirect('kelola_sertifikasi/kelas');
    }

    public function editkelas($id = null)
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['title'] = 'Jadwal & kelas';

        $query = "SELECT k.*, u.username AS proctor
                    FROM kelas k
                    LEFT JOIN user u
                    ON u.id = k.id_proctor
                    WHERE k.id = $id";
        $data['kelas'] = $this->db->query($query)->row_array();

        $this->db->where('role', 3);
        $data['proctor'] = $this->db->get('user')->result_array();


        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/admin_sidebar');
        $this->load->view('templates/admin_topbar');
        $this->load->view('kelola/editkelas');
        $this->load->view('templates/admin_footer');
    }

    public function proseseditkelas()
    {
        $id = $this->input->post('id');
        $nama = $this->input->post('nama');
        $waktu = strtotime($this->input->post('waktu'));
        $kuota = $this->input->post('kuota');
        $status = $this->input->post('status');
        $proctor = $this->input->post('proctor');

        $data = [
            'nama' => $nama,
            'tanggal' => $waktu,
            'kuota' => $kuota,
            'status' => $status,
            'id_proctor' => $proctor
        ];

        $this->db->where('id', $id);
        $update = $this->db->update('kelas', $data);

        if ($update) :
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Edit kelas berhasil  </div>');
        endif;

        redirect('kelola_sertifikasi');
    }
}
