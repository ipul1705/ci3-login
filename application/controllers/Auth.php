<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __counstruct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }
    public function index()
    {
        $data['title'] = 'Login';
        $this->load->view('templates/auth_header', $data);
        $this->load->view('auth/login');
        $this->load->view('templates/auth_footer');
    }

    public function registration()
    {
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|callback_chk_email');
        $this->form_validation->set_rules('birthdate', 'Birthdate', 'required|trim|callback_chk_umur');
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|matches[password2]|callback_chk_password');
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {

            $data['title'] = 'User Registration';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/registration');
            $this->load->view('templates/auth_footer');
        } else {
            echo 'Anda Berhasil Register';
        }
    }

    public function chk_email($str)

    {
        if (1 !== preg_match("/[\w]+@[rumahweb.co.id]+/", $str)) {
            return FALSE;
        } else {
            return TRUE;
        }
    }


    public function chk_umur()
    {

        $this->load->helper(array('umur_helper', 'date'));
        $tgl = $_POST['birthdate'];

        if (hitung_umur($tgl) < 17) {
            return FALSE;
        } else {
            return TRUE;
        }
    }


    public function chk_password($str)

    {

        if (1 !== preg_match("/^.*(?=.{12,})(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).*$/", $str)) {
            return FALSE;
        } else {
            return TRUE;
        }
    }
}
