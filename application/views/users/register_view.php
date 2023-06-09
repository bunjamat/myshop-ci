<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Register</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Thai:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url() ?>assets/admin/css/sb-admin-2.min.css?ts=005" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">สร้างบัญชีผู้ใช้</h1>
                            </div>
                            <form class="user needs-validation" autocomplete="off" novalidate>

                                <div class="form-group">
                                    <input name="username" type="text" class="form-control form-control-user" id="username" placeholder="ชื่อผู้ใช้งาน (ภาษาอังกฤษเท่านั้น)" required>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">กรุณากรอกชื่อผู้ใช้งาน</div>
                                </div>
                                <div class="form-group">
                                    <input name="password" type="password" class="form-control form-control-user" id="password" placeholder="รหัสผ่าน" required>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">กรุณากรอกรหัสผ่าน</div>
                                </div>
                                <div class="form-group">

                                    <input name="phone" type="tel" class="form-control form-control-user" id="phone" placeholder="เบอร์โทรศัพท์" required>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">กรุณากรอกเบอร์โทร</div>

                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input name="fname" type="text" class="form-control form-control-user" id="fname" placeholder="ชื่อ" required>
                                        <div class="valid-feedback">Valid.</div>
                                        <div class="invalid-feedback">กรุณากรอกชื่อ</div>
                                    </div>
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input name="lname" type="text" class="form-control form-control-user" id="lname" placeholder="นามสกุล" required>
                                        <div class="valid-feedback">Valid.</div>
                                        <div class="invalid-feedback">กรุณากรอกนามสกุล</div>
                                    </div>
                                </div>
                                <button type="submit" role="button" class="btn btn-primary btn-user btn-block">
                                    สมัครสมาชิก
                                </button>

                            </form>
                            <hr>

                            <div class="text-center">
                                <a class="small" href="<?= base_url() ?>users/authen">มีบัญชีผู้ใช้แล้ว ?
                                    เข้าสู่ระบบ!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url() ?>assets/admin/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url() ?>assets/admin/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url() ?>assets/admin/js/sb-admin-2.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <script>
        $(document).ready(function() {
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
                                    url: "<?= base_url() ?>users/Register/saveUser",
                                    data: formData,
                                    dataType: "json",
                                    success: function(res) {
                                        if (res.status == 200) {
                                            Swal.fire({
                                                icon: 'success',
                                                title: 'Success',
                                                text: res.msg,
                                            }).then((result) => {
                                                if (result.value) {
                                                    window.location.href = "<?= base_url() ?>users/Authen"
                                                }
                                            })

                                        } else {
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Oops...',
                                                text: res.msg,
                                            })

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
    </script>

</body>

</html>