<link href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap.min.css" rel="stylesheet">


<section class="our-checkout-area ptb--120 bg__white">
    <!-- Begin Page Content -->
    <div class="container">


        <div class="row mb-2">
            <div class="col-lg-12">

                <form autocomplete="off" id="fillter_form" class="">

                    <div class="row mb-3">

                    </div>


                </form>


            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered" id="food-table" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>ชื่อลูกค้า</th>
                        <th>เบอร์โทร</th>
                        <th>วันที่สั่งซื้อ</th>
                        <!-- <th>ราคา</th> -->
                        <!-- <th>จำนวน</th> -->
                        <th>ยอดรวม</th>
                        <th>สถานะ</th>
                        <!-- <th>หลักฐานการโอน</th> -->
                        <th>รายละเอียด</th>

                    </tr>
                </thead>

            </table>
        </div>


        <div class="modal fade" id="approveModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="approveModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="approveModalLabel">New message</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="dynamic-content">
                        <div class="image-src">

                        </div>

                    </div>
                    <div class="modal-footer">

                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
</section>
<div class="modal fade" data-backdrop="static" id="updatefoodModal" tabindex="-1" role="dialog" aria-labelledby="updatefoodModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" id="getfooddetail">

        </div>
    </div>
</div>

<!-- Page level plugins -->



<!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script>
    $('#approveModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var image = button.data('image') // Extract info from data-* attributes
        var dataID = button.data('id') // Extract info from data-* attributes
        var dataTBID = button.data('tbid') // Extract info from data-* attributes
        var username = button.data('username') // Extract info from data-* attributes
        var price = button.data('price') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-title').html('รายการโอนเงินของคุณ ' + username + '<br/>จำนวน : ' + price + ' บาท')
        modal.find('.modal-body .image-src').html('<img src="<?= base_url() ?>uploads/slip/' + image +
            '" class="img-fluid" alt="slip">');
        modal.find('.modal-footer').html(
            '<button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button><button type="button" onclick="updateApprove(' +
            dataID + ',' + dataTBID + ')" class="btn btn-primary">อนุมัติการจอง</button>');
    })

    // Disable form submissions if there are invalid fields
    var table;
    var start_date = '';
    var end_date = '';
    var records_displayed = 0;

    $(document).ready(function() {


        // $('.datepicker').datepicker({
        //     format: 'yyyy-mm-dd',
        //     todayBtn: true,
        //     language: 'th',
        //     thaiyear: true,
        //     autoclose: true,
        //     todayHighlight: true,
        // }).datepicker("setDate", "0");

        // $('.datepicker').on('changeDate', function() {
        //     start_date = $("#start_date").val();
        //     end_date = $("#end_date").val();

        //     if (end_date == '') {
        //         end_date = start_date;
        //     }

        //     table.draw();

        // });


        // สร้างปุ่มแบบกำหนดเองให้กับ DataTable ในที่นี้ใช้ชื่อว่า exportExcel
        $.fn.dataTable.ext.buttons.exportExcel = {
            className: 'buttons-excel', // กำหนด css class 
            action: function(e, dt, node, config) { // กำหนดการทำงาน
                if (this.text() == 'ไฟล์ Excel') { // ถ้าปุ่มที่กด มีข้อความว่า  Excel All Page
                    window.open(
                        '<?= base_url() ?>admin/export/excel?all=1'
                    ); // ให้เปิดไฟล์ export.php?all=1 เรียกฟังก์ชั่น excel ดึงข้อมูลทั้งหมด
                } else {
                    window.open(
                        '<?= base_url() ?>export/excel'
                    ); // ให้เปิดไฟล์ export.php เรียกฟังก์ชั่น excel ดึงข้อมูลเฉพาะหน้าปัจจุบัน
                }
            }
        };

        table = $('#food-table').DataTable({
            "orderCellsTop": true,
            "fixedHeader": true,
            "processing": true, // แสดงข้อความกำลังดำเนินการ กรณีข้อมูลมีมากๆ จะสังเกตเห็นง่าย
            "serverSide": true, // ใช้งานในโหมด Server-side processing
            "order": [], // กำหนดให้ไม่ต้องการส่งการเรียงข้อมูลค่าเริ่มต้น จะใช้ค่าเริ่มต้นตามค่าที่กำหนดในไฟล์ php
            "ajax": {
                "url": "<?= base_url() ?>ajaxdata/orderlist", // ไฟล์ Server script php
                "data": function(data) { // เพิ่มตัวแปรที่ต้องกาส่งเข้าไปแบบกำหนดเอง

                    var dataTable1 = $('#food-table')
                        .DataTable(); // ใข้ข้อมูลตัวแปรชื่อ page

                    // Append to data
                    data.page = dataTable1.page.info()
                        .page; // ส่งค่าเลขหน้าปัจจุบันไปไว้ในตัวแปร page ค่าเรี่มต้นนับจาก 0
                    data.start_date = start_date;
                    data.end_date = end_date;

                },
                "type": "POST" // ส่งข้อมูลแบบ post
            },
            /* drawCallback: function() {
                var api = this.api();
                var num_rows = api.page.info().recordsTotal;
                var records_displayed = api.page.info().recordsDisplay;
                console.log(records_displayed);

                // now do something with those variables
            }, */
            "columnDefs": [ // กำหนดลักษณะพิเสษเฉพาะสำหรับคอลัมน์ตารางที่ต้องการ
                {
                    "targets": [0, 3, 4, 6], // เราต้องการกำหนดคอลัมน์แรก ค่าเริ่มต้นที่ 0
                    "orderable": false, // ให้ไม่ต้องสามารถเรียงข้อมูลได้ เพราะเป็นลำดับรายการเฉยๆ 
                }
            ],
            'columns': [{
                    data: 'no',
                    width: "30",
                    className: "text-center",

                },
                {
                    data: 'us_fname',
                    render: function(data, type, row) {
                        return data + ' ' + row.us_lname
                    }
                },
                {
                    data: 'us_phone',
                },
                {
                    data: 'order_create',

                },
                {
                    data: 'order_grandtotal',
                    className: "text-center",

                },
                {
                    data: 'order_approve',
                    className: "text-center",
                    render: function(data, type, row) {

                        if (data == 0) {
                            return '<h5><span class="badge badge-pill badge-primary">รอตรวจสอบ</span></h5>'
                        } else if (data == 1) {
                            return '<h5><span class="badge badge-pill badge-success">อนุมัติ</span></h5>'
                        }

                    }
                },
                /* {
                    data: 'order_paymentslip',
                    className: "text-center",
                    render: function(data, type, row) {
                        var button = '';
                        if (data != null || data != '') {


                            if (row.order_approve == 0) {
                                button +=
                                    '<button type="btton" class="btn btn-primary"  data-toggle="modal" data-target="#approveModal" data-image="' +
                                    data +
                                    '" data-username="' + row.us_nickname + '" data-price="' +
                                    row.order_grandtotal + '" data-id="' +
                                    row.order_id + '" data-tbid="'+row.order_book_id+'">เรียกดูสลิป</button>';
                            }
                        }

                        return button;
                    }
                }, */
                {
                    data: 'order_id',
                    className: "text-center",
                    render: function(data, type, row) {
                        var button = '';

                        button +=
                            '<a target="_blank" href="<?= base_url() ?>order/orderDetail/' + data + '" type="btton" class="btn btn-info text-white">รายละเอียด</a>';

                        return button;
                    }
                }

            ],
            "dom": '<"row col justify-content-between top-information"lf>rt<"row col justify-content-between bottom-information"ip><"clear">',
            /* "aLengthMenu": [
                [5, 30, 50, 75, -1],
                [5, 30, 50, 75, "All"]
            ], */
            "pageLength": 50,
            "language": {
                "searchPlaceholder": "ค้นหา",
                "decimal": "",
                "emptyTable": "ไม่มีรายการข้อมูล",
                "info": "แสดงรายการที่ _START_ ถึง _END_ จาก _TOTAL_ รายการ",
                "infoEmpty": "ไม่มีรายการข้อมูล",
                "infoFiltered": "(กรองจากทั้งหมด _MAX_ รายการ)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "แสดง  _MENU_ ",
                "loadingRecords": "กำลังโหลดข้อมูล...",
                "processing": "กำลังประมวลผล...",
                "search": "ค้นหา:",
                "zeroRecords": "ไม่พบรายการที่ค้นหา",
                "paginate": {
                    "first": "หน้าแรก",
                    "last": "หน้าสุดท้าย",
                    "next": "ถัดไป",
                    "previous": "ก่อนหน้า"
                },
                "aria": {
                    "sortAscending": ": เรียงข้อมูลจากน้อยไปมาก",
                    "sortDescending": ": เรียงข้อมูลจากมากไปน้อย"
                }
            },
            "buttons": [{ // เริ่มต้นกลุ่มปุ่มแรก
                    "extend": 'collection',
                    "text": 'Export',
                    "className": 'btn btn-primary',
                    init: function(api, node, config) {
                        $(node).removeClass('dt-button');
                    },
                    "autoClose": true, // ให้ปิดกลุ่มปุ่มที่เปิดไว้แล้วอัตโนมัติ
                    "buttons": [ // ปุ่มทั้งหมดในกลุ่ม export
                        /* { // ปุ่มส่งออก Excel ปุ่มแรก
                            "extend": 'exportExcel', // สืบทอดจากปุ่มที่เรากำหนด
                            "text": 'Excel current Page', // กำหนดข้อความปุ่มตามต้องการ
                            "className": 'btn btn-success',
                            init: function(api, node, config) {
                                $(node).removeClass('dt-button');
                            }
                        }, */
                        { // ปุ่มส่งออก Excel ปุ่มที่สอง
                            "extend": 'exportExcel',
                            "text": 'ไฟล์ Excel',
                            "className": 'btn btn-success btn-block mb-2',
                            init: function(api, node, config) {
                                $(node).removeClass('dt-button');
                            }
                        }

                    ]
                }, // จบส่วนของ กลุ่มปุ่มแรก
            ]
        });




    });
</script>

<?php $this->load->view('templateuser/footer'); ?>