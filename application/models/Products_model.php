<?php
/**
 * Created by PhpStorm.
 * User: bobby
 * Date: 3/22/16
 * Time: 10:08 PM
 */
class Products_model extends CI_Model {

    public $product_title;
    public $product_status;

    public function __construct()
    {
        parent::__construct();
    }

    public function insert_product()
    {
        $this->product_title    = $this->input->post('product_title',true);
        $this->product_status   = $this->input->post('product_status', true);

        $this->db->insert('products', $this);
    }

    public function findProduct($product_title)
    {
        $product = $this->db
            ->get_where('products', array( 'product_title'=> $product_title))
            ->row();

        return $product;

    }
    public function getProducts(){
        $query = $this->db->get_where('products', array('product_status' => 'active'));

        if ($query->num_rows() > 0) {
            return  $query->result();

        }

    }

    public function getProductsByRewardName($reward_name)
    {
        echo $reward_name;
        
        $query = "Select `products`.`product_id`,`products`.`product_title`,`products`.`reward_amount` from `products` JOIN 
                  `program_rewards_products` ON `program_rewards_products`.`product_id` = `products`.`product_id`
                   JOIN  `programs` ON `program_rewards_products`.`program_id` = `programs`.`program_id`
                    where `programs`.`program_title` ='" . $reward_name ."'" ;
        $query = $this->db->query($query);

        if($query->num_rows() > 0){

            return $query->result();
        }

        return false;
    }

    public function getProductsRewardPlans()
    {
      $query = " SELECT `products`.`product_id`,`products`.`product_title`,`programs`.`program_id`, `programs`.`program_title`,
        `programs`.`program_type` from `products` JOIN `program_rewards_products`on 
        `products`.`product_id`= `program_rewards_products`.`product_id` JOIN `programs` on 
        `program_rewards_products`.`program_id` = `programs`.`program_id` 
        GROUP BY `products`.`product_title`";
    }


}