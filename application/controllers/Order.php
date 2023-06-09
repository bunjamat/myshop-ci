<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Order extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('product');
        $this->load->helper('cookie');
        $this->load->library('cart'); // Load cart library
        $this->load->library('user_agent'); // ใช้งาน user agent เพื่อลิ้งค์กลับหน้าเดิมที่กดเข้ามา

        if ($this->session->userdata('logged_in') !== true) {
            redirect('users/authen');
        }

    }

    public function index()
    {

       /*  $data['title'] = "Shop name";
        $data['booking'] = array();
        $data['table'] = $this->db->get('tb_table')->result_array();

        if ($this->input->cookie('booking_order', true)) {

            $booking = explode(",", $this->input->cookie('booking_order', true));
            $data['bookDate'] = $booking[1];
            $data['bookTime'] = $booking[2];
            $data['booking'] = $this->db->get_where('tb_table', array('ta_id' => $booking[0]))->row_array();
        }
        // Pass the user data and load view
        $this->load->view('templateuser/header', $data);
        $this->load->view('table_booking_view', $data); */

    }
    public function saveBooking()
    {
        if ($post = $this->input->post()) {
            extract($post);
            $val = $tbID . ',' . $tb_bookDate . ',' . $tb_booktime;
            $cookie = array(
                'name' => 'booking_order',
                'value' => $val,
                'expire' => '86500',
                'path' => '/',
            );
            $this->input->set_cookie($cookie);
            $callback = array(
                'status' => 200,
                'msg' => 'บันทึกการจองโต๊ะเรียบร้อย กรุณาสั่งอาหารและชำระเงินภายใน 5 นาที',
            );
            echo json_encode($callback);
        }
    }
    public function menu()
    {
        $data['title'] = "Shop name";
        $data['food_menu'] = $this->db->get('tb_food')->result_array();
        $data['food_type'] = $this->db->get('master_typefood')->result_array();

        // Pass the user data and load view
        $this->load->view('templateuser/header', $data);
        $this->load->view('food_menu_view', $data);
    }
    public function getFood($ID)
    {
        $table = $this->getRows($ID);
        $data = array(
            'food_id' => $table['food_id'],
            'food_name' => $table['food_name'],
            'food_price' => $table['food_price'],
            'food_status' => $table['food_status'],
            'food_img' => $table['food_img'],
        );
        echo json_encode($data);
    }
    public function getTable($ID)
    {
        $table = $this->getRowsTB($ID);
        $data = array(
            'ta_id' => $table['ta_id'],
            'ta_name' => $table['ta_name'],
            'ta_num' => $table['ta_num'],
            'ta_status' => $table['ta_status'],
        );
        echo json_encode($data);
    }



    public function getRows($id = '')
    {
        $this->db->select('*');
        $this->db->from('tb_food');
        // $this->db->where('pro_status', '1');
        if ($id) {
            $this->db->where('food_id', $id);
            $query = $this->db->get();
            $result = $query->row_array();
        } else {
            $this->db->order_by('product_name', 'asc');
            $query = $this->db->get();
            $result = $query->result_array();
        }
        // Return fetched data
        return !empty($result) ? $result : false;
    }

    public function getRowsTB($id = '')
    {
        $this->db->select('*');
        $this->db->from('tb_table');
        // $this->db->where('pro_status', '1');
        if ($id) {
            $this->db->where('ta_id', $id);
            $query = $this->db->get();
            $result = $query->row_array();
        } else {
            $this->db->order_by('ta_name', 'asc');
            $query = $this->db->get();
            $result = $query->result_array();
        }
        // Return fetched data
        return !empty($result) ? $result : false;
    }

    public function delete()
    {
        // Remove items from the cart
        $this->cart->destroy();
        // ลบ session ทั้งหมด
        $this->session->sess_destroy();
    }

    public function tracking()
    {
        $data['title'] = "รายการสั่งซื้อทั้งหมด";

        // Pass the user data and load view
        $this->load->view('templateuser/header', $data);
        $this->load->view('users/user_order_view', $data);
    }

    public function orderDetail($id='')
    {
        $data['title'] = "รายการสั่งซื้อ";

        if ($id == '') {
            redirect('booking/tracking','location');
        }
        $data['orderDetail'] = $this->product->getOrder($id);

        // print_r($data['orderDetail']);

        // Pass the user data and load view
        $this->load->view('templateuser/header', $data);
        $this->load->view('users/order_detail_view', $data);
        
        

    }

}
