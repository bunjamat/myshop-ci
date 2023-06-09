<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Productlist extends CI_Controller
{
    private $table = "products a"; // กำหนดชื่อตารางข้อมูล
    // กำหนดฟิลด์ข้อมูลในตารางที่ต้องการดึงมาใช้งาน
    private $column_select = array("a.*,b.type_name");
    // กำหนดตารางที่ต้องการเชื่อม และเงื่อนไขการเชื่อมตาราง
    private $table_join = array(
        array('category b', 'b.type_id = a.category', 'left'),
        // array("tbl_product c","b.pro_id=c.pro_id","left")
    );
    // กำหนดฟิลด์ข้อมูลที่สามารถให้ค้นหาข้อมูลได้
    private $column_search = array(
        "a.product_name"
    );
    // กำหนดฟิลด์ข้อมูลที่สามารถให้เรียงข้อมูลได้
    private $column_order = array(
        null, "a.product_name", "b.type_name"
    );
    // กำหนดฟิลด์ข้อมูลที่่ต้องการเรียงข้อมูลเริ่มต้น และรูปแบบการเรียงข้อมูล
    private $order = array("product_id" => "DESC");
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        // $role_id = $this->session->userdata('user_id');
        $data = array();
        $_draw = $this->input->post('draw'); // ครั้งที่การดึงข้อมูล ค่าของ dataTable ส่งมาอัตโนมัติ
        $_p = $this->input->post('search'); // ตัวแปรคำค้นหาถ้ามี
        $_earchValue = $_p['value']; // ค่าคำค้นหา
        $_order = $this->input->post('order'); // ตัวแปรคอลัมน์ที่ต้องการเรียงข้อมูล
        $_length = $this->input->post('length'); // ตัวแปรจำนวนรายการที่จะแสดงแต่ละหน้า
        $_start = $this->input->post('start'); // เริ่มต้นที่รายการ
        $this->db->select(implode(",", $this->column_select)); // สร้างคำสั่ง select ฟิลด์ข้อมูลที่กำหนด
        $query = $this->db->from($this->table); // ดึงข้อมูลจากตารางที่กำหนด


        // วนลูปเงื่อนไขการเชื่อมตารางเพื่อสร้างคำสั่ง sql การเชื่อมตาราง
        foreach ($this->table_join as $item_join) {
            call_user_func_array(array($this->db, 'join'), $item_join);
        }

        // $this->db->where('d.user_id', $role_id);

        $total_rows_all = $this->db->count_all_results(null, false); // เก็บค่าจำนวนรายการทั้งหมด

        $i = 0;
        // วนลูปฟิลด์ที่ต้องการค้นหา กรณีมีการส่งคำค้น เข้ามา
        foreach ($this->column_search as $item) {
            if ($_earchValue) { // ถ้ามีค่าคำค้น
                // จัดรูปแแบคำสั่ง sql การใช้งาน OR กับ LIKE
                if ($i === 0) { // ถ้าเป็นค่าเริ่มเต้นให้เปิดวงเล็บ (
                    $this->db->group_start();
                    $this->db->like($item, $_earchValue);
                } else {
                    $this->db->or_like($item, $_earchValue);
                }
                if (count($this->column_search) - 1 == $i) { // ถ้าเป็นต้วสุดท้ายให้ปิดวงเล็บ )
                    $this->db->group_end();
                }
            }
            $i++;
            // ส่วนของการวนลูปนี้จะได้รูปแบบ เช่น ( fileld1 LIKE 'a' OR field2 LIKE 'a' )  เป็นต้น
        }
        /*         $chk_date = $this->input->post('is_date_search'); //เช็คค่าถ้ามีวันที่

        if ($chk_date == 'yes') {
            $start_date = $this->input->post('start_date'); //วันที่เริ่มต้น
            $end_date = $this->input->post('end_date'); //วันที่สิ้นสุด
            $this->db->group_start();
            $this->db->where('a.create_date BETWEEN "' . date('Y-m-d', strtotime($start_date)) . '" and "' . date('Y-m-d', strtotime($end_date)) . '"');
            $this->db->group_end();
        } */

        // ถ้ามีการส่งฟิลด์ที่ต้องการเรียงข้อมูลเข้ามา เช่น กรณีกดที่หัวข้อในตาราง dataTable
        if (isset($_order) && $_order != null) {
            // จัดรูปแบบการจัดเรียงข้อมูลจากค่าที่ส่งมา
            $_orderColumn = $_order['0']['column'];
            $_orderSort = $_order['0']['dir'];
            $this->db->order_by($this->column_order[$_orderColumn], $_orderSort);
        } else { // กรณีไม่ได้ส่งค่าในตอนต้น ให้ใช้ค่าตามที่กำหนด
            // จัดรูปแบบการจัดเรียง  ตามที่กำหนดด้ายตัวแปร $order ด้านบน
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
        $total_rows_filter = $this->db->count_all_results(null, false); // กำหนดค่าจำนวนข้อมูลหลังมีเงื่อนไขต่างๆ
        if ($_length != -1) { // กรณีมีการกำหนดว่าต้องการแสดงข้อมูลหน้าละกี่รายการ
            $this->db->limit($_length, $_start); // จัดรูปแบบการแสดง ผลที่ได้เช่น LIMIT 10,10
        }
        $query = $this->db->get(); // คิวรี่ข้อมูลตาเงื่อนไข

        $sql_str = $this->db->last_query(); // เก็บค่าคำสั่ง SQL ล่าสุด
        $sql_str_all = substr($sql_str, 0, strpos($sql_str, 'LIMIT')); // เก็บค่าคำสั่ง SQL ล่าสุดโดยตัด LIMIT ออก
        $this->session->set_userdata('ses_sql_str_all', $sql_str_all); // กำหนดตัวแปร session ชื่อ ses_sql_str_all
        $this->session->set_userdata('ses_sql_str', $sql_str); // กำหนดตัวแปร session ชื่อ ses_sql_str

        $_page = $this->input->post('page'); // ค่าตัวแปร page ที่เรากำหนดเองส่งหน้าปัจจุบันเข้ามา
        // วนลูปนำฟิลด์รายการที่ต้องการและสอดคล้องกันมาไว้ในตัวแปร array ที่ชื่อ $data
        $_i = 0; // ตัวแปรเลขลำดับข้อมูล
        foreach ($query->result_array() as $row) {
            $_i++;
            $active = false;
            if ($row['product_status'] == 1) {
                $active = true;
            }
            $data[] = array(
                "no" => ($_page * $_length) + $_i,
                "product_id" => $row['product_id'],
                "product_name" => $row['product_name'],
                "product_price" => $row['product_price'],
                "product_sale_price" => $row['product_sale_price'],
                "product_img" => $row['product_img'],
                "category" => $row['type_name'],
                "stock" => $row['stock'],
                "active" => $active
            );
        }
        // กำหนดรูปแบบ array ของข้อมูลที่ต้องการสร้าง JSON data ตามรูปแบบที่ DataTable กำหนด
        $output = array(
            "draw" => $_draw, // ครั้งที่เข้ามาดึงข้อมูล
            "recordsTotal" => $total_rows_all, // ข้อมูลทั้งหมดที่มี
            "recordsFiltered" => $total_rows_filter, // ข้อมูลเฉพาะที่เข้าเงื่อนไข เช่น ค้นหา แล้ว
            "data" => $data, // รายการ array ข้อมูลที่จะใช้งาน
        );
        echo json_encode($output);
        exit();
    }
}