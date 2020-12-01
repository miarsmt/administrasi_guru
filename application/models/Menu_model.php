<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{
    public function getSubMenu()
    {
        $query = "SELECT `user_sub_menu`.*, `user_menu`.`menu`
                    FROM `user_sub_menu` JOIN `user_menu`
                    ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
                ";

        return $this->db->query($query)->result_array();
    }

    public function editMenu($where, $data)
    {
        $this->db->where($where);
        $this->db->update('user_menu', $data);
        return true;
    }

    public function deleteMenu($id)
    {
        $this->db->delete('user_menu', ['id' => $id]);
    }

    public function getSubmenuById($id)
    {
        // return $this->db->get_where('user_sub_menu', ['id' => $id])->row_array();
        $query = " SELECT `user_sub_menu`.*, `user_menu`.`menu`
                    FROM `user_sub_menu`JOIN `user_menu`
                    ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
                    WHERE `user_sub_menu`.`id` = $id
                    ";
        return $this->db->query($query)->row_array();
    }

    public function editDataSubmenu()
    {
        $data = [
            'title' => $this->input->post('title', true),
            'menu_id' => $this->input->post('menu_id', true),
            'url' => $this->input->post('url', true),
            'icon' => $this->input->post('icon', true),
            'is_active' => $this->input->post('is_active', true)
        ];

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('user_sub_menu', $data);
    }

    public function deleteSubmenu($id)
    {
        $this->db->delete('user_sub_menu', ['id' => $id]);
    }

    public function getAllMenu()
    {
        return $this->db->get('user_menu')->result_array();
    }

    public function saveMenu($data)
    {
        $this->db->insert('user_menu', $data);
    }

    public function save_sub($data)
    {
        $this->db->insert('user_sub_menu', $data);
    }

    public function getMenu()
    {
        $this->db->where('id != 1');
        return $this->db->get('user_menu')->result_array();
    }

    public function getAccessMenu($data)
    {
        return $this->db->get_where('user_access_menu', $data);
    }

    public function saveAccess($data)
    {
        $this->db->insert('user_access_menu', $data);
    }

    public function deleteAccess($data)
    {
        $this->db->delete('user_access_menu', $data);
    }
}
