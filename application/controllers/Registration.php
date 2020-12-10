<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Registration extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['title'] = "Registration - Pusdiklat & sertifikasi";
        $data['kategori'] = $this->db->get('jenis_pendaftar')->result_array();
        $data['institusi'] = $this->db->get('institusi')->result_array();
        $data['prodi'] = $this->db->get('prodi')->result_array();

        $this->load->view('beranda/header', $data);
        $this->load->view('beranda/navbar');
        $this->load->view('registration/index');
        $this->load->view('beranda/footer');
    }

    public function addmember()
    {
        $nama_lengkap   = htmlspecialchars($this->input->post('nama_lengkap'));
        $no_identitas   = htmlspecialchars($this->input->post('no_identitas'));
        $tgl_lahir      = htmlspecialchars($this->input->post('tgl_lahir'));
        $gender         = htmlspecialchars($this->input->post('gender'));
        $no_hp          = htmlspecialchars($this->input->post('no_hp'));
        $kategori       = htmlspecialchars($this->input->post('kategori'));
        $institusi      = htmlspecialchars($this->input->post('institusi'));
        $prodi          = htmlspecialchars($this->input->post('prodi'));
        $email          = htmlspecialchars($this->input->post('email'));
        $username       = htmlspecialchars($this->input->post('username'));
        $password       = htmlspecialchars($this->input->post('password'));

        $validate = [
            $no_identitas,
            $nama_lengkap,
            $tgl_lahir,
            $gender,
            $no_hp,
            $kategori,
            $institusi,
            $prodi,
            $email,
            $username,
            $password
        ];

        $data = [
            'no_identitas' => $no_identitas,
            'nama_lengkap' => $nama_lengkap,
            'tgl_lahir' => $tgl_lahir,
            'jns_kelamin' => $gender,
            'no_hp' => $no_hp,
            'id_jenis' => $kategori,
            'institusi' => $institusi,
            'program_studi' => $prodi,
            'email' => $email,
            'username' => $username,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'role' => 6,
            'last_active' => '0000000000',
            'is_active' => 1,
            'image' => 'default.svg'
        ];

        // var_dump($data);

        // die;

        // for ($i = 0; $i < count($validate); $i++) {
        //     if (empty($validate[$i])) {
        //         redirect('registration');
        //     }
        // };

        $add = $this->db->insert('user', $data);
        if ($add) :
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Pendaftaran berhasil, silahkan login  </div>');
            redirect('auth');
        else :
            redirect('Registration');
        endif;
    }

    public function no_identitas()
    {
        $this->db->select('no_identitas');
        $result = json_encode($this->db->get('user')->result_array());

        echo $result;
    }

    public function data_email()
    {
        $this->db->select('email');
        $result = json_encode($this->db->get('user')->result_array());

        echo $result;
    }

    public function data_username()
    {
        $this->db->select('username');
        $result = json_encode($this->db->get('user')->result_array());

        echo $result;
    }

    public function cekemail()
    {
        $email = $this->input->post('email');
        $response = "";
        $valid = true;
        $this->db->where('role', 7);
        $this->db->where('email', $email);
        $data_user = $this->db->get('user')->num_rows();
        if ($data_user >= 1) :
            $response = "Email sudah digunakan!";
            $valid = false;
        endif;
        $data = ['valid' => $valid, 'response' => $response];
        echo json_encode($data);
    }
}
