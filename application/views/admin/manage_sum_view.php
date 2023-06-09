<link href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css" rel="stylesheet">
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?= $title ?></h1>
    <!-- h2>วันนี้: < ?php echo date("Y-m-d");?></h2> -->
    <!-- DataTales Example -->
    <div class="card shadow mb-4">

        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">ยอดรวมรายการสั่งซื้อรายวันทั้งหมด</h6>
        </div>
        <div class="card-body">
            <div class="row mb-2">
                <div class="col-lg-12">

                    <form autocomplete="off" id="fillter_form" class="">

                        <div class="row mb-3">

                            <div class="col-lg-4">
                                <div class="input-group">
                                    <div class="input-group-prepend ">
                                        <span class="input-group-text bg-success text-white">
                                            เลือกวันที่ <i class="mdi mdi-calendar-range ml-2"></i>
                                        </span>
                                    </div>
                                    <input id="start_date" name="start_date" data-date-format="mm/dd/yyyy" class="datepicker form-control" required>

                                </div>
                            </div>
                            <!-- <div class="col-lg-4">
                                <div class="input-group">
                                    <div class="input-group-prepend ">
                                        <span class="input-group-text bg-danger text-white">
                                            ถึงวันที่ <i class="mdi mdi-calendar-range ml-2"></i>
                                        </span>
                                    </div>
                                    <input id="end_date" name="end_date" data-date-format="mm/dd/yyyy"
                                        class="datepicker form-control" required>
                                </div>
                            </div> -->
                            <!-- <div class="col-lg-4">
                                <div class="form-group">
                                      <input type="button" name="search" id="search" value="export รายงาน"
                                                        class="btn btn-info" />

                                    <input type="button" name="clear" id="cleardate" value="ล้างตัวกรอง"
                                        class="btn btn-dark ml-2" />

                                </div>
                            </div> -->

                        </div>


                    </form>


                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="food-table" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>วันที่สั่งซื้อ</th>
                            <th>จำนวน</th>
                            <th>ยอดรวม</th>
                        </tr>
                    </thead>

                </table>
            </div>
        </div>
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
<div class="modal fade" data-backdrop="static" id="updatefoodModal" tabindex="-1" role="dialog" aria-labelledby="updatefoodModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" id="getfooddetail">

        </div>
    </div>
</div>

<?php $this->load->view('themplate/coreplugin'); ?>
<!-- Page level plugins -->
<script src="<?= base_url() ?>assets/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url() ?>assets/js/moment.min.js"></script>

<script>
    $('#approveModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var image = button.data('image') // Extract info from data-* attributes
        var dataID = button.data('id') // Extract info from data-* attributes
        var username = button.data('username') // Extract info from data-* attributes
        var price = button.data('price') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-title').html('รายการโอนเงินของคุณ ' + username + '<br/>จำนวน : ' + price + ' บาท')
        modal.find('.modal-body .image-src').html('<img src="' + image + '" class="img-fluid" alt="slip">');
        modal.find('.modal-footer').html(
            '<button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button><button type="button" onclick="updateApprove(' +
            dataID + ')" class="btn btn-primary">อนุมัติเงินโอน</button>');
    })

    // Disable form submissions if there are invalid fields
    var table;
    var start_date = '';
    // var end_date = moment().format('YYYY-MM-DD');
    var records_displayed = 0;

    $(document).ready(function() {

        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            todayBtn: true,
            language: 'th',
            thaiyear: true,
            autoclose: true,
            todayHighlight: true,
        }).datepicker("setDate", "0");

        $('.datepicker').on('changeDate', function() {

            start_date = $("#start_date").val();
            table.draw();

        });


        // สร้างปุ่มแบบกำหนดเองให้กับ DataTable ในที่นี้ใช้ชื่อว่า exportExcel
        $.fn.dataTable.ext.buttons.exportExcel = {
            className: 'buttons-excel', // กำหนด css class 
            action: function(e, dt, node, config) { // กำหนดการทำงาน
                if (this.text() == 'ไฟล์ Excel') { // ถ้าปุ่มที่กด มีข้อความว่า  Excel All Page
                    window.open('<?= base_url() ?>exportnet/excel?all=1&start=' + start_date + '&end=' + end_date); // ให้เปิดไฟล์ export.php?all=1 เรียกฟังก์ชั่น excel ดึงข้อมูลทั้งหมด
                } else {
                    window.open('<?= base_url('export/excel') ?>'); // ให้เปิดไฟล์ export.php เรียกฟังก์ชั่น excel ดึงข้อมูลเฉพาะหน้าปัจจุบัน
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
                "url": "<?= base_url() ?>ajaxdata/Approvelistsum", // ไฟล์ Server script php
                "data": function(data) { // เพิ่มตัวแปรที่ต้องกาส่งเข้าไปแบบกำหนดเอง

                    var dataTable1 = $('#food-table')
                        .DataTable(); // ใข้ข้อมูลตัวแปรชื่อ page

                    // Append to data
                    data.page = dataTable1.page.info()
                        .page; // ส่งค่าเลขหน้าปัจจุบันไปไว้ในตัวแปร page ค่าเรี่มต้นนับจาก 0
                    data.start_date = start_date;

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
                    "targets": [0, 2, 3], // เราต้องการกำหนดคอลัมน์แรก ค่าเริ่มต้นที่ 0
                    "orderable": false, // ให้ไม่ต้องสามารถเรียงข้อมูลได้ เพราะเป็นลำดับรายการเฉยๆ 
                }
            ],
            'columns': [{
                    data: 'no',
                    width: "30"
                },
                {
                    data: 'order_checkin_date',
                    width: "50%"
                },
                {
                    data: 'order_qty',
                    className: "text-center",
                    width: "100"

                },
                {
                    data: 'order_grand_total',
                    className: "text-center",
                    width: "100"

                },

                /* {
                    data: 'order_slip_transfer',
                    className: "text-center",
                    render: function(data, type, row) {
                        var button = '';
                        if (data != null || data != '') {


                            if (row.order_approve == 0) {
                                button +=
                                    '<button type="btton" class="btn btn-primary"  data-toggle="modal" data-target="#approveModal" data-image="' +
                                    data +
                                    '" data-username="' + row.order_cust_name + '" data-price="' +
                                    row.order_grand_total + '" data-id="' +
                                    row.order_id + '">รายละเอียด</button>';
                            }
                        }

                        return button;
                    }
                } */

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



        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Get the forms we want to add validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        } else {
                            event.preventDefault();

                            var formData = $(this).serialize();

                            $.ajax({
                                type: "POST",
                                url: "<?= base_url() ?>manage/addfood",
                                data: formData,
                                dataType: "json",
                                success: function(res) {
                                    if (res.status == 200) {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Success',
                                            text: res.msg,
                                        })
                                        table.draw();
                                    } else {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Oops...',
                                            text: res.msg,
                                        })
                                        table.draw();
                                    }
                                }
                            });

                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();

    });


    function updateApprove(id) {

        $('#approveModal').modal("hide")
        $.ajax({
            type: "POST",
            url: "<?= base_url() ?>Manage/updateApprove",
            data: {
                id: id
            },
            dataType: "json",
            success: function(res) {
                if (res.status == 200) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: res.msg,
                    })
                    table.draw();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: res.msg,
                    })
                    table.draw();
                }
            }
        });

    }

    function getFood(code) {

        $.ajax({
            type: "POST",
            url: "<?= base_url() ?>manage/getFood",
            data: {
                code: code
            },
            success: function(response) {

                $("#updatefoodModal").modal({
                    backdrop: 'static',
                    keyboard: false
                }).show();

                $("#getfooddetail").html(response);
                $('#editfoodDate').datepicker({
                    language: "th",
                    autoclose: true,
                    format: "yyyy-mm-dd",
                    todayHighlight: true,
                    startDate: '+1d',
                });

            }
        });
    }


    function updateFood(code) {

        var foodName = $('#editfoodName').val();
        var foodDate = $('#editfoodDate').val();
        if (foodDate == '' || foodName == '') {
            Swal.fire({
                icon: 'info',
                title: 'แจ้งเตือน',
                text: 'กรุณากรอกรายละเอียดการดำเนินการก่อนทำการบันทึก',
            })
            return false;
        }

        $("#updatefoodModal").modal('hide');

        $.ajax({
            type: "POST",
            url: "<?= base_url() ?>manage/updateFood",
            data: {
                code: code,
                foodName: foodName,
                foodDate: foodDate,
            },
            dataType: "json",
            success: function(response) {

                if (response.status == 200) {
                    Swal.fire({
                        title: 'Success',
                        text: response.msg,
                        icon: 'success',
                    })
                    table.draw();

                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'แจ้งเตือน',
                        text: response.msg,
                    })
                    return false;
                }

            }
        });
    }

    function delFood(id) {
        Swal.fire({
            title: 'แจ้งเตือน',
            text: "ยืนยันการลบรายการอาหาร",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'ยืนยัน',
            showCancelButton: true,
            cancelButtonText: 'ยกเลิก',
        }).then((result) => {
            if (result.value) {

                $.post("<?= base_url() ?>manage/delFood", {
                        id: id
                    },
                    function(data, textStatus, jqXHR) {

                        if (data == 200) {
                            Swal.fire({
                                title: 'Success',
                                text: "ลบรายการอาหารเรียบร้อย",
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.value) {
                                    table.draw();
                                }
                            })
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'แจ้งเตือน',
                                text: 'เกิดข้อผิดพลาด กรุณาลองใหม่ภายหลัง',
                            })
                            return false;
                        }

                    }
                );

                table.draw();
            }
        });
    }
</script>

<?php $this->load->view('themplate/footer'); ?>