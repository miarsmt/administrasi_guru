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
            'guru' => $this->master->getAllGuru()
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('guru/index', $data);
        $this->load->view('templates/footer');
    }

    public function addguru()
    {
        $data = [
            'title' => 'Tambah Data Guru',
            'user'  => $this->admin->sesi()
        ];

        $this->_rulesGuru();

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('guru/add_guru', $data);
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
            'dtguru' => $this->master->getGuruById($nip)
        ];

        $this->_rulesEditGuru();

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('guru/edit_guru', $data);
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
            'guru'      => $this->master->getAllGuru()
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
            $this->load->view('jurusan/index', $data);
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
            $this->load->view('jurusan/edit_jurusan', $data);
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
            $this->load->view('kelas/index', $data);
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
            $this->load->view('kelas/edit_kelas', $data);
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
}
