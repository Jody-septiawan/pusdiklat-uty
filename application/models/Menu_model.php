<?php

class Menu_model extends CI_Model
{
    public function UpdateActiveById($id)
    {
        $this->db->where('id', $id);
        $result = $this->db->get('user_sub_menu')->result();
        if ($result[0]->is_active == 1) {
            $this->db->where('id', $id);
            $this->db->update('user_sub_menu', ['is_active' => 0]);
        } else {
            $this->db->where('id', $id);
            $this->db->update('user_sub_menu', ['is_active' => 1]);
        }
        return $result;
    }

    public function UpdateActiveByIdMenu($id)
    {
        $this->db->where('id', $id);
        $result = $this->db->get('user_menu')->result();
        if ($result[0]->is_active == 1) {
            $this->db->where('id', $id);
            $this->db->update('user_menu', ['is_active' => 0]);
        } else {
            $this->db->where('id', $id);
            $this->db->update('user_menu', ['is_active' => 1]);
        }
        return $result;
    }
}
