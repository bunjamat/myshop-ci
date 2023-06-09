<?php defined('BASEPATH') or exit('No direct script access allowed');

class Register extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if ($this->session->userdata('logged_in') === true) {
            redirect('dashboard');
        }
        $data['title'] = "Shop name";

        // Pass the user data and load view
        $this->load->view('users/register_view', $data);
    }
    public function saveUser()
    {
        if ($post = $this->input->post()) {
            extract($post);
            $this->db->where('us_username', $username);
            $checkDuplicate = $this->db->get('users')->num_rows();

            if ($checkDuplicate > 0) {
                $callback = array(
                    'status' => 400,
                    'msg' => 'ชื่อผู้ใช้นี้มีในระบบแล้ว กรุณาใช้ชื่อผู้ใช้งานอื่น',
                );
            } else {
                $datetime = date("Y-m-d H:i:s");
                $object = array(
                    'us_username' => $username,
                    'us_password' => $password,
                    'us_fname' => $fname,
                    'us_lname' => $lname,
                    'us_phone' => $phone,
                    'us_createdate' => $datetime,
                    'us_role' => 1,
                );
                $insert = $this->db->insert('users', $object);

                if ($insert) {
                    $callback = array(
                        'status' => 200,
                        'msg' => 'สมัครสมาชิกเรียบร้อย',
                    );
                } else {
                    $callback = array(
                        'status' => 500,
                        'msg' => 'เกิดข้อผิดพลาด ไม่สมัครสมาชิกได้',
                    );
                }
            }

            echo json_encode($callback);
        }
    }


    public function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url() . 'authen/', 'location');
    }
}
