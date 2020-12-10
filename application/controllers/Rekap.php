<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rekap extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        require_once APPPATH . 'third_party/dompdf/dompdf_config.inc.php';
        $id = $this->session->userdata('id');
        $this->load->model('User_model', 'User');
        $this->load->model('Rekap_model', 'rekap');
        $this->load->model('Tgl_model', 'tgl');
        $this->User->CekSession($id);
        // $this->User->CekRole1_5($id);
        $this->User->CekRole6($id);
        $this->User->CekRole7_10($id);
        // $this->User->CekRole11($id);
    }

    public function index($tigabulan = null)
    {
        $data['DataResult'] = 1;
        $data['hasilCek'] = [];
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['title'] = 'Laporan';

        $awal = strtotime($this->input->post('sejak'));
        $akhir = strtotime($this->input->post('hingga'));

        if ($awal || $akhir) {
            $akhir += 86340;
            $data['awal'] = $awal;
            $data['akhir'] = $akhir;
            $data['hasilCek'] = $this->rekap->CariDataKelas($awal, $akhir);

            if ($data['hasilCek']) {
                $this->load->view('templates/admin_header', $data);
                $this->load->view('templates/admin_sidebar', $data);
                $this->load->view('templates/admin_topbar', $data);
                $this->load->view('rekap/index', $data);
                $this->load->view('templates/admin_footer', $data);
            } else {
                $data['DataResult'] = 0;
                $this->load->view('templates/admin_header', $data);
                $this->load->view('templates/admin_sidebar', $data);
                $this->load->view('templates/admin_topbar', $data);
                $this->load->view('rekap/index', $data);
                $this->load->view('templates/admin_footer', $data);
            }
        } elseif ($tigabulan == 1) {
            // date_default_timezone_set('Asia/Jakarta');
            $timeNow = time();
            $awal = $timeNow - $this->tgl->tigabulanan();
            $akhir = $timeNow;

            $data['awal'] = $awal;
            $data['akhir'] = $akhir;

            $data['hasilCek'] = $this->rekap->CariDataKelas($awal, $akhir);

            $this->load->view('templates/admin_header', $data);
            $this->load->view('templates/admin_sidebar', $data);
            $this->load->view('templates/admin_topbar', $data);
            $this->load->view('rekap/index', $data);
            $this->load->view('templates/admin_footer', $data);
        } else {
            $this->load->view('templates/admin_header', $data);
            $this->load->view('templates/admin_sidebar', $data);
            $this->load->view('templates/admin_topbar', $data);
            $this->load->view('rekap/index', $data);
            $this->load->view('templates/admin_footer', $data);
        }
    }

    public function detailkelas()
    {
        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['title'] = 'Laporan';

        $id_kelas = $this->input->post('id');
        $data['awal'] = $this->input->post('awal');
        $data['akhir'] = $this->input->post('akhir');

        $this->db->where('id', $id_kelas);
        $data['dataKelas'] = $this->db->get('kelas')->result_array();

        $data['dataSertifikasi'] = $this->rekap->getDetailKelasByIdKelas($id_kelas);

        $queryLulus = "SELECT count(*) as lulus FROM peserta WHERE keterangan = 'Lulus' AND kelas_id = $id_kelas GROUP BY id_sertifikasi";
        $lulus = $this->db->query($queryLulus)->result_array();

        $urut = 0;
        foreach ($lulus as $l) :
            $data['dataSertifikasi'][$urut]['lulus'] = $l['lulus'];
            $urut++;
        endforeach;

        if (empty($lulus)) {
            $urut = 0;
            foreach ($data['dataSertifikasi'] as $ds) :
                $data['dataSertifikasi'][$urut]['lulus'] = 0;
                $urut++;
            endforeach;
        }

        $querySertifikasi = "SELECT p.id_sertifikasi FROM kelas k, peserta p
                                WHERE p.kelas_id = k.id
                                AND k.id = $id_kelas
                                GROUP BY p.id_sertifikasi ASC";

        $data['DetailPeserta'] = $this->db->query($querySertifikasi)->result_array();
        $querySemuaPeserta = "SELECT * FROM peserta p, sertifikasi_kat s 
                                WHERE p.kelas_id = $id_kelas
                                AND p.id_sertifikasi = s.id";
        $data['SemuaPeserta'] = $this->db->query($querySemuaPeserta)->result_array();

        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/admin_sidebar');
        $this->load->view('templates/admin_topbar');
        $this->load->view('rekap/detailkelas');
        $this->load->view('rekap/chart_detail');
        $this->load->view('templates/admin_footer');
    }

    public function detail()
    {
        $id = $this->input->post('id');
        $awal = $this->input->post('awal');
        $akhir = $this->input->post('akhir');
        if (empty($id)) {
            redirect('rekap');
        }

        $data['detail'] = $this->rekap->DataDetail($id, $awal, $akhir);
        $data['detailUser'] = $this->rekap->DataDetailUser($id, $awal, $akhir);

        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['title'] = 'Detail rekap ujian sertifikasi ';
        $data['hasilCek'] = [];
        $data['awal'] = $awal;
        $data['akhir'] = $akhir;

        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/admin_sidebar', $data);
        $this->load->view('templates/admin_topbar', $data);
        $this->load->view('rekap/detail', $data);
        $this->load->view('rekap/chart_detail', $data);
        $this->load->view('templates/admin_footer_rekap', $data);
    }

    public function cetakallpdf($awal = null, $akhir = null)
    {
        $data['awal'] = $awal;
        $data['akhir'] = $akhir;
        $data['kelas'] = $this->rekap->CariDataKelas($awal, $akhir);
        $peserta = $this->db->get('peserta')->result_array();

        //inialisasi jumlah peserta lulus
        $index = 0;
        foreach ($data['kelas'] as $k) :
            $data['kelas'][$index]['lulus'] = 0;
            $index++;
        endforeach;

        //Hitung jumlah peserta yang lulus
        $index = 0;
        foreach ($data['kelas'] as $k) :
            foreach ($peserta as $p) :
                if ($k['id'] == $p['kelas_id']) :
                    if ($p['keterangan'] == "Lulus") :
                        $data['kelas'][$index]['lulus'] += 1;
                    endif;
                endif;
            endforeach;
            $index++;
        endforeach;

        // $this->load->view('rekap/desain', $data);

        $mpdf = new \Mpdf\Mpdf();
        $html = $this->load->view('rekap/desain', $data, TRUE);
        $mpdf = new \Mpdf\Mpdf(['orientation' => 'L']); // 'P' -> Potrait, 'L' -> Landscape
        $mpdf->WriteHTML($html);
        $mpdf->Output('report.pdf', \Mpdf\Output\Destination::INLINE);
    }

    public function cetakpdf($id_kelas = null)
    {
        $query = "SELECT * FROM peserta p, sertifikasi_kat sk WHERE p.id_sertifikasi = sk.id AND  p.kelas_id = $id_kelas";
        $data['peserta'] = $this->db->query($query)->result_array();

        $this->db->where('id', $id_kelas);
        $data['kelas'] = $this->db->get('kelas')->row_array();

        // $this->load->view('rekap/desain2', $data);

        $mpdf = new \Mpdf\Mpdf();
        $html = $this->load->view('rekap/desain2', $data, TRUE);
        $mpdf = new \Mpdf\Mpdf(['orientation' => 'L']); // 'P' -> Potrait, 'L' -> Landscape
        $mpdf->WriteHTML($html);
        $mpdf->Output('report.pdf', \Mpdf\Output\Destination::INLINE);
    }

    public function cetak($id_kelas = null)
    {
        $awal = $this->input->post('awal');
        $akhir = $this->input->post('akhir');
        $data['cetak'] = $this->rekap->CariData($awal, $akhir);
        $data['awal'] = $awal;
        $data['akhir'] = $akhir;
        // $this->load->view('rekap/desain', $data);
        $mpdf = new \Mpdf\Mpdf();
        $html = $this->load->view('rekap/desain', $data, TRUE);
        $mpdf = new \Mpdf\Mpdf(['orientation' => 'Landscape']); // 'P' -> Potrait, 'L' -> Landscape
        $mpdf->WriteHTML($html);
        $mpdf->Output('report.pdf', \Mpdf\Output\Destination::INLINE);
    }

    public function rekap3bulan()
    {
        date_default_timezone_set('Asia/Jakarta');
        $timeNow = time();

        $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['title'] = 'Laporan';

        $data['tigabulan'] =  date('d M Y', $timeNow - $this->tgl->tigabulanan());
        $data['sekarang'] =  date('d M Y', $timeNow);

        $awal = $timeNow - $this->tgl->tigabulanan();
        $akhir = $timeNow;

        $queryKelas = "SELECT k.id, k.nama, k.tanggal, COUNT(k.id) as peserta FROM kelas k, peserta p
                        WHERE k.id = p.kelas_id
                        AND k.tanggal >= $awal
                        AND k.tanggal <= $akhir
                        GROUP BY k.id ASC";
        $data['kelas'] = $this->db->query($queryKelas)->result_array();

        $data['jenis_sertifikasi'] = $this->rekap->CariData($awal, $akhir);

        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/admin_sidebar');
        $this->load->view('templates/admin_topbar');
        $this->load->view('rekap/rekap3bulan');
        $this->load->view('templates/admin_footer');
    }
}
