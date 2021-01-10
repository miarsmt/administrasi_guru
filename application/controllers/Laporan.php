<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model([
            'Master_model' => 'master',
            'Guru_model'   => 'guru'
        ]);
        $this->load->library('fpdf');
        define('FPDF_FONTPATH', $this->config->item('fonts_path'));
    }

    public function dataguru()
    {
        $data = [
            'title' => 'REKAPITULASI DATA GURU',
            'guru'  => $this->master->getGuru()
        ];

        $this->load->view('report/dataguru', $data);
    }

    public function datakelas()
    {
        $data = [
            'title' => 'Data Kelas',
            'user'  => $this->admin->sesi(),
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('report/filter-kelas', $data);
        $this->load->view('templates/footer');
    }

    public function reportkelas()
    {
        $Tingkat = $this->uri->segment(3);
        $data    = [
            'title' => 'REKAPITULASI DATA KELAS',
            'tingkat' => $Tingkat,
            'kelas' => $this->master->getKelasByTingkatan($Tingkat)
        ];

        $this->load->view('report/datakelas', $data);
    }

    public function datasiswa()
    {
        $data = [
            'title' => 'Data Siswa',
            'user'  => $this->admin->sesi(),
            'jurusan' => $this->master->getAllJurusan()
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('report/filter-siswa', $data);
        $this->load->view('templates/footer');
    }

    public function getkelas()
    {
        echo json_encode($this->master->getDataKelas($_POST['id']));
    }

    public function reportsiswa()
    {
        $Kelas = $this->uri->segment(3);
        $data    = [
            'title' => 'REKAPITULASI DATA SISWA',
            'kelas' => $this->master->getKelasById($Kelas),
            'siswa' => $this->master->getDataSiswa($Kelas)
        ];

        $this->load->view('report/datasiswa', $data);
    }

    public function dataampu()
    {
        $data = [
            'title' => 'Data Ampu',
            'user'  => $this->admin->sesi(),
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('report/filter-ampu', $data);
        $this->load->view('templates/footer');
    }

    public function report_ampu()
    {
        $kelas = $this->input->post('tingkatan');
        $semeter = $this->input->post('semester');

        $data = [
            'title' => 'REKAPITULASI DATA AMPU',
            'kelas' => $kelas,
            'semester' => $semeter,
            'ampu'  => $this->master->getAmpu($kelas, $semeter)
        ];

        $this->load->view('report/dataampu', $data);
    }

    public function dataagenda()
    {
        $data = [
            'title' => 'Data Agenda',
            'user'  => $this->admin->sesi(),
            'guru'  => $this->master->getAllGuru()
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('report/filter-agenda', $data);
        $this->load->view('templates/footer');
    }

    public function reportagenda()
    {
        $nip = $this->uri->segment(3);

        $data = [
            'title' => 'REKAPITULASI AGENDA KEGIATAN',
            'guru'  => $this->master->getGuruById($nip),
            'agenda' => $this->guru->getDataAgenda($nip)
        ];

        $this->load->view('report/dataagenda', $data);
    }
}
