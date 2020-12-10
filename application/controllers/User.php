<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $id = $this->session->userdata('id');
        $this->load->model('User_model', 'User');
        $this->User->CekSession($id);
        // $this->User->CekRole1_5($id);
        // $this->User->CekRole6($id);
        // $this->User->CekRole7_10($id);
        // $this->User->CekRole11($id);
    }

    public function index()
    {
        // var_dump($this->session->userdata());

        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['title'] = 'Profile';

        $query = "SELECT * FROM user_role WHERE id_role != 1";

        $data['user_role'] = $this->db->query($query)->result_array();


        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/admin_sidebar', $data);
        $this->load->view('templates/admin_topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/admin_footer');
    }

    public function load_user()
    {
        // $this->db->where('id', 1);
        $data_user = $this->db->get('user')->result();
        echo json_encode($data_user);
    }

    public function UserActived()
    {
        $id = $this->input->post('id');
        echo json_encode($this->User->UpdateActiveById($id));
    }

    public function UpdateSidebar()
    {
        echo json_encode($this->User->UpdateSidebar());
    }

    public function edit()
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['title'] = 'Edit Profile';

        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/admin_header', $data);
            $this->load->view('templates/admin_sidebar', $data);
            $this->load->view('templates/admin_topbar', $data);
            $this->load->view('user/edit', $data);
            $this->load->view('templates/admin_footer');
        } else {

            //Ambil data post
            $user_id = $this->input->post('id');
            $username = $this->input->post('username');
            $email = $this->input->post('email');
            $useDefault = $this->input->post('useDefault');

            //cek jika ada gambar yang akan diupload
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['upload_path'] = './assets/img/profile/';
                $config['allowed_types'] = 'jpg|png|svg|jpeg';
                $config['max_size']     = '2048';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $old_image = $data['user']['image'];

                    if ($old_image != 'default.svg') {
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            if ($useDefault == 1) {
                $this->db->set('image', 'default.svg');
            }

            $this->db->set('username', $username);
            $this->db->set('email', $email);
            $this->db->where('id', $user_id);
            $this->db->update('user');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Edit profil berhasil  </div>');
            redirect('user');
        }
    }

    public function changePassword()
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['title'] = 'Ganti Password';

        // $this->form_validation->set_rules('currentPassword', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('newPassword1', 'New Password', 'required|trim|min_length[3]|matches[newPassword2]');
        $this->form_validation->set_rules('newPassword2', 'Confirm New Password', 'required|trim|min_length[3]|matches[newPassword1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/admin_header', $data);
            $this->load->view('templates/admin_sidebar', $data);
            $this->load->view('templates/admin_topbar', $data);
            $this->load->view('user/changepassword', $data);
            $this->load->view('templates/admin_footer');
        } else {
            $cpass = $this->input->post('currentPassword');
            $npass = $this->input->post('newPassword1');

            if (!password_verify($cpass, $data['user']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong current password!  </div>');
                redirect('user/changepassword');
            } else {
                if ($npass == $cpass) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">New Password cannot be the same as current password!  </div>');
                    redirect('user/changepassword');
                } else {
                    //true password
                    $pw_hash = password_hash($npass, PASSWORD_DEFAULT);

                    $this->db->set('password', $pw_hash);
                    $this->db->where('id', $this->session->userdata('id'));
                    $this->db->update('user');

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password change!</div>');
                    redirect('user');
                }
            }
        }
    }

    public function tambah()
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['title'] = 'Tambah user';

        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[3]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/admin_header', $data);
            $this->load->view('templates/admin_sidebar', $data);
            $this->load->view('templates/admin_topbar', $data);
            $this->load->view('user/index', $data);
            $this->load->view('templates/admin_footer');
        } else {
            $username = $this->input->post('username');
            $email    = $this->input->post('email');
            $status   = $this->input->post('status');
            $password = $this->input->post('password');
            $pw_hash = password_hash($password, PASSWORD_DEFAULT);

            $dataTambah = array(
                'id' => '',
                'username' => $username,
                'email' => $email,
                'role' => $status,
                'last_active' => '0000000000',
                'is_active' => '1',
                'password' => $pw_hash,
                'image' => 'default.svg'
            );

            $this->db->insert('user', $dataTambah);

            $this->session->set_flashdata('message2', '<div class="alert alert-success" role="alert">
            Tambah user berhasil  </div>');
            redirect('user');
        }
    }

    public function hapus($User_id)
    {
        $this->db->where('id', $User_id);
        $this->db->delete('user');

        $this->session->set_flashdata('message2', '<div class="alert alert-success" role="alert">
            Hapus user berhasil  </div>');
        redirect('user');
    }

    public function editUser($User_id)
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['title'] = 'Edit user profile';

        $data['edit'] = $this->db->get_where('user', ['id' => $User_id])->row_array();

        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/admin_sidebar', $data);
        $this->load->view('templates/admin_topbar', $data);
        $this->load->view('user/editUser', $data);
        $this->load->view('templates/admin_footer');
    }

    public function editProses()
    {

        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim');

        //Ambil data post
        $user_id = $this->input->post('id');
        $username = $this->input->post('username');
        $email = $this->input->post('email');
        $useDefault = $this->input->post('useDefault');
        $data['user'] = $this->db->get_where('user', ['id' => $user_id])->row_array();


        //cek jika ada gambar yang akan diupload
        $upload_image = $_FILES['image'];

        if ($upload_image) {
            $config['upload_path'] = './assets/img/profile/';
            $config['allowed_types'] = 'jpg|png|svg|jpeg';
            $config['max_size']     = '2048';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $old_image = $data['user']['image'];

                if ($old_image != 'default.svg') {
                    unlink(FCPATH . 'assets/img/profile/' . $old_image);
                }

                $new_image = $this->upload->data('file_name');
                $this->db->set('image', $new_image);
            } else {
                echo $this->upload->display_errors();
            }
        }

        if ($useDefault == 1) {
            $this->db->set('image', 'default.svg');
        }

        $this->db->set('username', $username);
        $this->db->set('email', $email);
        $this->db->where('id', $user_id);
        $this->db->update('user');

        $this->session->set_flashdata('message2', '<div class="alert alert-success" role="alert">
            Edit profil berhasil  </div>');
        redirect('user');
    }

    public function gantipassword($id)
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['title'] = 'Ganti Password';

        $data['ganti'] = $this->db->get_where('user', ['id' => $id])->row_array();

        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/admin_sidebar', $data);
        $this->load->view('templates/admin_topbar', $data);
        $this->load->view('user/gantipassword', $data);
        $this->load->view('templates/admin_footer');
    }

    public function prosesganti()
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['title'] = 'Ganti Password';

        $id_input = $this->input->post('id');
        $data['ganti'] = $this->db->get_where('user', ['id' => $id_input])->row_array();

        $this->form_validation->set_rules('currentPassword', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('newPassword1', 'New Password', 'required|trim|min_length[3]|matches[newPassword2]');
        $this->form_validation->set_rules('newPassword2', 'Confirm New Password', 'required|trim|min_length[3]|matches[newPassword1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/admin_header', $data);
            $this->load->view('templates/admin_sidebar', $data);
            $this->load->view('templates/admin_topbar', $data);
            $this->load->view('user/gantipassword', $data);
            $this->load->view('templates/admin_footer');
        } else {
            $id = $this->input->post('id');
            $cpass = $this->input->post('currentPassword');
            $npass = $this->input->post('newPassword1');

            if (!password_verify($cpass, $data['ganti']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong current password!  </div>');
                redirect('user/changePassword');
            } else {
                if ($npass == $cpass) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">New Password cannet be the same as current password!  </div>');
                    redirect('user/changePassword');
                } else {
                    //true password
                    $pw_hash = password_hash($npass, PASSWORD_DEFAULT);

                    $this->db->set('password', $pw_hash);
                    $this->db->where('id', $id);
                    $this->db->update('user');

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password change!</div>');
                    redirect('user/changePassword');
                }
            }
        }
    }

    public function history()
    {
        $id = $this->session->userdata('id');


        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['title'] = 'History User';
        $see = $this->input->post('see');
        $data['see'] = $see;
        if ($see) {
            $query = "SELECT h.id, u.username, ip_address, browser, sistem_operasi, status, time
                    FROM history_user h, user u 
                    WHERE h.id_user = u.id
                    ORDER BY h.id DESC";

            $data['history'] = $this->db->query($query)->result_array();

            $this->load->view('templates/admin_header', $data);
            $this->load->view('templates/admin_sidebar', $data);
            $this->load->view('templates/admin_topbar', $data);
            $this->load->view('user/history', $data);
            $this->load->view('templates/admin_footer');
        } else {
            $query = "SELECT h.id, u.username, ip_address, browser, sistem_operasi, status, time
                    FROM history_user h, user u 
                    WHERE h.id_user = u.id
                    ORDER BY h.id DESC  LIMIT 10";

            $data['history'] = $this->db->query($query)->result_array();

            $this->load->view('templates/admin_header', $data);
            $this->load->view('templates/admin_sidebar', $data);
            $this->load->view('templates/admin_topbar', $data);
            $this->load->view('user/history', $data);
            $this->load->view('templates/admin_footer');
        }
    }

    public function resethistory()
    {
        $query = "DELETE FROM history_user";
        $this->db->query($query);
        redirect('user/history');
    }
}
