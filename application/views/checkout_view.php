<style>
    .file {
        visibility: hidden;
        position: absolute;
    }

    .wrapper-card {
        font-family: 'Kanit', sans-serif;
        display: block;
        padding: 0;
    }

    .card-container {
        display: flex;
        align-items: center;
        background: #fff;
        border-radius: .5rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
        margin-bottom: 1rem;
        /* max-width: 400px; */
        overflow: hidden;
        line-height: normal;
        width: 100%;
    }

    .logo-card {
        width: 120px;
        height: 100%;
        padding: 21px;
    }

    .logo-card div {
        background-position: center;
        background-size: cover;
        border-radius: 50%;
        height: 50px;
        width: 50px;
        margin: 0 auto;
    }

    .text-card {
        padding: 5px;
        margin-left: .5rem;
    }

    .text-titel-name {
        margin: 0;
        font-size: 16px;
        line-height: normal;
    }

    .account-number {
        margin: 0 !important;
        font-size: 24px !important;
        font-weight: 500 !important;
        line-height: normal !important;
    }

    .account-detail {
        font-size: 14px;
        display: block;
        font-weight: 300;
        line-height: normal;
    }

    .our-important-note {
        margin-bottom: 3rem;
    }

    .cart_totals table th {
        text-align: left !important;
    }

    .wc-proceed-to-checkout button {
        background: #252525 none repeat scroll 0 0;
        color: #fff;
        display: inline-block;
        font-size: 14px;
        font-weight: 700;
        height: 50px;
        line-height: 50px;
        margin-top: 20px;
        padding: 0 30px;
        text-transform: none;
    }
</style>
<!-- Start Checkout Area -->
<form id="form-order" enctype="multipart/form-data">
    <section class="our-checkout-area ptb--120 bg__white">
        <div class="container">
            <div class="row">

                <div class="col-md-8 col-lg-8">
                    <div class="ckeckout-left-sidebar">
                        <!-- Start Checkbox Area -->
                        <div class="checkout-form">
                            <h2 class="section-title-3">รายละเอียดการสั่งซื้อสินค้า</h2>
                            <div class="checkout-form-inner">

                                <div class="single-checkout-box">
                                    <input type="text" name="fname" placeholder="ชื่อจริง*" value="<?= $user['us_fname'] ?>" required>
                                    <input type="text" name="lname" placeholder="นามสกุล*" value="<?= $user['us_lname'] ?>" required>
                                </div>
                                <div class="single-checkout-box">
                                    <input type="email" name="email" placeholder="อีเมล*" value="<?= $user['us_email'] ?>" required>
                                    <input type="text" name="phone" placeholder="เบอร์โทรติดต่อ*" value="<?= $user['us_phone'] ?>" required>
                                </div>
                                <div class="single-checkout-box">
                                    <textarea name="address" id="address" placeholder="ที่อยู่ (สำหรับกรณีจัดส่ง*)"><?= $user['us_address'] ?></textarea>
                                </div>
                                <!-- <div class="single-checkout-box select-option mt--40">
                                <select>
                                    <option>Country*</option>
                                    <option>Bangladesh</option>
                                    <option>Bangladesh</option>
                                    <option>Bangladesh</option>
                                    <option>Bangladesh</option>
                                </select>
                                <input type="text" placeholder="Company Name*">
                            </div>
                            <div class="single-checkout-box">
                                <input type="email" placeholder="State*">
                                <input type="text" placeholder="Zip Code*">
                            </div> -->

                            </div>
                        </div>
                        <!-- End Checkbox Area -->
                        <!-- Start Payment Way -->
                        <br>
                        <h2 class="section-title-3">ช่องทางการชำระเงิน</h2>
                        <br>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="wrapper-card">
                                    <div class="card-container">
                                        <div class="logo-card" style="background: #6f5f5f;">
                                            <div style="background-image: url(https://sellercenter-global.com/uploads/banklogo/krc-logo.jpg);">
                                            </div>
                                        </div>
                                        <div class="text-card">
                                            <h4 class="text-titel-name">ธนาคารกรุงศรี</h4>
                                            <p class="account-number">162-4-4453-8</p>
                                            <span class="account-detail">Shop name</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12">
                                <div id="msg"></div>
                                <form method="post" id="image-form">
                                    <input type="file" name="upload" id="upload" class="file" accept="image/*">
                                    <div class="input-group my-3">
                                        <input type="text" class="form-control" disabled placeholder="Upload File" id="file" required>
                                        <div class="input-group-btn">
                                            <button type="button" class="browse btn btn-primary">แนบหลักฐานการโอน</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 text-center">
                                <img src="https://via.placeholder.com/300x450?text=Payment+Slip" id="preview" class="img-thumbnail">
                            </div>
                        </div>
                        <!-- <div class="our-payment-sestem">
                        <h2 class="section-title-3">We Accept :</h2>
                        <ul class="payment-menu">
                            <li><a href="#"><img src="images/payment/1.jpg" alt="payment-img"></a></li>
                            <li><a href="#"><img src="images/payment/2.jpg" alt="payment-img"></a></li>
                            <li><a href="#"><img src="images/payment/3.jpg" alt="payment-img"></a></li>
                            <li><a href="#"><img src="images/payment/4.jpg" alt="payment-img"></a></li>
                            <li><a href="#"><img src="images/payment/5.jpg" alt="payment-img"></a></li>
                        </ul>
                        <div class="checkout-btn">
                            <a class="ts-btn btn-light btn-large hover-theme" href="#">CONFIRM & BUY NOW</a>
                        </div>
                    </div> -->
                        <!-- End Payment Way -->
                    </div>
                </div>

                <?php
                $grandTotal = 0;
                $deposit = 50;
                $text_deposit = "";
                if (count($this->cart->contents()) > 0) {
                    $grandTotal += $this->cart->total();
                    $text_deposit = "Free";
                } else {
                    $grandTotal += $deposit;
                    $text_deposit = number_format($deposit, 2);
                }


                ?>

                <div class="col-md-4 col-lg-4">
                    <div class="checkout-right-sidebar">

                        <div class="our-important-note">
                            <h2 class="section-title-3">เลือกวิธิชำระเงิน</h2>
                            <br>
                            <!-- <p class="note-desc">Lorem ipsum dolor sit amet, consectetur adipisici elit, sed do eiusmod tempor incididunt ut laborekf et dolore magna aliqua.</p> -->
                            <ul id="payment_method">
                                <li>
                                    <input type="radio" name="payment" onchange="handleChange(this);" value="1" id="payment_a" checked />
                                    <label for="payment_a">
                                        จ่ายเต็มจำนวน
                                    </label>
                                </li>
                                <!-- <li>
                                    <input type="radio" name="payment" onchange="handleChange(this);" value="2" id="payment_b" />
                                    <label for="payment_b">
                                        จ่ายมัดจำ <span class="text-danger">(สามารถรับเองที่ฟาร์มเท่านั้น)</span>
                                    </label>
                                </li> -->
                                <li></li>
                            </ul>
                            <hr>
                            <h2 class="section-title-3">เลือกวิธิจัดส่ง</h2>
                            <br>
                            <ul id="shipping_method">
                                <li>
                                    <input type="radio" name="shipping" value="1" id="shipping_a" checked />
                                    <label for="shipping_a">
                                        เคอร์รี่
                                    </label>
                                </li>
                                <li>
                                    <input type="radio" name="shipping" value="2" id="shipping_b" />
                                    <label for="shipping_b">
                                        ไปรษณีย์ ems
                                    </label>
                                </li>
                                <li></li>
                            </ul>

                            <!-- <ul class="important-note">
                            <li><i class="zmdi zmdi-caret-right-circle"></i> </li>
                            <li><i class="zmdi zmdi-caret-right-circle"></i> Lorem ipsum dolor sit amet</li>
                            <li><i class="zmdi zmdi-caret-right-circle"></i> Lorem ipsum dolor sit amet, consectetur nipabali</li>
                            <li><i class="zmdi zmdi-caret-right-circle"></i> Lorem ipsum dolor sit amet, consectetur nipabali</li>
                            <li><i class="zmdi zmdi-caret-right-circle"></i> Lorem ipsum dolor sit amet</li>
                        </ul> -->
                        </div>
                        <div class="cart_totals">
                            <h2>ยอดรวมทั้งหมด</h2>
                            <table width="100%">
                                <tbody>
                                    <!-- <tr class="cart-subtotal">
                                            <th>Subtotal</th>
                                            <td><span class="amount">£215.00</span></td>
                                        </tr> -->
                                    <!-- <tr class="shipping">
                                    <th>ค่าจัดส่ง</th>
                                    <td>
                                        <ul id="shipping_method">
                                            <li>
                                                ส่ง EMS: <span class="amount">฿150.-</span>
                                            </li>

                                            <li></li>
                                        </ul>
                                        <p class="shipping-calculator-button">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ยอดรวมทั้งหมด</p>
                                    </td>
                                </tr> -->
                                    <tr class="order-total">
                                        <th>Total</th>
                                        <td>
                                            <strong><span class="amount" id="total">฿<?php echo $this->cart->format_number($this->cart->total()); ?>.-</span></strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="wc-proceed-to-checkout">
                                <button class="btn-block text-center" type="submit">สั่งซื้อสินค้าและชำระเงิน</button>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>
</form>
<!-- End Checkout Area -->
<?php
$fullPay = $this->cart->format_number($this->cart->total());
$hafPay = $this->cart->format_number($this->cart->total() / 2);

?>


<script>
    let fullPay = '฿<?= $fullPay ?>.-';
    let hafPay = '฿<?= $hafPay ?>.-';

    function handleChange(src) {
        if (src.value == 2) {
            $("#total").html(hafPay);
            $("#shipping_b").attr('disabled', true);
        } else {
            $("#shipping_b").attr('disabled', false);
            $("#total").html(fullPay);
        }
    }

    $(document).on("click", ".browse", function() {
        var file = $(this).parents().find(".file");
        file.trigger("click");
    });




    $('input[type="file"]').change(function(e) {
        var fileName = e.target.files[0].name;
        $("#file").val(fileName);

        var reader = new FileReader();
        reader.onload = function(e) {
            // get loaded data and render thumbnail.
            document.getElementById("preview").src = e.target.result;
        };
        // read the image file as a data URL.
        reader.readAsDataURL(this.files[0]);
    });

    $("#form-order").on("submit", function(e) {
        e.preventDefault();
        var img = $("#upload").val();
        if (img == '') {
            Swal.fire({
                icon: 'error',
                title: 'แจ้งเตือน',
                text: 'กรุณาแนบหลักฐานการโอนเงิน',
            })
            return false;
        }
        if ($("#shipping_b").val() == 2 && $("textarea#address").val() == '') {
            Swal.fire({
                icon: 'error',
                title: 'แจ้งเตือน',
                text: 'กรุณากรอกที่อยู่สำหรับจัดส่งสินค้า',
            })
            return false;
        }
        $.ajax({
            type: "POST",
            url: "<?= base_url() ?>checkout/placeOrder",
            data: new FormData(this),
            // dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function(response) {

                if (response == 200) {
                    Swal.fire({
                        title: 'สั่งซื้อสินค้าสำเร็จ!',
                        text: "เราจะตรวจสอบและอนุมัติการสั่งซื้อของคุณโดยเร็วที่สุด ขอบคุณที่ใช้บริการ",
                        icon: 'success',
                        confirmButtonColor: '#304ffe',
                        confirmButtonText: 'ตกลง'
                    }).then((result) => {
                        if (result.value) {
                            window.location.href = "<?= base_url() ?>order/tracking";
                        }

                    });
                } else if ((response == 404)) {
                    Swal.fire({
                        title: "Upload Not found!",
                        text: "กรุณาเลือกรูปภาพก่อนทำการ Upload",
                        icon: 'error',
                        confirmButtonColor: '#304ffe'
                    });

                } else {
                    var content = response;
                    Swal.fire({
                        title: "Upload Error!",
                        html: content,
                        icon: 'error',
                        confirmButtonColor: '#304ffe'
                    });
                }
                console.log(response);
                // $('#uploaded_image').html(response)

            }
        });
    });
</script>

<?php $this->load->view('templateuser/footer'); ?>