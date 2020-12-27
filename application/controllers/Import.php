<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\Csv;

class Import extends CI_Controller
{
    public function uploadguru()
    {
        $file_mimes = ['application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];

        if (isset($_FILES['berkas_excel']['name']) && in_array($_FILES['berkas_excel']['type'], $file_mimes)) {
            $arr_file = explode('.', $_FILES['berkas_excel']['name']);
            $extension = end($arr_file);

            if ('csv' == $extension) {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
            } else {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }

            $spreadsheet = $reader->load($_FILES['berkas_excel']['tmp_name']);

            $sheetData = $spreadsheet->getActiveSheet()->toArray();
            for ($i = 1; $i < count($sheetData); $i++) {
                $data = [
                    'nip' => $sheetData[$i]['1'],
                    'namaguru' => $sheetData[$i]['2']
                ];

                $this->db->insert('tb_guru', $data);
            }
            $this->session->set_flashdata('message', 'data guru berhasil di-import');
            redirect('master/guru');
        }
    }

    public function uploadmapel()
    {
        $file_mimes = ['application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];

        if (isset($_FILES['berkas_excel']['name']) && in_array($_FILES['berkas_excel']['type'], $file_mimes)) {
            $arr_file = explode('.', $_FILES['berkas_excel']['name']);
            $extension = end($arr_file);

            if ('csv' == $extension) {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
            } else {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }

            $spreadsheet = $reader->load($_FILES['berkas_excel']['tmp_name']);

            $sheetData = $spreadsheet->getActiveSheet()->toArray();
            for ($i = 1; $i < count($sheetData); $i++) {
                $data = [
                    'kodemapel' => $sheetData[$i]['1'],
                    'namamapel' => $sheetData[$i]['2'],
                    'tingkatan' => $sheetData[$i]['3'],
                    'kodejurusan' => $sheetData[$i]['5']
                ];

                $this->db->insert('tb_mapel', $data);
            }
            $this->session->set_flashdata('message', 'data mapel berhasil di-import');
            redirect('master/mapel');
        }
    }

    public function uploadsiswa()
    {
        $file_mimes = ['application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];

        if (isset($_FILES['berkas_excel']['name']) && in_array($_FILES['berkas_excel']['type'], $file_mimes)) {
            $arr_file = explode('.', $_FILES['berkas_excel']['name']);
            $extension = end($arr_file);

            if ('csv' == $extension) {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
            } else {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }

            $spreadsheet = $reader->load($_FILES['berkas_excel']['tmp_name']);

            $sheetData = $spreadsheet->getActiveSheet()->toArray();
            for ($i = 1; $i < count($sheetData); $i++) {
                $data = [
                    'nis'           => $sheetData[$i]['1'],
                    'namasiswa'     => $sheetData[$i]['2'],
                    'jeniskelamin'  => $sheetData[$i]['4'],
                    'kodekelas'     => $sheetData[$i]['14'],
                    'kodejurusan'   => $sheetData[$i]['15'],
                    'semester_aktif' => $sheetData[$i]['16']
                ];

                $this->db->insert('tb_siswa', $data);
            }
            $this->session->set_flashdata('message', 'data siswa berhasil di-import');
            redirect('master/siswa');
        }
    }
}
