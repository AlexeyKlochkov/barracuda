<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Partner_Page extends CI_Controller {


    public function index()
    {
        if($this->session->is_logged_in ){

            $this->load->model('programs_model');
            $this->load->model('courses_model');
            $this->load->model('products_model');

            //get courses and products json encoded
            $data['reward_courses'] = json_encode($this->courses_model->getCourses());
            $data['reward_products'] = json_encode($this->products_model->getProducts());



            //get the reward programs
            $courses =  $this->programs_model->getRewardsProgramsCourses();
            $product  = $this->programs_model->getRewardsProgramsProucts();

            //merge products and course programs
            $data['rewards_programs'] = json_encode(array_merge( $courses,$product ));

            //set fullname in session
            $data['fullName'] = $this->session->firstName." ".$this->session->lastName;
            $data['pending_request'] = $this->session->pending_request;
            $data['last_activity'] = date("F d Y" ,strtotime( $this->session->last_activity));

            $this->renderPage($data);

        }else{

            exit("You are not authorized <br> <a href='/'><b>HOME PAGE</b> </a> ");
        }

    }
    public function addRewardsCourse()
    {
        $this->load->model('partner_rewards_model');
        $this->load->model('programs_model');
        $this->load->model('partners_model');
        $this->load->model('partner_comments_model');
        $id = null;

           $partner = $this->partners_model->getPartner($this->session->username);
           $program_id = $this->programs_model->getProgramId($this->input->post('programSelector'));

         $courses         = $this->array_default_key($this->input->post('courseSel'));
         $rewards         = $this->array_default_key($this->input->post('programReward'));
         $complete_dates  = $this->array_default_key($this->input->post('date_completed'));
         $comments        = $this->input->post('comments');

        if(!empty($comments)){

               $comments_id = $this->partner_comments_model->insertComments(
                                                               $partner->partner_id,
                                                               $program_id,
                                                               $comments);
           }else{
            $comments_id = null;
        }

            for ($i = 0; $i < count($courses); $i++) {
                $this->partner_rewards_model->insert_training_courses(
                    $partner->partner_id,
                    $program_id,
                    $courses[$i],
                    $comments_id,
                    $rewards[$i],
                    $complete_dates[$i]
                );
            }
        
    }

    public function addRewardsProduct()
    {
        //APIs
        $this->load->model('partner_rewards_model');
        $this->load->model('programs_model');
        $this->load->model('partners_model');
        $this->load->model('partner_comments_model');


        $partner = $this->partners_model->getPartner($this->session->username);
        $program_id = $this->programs_model->getProgramId($this->input->post('programSelector'));

        $products        = $this->array_default_key($this->input->post('prodSel'));
        $rewards         = $this->array_default_key($this->input->post('programReward'));
        $complete_dates  = $this->array_default_key($this->input->post('date_completed'));
        $comments        = $this->input->post('comments');

        //add comments
        if(!empty($comments)){

            $comments_id = $this->partner_comments_model->insertComments($partner->partner_id, $program_id, $comments);

        } else{

            $comments_id = null;
        }

        for ($i = 0; $i < count($products); $i++)
        {
            $this->partner_rewards_model->insert_product_rewards(
                $partner->partner_id,
                $program_id,
                $products[$i],
                $comments_id,
                $rewards[$i],
                $complete_dates[$i]
            );
        }
        $this->partners_model->updateLastActivity($partner->partner_id);

        echo 'true';
    }

    public function getCoursesByRewardProgram($program)
    {
        //APIs
        $this->load->model('courses_model');
        $result = $this->courses_model->getCoursesByRewardName(urldecode($program));
        echo json_encode($result);

    }

    public function getProductsByRewardProgram($program)
    {
       // APIs
        $this->load->model('products_model');
        $result = $this->products_model->getProductsByRewardName(urldecode( $program));
        echo json_encode($result);

    }

    public function getPartnerRewardRequest($partner_id){
        //APIs
        $this->load->model('partner_rewards_model');
        $result = $this->partner_rewards_model->getPartnerRewardsBySum($partner_id);
        echo json_encode($result);

    }

    private function renderPage($data = null)
    {
        $this->load->view('templates/header.php');
        $this->load->view('partner/partner_page', $data);
        $this->load->view('templates/footer_partner_page');

    }


    function array_default_key($array) {
        $arrayTemp = array();
        $i = 0;
        foreach ($array as $key => $val) {
            $arrayTemp[$i] = $val;
            $i++;
        }
        return $arrayTemp;
    }

}