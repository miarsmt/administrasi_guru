<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Master extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Master_model', 'master');
    }

    public function guru()
    {
        $data = [
            'title' => 'Modul Guru',
            'user' => $this->admin->sesi(),
            'guru' => $this->master->getGuru()
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('master/guru/index', $data);
        $this->load->view('templates/footer');
    }

    public function addguru()
    {
        $data = [
            'title' => 'Tambah Data Guru',
            'user'  => $this->admin->sesi(),
            'jurusan' => $this->master->getAllJurusan()
        ];

        $this->_rulesGuru();

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('master/guru/add_guru', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'nip'           => $this->input->post('nip', true),
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

            $this->master->save_guru($data);
            $this->session->set_flashdata('message', 'data guru berhasil ditambah-kan');
            redirect('master/guru');
        }
    }

    private function _rulesGuru()
    {
        $this->form_validation->set_rules('nip', 'NIP', 'required|trim|is_unique[tb_guru.nip]', [
            'required' => '%s tidak boleh kosong',
            'is_unique' => '%s sudah terdaftar'
        ]);
        $this->form_validation->set_rules('namaguru', 'Nama guru', 'required|trim', [
            'required' => '%s tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('alamatguru', 'Alamat', 'required|trim|min_length[10]', [
            'required' => '%s tidak boleh kosong',
            'min_length' => '%s minimal 10 karakter'
        ]);
        $this->form_validation->set_rules('tempat', 'Tempat lahir', 'required|trim', [
            'required' => '%s tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('tgl', 'Tanggal lahir', 'required|trim', [
            'required' => '%s tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('notelp', 'No telp seluler', 'required|trim', [
            'required' => '%s tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('emailguru', 'Email', 'required|trim|valid_email', [
            'required' => '%s tidak boleh kosong',
            'valid_email' => '%s tidak sesuai'
        ]);
    }

    public function editguru($nip)
    {
        $data = [
            'title' => 'Edit Data Guru',
            'user'  => $this->admin->sesi(),
            'dtguru' => $this->master->getGuruById($nip),
            'jurusan' => $this->master->getAllJurusan()
        ];

        $this->_rulesEditGuru();

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('master/guru/edit_guru', $data);
            $this->load->view('templates/footer');
        } else {
            $this->master->editDataGuru();
            $this->session->set_flashdata('message', 'data guru berhasil di-rubah!');
            redirect('master/guru');
        }
    }

    private function _rulesEditGuru()
    {
        $this->form_validation->set_rules('namaguru', 'Nama guru', 'required|trim', [
            'required' => '%s tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('alamatguru', 'Alamat', 'required|trim|min_length[10]', [
            'required' => '%s tidak boleh kosong',
            'min_length' => '%s minimal 10 karakter'
        ]);
        $this->form_validation->set_rules('tempat', 'Tempat lahir', 'required|trim', [
            'required' => '%s tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('tgl', 'Tanggal lahir', 'required|trim', [
            'required' => '%s tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('notelp', 'No telp seluler', 'required|trim', [
            'required' => '%s tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('emailguru', 'Email', 'required|trim|valid_email', [
            'required' => '%s tidak boleh kosong',
            'valid_email' => '%s tidak sesuai'
        ]);
    }

    public function deleteguru($nip)
    {
        $this->master->delguru($nip);
        $this->session->set_flashdata('message', 'data guru berhasil di-hapus!');
        redirect('master/guru');
    }

    public function jurusan()
    {
        $data = [
            'title'     => 'Modul Jurusan',
            'user'      => $this->admin->sesi(),
            'jurusan'   => $this->master->getJurusan(),
            'guru'      => $this->master->getGuruProd()
        ];

        $this->form_validation->set_rules('kodejur', 'Kode jurusan', 'required|trim|is_unique[tb_jurusan.kodejurusan]', [
            'required' => '%s tidak boleh kosong',
            'is_unique' => '%s sudah ada dalam database'
        ]);
        $this->form_validation->set_rules('namajur', 'Nama jurusan', 'required|trim', [
            'required' => '%s tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('nip', 'Ketua jurusan', 'required|trim', [
            'required' => '%s tidak boleh kosong'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('master/jurusan/index', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'kodejurusan' => $this->input->post('kodejur', true),
                'namajurusan' => $this->input->post('namajur', true),
                'nip'         => $this->input->post('nip', true),
                'iduser'      => $this->session->userdata('role_id')
            ];

            $this->master->save_jurusan($data);
            $this->session->set_flashdata('message', 'data jurusan berhasil ditambah-kan');
            redirect('master/jurusan');
        }
    }

    public function editjurusan($id)
    {
        $data = [
            'title'     => 'Edit Jurusan',
            'user'      => $this->admin->sesi(),
            'dtjurusan' => $this->master->getJurusanById($id),
            'guru'      => $this->master->getAllGuru()
        ];

        $this->form_validation->set_rules('namajur', 'Nama jurusan', 'required|trim', [
            'required' => '%s tidak boleh kosong'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('master/jurusan/edit_jurusan', $data);
            $this->load->view('templates/footer');
        } else {
            $this->master->update_jurusan();
            $this->session->set_flashdata('message', 'data jurusan berhasil di-rubah');
            redirect('master/jurusan');
        }
    }

    public function deletejurusan($id)
    {
        $this->master->deljurusan($id);
        $this->session->set_flashdata('message', 'data jurusan berhasil di-hapus');
        redirect('master/jurusan');
    }

    public function kelas()
    {
        $data = [
            'title'     => 'Modul Kelas',
            'user'      => $this->admin->sesi(),
            'kelas'     => $this->master->getKelas(),
            'jurusan'   => $this->master->getAllJurusan()
        ];

        $this->form_validation->set_rules('kodekls', 'Kode kelas', 'required|trim|is_unique[tb_kelas.kodekelas]', [
            'required' => '%s tidak boleh kosong',
            'is_unique' => '%s sudah ada dalam database'
        ]);
        $this->form_validation->set_rules('kodejur', 'Kode jurusan', 'required|trim', [
            'required' => '%s tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('namakls', 'Nama kelas', 'required|trim', [
            'required' => '%s tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('kls', 'Kelas', 'required|trim', [
            'required' => '%s tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('angkatan', 'Angkatan', 'required|trim', [
            'required' => '%s tidak boleh kosong'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('master/kelas/index', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'kodekelas' => $this->input->post('kodekls', true),
                'kodejurusan' => $this->input->post('kodejur', true),
                'namakelas' => $this->input->post('namakls', true),
                'kelas'     => $this->input->post('kls', true),
                'angkatankelas' => $this->input->post('angkatan', true),
                'is_active' => $this->input->post('is_active', true),
                'iduser'    => $this->session->userdata('role_id')
            ];

            $this->master->save_kelas($data);
            $this->session->set_flashdata('message', 'data kelas berhasil ditambah-kan');
            redirect('master/kelas');
        }
    }

    public function editkelas($id)
    {
        $data = [
            'title'     => 'Edit Data Kelas',
            'user'      => $this->admin->sesi(),
            'dtkelas'   => $this->master->getKelasById($id),
            'jurusan'   => $this->master->getAllJurusan()
        ];

        $this->form_validation->set_rules('namakls', 'Nama kelas', 'required|trim', [
            'required' => '%s tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('angkatan', 'Angkatan', 'required|trim', [
            'required' => '%s tidak boleh kosong'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('master/kelas/edit_kelas', $data);
            $this->load->view('templates/footer');
        } else {
            $this->master->update_kelas();
            $this->session->set_flashdata('message', 'data kelas berhasil di-rubah');
            redirect('master/kelas');
        }
    }

    public function deletekelas($id)
    {
        $this->master->delkelas($id);
        $this->session->set_flashdata('message', 'data kelas berhasil di-hapus');
        redirect('master/kelas');
    }

    public function siswa()
    {
        $data = [
            'title' => 'Modul Siswa',
            'user' => $this->admin->sesi(),
            'siswa' => $this->master->getSiswa()
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('master/siswa/index', $data);
        $this->load->view('templates/footer');
    }

    public function addsiswa()
    {
        $data = [
            'title' => 'Tambah Data Siswa',
            'user' => $this->admin->sesi(),
            'jurusan' => $this->master->getAllJurusan(),
            'kelas' => $this->master->getKelas()
        ];

        $this->_rulesSiswa();

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('master/siswa/add_siswa', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'nis'       => $this->input->post('nis', true),
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

            $this->master->save_siswa($data);
            $this->session->set_flashdata('message', 'data siswa berhasil ditambah-kan');
            redirect('master/siswa');
        }
    }

    private function _rulesSiswa()
    {
        $this->form_validation->set_rules('nis', 'Nomor induk siswa', 'required|trim|is_unique[tb_siswa.nis]|min_length[6]', [
            'required' => '%s tidak boleh kosong',
            'is_unique' => '%s sudah ada dalam database',
            'min_length' => '$s minimal 6 karakter'
        ]);
        $this->form_validation->set_rules('namasiswa', 'Nama siswa', 'required|trim', [
            'required' => '%s tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('nisn', 'NISN', 'required|trim|min_length[7]', [
            'required' => '%s tidak boleh kosong',
            'min_length' => '$s minimal 7 karakter'
        ]);
        $this->form_validation->set_rules('jenkel', 'Jenis kelamin', 'required|trim', [
            'required' => '%s tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('tempat', 'Tempat lahir', 'required|trim', [
            'required' => '%s tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('tgl', 'Tanggal lahir', 'required|trim', [
            'required' => '%s tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim', [
            'required' => '%s tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('notelp', 'No telp seluler', 'required|trim', [
            'required' => '%s tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('email', 'Email siswa', 'required|trim|valid_email', [
            'required' => '%s tidak boleh kosong',
            'valid_email' => '%s harus valid'
        ]);
        $this->form_validation->set_rules('asal', 'Asal sekolah', 'required|trim', [
            'required' => '%s tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('tgmasuk', 'Tanggal masuk', 'required|trim', [
            'required' => '%s tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('ayah', 'Nama ayah', 'required|trim', [
            'required' => '%s tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('ibu', 'Nama ibu', 'required|trim', [
            'required' => '%s tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('kodekls', 'Kode kelas', 'required|trim', [
            'required' => '%s tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('kodejur', 'Kode jurusan', 'required|trim', [
            'required' => '%s tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('semester', 'Semester', 'required|trim', [
            'required' => '%s tidak boleh kosong',
        ]);
    }

    public function editsiswa($id)
    {
        $data = [
            'title' => 'Edit Data Siswa',
            'user' => $this->admin->sesi(),
            'dtsiswa' => $this->master->getSiswaById($id),
            'jurusan' => $this->master->getAllJurusan(),
            'kelas' => $this->master->getKelas()
        ];

        $this->_rulesEditSiswa();

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('master/siswa/edit_siswa', $data);
            $this->load->view('templates/footer');
        } else {
            $this->master->update_siswa();
            $this->session->set_flashdata('message', 'data siswa berhasil di-rubah');
            redirect('master/siswa');
        }
    }

    public function _rulesEditSiswa()
    {
        $this->form_validation->set_rules('namasiswa', 'Nama siswa', 'required|trim', [
            'required' => '%s tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('nisn', 'NISN', 'required|trim|min_length[7]', [
            'required' => '%s tidak boleh kosong',
            'min_length' => '$s minimal 7 karakter'
        ]);
        $this->form_validation->set_rules('tempat', 'Tempat lahir', 'required|trim', [
            'required' => '%s tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('tgl', 'Tanggal lahir', 'required|trim', [
            'required' => '%s tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim', [
            'required' => '%s tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('notelp', 'No telp seluler', 'required|trim', [
            'required' => '%s tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('email', 'Email siswa', 'required|trim|valid_email', [
            'required' => '%s tidak boleh kosong',
            'valid_email' => '%s harus valid'
        ]);
        $this->form_validation->set_rules('asal', 'Asal sekolah', 'required|trim', [
            'required' => '%s tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('tgmasuk', 'Tanggal masuk', 'required|trim', [
            'required' => '%s tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('ayah', 'Nama ayah', 'required|trim', [
            'required' => '%s tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('ibu', 'Nama ibu', 'required|trim', [
            'required' => '%s tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('semester', 'Semester', 'required|trim', [
            'required' => '%s tidak boleh kosong',
        ]);
    }

    public function deletesiswa($id)
    {
        $this->master->delsiswa($id);
        $this->session->set_flashdata('message', 'data siswa berhasil di-hapus');
        redirect('master/siswa');
    }

    public function mapel()
    {
        $data = [
            'title'     => 'Modul Mata Pelajaran',
            'user'      => $this->admin->sesi(),
            'mapel'     => $this->master->getMapel(),
            'kodemp'    => $this->master->kode_mp(),
            'jrsn'      => $this->master->getAllJurusan()
        ];

        $this->form_validation->set_rules('namamp', 'Nama mapel', 'required|trim', [
            'required' => '%s tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('tingkatan', 'Tingkatan', 'required|trim', [
            'required' => '%s tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('kelompok', 'Kelompok mapel', 'required|trim', [
            'required' => '%s tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('kodejur', 'Jurusan', 'required|trim', [
            'required' => '%s tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('kkm', 'KKM', 'required|trim', [
            'required' => '%s tidak boleh kosong'
        ]);
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('master/mapel/index', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'kodemapel'     => $this->input->post('kodemp', true),
                'namamapel'     => $this->input->post('namamp', true),
                'tingkatan'     => $this->input->post('tingkatan', true),
                'kelompok'      => $this->input->post('kelompok', true),
                'kodejurusan'   => $this->input->post('kodejur', true),
                'kkm'           => $this->input->post('kkm', true),
                'iduser'        => $this->session->userdata('role_id')
            ];

            $this->master->save_mapel($data);
            $this->session->set_flashdata('message', 'data mapel berhasil ditambah-kan');
            redirect('master/mapel');
        }
    }

    public function editmapel($id)
    {
        $data = [
            'title'     => 'Edit Data Mapel',
            'user'      => $this->admin->sesi(),
            'dtmapel'   => $this->master->getMapelById($id),
            'jurusan'   => $this->master->getAllJurusan()
        ];

        $this->form_validation->set_rules('namamp', 'Nama mapel', 'required|trim', [
            'required' => '%s tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('tingkatan', 'Tingkatan', 'required|trim', [
            'required' => '%s tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('kelompok', 'Kelompok mapel', 'required|trim', [
            'required' => '%s tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('kkm', 'KKM', 'required|trim', [
            'required' => '%s tidak boleh kosong'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('master/mapel/edit_mapel', $data);
            $this->load->view('templates/footer');
        } else {
            $this->master->update_mapel();
            $this->session->set_flashdata('message', 'data mapel berhasil di-rubah');
            redirect('master/mapel');
        }
    }

    public function deletemapel($id)
    {
        $this->master->delmapel($id);
        $this->session->set_flashdata('message', 'data mapel berhasil di-hapus');
        redirect('master/mapel');
    }

    public function mengajar()
    {
        $data = [
            'title'     => 'Modul Mengajar',
            'user'      => $this->admin->sesi(),
            'ajar'      => $this->master->getAjar(),
            'mapel'     => $this->master->getMapel(),
            'guru'      => $this->master->getAllGuru(),
            'kelas'     => $this->master->getKelas()
        ];

        $this->form_validation->set_rules('smstr', 'Semester', 'required|trim', [
            'required' => '%s tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('periode', 'Periode mengajar', 'required|trim', [
            'required' => '%s tidak boleh kosong'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('master/mengajar/index', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'kodemapel' => $this->input->post('kodemapel', true),
                'nip'       => $this->input->post('nip', true),
                'semester'  => $this->input->post('smstr', true),
                'kodekelas' => $this->input->post('kodekls', true),
                'periode_mengajar' => $this->input->post('periode', true)
            ];

            $this->master->save_mengajar($data);
            $this->session->set_flashdata('message', 'data mengajar berhasil ditambah-kan');
            redirect('master/mengajar');
        }
    }

    public function editajar($id)
    {
        $data = [
            'title'     => 'Edit Data Mengajar',
            'user'      => $this->admin->sesi(),
            'dtajar'    => $this->master->getAjarById($id),
            'mapel'     => $this->master->getMapel(),
            'guru'      => $this->master->getAllGuru(),
            'kelas'     => $this->master->getKelas()
        ];

        $this->form_validation->set_rules('smstr', 'Semester', 'required|trim', [
            'required' => '%s tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('periode', 'Periode mengajar', 'required|trim', [
            'required' => '%s tidak boleh kosong'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('master/mengajar/edit_mengajar', $data);
            $this->load->view('templates/footer');
        } else {
            $this->master->update_ajar();
            $this->session->set_flashdata('message', 'data mengajar berhasil di-rubah');
            redirect('master/mengajar');
        }
    }

    public function deleteajar($id)
    {
        $this->master->delajar($id);
        $this->session->set_flashdata('message', 'data mengajar berhasil di-hapus');
        redirect('master/mengajar');
    }
}
