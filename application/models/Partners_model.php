<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Partners_model extends CI_Model {
    public $email;
    public $password;
    public $firstName;
    public $lastName;
    public $company;
    public $last_activity;
    public $pending_request;
    public $partner_status;

    public function __construct()
    {
        parent::__construct();
    }

    public function insert_partner()
    {
        $this->email            = $this->input->post('email',true) ;
        $this->password         = password_hash($this->input->post('password'),PASSWORD_DEFAULT);
        $this->firstName        = $this->input->post('firstName',true);
        $this->lastName         = $this->input->post('lastName', true);
        $this->company          = $this->input->post('company', true);
        $this->last_activity    = date("Y-m-d H:i:s");
        $this->pending_request  = null;
        $this->partner_status   = "active";

        $this->db->insert('partners', $this);
    }

    public function verifyEmail($email){
        if(empty($email)){
            return null;
        }

        $partner = $this->getPartner($email);

        if($partner == null){

            return false;
        }

             return true;
    }

    public function verifyLoginCredentials($email, $password){
        if(empty($email) || empty($password)){
            return null;
        }
        $result = $this->verifyPassword($email, $password);

        if($result){

            return true;
        }
        return false;
    }

    public function verifyPassword($email, $password)
    {
        $partner = $this->getPartner($email);

        if($partner == null){
            return false;
        }

        if (password_verify($password, $partner->password)) {
                return true;
        } else {
            return false;
        }
    }

    public function getPartner($email)
    {
        $partner = $this->db
                        ->get_where('partners', array( 'email'=> $email))
                         ->row();
        
        return $partner;
    }
    public function updateLastActivity($partner_id){

        $query ="update `partners` SET `partners`.`last_activity` = (select now()) 
                  WHERE `partners`.`partner_id`='" . $partner_id ."'" ;

        $query = $this->db->query($query);

        $afftectedRows  = $this->db->affected_rows();

        if($afftectedRows == 1){

            return true;
        }

        return false;

    }

}