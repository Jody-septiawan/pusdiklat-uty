<?php

class Method_model extends CI_Model
{
    public function CekMethod($id_sert)
    {
        if ($id_sert == "1") {
            $method = "mos";
        } elseif ($id_sert == "2") {
            $method = "mta";
        } elseif ($id_sert == "3") {
            $method = "mce";
        } elseif ($id_sert == "4") {
            $method = "mtc";
        }

        return $method;
    }
}
