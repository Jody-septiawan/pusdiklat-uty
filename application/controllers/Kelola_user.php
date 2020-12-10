<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelola_user extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $id = $this->session->userdata('id');
        $this->load->model('User_model', 'User');
        $this->load->model('Menu_model', 'Menu');
        $this->User->CekSession($id);
        // $this->User->CekRole1_5($id);
        $this->User->CekRole6($id);
        $this->User->CekRole7_10($id);
        // $this->User->CekRole11($id);
    }

    public function index()
    {
        redirect('kelola_user/admin');
    }

    public function admin()
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['title'] = 'Admin & Staff';

        date_default_timezone_set('Asia/Jakarta');
        $data['role'] = $this->db->get('user_role')->result_array();

        $query = "SELECT *,user_role.id_role AS id_role FROM user, user_role
                    WHERE user.role = user_role.id_role ORDER BY user.role ASC";

        $data['admin'] = $this->db->query($query)->result_array();

        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/admin_sidebar');
        $this->load->view('templates/admin_topbar');
        $this->load->view('kelola/admin');
        $this->load->view('templates/admin_footer');
    }

    public function addadmin()
    {
        $role = $this->input->post('role');
        $email = $this->input->post('email');
        $username = $this->input->post('username');
        $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);

        $data = [
            'role' => $role,
            'email' => $email,
            'username' => $username,
            'password' => $password,
            'is_active' => 1,
            'last_active' => '0000000000',
            'image' => 'default.svg'
        ];

        $add = $this->db->insert('user', $data);
        if ($add) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Tambah admin / staff berhasil  </div>');
            redirect('kelola_user/admin');
        }
    }
    // member ================================================
    public function member()
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['title'] = 'Member';

        $data['member'] = $this->db->get_where('user', ['role' => 6])->result_array();
        $data['kategori'] = $this->db->get('jenis_pendaftar')->result_array();
        $data['institusi'] = $this->db->get('institusi')->result_array();
        $data['prodi'] = $this->db->get('prodi')->result_array();

        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/admin_sidebar');
        $this->load->view('templates/admin_topbar');
        $this->load->view('kelola/member');
        $this->load->view('templates/admin_footer');
    }

    public function member_gantipw()
    {
        $id = $this->input->post('id');
        $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);

        $this->db->where('id', $id);
        $update = $this->db->update('user', ['password' => $password]);

        if ($update) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Ganti password berhasil  </div>');
            redirect('kelola_user/member');
        }
    }

    // =======================================================

    public function role()
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['title'] = 'Role';

        $query = "SELECT * FROM user_role ORDER BY role ASC";
        $data['role'] = $this->db->query($query)->result_array();


        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/admin_sidebar');
        $this->load->view('templates/admin_topbar');
        $this->load->view('kelola/role');
        $this->load->view('templates/admin_footer');
    }

    public function addRole()
    {
        $nama = $this->input->post('nama');

        $add = $this->db->insert('user_role', ['role' => $nama]);

        if ($add) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Tambah role berhasil  </div>');
            redirect('kelola_user/role');
        }
    }

    public function editRole()
    {
        $id = $this->input->post('id');
        $nama = $this->input->post('nama');

        $this->db->where('id_role', $id);
        $update = $this->db->update('user_role', ['role' => $nama]);

        if ($update) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Edit role berhasil  </div>');
            redirect('kelola_user/role');
        }
    }

    public function deleteRole($id = null)
    {
        $this->db->where('id_role', $id);
        $delete = $this->db->delete('user_role');

        if ($delete) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Hapus role berhasil  </div>');
            redirect('kelola_user/role');
        }
    }
}
