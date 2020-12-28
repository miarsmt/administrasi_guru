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
}
