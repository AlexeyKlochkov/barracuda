<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{

        $this->renderPage();
	}

	public function partnerLogin()
	{
		$this->load->database();
		$this->load->model('partners_model');

		$result = $this->partners_model->verifyLoginCredentials(
                                $this->input->post('email'),
                                $this->input->post('password'));

        //credentials verified
		if ($result) {
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

                $this->setPartnerSession($username);

                echo 'correct';

            }
        }
        // credentials not valid
        if(!$result) {

            echo "Your email address or password is not valid";
        }
	}

    private function renderPage()
    {
        $this->load->view('templates/header.php');
        $this->load->view('login');
        $this->load->view('templates/footer');
    }

    private function setPartnerSession($email){

        $this->load->model('partners_model');
        $partner = $this->partners_model->getPartner($email);

        $data = array(
            'username' => $email,
            'is_logged_in' => true,
            'firstName' => $partner->firstName,
            'lastName' => $partner->lastName,
            'partner_status' => $partner->partner_status,
            'pending_request' => $partner->pending_request,
            'last_activity' => $partner->last_activity
        );

        $this->session->set_userdata($data);
    }

}
