<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Shop extends CI_Controller
{

    public function index()
    {

        $data['title'] = "Shop name | สินค้าทั้งหมด";
        // Pass the user data and load view

        $data['category'] = $this->db->get('category')->result_array();
        $data['products'] = $this->db->get('products')->result_array();
        
        $this->load->view('templateuser/header', $data);
        $this->load->view('shop_view', $data);
        $this->load->view('templateuser/footer', $data);

    }

}
