<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Add_Employee extends CI_Controller {

    public function index()
    {
        $this->renderPage();
    }
    public function submit()
    {
        $this->load->database();
        $this->load->model('employees_model');

        if ($this->employees_model->verifyEmail($this->input->post('email'))) {
            echo 'Email address already exsist';

        } else {
            //add partner to DB
            $this->employees_model->insert_employee();

            //add session data
            $data = array(
                'username' => $this->input->post('email'),
                'is_logged_in' => true,
                'firstName' => $this->input->post('firstName'),
                'lastName' => $this->input->post('lastName'),
                'employee_status' => 'active'
            );
            $this->session->set_userdata($data);

            echo 'correct';
        }
    }
    private function renderPage($data = null)
    {
        $this->load->view('templates/header.php');
        $this->load->view('employee/add_employee', $data);
        $this->load->view('templates/footer_addEmployee');
    }
}