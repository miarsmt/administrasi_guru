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

    public function getGuruById($id)
    {
        return $this->db->get_where('tb_guru', ['id' => $id])->row_array();
    }

    public function editDataGuru()
    {
        $data = [
            'nip'           => $this->input->post('nip'),
            'namaguru'     => $this->input->post('namaguru'),
            'jeniskelamin'  => $this->input->post('jenkel'),
            'tempatlahir'   => $this->input->post('tempat'),
            'tgllahir'      => $this->input->post('tgl'),
            'alamatguru'   => $this->input->post('alamatguru'),
            'notelpseluler' => $this->input->post('notelp'),
            'emailguru'    => $this->input->post('emailguru'),
            'kodejurusan'   => $this->input->post('kodejurusan'),
            'iduser'        => $this->session->userdata('role_id'),
            'is_active'     => $this->input->post('is_active')
        ];

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('tb_guru', $data);
        return true;
    }

    public function delguru($id)
    {
        $this->db->delete('tb_guru', ['id' => $id]);
        return true;
    }
}
