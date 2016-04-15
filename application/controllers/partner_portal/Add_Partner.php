<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Add_Partner extends CI_Controller {

    public function index(){

        $this->renderPage();
    }

    public function submit()
    {
        $this->load->database();
        $this->load->model('partners_model');

        if($this->partners_model->verifyEmail($this->input->post('email'))){

            echo  'Email address already exsist';

        } else {
            //add partner to DB
            $this->partners_model->insert_partner();

                //add session data
                $data = array(
                    'username' => $this->input->post('email'),
                    'is_logged_in' => true,
                    'firstName' => $this->input->post('firstName'),
                    'lastName' => $this->input->post('lastName'),
                    'partner_status' => $this->input->post('partner_status')
                );
                $this->session->set_userdata($data);

                echo 'correct';
        }
    }

    private function renderPage($data = null)
    {
        $this->load->view('templates/header.php');
        $this->load->view('partner/add_partner');
        $this->load->view('templates/footer_addPartner');

    }

}