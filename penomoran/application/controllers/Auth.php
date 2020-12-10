<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function goToDefaultPage()
    {
        if ($this->session->userdata('role_id') == 1) {
            redirect('admin');
        } else if ($this->session->userdata('role_id') == 2) {
            redirect('user');
        } else {
            redirect('superadmin');
        }
    }

    public function index()
    {
        if ($this->session->userdata('email')) {
            $this->goToDefaultPage();
        }

        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        $keyword = $this->input->get('keyword');

        $data['keyword'] = $keyword;

        // $this->db->select('*');
        // $this->db->from('detail_penerima');
        // $this->db->where('nama', $keyword);
        // $this->db->or_where('no_identitas', $keyword);

        $kueri = "SELECT dp.id_pengajuan, p.nama_kegiatan, p.penyelenggara, 
                    p.tanggal_kegiatan, dp.nama, dp.no_sertifikat, dpe.tgl_terbit
                     FROM detail_penerima dp, pengajuan p, detail_penerbitan dpe WHERE p.id = dp.id_pengajuan 
                     AND p.id = dpe.id_pengajuan
                     AND no_sertifikat IS NOT NULL
                        AND (nama='$keyword' OR no_identitas = '$keyword' OR no_sertifikat = '$keyword')";

        $data['detail'] = $this->db->query($kueri)->result_array();

        $data['isi'] = 1;

        if ($keyword) {
            $detail = $data['detail'];
            if (!$detail) {
                $data['isi'] = 0;
            }
        }


        if ($this->form_validation->run() == false) {
            $data['tittle'] = 'PUSDIKLAT UTY';

            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        } else {
            $this->_login();
        }
    }

    public function lupa_password()
    {
        $data['tittle'] = 'PUSDIKLAT UTY';

        $this->load->view('templates/auth_header', $data);
        $this->load->view('auth/lupa_password');
        $this->load->view('templates/auth_footer');
    }


    private function _login()
    {
        $username = $this->input->post('name');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['email' => $username])->row_array();
        $penyelenggara = $this->db->get_where('pengajuan', ['penyelenggara' => $user['name']])->row_array();


        //jika user ada
        if ($user) {
            //cek password
            if (password_verify($password, $user['password'])) {
                $data = [
                    'email'         => $user['email'],
                    'id'            => $user['id'],
                    'penyelenggara' => $penyelenggara['penyelenggara'],
                    'role_id'       => $user['role_id']
                ];

                //buat nentuin masuk ke menu admin apa user
                //session
                $this->session->set_userdata($data);
                if ($user['role_id'] == 1) {
                    redirect('admin');
                } elseif ($user['role_id'] == 3) {
                    redirect('superadmin');
                } else {
                    redirect('user');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password Salah!</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Username Tidak Terdaftar</div>');
            redirect('auth');
        }
    }

    public function reg()
    {
        //untuk rule required sesuai name
        $this->form_validation->set_rules('name', 'Name', 'required|trim'); //namanya dari view, alias, rulesnya
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'This email has already register'
        ]); //is_unique [nama-tabel.nama-field]
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'Password dont match!',
            'min_length' => 'Password too short'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');


        if ($this->form_validation->run() == false) {
            $data['tittle'] = 'PUSDIKLAT UTY';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/registrasi');
            $this->load->view('templates/auth_footer');
        } else {
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 2
            ];

            $this->db->insert('user', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Akun Berhasil Dibuat</div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        //bersihkan session
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');
        $this->session->unset_userdata('id');
        $this->session->unset_userdata('penyelenggara');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Kamu Telah Logout</div>');
        redirect('auth');
    }

    public function blocked()
    {
        $data['role'] =  $this->session->userdata('role_id');
        $this->load->view('auth/blocked', $data);
    }
}
