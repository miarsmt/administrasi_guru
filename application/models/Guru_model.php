<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Guru_model extends CI_Model
{
    public function getListKelas()
    {
        $this->db->select('tb_kelas.kelas, tb_kelas.namakelas, tb_mapel.namamapel, tb_mengajar.kodekelas, tb_mengajar.kodemapel, tb_mengajar.semester, tb_mengajar.periode_mengajar');
        $this->db->from('tb_mengajar');
        $this->db->join('tb_kelas', 'tb_kelas.kodekelas = tb_mengajar.kodekelas', 'left');
        $this->db->join('tb_mapel', 'tb_mapel.kodemapel = tb_mengajar.kodemapel', 'left');
        $this->db->where('tb_mengajar.nip = 11147');
        $result = $this->db->get();
        return $result->result_array();
    }

    public function getListKd($kdmapel)
    {
        $this->db->select('*');
        $this->db->from('tb_kompdasar');
        $this->db->where('kodemapel', $kdmapel);
        $result = $this->db->get();
        return $result->result_array();
    }

    public function getAgenda()
    {
        $this->db->select('tb_agenda.*, tb_kelas.kelas, tb_kelas.namakelas, tb_kompdasar.kodekd, tb_kompdasar.namakd, tb_mapel.namamapel');
        $this->db->from('tb_agenda');
        $this->db->join('tb_kelas', 'tb_kelas.kodekelas = tb_agenda.kodekelas', 'left');
        $this->db->join('tb_mapel', 'tb_mapel.kodemapel = tb_agenda.kodemapel', 'left');
        $this->db->join('tb_kompdasar', 'tb_kompdasar.idkd = tb_agenda.idkd', 'left');
        $result = $this->db->get();
        return $result->result_array();
    }

    public function save_agenda($data)
    {
        $this->db->insert('tb_agenda', $data);
        return true;
    }

    public function delagenda($id)
    {
        $this->db->delete('tb_agenda', ['idagenda' => $id]);
        return true;
    }

    public function save_tugas($data)
    {
        $this->db->insert('tb_tugas', $data);
        return true;
    }
}
