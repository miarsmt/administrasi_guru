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
            'dtkelas'   => $this->guru->getMengajar(),
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
            'title' => 'Mapel Diampu',
            'user'  => $this->admin->sesi(),
            'ampu'  => $this->guru->getMengajar()
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('guru/ampu', $data);
        $this->load->view('templates/footer');
    }

    public function addkomp()
    {
        $id = $this->uri->segment(3);
        $data = [
            'kodekd'        => $this->input->post('kode', true),
            'namakd'        => $this->input->post('nama', true),
            'semester'      => $this->input->post('semester', true),
            'kodemapel'     => $this->input->post('kodemapel', true)
        ];

        $mapel = $this->master->getMapelById($this->input->post('kodemapel'));

        $this->master->save_komp($data);
        $this->session->set_flashdata('message', 'data kompetensi dasar ' . $mapel['namamapel'] . ' berhasil ditambah-kan');
        redirect('guru/n_pengetahuan/' . $id);
    }

    public function deletekomp()
    {
        $id = $this->uri->segment(3);
        $ambil = $this->master->getKompById($id);
        if ($ambil) {
            $this->guru->delkomp($id);
            $this->session->set_flashdata('message', 'data kompetensi dasar berhasil di-hapus');
            redirect('guru/addkomp/' . $ambil['kodemapel']);
        }
    }

    public function addagenda()
    {
        $id = $this->uri->segment(3);
        $ambil = $this->master->getAjarById($id);
        $data = [
            'title'     => 'Agenda Kegiatan',
            'subtitle'  => 'Input Agenda',
            'user'      => $this->admin->sesi(),
            'kompdasar' => $this->guru->getListKd($ambil['kodemapel']),
            'kelas'     => $this->master->getKelasById($ambil['kodekelas']),
            'mapel'     => $this->master->getMapelById($ambil['kodemapel'])
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
                'idmengajar'  => $id,
                'tanggal'   => $this->input->post('tgl', true),
                'jam_ke'    => $this->input->post('jamke', true),
                'idkd'      => $this->input->post('kompdsr', true),
                'keterangan' => $this->input->post('ket', true),
                'status_tgs' => 0
            ];

            $this->guru->save_agenda($data);
            $this->session->set_flashdata('message', 'data agenda berhasil ditambah-kan');
            redirect('guru');
        }
    }

    public function editagenda()
    {
        $kode = $this->uri->segment(3);
        $ambil = $this->guru->ambilagenda($kode);
        $data = [
            'title'     => 'Agenda Kegiatan',
            'subtitle'  => 'Edit Agenda',
            'user'      => $this->admin->sesi(),
            'kompdasar' => $this->guru->getListKd($ambil['kodemapel']),
            'agenda'    => $this->guru->getAgendaById($kode)
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
            $this->load->view('guru/editagenda', $data);
            $this->load->view('templates/footer');
        } else {
            $idajar = $ambil['idmengajar'];
            $this->guru->update_agenda($idajar);
            $this->session->set_flashdata('message', 'data agenda berhasil di-rubah');
            redirect('guru');
        }
    }

    public function delete_agenda($id)
    {
        $this->guru->delagenda($id);
        $this->session->set_flashdata('message', 'data agenda berhasil di-hapus');
        redirect('guru');
    }

    public function absensi()
    {
        $idajar = $this->uri->segment(3);
        $ambil = $this->master->getAjarById($idajar);
        $data = [
            'title'     => 'Agenda Kegiatan',
            'subtitle'  => 'Absensi Siswa',
            'user'      => $this->admin->sesi(),
            'agenda'    => $this->guru->getAgendaByKelas($ambil['kodekelas'], $ambil['kodemapel']),
            'kelas'     => $this->master->getKelasById($ambil['kodekelas']),
            'mapel'     => $this->master->getMapelById($ambil['kodemapel'])
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('guru/absensi', $data);
        $this->load->view('templates/footer');
    }

    public function getsiswa()
    {
        echo json_encode($this->guru->getDataSiswa($_POST['kelas']));
    }

    public function tambahabsen()
    {
        $kodsen = $this->guru->kode_absen();

        $nis        = $_POST['nis'];
        $keterangan = $_POST['keterangan'];
        $semester   = $_POST['semester'];
        $idagenda   = $_POST['id_agenda'];

        $ambil = $this->guru->getAgendaById($idagenda);

        $data = [];

        $index = 0; // set index array awal dengan 0
        foreach ($nis as $datanis) {
            array_push($data, [
                'kodeabsen' => $kodsen,
                'tglabsen'  => $ambil['tanggal'],
                'nis'       => $datanis,
                'keterangan' => $keterangan[$index],
                'semester'   => $semester[$index]
            ]);

            $index++;
            $kodsen++;
        }

        $sql = $this->guru->save_absen($data);
        if ($sql) {
            $this->db->set('status_absen', 1);
            $this->db->where('idagenda', $idagenda);
            $this->db->update('tb_agenda');
            $this->session->set_flashdata('message', 'data agenda berhasil ditambah-kan');
            redirect('guru/absensi/' . $ambil['idmengajar']);
        } else {
            echo "<script>alert('Data gagal disimpan');window.location = '" . base_url('guru') . "'</script>";
        }
    }

    public function n_pengetahuan()
    {
        $id = $this->uri->segment(3);
        $ambil = $this->guru->getMengajarById($id);

        $list_data = $this->db->query("SELECT 
                        b.nis, b.namasiswa, 0 nilai
                        FROM tb_kelas a
                        INNER JOIN tb_siswa b ON a.kodekelas = b.kodekelas
                        WHERE a.kodekelas = '" . $ambil['kodekelas'] . "' 
                        ORDER BY b.namasiswa ASC")->result_array();

        $list_kd = $this->db->query("SELECT *
                        FROM tb_kompdasar
                        WHERE kodemapel = '" . $ambil['kodemapel'] . "'
                        AND jenis = 'P'")->result_array();

        $data = [
            'title'         => 'Mapel Diampu',
            'subtitle'      => 'Nilai Pengetahuan',
            'user'          => $this->admin->sesi(),
            'detil_mp'      => $ambil,
            'idmengajar'    => $id,
            'ambil_siswa'   => $list_data,
            'ambil_kd'      => $list_kd
        ];

        $this->session->set_userdata("idmengajar", $id);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('guru/n_pengetahuan', $data);
        $this->load->view('templates/footer');
    }

    public function list_kd($id)
    {
        $detil_mp = $this->guru->getMengajarById($id);
        $list_data = $this->master->getKompdasarP($detil_mp['kodemapel']);

        echo json_encode($list_data);
    }

    public function editkd($id)
    {
        $query = $this->db->query("SELECT *, 'edit' AS mode FROM tb_kompdasar WHERE idkd = '$id'")->row_array();

        $d = [];

        if (empty($query)) {
            $d['data']['idkd'] = "";
            $d['data']['mode'] = "add";
            $d['data']['kodekd'] = "";
            $d['data']['namakd'] = "";
            $d['data']['jenis'] = "";
            $d['data']['semester'] = "";
            $d['data']['kodemapel'] = "";
        } else {
            $d['data'] = $query;
        }

        echo json_encode($d);
    }

    public function simpankd($id)
    {
        $detil_mp = $this->guru->getMengajarById($id);
        $j = $this->uri->segment(4);
        $p = $this->input->post();

        $d['status'] = "";
        $d['data'] = "";


        if ($p['_mode'] == "add") {
            $this->db->query("INSERT INTO tb_kompdasar (kodekd, namakd, jenis, semester, kodemapel) VALUES ('" . $p['kode'] . "', '" . $p['nama'] . "', '$j', '" . $p['semester'] . "', '" . $detil_mp['kodemapel'] . "')");

            $d['status'] = "ok";
            $d['data'] = "Data KD berhasil di-simpan";
        } else if ($p['_mode'] == "edit") {
            $this->db->query("UPDATE tb_kompdasar SET kodekd = '" . $p['kode'] . "', namakd = '" . $p['nama'] . "', jenis = '" . $p['jenis'] . "', semester = '" . $p['semester'] . "', kodemapel = '" . $p['kodemapel'] . "' WHERE idkd = '" . $p['_id'] . "'");

            $d['status'] = "ok";
            $d['data'] = "Data KD berhasil disimpan";
        } else {
            $d['status'] = "gagal";
            $d['data'] = "Kesalahan sistem";
        }

        echo json_encode($d);
    }

    public function hapuskd($id)
    {
        $this->guru->delkomp($id);

        $d['status'] = "ok";
        $d['data'] = "Data KD berhasil di-hapus";

        echo json_encode($d);
    }

    public function simpan()
    {
        $p = $this->input->post();
        $jumlah_sudah = 0;
        $i = 0;

        $query = [];

        foreach ($p['nilai'] as $s) {
            $cek = $this->db->query("SELECT id FROM tb_nilai WHERE idmengajar = '" . $p['idmengajar'] . "' AND idkd = '" . $p['idkd'] . "' AND nis = '" . $p['nis'][$i] . "' AND jenis = '" . $p['jenis'] . "'")->num_rows();

            if ($cek > 0) {
                $jumlah_sudah++;
                $this->db->query("UPDATE tb_nilai SET nilai = '$s' WHERE idmengajar = '" . $p['idmengajar'] . "' AND idkd = '" . $p['idkd'] . "' AND nis = '" . $p['nis'][$i] . "' AND jenis = '" . $p['jenis'] . "'");
            } else {
                $this->db->query("INSERT INTO tb_nilai (jenis, idmengajar, idkd, nis, nilai) VALUES ('" . $p['jenis'] . "', '" . $p['idmengajar'] . "', '" . $p['idkd'] . "', '" . $p['nis'][$i] . "', '" . $s . "')");
            }
            $i++;
        }

        $d['status'] = "ok";
        $d['data'] = $i . " Data nilai berhasil di-simpan ";
        echo json_encode($d);
    }

    public function ambil_siswa($kelas)
    {
        $id_kd = $this->uri->segment(4);
        $jenis = $this->uri->segment(5);

        $idmengajar = $this->session->userdata('idmengajar');

        $list_data = [];
        if ($jenis == "h") {
            $ambil_nilai = $this->db->query("SELECT
                        b.nis,
                        b.namasiswa,
                        IFNULL(a.nilai, 0) nilai
                        FROM tb_siswa b
                        INNER JOIN tb_nilai a ON a.nis = b.nis
                        INNER JOIN tb_mengajar c ON a.idmengajar = c.idmengajar
                        INNER JOIN tb_kompdasar d ON a.idkd = d.idkd
                        INNER JOIN tb_guru e ON c.nip = e.nip
                        INNER JOIN tb_mapel f ON c.kodemapel = f.kodemapel
                        INNER JOIN tb_kelas g ON c.kodekelas = g.kodekelas
                        WHERE g.kodekelas = '" . $kelas . "' AND a.idkd = '" . $id_kd . "'
                        AND a.jenis = '" . $jenis . "'
                        ORDER BY b.namasiswa ASC")->result_array();

            $ambil_nilai = $this->db->query("SELECT
                        tb_nilai.nis, tb_siswa.namasiswa, IFNULL(tb_nilai.nilai, 0) nilai
                        FROM tb_nilai
                        INNER JOIN tb_mengajar ON tb_nilai.idmengajar = tb_mengajar.idmengajar
                        INNER JOIN tb_siswa ON tb_nilai.nis = tb_siswa.nis
                        WHERE tb_mengajar.idmengajar = '" . $idmengajar . "'
                        AND tb_nilai.idkd = '" . $id_kd . "'
                        AND tb_nilai.jenis = '" . $jenis . "'")->result_array();
        } else {
            $ambil_nilai = $this->db->query("SELECT
                        tb_nilai.nis, tb_siswa.namasiswa, IFNULL(tb_nilai.nilai, 0) nilai
                        FROM tb_nilai
                        INNER JOIN tb_mengajar ON tb_nilai.idmengajar = tb_mengajar.idmengajar
                        INNER JOIN tb_siswa ON tb_nilai.nis = tb_siswa.nis
                        WHERE tb_mengajar.idmengajar = '" . $idmengajar . "'
                        AND tb_nilai.jenis = '" . $jenis . "'")->result_array();
        }


        if (empty($ambil_nilai)) {
            $list_data = $this->db->query("SELECT 
                        b.nis, b.namasiswa, 0 nilai
                        FROM tb_kelas a
                        INNER JOIN tb_siswa b ON a.kodekelas = b.kodekelas
                        WHERE a.kodekelas = '" . $kelas . "' 
                        ORDER BY b.namasiswa ASC")->result_array();
            $d['sik_endi'] = "belum ada";
        } else {
            $list_data = $ambil_nilai;
            $d['sik_endi'] = "sudah ada";
        }

        $d['idmengajar'] = $idmengajar;
        $d['status'] = "ok";
        $d['data'] = $list_data;
        echo json_encode($d);
    }

    public function simpan_nilai()
    {
        $p = $this->input->post();
        $i = 0;

        foreach ($p['nilai'] as $s) {
            $this->db->query("INSERT INTO tb_nilai (jenis, idmengajar, idkd, nis, nilai) VALUES ('" . $p['djenis'] . "', '" . $p['idmengajar'] . "', '" . $p['idkd'] . "', '" . $p['nis'][$i] . "', '" . $s . "')");

            $i++;
        }

        $this->session->set_flashdata('message', '' . $i . ' Data nilai pengetahuan berhasil ditambah-kan');
        redirect('guru/ampu');
    }

    public function n_keterampilan()
    {
        $id = $this->uri->segment(3);
        $ambil = $this->guru->getMengajarById($id);

        $list_data = $this->db->query("SELECT 
                        b.nis, b.namasiswa, 0 nilai
                        FROM tb_kelas a
                        INNER JOIN tb_siswa b ON a.kodekelas = b.kodekelas
                        WHERE a.kodekelas = '" . $ambil['kodekelas'] . "' 
                        ORDER BY b.namasiswa ASC")->result_array();

        $list_kd = $this->db->query("SELECT *
                        FROM tb_kompdasar
                        WHERE kodemapel = '" . $ambil['kodemapel'] . "'
                        AND jenis = 'K'")->result_array();

        $data = [
            'title'         => 'Mapel Diampu',
            'subtitle'      => 'Nilai Keterampilan',
            'user'          => $this->admin->sesi(),
            'detil_mp'      => $ambil,
            'ambil_siswa'   => $list_data,
            'ambil_kd'      => $list_kd
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('guru/n_keterampilan', $data);
        $this->load->view('templates/footer');
    }

    public function simpan_nilaiket()
    {
        $p = $this->input->post();
        $i = 0;

        foreach ($p['nilai'] as $s) {
            $this->db->query("INSERT INTO tb_nilai_ket (idmengajar, idkd, nis, nilai) VALUES ('" . $p['idmengajar'] . "', '" . $p['idkd'] . "', '" . $p['nis'][$i] . "', '" . $s . "')");

            $i++;
        }

        $this->session->set_flashdata('message', '' . $i . ' Data nilai keterampilan berhasil ditambah-kan');
        redirect('guru/ampu');
    }

    public function n_pts()
    {
        $id = $this->uri->segment(3);
        $ambil = $this->guru->getMengajarById($id);

        $list_data = $this->db->query("SELECT 
                        b.nis, b.namasiswa, 0 nilai
                        FROM tb_kelas a
                        INNER JOIN tb_siswa b ON a.kodekelas = b.kodekelas
                        WHERE a.kodekelas = '" . $ambil['kodekelas'] . "' 
                        ORDER BY b.namasiswa ASC")->result_array();

        $list_kdk = $this->db->query("SELECT *
                        FROM tb_kompdasar
                        WHERE kodemapel = '" . $ambil['kodemapel'] . "'
                        AND jenis = 'K'")->result_array();

        $list_kdp = $this->db->query("SELECT *
                        FROM tb_kompdasar
                        WHERE kodemapel = '" . $ambil['kodemapel'] . "'
                        AND jenis = 'P'")->result_array();

        $data = [
            'title'         => 'Mapel Diampu',
            'subtitle'      => 'Nilai PTS',
            'user'          => $this->admin->sesi(),
            'detil_mp'      => $ambil,
            'ambil_kdp'     => $list_kdp,
            'ambil_kdk'     => $list_kdk,
            'ambil_siswa'   => $list_data
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('guru/n_pts', $data);
        $this->load->view('templates/footer');
    }

    public function n_pas()
    {
        $id = $this->uri->segment(3);
        $ambil = $this->guru->getMengajarById($id);

        $list_data = $this->db->query("SELECT 
                        b.nis, b.namasiswa, 0 nilai
                        FROM tb_kelas a
                        INNER JOIN tb_siswa b ON a.kodekelas = b.kodekelas
                        WHERE a.kodekelas = '" . $ambil['kodekelas'] . "' 
                        ORDER BY b.namasiswa ASC")->result_array();

        $list_kdk = $this->db->query("SELECT *
                        FROM tb_kompdasar
                        WHERE kodemapel = '" . $ambil['kodemapel'] . "'
                        AND jenis = 'K'")->result_array();

        $list_kdp = $this->db->query("SELECT *
                        FROM tb_kompdasar
                        WHERE kodemapel = '" . $ambil['kodemapel'] . "'
                        AND jenis = 'P'")->result_array();

        $data = [
            'title'         => 'Mapel Diampu',
            'subtitle'      => 'Nilai PAS',
            'user'          => $this->admin->sesi(),
            'detil_mp'      => $ambil,
            'ambil_kdp'     => $list_kdp,
            'ambil_kdk'     => $list_kdk,
            'ambil_siswa'   => $list_data
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('guru/n_pas', $data);
        $this->load->view('templates/footer');
    }

    public function cetak($bawa)
    {
        $strq_detail_guru = "SELECT 
                a.periode_mengajar, a.semester, b.namaguru, c.kelas, c.namakelas, d.namamapel
                FROM tb_mengajar a
                INNER JOIN tb_guru b ON a.nip = b.nip
                INNER JOIN tb_kelas c ON a.kodekelas = c.kodekelas
                INNER JOIN tb_mapel d ON a.kodemapel = d.kodemapel
                WHERE a.idmengajar = '" . $bawa . "'";
        $detil_guru = $this->db->query($strq_detail_guru)->row_array();

        $strq_np = "SELECT
                a.nis, a.jenis, a.idkd, a.nilai
                FROM tb_nilai a
                WHERE a.idmengajar = '" . $bawa . "'
                GROUP BY a.nis, a.jenis, a.idkd";


        $strq_kd = "SELECT
                b.idkd, b.kodekd
                FROM tb_nilai a
                INNER JOIN tb_kompdasar b ON a.idkd = b.idkd
                WHERE a.idmengajar = '" . $bawa . "' AND b.jenis = 'P' 
                GROUP BY a.idkd";

        $strq_siswa = "SELECT
                b.nis, b.namasiswa
                FROM tb_mengajar a
                INNER JOIN tb_siswa b ON a.kodekelas = b.kodekelas
                WHERE a.idmengajar = '" . $bawa . "'";

        $queri_np = $this->db->query($strq_np)->result_array();
        $queri_kd = $this->db->query($strq_kd)->result_array();
        $jml_kd = $this->db->query($strq_kd)->num_rows();
        $queri_siswa = $this->db->query($strq_siswa)->result_array();

        $data_np = [];
        foreach ($queri_np as $a) {
            $idx1 = $a['nis'];
            $idx2 = $a['jenis'];
            $idx3 = $a['idkd'];
            if ($a['jenis'] == "t") {
                $data_np[$idx1][$idx2] = $a['nilai'];
            } else if ($a['jenis'] == "a") {
                $data_np[$idx1][$idx2] = $a['nilai'];
            } else {
                $data_np[$idx1][$idx2][$idx3] = $a['nilai'];
            }
        }

        $html = '<p align="left"><b>REKAP NILAI PENGETAHUAN</b>
                <br>
                Mata Pelajaran : ' . $detil_guru['namamapel'] . ', Kelas : ' . $detil_guru['kelas'] . ' ' . $detil_guru['namakelas'] . ', Guru : ' . $detil_guru['namaguru'] . '. Tahun Pelajaran ' . $detil_guru['periode_mengajar'] . ', Semester : ' . $detil_guru['semester'] . '<hr style="border: solid 1px #000; margin-top: -10px"></p>';

        $html .= '<table class="table"><tr><td rowspan="2">Nama</td><td colspan="' . $jml_kd . '">NH</td><td rowspan="2">Rata-rata NH</td><td rowspan="2">PTS</td><td rowspan="2">PAS</td><td rowspan="2">Nilai Akhir</td></tr><tr>';

        foreach ($queri_kd as $k) {
            $html .= '<td>' . $k['kodekd'] . '</td>';
        }

        $html .= '</tr>';

        foreach ($queri_siswa as $s) {
            $idxs = $s['nis'];
            $html .= '<tr><td>' . $s['namasiswa'] . '</td>';
            $jml_nilai_kd = 0;
            foreach ($queri_kd as $k) {
                $idxk = $k['idkd'];
                $nilai_kd = !empty($data_np[$idxs]['h'][$idxk]) ? number_format($data_np[$idxs]['h'][$idxk]) : 0;
                $jml_nilai_kd += $nilai_kd;

                $html .= '<td>' . $nilai_kd . '</td>';
            }
            if ($jml_kd > 0) {
                $rata_rata_nilai_kd = number_format($jml_nilai_kd / $jml_kd);
            } else {
                $rata_rata_nilai_kd = 0;
            }
            $nilai_uts = !empty($data_np[$idxs]['t']) ? number_format($data_np[$idxs]['t']) : 0;
            $nilai_uas = !empty($data_np[$idxs]['a']) ? number_format($data_np[$idxs]['a']) : 0;
            $html .= '<td>' . $rata_rata_nilai_kd . '</td><td>' . $nilai_uts . '</td><td>' . $nilai_uas . '</td>';

            $p_h = $this->config->item('pnp_h');
            $p_t = $this->config->item('pnp_t');
            $p_a = $this->config->item('pnp_a');
            $jml = $p_h + $p_t + $p_a;

            $p_h = ($p_h / $jml) * 100;
            $p_t = ($p_t / $jml) * 100;
            $p_a = ($p_a / $jml) * 100;

            $na_np = number_format((($rata_rata_nilai_kd * $p_h) + ($nilai_uts * $p_t) + ($nilai_uas * $p_a)) / 100);

            $html .= '<td>' . $na_np . '</td></tr>';
        }

        $html .= '</table>';

        $this->d['html'] = $html;
        $this->load->view('nilai/cetak', $this->d);
    }

    public function cetaknk($bawa)
    {
        $pc_bawa = explode("-", $bawa);

        $html = '';

        $detil_guru = $this->db->query('SELECT
                b.namamapel, c.kelas, c.namakelas, d.namaguru, a.semester, a.periode_mengajar
                FROM tb_mengajar a
                INNER JOIN tb_mapel b ON a.kodemapel = b.kodemapel
                INNER JOIN tb_kelas c ON a.kodekelas = c.kodekelas
                INNER JOIN tb_guru d ON a.nip = d.nip
                WHERE b.kodemapel = "' . $pc_bawa[0] . '" AND c.kodekelas = "' . $pc_bawa[1] . '"')->row_array();

        $q_nilai_harian = $this->db->query('SELECT
                c.namasiswa, a.idkd, a.nis, a.nilai
                FROM tb_nilai_ket a
                LEFT JOIN tb_kompdasar b ON a.idkd = b.idkd
                LEFT JOIN tb_siswa c ON a.nis = c.nis
                WHERE c.kodekelas = "' . $pc_bawa[1] . '" AND b.kodemapel = "' . $pc_bawa[0] . '"
                ORDER BY c.namasiswa ASC')->result_array();

        $nilai_harian = $this->db->query('SELECT
        b.namasiswa, a.nis, a.idkd, a.nilai
        FROM tb_nilai_ket a
        LEFT JOIN tb_siswa b ON a.nis = b.nis
        LEFT JOIN tb_kompdasar c ON a.idkd = c.idkd
        LEFT JOIN tb_mengajar d ON a.idmengajar = d.idmengajar
        WHERE d.kodekelas = "' . $pc_bawa[1] . '" AND d.kodemapel = "' . $pc_bawa[0] . '"
        ORDER BY b.namasiswa ASC')->result_array();

        $q_kd_guru_ini = $this->db->query('SELECT a.*
                FROM tb_kompdasar a
                LEFT JOIN tb_mengajar b ON a.kodemapel = b.kodemapel
                WHERE b.kodemapel = "' . $pc_bawa[0] . '"
                AND b.kodekelas = "' . $pc_bawa[1] . '"
                AND a.jenis = "K"')->result_array();

        $d_kd = [];

        if (!empty($q_kd_guru_ini)) {
            foreach ($q_kd_guru_ini as $v) {
                $idx = $v['idkd'];
                $d_kd[$idx]['kode'] = $v['kodekd'];
                $d_kd[$idx]['nama_kd'] = $v['namakd'];
            }
        }

        $d_nilai = [];

        if (!empty($nilai_harian)) {
            foreach ($nilai_harian as $d) {
                $idx1 = $d['nis'];
                $idx2 = $d['idkd'];

                $d_nilai[$idx1]['nama'] = $d['namasiswa'];
                $d_nilai[$idx1]['h'][$idx2]['nilai_huruf'] = nilai_huruf($d['nilai']);
                $d_nilai[$idx1]['h'][$idx2]['nilai_pre'] = nilai_pre($d['nilai']);
                $d_nilai[$idx1]['h'][$idx2]['nilai_angka'] = $d['nilai'];
            }
        }

        $jml_kd = sizeof($d_kd);

        $html = '<p align="left"><b>REKAP NILAI KETERAMPILAN</b>
                <br>
                Mata Pelajaran : ' . $detil_guru['namamapel'] . ', Kelas : ' . $detil_guru['kelas'] . ' ' . $detil_guru['namakelas'] . ', Guru : ' . $detil_guru['namaguru'] . ', Tahun Pelajaran: ' . $detil_guru['periode_mengajar'] . ', Semester : ' . $detil_guru['semester'] . '<hr style="border: solid 1px #000; margin-top: -10px"></p>
                <table class="table"><thead><tr>
                <th rowspan="2">No</th>
                <th rowspan="2">Nama</th>
                <th colspan="' . $jml_kd . '">Kode KD</th>
                <th rowspan="2">Rata-rata UH</th>
                <th colspan="3">Nilai Akhir</th>
                </tr>
                <tr>';

        if (!empty($d_kd)) {
            foreach ($d_kd as $kd) {
                $html .= '<th>' . $kd['kode'] . '</th>';
            }
        }

        $html .= '<th>Nilai</th><th>Predikat</th><th>Deskripsi</th></tr></thead><tbody>';

        if (!empty($d_nilai)) {
            $no = 1;
            foreach ($d_nilai as $ke => $dn) {

                $html .= '<tr><td class="ctr">' . $no . '</td><td>' . $dn['nama'] . '</td>';

                $jml_nilai_tugas = 0;

                $array_kurang = [];
                $array_cukup = [];
                $array_baik = [];
                $array_sangat_baik = [];
                $array_undefined = [];
                $kurang = "";
                $cukup = "";
                $baik = "";
                $sangat_baik = "";
                $undefined = "";

                if (!empty($d_kd)) {
                    foreach ($d_kd as $k => $v) {
                        $id_siswa = $ke;
                        $id_kd = $k;
                        $nil_huruf = empty($dn["h"][$id_kd]['nilai_huruf']) ? "" : $dn["h"][$id_kd]['nilai_huruf'];

                        if ($nil_huruf == "D") {
                            $array_kurang[] = $v['nama_kd'];
                        } else if ($nil_huruf == "C") {
                            $array_cukup[] = $v['nama_kd'];
                        } else if ($nil_huruf == "B") {
                            $array_baik[] = $v['nama_kd'];
                        } else if ($nil_huruf == "A") {
                            $array_sangat_baik[] = $v['nama_kd'];
                        } else {
                            $array_undefined[] = "un";
                        }

                        $nilai_uh = empty($dn["h"][$id_kd]["nilai_angka"]) ? 0 : number_format($dn["h"][$id_kd]["nilai_angka"]);

                        $html .= '<td class="ctr">' . $nilai_uh . '</td>';
                        $jml_nilai_tugas += $nilai_uh;
                    }
                }

                $n_h    = number_format($jml_nilai_tugas / $jml_kd);
                $nilai_akhir = number_format($n_h);

                $kurang = empty($array_kurang) ? "" : "KURANG, pada : " . implode(", ", $array_kurang) . "; ";
                $cukup = empty($array_cukup) ? "" : "CUKUP, pada : " . implode(", ", $array_cukup) . "; ";
                $baik = empty($array_baik) ? "" : "BAIK, pada : " . implode(", ", $array_baik) . "; ";
                $sangat_baik = empty($array_sangat_baik) ? "" : "SANGAT BAIK, pada : " . implode(", ", $array_sangat_baik) . "; ";

                $html .= '<td class="ctr">' . $n_h . '</td><td class="ctr">' . $nilai_akhir . '</td><td class="ctr">' . nilai_huruf($nilai_akhir) . '</td><td>' . $kurang . $cukup . $baik . $sangat_baik . '</td>';

                $no++;
            }
        } else {
            $html .= '<tr><td colspan="' . ($jml_kd + 6) . '">Belum ada data</td></tr>';
        }

        $this->d['html'] = $html;
        $this->load->view('nilai/cetaknk', $this->d);
    }

    public function riwayat()
    {
        $data = [
            'title' => 'Riwayat Mengajar',
            'user'  => $this->admin->sesi(),
            'riwayat' => $this->guru->getRiwayat()
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('guru/riwayat', $data);
        $this->load->view('templates/footer');
    }

    public function cekabsen()
    {
        $kelas = $this->uri->segment(3);
        $tanggal = $this->uri->segment(4);

        $data = [
            'title' => 'Edit Absensi',
            'user'  => $this->admin->sesi(),
            'ambil' => $this->guru->getAbsen($kelas, $tanggal)
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('guru/cekabsen', $data);
        $this->load->view('templates/footer');
    }

    public function update_absen()
    {
        $p = $this->input->post();
        $i = 0;

        foreach ($p['ket'] as $s) {
            $this->db->query("UPDATE tb_absensi SET keterangan = '$s' WHERE nis = '" . $p['nis'][$i] . "' ");

            $i++;
        }

        $this->session->set_flashdata('message', '' . $i . ' Data absensi berhasil di-rubah');
        redirect('guru');
    }
}
