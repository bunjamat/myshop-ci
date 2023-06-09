<?php defined('BASEPATH') or exit('No direct script access allowed');

class Authen extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['title'] = "Shop name";

        if ($this->session->userdata('logged_in') === true) {
            redirect('dashboard'); //เปลี่ยนเส้นทางไปยังหน้าที่เข้าสู่ระบบแล้ว
        }

        // ถ้ายังไม่มีก็จะให้ไปที่หน้า login
        $this->load->view('users/login_view', $data);
    }

    public function auth()
    {
        // echo "กำลังจะเข้าสู่ระบบ";
        $user = $this->input->post('username');
        $pass = $this->input->post('password');

        //ส่ง user pass เข้าไปเช็คที่ function
        $validate = $this->validateUser($user, $pass);

        if ($validate !== false) {

            $sesdata = array(
                'user_id' => $validate['us_id'],
                'name' => $validate['us_fname'],
                'role_user' => $validate['us_role'],
                'logged_in' => true,
            );

            $this->session->set_userdata($sesdata);

            // access login for admin
            if ($validate['us_role'] == 1) {
                redirect(base_url() . '/dashboard', 'location');
            }
        } else {
            echo $this->session->set_flashdata('msg', 'ชื่อผู้ใช้งานหรือรหัสผ่านไม่ถูกต้อง');
            redirect('users/authen');
        }

        // echo $user . '<br>' . $pass;
    }

    private function validateUser($user, $pass)
    {
        //ความหมายเดียวกัน
        $sql = "select * from users where us_username = '$user' and us_password='$pass' and us_role = 9";

        //ความหมายเดียวกัน
        $getUser = $this->db->get_where('users', array('us_username' => $user, 'us_password' => $pass, 'us_role' => 1));


        if ($getUser->num_rows() === 1) {
            return $getUser->row_array();
        } else {
            return false;
        }
    }
    public function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url('') . 'dashboard', 'location');
    }
}
