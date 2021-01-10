<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data = [
            'title' => 'My Profile',
            'user'  => $this->admin->sesi()
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }

    public function edit()
    {
        $data = [
            'title' => 'Edit Profile',
            'user'  => $this->admin->sesi()
        ];

        $this->form_validation->set_rules('name', 'Name', 'required|trim', [
            'required' => '%s tidak boleh kosong'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $name = $this->input->post('name', true);
            $uname = $this->input->post('namauser');

            //cek jika ada upload gambar
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']     = '2048';
                $config['upload_path'] = './assets/img/profile/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $old_image = $data['user']['image'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('avataruser', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->db->set('namalengkapuser', $name);
            $this->db->where('namauser', $uname);
            $this->db->update('user_login');
            $this->session->set_flashdata('message', 'Profile anda telah berhasil di-ubah!');
            redirect('user');
        }
    }

    public function changepassword()
    {
        $data = [
            'title' => 'Change Password',
            'user'  => $this->admin->sesi()
        ];

        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim', [
            'required' => '%s tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[3]|matches[new_password2]', [
            'required' => '%s tidak boleh kosong',
            'min_length' => '%s minimal 3 karakter',
            'matches' => '%s harus sama'
        ]);
        $this->form_validation->set_rules('new_password2', 'Retype Password', 'required|trim|min_length[3]|matches[new_password1]', [
            'required' => '%s tidak boleh kosong',
            'min_length' => '%s minimal 3 karakter',
            'matches' => '%s harus sama'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/change_password', $data);
            $this->load->view('templates/footer');
        } else {
            $current_password = md5($this->input->post('current_password', true));
            $new_password = md5($this->input->post('new_password1', true));

            if ($current_password != $data['user']['passuser']) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password lama salah!</div>');
                redirect('user/changepassword');
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password baru tidak boleh sama dengan password lama!</div>');
                    redirect('user/changepassword');
                } else {
                    // password ok
                    // $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                    $this->user->changePass($new_password);

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password telah berhasil di-ubah!</div>');
                    redirect('user/changepassword');
                }
            }
        }
    }
}
