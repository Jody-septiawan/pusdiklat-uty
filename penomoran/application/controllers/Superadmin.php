<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Superadmin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'PUSDIKLAT UTY';
        $data['aktif'] = 'Daftar Member';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->load->model('m_penomoran');

        $role = array(
            'role_id !=' => 3
        );
        $data['member'] = $this->db->where($role)->get('user')->result_array();
        $data['naungan'] = $this->db->get('naungan')->result_array();
        $data['j_member'] = $this->db->get('jenis_penyelenggara')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('superadmin/tambah', $data);
        $this->load->view('templates/footer');
    }

    public function tambah_member()
    {
        $nama  = htmlspecialchars($this->input->post('name', true));

        $this->form_validation->set_rules('name', 'Name', 'required|trim|is_unique[user.name]', [
            'is_unique' => 'Member telah terdaftar'
        ]);
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'Email telah terdaftar'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[3]', [
            'min_length' => 'Password terlalu pendek'
        ]);
        $this->form_validation->set_rules('jenis', 'Jenis', 'required');
        $this->form_validation->set_rules('naungan', 'Naungan', 'required');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal : Nama atau Email telah terdaftar</div>');
            redirect('superadmin');
        } else {

            //proses menangkap inputan
            $data = [
                'name'               => strtoupper(htmlspecialchars($this->input->post('name', true))),
                'email'              => htmlspecialchars($this->input->post('email', true)),
                'image'              => 'default.jpg',
                'password'           => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'role_id'            => $this->input->post('peran'),
                'kode_naungan'       => $this->input->post('naungan'),
                'kode_penyelenggara' => $this->input->post('jenis')
            ];

            // proses insert databse
            $this->db->insert('user', $data);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Akun ' . $nama . ' Berhasil Dibuat</div>');
            redirect('superadmin');
        }
    }

    public function edit_member()
    {
        $id           = $this->input->post('id');
        $nama         = htmlspecialchars($this->input->post('name', true));
        $nama         = strtoupper($nama);
        $email        = htmlspecialchars($this->input->post('email', true));
        $peran        = $this->input->post('peran');
        $kode_naungan = $this->input->post('naungan');
        $jenis        = $this->input->post('jenis');

        $data_awal = $this->db->where('id', $id)->get('user')->row();

        $nama1         = $data_awal->name;
        $email1        = $data_awal->email;
        $peran1        = $data_awal->role_id;
        $kode_naungan1 = $data_awal->kode_naungan;
        $jenis1        = $data_awal->kode_penyelenggara;

        if ($nama == $nama1 && $email == $email1 && $peran == $peran1 && $kode_naungan == $kode_naungan1 && $jenis == $jenis1) {
            $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Tidak Ada Data Yang Dirubah</div>');
            redirect('superadmin');
        } else {
            $this->load->database();
            $this->db->trans_begin();

            $data = [
                'name'               => $nama,
                'email'              => $email,
                'role_id'            => $peran,
                'kode_naungan'       => $kode_naungan,
                'kode_penyelenggara' => $jenis
            ];

            $data2 = [
                'penyelenggara' => $nama
            ];

            $this->db->where('id', $id);
            $this->db->update('user', $data);

            $this->db->where('id_user', $id);
            $this->db->update('pengajuan', $data2);

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                echo 'gagal input data';
            } else {
                $this->db->trans_commit();
                echo 'berhasil';
            }

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Akun ' . $nama . ' Berhasil Diedit</div>');
            redirect('superadmin');
        }
    }

    public function update_password()
    {
        $id = $this->input->post('id');

        $data_awal = $this->db->where('id', $id)->get('user')->row();
        $nama      = $data_awal->name;

        $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);

        $this->db->set('password', $password);
        $this->db->where('id', $id);
        $this->db->update('user');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password Akun  ' . $nama . '  Telah Diubah</div>');
        redirect('superadmin');
    }

    public function hapus($id)
    {
        $this->load->model('m_penomoran');
        $where = array('id' => $id);

        $data_awal = $this->db->where('id', $id)->get('user')->row();
        $nama      = $data_awal->name;

        $this->m_penomoran->hapus_member($where, 'user');

        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Akun ' . $nama . ' Telah Dihapus</div>');
        redirect('superadmin');
    }

    public function persyaratan()
    {
        $data['title'] = 'PUSDIKLAT UTY';
        $data['aktif'] = 'File Persyaratan';
        $data['user']  = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['file'] = $this->db->get('persyaratan')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('superadmin/persyaratan', $data);
        $this->load->view('templates/footer');
    }

    public function tambah_persyaratan()
    {
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->model('m_penomoran');

        $nama = $this->input->post('name');
        $pengupload = $this->input->post('pengupload');

        $coba = $this->form_validation->set_rules('name', 'Name', 'trim|required|is_unique[persyaratan.persyaratan]', [
            'is_unique' => 'Nama Persyaratan Sudah Ada'
        ]);

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Persyaratan ' . $nama . ' Sudah Ada</div>');
            redirect('superadmin/persyaratan');
        } else {


            if (!empty($_FILES['file']['name'])) {

                $config['upload_path'] = './assets/file/persyaratan/';
                $config['allowed_types'] = 'pdf|xls|xlsx';
                $this->load->library('upload', $config, 'pdf1upload'); // Create custom object for cover upload
                $this->pdf1upload->initialize($config);
                $upload_file = $this->pdf1upload->do_upload('file');
                $desain = $this->pdf1upload->data();
                $data_desain = $desain['file_name'];


                if ($upload_file) {

                    $this->m_penomoran->persyaratan($nama, $data_desain, $pengupload);

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Persyaratan ' . $nama . '  Berhasil Ditambahkan</div>');
                    redirect('superadmin/persyaratan');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Extensi file ' . $data_desain . ' yang diupload tidak sesuai dengan ketentuan</div>');
                    redirect('superadmin/persyaratan');
                }
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data Belum Lengkap</div>');
                redirect('superadmin/persyaratan');
            }
        }
    }

    public function edit_persyaratan()
    {
        $id = $this->input->post('id');

        $data['persyaratan'] = $this->db->get_where('persyaratan', ['id' => $id])->row_array();

        $this->load->model('m_penomoran');

        $p = $data['persyaratan']['nama_file'];

        $nama = $this->input->post('name');
        $pengupload = $this->input->post('pengupload');

        if (!empty($_FILES['file']['name'])) {

            $config['upload_path'] = './assets/file/persyaratan/';
            $config['allowed_types'] = 'pdf|xls|xlsx';
            $this->load->library('upload', $config, 'satu'); // Create custom object for cover upload
            $this->satu->initialize($config);
            $upload_file = $this->satu->do_upload('file');
            $desain = $this->satu->data();
            $data_desain = $desain['file_name'];

            if ($upload_file) {
                unlink(FCPATH . './assets/file/persyaratan/' . $p);

                $data =  array(
                    'persyaratan' => $nama,
                    'nama_file'   => $data_desain,
                    'id_pengupload' => $pengupload
                );

                $where =  array(
                    'id' => $id
                );

                $this->db->where('id', $id);
                $this->db->update('persyaratan', $data);

                // $this->m_penomoran->update_persyaratan($where, $data, 'persyaratan');

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Persyaratan ' . $nama . ' Berhasil Diubah</div>');
                redirect('superadmin/persyaratan');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Extensi file ' . $data_desain . ' yang diupload tidak sesuai dengan ketentuan</div>');
                redirect('superadmin/persyaratan');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data Belum Lengkap</div>');
            redirect('superadmin/persyaratan');
        }
    }

    public function download1($id)
    {
        $data = $this->db->where('id', $id)->get('persyaratan')->row_array();

        force_download(FCPATH . 'assets/file/persyaratan/' . $data['nama_file'], null);
        redirect('superadmin/persyaratan');
    }

    public function hapus_persyaratan($id)
    {
        $this->load->model('m_penomoran');
        $where = array('id' => $id);

        $data['persyaratan'] = $this->db->get_where('persyaratan', ['id' => $id])->row_array();

        $file = $data['persyaratan']['nama_file'];
        $nama = $data['persyaratan']['persyaratan'];

        $this->load->database();
        $this->db->trans_begin();

        unlink(FCPATH . './assets/file/persyaratan/' . $file);
        $this->m_penomoran->hapus_persyaratan($where, 'persyaratan');

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            echo 'gagal hapus data';
        } else {
            $this->db->trans_commit();
            echo 'berhasil hapus data';
        }

        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Persyaratan ' . $nama . ' Telah Dihapus</div>');
        redirect('superadmin/persyaratan');
    }

    public function ketentuan()
    {
        $data['title'] = 'PUSDIKLAT UTY';
        $data['aktif'] = 'Ketentuan Pengajuan';
        $data['user']  = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['ketentuan'] = $this->db->get('ketentuan')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('superadmin/ketentuan', $data);
        $this->load->view('templates/footer');
    }

    public function tambah_ketentuan()
    {
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->model('m_penomoran');

        $pengupload = $this->input->post('pengupload');
        $nama       = $this->input->post('name');

        $this->form_validation->set_rules('name', 'Name', 'trim|required|is_unique[ketentuan.ketentuan]');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Ketentuan ' . $nama . ' Sudah Ada</div>');
            redirect('superadmin/ketentuan');
        } else {
            if (!empty($_FILES['file']['name'])) {

                $nama_file = 'ketentuan';
                $config['upload_path'] = './assets/file/ketentuan/';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['file_name'] = $nama_file;

                $this->load->library('upload', $config, 'pdf1upload'); // Create custom object for cover upload
                $this->pdf1upload->initialize($config);
                $upload_file = $this->pdf1upload->do_upload('file');
                $file = $this->pdf1upload->data();
                $ketentuan = $file['file_name'];

                if ($upload_file) {

                    $this->m_penomoran->ketentuan($nama, $ketentuan, $pengupload);

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Ketentuan ' . $nama . '  Berhasil Ditambahkan</div>');
                    redirect('superadmin/ketentuan');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Extensi file ' . $ketentuan . ' yang diupload tidak sesuai dengan ketentuan</div>');
                    redirect('superadmin/ketentuan');
                }
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data Belum Lengkap</div>');
                redirect('superadmin/ketentuan');
            }
        }
    }

    public function edit_ketentuan()
    {
        $id = $this->input->post('id');

        $data['ketentuan'] = $this->db->get_where('ketentuan', ['id' => $id])->row_array();

        $this->load->model('m_penomoran');

        $p = $data['ketentuan']['nama_file'];

        $nama = $this->input->post('name');
        $pengupload = $this->input->post('pengupload');


        if (!empty($_FILES['file']['name'])) {

            $nama_file = 'ketentuan';
            $config['upload_path'] = './assets/file/ketentuan/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['file_name'] = $nama_file;

            $this->load->library('upload', $config, 'satu'); // Create custom object for cover upload
            $this->satu->initialize($config);
            $upload_file = $this->satu->do_upload('file');
            $file        = $this->satu->data();
            $ketentuan   = $file['file_name'];

            if ($upload_file) {
                unlink(FCPATH . './assets/file/ketentuan/' . $p);

                $data =  array(
                    'ketentuan'     => $nama,
                    'nama_file'     => $ketentuan,
                    'id_pengupload' => $pengupload
                );

                $where =  array(
                    'id' => $id
                );

                $this->db->where('id', $id);
                $this->db->update('ketentuan', $data);

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Ketentuan ' . $nama . ' Berhasil Diubah</div>');
                redirect('superadmin/ketentuan');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Extensi file ' . $ketentuan . ' yang diupload tidak sesuai dengan ketentuan</div>');
                redirect('superadmin/ketentuan');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data Belum Lengkap</div>');
            redirect('superadmin/ketentuan');
        }
    }

    public function download2($id)
    {
        $data = $this->db->where('id', $id)->get('ketentuan')->row_array();

        force_download(FCPATH . 'assets/file/ketentuan/' . $data['nama_file'], null);
        redirect('superadmin/ketentuan');
    }

    public function hapus_ketentuan($id)
    {
        $this->load->model('m_penomoran');
        $where = array('id' => $id);

        $data['ketentuan'] = $this->db->get_where('ketentuan', ['id' => $id])->row_array();

        $file = $data['ketentuan']['nama_file'];
        $nama = $data['ketentuan']['ketentuan'];

        $this->load->database();
        $this->db->trans_begin();

        unlink(FCPATH . './assets/file/ketentuan/' . $file);
        $this->m_penomoran->hapus_ketentuan($where, 'ketentuan');

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            echo 'gagal hapus data';
        } else {
            $this->db->trans_commit();
            echo 'berhasil hapus data';
        }

        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Ketentuan  ' . $nama . ' Telah Dihapus</div>');
        redirect('superadmin/ketentuan');
    }

    public function jenis_penyelenggara()
    {
        $data['title'] = 'PUSDIKLAT UTY';
        $data['aktif'] = 'Jenis Penyelenggara';
        $data['user']  = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['j_penyelenggara'] = $this->db->get('jenis_penyelenggara')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('superadmin/j_penyelenggara', $data);
        $this->load->view('templates/footer');
    }

    public function tambah_jpenyelenggara()
    {
        $nama = $this->input->post('jp');
        $data = ['jenis_penyelenggara' => $this->input->post('jp')];

        $this->db->insert('jenis_penyelenggara', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Jenis Penyelenggara ' . $nama . '  Berhasil Ditambahkan</div>');
        redirect('superadmin/jenis_penyelenggara');
    }

    public function edit_jpenyelenggara()
    {
        $id   = $this->input->post('id');
        $nama = $this->input->post('name', true);

        $data = [
            'jenis_penyelenggara' => $nama
        ];

        $nama1 = $this->db->where('id', $id)->get('jenis_penyelenggara')->row();
        $nama1 = $nama1->jenis_penyelenggara;

        $this->db->where('id', $id);
        $this->db->update('jenis_penyelenggara', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Jenis Penyelenggara ' . $nama1 . ' Berhasil Diedit Menjadi ' . $nama . '</div>');
        redirect('superadmin/jenis_penyelenggara');
    }

    public function hapus_jpenyelenggara($id)
    {
        $this->load->model('m_penomoran');
        $where = array('id' => $id);

        $nama1 = $this->db->where('id', $id)->get('jenis_penyelenggara')->row();
        $nama1 = $nama1->jenis_penyelenggara;

        $this->m_penomoran->hapus_jpenyelenggara($where, 'jenis_penyelenggara');
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Jenis Penyelenggara ' . $nama1 . ' Telah Dihapus</div>');
        redirect('superadmin/jenis_penyelenggara');
    }

    public function jenis_kegiatan()
    {
        $data['title'] = 'PUSDIKLAT UTY';
        $data['aktif'] = 'Jenis Kegiatan';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['j_kegiatan'] = $this->db->get('jenis_kegiatan')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('superadmin/j_kegiatan', $data);
        $this->load->view('templates/footer');
    }

    public function tambah_jkegiatan()
    {
        $nama = $this->input->post('jk');

        $this->form_validation->set_rules('jk', 'jk', 'trim|required|is_unique[jenis_kegiatan.jenis_kegiatan]', [
            'is_unique' => 'Nama Ketentuan Sudah Ada'
        ]);

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Jenis Kegiatan ' . $nama . ' Sudah Ada</div>');
            redirect('superadmin/jenis_kegiatan');
        } else {
            $data = ['jenis_kegiatan' => $this->input->post('jk')];
            $this->db->insert('jenis_kegiatan', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Jenis Kegiatan ' . $nama . ' Berhasil Ditambahkan</div>');
            redirect('superadmin/jenis_kegiatan');
        }
    }

    public function edit_jkegiatan()
    {
        $id   = $this->input->post('id');
        $nama = $this->input->post('name', true);

        $nama1 = $this->db->where('id', $id)->get('jenis_kegiatan')->row();
        $nama1 = $nama1->jenis_kegiatan;

        $this->form_validation->set_rules('name', 'Name', 'trim|required|is_unique[jenis_kegiatan.jenis_kegiatan]', [
            'is_unique' => 'Nama Ketentuan Sudah Ada'
        ]);
        if ($nama == $nama1) {
            $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Tidak Ada Data Yang Dirubah</div>');
            redirect('superadmin/jenis_kegiatan');
        } else if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Jenis Kegiatan ' . $nama . ' Sudah Ada</div>');
            redirect('superadmin/jenis_kegiatan');
        } else {
            $data = [
                'jenis_kegiatan' => $nama
            ];

            $this->db->where('id', $id);
            $this->db->update('jenis_kegiatan', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Jenis Kegiatan ' . $nama1 . ' Berhasil Diedit Menjadi ' . $nama . ' </div>');
            redirect('superadmin/jenis_kegiatan');
        }
    }

    public function hapus_jkegiatan($id)
    {
        $this->load->model('m_penomoran');
        $where = array('id' => $id);

        $nama = $this->db->where($where)->get('jenis_kegiatan')->row();
        $nama = $nama->jenis_kegiatan;

        $this->m_penomoran->hapus_jkegiatan($where, 'jenis_kegiatan');
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Jenis Kegiatan ' . $nama .  ' Telah Dihapus</div>');
        redirect('superadmin/jenis_kegiatan');
    }


    public function naungan()
    {
        $data['title'] = 'PUSDIKLAT UTY';
        $data['aktif'] = 'Naungan';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['naungan'] = $this->db->get('naungan')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('superadmin/naungan', $data);
        $this->load->view('templates/footer');
    }

    public function tambah_naungan()
    {
        $nama = $this->input->post('name');
        $data = [
            'nama_naungan' => $this->input->post('name'),
            'kode' => $this->input->post('kode')
        ];

        $this->db->insert('naungan', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Naungan ' . $nama . ' Berhasil Ditambahkan</div>');
        redirect('superadmin/naungan');
    }

    public function edit_naungan()
    {
        $id           = $this->input->post('id');
        $nama_naungan = $this->input->post('name');
        $kode         = $this->input->post('kode');

        $data = [
            'nama_naungan' => $nama_naungan,
            'kode' => $kode
        ];

        $nama1 = $this->db->where('id', $id)->get('naungan')->row();
        $nama1 = $nama1->nama_naungan;

        $this->db->where('id', $id);
        $this->db->update('naungan', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Naungan ' . $nama1 . ' Berhasil Diedit Menjadi ' . $nama_naungan . '</div>');
        redirect('superadmin/naungan');
    }

    public function hapus_naungan($id)
    {
        $this->load->model('m_penomoran');
        $where = array('id' => $id);

        $nama = $this->db->where($where)->get('naungan')->row();
        $nama = $nama->nama_naungan;

        $this->m_penomoran->hapus_naungan($where, 'naungan');
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Naungan ' . $nama . ' Telah Dihapus</div>');
        redirect('superadmin/naungan');
    }


    public function pihak_ttd()
    {
        $data['title'] = 'PUSDIKLAT UTY';
        $data['aktif'] = 'Pihak Tanda Tangan';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['pihak_ttd'] = $this->db->get('pihak_ttd')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('superadmin/pihak_ttd', $data);
        $this->load->view('templates/footer');
    }

    public function tambah_ttd()
    {
        $nama = $this->input->post('jabatan');

        $data = [
            // 'pihak_ke' => $this->input->post('pihak_ke'),
            'jabatan'  => $this->input->post('jabatan')
        ];

        $this->db->insert('pihak_ttd', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Jabatan ' . $nama . ' Berhasil Ditambahkan</div>');
        redirect('superadmin/pihak_ttd');
    }

    public function edit_ttd()
    {
        $id       = $this->input->post('id');
        $pihak_ke = $this->input->post('pihak_ke');
        $jabatan  = $this->input->post('jabatan');

        $data = [
            // 'pihak_ke' => $pihak_ke,
            'jabatan'  => $jabatan
        ];

        $nama = $this->db->where('id', $id)->get('pihak_ttd')->row();
        $nama = $nama->jabatan;

        $this->db->where('id', $id);
        $this->db->update('pihak_ttd', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pihak Tanda Tangan ' . $nama . ' Berhasil Diedit Menjadi ' . $jabatan . '</div>');
        redirect('superadmin/pihak_ttd');
    }

    public function hapus_ttd($id)
    {
        $this->load->model('m_penomoran');
        $where = array('id' => $id);

        $nama = $this->db->where($where)->get('pihak_ttd')->row();
        $nama = $nama->jabatan;

        $this->m_penomoran->hapus_ttd($where, 'pihak_ttd');
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Pihak Tanda Tangan ' . $nama . ' Telah Dihapus</div>');
        redirect('superadmin/pihak_ttd');
    }

    public function nama_ttd()
    {
        $data['title'] = 'PUSDIKLAT UTY';
        $data['aktif'] = 'Pihak Tanda Tangan';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['pihak_ttd'] = $this->db->get('nama_pihak_ttd')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('superadmin/nama_ttd', $data);
        $this->load->view('templates/footer');
    }

    public function tambah_nama_ttd()
    {
        $nama = $this->input->post('nama');

        $data = [
            // 'pihak_ke' => $this->input->post('pihak_ke'),
            'nama'  => $this->input->post('nama')
        ];

        $this->db->insert('nama_pihak_ttd', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> ' . $nama . ' Berhasil Ditambahkan</div>');
        redirect('superadmin/nama_ttd');
    }

    public function edit_nama_ttd()
    {
        $id       = $this->input->post('id');
        // $pihak_ke = $this->input->post('pihak_ke');
        $nama_awal  = $this->input->post('nama');

        $data = [
            // 'pihak_ke' => $pihak_ke,
            'nama'  => $nama_awal
        ];

        $nama = $this->db->where('id', $id)->get('nama_pihak_ttd')->row();
        $nama = $nama->nama;

        $this->db->where('id', $id);
        $this->db->update('nama_pihak_ttd', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pihak Tanda Tangan ' . $nama . ' Berhasil Diedit Menjadi ' . $nama_awal . '</div>');
        redirect('superadmin/nama_ttd');
    }

    public function hapus_nama_ttd($id)
    {
        $this->load->model('m_penomoran');
        $where = array('id' => $id);

        $nama = $this->db->where($where)->get('nama_pihak_ttd')->row();
        $nama = $nama->nama;

        $this->m_penomoran->hapus_nama_ttd($where, 'nama_pihak_ttd');
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $nama . ' Telah Dihapus</div>');
        redirect('superadmin/nama_ttd');
    }

    public function menu()
    {
        $data['title'] = 'PUSDIKLAT UTY';
        $data['aktif'] = 'Daftar Menu';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['user_menu'] = $this->db->get('user_menu')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('superadmin/menu', $data);
        $this->load->view('templates/footer');
    }

    public function tambah_menu()
    {
        $menu   = $this->input->post('menu');
        $status = 1;

        $data = [
            'menu'   => $this->input->post('menu'),
            'status' => $status
        ];

        $this->db->insert('user_menu', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Menu ' . $menu . ' Berhasil Ditambahkan</div>');
        redirect('superadmin/menu');
    }

    public function edit_menu()
    {
        $id       = $this->input->post('id');
        $menu = $this->input->post('name');

        $data = [
            'id'   => $id,
            'menu' => $menu
        ];

        $nama_menu = $this->db->where('id', $id)->get('user_menu')->row();
        $nama_menu = $nama_menu->menu;

        $this->db->where('id', $id);
        $this->db->update('user_menu', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Menu ' . $nama_menu . ' Berhasil Diedit Menjadi ' . $menu . '</div>');
        redirect('superadmin/menu');
    }

    public function status_menu()
    {
        $id     = $this->input->post('id');
        $status = $this->input->post('status');

        $data = [
            'id'   => $id,
            'status' => $status
        ];

        $status_menu = $this->db->where('id', $id)->get('user_menu')->row();
        $nama_menu   = $status_menu->menu;
        $status_menu = $status_menu->status;

        if ($status_menu == 1) {
            $menu_status = "Non-Aktifkan";
        } else {
            $menu_status = "Aktifkan";
        }

        $this->db->where('id', $id);
        $this->db->update('user_menu', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Menu ' . $nama_menu . ' Berhasil Di' . $menu_status . '</div>');
        redirect('superadmin/menu');
    }

    public function hapus_menu($id)
    {
        $this->load->model('m_penomoran');
        $where = array('id' => $id);

        $menu = $this->db->where($where)->get('user_menu')->row();
        $menu = $menu->menu;

        $this->m_penomoran->hapus_menu($where, 'user_menu');
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Menu ' . $menu . ' Telah Dihapus</div>');
        redirect('superadmin/menu');
    }

    public function hak_akses()
    {
        $data['title'] = 'PUSDIKLAT UTY';
        $data['aktif'] = 'Hak Akses Menu';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $query = "SELECT uam.id as id_akses, role_id, menu_id, ur.role, um.menu, ur.id, um.id
                        FROM user_access_menu uam, user_menu um, user_role ur
                     WHERE um.id = uam.menu_id
                     AND ur.id = uam.role_id";
        $data['hak_akses'] = $this->db->query($query)->result_array();
        $data['user_role'] = $this->db->get('user_role')->result_array();
        $data['user_menu'] = $this->db->get('user_menu')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('superadmin/hak_akses', $data);
        $this->load->view('templates/footer');
    }

    public function tambah_hak_akses()
    {
        $menu   = $this->input->post('menu');

        $data = [
            'role_id' => $this->input->post('role'),
            'menu_id' => $this->input->post('menu')
        ];

        $this->db->insert('user_access_menu', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Hak Akses Berhasil Ditambahkan</div>');
        redirect('superadmin/hak_akses');
    }

    public function edit_hak_akses()
    {
        $id      = $this->input->post('id');
        $role_id = $this->input->post('role');
        $menu_id = $this->input->post('menu');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $this->db->where('id', $id);
        $this->db->update('user_access_menu', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Hak Akses Berhasil Diedit </div>');
        redirect('superadmin/hak_akses');
    }

    public function hapus_hak_akses($id)
    {
        $this->load->model('m_penomoran');
        $where = array('id' => $id);

        $menu = $this->db->where($where)->get('user_access_menu')->row();

        $this->m_penomoran->hapus_hak_akses($where, 'user_access_menu');
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Hak Akses Telah Dihapus</div>');
        redirect('superadmin/hak_akses');
    }

    public function submenu()
    {
        $data['title'] = 'PUSDIKLAT UTY';
        $data['aktif'] = 'Daftar Sub Menu';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $query = "SELECT um.menu AS id_menu, usm.id, menu_id, title, usm.url, icon, usm.status
                    FROM user_sub_menu usm, user_menu um
                    WHERE usm.menu_id = um.id";
        $data['submenu'] = $this->db->query($query)->result_array();
        $data['user_menu'] = $this->db->get('user_menu')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('superadmin/submenu', $data);
        $this->load->view('templates/footer');
    }

    public function status_submenu()
    {
        $id     = $this->input->post('id');
        $status = $this->input->post('status');

        $data = [
            'id'   => $id,
            'status' => $status
        ];

        $status_submenu = $this->db->where('id', $id)->get('user_sub_menu')->row();
        $nama_submenu   = $status_submenu->title;
        $status_submenu = $status_submenu->status;

        if ($status_submenu == 1) {
            $submenu_status = "Non-Aktifkan";
        } else {
            $submenu_status = "Aktifkan";
        }

        $this->db->where('id', $id);
        $this->db->update('user_sub_menu', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Menu ' . $nama_submenu . ' Berhasil Di' . $submenu_status . '</div>');
        redirect('superadmin/submenu');
    }

    public function edit_submenu()
    {
        $id      = $this->input->post('id');
        $menu_id = $this->input->post('menu_id');
        $title   = $this->input->post('title');
        $url     = $this->input->post('url');
        $icon    = $this->input->post('icon');

        $data = [
            'id'   => $id,
            'menu_id' => $menu_id,
            'title' => $title,
            'url' => $url,
            'icon' => $icon
        ];

        $nama_submenu = $this->db->where('id', $id)->get('user_sub_menu')->row();
        $nama_submenu = $nama_submenu->title;

        $this->db->where('id', $id);
        $this->db->update('user_sub_menu', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Menu ' . $nama_submenu . ' Berhasil Diedit Menjadi ' . $title . '</div>');
        redirect('superadmin/submenu');
    }

    public function tambah_submenu()
    {
        $menu_id = $this->input->post('menu_id');
        $title   = $this->input->post('title');
        $url     = $this->input->post('url');
        $icon    = $this->input->post('icon');
        $status  = 1;

        $data = [
            'menu_id' => $menu_id,
            'title'   => $title,
            'url'     => $url,
            'icon'    => $icon,
            'status'  => $status
        ];

        $this->db->insert('user_sub_menu', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Sub Menu ' . $title . ' Berhasil Ditambahkan</div>');
        redirect('superadmin/submenu');
    }

    public function hapus_submenu($id)
    {
        $this->load->model('m_penomoran');
        $where = array('id' => $id);

        $submenu = $this->db->where('id', $id)->get('user_sub_menu')->row();
        $submenu = $submenu->title;

        $this->m_penomoran->hapus_submenu($where, 'user_sub_menu');
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Sub Menu ' . $submenu . ' Telah Dihapus</div>');
        redirect('superadmin/submenu');
    }
}
