<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        // var_dump($this->session->userdata());

        if ($this->session->userdata('id')) {
            if ($this->session->userdata('role') == 6) :
                redirect('mbr');
            elseif ($this->session->userdata('role') >= 1 || $this->session->userdata('role') <= 5) :
                redirect('admin');
            elseif ($this->session->userdata('role') >= 7 || $this->session->userdata('role') <= 10) :
                redirect('ptr');
            elseif ($this->session->userdata('role') == 11) :
                redirect('admin');
            endif;
        }

        $data['title'] = 'Login - Pusdiklat & Sertifikasi UTY';

        $this->form_validation->set_rules('username', 'email or username', 'required|trim');
        $this->form_validation->set_rules('password', 'password', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/index', $data);
            $this->load->view('templates/auth_footer');
        } else {
            $this->proses_login();
        }
    }

    private function proses_login()
    {
        $waktu = time();
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $query = "SELECT * FROM user WHERE username = '$username' OR email = '$username'";

        $user = $this->db->query($query)->row_array();

        if ($user) {
            if ($user['is_active'] == 1) {
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'id' => $user['id'],
                        'role' => $user['role'],
                        'email' => $user['email']
                    ];

                    $this->session->set_userdata($data);

                    $DataOnline = [
                        'last_active' => 'Online',
                    ];

                    $this->db->where('id', $user['id']);
                    $this->db->update('user', $DataOnline);

                    // HISTORY LOGIN USER
                    if ($this->agent->is_browser()) {
                        $agent = $this->agent->browser() . ' ' . $this->agent->version();
                    } elseif ($this->agent->is_mobile()) {
                        $agent = $this->agent->mobile();
                    } else {
                        $agent = 'Data user gagal di dapatkan';
                    }

                    $ip = $this->input->ip_address();
                    $sistem_operasi = $this->agent->platform();

                    $dataHistory =
                        [
                            'id_user' => $user['id'],
                            'ip_address' => $ip,
                            'browser' => $agent,
                            'sistem_operasi' => $sistem_operasi,
                            'status' => 'login',
                            'time' => $waktu
                        ];
                    $this->db->insert('history_user', $dataHistory);

                    // CEK ROLE USER
                    if ($user['role'] >= 1 && $user['role'] <= 5) {
                        redirect('admin');
                    } else if ($user['role'] == 6) {
                        redirect('mbr');
                    } else if ($user['role'] >= 7 && $user['role'] <= 10) {
                        redirect('ptr');
                    } else if ($user['role'] == 11) {
                        redirect('admin');
                    } else {
                        redirect('auth/logout');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Wrong password!</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                account is being deactivated </div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Username is not registered! </div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        date_default_timezone_set('Asia/Jakarta');
        $time = time();

        $id = $this->session->userdata('id');

        if ($id) :
            // HISTORY LOGIN USER
            if ($this->agent->is_browser()) {
                $agent = $this->agent->browser() . ' ' . $this->agent->version();
            } elseif ($this->agent->is_mobile()) {
                $agent = $this->agent->mobile();
            } else {
                $agent = 'Data user gagal di dapatkan';
            }

            $ip = $this->input->ip_address();
            $sistem_operasi = $this->agent->platform();
            $dataHistory =
                [
                    'id_user' => $id,
                    'ip_address' => $ip,
                    'browser' => $agent,
                    'sistem_operasi' => $sistem_operasi,
                    'status' => 'logout',
                    'time' => time()
                ];
            $this->db->insert('history_user', $dataHistory);

            $DataLogoutOnline = [
                'last_active' => $time
            ];
            $this->db->where('id', $id);
            $this->db->update('user', $DataLogoutOnline);


            $this->session->unset_userdata('id');
            $this->session->unset_userdata('role');
            $this->session->unset_userdata('email');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            You success has been logout  </div>');
            redirect('auth');
        else :
            redirect('auth');
        endif;
    }
}
