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

    public function mapel()
    {
        $data = [
            'title'     => 'Modul Mata Pelajaran',
            'user'      => $this->admin->sesi(),
            'mapel'     => $this->guru->getMapel(),
            'kodemp'    => $this->guru->kode_mp(),
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
            $this->load->view('guru/mapel/index', $data);
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

            $this->guru->save_mapel($data);
            $this->session->set_flashdata('message', 'data mapel berhasil ditambah-kan');
            redirect('guru/mapel');
        }
    }

    public function editmapel($id)
    {
        $data = [
            'title'     => 'Edit Data Mapel',
            'user'      => $this->admin->sesi(),
            'dtmapel'   => $this->guru->getMapelById($id),
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
            $this->load->view('guru/mapel/edit_mapel', $data);
            $this->load->view('templates/footer');
        } else {
            $this->guru->update_mapel();
            $this->session->set_flashdata('message', 'data mapel berhasil di-rubah');
            redirect('guru/mapel');
        }
    }

    public function deletemapel($id)
    {
        $this->guru->delmapel($id);
        $this->session->set_flashdata('message', 'data mapel berhasil di-hapus');
        redirect('guru/mapel');
    }

    public function addkomp($id)
    {
        $data = [
            'title'     => 'Add Kompetensi Dasar',
            'user'      => $this->admin->sesi(),
            'kompdasar' => $this->guru->getKompdasar($id),
            'mapel'     => $this->guru->getMapelById($id)
        ];

        $dmapel    = $this->guru->getMapelById($id);

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
            $this->load->view('guru/mapel/add_komp', $data);
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

            $this->guru->save_komp($data);
            $this->session->set_flashdata('message', 'data kompetensi dasar ' . $dmapel['namamapel'] . ' berhasil ditambah-kan');
            redirect('guru/mapel');
        }
    }
}
