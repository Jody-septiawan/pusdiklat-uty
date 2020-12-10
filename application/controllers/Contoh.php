<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Contoh extends CI_Controller
{
    public function index()
    {
        //ambil data sertifikasi
        $data['sertifikasi'] = $this->db->get('sertifikasi_kat')->result_array();

        //ambil data spesifikasi
        $data['spesifikasi'] = $this->db->get('spesifikasi')->result_array();

        $this->load->view('contoh/index', $data);
    }
}
