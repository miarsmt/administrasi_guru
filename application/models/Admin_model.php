<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    public function sesi()
    {
        return $this->db->get_where('user_login', ['namauser' => $this->session->userdata('namauser')])->row_array();
    }
}
