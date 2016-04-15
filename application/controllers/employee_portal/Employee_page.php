<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee_Page extends CI_Controller
{

    public function index()
    {
        if($this->session->is_logged_in && $this->session->employee_status == 'active' ){

            $data['fullName'] = $this->session->firstName." ".$this->session->lastName;
            
            $this->renderPage($data);

        }else{

            exit("You are not authorized");
            // redirect('unautorized', 500);
        }
    }

    
    private function renderPage($data = null)
    {
        $this->load->view('templates/header.php');
        $this->load->view('employee/employee_page', $data);
        $this->load->view('templates/footer');

    }

}