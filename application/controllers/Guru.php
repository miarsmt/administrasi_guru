<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Guru extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model([
            'Guru_model' => 'guru',
            'Master_model' => 'master'
        ]);
    }

    public function index()
    {
        $data = [
            'title' => 'Agenda Kegiatan',
            'user'  => $this->admin->sesi(),
            'dtkelas' => $this->guru->getListKelas()
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('guru/index', $data);
        $this->load->view('templates/footer');
    }

    public function ampu()
    {
        $data = [
            'title' => 'Daftar Ampu',
            'user'  => $this->admin->sesi(),
            'ampu'  => $this->guru->getListKelas()
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('guru/ampu', $data);
        $this->load->view('templates/footer');
    }

    public function addkomp($id)
    {
        $data = [
            'title'     => 'Add Kompetensi Dasar',
            'user'      => $this->admin->sesi(),
            'kompdasar' => $this->master->getKompdasar($id),
            'mapel'     => $this->master->getMapelById($id)
        ];

        $dmapel    = $this->master->getMapelById($id);

        $this->form_validation->set_rules('kodekd', 'Kode KD', 'required|trim', [
            'required' => '%s tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('namakd', 'Nama KD', 'required|trim', [
            'required' => '%s tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('semester', 'Semester', 'required|trim', [
            'required' => '%s tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('kkm', 'KKM', 'required|trim', [
            'required' => '%s tidak boleh kosong'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('guru/add_komp', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'kodekd'    => $this->input->post('kodekd', true),
                'namakd'    => $this->input->post('namakd', true),
                'semester'  => $this->input->post('semester', true),
                'kkm'       => $this->input->post('kkm', true),
                'kodemapel' => $id,
                'iduser'    => $this->session->userdata('role_id')
            ];

            $this->master->save_komp($data);
            $this->session->set_flashdata('message', 'data kompetensi dasar ' . $dmapel['namamapel'] . ' berhasil ditambah-kan');
            redirect('guru/ampu');
        }
    }
}
