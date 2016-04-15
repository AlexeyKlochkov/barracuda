<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Programs_model extends CI_Model
{
    //fields in DB
    public $program_id;
    public $program_type;
    public $program_title;
    public $program_desc;
    public $program_status;


    public function __construct()
    {
        parent::__construct();
    }

    //Get program Id
    public function getProgramId($program_title)
    {
        $query = $this->db
            ->get_where( 'programs', array('program_title' => $program_title));


        if(($query->num_rows() > 1 || $query->num_rows() == 0)){
            return false;
        }

        foreach($query->row() as $key => $value){

            if($key == 'program_id' ){

                return $program_id = $value;
            }
        }

    }

    public function getRewardsProgramsCourses()
    {
       $query_str = "select `programs`.`program_id`,`programs`.`program_title`,
         `programs`.`program_type`,`programs`.`program_desc` ,
         `courses`.`course_title` as `title` from `programs` ,
         `program_rewards_courses`, `courses`
          where `program_rewards_courses`.`course_id` = `courses`.`course_id`
          and `programs`.`program_id` = `program_rewards_courses`.`program_id`";

        $query = $this->db->query($query_str);

        if($query->num_rows() > 0){

            return $query->result();
        }

        return false;
    }

    public function getRewardsProgramsProucts()
    {
        $query_str = "select `programs`.`program_id`,`programs`.`program_title`,
         `programs`.`program_type`,`programs`.`program_desc` ,
         `products`.`product_title` as `title` from `programs` ,
         `program_rewards_products`, `products`
          where `program_rewards_products`.`product_id` = `products`.`product_id`
          and `programs`.`program_id` = `program_rewards_products`.`program_id`";

        $query = $this->db->query($query_str);

        if($query->num_rows() > 0){

            return $query->result();
        }

        return false;
    }

    //create rewards program
    public function insert_prorgam()
    {
        $this->program_type    = $this->input->post('program_type', true);
        $this->program_title   = $this->input->post('program_title', true);
        $this->program_desc   = $this->input->post('program_desc', true);
        $this->program_status  = $this->input->post('program_status', true);

        $this->db->insert('programs', $this);
    }



}