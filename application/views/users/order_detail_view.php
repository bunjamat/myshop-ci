<link rel="stylesheet" href="<?= base_url() ?>assets/css/form-appeal.css">
<style>
    page {
        background: white;
        display: block;
        margin: 0 auto;
        margin-bottom: 0.5cm;
        box-shadow: 0 0 0.5cm rgba(0, 0, 0, 0.2);
    }

    page[size="A4"] {
        width: 21cm;
        /* height: 29.7cm; */
        height: auto;
    }

    /*======================================
   Start Shopping Cart CSS
========================================*/
    .table.shopping-summery {
        background: #fff;
    }

    .shopping-cart {
        background: #f6f6f6;
        padding: 50px 30px;
    }

    .shopping-summery thead .main-hading {
        padding: 0px 50px;
    }

    .shopping-summery thead {
        background: #3f51b5;
        color: #fff;
    }

    .shopping-summery thead tr th {
        border: none;
        font-weight: 600;
        color: #fff;
        text-align: center;
    }

    .shopping-summery tbody tr {
        border-bottom: 1px solid #F7941D;
        margin-top: 20px;
    }

    .shopping-summery tbody tr img {
        border-radius: 0;
        width: 80px;
        height: 80px;
    }

    .shopping-summery tbody tr:last-child {
        border: none;
    }

    .shopping-summery tbody .product-name a {
        font-weight: 600;
        color: #282828;
        font-weight: 600;
        font-size: 17px;
    }

    .shopping-cart .table p {
        font-size: 14px;
        color: #666;
    }

    .shopping-summery tbody .product-name a:hover {
        color: #F7941D;
    }

    .shopping-summery tbody .product img {
        max-width: 70px;
        border-radius: 100%;
        max-height: 65px;
        border: 1px solid #e6e6e6;
        padding: 4px;
    }

    .shopping-summery tbody .product:hover img {
        border-color: #F7941D;
        -webkit-transform: rotate(360deg);
        -moz-transform: rotate(360deg);
        transform: rotate(360deg);
    }

    .shopping-cart .border {}

    .shopping-cart .table .remove-icon {
        font-size: 16px;
    }

    .shopping-cart .table td {
        vertical-align: middle;
        border-top: 1px solid #eee;
        padding: 30px;
    }

    .shopping-summery tbody .price {
        text-align: center;
    }

    .shopping-summery tbody .price span {}

    .shopping-cart tbody .qty .input-group {
        width: 175px;
        display: inline-block;
    }

    .shopping-cart .qty .button {
        display: inline-block;
        position: absolute;
        top: 0;
    }

    .shopping-cart .qty .button.minus {
        left: 0;
        border-radius: 0;
        overflow: hidden;
    }

    .shopping-cart .qty .button.plus {
        right: 0;
        border-radius: 0;
        overflow: hidden;
    }

    .shopping-cart .qty .button .btn {
        padding: 0;
        width: 44px;
        height: 47px;
        line-height: 50px;
        border-radius: 0px;
        background: transparent;
        color: #282828;
        border: none;
        font-size: 12px;
    }

    .shopping-cart .qty .button .btn:hover {
        color: #F7941D;
    }

    .shopping-cart .qty .input-number {
        border: 1px solid #eceded;
        width: 100%;
        text-align: center;
        height: 47px;
        border-radius: 0;
        overflow: hidden;
        padding: 0px 45px;
    }

    .shopping-summery tbody .total-amount {
        text-align: center;
    }

    .shopping-summery tbody .total-amount span {}

    .shopping-summery tbody .action {
        text-align: center;
    }

    .shopping-summery tbody .action a:hover {
        color: #F7941D;
    }

    .shopping-cart .total-amount {
        margin-top: 50px;
    }

    .shopping-cart .total-amount .left {}

    .shopping-cart .total-amount .left .coupon {}

    .shopping-cart .total-amount .left .coupon form {}

    .shopping-cart .total-amount .left .coupon form input {
        width: 220px;
        display: inline-block;
        height: 48px;
        color: #333;
        padding: 0px 20px;
        border: none;
        box-shadow: 0px 0px 5px #0000000a;
    }

    .shopping-cart .total-amount .left .coupon form .btn {
        display: inline-block;
        height: 48px;
        border: navajowhite;
        margin-left: 4px;
        background: transparent;
        color: #333;
        background: #fff;
        box-shadow: 0px 0px 5px #00000012;
    }

    .shopping-cart .total-amount .left .coupon form .btn:hover {
        background: #fff;
        color: #F7941D;
    }

    .shopping-cart .total-amount .left label {
        font-size: 22px;
        font-weight: 500;
        color: #333;
    }

    .shopping-cart .total-amount .left .checkbox {
        text-align: left;
        margin: 0;
        margin-top: 20px;
    }

    .shopping-cart .total-amount .left .checkbox label {
        font-size: 15px;
        font-weight: 400;
        color: #333;
        position: relative;
        padding-left: 30px;
    }

    .shopping-cart .total-amount .left .checkbox label:hover {
        cursor: pointer;
    }

    .shopping-cart .total-amount .left .checkbox label input {
        display: none;
    }

    .shopping-cart .total-amount .left .checkbox label::before {
        position: absolute;
        content: "";
        left: 0;
        top: 4px;
        width: 16px;
        height: 16px;
        border: 1px solid #555555;
        border-radius: 0px;
    }

    .shopping-cart .total-amount .left .checkbox label::after {
        position: absolute;
        content: "\f00c";
        font-family: "Fontawesome";
        left: 0;
        top: 0;
        width: 22px;
        height: 22px;
        line-height: 24px;
        left: 3px;
        top: 0px;
        opacity: 0;
        visibility: hidden;
        transform: scale(0);
        -webkit-transition: all 0.4s ease;
        -moz-transition: all 0.4s ease;
        transition: all 0.4s ease;
        display: block;
        font-size: 11px;
    }

    .shopping-cart .total-amount .left .checkbox label.checked::after {
        opacity: 1;
        visibility: visible;
        transform: scale(1);
    }

    .shopping-cart .total-amount .right {
        padding-right: 1em;
    }

    .shopping-cart .total-amount .right ul {
        list-style: none;
    }

    .shopping-cart .total-amount .right ul li {
        font-size: 15px;
        font-weight: 400;
        color: #333;
        margin-bottom: 12px;
    }

    .shopping-cart .total-amount .right ul li.last {
        padding-top: 12px;
        border-top: 1px solid #c8c8c8;
        color: #333;
        font-size: 15px;
        font-weight: 400;
    }

    .shopping-cart .total-amount .right ul li span {
        display: inline-block;
        float: right;
    }

    .shopping-cart .total-amount .right .button5 .btn {
        text-align: center;
        border-radius: 0;
        width: 100%;
        margin-top: 10px;
        height: 46px;
        line-height: 18px;
        font-size: 13px;
        color: #fff;
    }

    .label-danger {
        background-color: #3f51b5;
    }

    .label {
        display: inline;
        padding: .2em .6em .3em;
        /* font-size: 75%; */
        font-weight: 700;
        line-height: 1;
        color: #fff;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: .25em;
    }

    /*======================================
   End Shopping Cart CSS
========================================*/
    @media (max-width: 992px) {

        page[size="A4"] {
            width: 100%;
        }
    }
</style>
<br><br>
<page size="A4">
    <?php

    ?>
    <!-- Shopping Cart -->
    <div class="shopping-cart section">



        <?php

        $subtotal = 0;
        $extra_price = 0;

        if (count($orderDetail['items']) > 0) {
            $chk_item = 0;
            $fild = 1;
        ?>
            <!-- Shopping Summery -->
            <table class="table shopping-summery">
                <thead>
                    <tr class="main-hading">
                        <th>รูปภาพ</th>
                        <th>ชือสินค้า</th>
                        <th class="text-center">ราคา/หน่วย</th>
                        <th class="text-center" width="50">จำนวนสั่งซื้อ</th>
                        <th class="text-center">ยอดรวม</th>

                    </tr>
                </thead>
                <tbody>


                    <?php foreach ($orderDetail['items'] as $items) { ?>
                        <tr>
                            <td class="image" data-title="No"><img src="<?= base_url() ?>uploads/product/<?= $items['product_img'] ?>" alt="#">
                            </td>
                            <td class="product-des" data-title="Description">
                                <p class="product-name"><?= $items['product_name'] ?></p>
                                <p class="product-des"></p>
                            </td>
                            <td class="price" data-title="Price"><span>฿<?= $items['product_price'] ?>.-</span></td>
                            <td class="qty" data-title="Qty" width="50">
                                <!-- Input Order -->
                                <div class="input-group">

                                    <input type="text" name="quant[<?= $fild ?>]" class="input-number" data-min="1" data-max="100" value="<?= $items['quantity'] ?>" readonly>

                                </div>
                                <!--/ End Input Order -->
                            </td>
                            <td class="total-amount" data-title="Total"><span>฿<?= $items["sub_total"] ?>.-</span></td>

                        </tr>
                    <?php
                        $fild++;
                    } ?>

                </tbody>
            </table>

        <?php } else { ?>





        <?php } ?>
        <!--/ End Shopping Summery -->
        <!-- Total Amount -->
        <div class="total-amount">
            <div class="row">
                <div class="col-lg-6 col-md-5 col-12">
                    <div class="left">
                        <!--  <div class="coupon">
                                    <form action="#" target="_blank">
                                        <input name="Coupon" placeholder="Enter Your Coupon">
                                        <button class="btn">Apply</button>
                                    </form>
                                </div>
                                <div class="checkbox">
                                    <label class="checkbox-inline" for="2"><input name="news" id="2" type="checkbox">
                                        Shipping (+10$)</label>
                                </div> -->
                    </div>
                </div>
                <?php
                $grandTotal = number_format($orderDetail['order_grandtotal'], 2);
                $text_payment = ($orderDetail['order_payment'] == 1) ? 'จ่ายเต็มจำนวน' : 'จ่ายมัดจำ';
                $text_shipping = ($orderDetail['order_shipping'] == 1) ? 'รับเองที่ฟาร์ม' : 'จัดส่งที่บ้าน';


                ?>
                <div class="col-lg-6 col-md-7 col-12">
                    <div class="right">
                        <ul>
                            <!-- <li>ยอดรวมสินค้า<span>฿< ?php echo number_format($orderDetail['order_grandtotal'], 2) ?>.-</span> -->
                            </li>
                            <li>การชำระเงิน<span class="label label-danger"><?= $text_payment ?></span></li>
                            <li>การจัดส่ง<span class="label label-danger"><?= $text_shipping ?></span></li>
                            <li class="last">ยอดรวมทั้งสิ้น<b><span>฿<?= $grandTotal?>.-</span></b>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
        <!--/ End Total Amount -->
    </div>


    <!--/ End Shopping Cart -->
    <div class="modal-footer">

        <button type="button" class="btn btn-dark btn-pill" id="smrSubmit">ปริ้นรายละเอียด</button>

    </div>

</page>

<!-- < ?php $this->load->view('user_elements/core_pluins'); ?> -->
<script type="text/javascript" src="<?= base_url() ?>assets/plugin/printthis/printThis.js"></script>
<script>
    $('#smrSubmit').click(function(e) {

        $('.shopping-cart').printThis({
            pageTitle: "Shop name",
            header: null, // prefix to html
            footer: null, // postfix to html
            importCSS: true, // import parent page css
            importStyle: true, // import style tags
        });

    });
</script>