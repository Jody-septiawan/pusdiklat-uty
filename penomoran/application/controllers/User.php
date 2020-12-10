<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'PUSDIKLAT UTY';
        $data['aktif'] = 'Ketentuan Pengajuan';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $nama_file = $this->db->get('ketentuan')->row();
        $data['nama_file'] = $this->db->get('ketentuan')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }

    public function persyaratan()
    {
        $data['title'] = 'PUSDIKLAT UTY';
        $data['aktif'] = 'File Persyaratan';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['persyaratan'] = $this->db->get('persyaratan')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/persyaratan', $data);
        $this->load->view('templates/footer');
    }

    public function download($id)
    {
        $data = $this->db->where('id', $id)->get('persyaratan')->row_array();

        force_download(FCPATH . 'assets/file/persyaratan/' . $data['nama_file'], null);
        redirect('user/persyaratan');
    }

    public function pengajuan()
    {
        $data['title'] = 'PUSDIKLAT UTY';
        $data['aktif'] = 'Ajukan Nomor Sertifikat';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['pihak_ttd']      = $this->db->get('pihak_ttd')->result_array();
        $data['nama_pihak_ttd'] = $this->db->get('nama_pihak_ttd')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/pengajuan', $data);
        $this->load->view('templates/footer');
    }

    public function tambah_pengajuan()
    {
        $data['title'] = 'PUSDIKLAT UTY';
        $data['aktif'] = 'Ajukan Nomor Sertifikat';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->load->model('m_penomoran');

        $kode = $data['user']['kode_penyelenggara'];

        $this->form_validation->set_rules('penyelenggara', 'Penyelenggara', 'required');
        $this->form_validation->set_rules('nama_kegiatan', 'Nama_Kegiatan', 'required');
        $this->form_validation->set_rules('tanggal_kegiatan', 'Tanggal_kegiatan', 'required');
        $this->form_validation->set_rules('pihak_satu', 'Pihak_Satu', 'required');
        $this->form_validation->set_rules('jabatan_pihak_satu', 'Jabatan_Pihak_Satu', 'required');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data Belum Lengkap</div>');
            redirect('user/pengajuan');
        } else {
            $id_user            = $this->input->post('id');
            $penyelenggara      = $this->input->post('penyelenggara');
            $nama_kegiatan      = $this->input->post('nama_kegiatan');
            $tanggal_kegiatan   = $this->input->post('tanggal_kegiatan');
            $pihak_satu         = $this->input->post('pihak_satu');
            $jabatan_pihak_satu = $this->input->post('jabatan_pihak_satu');
            $pihak_dua          = $this->input->post('pihak_dua');
            $jabatan_pihak_dua  = $this->input->post('jabatan_pihak_dua');
            $pihak_tiga         = $this->input->post('pihak_tiga');
            $jabatan_pihak_tiga = $this->input->post('jabatan_pihak_tiga');
            $status             = 1;
            $pesan              = 'sedang diproses';

            $temporary = explode('/', $jabatan_pihak_satu);
            $jabatan_pihak_satu = $temporary[0];
            $id_jabatan_pihak_satu = $temporary[1];

            $temporary = explode('/', $jabatan_pihak_dua);
            $jabatan_pihak_dua = $temporary[0];
            $id_jabatan_pihak_dua = $temporary[1];

            $temporary = explode('/', $jabatan_pihak_tiga);
            $jabatan_pihak_tiga = $temporary[0];
            $id_jabatan_pihak_tiga = $temporary[1];

            if ($kode == 6 || $kode == 5) {

                if (!empty($_FILES['penerima']['name']) && !empty($_FILES['desain']['name']) && !empty($_FILES['scan_formulir']['name'])) {
                    $config['upload_path'] = './assets/file/data_penerima/';
                    $config['allowed_types'] = 'xls|xlsx';
                    $this->load->library('upload', $config, 'excelupload');
                    $this->excelupload->initialize($config);
                    $upload_penerima = $this->excelupload->do_upload('penerima');
                    $penerima        = $this->excelupload->data();
                    $data_penerima   = $penerima['file_name'];

                    $config['upload_path'] = './assets/file/desain/';
                    $config['allowed_types'] = 'png|jpeg|jpg';
                    $this->load->library('upload', $config, 'pdf1upload');
                    $this->pdf1upload->initialize($config);
                    $upload_desain = $this->pdf1upload->do_upload('desain');
                    $desain = $this->pdf1upload->data();
                    $data_desain = $desain['file_name'];

                    $config['upload_path'] = './assets/file/scan_formulir/';
                    $config['allowed_types'] = 'pdf';
                    $this->load->library('upload', $config, 'pdf2upload');
                    $this->pdf2upload->initialize($config);
                    $upload_formulir = $this->pdf2upload->do_upload('scan_formulir');
                    $formulir = $this->pdf2upload->data();
                    $data_formulir = $formulir['file_name'];

                    if ($upload_penerima && $upload_desain && $upload_formulir) {
                        $this->load->database();
                        $this->db->trans_begin();

                        $id =  $this->m_penomoran->input_data(
                            $id_user,
                            $penyelenggara,
                            $nama_kegiatan,
                            $tanggal_kegiatan,
                            $pihak_satu,
                            $jabatan_pihak_satu,
                            $pihak_dua,
                            $jabatan_pihak_dua,
                            $pihak_tiga,
                            $jabatan_pihak_tiga,
                            $data_penerima,
                            $data_desain,
                            $data_formulir,
                            $status,
                            $pesan
                        );

                        $this->konversi($id, $kode);

                        if ($id_jabatan_pihak_tiga != '5') {

                            $detail_1 = array(
                                'id_pengajuan' => $id,
                                'id_pihak_ttd' => $id_jabatan_pihak_satu
                            );

                            $detail_2 = array(
                                'id_pengajuan' => $id,
                                'id_pihak_ttd' => $id_jabatan_pihak_dua
                            );

                            $detail_3 = array(
                                'id_pengajuan' => $id,
                                'id_pihak_ttd' => $id_jabatan_pihak_tiga
                            );

                            $this->db->insert('detail_ttd', $detail_1);
                            $this->db->insert('detail_ttd', $detail_2);
                            $this->db->insert('detail_ttd', $detail_3);
                        } else {
                            $detail_1 = array(
                                'id_pengajuan' => $id,
                                'id_pihak_ttd' => $id_jabatan_pihak_satu
                            );

                            $detail_2 = array(
                                'id_pengajuan' => $id,
                                'id_pihak_ttd' => $id_jabatan_pihak_dua
                            );

                            $this->db->insert('detail_ttd', $detail_1);
                            $this->db->insert('detail_ttd', $detail_2);
                        }

                        $query = "SELECT COUNT(*) FROM detail_penerima WHERE id_pengajuan = $id GROUP BY no_identitas HAVING(COUNT(no_identitas)>1)";

                        $hasil = $this->db->query($query)->result();
                        $hasil = intval($hasil);

                        if ($hasil > 0) {
                            unlink(FCPATH . './assets/file/data_penerima/' . $data_penerima);
                            unlink(FCPATH . './assets/file/desain/' . $data_desain);
                            unlink(FCPATH . './assets/file/scan_formulir/' . $data_formulir);

                            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Gagal : Terdapat data nomor identitas ganda </div>');
                            redirect('user/pengajuan');
                        }

                        if ($this->db->trans_status() === FALSE) {
                            $this->db->trans_rollback();
                            echo 'gagal input data';
                        } else {
                            $this->db->trans_commit();
                            echo 'berhasil';
                        }

                        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Berhasil Diajukan</div>');
                        redirect('user/rekap');
                    } else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Extensi file yang diupload tidak sesuai</div>');
                        redirect('user/pengajuan');
                    }
                } else {
                    if (empty($_FILES['penerima']['name'])) {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data Penerima Belum Ada</div>');
                        redirect('user/pengajuan');
                    }

                    if (empty($_FILES['desain']['name'])) {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data Desain Sertifikat Belum Ada</div>');
                        redirect('user/pengajuan');
                    }

                    if (empty($_FILES['scan_formulir']['name'])) {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data Scan Formulir Belum Ada</div>');
                        redirect('user/pengajuan');
                    }
                }
            } else {
                if (!empty($_FILES['penerima']['name']) && !empty($_FILES['desain']['name'])) {
                    $config['upload_path'] = './assets/file/data_penerima/';
                    $config['allowed_types'] = 'xls|xlsx';
                    $this->load->library('upload', $config, 'excelupload');
                    $this->excelupload->initialize($config);
                    $upload_penerima = $this->excelupload->do_upload('penerima');
                    $penerima        = $this->excelupload->data();
                    $data_penerima   = $penerima['file_name'];

                    $config['upload_path'] = './assets/file/desain/';
                    $config['allowed_types'] = 'jpg|jpeg|png';
                    $this->load->library('upload', $config, 'pdf1upload');
                    $this->pdf1upload->initialize($config);
                    $upload_desain = $this->pdf1upload->do_upload('desain');
                    $desain = $this->pdf1upload->data();
                    $data_desain = $desain['file_name'];

                    if ($upload_penerima && $upload_desain) {
                        $this->load->database();
                        $this->db->trans_begin();

                        $id =  $this->m_penomoran->input_data2(
                            $id_user,
                            $penyelenggara,
                            $nama_kegiatan,
                            $tanggal_kegiatan,
                            $pihak_satu,
                            $jabatan_pihak_satu,
                            $pihak_dua,
                            $jabatan_pihak_dua,
                            $pihak_tiga,
                            $jabatan_pihak_tiga,
                            $data_penerima,
                            $data_desain,
                            $status,
                            $pesan
                        );

                        $this->konversi($id);

                        if ($id_jabatan_pihak_tiga != '5') {

                            $detail_1 = array(
                                'id_pengajuan' => $id,
                                'id_pihak_ttd' => $id_jabatan_pihak_satu
                            );

                            $detail_2 = array(
                                'id_pengajuan' => $id,
                                'id_pihak_ttd' => $id_jabatan_pihak_dua
                            );

                            $detail_3 = array(
                                'id_pengajuan' => $id,
                                'id_pihak_ttd' => $id_jabatan_pihak_tiga
                            );

                            $this->db->insert('detail_ttd', $detail_1);
                            $this->db->insert('detail_ttd', $detail_2);
                            $this->db->insert('detail_ttd', $detail_3);
                        } else {
                            $detail_1 = array(
                                'id_pengajuan' => $id,
                                'id_pihak_ttd' => $id_jabatan_pihak_satu
                            );

                            $detail_2 = array(
                                'id_pengajuan' => $id,
                                'id_pihak_ttd' => $id_jabatan_pihak_dua
                            );

                            $this->db->insert('detail_ttd', $detail_1);
                            $this->db->insert('detail_ttd', $detail_2);
                        }

                        $query = "SELECT COUNT(*) FROM detail_penerima WHERE id_pengajuan = $id GROUP BY no_identitas HAVING(COUNT(no_identitas)>1)";

                        $hasil = $this->db->query($query)->result();
                        $hasil = intval($hasil);

                        if ($hasil > 0) {
                            unlink(FCPATH . './assets/file/data_penerima/' . $data_penerima);
                            unlink(FCPATH . './assets/file/desain/' . $data_desain);

                            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Gagal : Terdapat data nomor identitas ganda </div>');
                            redirect('user/pengajuan');
                        }

                        if ($this->db->trans_status() === FALSE) {
                            $this->db->trans_rollback();
                            echo 'gagal input data';
                        } else {
                            $this->db->trans_commit();
                            echo 'berhasil';
                        }

                        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Berhasil Diajukan</div>');
                        redirect('user/rekap');
                    } else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Extensi file yang diupload tidak sesuai</div>');
                        redirect('user/pengajuan');
                    }
                } else {
                    if (empty($_FILES['penerima']['name'])) {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data Penerima Belum Ada</div>');
                        redirect('user/pengajuan');
                    }

                    if (empty($_FILES['desain']['name'])) {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data Desain Sertifikat Belum Ada</div>');
                        redirect('user/pengajuan');
                    }
                }
            }
        }
    }

    public function konversi($id)
    {
        $this->load->model('site');


        $extension = pathinfo($_FILES['penerima']['name'], PATHINFO_EXTENSION);

        if ($extension == 'csv') {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
        } elseif ($extension == 'xlsx') {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        } else {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
        }
        // file path
        $spreadsheet = $reader->load($_FILES['penerima']['tmp_name']);
        $allDataInSheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

        // array Count
        $arrayCount = count($allDataInSheet);
        $flag = 0;
        $createArray = array('nama', 'no_identitas', 'instansi', 'keterangan');
        $makeArray = array('nama' => 'name', 'no_identitas' => 'no_identitas', 'instansi' => 'instansi', 'keterangan' => 'keterangan');
        $SheetDataKey = array();
        foreach ($allDataInSheet as $dataInSheet) {
            foreach ($dataInSheet as $key => $value) {
                if (in_array(trim($value), $createArray)) {
                    $value = preg_replace('/\s+/', '', $value);
                    $SheetDataKey[trim($value)] = $key;
                }
            }
        }
        $dataDiff = array_diff_key($makeArray, $SheetDataKey);
        if (empty($dataDiff)) {
            $flag = 1;
        }
        // match excel sheet column
        if ($flag == 1) {
            for ($i = 2; $i <= $arrayCount; $i++) {
                $addresses = array();
                $nama = $SheetDataKey['nama'];
                $no_identitas = $SheetDataKey['no_identitas'];
                $instansi = $SheetDataKey['instansi'];
                $keterangan = $SheetDataKey['keterangan'];

                $nama = filter_var(trim($allDataInSheet[$i][$nama]), FILTER_SANITIZE_STRING);
                $no_identitas = filter_var(trim($allDataInSheet[$i][$no_identitas]), FILTER_SANITIZE_STRING);
                $instansi = filter_var(trim($allDataInSheet[$i][$instansi]), FILTER_SANITIZE_EMAIL);
                $keterangan = filter_var(trim($allDataInSheet[$i][$keterangan]), FILTER_SANITIZE_STRING);

                if ($nama != null && $no_identitas != null && $instansi != null && $keterangan != null) {
                    $fetchData[] = array('id_pengajuan' => $id, 'nama' => $nama, 'no_identitas' => $no_identitas, 'instansi' => $instansi, 'keterangan' => $keterangan);
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> terdapat data kosong pada file EXCEL yang diupload</div>');
                    redirect('user/pengajuan');
                }
            }
            $data['dataInfo'] = $fetchData;
            $this->site->setBatchImport($fetchData);
            $this->site->importData();
        } else {
            // echo "Please import correct file, did not match excel sheet column";
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> file EXCEL yang diupload tidak sesuai</div>');
            redirect('user/pengajuan');
        }
    }

    public function rekap()
    {

        $data['title'] = 'PUSDIKLAT UTY';
        $data['aktif'] = 'Rekap Nomor Sertifikat';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['penomoran'] = $this->db->where('id_user', $data['user']['id'])->order_by('id', 'DESC')->get('pengajuan')->result();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/rekap', $data);
        $this->load->view('templates/footer');
    }

    public function detail($id)
    {
        $data['title'] = 'PUSDIKLAT UTY';
        $data['aktif'] = 'Rekap Nomor Sertifikat';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->load->model('m_penomoran');

        $detail = $this->m_penomoran->detail_data($id);
        $data['detail'] = $detail;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/detail', $data);
        $this->load->view('templates/footer');
    }

    public function edit($id)
    {
        $data['title'] = 'PUSDIKLAT UTY';
        $data['aktif'] = 'Rekap Nomor Sertifikat';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->load->model('m_penomoran');

        $where = array('id' => $id);
        $data['pengajuan'] =  $this->m_penomoran->edit_data($where, 'pengajuan')->result();
        $data['pihak_ttd'] = $this->db->get('pihak_ttd')->result_array();
        $data['nama_pihak_ttd'] = $this->db->get('nama_pihak_ttd')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/edit', $data);
        $this->load->view('templates/footer');
    }

    public function update()
    {
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $kode = $data['user']['kode_penyelenggara'];

        $id = $this->input->post('id');

        $this->form_validation->set_rules('penyelenggara', 'Penyelenggara', 'required');
        $this->form_validation->set_rules('nama_kegiatan', 'Nama_Kegiatan', 'required');
        $this->form_validation->set_rules('tanggal_kegiatan', 'Tanggal_kegiatan', 'required');
        $this->form_validation->set_rules('pihak_satu', 'Pihak_Satu', 'required');
        $this->form_validation->set_rules('jabatan_pihak_satu', 'Jabatan_Pihak_Satu', 'required');
        // $this->form_validation->set_rules('pihak_dua', 'Pihak_Dua', 'required');
        // $this->form_validation->set_rules('jabatan_pihak_dua', 'Jabatan_Pihak_Dua', 'required');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data Belum Lengkap</div>');
            redirect('user/edit/' . $id);
        } else {
            $id = $this->input->post('id');

            $data['pengajuan'] = $this->db->get_where('pengajuan', ['id' => $id])->row_array();

            $this->load->model('m_penomoran');

            $p = $data['pengajuan']['data_penerima'];
            $d = $data['pengajuan']['desain'];
            $s = $data['pengajuan']['scan_formulir'];

            $penyelenggara      = $this->input->post('penyelenggara');
            $nama_kegiatan      = $this->input->post('nama_kegiatan');
            $tanggal_kegiatan   = $this->input->post('tanggal_kegiatan');
            $pihak_satu         = $this->input->post('pihak_satu');
            $jabatan_pihak_satu = $this->input->post('jabatan_pihak_satu');
            $pihak_dua          = $this->input->post('pihak_dua');
            $jabatan_pihak_dua  = $this->input->post('jabatan_pihak_dua');
            $pihak_tiga         = $this->input->post('pihak_tiga');
            $jabatan_pihak_tiga = $this->input->post('jabatan_pihak_tiga');
            $status             = 1;
            $pesan              = 'sedang diproses';


            $temporary = explode('/', $jabatan_pihak_satu);
            $jabatan_pihak_satu = $temporary[0];
            $id_jabatan_pihak_satu = $temporary[1];

            $temporary = explode('/', $jabatan_pihak_dua);
            $jabatan_pihak_dua = $temporary[0];
            $id_jabatan_pihak_dua = $temporary[1];

            $temporary = explode('/', $jabatan_pihak_tiga);
            $jabatan_pihak_tiga = $temporary[0];
            $id_jabatan_pihak_tiga = $temporary[1];

            if ($kode == 6 || $kode == 5) {

                if (!empty($_FILES['penerima']['name']) && !empty($_FILES['desain']['name']) && !empty($_FILES['scan_formulir']['name'])) {

                    unlink(FCPATH . './assets/file/data_penerima/' . $p);
                    unlink(FCPATH . './assets/file/desain/' . $d);
                    unlink(FCPATH . './assets/file/scan_formulir/' . $s);

                    $config['upload_path'] = './assets/file/data_penerima/';
                    $config['allowed_types'] = 'xls|xlsx';
                    $this->load->library('upload', $config, 'excelupload'); // Create custom object for cover upload
                    $this->excelupload->initialize($config);
                    $upload_penerima = $this->excelupload->do_upload('penerima');
                    $penerima        = $this->excelupload->data();
                    $data_penerima   = $penerima['file_name'];

                    $config['upload_path'] = './assets/file/desain/';
                    $config['allowed_types'] = 'jpg|png|jpeg';
                    $this->load->library('upload', $config, 'pdf1upload'); // Create custom object for cover upload
                    $this->pdf1upload->initialize($config);
                    $upload_desain = $this->pdf1upload->do_upload('desain');
                    $desain = $this->pdf1upload->data();
                    $data_desain = $desain['file_name'];

                    $config['upload_path'] = './assets/file/scan_formulir/';
                    $config['allowed_types'] = 'pdf';
                    $this->load->library('upload', $config, 'pdf2upload'); // Create custom object for cover upload
                    $this->pdf2upload->initialize($config);
                    $upload_formulir = $this->pdf2upload->do_upload('scan_formulir');
                    $formulir = $this->pdf2upload->data();
                    $data_formulir = $formulir['file_name'];

                    if ($upload_penerima && $upload_desain && $upload_formulir) {

                        $data = array(
                            'penyelenggara'      => $penyelenggara,
                            'nama_kegiatan'      => $nama_kegiatan,
                            'tanggal_kegiatan'   => $tanggal_kegiatan,
                            'pihak_satu'         => $pihak_satu,
                            'jabatan_pihak_satu' => $jabatan_pihak_satu,
                            'pihak_dua'          => $pihak_dua,
                            'jabatan_pihak_dua'  => $jabatan_pihak_dua,
                            'pihak_tiga'         => $pihak_tiga,
                            'jabatan_pihak_tiga' => $jabatan_pihak_tiga,
                            'data_penerima'      => $data_penerima,
                            'desain'             => $data_desain,
                            'scan_formulir'      => $data_formulir,
                            'status'             => $status,
                            'pesan'              => $pesan
                        );

                        $where =  array(
                            'id' => $id
                        );

                        $this->load->database();
                        $this->db->trans_begin();

                        $this->m_penomoran->update_data($where, $data, 'pengajuan');
                        $this->konversi($id);

                        $this->db->where('id_pengajuan', $id)->delete('detail_ttd');

                        if ($id_jabatan_pihak_tiga != '5') {

                            $detail_1 = array(
                                'id_pengajuan' => $id,
                                'id_pihak_ttd' => $id_jabatan_pihak_satu
                            );

                            $detail_2 = array(
                                'id_pengajuan' => $id,
                                'id_pihak_ttd' => $id_jabatan_pihak_dua
                            );

                            $detail_3 = array(
                                'id_pengajuan' => $id,
                                'id_pihak_ttd' => $id_jabatan_pihak_tiga
                            );

                            $this->db->insert('detail_ttd', $detail_1);
                            $this->db->insert('detail_ttd', $detail_2);
                            $this->db->insert('detail_ttd', $detail_3);
                        } else {
                            $detail_1 = array(
                                'id_pengajuan' => $id,
                                'id_pihak_ttd' => $id_jabatan_pihak_satu
                            );

                            $detail_2 = array(
                                'id_pengajuan' => $id,
                                'id_pihak_ttd' => $id_jabatan_pihak_dua
                            );

                            $this->db->insert('detail_ttd', $detail_1);
                            $this->db->insert('detail_ttd', $detail_2);
                        }

                        $query = "SELECT COUNT(*) FROM detail_penerima WHERE id_pengajuan = $id GROUP BY no_identitas HAVING(COUNT(no_identitas)>1)";

                        $hasil = $this->db->query($query)->result();
                        $hasil = intval($hasil);

                        if ($hasil > 0) {
                            unlink(FCPATH . './assets/file/data_penerima/' . $data_penerima);
                            unlink(FCPATH . './assets/file/desain/' . $data_desain);
                            unlink(FCPATH . './assets/file/scan_formulir/' . $data_formulir);

                            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Gagal : Terdapat data nomor identitas ganda </div>');
                            redirect('user/edit/' . $id);
                        }

                        if ($this->db->trans_status() === FALSE) {
                            $this->db->trans_rollback();
                            echo 'gagal input data';
                        } else {
                            $this->db->trans_commit();
                            echo 'berhasil';
                        }

                        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Berhasil Diubah</div>');
                        redirect('user/rekap');
                    } else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Extensi file yang diupload tidak sesuai</div>');
                        redirect('user/edit/' . $id);
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data Belum Lengkap</div>');
                    redirect('user/edit/' . $id);
                }
            } else {
                if (!empty($_FILES['penerima']['name']) && !empty($_FILES['desain']['name'])) {

                    unlink(FCPATH . './assets/file/data_penerima/' . $p);
                    unlink(FCPATH . './assets/file/desain/' . $d);

                    $config['upload_path'] = './assets/file/data_penerima/';
                    $config['allowed_types'] = 'xls|xlsx';
                    $this->load->library('upload', $config, 'excelupload'); // Create custom object for cover upload
                    $this->excelupload->initialize($config);
                    $upload_penerima = $this->excelupload->do_upload('penerima');
                    $penerima        = $this->excelupload->data();
                    $data_penerima   = $penerima['file_name'];

                    $config['upload_path'] = './assets/file/desain/';
                    $config['allowed_types'] = 'jpg|png|jpeg';
                    $this->load->library('upload', $config, 'pdf1upload'); // Create custom object for cover upload
                    $this->pdf1upload->initialize($config);
                    $upload_desain = $this->pdf1upload->do_upload('desain');
                    $desain = $this->pdf1upload->data();
                    $data_desain = $desain['file_name'];

                    if ($upload_penerima && $upload_desain) {

                        $data = array(
                            'penyelenggara'      => $penyelenggara,
                            'nama_kegiatan'      => $nama_kegiatan,
                            'tanggal_kegiatan'   => $tanggal_kegiatan,
                            'pihak_satu'         => $pihak_satu,
                            'jabatan_pihak_satu' => $jabatan_pihak_satu,
                            'pihak_dua'          => $pihak_dua,
                            'jabatan_pihak_dua'  => $jabatan_pihak_dua,
                            'pihak_tiga'         => $pihak_tiga,
                            'jabatan_pihak_tiga' => $jabatan_pihak_tiga,
                            'data_penerima'      => $data_penerima,
                            'desain'             => $data_desain,
                            'status'             => $status,
                            'pesan'              => $pesan
                        );

                        $where =  array(
                            'id' => $id
                        );

                        $this->load->database();
                        $this->db->trans_begin();

                        $this->m_penomoran->update_data($where, $data, 'pengajuan');
                        $this->konversi($id);

                        $this->db->where('id_pengajuan', $id)->delete('detail_ttd');

                        if ($id_jabatan_pihak_tiga != '5') {

                            $detail_1 = array(
                                'id_pengajuan' => $id,
                                'id_pihak_ttd' => $id_jabatan_pihak_satu
                            );

                            $detail_2 = array(
                                'id_pengajuan' => $id,
                                'id_pihak_ttd' => $id_jabatan_pihak_dua
                            );

                            $detail_3 = array(
                                'id_pengajuan' => $id,
                                'id_pihak_ttd' => $id_jabatan_pihak_tiga
                            );

                            $this->db->insert('detail_ttd', $detail_1);
                            $this->db->insert('detail_ttd', $detail_2);
                            $this->db->insert('detail_ttd', $detail_3);
                        } else {
                            $detail_1 = array(
                                'id_pengajuan' => $id,
                                'id_pihak_ttd' => $id_jabatan_pihak_satu
                            );

                            $detail_2 = array(
                                'id_pengajuan' => $id,
                                'id_pihak_ttd' => $id_jabatan_pihak_dua
                            );

                            $this->db->insert('detail_ttd', $detail_1);
                            $this->db->insert('detail_ttd', $detail_2);
                        }

                        $query = "SELECT COUNT(*) FROM detail_penerima WHERE id_pengajuan = $id GROUP BY no_identitas HAVING(COUNT(no_identitas)>1)";

                        $hasil = $this->db->query($query)->result();
                        $hasil = intval($hasil);

                        if ($hasil > 0) {
                            unlink(FCPATH . './assets/file/data_penerima/' . $data_penerima);
                            unlink(FCPATH . './assets/file/desain/' . $data_desain);

                            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Gagal : Terdapat data nomor identitas ganda </div>');
                            redirect('user/edit/' . $id);
                        }

                        if ($this->db->trans_status() === FALSE) {
                            $this->db->trans_rollback();
                            echo 'gagal input data';
                        } else {
                            $this->db->trans_commit();
                            echo 'berhasil';
                        }

                        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Berhasil Diubah</div>');
                        redirect('user/rekap');
                    } else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Extensi file yang diupload tidak sesuai</div>');
                        redirect('user/edit/' . $id);
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data Belum Lengkap</div>');
                    redirect('user/edit/' . $id);
                }
            }
        }
    }

    public function download1($id)
    {
        $data = $this->db->where('id', $id)->get('pengajuan')->row_array();

        force_download(FCPATH . 'assets/file/data_penerima/' . $data['data_penerima'], null);
        redirect('user/detail/' . $id);
    }

    public function download2($id)
    {
        $data = $this->db->where('id', $id)->get('pengajuan')->row_array();

        force_download(FCPATH . 'assets/file/desain/' . $data['desain'], null);
        redirect('user/detail/' . $id);
    }

    public function download3($id)
    {
        $data = $this->db->where('id', $id)->get('pengajuan')->row_array();

        force_download(FCPATH . 'assets/file/scan_formulir/' . $data['scan_formulir'], null);
        redirect('user/detail/' . $id);
    }

    public function hapus($id)
    {
        $this->load->model('m_penomoran');
        $where = array('id' => $id);

        $data['pengajuan'] = $this->db->get_where('pengajuan', ['id' => $id])->row_array();

        $p = $data['pengajuan']['data_penerima'];
        $d = $data['pengajuan']['desain'];
        $s = $data['pengajuan']['scan_formulir'];

        $this->load->database();
        $this->db->trans_begin();

        unlink(FCPATH . './assets/file/data_penerima/' . $p);
        unlink(FCPATH . './assets/file/desain/' . $d);
        unlink(FCPATH . './assets/file/scan_formulir/' . $s);

        $this->m_penomoran->hapus_pengajuan($where, 'pengajuan');
        $this->hapus_penerima($id);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            echo 'gagal hapus data';
        } else {
            $this->db->trans_commit();
            echo 'berhasil';
        }

        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Pengajuan telah dihapus</div>');
        redirect('user/rekap');
    }

    private function hapus_penerima($id)
    {
        $this->load->model('m_penomoran');
        $where = array('id_pengajuan' => $id);

        $this->m_penomoran->hapus_penerima($where, 'detail_penerima');
    }

    public function pengajuan_susulan()
    {
        $this->load->model('m_penomoran');

        $id     = $this->input->post('id');

        $data['pengajuan'] = $this->db->get_where('pengajuan', ['id' => $id])->row_array();

        $p = $data['pengajuan']['data_penerima'];

        $status = 4;
        $pesan  = 'sedang diproses';

        if (!empty($_FILES['penerima']['name'])) {

            unlink(FCPATH . './assets/file/data_penerima/' . $p);

            $config['upload_path']   = './assets/file/data_penerima/';
            $config['allowed_types'] = 'xls|xlsx';
            $this->load->library('upload', $config, 'excelupload'); // Create custom object for cover upload
            $this->excelupload->initialize($config);
            $upload_penerima = $this->excelupload->do_upload('penerima');
            $penerima        = $this->excelupload->data();
            $data_penerima   = $penerima['file_name'];

            if ($upload_penerima) {

                $data = array(
                    'data_penerima'      => $data_penerima,
                    'status'             => $status,
                    'pesan'              => $pesan
                );

                $where =  array(
                    'id' => $id
                );

                $this->load->database();
                $this->db->trans_begin();

                // $this->hapus_penerima($id);
                $this->m_penomoran->update_data($where, $data, 'pengajuan');
                $this->konversi($id);

                $query = "SELECT COUNT(*) FROM detail_penerima WHERE id_pengajuan = $id GROUP BY no_identitas HAVING(COUNT(no_identitas)>1)";

                $hasil = $this->db->query($query)->result();
                $hasil = intval($hasil);

                if ($hasil > 0) {
                    unlink(FCPATH . './assets/file/data_penerima/' . $data_penerima);

                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Gagal : Terdapat data nomor identitas ganda </div>');
                    redirect('user/rekap');
                }

                if ($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback();
                    echo 'gagal input data';
                } else {
                    $this->db->trans_commit();
                    echo 'berhasil';
                }

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Berhasil Diajukan</div>');
                redirect('user/rekap');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Extensi file yang diupload tidak sesuai</div>');
                redirect('user/rekap');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data Belum Lengkap</div>');
            redirect('user/rekap');
        }
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

    public function excel($id)
    {
        $data_penerima = $this->db->where('id_pengajuan', $id)->get('detail_penerima')->result();

        $spreadsheet = new Spreadsheet;

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'No')
            ->setCellValue('B1', 'Nama')
            ->setCellValue('C1', 'No Identitas')
            ->setCellValue('D1', 'Instansi')
            ->setCellValue('E1', 'Keterangan')
            ->setCellValue('F1', 'No Sertifikat');

        $kolom = 2;
        $nomor = 1;
        foreach ($data_penerima as $penerima) {

            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $kolom, $nomor)
                ->setCellValue('B' . $kolom, $penerima->nama)
                ->setCellValue('C' . $kolom, $penerima->no_identitas)
                ->setCellValue('D' . $kolom, $penerima->instansi)
                ->setCellValue('E' . $kolom, $penerima->keterangan)
                ->setCellValue('F' . $kolom, $penerima->no_sertifikat);

            $kolom++;
            $nomor++;
        }

        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Nomor Sertifikat.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

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
            $config['allowed_types'] = 'jpg|png';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $old_image = $data['user']['image'];

                if ($old_image != 'default.jpg') {
                    unlink(FCPATH . './assets/img/profile/' . $old_image);
                }

                $new_image = $this->upload->data('file_name');
                $this->db->set('image', $new_image)->where('email', $email)->update('user');

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Telah Diedit</div>');
                redirect('user/profile');
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

        $data['pesan'] = $this->db->get('pesan')->result();

        $query = "SELECT*FROM user, pesan psn WHERE psn.pengirim = user.id AND 
                    waktu = (SELECT MAX(waktu) FROM pesan WHERE psn.pengirim = pesan.pengirim) 
                    ORDER BY waktu DESC";

        $pesan = $this->db->query($query)->result();

        $data['pesan']    = $pesan;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/pesan', $data);
        $this->load->view('templates/footer');
    }

    public function balas()
    {
        $penerima = 2;
        $pengirim = $this->input->post('pengirim');
        $isi_pesan = $this->input->post('balasan');

        $data = array(
            'pengirim' => $pengirim,
            'penerima'   => $penerima,
            'isi_pesan'  => $isi_pesan
        );

        $this->db->insert('pesan', $data);

        $this->db->set('status', 1)->where('pengirim', $pengirim)->update('pesan');

        redirect('user/pesan');
    }
}
