<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Exportnet extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('excel');
        // $this->load->library('Pdf');
    }
    public function excel()
    {

        // เรียนกใช้ PHPExcel
        $objPHPExcel = new PHPExcel();
        // เราสามารถเรียกใช้เป็น  $this->excel แทนก็ได้
        $start_date = $this->input->get('start');
        $end_date = $this->input->get('end');
        // กำหนดค่าต่างๆ ของเอกสาร excel
        $objPHPExcel->getProperties()->setCreator("Shop name")
            ->setLastModifiedBy("Shop name")
            ->setTitle("รายการสั่งซื้อสินค้า")
            ->setSubject("รายการสั่งซื้อสินค้า")
            ->setDescription("สรุปยอดรายการสั่งซื้อสินค้า วันที่ " . $start_date . " - " . $end_date)
            ->setKeywords("รายการสั่งซื้อสินค้า")
            ->setCategory("coupon");

        // กำหนดชื่อให้กับ worksheet ที่ใช้งาน
        $objPHPExcel->getActiveSheet()->setTitle('รายการสั่งซื้อสินค้า');

        // กำหนด worksheet ที่ต้องการให้เปิดมาแล้วแสดง ค่าจะเริ่มจาก 0 , 1 , 2 , ......
        $objPHPExcel->setActiveSheetIndex(0);

        // การจัดรูปแบบของ cell
        $objPHPExcel->getDefaultStyle()
            ->getAlignment()
            ->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP)
            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        //HORIZONTAL_CENTER //VERTICAL_CENTER

        // จัดความกว้างของคอลัมน์
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(30);
        /*         $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(35);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(30); */
        // $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);

        $objPHPExcel->getActiveSheet()->getStyle('A1:G1')->applyFromArray(
            array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => '76b0cc'),
                ),
            )
        );

        // กำหนดหัวข้อให้กับแถวแรก
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'ลำดับ')
            ->setCellValue('B1', 'ชื่อลูกค้า')
            ->setCellValue('C1', 'เบอร์โทร')
            ->setCellValue('D1', 'การชำระเงิน')
            ->setCellValue('E1', 'การจัดส่ง')
            ->setCellValue('F1', 'วันที่สั่งซื้อ')
            ->setCellValue('G1', 'ยอดรวม');
        // ->setCellValue('F1', 'จำนวน')
        // ->setCellValue('G1', 'ยอดรวม');
        // ->setCellValue('H1', 'สถานะ');



        // ดึงข้อมูลเริ่มเพิ่มแถวที่ 2 ของ excel
        $start_row = 2;


        // กรณีส่งตัวแปร GET['all'] หรือให้แสดงข้อมูลทั้งหมด
        if ($this->input->get('all')) {
            $sql = $this->session->ses_sql_str_all; // ใช้คำสั่ง SQL ที่ดึงรายกรทั้งหมด
        } else {
            $sql = $this->session->ses_sql_str; // ใช้คำสั่ง SQL ที่ดึงข้อมูลเฉพาะหน้านั้นๆ
        }
        $query = $this->db->query($sql);
        $result = $query->result_array();
        $i_num = 0;
        if (count($result) > 0) {
            foreach ($result as $row) {
                $i_num++;

                // หากอยากจัดข้อมูลราคาให้ชิดขวา
                /* $objPHPExcel->getActiveSheet()
                    ->getStyle('C' . $start_row)
                    ->getAlignment()
                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); */

                // หากอยากจัดให้รหัสสินค้ามีเลย 0 ด้านหน้า และแสดง 3     หลักเช่น 001 002
                /*  $objPHPExcel->getActiveSheet()
                    ->getStyle('B' . $start_row)
                    ->getNumberFormat()
                    ->setFormatCode('000'); */
                $payment = ($row['order_payment']  == 1) ? 'เต็มจำนวน' :  'มัดจำ';
                $shipping = ($row['order_shipping']  == 1) ? 'เคอร์รี่' :  'ไปรษณีย์ EMS';
                // เพิ่มข้อมูลลงแต่ละเซลล์
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A' . $start_row, $i_num)
                    ->setCellValue('B' . $start_row, $row['order_fname'] . ' ' . $row['order_lname'])
                    ->setCellValue('C' . $start_row, $row['order_phone'])
                    ->setCellValue('D' . $start_row, $payment)
                    ->setCellValue('E' . $start_row, $shipping)
                    ->setCellValue('F' . $start_row, $row['order_create'])
                    ->setCellValue('G' . $start_row, $row['order_grandtotal']);
                // ->setCellValue('H' . $start_row, $row['access_name']);

                // เพิ่มแถวข้อมูล
                $start_row++;
            }

            // กำหนดรูปแบบของไฟล์ที่ต้องการเขียนว่าเป็นไฟล์ excel แบบไหน ในที่นี้เป้นนามสกุล xlsx  ใช้คำว่า Excel2007
            // แต่หากต้องการกำหนดเป็นไฟล์ xls ใช้กับโปรแกรม excel รุ่นเก่าๆ ได้ ให้กำหนดเป็น  Excel5
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007'); // Excel2007 (xlsx) หรือ Excel5 (xls)

            $filename = 'รายการสั่งซื้อสินค้า วันที่ ' . $start_date . ' - ' . $end_date . '.xlsx'; //  กำหนดชือ่ไฟล์ นามสกุล xls หรือ xlsx
            // บังคับให้ทำการดาวน์ดหลดไฟล์
            // https://www.freeformatter.com/mime-types-list.html
            // header('Content-Type: application/vnd.ms-excel'); //mime type xls
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); //mime type   xlsx
            header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
            header('Cache-Control: max-age=0'); //no cache
            ob_end_clean();
            $objWriter->save('php://output'); // ดาวน์โหลดไฟล์รายงาน
            // หากต้องการบันทึกเป็นไฟล์ไว้ใน server  ใช้คำสั่งนี้ $this->excel->save("/path/".$filename);
            // แล้วตัด header ดัานบนทั้ง 3 อันออก
            exit();
        }
    }
}
