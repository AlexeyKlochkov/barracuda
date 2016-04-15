<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Program_rewards_model extends CI_Model
{
    //fields in DB
    public $program_id;
    public $course_id;
    public $product_id;
    public $partner_id;
    public $reward_amount;


    function __construct()
    {
        parent::__construct();
    }


    public function insert_rewards_courses($program_id, $program_rewards, $course_selection)
    {
        $this->program_id = $program_id;

        //insert program into rewards table
        if(count($program_rewards) == count($course_selection)) {

            for ($i = 0; $i < count($program_rewards); ++$i) {

                $this->db->insert('program_rewards_courses', array(
                    "program_id" => $program_id,
                    "course_id" => $course_selection[$i],
                    "reward_amount" => $program_rewards[$i]));
            }

            return true;

        } else{

            return false;
        }

    }

    public function insert_rewards_products($program_id, $product_rewards, $product_selection)
    {
        $this->program_id = $program_id;


        //insert program into rewards table
        if(count($product_rewards) == count($product_selection)){

            for ($i = 0; $i < count($product_selection); ++$i) {

                $this->db->insert('program_rewards_products', array(
                    "program_id" => $program_id,
                    "product_id" => $product_selection[$i],
                    "reward_amount" => $product_rewards[$i]));
            }

            return true;

        } else{

            return false;
        }

    }

    public function getRewardsByProgramId($program_id ){

        $rewardProgram = $this->db->get_where('program_rewards', array('program_id' => $program_id));
        
    
    }


}