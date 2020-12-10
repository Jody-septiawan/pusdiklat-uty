<?php
class M_penomoran extends CI_Model
{
    public function tampil_data()
    {
        return $this->db->get('pengajuan');
    }

    public function no_sertifikat()
    {
        return $this->db->get('detail_penerima');
    }

    public function input_data(
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
    ) {
        $data = array(
            'id_user'               => $id_user,
            'penyelenggara'         => $penyelenggara,
            'nama_kegiatan'         => $nama_kegiatan,
            'tanggal_kegiatan'      => $tanggal_kegiatan,
            'pihak_satu'            => $pihak_satu,
            'jabatan_pihak_satu'    => $jabatan_pihak_satu,
            'pihak_dua'             => $pihak_dua,
            'jabatan_pihak_dua'     => $jabatan_pihak_dua,
            'pihak_tiga'            => $pihak_tiga,
            'jabatan_pihak_tiga'    => $jabatan_pihak_tiga,
            'data_penerima'         => $data_penerima,
            'desain'                => $data_desain,
            'scan_formulir'         => $data_formulir,
            'status'                => $status,
            'pesan'                 => $pesan
        );
        $this->db->insert('pengajuan', $data);
        return $this->db->insert_id();
    }

    public function input_data2(
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
    ) {
        $data = array(
            'id_user'               => $id_user,
            'penyelenggara'         => $penyelenggara,
            'nama_kegiatan'         => $nama_kegiatan,
            'tanggal_kegiatan'      => $tanggal_kegiatan,
            'pihak_satu'            => $pihak_satu,
            'jabatan_pihak_satu'    => $jabatan_pihak_satu,
            'pihak_dua'             => $pihak_dua,
            'jabatan_pihak_dua'     => $jabatan_pihak_dua,
            'pihak_tiga'            => $pihak_tiga,
            'jabatan_pihak_tiga'    => $jabatan_pihak_tiga,
            'data_penerima'         => $data_penerima,
            'desain'                => $data_desain,
            'status'                => $status,
            'pesan'                 => $pesan
        );
        $this->db->insert('pengajuan', $data);
        return $this->db->insert_id();
    }

    public function detail_data($id = NULL)
    {
        $query = $this->db->get_where('pengajuan', array('id' => $id))->row();
        return $query;
    }

    public function edit_data($where)
    {
        return $this->db->get_where('pengajuan', $where);
    }

    public function update_data($where, $data)
    {
        $this->db->where($where);
        $this->db->update('pengajuan', $data);
    }

    public function revisi($where, $data)
    {
        $this->db->where($where);
        $this->db->update('pengajuan', $data);
    }

    public function hapus_member($where)
    {
        $this->db->where($where);
        $this->db->delete('user');
    }

    public function hapus_penyelenggara($where)
    {
        $this->db->where($where);
        $this->db->delete('penyelenggara');
    }

    public function hapus_pengajuan($where)
    {
        $this->db->where($where);
        $this->db->delete('pengajuan');
    }

    public function hapus_penerima($where)
    {
        $this->db->where($where);
        $this->db->delete('detail_penerima');
    }

    public function hapus_jpenyelenggara($where)
    {
        $this->db->where($where);
        $this->db->delete('jenis_penyelenggara');
    }

    public function hapus_jkegiatan($where)
    {
        $this->db->where($where);
        $this->db->delete('jenis_kegiatan');
    }

    public function hapus_naungan($where)
    {
        $this->db->where($where);
        $this->db->delete('naungan');
    }

    public function hapus_ttd($where)
    {
        $this->db->where($where);
        $this->db->delete('pihak_ttd');
    }

    public function hapus_nama_ttd($where)
    {
        $this->db->where($where);
        $this->db->delete('nama_pihak_ttd');
    }

    public function detail_penerima($id = NULL)
    {
        $query = $this->db->get_where('detail_penerima', array('id_pengajuan' => $id))->row();
        return $query;
    }

    public function persyaratan(
        $nama,
        $data_desain,
        $pengupload
    ) {
        $data = array(
            'persyaratan' => $nama,
            'nama_file'   => $data_desain,
            'id_pengupload' => $pengupload
        );
        $this->db->insert('persyaratan', $data);
    }

    public function hapus_persyaratan($where)
    {
        $this->db->where($where);
        $this->db->delete('persyaratan');
    }

    public function ketentuan(
        $nama,
        $ketentuan,
        $pengupload
    ) {
        $data = array(
            'ketentuan'     => $nama,
            'nama_file'     => $ketentuan,
            'id_pengupload' => $pengupload
        );
        $this->db->insert('ketentuan', $data);
    }

    public function hapus_ketentuan($where)
    {
        $this->db->where($where);
        $this->db->delete('ketentuan');
    }

    public function hapus_menu($where)
    {
        $this->db->where($where);
        $this->db->delete('user_menu');
    }

    public function hapus_submenu($where)
    {
        $this->db->where($where);
        $this->db->delete('user_sub_menu');
    }

    public function hapus_hak_akses($where)
    {
        $this->db->where($where);
        $this->db->delete('user_access_menu');
    }
}
