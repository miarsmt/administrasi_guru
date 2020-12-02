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

            $this->master->save_guru($data);
            $this->session->set_flashdata('message', 'data guru berhasil ditambah-kan');
            redirect('master/guru');
        }
    }

    private function _rulesGuru()
    {
        $this->form_validation->set_rules('nip', 'NIP', 'required|trim|is_unique[tb_guru.nip]', [
            'required' => '%s tidak boleh kosong',
            'is_unique' => '%s sudah terdaftar sebelum-nya'
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

    public function editguru($id)
    {
        $data = [
            'title' => 'Edit Data Guru',
            'user'  => $this->admin->sesi(),
            'dtguru' => $this->master->getGuruById($id)
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

    public function deleteguru($id)
    {
        $this->master->delguru($id);
        $this->session->set_flashdata('message', 'data guru berhasil di-hapus!');
        redirect('master/guru');
    }
}
