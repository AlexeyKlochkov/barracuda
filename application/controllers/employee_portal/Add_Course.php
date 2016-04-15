<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*****
 * Employee add @Course controller
 * @Add : adds course to DB
 * @render : renders page
 * @Returns Ajax response
 *
 */

class Add_Course extends CI_Controller {

    public function index()
    {
        if($this->session->is_logged_in && $this->session->employee_status == 'active' ){

            $this->renderPage();

        }else{

            exit("You are not authorized");
            // redirect('unautorized', 500);
        }
    }

    public function add(){

        $this->load->database();
        $this->load->model('courses_model');

        if($this->courses_model->findCourse($this->input->post('course_title')) != null){

            echo 'false';

        } else{

            $this->courses_model->insert_course();

            echo "true";
        }
    }


    private function renderPage($data = null)
    {
        $this->load->view('templates/header.php');
        $this->load->view('employee/add_course', $data);
        $this->load->view('templates/footer_course');
    }

}