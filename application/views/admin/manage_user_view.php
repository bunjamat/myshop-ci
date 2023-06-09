<style>
    .custom-file-label {
        overflow: hidden;
    }
</style>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">จัดการสมาชิก</h1>
    <!-- h2>วันนี้: < ?php echo date("Y-m-d");?></h2> -->





    <!-- DataTales Example -->
    <div class="card shadow mb-4">

        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">สมาชิกทั้งหมด</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="product-table" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ชื่อสมาชิก</th>
                            <th>เบอร์โทร</th>
                            <th>อีเมล</th>
                            <th>action</th>

                        </tr>
                    </thead>

                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
<div class="modal fade" id="updateproductModal" tabindex="-1" role="dialog" aria-labelledby="updateproductModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" id="getproductdetail">

        </div>
    </div>
</div>

<?php $this->load->view('themplate/coreplugin'); ?>
<!-- Page level plugins -->
<script src="<?= base_url() ?>assets/admin/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/admin/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script>
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });

    // Disable form submissions if there are invalid fields
    var table;

    $(document).ready(function() {
        /* $('#productDate').datepicker({
            language: "th",
            autoclose: true,
            format: "yyyy-mm-dd",
            todayHighlight: true,
            startDate: '+1d',
        }); */

        table = $('#product-table').DataTable({
            "orderCellsTop": true,
            "fixedHeader": true,
            "processing": true, // แสดงข้อความกำลังดำเนินการ กรณีข้อมูลมีมากๆ จะสังเกตเห็นง่าย
            "serverSide": true, // ใช้งานในโหมด Server-side processing
            "order": [], // กำหนดให้ไม่ต้องการส่งการเรียงข้อมูลค่าเริ่มต้น จะใช้ค่าเริ่มต้นตามค่าที่กำหนดในไฟล์ php
            "ajax": {
                "url": "<?= base_url() ?>ajaxdata/Userlist", // ไฟล์ Server script php
                "data": { // เพิ่มตัวแปรที่ต้องกาส่งเข้าไปแบบกำหนดเอง
                    "page": function() { // ใข้ข้อมูลตัวแปรชื่อ page
                        var dataTable1 = $('#product-table')
                            .DataTable(); // จะใช้ข้อมูลอ้างอิงจาก dataTable
                        return dataTable1.page.info()
                            .page; // ส่งค่าเลขหน้าปัจจุบันไปไว้ในตัวแปร page ค่าเรี่มต้นนับจาก 0
                    },

                },
                "type": "POST" // ส่งข้อมูลแบบ post
            },
            "columnDefs": [ // กำหนดลักษณะพิเสษเฉพาะสำหรับคอลัมน์ตารางที่ต้องการ
                {
                    "targets": [0], // เราต้องการกำหนดคอลัมน์แรก ค่าเริ่มต้นที่ 0
                    "orderable": false, // ให้ไม่ต้องสามารถเรียงข้อมูลได้ เพราะเป็นลำดับรายการเฉยๆ
                }
            ],
            'columns': [{
                    data: 'no',
                    width: "50"
                },

                {
                    data: 'us_fname',
                    width: "auto",
                    render: function(data, type, row) {
                        return data + ' ' + row.us_lname;
                    }

                },
                {
                    data: 'us_email',
                    width: "auto",

                },
                {
                    data: 'us_phone',
                    width: "auto",

                },
                {
                    width: "150",
                    className: 'text-center',
                    render: function(data, type, row) {
                        // <button  type="button" class="btn btn-square btn-warning btn-sm mr-2" onclick="getproduct(' +
                        //     row.product_id +
                            // ')" >แก้ไข</button>
                        return '<button  type="button"  class="btn btn-square btn-danger btn-sm" onclick="delproduct(' +
                            row.us_id +
                            ')" >ลบ</button>';
                    }
                }
            ],
            "dom": '<"row col justify-content-between top-information"lf>rt<"row col justify-content-between bottom-information"ip><"clear">',
            /* "aLengthMenu": [
                [5, 30, 50, 75, -1],
                [5, 30, 50, 75, "All"]
            ], */
            "pageLength": 10,
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
            }
        });



    });

    function getproduct(id) {

        $.ajax({
            type: "POST",
            url: "<?= base_url() ?>admin/manage/getproduct",
            data: {
                id: id
            },
            success: function(response) {

                $("#updateproductModal").modal({
                    backdrop: 'static',
                    keyboard: false
                }).show();

                $("#getproductdetail").html(response);
                $(".custom-file-input").on("change", function() {
                    var fileName = $(this).val().split("\\").pop();
                    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
                });

            }
        });

    }


    function updateProductEdit(id) {

        var productName = $('#editProductName').val();
        var productPrice = $('#editProductPrice').val();
        var productStatus = $('#editProductStatus').val();
        if (productName == '' || productPrice == '') {
            Swal.fire({
                icon: 'info',
                title: 'แจ้งเตือน',
                text: 'กรุณากรอกรายละเอียดการดำเนินการก่อนทำการบันทึก',
            })
            return false;
        }

        $("#updateproductModal").modal('hide');

        var formData = new FormData($("#form-updateProduct")[0]);
        formData.append("productID", id); // เพิ่มค่าจากนอกฟอร์ม



        $.ajax({
            type: "POST",
            url: "<?= base_url() ?>admin/manage/updateproduct",
            data: formData,
            dataType: "JSON",
            cache: false,
            contentType: false,
            processData: false,
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

    function delproduct(id) {
        Swal.fire({
            title: 'แจ้งเตือน',
            text: "ยืนยันการลบสมาชิก",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'ยืนยัน',
            showCancelButton: true,
            cancelButtonText: 'ยกเลิก',
        }).then((result) => {
            if (result.value) {

                $.post("<?= base_url() ?>admin/manage/deluser", {
                        id: id
                    },
                    function(data, textStatus, jqXHR) {

                        if (data == 200) {
                            Swal.fire({
                                title: 'Success',
                                text: "ลบสมาชิกเรียบร้อย",
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