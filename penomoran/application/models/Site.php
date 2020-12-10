<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Site extends CI_Model
{
    private $_batchImport;

    public function setBatchImport($batchImport)
    {
        $this->_batchImport = $batchImport;
    }

    // save data
    public function importData()
    {
        $data = $this->_batchImport;
        $this->db->insert_batch('detail_penerima', $data);
    }
    // get employee list
    public function employeeList()
    {
        $this->db->select(array('e.id', 'e.nama', 'e.no_identitas', 'e.instansi', 'e.keterangan'));
        $this->db->from('detail_penerima as e');
        $query = $this->db->get();
        return $query->result_array();
    }
}
