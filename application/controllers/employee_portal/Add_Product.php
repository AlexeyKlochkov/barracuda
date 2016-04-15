<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*****
 * Employee add @Product controller
 * @Add : adds product to DB
 * @render : renders page
 * @Returns Ajax response
 * 
 */

class Add_Product extends CI_Controller {

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
        $this->load->model('products_model');

        if($this->products_model->findProduct($this->input->post('product_title')) != null){

            echo 'false';

        } else{

            $this->products_model->insert_product();

            echo "true";
        }
    }


    private function renderPage()
    {
        $this->load->view('templates/header.php');
        $this->load->view('employee/add_product');
        $this->load->view('templates/footer_product');
    }
    
}