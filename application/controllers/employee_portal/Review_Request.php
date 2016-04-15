<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Review_Request extends CI_Controller {

    public function index()
    {
        $this->renderPage();
    }

    public function reviewPartnerRequest(){
        //APIs
        $this->load->model('partner_rewards_model');
        $result = $this->partner_rewards_model->getPartnerRequest();
        echo json_encode($result);

    }

    private function renderPage($data = null)
    {
        $this->load->view('templates/header.php');
        $this->load->view('employee/review_request', $data);
        $this->load->view('templates/footer_review_request');
    }

}