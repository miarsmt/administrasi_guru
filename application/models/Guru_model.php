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

    public function kode_absen()
    {
        $this->db->select('RIGHT(tb_absensi.kodeabsen, 2) as kode', FALSE);
        $this->db->from('tb_absensi');
        $this->db->order_by('kodeabsen', 'DESC');
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
        $kodehasil = "ABN" . $kodemax;
        return $kodehasil;
    }

    public function getAgendaByKelas($idkelas, $kdmapel)
    {
        $this->db->select('tb_agenda.*, tb_mapel.namamapel');
        $this->db->from('tb_agenda');
        $this->db->join('tb_mapel', 'tb_mapel.kodemapel = tb_agenda.kodemapel', 'left');
        $this->db->where('tb_agenda.kodekelas', $idkelas);
        $this->db->where('tb_agenda.kodemapel', $kdmapel);
        $this->db->where('tb_agenda.nip', '11147');
        $result = $this->db->get();
        return $result->result_array();
    }

    public function getDataSiswa($kodekls)
    {
        return $this->db->get_where('tb_siswa', ['kodekelas' => $kodekls])->result();
    }

    public function getAgendaById($idagenda)
    {
        return $this->db->get_where('tb_agenda', ['idagenda' => $idagenda])->row_array();
    }

    public function save_absen($data)
    {
        return $this->db->insert_batch('tb_absensi', $data);
    }
}
