<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {

    public function index()
    {
        redirect('login');
    }

    public function logout_employee()
    {
        $this->session->sess_destroy();
        redirect('employee');
    }

    public function logout_partner()
    {
        $this->session->sess_destroy();
        redirect('login');
    }

}