<style>
    .custom-file-label {
        overflow: hidden;
    }
</style>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">จัดการรายสินค้า</h1>
    <!-- h2>วันนี้: < ?php echo date("Y-m-d");?></h2> -->

    <div class="card shadow mb-5">

        <div class="card-header py-3 ">
            <h6 class="m-0 font-weight-bold text-primary">เพิ่มสินค้า</h6>
        </div>
        <div class="card-body">

            <form id="add-product" class="needs-validation  " autocomplete="off" novalidate>

                <div class="form-group row">
                    <div class="col-md-12">
                        <input type="text" name="productName" class="form-control mb-2 mr-sm-2 w-100" placeholder="กรอกชื่อสินค้า" id="productName" required>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">กรุณากรอกชื่อสินค้าที่ต้องการเพิ่ม</div>
                    </div>
                    <div class="col-md-12">
                        <select class="form-control mb-2" name="productCategory" id="productCategory" required>
                            <option value="">เลือกหมวดหมู่สินค้า</option>
                            <?php
                            foreach ($category as  $value) {
                                echo '<option value="' . $value['type_id'] . '">' . $value['type_name'] . '</option>';
                            }
                            ?>

                        </select>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">กรุณาเลือกหมวดหมู่สินค้า</div>
                    </div>
                    <div class="col-md-6">
                        <input type="number" name="productPrice" class="form-control mb-2 mr-sm-2" width="100%" placeholder="ระบุราคา" id="productPrice" required>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">กรุณาระบุราคา</div>
                    </div>
                    <div class="col-md-6">
                        <input type="number" name="productSalePrice" class="form-control mb-2 mr-sm-2" width="100%" placeholder="ระบุราคาโปรโมชั่น (ุถ้ามี)" id="productSalePrice">

                    </div>
                    <div class="col-md-6">
                        <input type="number" name="productStock" class="form-control mb-2 mr-sm-2" width="100%" placeholder="จำนวนสินค้าในสต็อก" id="productStock" required>

                    </div>
                    <div class="col-md-6">
                        <div class="custom-file mb-2">
                            <input type="file" name="upload" class="custom-file-input" id="customFile" required>
                            <label class="custom-file-label" for="customFile">เลือกรูปภาพ</label>
                        </div>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">กรุณาเลือกรูปภาพ</div>
                    </div>
                    <div class="col-md-12">

                        <div class="form-group mt-2">
                            <label for="description">รายละเอียดสินค้า</label>
                            <textarea name="description" class="form-control" id="description" rows="3"></textarea>
                        </div>

                        <div class="col-md-12 py-3 d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary  mb-2 px-5">เพิ่มสินค้า</button>
                        </div>


                    </div>
                </div>
            </form>


        </div>
    </div>



    <!-- DataTales Example -->
    <div class="card shadow mb-4">

        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">รายการสินค้าทั้งหมด</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="product-table" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ชื่อสินค้า</th>
                            <th>หมวดหมู่</th>
                            <th>ราคา</th>
                            <th>สถานะ</th>
                            <th>รูปภาพ</th>
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
                "url": "<?= base_url() ?>ajaxdata/Productlist", // ไฟล์ Server script php
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
                    data: 'product_name',
                    width: "auto",

                },
                {
                    data: 'category',
                    width: "150",
                    render: function(data, type, row) {

                        if (data == '' || data == null) {
                            return 'ไม่มีหมวดหมู่';
                        } else {

                        }
                        return data;

                    }
                },
                {
                    data: 'product_price',
                    width: "150",
                    className: 'text-center',
                    render: function(data, type, row) {
                        return '฿' + data + ' .-';
                    }
                },
                {
                    data: 'active',
                    width: "100",
                    className: 'text-center',
                    render: function(data, type, row) {


                        if (row.active == true) {
                            return '<h6><span class="badge badge-pill badge-success"> มีสินค้า ' +
                                row.stock + ' รายการ</span></h6>';
                        } else {
                            return '<h6><span class="badge badge-pill badge-warning"> สินค้าหมด </span></h6>';
                        }

                    }
                },
                {
                    data: 'product_img',
                    width: "100",
                    className: 'text-center',
                    render: function(data, type, row) {

                        return '<img class="img-fluid" style="max-height: 100px;" src="<?= base_url() ?>uploads/product/' +
                            data + '">';
                    }
                },
                {
                    width: "150",
                    className: 'text-center',
                    render: function(data, type, row) {

                        return '<button  type="button" class="btn btn-square btn-warning btn-sm mr-2" onclick="getproduct(' +
                            row.product_id +
                            ')" >แก้ไข</button><button  type="button"  class="btn btn-square btn-danger btn-sm" onclick="delproduct(' +
                            row.product_id +
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
                                url: "<?= base_url() ?>admin/manage/addproduct",
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
                                        }).then((result) => {
                                            if (result.value) {
                                                window.location
                                                    .reload();
                                            }
                                        })

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
            text: "ยืนยันการลบสินค้า",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'ยืนยัน',
            showCancelButton: true,
            cancelButtonText: 'ยกเลิก',
        }).then((result) => {
            if (result.value) {

                $.post("<?= base_url() ?>admin/manage/delproduct", {
                        id: id
                    },
                    function(data, textStatus, jqXHR) {

                        if (data == 200) {
                            Swal.fire({
                                title: 'Success',
                                text: "ลบสินค้าเรียบร้อย",
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