<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Guru_model extends CI_Model
{
    public function getMapel()
    {
        $this->db->select('tb_mapel.*, tb_jurusan.namajurusan');
        $this->db->from('tb_mapel');
        $this->db->join('tb_jurusan', 'tb_jurusan.kodejurusan = tb_mapel.kodejurusan', 'left');
        $result = $this->db->get();
        return $result->result_array();
    }

    public function kode_mp()
    {
        $this->db->select('RIGHT(tb_mapel.kodemapel, 2) as kode', FALSE);
        $this->db->from('tb_mapel');
        $this->db->order_by('kodemapel', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('');      //cek dulu apakah ada sudah ada kode di tabel.    
        if ($query->num_rows() <> 0) {
            //jika kode ternyata sudah ada.      
            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            //jika kode belum ada      
            $kode = 1;
        }
        $kodemax = str_pad($kode, 3, "0", STR_PAD_LEFT); // angka 3 menunjukkan jumlah digit angka 0
        $kodehasil = "MP" . $kodemax;
        return $kodehasil;
    }

    public function save_mapel($data)
    {
        $this->db->insert('tb_mapel', $data);
        return true;
    }

    public function getMapelById($id)
    {
        return $this->db->get_where('tb_mapel', ['kodemapel' => $id])->row_array();
    }

    public function update_mapel()
    {
        $data = [
            'namamapel'     => $this->input->post('namamp', true),
            'tingkatan'     => $this->input->post('tingkatan', true),
            'kelompok'      => $this->input->post('kelompok', true),
            'kodejurusan'   => $this->input->post('kodejur', true),
            'kkm'           => $this->input->post('kkm', true),
            'iduser'        => $this->session->userdata('role_id')
        ];

        $this->db->where('kodemapel', $this->input->post('kode'));
        $this->db->update('tb_mapel', $data);
        return true;
    }

    public function delmapel($id)
    {
        $this->db->delete('tb_mapel', ['kodemapel' => $id]);
        return true;
    }

    public function save_komp($data)
    {
        $this->db->insert('tb_kompdasar', $data);
        return true;
    }

    public function getKompdasar($id)
    {
        $this->db->select('*');
        $this->db->from('tb_kompdasar');
        $this->db->where('kodemapel', $id);
        $result = $this->db->get();
        return $result->result_array();
    }
}
