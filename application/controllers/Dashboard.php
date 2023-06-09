<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        // if ($this->session->userdata('admin_logged_in') !== true) {
        //     redirect('admin/authen');
        // }


    }

    public function index()
    {
        // echo "สวัสดี thongchai bunjamat";
        $data['title'] = 'Dashboard';

        // $data['users'] = $this->db->get_where('users', array('us_role' => 1))->num_rows();
        // $data['products'] = $this->db->get('products')->num_rows();
        // $data['orders'] = $this->db->get_where('orders', array('order_approve' => 0))->num_rows();
        // $this->db->select("date_format(order_create, '%M') as month,sum(order_grandtotal) as sum");
        // $this->db->where('order_approve', 1);

        // $this->db->group_by("date_format(order_create, '%M')");
        // $this->db->order_by("date_format(order_create, '%M') DESC",  FALSE);
        // $data['total'] = $this->db->get('orders')->row_array();

        $data['users'] = 0;
        $data['products'] = 0;
        $data['orders'] = 0;
        $data['total'] = 0;


        $this->load->view('templateuser/header'); //ส่วนหัว
        $this->load->view('dashboard_view', $data);
    }
}
