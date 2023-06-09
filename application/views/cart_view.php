<style>
    .table {

        height: auto !important;
    }
</style>
<?php
@$remove = $_GET['remove'];
if ($remove == 1) { ?>
    <script>
        Swal.fire({
            title: 'Success',
            text: 'ลบรายการออกจากตะกร้าเรียบร้อย',
            icon: 'success',
        })
    </script>
<?php } ?>
<!-- cart-main-area start -->
<div class="cart-main-area ptb--120 bg__white">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <?php

                $subtotal = 0;
                $extra_price = 0;

                if (count($this->cart->contents()) > 0) {
                    $chk_item = 0;
                    $fild = 1;
                ?>
                    <!-- Shopping Summery -->
                    <div class="table-content table-responsive">
                        <table class="table shopping-summery ">
                            <thead>
                                <tr class="main-hading ">
                                    <th class=" product-thumbnail">รูปสินค้า</th>
                                    <th class=" product-name">ชื่อสินค้า</th>
                                    <th class="text-center product-price">ราคา/หน่วย</th>
                                    <th class="text-center product-quantity" width="200">จำนวนสั้งซื้อ</th>
                                    <th class="text-center product-subtotal">ยอดรวม</th>
                                    <th class="text-center product-remove"><i class="ti-trash remove-icon"></i></th>
                                </tr>
                            </thead>
                            <tbody>


                                <?php foreach ($this->cart->contents() as $items) { ?>
                                    <tr>
                                        <td class="image product-thumbnail" data-title="No"><img src="<?= base_url() ?>uploads/product/<?= $items['image'] ?>" alt="#">
                                        </td>
                                        <td class="product-des" data-title="Description">
                                            <p class="product-name"><?= $items['name'] ?></p>
                                            <!-- <p class="product-des">Maboriosam in a tonto nesciung eget distingy magndapibus.</p> -->
                                        </td>
                                        <td class="price text-center" data-title="Price"><span>฿<?= number_format($items['price']) ?>.-</span></td>
                                        <td class="qty text-center" data-title="Qty">
                                            <!-- Input Order -->
                                            <div class="input-group">
                                                <div class="input-group-btn button minus ">
                                                    <button type="button" class="btn btn-default btn-number quantity-left-minus" data-type="minus" data-field="quant<?= $fild ?>" data-rowid="<?= $items['rowid'] ?>">
                                                        <i class="ti-minus"></i>
                                                    </button>
                                                </div>
                                                <input type="text" name="quant<?= $fild ?>" class="form-control input-number text-center" id="quant<?= $fild ?>" data-min="1" data-max="100" value="<?= $items['qty'] ?>" onchange="updateCartItem(this, '<?= $items['rowid'] ?>')">
                                                <div class="input-group-btn button plus">
                                                    <button type="button" class="btn btn-default btn-number quantity-right-plus" data-type="plus" data-field="quant<?= $fild ?>" data-rowid="<?= $items['rowid'] ?>">
                                                        <i class="ti-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <!--/ End Input Order -->
                                        </td>
                                        <td class="total-amount text-center" data-title="Total"><span>฿<?= number_format($items["subtotal"]) ?>.-</span></td>
                                        <td class="action text-center" data-title="Remove"><a href="javascript:void(0)" onclick="removeCartItem('<?= $items['rowid'] ?>')"><i class="ti-trash remove-icon"></i></a>
                                        </td>
                                    </tr>
                                <?php
                                    $fild++;
                                } ?>

                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-md-8 col-sm-7 col-xs-12">
                            <div class="buttons-cart">
                                <!-- <input type="submit" value="Update Cart" /> -->
                                <a href="<?=base_url('')?>shop">สั่งซื้อสินค้าเพิ่มเติม</a>
                            </div>
                            <!-- <div class="coupon">
                                <h3>Coupon</h3>
                                <p>Enter your coupon code if you have one.</p>
                                <input type="text" placeholder="Coupon code" />
                                <input type="submit" value="Apply Coupon" />
                            </div> -->
                        </div>
                        <div class="col-md-4 col-sm-5 col-xs-12">
                            <div class="cart_totals">
                                <h2>Cart Totals</h2>
                                <table>
                                    <tbody>
                                        <!-- <tr class="cart-subtotal">
                                            <th>Subtotal</th>
                                            <td><span class="amount">£215.00</span></td>
                                        </tr> -->
                                        <tr class="shipping">
                                            <th></th>
                                            <td>
                                                <!--  <ul id="shipping_method">
                                                    <li>
                                                        <input type="radio" />
                                                        <label>
                                                            Flat Rate: <span class="amount">£7.00</span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <input type="radio" />
                                                        <label>
                                                            Free Shipping
                                                        </label>
                                                    </li>
                                                    <li></li>
                                                </ul> -->
                                                <p><a class="shipping-calculator-button" href="#">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ยอดรวมทั้งหมด</a></p>
                                            </td>
                                        </tr>
                                        <tr class="order-total">
                                            <th>Total</th>
                                            <td>
                                                <strong><span class="amount">฿<?php echo $this->cart->format_number($this->cart->total()); ?></span></strong>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="wc-proceed-to-checkout">
                                    <a href="<?= base_url() ?>checkout">สั่งซื้อสินค้าและชำระเงิน</a>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php } else { ?>
                    <div class="text-center">
                        <h2>ยังไม่มีสินค้าในตระกร้า</h2>
                        <div class="wc-proceed-to-checkout">
                            <a href="<?= base_url() ?>shop">เลือกซื้อสินค้า</a>
                            <br><br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>

                        </div>
                    </div>






                <?php } ?>
            </div>
        </div>
    </div>
</div>
<!-- cart-main-area end -->


<?php $this->load->view('templateuser/footer'); ?>
<!-- Page level plugins -->

<script>
    $(document).ready(function() {
        var quantitiy = 0;
        $(".quantity-right-plus").click(function(e) {
            e.preventDefault();
            var id = $(this).data("field");
            var rowId = $(this).data("rowid");
            console.log(rowId);
            var quantity = parseInt($("#" + id).val());
            $("#" + id).val(quantity + 1);
            let obj = {
                value: quantity + 1
            };
            updateCartItem(obj, rowId);


        });

        $(".quantity-left-minus").click(function(e) {
            e.preventDefault();
            var id = $(this).data("field");
            var rowId = $(this).data("rowid");
            console.log(rowId);
            var quantity = parseInt($("#" + id).val());



            if (quantity > 1) {
                let obj = {
                    value: quantity - 1
                };
                $("#" + id).val(quantity - 1);
                updateCartItem(obj, rowId);
            }

        });
    });
    /* Update item quantity */
    function updateCartItem(obj, rowid) {
        $.get("<?php echo base_url('cart/updateItemQty/'); ?>", {
            rowid: rowid,
            qty: obj.value
        }, function(resp) {
            if (resp == 'ok') {
                location.reload();
                /* Swal.fire({
                    title: 'Success',
                    text: 'อัพเดตจำนวนเรียบร้อย',
                    icon: 'success',
                }).then((result) => {
                    if (result.value) {
                        location.reload();
                    }
                }) */
            }
        });
    }


    function removeCartItem(rowid) {

        $.get("<?php echo base_url('cart/removeItem/'); ?>", {
            rowid: rowid,
        }, function(res) {
            if (res == 'ok') {

                Swal.fire({
                    title: 'Success',
                    text: 'ลบรายการของจากตะกร้าเรียบร้อย',
                    icon: 'success',
                }).then((result) => {
                    if (result.value) {
                        location.reload();
                    }
                })

            } else {
                alert('error');
            }
        });
    }
</script>