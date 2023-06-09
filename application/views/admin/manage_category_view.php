<style>
    .custom-file-label {
        overflow: hidden;
    }
    .badge{
        line-height: 1.5;
    }
</style>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">จัดการหมวดหมู่สินค้า</h1>
    <!-- h2>วันนี้: < ?php echo date("Y-m-d");?></h2> -->
    <div class="card shadow mb-4">

        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">เพิ่มหมวดหมู่สินค้า</h6>
        </div>
        <div class="card-body">
            <form id="add-category" class="needs-validation " autocomplete="off" novalidate>

                <div class="form-group row">
                    <div class="col-md-6">
                        <input type="text" name="categoryName" class="form-control mb-2 mr-sm-2 w-100" placeholder="กรอกชื่อหมวดหมู่สินค้า" id="categoryName" required>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">กรุณากรอกชื่อหมวดหมู่สินค้า</div>
                    </div>
                    <div class="col-md-3">
                    <select class="form-control mb-2" name="categoryStatus" id="categoryStatus" required>
                            <option value="1">ใช้งาน</option>
                            <option value="0">ปิดใช้งาน</option>
                           

                        </select>
                    </div>
                    <!--  <div class="col-md-2">
                <div class="custom-file">
                    <input type="file" name="upload" class="custom-file-input" id="customFile" required>
                    <label class="custom-file-label" for="customFile">เลือกรูปภาพ</label>
                </div>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">กรุณาเลือกรูปภาพ</div>
            </div> -->
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary btn-block mb-2">เพิ่มหมวดหมู่สินค้า</button>
                    </div>
                </div>

            </form>
        </div>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">

        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">หมวดหมู่สินค้าทั้งหมด</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ชื่อหมวดหมู่</th>
                            <th>สถานะ</th>
                            <th>action</th>

                        </tr>
                    </thead>

                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
<div class="modal fade" id="updatetableModal" tabindex="-1" role="dialog" aria-labelledby="updatetableModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" id="gettabledetail">

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
        /* $('#foodDate').datepicker({
            language: "th",
            autoclose: true,
            format: "yyyy-mm-dd",
            todayHighlight: true,
            startDate: '+1d',
        }); */

        table = $('#dataTable').DataTable({
            "orderCellsTop": true,
            "fixedHeader": true,
            "processing": true, // แสดงข้อความกำลังดำเนินการ กรณีข้อมูลมีมากๆ จะสังเกตเห็นง่าย
            "serverSide": true, // ใช้งานในโหมด Server-side processing
            "order": [], // กำหนดให้ไม่ต้องการส่งการเรียงข้อมูลค่าเริ่มต้น จะใช้ค่าเริ่มต้นตามค่าที่กำหนดในไฟล์ php
            "ajax": {
                "url": "<?= base_url() ?>ajaxdata/categorylist", // ไฟล์ Server script php
                "data": { // เพิ่มตัวแปรที่ต้องกาส่งเข้าไปแบบกำหนดเอง
                    "page": function() { // ใข้ข้อมูลตัวแปรชื่อ page
                        var dataTable1 = $('#dataTable')
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
                    data: 'type_name',
                    width: "auto",

                },
               
                {
                    data: 'type_status',
                    width: "100",
                    className: 'text-center',
                    render: function(data, type, row) {


                        if (data == 1) {
                            return '<h6><span class="badge badge-pill badge-success"> ใช้งาน </span></h6>';
                        } else if (data == 0) {
                            return '<h6><span class="badge badge-pill badge-warning"> ปิดใช้งาน </span></h6>';
                        }

                    }
                },

                {
                    width: "150",
                    render: function(data, type, row) {

                        return '<button  type="button" class="btn btn-square btn-warning btn-sm mr-2" onclick="getCategory(' +
                            row.type_id +
                            ')" >แก้ไข</button><button  type="button"  class="btn btn-square btn-danger btn-sm" onclick="delCategory(' +
                            row.type_id +
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
                            var formData = new FormData($(this)[0]);

                            $.ajax({
                                type: "POST",
                                url: "<?= base_url() ?>admin/manage/addCategory",
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
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();

    });

    function getCategory(id) {

        $.ajax({
            type: "POST",
            url: "<?= base_url() ?>admin/manage/getCategory",
            data: {
                id: id
            },
            success: function(response) {

                $("#updatetableModal").modal({
                    backdrop: 'static',
                    keyboard: false
                }).show();

                $("#gettabledetail").html(response);

            }
        });
    }


    function updateCategory(id) {

        var tableName = $('#editCategoryName').val();
        var tableStatus = $('#editCategoryStatus').val();
        if (tableName == '' || tableStatus == '') {
            Swal.fire({
                icon: 'info',
                title: 'แจ้งเตือน',
                text: 'กรุณากรอกรายละเอียดการดำเนินการก่อนทำการบันทึก',
            })
            return false;
        }

        $("#updatetableModal").modal('hide');

        $.ajax({
            type: "POST",
            url: "<?= base_url() ?>admin/manage/updateCategory",
            data: {
                id: id,
                editCategoryName: tableName,
                editCategoryStatus: tableStatus,
            },
            dataType: "JSON",
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

    function delCategory(id) {
        Swal.fire({
            title: 'แจ้งเตือน',
            text: "ยืนยันการลบหมวดหมู่สินค้า",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'ยืนยัน',
            showCancelButton: true,
            cancelButtonText: 'ยกเลิก',
        }).then((result) => {
            if (result.value) {

                $.post("<?= base_url() ?>admin/manage/delCategory", {
                        id: id
                    },
                    function(data, textStatus, jqXHR) {

                        if (data == 200) {
                            Swal.fire({
                                title: 'Success',
                                text: "ลบหมวดหมู่สินค้าเรียบร้อย",
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