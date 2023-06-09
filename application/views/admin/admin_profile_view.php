<style>
    /*======================================
  21. Contact CSS
========================================*/
    .contact-us {
        position: relative;
        z-index: 43;
    }

    .contact-us .title {
        margin-bottom: 30px;
    }

    .contact-us .title h4 {
        font-size: 17px;
        font-weight: 500;
        margin-bottom: 5px;
        color: #F7941D;
    }

    .contact-us .title h3 {
        font-size: 25px;
        text-transform: capitalize;
        font-weight: 600;
    }

    .contact-us .single-head {
        padding: 50px;
        box-shadow: 0px 0px 15px #0000001a;
        height: 100%;
    }

    .contact-us .single-info {
        text-align: left;
        margin-bottom: 30px;
    }

    .contact-us .single-info i {
        color: #fff;
        font-size: 18px;
        display: inline-block;
        margin-bottom: 15px;
        height: 40px;
        width: 40px;
        display: block;
        text-align: center;
        border-radius: 3px;
        line-height: 40px;
        background: #F7941D;
    }

    .contact-us .single-info ul .contact-us .single-info ul li {
        margin-bottom: 5px;
    }

    .contact-us .single-info ul li:last-child {
        margin-bottom: 0;
    }

    .contact-us .single-info ul li a {
        font-weight: 400;
    }

    .contact-us .single-info ul li a:hover {
        color: #F7941D;
    }

    .contact-us .single-info .title {
        margin-bottom: 10px;
        font-weight: 500;
        color: #333;
        font-size: 18px;
    }

    .contact-us .form-main {
        box-shadow: 0px 0px 15px #0000001a;
        padding: 50px;
    }

    .contact-us .form .form-group input {
        height: 48px;
        line-height: 48px;
        width: 100%;
        border: 1px solid #e6e2f5;
        padding: 0px 20px;
        color: #333;
        border-radius: 0px;
        font-weight: 400;
    }

    .contact-us .form .form-group textarea {
        height: 180px;
        width: 100%;
        border: 1px solid #e6e2f5;
        padding: 15px 20px;
        color: #333;
        border-radius: 0px;
        resize: none;
        font-weight: 400;
    }

    .contact-us .form .form-group label {
        color: #333;
        position: relative;
    }

    .contact-us .form .form-group label span {
        color: #ff2c18;
        display: inline-block;
        position: absolute;
        right: -12px;
        top: 4px;
        font-size: 16px;
    }

    .contact-us .form .button {
        margin: 0;
    }

    .contact-us .form .button .btn {
        height: 50px;
        border: none;
    }



    /*======================================
  End Contact CSS
========================================*/
</style>
<!-- Start Contact -->
<section id="contact-us" class="contact-us section">
    <div class="container">
        <div class="contact-head">
            <div class="row">
                <div class="col-lg-8 col-12">
                    <div class="form-main">
                        <div class="title">
                            <h4>จัดการ</h4>
                            <h3>ข้อมูลส่วนตัว</h3>
                        </div>
                        <form class="form" id="form-profile" method="post" action="#">
                            <div class="row">
                                <div class="col-lg-12 col-12">
                                    <div class="form-group">
                                        <label>Username<span>*</span></label>
                                        <input name="username" value="<?= $user['us_username'] ?>" type="text" placeholder="">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label>ชื่อแสดง<span>*</span></label>
                                        <input name="fname" value="<?=$user['us_fname']?>" type="text"
                                            placeholder="">
                                    </div>
                                </div>
                               <!--  <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label>อายุ<span>*</span></label>
                                        <input name="age" value="< ?= $user['us_age'] ?>" type="text" placeholder="">
                                    </div>
                                </div> -->
                               <!--  <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label>เบอร์โทรติดต่อ<span>*</span></label>
                                        <input name="phone" value="< ?= $user['us_phone'] ?>" type="text" placeholder="">
                                    </div>
                                </div> -->

                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label>รหัสผ่าน<span>*</span></label>
                                        <input name="password" value="<?= $user['us_password'] ?>" type="text" placeholder="">
                                    </div>
                                </div>

                                <!-- <div class="col-12">
											<div class="form-group message">
												<label>your message<span>*</span></label>
												<textarea name="message" placeholder=""></textarea>
											</div>
										</div> -->
                                <div class="col-12">
                                    <div class="form-group button">
                                        <button type="submit" id="submit" class="btn btn-primary" disabled>บันทึกการเปลี่ยนแปลง</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="single-head">
                        <div class="single-info">
                            <i class="fa fa-user-circle" aria-hidden="true"></i>
                            <h4 class="title">ชื่อผู้ใช้งาน:</h4>
                            <ul>
                                <li>username : <?= $user['us_username'] ?></li>
                                <li>ชื่อแสดง : <?= $user['us_fname'] ?></li>
                            </ul>
                        </div>
                       <!--  <div class="single-info">
                            <i class="fa fa-phone"></i>
                            <h4 class="title">เบอร์โทร:</h4>
                            <ul>
                                <li>< ?= $user['us_phone'] ?></li>
                            </ul>
                        </div> -->

                        <!-- <div class="single-info">
									<i class="fa fa-location-arrow"></i>
									<h4 class="title">Our Address:</h4>
									<ul>
										<li>KA-62/1, Travel Agency, 45 Grand Central Terminal, New York.</li>
									</ul>
								</div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/ End Contact -->

<?php $this->load->view('elements/core_pluins'); ?>
<script>
    $(document).ready(function() {
        $("input").keyup(function() {
            $("#submit").prop("disabled", false);
        });

    });
    $("#form-profile").submit(function(e) {
        e.preventDefault();
        var formData = $(this).serialize();

        $.ajax({
            type: "POST",
            url: "<?= base_url() ?>admin/profile/updateprofile",
            data: formData,
            dataType: "JSON",
            success: function(response) {

                if (response.status == 200) {

                    Swal.fire({
                        title: 'บันทึกการเปลี่ยนแปลงเรียบร้อย',
                        text: response.msg,
                        icon: 'success',
                    }).then((result) => {
                        if (result.value) {
                            window.location.href = "<?= base_url() ?>admin/authen/logout";
                        }
                    })

                } else {
                    Swal.fire({
                        title: "ผิดพลาด",
                        html: response.msg,
                        icon: 'error',
                    });
                }

            }
        });

    });
</script>