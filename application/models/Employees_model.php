<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employees_model extends CI_Model
{
    public $email;
    public $password;
    public $firstName;
    public $lastName;
    public $employee_status;

    public function __construct()
    {
        parent::__construct();
    }

    public function insert_employee()
    {
        $this->email = $this->input->post('email', true);
        $this->password = password_hash($this->input->post('password'),PASSWORD_DEFAULT);
        $this->firstName = $this->input->post('firstName', true);
        $this->lastName = $this->input->post('lastName', true);
        $this->employee_status = "active";

        $this->db->insert('employees', $this);
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
    
    public function verifyEmail($email){
        if(empty($email)){
            return null;
        }

        $employee = $this->getEmployee($email);

        if($employee == null){

            return false;
        }

        return true;
    }

    public function verifyPassword($email, $password)
    {
        $employee = $this->getEmployee($email);

        if($employee == null){
            return false;
        }

        if (password_verify($password, $employee->password)) {
            return true;
        } else {
            return false;
        }
    }

    public function getEmployee($email)
    {
        $employee = $this->db
            ->get_where('employees', array( 'email'=> $email))
            ->row();

        return $employee;
    }
}