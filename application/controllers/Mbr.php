<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mbr extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $id = $this->session->userdata('id');
        $this->load->model('User_model', 'User');
        $this->User->CekSession($id);
        $this->User->CekRole1_5($id);
        // $this->User->CekRole6($id);
        $this->User->CekRole7_10($id);
        $this->User->CekRole11($id);
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['title'] = 'Dashboard';
        $data['kelasSertifikasi'] = 0;

        $queryKelas = "SELECT k.*, COUNT(k.id) as peserta 
                        FROM kelas k, peserta p
                        WHERE k.id = p.id_kelas 
                        AND k.status = 'Buka'
                        GROUP BY k.id
                        ORDER BY id ASC";
        $kelas = $this->db->query("$queryKelas")->result_array();

        foreach ($kelas as $k) :
            if ($k['kuota'] != $k['peserta']) :
                $data['kelasSertifikasi']++;
            endif;
        endforeach;

        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/admin_sidebar', $data);
        $this->load->view('templates/admin_topbar', $data);
        $this->load->view('member/index', $data);
        $this->load->view('templates/admin_footer');
    }

    public function Profile()
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['title'] = 'Profile';

        $data['kategori'] = $this->db->get('jenis_pendaftar')->result_array();
        $data['institusi'] = $this->db->get('institusi')->result_array();
        $data['prodi'] = $this->db->get('prodi')->result_array();

        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/admin_sidebar', $data);
        $this->load->view('templates/admin_topbar', $data);
        $this->load->view('member/profile', $data);
        $this->load->view('templates/admin_footer');
    }

    public function ganti_password()
    {
        $id =  $this->session->userdata('id');
        $pass1 = $this->input->post('pass1');
        $pass2 = $this->input->post('pass2');

        if ($pass1 != $pass2) :
            $this->session->set_flashdata('ganti_pw_salah', 'Konfirmasi Password Salah');
        else :
            $pass = password_hash($pass1, PASSWORD_DEFAULT);
            $ganti_pw = $this->db->update('user', ['password' => $pass]);
            if ($ganti_pw) :
                $this->session->set_flashdata('ganti_pw', 'Berhasil Ganti password');
            else :
                $this->session->set_flashdata('ganti_pw', 'Gagal Ganti password');
            endif;
        endif;

        redirect('mbr');
    }

    public function editprofile()
    {
        $id             = $this->input->post('id');
        $no_identitas   = htmlspecialchars($this->input->post('no_identitas'));
        $nama_lengkap   = htmlspecialchars($this->input->post('nama_lengkap'));
        $tempat_lahir   = htmlspecialchars($this->input->post('tempat_lahir'));
        $tgl_lahir      = htmlspecialchars($this->input->post('tgl_lahir'));
        $gender         = htmlspecialchars($this->input->post('gender'));
        $no_hp          = htmlspecialchars($this->input->post('no_hp'));
        $kategori       = htmlspecialchars($this->input->post('kategori'));
        $institusi      = htmlspecialchars($this->input->post('institusi'));
        $prodi          = htmlspecialchars($this->input->post('prodi'));
        $username       = htmlspecialchars($this->input->post('username'));
        $email          = htmlspecialchars($this->input->post('email'));

        $data = [
            'no_identitas' => $no_identitas,
            'nama_lengkap' => $nama_lengkap,
            'tgl_lahir' => $tgl_lahir,
            'tempat_lahir' => $tempat_lahir,
            'jns_kelamin' => $gender,
            'no_hp' => $no_hp,
            'id_jenis' => $kategori,
            'institusi' => $institusi,
            'program_studi' => $prodi,
            'email' => $email,
            'username' => $username,
        ];

        $this->db->where('id', $id);
        $update = $this->db->update('user', $data);

        if ($update) :
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Berhasil Update Profile</div>');
        endif;
        redirect('mbr/profile');
    }
}
