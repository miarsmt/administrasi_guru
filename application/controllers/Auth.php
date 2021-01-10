<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        // kalau sudah login tidak bisa akses page login lagi
        if ($this->session->userdata('email')) {
            redirect('user');
        }

        $data['title'] = 'Login Page';

        $this->form_validation->set_rules('username', 'Username', 'required|trim', [
            'required' => '%s tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim', [
            'required' => '%s tidak boleh kosong'
        ]);


        if ($this->form_validation->run() == false) {
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        } else {
            // validasinya sukses
            $this->_login();
        }
    }

    private function _login()
    {
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));

        $data = [
            'namauser' => $username
        ];

        // $user = $this->user->getUserByEmail($data);
        $user = $this->user->getUserByUname($data);

        // jika usernya ada
        if ($user) {
            // jika usernya aktif
            if ($user['is_active'] == 1) {
                // cek passwordnya
                if ($password == $user['passuser']) {
                    $data = [
                        'namauser' => $user['namauser'],
                        'role_id' => $user['role_id'],
                        'iduser'  => $user['iduser']
                    ];

                    $this->session->set_userdata($data);

                    if ($user['role_id'] == 1) {
                        // $this->session->set_flashdata('message', 'Hello ' . $user['name'] . ', welcome back!');
                        redirect('admin');
                    } else {
                        // $this->session->set_flashdata('message', 'Hello ' . $user['name'] . ', welcome back!');
                        redirect('user');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password yang anda masukkan salah!</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Username ini belum di-aktif kan!</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Username belum terdaftar!</div>');
            redirect('auth');
        }
    }

    public function registration()
    {
        // kalau sudah login ga bisa akses page registration
        if ($this->session->userdata('email')) {
            redirect('user');
        }

        $data['title'] = 'CI User Registration';

        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => '%s telah terdaftar sebelum-nya',
            'required' => '%s tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'required' => '%s tidak boleh kosong',
            'matches' => '%s harus sama',
            'min_length' => '%s terlalu pendek'
        ]);

        $this->form_validation->set_rules('password2', 'Repeat Password', 'required|trim|matches[password1]', [
            'required' => '%s tidak boleh kosong',
            'matches' => '%s harus sama',
            'min_length' => '%s terlalu pendek'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/registration');
            $this->load->view('templates/auth_footer');
        } else {
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 2,
                'is_active' => 1,
                'date_created' => time()

            ];

            //siapkan token
            // $token = base64_encode(random_bytes(32));
            // $user_token = [
            //     'email' => $this->input->post('email', true),
            //     'token' => $token,
            //     'date_created' => time()
            // ];


            $this->user->save($data);
            // $this->user->saveToken($user_token);

            // $this->_sendEmail($token, 'verify');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Selamat! akun anda telah berhasil dibuat. Silahkan Login</div>');
            redirect('auth');
        }
    }

    private function _sendEmail($token, $type)
    {
        $config = [
            'protocol'  => 'smtp', //simple mail transfer protocol
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'miarsmt03@gmail.com', //email pengirim yg baru
            'smtp_pass' => 'titikom4$$', //pass email
            'smtp_port' => 465, // port smtp google
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'newline'   => "\r\n"
        ];

        $this->email->initialize($config);

        $this->email->from('miarsmt03@gmail.com', 'Mia Rusmiati');
        $this->email->to($this->input->post('email'));

        if ($type == 'verify') {
            $this->email->subject('Account Verification');
            $this->email->message('Click this link to verify your account : <a href="' . base_url() . 'auth/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Activate</a>');
        } elseif ($type == 'forgot') {
            $this->email->subject('Reset Password');
            $this->email->message('Click this link to reset your password : <a href="' . base_url() . 'auth/resetpassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Reset Password</a>');
        }

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }

    public function verify()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $data = [
            'email' => $email
        ];
        $data_token = [
            'token' => $token
        ];

        $user = $this->user->getUserByEmail($data);

        if ($user) {
            $user_token = $this->user->getToken($data_token);

            if ($user_token) {
                if (time() - $user_token['date_created'] < 60 * 60 * 24) {

                    $this->user->updateUser($email);

                    $this->user->deleteToken($data);

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">' . $email . ' has been activated. Please login!</div>');
                    redirect('auth');
                } else {

                    $this->user->deleteUser($data);
                    $this->user->deleteToken($data);
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Account activation failed. Token expired!</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Account activation failed. Token invalid!</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Account activation failed. Wrong email!</div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('namauser');
        $this->session->unset_userdata('role_id');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda telah berhasil logout!</div>');
        redirect('auth');
    }

    public function blocked()
    {
        $this->load->view('auth/blocked');
    }

    public function forgotPassword()
    {
        $data['title'] = 'Forgot Password';

        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email', [
            'required' => '%s tidak boleh kosong',
            'valid_email' => '%s tidak sesuai'
        ]);
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/forgot_password');
            $this->load->view('templates/auth_footer');
        } else {
            $email = $this->input->post('email');

            $user = $this->user->getUserByEmailActive($email);
            if ($user) {
                $token = base64_encode(random_bytes(32));
                $user_token = [
                    'email' => $email,
                    'token' => $token,
                    'date_created' => time()
                ];

                $this->user->saveToken($user_token);
                $this->_sendEmail($token, 'forgot');

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Please check your email to reset your password!</div>');
                redirect('auth/forgotPassword');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email is not registered or activated!</div>');
                redirect('auth/forgotPassword');
            }
        }
    }

    public function resetpassword()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

            if ($user_token) {
                $this->session->set_userdata('reset_email', $email);
                $this->changepassword();
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset password failed. Wrong token!</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset password failed. Wrong email!</div>');
            redirect('auth');
        }
    }

    public function changepassword()
    {
        // supaya ga sembarang di akses perlu ada session dulu
        if (!$this->session->userdata('reset_email')) {
            redirect('auth');
        }

        $data['title'] = 'Change Password';

        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'required' => '%s tidak boleh sama',
            'min_length' => '%s minimal 3 karakter',
            'matches' => '%s harus sama'
        ]);
        $this->form_validation->set_rules('password2', 'Retype Password', 'required|trim|min_length[3]|matches[password1]', [
            'required' => '%s tidak boleh sama',
            'min_length' => '%s minimal 3 karakter',
            'matches' => '%s harus sama'
        ]);
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/change_password');
            $this->load->view('templates/auth_footer');
        } else {
            $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
            $email = $this->session->userdata('reset_email');

            $this->user->updatePassword($password, $email);

            $this->session->unset_userdata('reset_email');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password has been changed! Please login.</div>');
            redirect('auth');
        }
    }
}
