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
            'title'     => 'Agenda Kegiatan',
            'user'      => $this->admin->sesi(),
            'dtkelas'   => $this->guru->getListKelas(),
            'agenda'    => $this->guru->getAgenda()
        ];

        $this->form_validation->set_rules('judul', 'Judul', 'required|trim', [
            'required' => '%s tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('desk', 'Deskripsi', 'required|trim', [
            'required' => '%s tidak boleh kosong'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('guru/index', $data);
            $this->load->view('templates/footer');
        } else {
            $idagenda  = $this->input->post('id_agenda', true);
            $judul     = $this->input->post('judul', true);
            $desk      = $this->input->post('desk', true);
            $ket       = $this->input->post('ket', true);

            //cek jika ada upload file tugas
            $upload_berkas = $_FILES['berkas_file']['name'];

            if ($upload_berkas) {
                $config['allowed_types'] = 'jpg|png|jpeg|pdf|doc|docx|xls|xlsx';
                $config['max_size']     = '2048';
                $config['upload_path']  = './assets/berkas/tugas/';
                $config['file_name']    = 'Tugas-' . date('y-m-d');

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('berkas_file')) {
                    $new_berkas = $this->upload->data('file_name');
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $data = [
                'idagenda' => $idagenda,
                'judul'     => $judul,
                'deskripsi' => $desk,
                'fileupload' => $new_berkas,
                'keterangan' => $ket
            ];

            $simpan = $this->guru->save_tugas($data);
            if ($simpan) {
                $this->db->set('status_tgs', 1);
                $this->db->where('idagenda', $idagenda);
                $this->db->update('tb_agenda');

                $this->session->set_flashdata('message', 'data tugas berhasil ditambah-kan');
                redirect('guru');
            }
        }
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

    public function addagenda($kdkelas, $kdmapel)
    {
        $data = [
            'title'     => 'Tambah Agenda Kegiatan',
            'user'      => $this->admin->sesi(),
            'kompdasar' => $this->guru->getListKd($kdmapel),
            'kelas'     => $this->master->getKelasById($kdkelas),
            'mapel'     => $this->master->getMapelById($kdmapel)
        ];

        $this->form_validation->set_rules('tgl', 'Tanggal', 'required', [
            'required' => '%s tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('jamke', 'Jam ke', 'required', [
            'required' => '%s tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('ket', 'Keterangan', 'required|trim', [
            'required' => '%s tidak boleh kosong'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('guru/addagenda', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'tanggal'   => $this->input->post('tgl', true),
                'jam_ke'    => $this->input->post('jamke', true),
                'kodekelas' => $kdkelas,
                'kodemapel' => $kdmapel,
                'idkd'      => $this->input->post('kompdsr', true),
                'keterangan' => $this->input->post('ket', true),
                'status_tgs' => 0,
            ];

            $this->guru->save_agenda($data);
            $this->session->set_flashdata('message', 'data agenda berhasil ditambah-kan');
            redirect('guru');
        }
    }

    public function delete_agenda($id)
    {
        $this->guru->delagenda($id);
        $this->session->set_flashdata('message', 'data agenda berhasil di-hapus');
        redirect('guru');
    }
}
