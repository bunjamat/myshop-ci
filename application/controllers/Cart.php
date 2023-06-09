<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cart extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        // Load cart library
        $this->load->library('cart');
        $this->load->library('user_agent'); // ใช้งาน user agent เพื่อลิ้งค์กลับหน้าเดิมที่กดเข้ามา
        $this->load->helper('cookie');
    }

    public function index()
    {


        $data = array();
        // $data['booking'] = array();
        $data['title'] = "ตระกร้าสินค้า";

        // $booking = explode(",", $this->input->cookie('booking_order', true));
        // $data['bookDate'] = $booking[1];
        // $data['bookTime'] = $booking[2];
        // $data['booking'] = $this->db->get_where('tb_table', array('ta_id' => $booking[0]))->row_array();
        foreach ($this->cart->contents() as  $value) {

            if ($value['qty'] > $value['stock']) {

                $dataUpdate = array(
                    'rowid' => $value['rowid'],
                    'qty' => $value['stock'],
                );

                $this->cart->update($dataUpdate);
            }
        }




        // Retrieve cart data from the session
        $data['cartItems'] = $this->cart->contents();

        // // Load the cart view
        $this->load->view('templateuser/header', $data);
        $this->load->view('cart_view', $data);
    }

    public function updateItemQty()
    {
        $update = 0;
        // Get cart item info
        $rowid = $this->input->get('rowid');
        $qty = $this->input->get('qty');

        // Update item in the cart
        if (!empty($rowid) && !empty($qty)) {
            $data = array(
                'rowid' => $rowid,
                'qty' => $qty,
            );
            $update = $this->cart->update($data);
        }

        // Return response
        echo $update ? 'ok' : 'err';
    }

    public function removeItem()
    {

        $rowid = $this->input->get('rowid');

        // Remove item from cart
        $remove = $this->cart->remove($rowid);

        // Return response
        echo $remove ? 'ok' : 'err';
    }
}
