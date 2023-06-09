<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Manage extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->library('upload'); //upload file
        $this->load->helper('file'); //จัดการที่อยู่ไฟล์
        $this->load->model('product');

        //ถ้าไม่ login จะไม่สามารถเข้าหน้านี้ได้ 
        if ($this->session->userdata('admin_logged_in') !== true) {
            redirect('admin/authen');
        }
    }

    public function index()
    {
        // echo "สวัสดี thongchai bunjamat";
        $data = array();
        $data['title'] = "จัดการหมวดหมู่สินค้า";
        $data['lastname'] = "bunjamat";
        $this->load->view('themplate/header', $data); //ส่วนหัว
        $this->load->view('admin/manage_category_view');
    }

    /* CATEGORY */
    public function category()
    {
        $data['title'] = "จัดการหมวดหมู่สินค้า";
        // Pass the user data and load view
        $this->load->view('themplate/header', $data);
        $this->load->view('admin/manage_category_view', $data);
    }
    public function addCategory()
    {
        if ($post = $this->input->post()) {
            extract($post);

            //เช็คว่า
            $this->db->like('type_name', $categoryName);
            $checkDuplicate = $this->db->get('category')->num_rows();

            if ($checkDuplicate > 0) {
                $callback = array(
                    'status' => 400,
                    'msg' => 'หมวดหมู่นี้มีในระบบแล้ว',
                );
            } else {

                $object = array(
                    'type_name' => $categoryName,
                    'type_status' => $categoryStatus,
                );
                $insert = $this->db->insert('category', $object);

                if ($insert) {
                    $callback = array(
                        'status' => 200,
                        'msg' => 'เพิ่มหมวดหมู่สินค้าเรียบร้อย',
                    );
                } else {
                    $callback = array(
                        'status' => 500,
                        'msg' => 'เกิดข้อผิดพลาด ไม่สามารถเพิ่มหมวดหมู่สินค้าได้',
                    );
                }
            }

            echo json_encode($callback);
        }
    }
    public function updateCategory()
    {
        if ($post = $this->input->post()) {
            extract($post);

            $object = array(
                "type_name" => $editCategoryName,
                "type_status" => $editCategoryStatus,
            );

            $this->db->where('type_id', $id);
            $update = $this->db->update('category', $object);


            if ($update) {
                $callback = array(
                    "status" => 200,
                    'msg' => 'อัพเดตหมวดหมู่สินค้าเรียบร้อย',
                );
            } else {
                $callback = array(
                    "status" => 500,
                    'msg' => 'เกิดข้อผิดพลาด กรุณาลองใหม่ภายหลัง',
                );
            }

            echo json_encode($callback);
        }
    }
    public function delCategory()
    {

        if ($post = $this->input->post()) {
            extract($post);

            $delete = $this->db->delete('category', array('type_id' => $id));
            if ($delete) {
                echo 200;
            } else {
                echo 500;
            }
        }
    }
    public function getCategory()
    {
        $id = $this->input->post('id');

        $this->db->where('type_id', (int)$id);
        $result = $this->db->get('category')->row_array();

        $html = '';
        $status0 = '';
        $status1 = '';

        if ($result['type_status'] == 1) {
            $status1 = 'selected';
        } else {
            $status0 = 'selected';
        }
        // print_r($result);

        $html .= '<div class="modal-header">
		<h5 class="modal-title" id="updatefoodModalLabel">แก้ไขรายละเอียด</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
        </div>
        <div class="modal-body">
            <form>
                <div class="form-group">
                    <label for="editCategoryName" class="col-form-label">ชื่อรายการ: <font style="color:red">*</font></label>
                    <input type="text" name="editCategoryName" class="form-control mb-2 mr-sm-2 w-100"
                        placeholder="กรอกชื่อรายการ" id="editCategoryName" value="' . $result['type_name'] . '" required>
                </div>

                <div class="form-group">
                <label for="sel1">สถานะ</label>
                <select class="form-control" id="editCategoryStatus">
                    <option value="1" ' . $status1 . '>ใช้งาน</option>
                    <option value="0" ' . $status0 . '>ปิดใช้งาน</option>
                </select>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
            <button type="button" class="btn btn-primary" onclick="updateCategory(\'' . $id . '\')" >บันทึกการเปลี่ยนแปลง</button>
        </div>';

        echo $html;
    }


    /* PRODUCTS */
    public function product()
    {
        $data['title'] = "จัดการสินค้า";

        $data['category'] = $this->db->get('category')->result_array();

        // Pass the user data and load view
        $this->load->view('themplate/header', $data);
        $this->load->view('admin/manage_product_view', $data);
    }


    public function addProduct()
    {
        if ($post = $this->input->post()) {
            extract($post);
            $this->db->like('product_name', $productName);
            $checkDuplicate = $this->db->get('products')->num_rows();
            if ($checkDuplicate > 0) {
                $callback = array(
                    'status' => 400,
                    'msg' => 'รายการนี้มีในระบบแล้ว',
                );
            } else {

                if (isset($_FILES['upload']['name']) && $_FILES['upload']['name'] != "") {
                    $fname = "product-" . date("dmYHis");
                    $config['upload_path'] = 'uploads/product/';
                    $config['allowed_types'] = 'gif|jpg|png|webp'; //นามสกุลรูปภาพที่อนุญาตให้ upload
                    $config['max_size'] = 4096;
                    // $config['max_width'] = 1024;
                    // $config['max_height'] = 768;
                    $config['file_name'] = $fname; // ชื่อไฟล์ ถ้าไม่กำหนดจะเป็นตามชื่อเพิม

                    $this->upload->initialize($config); // เรียกใช้การตั้งค่า
                    if (!$this->upload->do_upload('upload')) {
                        $callback = array(
                            'status' => 500,
                            'msg' => $this->upload->display_errors(),
                        );
                    } else {
                        $dataPic = $this->upload->data();
                        $name_new = $dataPic['orig_name'];

                        $object = array(
                            'product_name' => $productName,
                            'description' => $description,
                            'product_price' => $productPrice,
                            'product_sale_price' => $productSalePrice,
                            'product_status' => 1,
                            'product_img' => $name_new,
                            'category' => $productCategory,
                            'stock' => $productStock,
                        );
                        $insert = $this->db->insert('products', $object);

                        if ($insert) {
                            $callback = array(
                                'status' => 200,
                                'msg' => 'เพิ่มสินค้าเรียบร้อย',
                            );
                        } else {
                            $callback = array(
                                'status' => 500,
                                'msg' => 'เกิดข้อผิดพลาด ไม่สามารถเพิ่มสินค้าได้',
                            );
                        }
                    }
                }
            }

            echo json_encode($callback);
        }
    }
    public function updateProduct()
    {
        if ($post = $this->input->post()) {
            extract($post);
            $this->db->where('product_id !=', $productID);
            $this->db->where('product_name', $editProductName);
            $checkDuplicate = $this->db->get('products')->num_rows();
            if ($checkDuplicate > 0) {
                $callback = array(
                    'status' => 400,
                    'msg' => 'รายการนี้มีในระบบแล้ว',
                );
            } else {

                if (isset($_FILES['editupload']['name']) && $_FILES['editupload']['name'] != "") {
                    $fname = "product-" . date("dmYHis");
                    $config['upload_path'] = 'uploads/product/';
                    $config['allowed_types'] = 'gif|jpg|png|webp'; //นามสกุลรูปภาพที่อนุญาตให้ upload
                    $config['max_size'] = 4096;
                    // $config['max_width'] = 1024;
                    // $config['max_height'] = 768;
                    $config['file_name'] = $fname; // ชื่อไฟล์ ถ้าไม่กำหนดจะเป็นตามชื่อเพิม

                    $this->upload->initialize($config); // เรียกใช้การตั้งค่า
                    if (!$this->upload->do_upload('editupload')) {
                        $callback = array(
                            'status' => 500,
                            'msg' => $this->upload->display_errors(),
                        );
                    } else {
                        $dataPic = $this->upload->data();
                        $name_new = $dataPic['orig_name'];

                        $object = array(

                            'product_name' => $editProductName,
                            'description' => $editDescription,
                            'product_price' => $editProductPrice,
                            'product_sale_price' => $editProductSalePrice,
                            'product_status' => $editProductStatus,
                            'product_img' => $name_new,
                            'category' => $editProductCategory,
                            'stock' => $editProductStock,
                        );
                        $this->db->where('product_id', $productID);
                        $update = $this->db->update('products', $object);

                        if ($update) {
                            $callback = array(
                                'status' => 200,
                                'msg' => 'อัพเดตสินค้าเรียบร้อย',
                            );
                        } else {
                            $callback = array(
                                'status' => 500,
                                'msg' => 'เกิดข้อผิดพลาด ไม่สามารถเพิ่มสินค้าได้',
                            );
                        }
                    }
                } else {

                    $object = array(

                        'product_name' => $editProductName,
                        'description' => $editDescription,
                        'product_price' => $editProductPrice,
                        'product_sale_price' => $editProductSalePrice,
                        'product_status' => $editProductStatus,
                        'category' => $editProductCategory,
                        'stock' => $editProductStock,
                    );
                    $this->db->where('product_id', $productID);
                    $update = $this->db->update('products', $object);

                    if ($update) {
                        $callback = array(
                            'status' => 200,
                            'msg' => 'อัพเดตสินค้าเรียบร้อย',
                        );
                    } else {
                        $callback = array(
                            'status' => 500,
                            'msg' => 'เกิดข้อผิดพลาด ไม่สามารถอัพเดตสินค้าได้',
                        );
                    }
                }
            }

            echo json_encode($callback);
        }
    }
    public function delProduct()
    {

        if ($post = $this->input->post()) {
            extract($post);

            $delete = $this->db->delete('products', array('product_id' => $id));
            if ($delete) {
                echo 200;
            } else {
                echo 500;
            }
        }
    }
    public function getProduct()
    {
        $id = $this->input->post('id');

        $this->db->where('product_id', $id);
        $result = $this->db->get('products')->row_array();
        $category = $this->db->get('category')->result_array();

        $html = '';
        $status0 = '';
        $status1 = '';
        if ($result['product_status'] == 1) {
            $status1 = 'selected';
        } else {
            $status0 = 'selected';
        }

        $html .= '<div class="modal-header">
		<h5 class="modal-title" id="updateProductModalLabel">แก้ไขรายละเอียด</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
        </div>
        <form name="updateProduct" id="form-updateProduct" >
        <div class="modal-body">

                <div class="form-group">
                    <label for="editProductName" class="col-form-label">ชื่อรายการ: <font style="color:red">*</font></label>
                    <input type="text" name="editProductName" class="form-control mb-2 mr-sm-2 w-100"
                        placeholder="กรอกชื่อรายการ" id="editProductName" value="' . $result['product_name'] . '" required>
                </div>
                <div class="form-group">
                    <label for="editProductPrice" class="col-form-label">ราคาสินค้า:</label>
                    <input type="number" name="editProductPrice" class="form-control mb-2 mr-sm-2 w-100"
                        placeholder="กรอกราคาสินค้า" id="editProductPrice" value="' . $result['product_price'] . '">
                </div>
                <div class="form-group">
                    <label for="editProductSalePrice" class="col-form-label">ราคาโปรโมชั่น:</label>
                    <input type="number" name="editProductSalePrice" class="form-control mb-2 mr-sm-2 w-100"
                        placeholder="กรอกราคาสินค้า" id="editProductPrice" value="' . $result['product_sale_price'] . '">
                </div>
                <div class="form-group">
                <label for="editProductStatus">สถานะ</label>
                <select class="form-control" name="editProductStatus" id="editProductStatus">
                    <option value="1" ' . $status1 . '>มีสินค้า</option>
                    <option value="0" ' . $status0 . '>สินค้าหมด</option>
                </select>
                </div>
                <div class="form-group">
                    <label for="editProductSalePrice" class="col-form-label">สต็อกสินค้า:</label>
                    <input type="number" name="editProductStock" class="form-control mb-2 mr-sm-2 w-100"
                        placeholder="กรอกสต็อกสินค้า" id="editProductStock" value="' . $result['stock'] . '">
                </div>
                <div class="form-group">
                <label for="editProductCategory" class="col-form-label">หมวดหมู่สินค้า:</label>
                <select class="form-control" name="editProductCategory" id="editProductCategory">';

        foreach ($category as  $value) {
            if ($value['type_id'] == $result['category']) {
                $selected = ' selected';
            } else {
                $selected = '';
            }

            $html .= '<option value="' . $value['type_id'] . '" ' . $selected . '>' . $value['type_name'] . '</option>';
        }


        $html .= '</select>
                </div>
                <div class="form-group mt-2">
                <label for="description">รายละเอียดสินค้า</label>
                <textarea name="editDescription" class="form-control" id="editDescription" rows="3">' . $result['description'] . '</textarea>
            </div>
                <div class="form-group">
                <label for="editupload">(อัพโหลดรูปภาพหากต้องการเปลี่ยน)</label>
                <div class="custom-file">
                        <input type="file" name="editupload" class="custom-file-input" id="customFile">
                        <label class="custom-file-label" for="customFile">อัพโหลดรูปภาพ (เปลี่ยนรูปภาพ)</label>
                    </div>
                </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
            <button type="button" class="btn btn-primary" onclick="updateProductEdit(' . $id . ')" >บันทึกการเปลี่ยนแปลง</button>
        </div></form>';

        echo $html;
    }

    /* user */
    public function delUser()
    {

        if ($post = $this->input->post()) {
            extract($post);

            $delete = $this->db->delete('users', array('us_id' => $id));
            if ($delete) {
                echo 200;
            } else {
                echo 500;
            }
        }
    }
    public function user()
    {
        $data['title'] = "จัดการหมวดหมู่สินค้า";
        // Pass the user data and load view
        $this->load->view('themplate/header', $data);
        $this->load->view('admin/manage_user_view', $data);
    }


    /* order */
    public function approve()
    {
        $data['title'] = "รายการสั่งซื้อ";
        // Pass the user data and load view
        $this->load->view('themplate/header', $data);
        $this->load->view('admin/manage_approve_view', $data);
    }
    public function orderDetail($id = '')
    {
        $data['title'] = "รายการสั่งซื้อ";

        if ($id == '') {
            redirect('admin/manage/approve', 'location');
        }
        $data['orderDetail'] = $this->product->getOrder($id);

        // print_r($data['orderDetail']);

        // Pass the user data and load view
        $this->load->view('themplate/header', $data);
        $this->load->view('admin/order_detail_view', $data);
    }

    public function approveNet()
    {
        $data['title'] = "รายการสั่งซื้อ";
        // Pass the user data and load view
        $this->load->view('themplate/header', $data);
        $this->load->view('admin/manage_net_view', $data);
    }
    public function approveSum()
    {
        $data['title'] = "ยอดรายการสั่งซื้อรายวัน";
        // Pass the user data and load view
        $this->load->view('themplate/header', $data);
        $this->load->view('admin/manage_sum_view', $data);
    }
    public function updateApprove()
    {
        if ($post = $this->input->post()) {
            extract($post);


            $this->db->where('order_id', $id);
            $items = $this->db->get('orders_items')->result_array();

            $product = $this->db->get('products')->result_array();


            foreach ($items as  $item) {
                foreach ($product as  $pro) {
                    $objectData = array();

                    if ($pro['product_id'] == $item['product_id']) {
                        $stockNew = $pro['stock'] - $item['quantity'];

                        if ($stockNew <= 0) {
                            $objectData = array(
                                "stock" => 0,
                                "product_status" => 0,
                            );
                        } else {
                            $objectData = array(
                                "stock" => $stockNew,
                            );
                        }

                        $this->db->where('product_id', $pro['product_id']);
                        $this->db->update('products', $objectData);
                    }
                }
            }

            $object = array(
                "order_approve" => 1,
            );
            $this->db->where('order_id', $id);
            $update = $this->db->update('orders', $object);

            if ($update) {
                $callback = array(
                    "status" => 200,
                    'msg' => 'อนุมัติเงินโอนเรียบร้อย',
                );
            } else {
                $callback = array(
                    "status" => 500,
                    'msg' => 'เกิดข้อผิดพลาด กรุณาลองใหม่ภายหลัง',
                );
            }

            echo json_encode($callback);
        }
    }
}
