<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Checkout extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('product');
        // Load cart library
        $this->load->library('cart');
        $this->load->library('user_agent'); // ใช้งาน user agent เพื่อลิ้งค์กลับหน้าเดิมที่กดเข้ามา
        $this->load->helper('cookie');
        $this->load->library('upload');
        $this->load->helper('file');

        if ($this->session->userdata('logged_in') !== true) {
            redirect('users/authen');
        }
    }

    public function index()
    {
        $data = array();
        $data['booking'] = array();
        $data['title'] = "ยืนยันการสั่งซื้อและชำระเงิน";

        // Retrieve cart data from the session
        $data['cartItems'] = $this->cart->contents();

        /* if ($this->input->cookie('booking_order', true)) {
            $booking = explode(",", $this->input->cookie('booking_order', true));
            $data['bookDate'] = $booking[1];
            $data['bookTime'] = $booking[2];
            $data['booking'] = $this->db->get_where('tb_table', array('ta_id' => $booking[0]))->row_array();
        } */
        $userID = $this->session->userdata('user_id');
        // echo $userID;
        $data['user'] = $this->db->get_where('users', array('us_id' => $userID))->row_array();

        // print_r($data['user']);

        // Load the cart view
        $this->load->view('templateuser/header', $data);
        $this->load->view('checkout_view', $data);
    }
    public function placeOrder()
    {
        if ($post = $this->input->post()) {
            extract($post);
            if (isset($_FILES['upload']['name']) && $_FILES['upload']['name'] != "") {

                $fnameImg = "slip-" . date("dmYHis");
                $config['upload_path'] = 'uploads/slip';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = 4096;
                // $config['max_width'] = 1024;
                // $config['max_height'] = 768;
                $config['file_name'] = $fnameImg; // ชื่อไฟล์ ถ้าไม่กำหนดจะเป็นตามชื่อเพิม

                $this->upload->initialize($config); // เรียกใช้การตั้งค่า
                if (!$this->upload->do_upload('upload')) {
                    $res = $this->upload->display_errors();
                } else {
                    $dataPic = $this->upload->data();
                    $name_new = $dataPic['orig_name'];


                    // insert user
                    $userData = array(
                        'us_fname' => $fname,
                        'us_lname' => $lname,
                        'us_email' => $email,
                        'us_address' => $address,
                        'us_phone' => $phone,
                    );
                    $updateUser = $this->product->updateUser($userData);

                    //ข้อมูลการสั่งซื้อ
                    $grandTotal = 0;
                    if ($payment == 2) {
                        $grandTotal += $this->cart->total() / 2;
                    } else {
                        $grandTotal += $this->cart->total();
                    }

                    // Insert order data
                    $ordData = array(
                        'user_id' => $this->session->userdata('user_id'),
                        'order_grandtotal' => $grandTotal,
                        'order_paymentslip' => $name_new,
                        'order_payment' => $payment,
                        'order_shipping' => $shipping,
                        'order_fname' => $fname,
                        'order_lname' => $lname,
                        'order_phone' => $phone,
                        'order_address' => $address,
                        'order_email' => $email,

                    );

                    $insertOrder = $this->product->insertOrder($ordData);

                    if ($insertOrder) {

                        // $object = array(
                        //     'ta_status' => 1
                        // );
                        // $this->db->where('ta_id', $bookID);
                        // $update_table = $this->db->update('tb_table', $object);


                        // Retrieve cart data from the session
                        $cartItems = $this->cart->contents();

                        if (!empty($cartItems)) {
                            // Cart items
                            $ordItemData = array();
                            $i = 0;
                            foreach ($cartItems as $item) {
                                $ordItemData[$i]['order_id'] = $insertOrder;
                                $ordItemData[$i]['product_id'] = $item['id'];
                                $ordItemData[$i]['quantity'] = $item['qty'];
                                $ordItemData[$i]['sub_total'] = $item["subtotal"];
                                $i++;
                            }
                            if (!empty($ordItemData)) {
                                // Insert order items
                                $insertOrderItems = $this->product->insertOrderItems($ordItemData);

                                if ($insertOrderItems) {
                                    // Remove items from the cart
                                    $this->cart->destroy();
                                    // Return
                                    $res = 200;
                                    // return $insertOrder;
                                }
                            }
                        } else {
                            //ลบการจองโต๊ะ
                            delete_cookie('booking_order');
                            $res = 200;
                        }
                    }
                }
                echo $res;
            } else {
                $res = 404;
                echo $res;
            }
        }
    }
}
