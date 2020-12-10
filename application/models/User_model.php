<?php

class User_model extends CI_Model
{
    public function CekSession($id)
    {
        if (!$id) {
            return redirect('auth');
        } else {
            return 0;
        }
    }

    // admin
    public function CekRole1_5($id)
    {
        $data_user = $this->db->get_where('user', ['id' => $id])->row_array();
        if ($data_user['role'] >= 1 && $data_user['role'] <= 5) {
            return redirect('admin');
        }
    }

    // member
    public function CekRole6($id)
    {
        $data_user = $this->db->get_where('user', ['id' => $id])->row_array();
        if ($data_user['role'] == 6) {
            return redirect('mbr');
        }
    }

    // proctor
    public function CekRole7_10($id)
    {
        $data_user = $this->db->get_where('user', ['id' => $id])->row_array();
        if ($data_user['role'] >= 7 && $data_user['role'] <= 10) {
            return redirect('ptr');
        }
    }

    // Proctor
    public function CekRole11($id)
    {
        $data_user = $this->db->get_where('user', ['id' => $id])->row_array();
        if ($data_user['role'] == 11) {
            return redirect('admin');
        }
    }


    public function UpdateActiveById($id)
    {
        $this->db->where('id', $id);
        $result = $this->db->get('user')->result();
        if ($result[0]->is_active == 1) {
            $this->db->where('id', $id);
            $this->db->update('user', ['is_active' => 0]);
        } else {
            $this->db->where('id', $id);
            $this->db->update('user', ['is_active' => 1]);
        }
        return $result;
    }

    public function UpdateSidebar()
    {
        $result = $this->db->get_where('company', ['nama' => 'sidebar'])->row_array();

        if ($result['value'] == "1") :
            // $result['value'] = 0;
            $id = $result['id'];
            $this->db->where('id', $id);
            $update = $this->db->update('company', ['value' => 0]);
        else :
            // $result['value'] = 1;
            $id = $result['id'];
            $this->db->where('id', $id);
            $update = $this->db->update('company', ['value' => 1]);
        endif;

        return $result;
    }
}
