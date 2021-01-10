<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    public function getUserByEmail($data)
    {
        return $this->db->get_where('user', $data)->row_array();
    }

    public function getUserByUname($data)
    {
        return $this->db->get_where('user_login', $data)->row_array();
    }

    public function getUserByEmailActive($email)
    {
        return $this->db->get_where('user', ['email' => $email, 'is_active' => 1])->row_array();
    }

    public function getToken($data_token)
    {
        return $this->db->get_where('user_token', $data_token)->row_array();
    }

    public function save($data)
    {
        $this->db->insert('user', $data);
    }

    public function saveToken($user_token)
    {
        $this->db->insert('user_token', $user_token);
    }

    public function updateUser($email)
    {
        $this->db->set('is_active', 1);
        $this->db->where('email', $email);
        $this->db->update('user');
    }

    public function updatePassword($password, $email)
    {
        $this->db->set('password', $password);
        $this->db->where('email', $email);
        $this->db->update('user');
    }

    public function changePass($new_password)
    {
        $this->db->set('passuser', $new_password);
        $this->db->where('namauser', $this->session->userdata('namauser'));
        $this->db->update('user_login');
    }

    public function deleteUser($data)
    {
        $this->db->delete('user', $data);
    }

    public function deleteToken($data)
    {
        $this->db->delete('user_token', $data);
    }
}
