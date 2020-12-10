<?php

class Tgl_model extends CI_Model
{
    public function tglSekarang()
    {
        date_default_timezone_set('Asia/Jakarta');

        $hari = array(
            1 =>    'Senin',
            'Selasa',
            'Rabu',
            'Kamis',
            'Jumat',
            'Sabtu',
            'Minggu'
        );

        $tgl = date('d-m-Y  H:i', time());

        return $hari[date('N')] . ", " . $tgl;
    }

    public function tigabulanan()
    {
        return 7972024;
    }
}
