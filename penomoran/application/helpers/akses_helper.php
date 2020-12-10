<?php

function is_logged_in()
{
    $ci = get_instance(); //ganti $this jadi $ci
    if (!$ci->session->userdata('email')) {
        redirect('auth');
    } else {
        $role_id   = $ci->session->userdata('role_id');
        $role_id = intval($role_id);
        $controler = $ci->uri->segment(1);

        if ($controler == 'superadmin' && $role_id == 2) {
            redirect('auth/blocked');
        } elseif ($controler == 'admin' && $role_id == 2) {
            redirect('auth/blocked');
        } elseif ($controler == 'user' && $role_id == 1) {
            redirect('auth/blocked');
        } elseif ($controler == 'superadmin' && $role_id == 1) {
            redirect('auth/blocked');
        } elseif ($controler == 'admin' && $role_id == 3) {
            redirect('auth/blocked');
        } elseif ($controler == 'user' && $role_id == 3) {
            redirect('auth/blocked');
        }

        if ($controler == 'assets') {
            redirect('auth/blocked');
        }
    }
}
