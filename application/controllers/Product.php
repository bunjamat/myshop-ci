<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        /*  if ($this->session->userdata('logged_in') !== true) {
            redirect('authen');
        } */
    }

    public function index()
    {

        /*  $data['title'] = "Shop name | สินค้าทั้งหมด";
        // Pass the user data and load view

        $data['category'] = $this->db->get('category')->result_array();
        $data['products'] = $this->db->get('products')->result_array();
        
        $this->load->view('user_elements/header', $data);
        $this->load->view('shop_view', $data);
        $this->load->view('user_elements/footer', $data); */
    }
    public function getProduct($ID)
    {
        $product = $this->getRows($ID);

        $html = '
        <div class="product-images">
            <div class="main-image images">
                <img alt="big images" src="uploads/product/' . $product['product_img'] . '">
            </div>
        </div>

        <div class="product-info">
            <h1>' . $product['product_name'] . '</h1>';
        if ($product['product_sale_price'] > 0) {
            $html .= '<div class="price-box-3">
                <div class="s-price-box">
                    <span class="new-price">฿' . number_format($product['product_sale_price']) . '.-</span>
                    <span class="old-price">฿' . number_format($product['product_price']) . '.-</span>
                </div>
            </div>';
        } else {
            $html .= ' <div class="price-box-3">
                <div class="s-price-box">
                    <span class="new-price">฿' . number_format($product['product_price']) . '.-</span>
                </div>
            </div>';
        }

        $html .= '<div class="select__size">
        <h2>สินค้าคงเหลือ</h2>
        <ul class="color__list">
            <li class="l__size"><a title="L" href="javascript:void(0)">'.$product['stock'].'</a></li>
           
        </ul>
            </div>
                    <div class="quick-desc">
                    ' . $product['description'] . '
                    </div>
                    <div class="quantity-input">
                    <div class="input-group">
                    <span class="input-group-btn">
                        <button type="button" class="quantity-left-minus btn btn-default btn-number"  data-type="minus" data-field="">
                        <span class="glyphicon glyphicon-minus"></span>
                        </button>
                    </span>
                    <input type="text" id="quantity" name="quantity" class="form-control input-number text-center" value="1" min="1" max="100">
                    <span class="input-group-btn">
                        <button type="button" class="quantity-right-plus btn btn-default btn-number" data-type="plus" data-field="">
                            <span class="glyphicon glyphicon-plus"></span>
                        </button>
                    </span>
                </div>
                    </div>
                    <div class="addtocart-btn">
                        <a href="javasctipt:void(0)" onclick="addcart(' . $product['product_id'] . ','.$product['stock'] .')">เพิ่มลงตระกร้า</a>
                    </div>
                </div>
                <script>var quantitiy = 0;
                $(".quantity-right-plus").click(function(e) {
                    e.preventDefault();
                
                
                    var quantity = parseInt($("#quantity").val());
                    
                    if(quantity + 1 > ' . $product['stock'] . '){
                        Swal.fire({
                            title: "แจ้งเตือน!",
                            text: "ไม่สามารถสั่งเกินสต็อกสินค้าได้",
                            icon: "error",
                            confirmButtonColor: "#304ffe"
                        });

                        return false;
                    }
                    $("#quantity").val(quantity + 1)
                    
                });

                $(".quantity-left-minus").click(function(e) {
                    e.preventDefault();
                    var quantity = parseInt($("#quantity").val());
                    if (quantity > 1) {
                        $("#quantity").val(quantity - 1);
                    }
                });</script>';
                $data = array(
                    'html' => $html
        );
        echo json_encode($data);
    }

    public function addToCart($proID)
    {
        header('content-type:text/html;charset=utf-8');
        // Fetch specific product by ID
        $qty = $this->input->post("qty");
        $stock = $this->input->post("stock");
        $product = $this->getRows($proID);
        $newPrice = ($product['product_sale_price']) ? $product['product_sale_price'] : $product['product_price'];

        // Add product to the cart
        $data = array(
            'id' => $product['product_id'],
            'qty' => $qty,
            'price' => $newPrice,
            'name' => $product['product_name'],
            'image' => $product['product_img'],
            'stock' =>  $stock
        );

        if ($this->cart->insert($data)) {
            $data['status'] = 200;
            $data['msg'] = "เพิ่มในรายการสั่งซื้อเรียบร้อย";
            $data['sumQty'] = $this->cart->total_items();
            echo json_encode($data);
        } else {
            $data['status'] = 500;
            $data['msg'] = "เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้ง";
            $data['sumQty'] = $this->cart->total_items();
            echo json_encode($data);
        }
        // $this->cart->insert($data);

        // Redirect to the cart page
        // redirect('cart/');
    }

    public function getRows($id = '')
    {
        $this->db->select('*');
        $this->db->from('products');
        // $this->db->where('pro_status', '1');
        if ($id) {
            $this->db->where('product_id', $id);
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
}
