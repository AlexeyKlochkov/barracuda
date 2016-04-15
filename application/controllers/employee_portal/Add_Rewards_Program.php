<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Add_Rewards_Program extends CI_Controller {

    public function index()
    {
        $this->load->model('courses_model');
        $this->load->model('products_model');

        //get available courses and products;
        $data['courses'] = json_encode($this->courses_model->getCourses());
        $data['products'] = json_encode($this->products_model->getProducts());

        $this->renderPage($data);
    }

    public function addCourses()
    {
        //insert rewards program
        $this->load->model('programs_model');
        $this->programs_model->insert_prorgam();
        $program_id = $this->programs_model->getProgramId($this->input->post('program_title',true));

        $program_rewards = array();
        $course_selection = array();

        //get Post data
        $post_data = $this->input->post(NULL, TRUE);

        var_dump($post_data);

        //iterate over post vars pull out courses and rewards
        foreach ($post_data as $key => $value){

            if(strchr($key, "programReward") ){
                $program_rewards = $value ;
            }
            if(strchr($key, "courseSel")){
                $course_selection = $value;
            }
        }

        if($program_id){
            
            //insert rewards details
            $this->load->model('program_rewards_model');

            $result = $this->program_rewards_model->insert_rewards_courses($program_id, $program_rewards, $course_selection );


            if($result){
                echo "true";

            } else{

                echo "false";
            }
            
        }else{
            
            echo "false";

        }
    }

    public function addProducts ()
    {
        //insert product reward program
        $this->load->model('programs_model');
        $this->programs_model->insert_prorgam();
        $program_id = $this->programs_model->getProgramId($this->input->post('program_title',true));



        $program_rewards = array();
        $product_selection = array();

        //get Post data
        $post_data = $this->input->post(NULL, TRUE);


        //iterate over post vars pull out courses and rewards
        foreach ($post_data as $key => $value){

            if(strchr($key, "programReward") ){
                $program_rewards = $value;
            }
            if(strchr($key, "prodSel")){
                $product_selection = $value;
            }
        }

      if($program_id){

          //insert rewards details
          $this->load->model('program_rewards_model');
          

          $result = $this->program_rewards_model->insert_rewards_products($program_id, $program_rewards, $product_selection );
          

          if($result){
              echo "true";

          } else{

              echo "false";
          }

      }else{

          echo "false";

      }
      
    }



    private function renderPage($data = null)
    {
        $this->load->view('templates/header.php');
        $this->load->view('employee/add_rewards_program', $data);
        $this->load->view('templates/footer_rewards_program');
    }

}