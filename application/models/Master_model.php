<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Master_model extends CI_Model
{
    public function getAllGuru()
    {
        return $this->db->get('tb_guru')->result_array();
    }

    public function save_guru($data)
    {
        $this->db->insert('tb_guru', $data);
        return true;
    }

    public function getGuruById($nip)
    {
        return $this->db->get_where('tb_guru', ['nip' => $nip])->row_array();
    }

    public function editDataGuru()
    {
        $data = [
            'namaguru'     => $this->input->post('namaguru' . true),
            'jeniskelamin'  => $this->input->post('jenkel', true),
            'tempatlahir'   => $this->input->post('tempat', true),
            'tgllahir'      => $this->input->post('tgl', true),
            'alamatguru'   => $this->input->post('alamatguru', true),
            'notelpseluler' => $this->input->post('notelp', true),
            'emailguru'    => $this->input->post('emailguru', true),
            'kodejurusan'   => $this->input->post('kodejurusan', true),
            'iduser'        => $this->session->userdata('role_id'),
            'is_active'     => $this->input->post('is_active', true)
        ];

        $this->db->where('nip', $this->input->post('idnip'));
        $this->db->update('tb_guru', $data);
        return true;
    }

    public function delguru($nip)
    {
        $this->db->delete('tb_guru', ['nip' => $nip]);
        return true;
    }

    public function getJurusan()
    {
        $this->db->select('tb_jurusan.*, tb_guru.namaguru');
        $this->db->from('tb_jurusan');
        $this->db->join('tb_guru', 'tb_jurusan.nip = tb_guru.nip', 'left');
        $result = $this->db->get('');
        return $result->result_array();
    }

    public function save_jurusan($data)
    {
        $this->db->insert('tb_jurusan', $data);
        return true;
    }

    public function getJurusanById($id)
    {
        return $this->db->get_where('tb_jurusan', ['kodejurusan' => $id])->row_array();
    }

    public function update_jurusan()
    {
        $data = [
            'namajurusan' => $this->input->post('namajur', true),
            'nip'         => $this->input->post('nip', true),
            'iduser'      => $this->session->userdata('role_id')
        ];

        $this->db->where('kodejurusan', $this->input->post('kode'));
        $this->db->update('tb_jurusan', $data);
        return true;
    }

    public function deljurusan($id)
    {
        $this->db->delete('tb_jurusan', ['kodejurusan' => $id]);
        return true;
    }
}
