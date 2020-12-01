<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Role_model extends CI_Model
{
    public function getUserRole()
    {
        return $this->db->get('user_role')->result_array();
    }

    public function save($data)
    {
        $this->db->insert('user_role', $data);
    }

    public function editRole($where, $data)
    {
        $this->db->where($where);
        $this->db->update('user_role', $data);
        return true;
    }

    public function delete($id)
    {
        $this->db->delete('user_role', ['id' => $id]);
    }

    public function getRoleById($role_id)
    {
        return $this->db->get_where('user_role', ['id' => $role_id])->row_array();
    }
}
