<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Master_model extends CI_Model
{
    public function getAllGuru()
    {
        return $this->db->get('tb_guru')->result_array();
    }

    public function getGuru()
    {
        $this->db->select('tb_guru.*, tb_jurusan.namajurusan');
        $this->db->from('tb_guru');
        $this->db->join('tb_jurusan', 'tb_guru.kodejurusan = tb_jurusan.kodejurusan', 'left');
        $result = $this->db->get();
        return $result->result_array();
    }

    public function getGuruProd()
    {
        $this->db->where('kodejurusan != "-"');
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
            'namaguru'     => $this->input->post('namaguru', true),
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

    public function getAllJurusan()
    {
        return $this->db->get('tb_jurusan')->result_array();
    }

    public function getJurusan()
    {
        $this->db->select('tb_jurusan.*, tb_guru.namaguru');
        $this->db->from('tb_jurusan');
        $this->db->join('tb_guru', 'tb_jurusan.nip = tb_guru.nip', 'left');
        $result = $this->db->get();
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

    public function getKelas()
    {
        $this->db->select('tb_kelas.*, tb_jurusan.namajurusan');
        $this->db->from('tb_kelas');
        $this->db->join('tb_jurusan', 'tb_kelas.kodejurusan = tb_jurusan.kodejurusan', 'left');
        $result = $this->db->get();
        return $result->result_array();
    }

    public function getKelasByTingkatan($Tingkat)
    {
        $this->db->select('tb_kelas.*, tb_jurusan.namajurusan');
        $this->db->from('tb_kelas');
        $this->db->join('tb_jurusan', 'tb_kelas.kodejurusan = tb_jurusan.kodejurusan', 'left');
        $this->db->where('tb_kelas.kelas', $Tingkat);
        $result = $this->db->get();
        return $result->result();
    }

    public function getDataKelas($id)
    {
        $this->db->select('*');
        $this->db->from('tb_kelas');
        $this->db->where('kodejurusan', $id);
        $this->db->order_by('angkatankelas', 'DESC');
        $result = $this->db->get();
        return $result->result();
    }

    public function save_kelas($data)
    {
        $this->db->insert('tb_kelas', $data);
        return true;
    }

    public function getKelasById($id)
    {
        return $this->db->get_where('tb_kelas', ['kodekelas' => $id])->row_array();
    }

    public function update_kelas()
    {
        $data = [
            'kodejurusan' => $this->input->post('kodejur', true),
            'namakelas'   => $this->input->post('namakls', true),
            'kelas'       => $this->input->post('kls', true),
            'angkatankelas' => $this->input->post('angkatan', true),
            'is_active'   => $this->input->post('is_active', true),
            'iduser'      => $this->session->userdata('role_id')
        ];

        $this->db->where('kodekelas', $this->input->post('kode'));
        $this->db->update('tb_kelas', $data);
        return true;
    }

    public function delkelas($id)
    {
        $this->db->delete('tb_kelas', ['kodekelas' => $id]);
        return true;
    }

    public function getSiswa()
    {
        $this->db->select('tb_siswa.*, tb_jurusan.namajurusan, tb_kelas.namakelas, tb_kelas.kelas');
        $this->db->from('tb_siswa');
        $this->db->join('tb_jurusan', 'tb_siswa.kodejurusan = tb_jurusan.kodejurusan', 'left');
        $this->db->join('tb_kelas', 'tb_siswa.kodekelas = tb_kelas.kodekelas', 'left');
        $result = $this->db->get();
        return $result->result_array();
    }

    public function getDataSiswa($Kelas)
    {
        $this->db->select('tb_siswa.*, tb_kelas.kelas, tb_kelas.namakelas');
        $this->db->from('tb_siswa');
        $this->db->join('tb_kelas', 'tb_siswa.kodekelas = tb_kelas.kodekelas', 'left');
        $this->db->where('tb_siswa.kodekelas', $Kelas);
        $result = $this->db->get();
        return $result->result();
    }

    public function save_siswa($data)
    {
        $this->db->insert('tb_siswa', $data);
        return true;
    }

    public function getSiswaById($id)
    {
        return $this->db->get_where('tb_siswa', ['nis' => $id])->row_array();
    }

    public function update_siswa()
    {
        $data = [
            'namasiswa' => $this->input->post('namasiswa', true),
            'nisn'      => $this->input->post('nisn', true),
            'jeniskelamin' => $this->input->post('jenkel', true),
            'tempatlahir'  => $this->input->post('tempat', true),
            'tgllahir'     => $this->input->post('tgl', true),
            'alamatsiswa'  => $this->input->post('alamat', true),
            'notelpseluler' => $this->input->post('notelp', true),
            'emailsiswa'   => $this->input->post('email', true),
            'asalsekolah'  => $this->input->post('asal', true),
            'tglmasuk'     => $this->input->post('tgmasuk', true),
            'nama_ayah'    => $this->input->post('ayah', true),
            'nama_ibu'     => $this->input->post('ibu', true),
            'kodekelas'    => $this->input->post('kodekls', true),
            'kodejurusan'  => $this->input->post('kodejur', true),
            'semester_aktif' => $this->input->post('semester', true),
            'is_active'    => 1,
            'iduser'       => $this->session->userdata('role_id')
        ];

        $this->db->where('nis', $this->input->post('dnis'));
        $this->db->update('tb_siswa', $data);
        return true;
    }

    public function delsiswa($id)
    {
        $this->db->delete('tb_siswa', ['nis' => $id]);
        return true;
    }

    public function getMapel()
    {
        $this->db->select('tb_mapel.*, tb_jurusan.namajurusan, tb_mapel_kelompok.namakelompokmapel');
        $this->db->from('tb_mapel');
        $this->db->join('tb_jurusan', 'tb_jurusan.kodejurusan = tb_mapel.kodejurusan', 'left');
        $this->db->join('tb_mapel_kelompok', 'tb_mapel_kelompok.idkelompokmapel = tb_mapel.idkelompokmapel', 'left');
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
            'idkelompokmapel' => $this->input->post('kelompok', true),
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

    public function getKompdasarP($id)
    {
        $this->db->select('*');
        $this->db->from('tb_kompdasar');
        $this->db->where('kodemapel', $id);
        $this->db->where('jenis', 'P');
        $result = $this->db->get();
        return $result->result_array();
    }

    public function getKompById($id)
    {
        return $this->db->get_where('tb_kompdasar', ['idkd' => $id])->row_array();
    }

    public function getKelompok()
    {
        return $this->db->get('tb_mapel_kelompok')->result_array();
    }

    public function getAjar()
    {
        $this->db->select('tb_mengajar.*, tb_mapel.namamapel, tb_guru.namaguru, tb_kelas.namakelas, tb_kelas.kelas');
        $this->db->from('tb_mengajar');
        $this->db->join('tb_mapel', 'tb_mapel.kodemapel = tb_mengajar.kodemapel', 'left');
        $this->db->join('tb_guru', 'tb_guru.nip = tb_mengajar.nip', 'left');
        $this->db->join('tb_kelas', 'tb_kelas.kodekelas = tb_mengajar.kodekelas', 'left');
        $result = $this->db->get();
        return $result->result_array();
    }

    public function getAmpu($kelas, $semeter)
    {
        $this->db->select('tb_mengajar.*, tb_kelas.kelas, tb_kelas.namakelas, tb_guru.kodeguru, tb_guru.namaguru, tb_mapel.namamapel, tb_mapel.kelompok');
        $this->db->from('tb_mengajar');
        $this->db->join('tb_kelas', 'tb_mengajar.kodekelas = tb_kelas.kodekelas', 'left');
        $this->db->join('tb_mapel', 'tb_mengajar.kodemapel = tb_mapel.kodemapel', 'left');
        $this->db->join('tb_guru', 'tb_mengajar.nip = tb_guru.nip', 'left');
        $this->db->where('tb_kelas.kelas', $kelas);
        $this->db->where('tb_mengajar.semester', $semeter);
        $result = $this->db->get();
        return $result->result();
    }

    public function save_mengajar($data)
    {
        $this->db->insert('tb_mengajar', $data);
        return true;
    }

    public function getAjarById($id)
    {
        return $this->db->get_where('tb_mengajar', ['idmengajar' => $id])->row_array();
    }

    public function update_ajar()
    {
        $data = [
            'kodemapel' => $this->input->post('kodemapel', true),
            'nip'       => $this->input->post('nip', true),
            'semester'  => $this->input->post('smstr', true),
            'kodekelas' => $this->input->post('kodekls', true),
            'periode_mengajar' => $this->input->post('periode', true)
        ];

        $this->db->where('idmengajar', $this->input->post('kode'));
        $this->db->update('tb_mengajar', $data);
        return true;
    }

    public function delajar($id)
    {
        $this->db->delete('tb_mengajar', ['idmengajar' => $id]);
        return true;
    }
}
