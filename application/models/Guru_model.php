<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Guru_model extends CI_Model
{
    public function getMengajar()
    {
        $this->db->select('tb_kelas.kelas, tb_kelas.namakelas, tb_mapel.namamapel, tb_mengajar.*');
        $this->db->from('tb_mengajar');
        $this->db->join('tb_kelas', 'tb_kelas.kodekelas = tb_mengajar.kodekelas', 'left');
        $this->db->join('tb_mapel', 'tb_mapel.kodemapel = tb_mengajar.kodemapel', 'left');
        $this->db->where('tb_mengajar.nip', $this->session->userdata('namauser'));
        $result = $this->db->get();
        return $result->result_array();
    }

    public function getMengajarById($id)
    {
        $this->db->select('tb_kelas.kelas, tb_kelas.namakelas, tb_mapel.namamapel, tb_mengajar.*');
        $this->db->from('tb_mengajar');
        $this->db->join('tb_kelas', 'tb_kelas.kodekelas = tb_mengajar.kodekelas', 'left');
        $this->db->join('tb_mapel', 'tb_mapel.kodemapel = tb_mengajar.kodemapel', 'left');
        $this->db->where('tb_mengajar.idmengajar', $id);
        $result = $this->db->get();
        return $result->row_array();
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
        $this->db->join('tb_mengajar', 'tb_mengajar.idmengajar = tb_agenda.idmengajar', 'left');
        $this->db->join('tb_kelas', 'tb_kelas.kodekelas = tb_mengajar.kodekelas', 'left');
        $this->db->join('tb_mapel', 'tb_mapel.kodemapel = tb_mengajar.kodemapel', 'left');
        $this->db->join('tb_kompdasar', 'tb_kompdasar.idkd = tb_agenda.idkd', 'left');
        $this->db->where('tb_mengajar.nip', $this->session->userdata('namauser'));
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
        $this->db->select('tb_agenda.*, tb_mapel.namamapel, tb_mengajar.kodekelas');
        $this->db->from('tb_agenda');
        $this->db->join('tb_mengajar', 'tb_agenda.idmengajar = tb_mengajar.idmengajar', 'left');
        $this->db->join('tb_mapel', 'tb_mapel.kodemapel = tb_mengajar.kodemapel', 'left');
        $this->db->where('tb_mengajar.kodekelas', $idkelas);
        $this->db->where('tb_mengajar.kodemapel', $kdmapel);
        $this->db->where('tb_mengajar.nip', $this->session->userdata('namauser'));
        // $this->db->where('tb_agenda.status_absen', 0);
        $result = $this->db->get();
        return $result->result_array();
    }

    public function getDataAgenda($nip)
    {
        $this->db->select('tb_agenda.*, tb_kelas.kelas, tb_kelas.namakelas, tb_mapel.namamapel, tb_kompdasar.kodekd, tb_kompdasar.namakd');
        $this->db->from('tb_agenda');
        $this->db->join('tb_mengajar', 'tb_agenda.idmengajar = tb_mengajar.idmengajar', 'left');
        $this->db->join('tb_kelas', 'tb_mengajar.kodekelas = tb_kelas.kodekelas', 'left');
        $this->db->join('tb_mapel', 'tb_mengajar.kodemapel = tb_mapel.kodemapel', 'left');
        $this->db->join('tb_kompdasar', 'tb_agenda.idkd = tb_kompdasar.idkd', 'left');
        $this->db->where('tb_mengajar.nip', $nip);
        $result = $this->db->get();
        return $result->result();
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

    public function delkomp($id)
    {
        $this->db->delete('tb_kompdasar', ['idkd' => $id]);
        $this->db->delete('tb_nilai', ['idkd' => $id]);
        $this->db->delete('tb_nilai_ket', ['idkd' => $id]);
        return true;
    }

    public function getRiwayat()
    {
        $this->db->select('a.*, b.namamapel, c.kelas, c.namakelas');
        $this->db->from('tb_mengajar a');
        $this->db->join('tb_mapel b', 'a.kodemapel = b.kodemapel', 'left');
        $this->db->join('tb_kelas c', 'a.kodekelas = c.kodekelas', 'left');
        $this->db->where('a.nip', $this->session->userdata('namauser'));
        $result = $this->db->get();
        return $result->result_array();
    }

    public function getAbsen($kelas, $tanggal)
    {
        $this->db->select('a.nis, a.namasiswa, b.keterangan');
        $this->db->from('tb_absensi b');
        $this->db->join('tb_siswa a', 'a.nis = b.nis', 'left');
        $this->db->where('a.kodekelas', $kelas);
        $this->db->where('b.tglabsen', $tanggal);
        $hasil = $this->db->get();
        return $hasil->result();
    }

    public function ambilagenda($kode)
    {
        $this->db->select('tb_mengajar.kodemapel, tb_mengajar.idmengajar');
        $this->db->from('tb_mengajar');
        $this->db->join('tb_agenda', 'tb_mengajar.idmengajar = tb_agenda.idmengajar', 'left');
        $this->db->where('tb_agenda.idagenda', $kode);
        $hsl = $this->db->get();
        return $hsl->row_array();
    }

    public function update_agenda($idajar)
    {
        $data = [
            'idmengajar' => $idajar,
            'tanggal'    => $this->input->post('tgl', true),
            'jam_ke'     => $this->input->post('jamke', true),
            'idkd'       => $this->input->post('kompdsr', true),
            'keterangan' => $this->input->post('ket', true)
        ];

        $this->db->where('idagenda', $this->input->post('agenda_id'));
        $this->db->update('tb_agenda', $data);
        return true;
    }
}
