<?php defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('logged_in') !== true) {
            redirect('users/authen');
        }
    }

    public function index()
    {

        $data['title'] = "Shop name";

        $userID = $this->session->userdata('user_id');
        $data['user'] = $this->db->get_where('users', array('us_id' => $userID))->row_array();

        // Pass the user data and load view
        $this->load->view('templateuser/header', $data);
        $this->load->view('users/user_profile_view', $data);

    }
    public function updateProfile()
    {

        if ($post = $this->input->post()) {
            extract($post);
            $userID = $this->session->userdata('user_id');
            $this->db->where('us_username', $username);
            $this->db->where('us_id !=', $userID);
            $checkDuplicate = $this->db->get('users')->num_rows();
            if ($checkDuplicate > 0) {
                $callback = array(
                    'status' => 400,
                    'msg' => 'username นี้มีในระบบแล้ว',
                );

            } else {
                
                $object = array(
                    'us_username' => $username,
                    'us_password' => $password,
                    'us_fname' => $fname,
                    'us_lname' => $lname,
                    'us_email' => $email,
                    'us_phone' => $phone,
                    'us_address' => $address,

                );
                $this->db->where('us_id', $userID);
                $userdate = $this->db->update('users', $object);

                if ($userdate) {
                    $callback = array(
                        'status' => 200,
                        'msg' => 'กรุณาเข้าสู่ระบบใหม่อีกครั้ง เพื่ออัปเดตข้อมูล',
                    );
                } else {
                    $callback = array(
                        'status' => 500,
                        'msg' => 'เกิดข้อผิดพลาด กรุณาลองใหม่ภายหลัง',
                    );
                }

            }

            echo json_encode($callback);

        }
    }

}
