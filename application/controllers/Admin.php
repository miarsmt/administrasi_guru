<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'user'  => $this->admin->sesi()
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }

    public function role()
    {
        $data = [
            'title' => 'Role',
            'user'  => $this->admin->sesi(),
            'role'  => $this->role->getUserRole()
        ];

        $this->form_validation->set_rules('role', 'Role', 'required|trim', [
            'required' => '%s tidak boleh kosong'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/role', $data);
            $this->load->view('templates/footer');
        } else {
            $role = $this->input->post('role', true);
            $data = [
                'role' => $role
            ];

            $this->role->save($data);
            $this->session->set_flashdata('message', 'Role baru berhasil ditambahkan!');
            redirect('admin/role');
        }
    }

    public function editrole()
    {
        $data = [
            'title' => 'Role',
            'user'  => $this->admin->sesi(),
            'role'  => $this->role->getUserRole()
        ];

        $this->form_validation->set_rules('role', 'Role', 'required|trim', [
            'required' => '%s tidak boleh kosong'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/role', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'role' => $this->input->post('role', true)
            ];
            $where = [
                'id' => $this->input->post('id')
            ];

            $this->role->editRole($where, $data);
            $this->session->set_flashdata('message', 'Role berhasil di-rubah!');
            redirect('admin/role');
        }
    }

    public function deleterole($id)
    {

        $this->role->delete($id);
        $this->session->set_flashdata('message', 'Role telah berhasil di hapus!');
        redirect('admin/role');
    }

    public function roleAccess($role_id)
    {
        $data = [
            'title' => 'Role',
            'subtitle' => 'Role Access',
            'user'  => $this->admin->sesi(),
            'role'  => $this->role->getRoleById($role_id),
            'menu'  => $this->menu->getMenu()
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role_access', $data);
        $this->load->view('templates/footer');
    }

    public function changeAccess()
    {
        $menu_id = $this->input->post('menuId', true);
        $role_id = $this->input->post('roleId', true);

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->menu->getAccessMenu($data);

        if ($result->num_rows() < 1) {
            $this->menu->saveAccess($data);
        } else {
            $this->menu->deleteAccess($data);
        }

        $this->session->set_flashdata('message', 'Akses telah berhasil di ubah!');
    }
}
