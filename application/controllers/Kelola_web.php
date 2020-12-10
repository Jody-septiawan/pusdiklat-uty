<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelola_web extends CI_Controller
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
        redirect('kelola_web/menu');
    }

    public function menu()
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['title'] = 'Menu management';

        $data['menu'] = $this->db->get('user_menu')->result_array();

        $querySubmenu = "SELECT *,m.title as menu_title FROM user_menu m, user_sub_menu sm
                        WHERE m.id = sm.menu_id
                        ORDER BY menu_title ASC";
        $data['submenu'] = $this->db->query($querySubmenu)->result_array();

        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/admin_sidebar');
        $this->load->view('templates/admin_topbar');
        $this->load->view('kelola/menu');
        $this->load->view('templates/admin_footer');
    }

    public function UserActived()
    {
        $id = $this->input->post('id');
        echo json_encode($this->Menu->UpdateActiveById($id));
    }

    public function UserActivedMenu()
    {
        $id = $this->input->post('id');
        echo json_encode($this->Menu->UpdateActiveByIdMenu($id));
    }

    public function addmenu()
    {
        $nama = $this->input->post('nama');

        $menu = $this->db->insert('user_menu', ['title' => $nama]);

        if ($menu) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Tambah menu berhasil  </div>');
            redirect('kelola_web');
        };
    }

    public function deletemenu($id = null)
    {

        $this->db->where('id', $id);
        $menu = $this->db->delete('user_menu');

        if ($menu) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Hapus menu berhasil  </div>');
            redirect('kelola_web');
        };
    }

    public function editmenu($id = null)
    {
        if (!$id) {
            redirect('kelola_web/menu');
        }

        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['title'] = 'Menu management';

        $this->db->where('id', $id);
        $data['menu'] = $this->db->get('user_menu')->row_array();

        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/admin_sidebar');
        $this->load->view('templates/admin_topbar');
        $this->load->view('kelola/editmenu');
        $this->load->view('templates/admin_footer');
    }

    public function proseseditmenu()
    {
        $id = $this->input->post('id');
        $nama = $this->input->post('nama');

        $this->db->where('id', $id);
        $menu = $this->db->update('user_menu', ['title' => $nama]);

        if ($menu) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Edit menu berhasil  </div>');
            redirect('kelola_web');
        }
    }

    public function addsubmenu()
    {
        $menu_id = $this->input->post('menu_id');
        $nama = $this->input->post('nama');
        $icon = $this->input->post('icon');
        $url = $this->input->post('url');
        $status = $this->input->post('status');

        if ($status == null) {
            $status = 1;
        }

        $data = [
            'menu_id' => $menu_id,
            'title' => $nama,
            'icon' => $icon,
            'url' => $url,
            'is_active' => $status
        ];

        $submenu = $this->db->insert('user_sub_menu', $data);

        if ($submenu) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Edit menu berhasil  </div>');
            redirect('kelola_web');
        }
    }

    public function editsubmenu($id = null)
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['title'] = 'Menu management';

        $this->db->where('id', $id);
        $data['submenu'] = $this->db->get('user_sub_menu')->row_array();

        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/admin_sidebar');
        $this->load->view('templates/admin_topbar');
        $this->load->view('kelola/editsubmenu');
        $this->load->view('templates/admin_footer');
    }

    public function proseseditsubmenu()
    {
        $id = $this->input->post('id');
        $menu_id = $this->input->post('menu_id');
        $title = $this->input->post('nama');
        $icon = $this->input->post('icon');
        $url = $this->input->post('url');
        $is_active = $this->input->post('status');

        $data = [
            'menu_id' => $menu_id,
            'title' => $title,
            'icon' => $icon,
            'url' => $url,
            'is_active' => $is_active
        ];

        $this->db->where('id', $id);
        $submenu = $this->db->update('user_sub_menu', $data);

        if ($submenu) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Edit submenu berhasil  </div>');
            redirect('kelola_web');
        }
    }

    public function deletesubmenu($id = null)
    {
        $this->db->where('id', $id);
        $submenu = $this->db->delete('user_sub_menu');

        if ($submenu) {
            redirect('kelola_web');
        }
    }

    public function menuakses()
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['title'] = 'Menu akses';

        $queryAksesMenu = "SELECT am.id, am.role_id,u.username, am.menu_id, m.title
                        FROM user u,user_access_menu am, user_menu m
                        WHERE u.role = am.role_id
                        AND am.menu_id = m.id
                        ORDER BY u.username, m.title ASC";

        $data['menuakses'] = $this->db->query($queryAksesMenu)->result_array();

        $queryRole = "SELECT * FROM user_role";
        $data['datarole'] = $this->db->query($queryRole)->result_array();

        $queryMenu = "SELECT * FROM user_menu";
        $data['datamenu'] = $this->db->query($queryMenu)->result_array();

        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/admin_sidebar');
        $this->load->view('templates/admin_topbar');
        $this->load->view('kelola/menuakses');
        $this->load->view('templates/admin_footer');
    }

    public function addaksesmenu()
    {
        $role_id = $this->input->post('role_id');
        $menu_id = $this->input->post('menu_id');

        $data_user_akses = $this->db->get('user_access_menu')->result_array();
        $pesan = 0;
        foreach ($data_user_akses as $d) :
            if ($d['role_id'] == $role_id) :
                if ($d['menu_id'] == $menu_id) :
                    $pesan = 1;
                endif;
            endif;
        endforeach;

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        if ($pesan == 1) :
            $queryUserMenu = "SELECT am.id, am.role_id,u.username, am.menu_id, m.title
                                FROM user u,user_access_menu am, user_menu m
                                WHERE u.role = am.role_id
                                AND am.menu_id = m.id
                                AND am.role_id = $role_id
                                AND am.menu_id = $menu_id";
            $usermenu = $this->db->query($queryUserMenu)->row_array();
            $username = $usermenu['username'];
            $title = $usermenu['title'];
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Role <b class="text-primary">' . $username . '</b> sudah memiliki akses ke menu <b class="text-primary">' . $title . ' </b></div>');
        else :
            $addmenuakses = $this->db->insert('user_access_menu', $data);
            if ($addmenuakses) :
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Akses berhasil di tambahkan  </div>');
            endif;
        endif;

        redirect('kelola_web/menuakses');
    }

    public function deleteaksesmenu($id = null)
    {
        if ($id) {
            $queryUserMenu = "SELECT am.id, am.role_id,u.username, am.menu_id, m.title
            FROM user u,user_access_menu am, user_menu m
            WHERE u.role = am.role_id
            AND am.menu_id = m.id
            AND am.id = $id";
            $usermenu = $this->db->query($queryUserMenu)->row_array();
            $username = $usermenu['username'];
            $title = $usermenu['title'];

            $this->db->where('id', $id);
            $delete = $this->db->delete('user_access_menu');

            if ($delete) :
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Akses <b class="text-primary">' . $username . '</b> ke <b class="text-primary">' . $title . '</b> berhasil dihapus  </div>');
            else :
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Akses ' . $username . ' ke ' . $title . ' gagal dihapus  </div>');
            endif;
        }
        redirect('kelola_web/menuakses');
    }

    //SERTIFIKASI ==================================
    public function sertifikasi()
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['title'] = 'Sertifikasi';

        $data['sertifikasi'] = $this->db->get('sertifikasi_kat')->result_array();

        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/admin_sidebar');
        $this->load->view('templates/admin_topbar');
        $this->load->view('kelola/sertifikasi');
        $this->load->view('templates/admin_footer');
    }

    public function editsertifikasi($id = null)
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['title'] = 'Sertifikasi';

        $this->db->where('id', $id);
        $data['sertifikasi'] = $this->db->get('sertifikasi_kat')->row_array();

        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/admin_sidebar');
        $this->load->view('templates/admin_topbar');
        $this->load->view('kelola/editsertifikasi');
        $this->load->view('templates/admin_footer');
    }

    public function proseseditsertifikasi()
    {
        $id = $this->input->post('id');
        $nama = $this->input->post('nama');
        $alias = $this->input->post('alias');
        $nilai = $this->input->post('nilai');

        $data = [
            'nama_sertifikasi' => $nama,
            'alias' => $alias,
            'std_nilai' => $nilai
        ];

        $this->db->where('id', $id);
        $edit = $this->db->update('sertifikasi_kat', $data);

        if ($edit) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Edit sertifikasi berhasil </div>');
            redirect('kelola_web/sertifikasi');
        }
    }

    public function addsertifikasi()
    {
        $nama = $this->input->post('nama');
        $ket = $this->input->post('ket');
        $nilai = $this->input->post('nilai');

        $data = [
            'nama_sertifikasi' => $nama,
            'alias' => $ket,
            'std_nilai' => $nilai,
        ];

        $sertifikasi = $this->db->insert('sertifikasi_kat', $data);

        if ($sertifikasi) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Tambah sertifikasi berhasil  </div>');
            redirect('kelola_web/sertifikasi');
        };
    }

    public function deletesertifikasi($id = null)
    {
        $this->db->where('id', $id);
        $submenu = $this->db->delete('sertifikasi_kat');

        if ($submenu) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Hapus sertifikasi berhasil  </div>');
            redirect('kelola_web/sertifikasi');
        }
    }

    //SPESIFIKASI ==================================
    public function spesifikasi()
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['title'] = 'Spesifikasi';

        $query = "SELECT sp.id, sk.alias, sp.spesifikasi FROM spesifikasi sp, sertifikasi_kat sk
                    WHERE sk.id = sp.id_sertifikasi";

        $data['spesifikasi'] = $this->db->query($query)->result_array();

        $data['sertifikasi'] = $this->db->get('sertifikasi_kat')->result_array();

        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/admin_sidebar');
        $this->load->view('templates/admin_topbar');
        $this->load->view('kelola/spesifikasi');
        $this->load->view('templates/admin_footer');
    }

    public function editspesifikasi($id = null)
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['title'] = 'Spesifikasi';

        $data['sertifikasi'] = $this->db->get('sertifikasi_kat')->result_array();

        $this->db->where('id', $id);
        $data['spesifikasi'] = $this->db->get('spesifikasi')->row_array();

        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/admin_sidebar');
        $this->load->view('templates/admin_topbar');
        $this->load->view('kelola/editspesifikasi');
        $this->load->view('templates/admin_footer');
    }

    public function proseseditspesifikasi()
    {
        $id = $this->input->post('id');
        $id_sertifikasi = $this->input->post('id_sertifikasi');
        $spesifikasi = $this->input->post('spesifikasi');

        $data = [
            'id' => $id,
            'id_sertifikasi' => $id_sertifikasi,
            'spesifikasi' => $spesifikasi
        ];

        $this->db->where('id', $id);
        $edit = $this->db->update('spesifikasi', $data);

        if ($edit) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Edit spesifikasi berhasil </div>');
            redirect('kelola_web/spesifikasi');
        }
    }

    public function addspesifikasi()
    {
        $id_sertifikasi = $this->input->post('id_sertifikasi');
        $spesifikasi = $this->input->post('spesifikasi');

        $data = [
            'id_sertifikasi' => $id_sertifikasi,
            'spesifikasi' => $spesifikasi
        ];

        $sertifikasi = $this->db->insert('spesifikasi', $data);

        if ($sertifikasi) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Tambah spesifikasi berhasil  </div>');
            redirect('kelola_web/spesifikasi');
        };
    }

    public function deletespesifikasi($id = null)
    {
        $this->db->where('id', $id);
        $spesifikasi = $this->db->delete('spesifikasi');

        if ($spesifikasi) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Hapus spesifikasi berhasil  </div>');
            redirect('kelola_web/spesifikasi');
        }
    }
    // fakultas
    public function fakultas()
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['title'] = 'Fakultas';

        $data['fakultas'] = $this->db->get('fakultas')->result_array();

        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/admin_sidebar');
        $this->load->view('templates/admin_topbar');
        $this->load->view('kelola/fakultas');
        $this->load->view('templates/admin_footer');
    }

    public function addfakultas()
    {
        $nama = $this->input->post('nama');
        $alias = $this->input->post('alias');

        $data = [
            'nama' => $nama,
            'alias' => $alias
        ];


        $input = $this->db->insert('fakultas', $data);

        if ($input) :
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Tambah fakultas berhasil  </div>');
            redirect('kelola_web/fakultas');
        endif;
    }

    public function editfakultas($id)
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['title'] = 'Fakultas';

        $data['fakultas'] = $this->db->get_where('fakultas', ['id' => $id])->row_array();

        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/admin_sidebar');
        $this->load->view('templates/admin_topbar');
        $this->load->view('kelola/editfakultas');
        $this->load->view('templates/admin_footer');
    }

    public function proseseditfakultas()
    {
        $id = $this->input->post('id');
        $nama = $this->input->post('nama');
        $alias = $this->input->post('alias');

        $data = [
            'nama' => $nama,
            'alias' => $alias
        ];

        $this->db->where('id', $id);
        $edit = $this->db->update('fakultas', $data);

        if ($edit) :
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Ubah fakultas berhasil  </div>');
            redirect('kelola_web/fakultas');
        endif;
    }

    public function deletefakultas($id)
    {

        $this->db->where('id', $id);
        $delete = $this->db->delete('fakultas');

        if ($delete) :
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Delete fakultas berhasil  </div>');
            redirect('kelola_web/fakultas');
        endif;
    }

    // prodi
    public function prodi()
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['title'] = 'Program Studi';

        $data['fakultas'] = $this->db->get('fakultas')->result_array();
        $queryProdi = "SELECT p.*,f.alias from prodi p, fakultas f
                        WHERE f.id = p.id_fakultas
                        ORDER BY p.id_fakultas ASC";
        $data['prodi'] = $this->db->query($queryProdi)->result_array();

        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/admin_sidebar');
        $this->load->view('templates/admin_topbar');
        $this->load->view('kelola/prodi');
        $this->load->view('templates/admin_footer');
    }

    public function addprodi()
    {
        $nama = $this->input->post('nama');
        $akreditas = $this->input->post('akreditas');
        $id_fakultas = $this->input->post('id_fakultas');

        $data = [
            'id_fakultas' => $id_fakultas,
            'nama' => $nama,
            'akreditas' => $akreditas
        ];

        $input = $this->db->insert('prodi', $data);

        if ($input) :
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Tambah prodi berhasil  </div>');
            redirect('kelola_web/prodi');
        endif;
    }

    public function editprodi($id)
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['title'] = 'Program Studi';

        $data['fakultas'] = $this->db->get('fakultas')->result_array();
        $queryProdi = "SELECT p.*,f.alias from prodi p, fakultas f
                        WHERE f.id = p.id_fakultas
                        AND p.id = $id";
        $data['prodi'] = $this->db->query($queryProdi)->row_array();

        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/admin_sidebar');
        $this->load->view('templates/admin_topbar');
        $this->load->view('kelola/editprodi');
        $this->load->view('templates/admin_footer');
    }

    public function proseseditprodi()
    {
        $id = $this->input->post('id');
        $nama = $this->input->post('nama');
        $akreditas = $this->input->post('akreditas');
        $id_fakultas = $this->input->post('id_fakultas');

        $data = [
            'nama' => $nama,
            'akreditas' => $akreditas,
            'id_fakultas' => $id_fakultas
        ];

        $this->db->where('id', $id);
        $edit = $this->db->update('prodi', $data);

        if ($edit) :
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Edit prodi berhasil  </div>');
            redirect('kelola_web/prodi');
        endif;
    }

    public function deleteprodi($id)
    {

        $this->db->where('id', $id);
        $delete = $this->db->delete('prodi');

        if ($delete) :
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Delete program studi berhasil  </div>');
            redirect('kelola_web/prodi');
        endif;
    }

    // Institusi
    public function institusi()
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['title'] = 'Institusi';

        $data['institusi'] = $this->db->get('institusi')->result_array();

        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/admin_sidebar');
        $this->load->view('templates/admin_topbar');
        $this->load->view('kelola/institusi');
        $this->load->view('templates/admin_footer');
    }

    public function addinstitusi()
    {
        $nama = $this->input->post('nama');

        $add = $this->db->insert('institusi', ['nama' => $nama]);

        if ($add) :
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Tambah institusi berhasil  </div>');
            redirect('kelola_web/institusi');
        endif;
    }

    public function deleteinstitusi($id)
    {
        $this->db->where('id', $id);
        $delete = $this->db->delete('institusi');

        if ($delete) :
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Delete institusi berhasil  </div>');
            redirect('kelola_web/institusi');
        endif;
    }

    public function editinstitusi($id = null)
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['title'] = 'Institusi';

        $data['fakultas'] = $this->db->get('fakultas')->result_array();
        $queryInstitusi = "SELECT * from institusi i WHERE i.id = $id";
        $data['institusi'] = $this->db->query($queryInstitusi)->row_array();

        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/admin_sidebar');
        $this->load->view('templates/admin_topbar');
        $this->load->view('kelola/editinstitusi');
        $this->load->view('templates/admin_footer');
    }

    public function proseseditinstitusi()
    {
        $id = $this->input->post('id');
        $nama = $this->input->post('nama');

        $this->db->where('id', $id);
        $edit = $this->db->update('institusi', ['nama' => $nama]);

        if ($edit) :
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Edit institusi berhasil  </div>');
            redirect('kelola_web/institusi');
        endif;
    }

    public function jenis_pendaftar()
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['title'] = 'Jenis Pendaftar';

        $data['pendaftar'] = $this->db->get('jenis_pendaftar')->result_array();

        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/admin_sidebar');
        $this->load->view('templates/admin_topbar');
        $this->load->view('kelola/jenis_pendaftar');
        $this->load->view('templates/admin_footer');
    }

    public function addjenis_pendaftar()
    {
        $nama = $this->input->post('nama');

        $add = $this->db->insert('jenis_pendaftar', ['nama_jenis' => $nama]);

        if ($add) :
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Tambah jenis pendaftar berhasil  </div>');
            redirect('kelola_web/jenis_pendaftar');
        endif;
    }
}
