<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Controller {

    public function index()
    {
        $this->renderPage();
    }

    public function employeeLogin()
    {
        $this->load->model('employees_model');

        $result = $this->employees_model->verifyLoginCredentials(
                                            $this->input->post('email'),
                                            $this->input->post('password'));
        //credentials verified
        if($result) {
            $username = $this->input->post('email');

            //verify session is set
            if (isset($_SESSION['username'])) {

                if ($this->session->is_logged_in) {

                    //send ajax acknowledgement
                    echo 'correct';

                } else {

                    $this->session->is_logged_in = true;
                }
            }else{ //session not set find user andset it

                $this->setEmployeeSession($username);

                echo 'correct';

            }
        }
        // credentials not valid
        if(!$result) {

            echo "Your email address or password is not valid";
        }

    }

    private function renderPage($data = null)
    {
        $this->load->view('templates/header.php');
        $this->load->view('employee_login', $data);
        $this->load->view('templates/footer_employee_login');
    }

    private function setEmployeeSession($email){

        $this->load->model('employees_model');
        $employee = $this->employees_model->getEmployee($email);

        $data = array(
            'username' => $email,
            'is_logged_in' => true,
            'firstName' => $employee->firstName,
            'lastName' => $employee->lastName,
            'employee_status' => $employee->employee_status
        );
        $this->session->set_userdata($data);
    }


}