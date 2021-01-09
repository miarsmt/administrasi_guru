<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data = [
            'title' => 'Menu Management',
            'user'  => $this->admin->sesi(),
            'menu'  => $this->menu->getAllMenu()
        ];

        $this->form_validation->set_rules('menu', 'Menu', 'required|trim', [
            'required' => '%s tidak boleh kosong'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('templates/footer');
        } else {
            $menu = $this->input->post('menu', true);
            $data = [
                'menu' => $menu
            ];

            $this->menu->saveMenu($data);
            $this->session->set_flashdata('message', 'Menu baru berhasil di-tambahkan!');
            redirect('menu');
        }
    }

    public function editmenu()
    {
        $data = [
            'title' => 'Menu Management',
            'user'  => $this->admin->sesi(),
            'menu'  => $this->menu->getAllMenu()
        ];

        $this->form_validation->set_rules('menu', 'Menu', 'required|trim', [
            'required' => '%s tidak boleh kosong'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'menu' => $this->input->post('menu', true)
            ];
            $where = [
                'id' => $this->input->post('id')
            ];

            $this->menu->editMenu($where, $data);
            $this->session->set_flashdata('message', 'Menu berhasil di-rubah!');
            redirect('menu');
        }
    }

    public function submenu()
    {
        $data = [
            'title'   => 'Submenu Management',
            'user'    => $this->admin->sesi(),
            'submenu' => $this->menu->getSubMenu(),
            'menu'    => $this->menu->getAllMenu()
        ];

        $this->_rulesSubmenu();

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/submenu', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'title' => $this->input->post('title', true),
                'menu_id' => $this->input->post('menu_id', true),
                'url' => $this->input->post('url', true),
                'icon' => $this->input->post('icon', true),
                'is_active' => $this->input->post('is_active', true)
            ];

            // tambah data baru sub menu
            $this->menu->save_sub($data);
            $this->session->set_flashdata('message', 'Submenu baru berhasil ditambah-kan!');
            redirect('menu/submenu');
        }
    }

    private function _rulesSubmenu()
    {
        $this->form_validation->set_rules('title', 'Title', 'required|trim', [
            'required' => '%s tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('menu_id', 'Menu', 'required', [
            'required' => '%s tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('url', 'URL', 'required', [
            'required' => '%s tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('icon', 'Icon', 'required|trim', [
            'required' => '%s tidak boleh kosong'
        ]);
    }

    public function deletemenu($id)
    {
        $this->menu->deleteMenu($id);
        $this->session->set_flashdata('message', 'Menu berhasil ter-hapus!');
        redirect('menu');
    }

    public function editsubmenu($id)
    {
        $data = [
            'title'    => 'Submenu Management',
            'subtitle' => 'Edit Submenu',
            'user'  => $this->admin->sesi(),
            'submenu' => $this->menu->getSubmenuById($id),
            'menu'    => $this->menu->getAllMenu()
        ];

        $this->_rulesSubmenu();

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/editsubmenu', $data);
            $this->load->view('templates/footer');
        } else {
            $this->menu->editDataSubmenu();
            $this->session->set_flashdata('message', 'Submenu telah berhasil di-rubah!');
            redirect('menu/submenu');
        }
    }

    public function deletesubmenu($id)
    {
        $this->menu->deleteSubmenu($id);
        $this->session->set_flashdata('message', 'Submenu berhasil ter-hapus!');
        redirect('menu/submenu');
    }
}
