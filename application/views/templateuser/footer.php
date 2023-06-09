<?php
$user_id =  $this->session->userdata('user_id');
$nickname =  $this->session->userdata('nickname');
$role_user =  $this->session->userdata('');
$logged_in =  $this->session->userdata('logged_in');

?>
 <!-- Start Footer Area -->
 <footer class="htc__foooter__area gray-bg">
     <div class="container">
         <div class="row">
             <div class="footer__container clearfix">
                 <!-- Start Single Footer Widget -->
                 <div class="col-md-3 col-lg-3 col-sm-6">
                     <div class="ft__widget">
                         <div class="ft__logo">
                             <a href="<?= base_url('') ?>">
                                 <h2>Shop name</h2>
                             </a>
                         </div>
                         <div class="footer-address">
                             <ul>
                                 <li>
                                     <div class="address-icon">
                                         <i class="zmdi zmdi-pin"></i>
                                     </div>
                                     <div class="address-text">
                                         <p> Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores deserunt, consequatur, provident eveniet distinctio, sed iure recusandae quos esse soluta nobis incidunt pariatur minus! Nulla exercitationem labore corporis cupiditate quam.</p>
                                     </div>
                                 </li>
                                 <li>
                                     <div class="address-icon">
                                         <i class="zmdi zmdi-email"></i>
                                     </div>
                                     <div class="address-text">
                                         <a href="#"> info@example.com</a>
                                     </div>
                                 </li>
                                 <li>
                                     <div class="address-icon">
                                         <i class="zmdi zmdi-phone-in-talk"></i>
                                     </div>
                                     <div class="address-text">
                                         <p>+012 345 678 102 </p>
                                     </div>
                                 </li>
                             </ul>
                         </div>
                         <ul class="social__icon">
                             <li><a href="#"><i class="zmdi zmdi-twitter"></i></a></li>
                             <li><a href="#"><i class="zmdi zmdi-instagram"></i></a></li>
                             <li><a href="#"><i class="zmdi zmdi-facebook"></i></a></li>
                             <li><a href="#"><i class="zmdi zmdi-google-plus"></i></a></li>
                         </ul>
                     </div>
                 </div>
                 <!-- End Single Footer Widget -->
                 <!-- Start Single Footer Widget -->
                 <!-- <div class="col-md-3 col-lg-2 col-sm-6 smt-30 xmt-30">
                     <div class="ft__widget">
                         <h2 class="ft__title">Categories</h2>
                         <ul class="footer-categories">
                             <li><a href="shop-sidebar.html">Men</a></li>
                             <li><a href="shop-sidebar.html">Women</a></li>
                             <li><a href="shop-sidebar.html">Accessories</a></li>
                             <li><a href="shop-sidebar.html">Shoes</a></li>
                             <li><a href="shop-sidebar.html">Dress</a></li>
                             <li><a href="shop-sidebar.html">Denim</a></li>
                         </ul>
                     </div>
                 </div> -->
                 <!-- Start Single Footer Widget -->
                 <div class="col-md-6 col-lg-2 col-sm-6 smt-30 xmt-30">
                     <div class="ft__widget">
                         <h2 class="ft__title">เมนู</h2>
                         <ul class="footer-categories">
                             <li ><a href="<?= base_url() ?>">หน้าแรก</a></li>
                             <!-- <li class="drop"><a href="shop">หมวดหมู่สินค้า</a></li> -->
                             <li ><a href="<?= base_url() ?>shop">สินค้าทั้งหมด</a></li>
                             <?php if ($logged_in) { ?>
                                 <li><a href="<?= base_url() ?>order/tracking">รายการสั่งซื้อของฉัน</a></li>
                             <?php }  ?>
                         </ul>
                     </div>
                 </div>
                 <!-- Start Single Footer Widget -->
                 <div class="col-md-3 col-lg-3 col-lg-offset-1 col-sm-6 smt-30 xmt-30">
                     <div class="ft__widget">
                         <h2 class="ft__title">เกี่ยวกับเรา</h2>
                         <div class="newsletter__form">
                             <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Asperiores expedita in aperiam commodi perspiciatis suscipit tenetur rerum necessitatibus ipsa nostrum consequatur minima atque, blanditiis incidunt quos, nam placeat, voluptates inventore?</p>
                             <div class="input__box">
                                 <!-- <div id="mc_embed_signup">
                                     <form action="#" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                                         <div id="mc_embed_signup_scroll" class="htc__news__inner">
                                             <div class="news__input">
                                                 <input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="Email Address" required>
                                             </div>
                                             real people should not fill this in and expect good things - do not remove this or risk form bot signups
                                             <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_6bbb9b6f5827bd842d9640c82_05d85f18ef" tabindex="-1" value=""></div>
                                             <div class="clearfix subscribe__btn"><input type="submit" value="Send" name="subscribe" id="mc-embedded-subscribe" class="bst__btn btn--white__color">

                                             </div>
                                         </div>
                                     </form>
                                 </div> -->
                             </div>
                         </div>
                     </div>
                 </div>
                 <!-- End Single Footer Widget -->
             </div>
         </div>
         <!-- Start Copyright Area -->
         <!-- <div class="htc__copyright__area">
             <div class="row">
                 <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                     <div class="copyright__inner">
                         <div class="copyright">
                             <p>© 2017 <a href="https://freethemescloud.com/">Free themes Cloud</a>
                                 All Right Reserved.</p>
                         </div>
                         <ul class="footer__menu">
                             <li><a href="index.html">Home</a></li>
                             <li><a href="shop.html">Product</a></li>
                             <li><a href="contact.html">Contact Us</a></li>
                         </ul>
                     </div>
                 </div>
             </div>
         </div> -->
         <!-- End Copyright Area -->
     </div>
 </footer>
 <!-- End Footer Area -->
 </div>
 <!-- Body main wrapper end -->
 <!-- QUICKVIEW PRODUCT -->
 <div id="quickview-wrapper">
     <!-- Modal -->
     <div class="modal fade" id="productModal" tabindex="-1" role="dialog">
         <div class="modal-dialog modal__container" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                 </div>
                 <div class="modal-body">
                     <div class="modal-product">

                     </div><!-- .modal-product -->
                 </div><!-- .modal-body -->
             </div><!-- .modal-content -->
         </div><!-- .modal-dialog -->
     </div>
     <!-- END Modal -->
 </div>
 <!-- END QUICKVIEW PRODUCT -->
 <!-- Placed js at the end of the document so the pages load faster -->


 <!-- Bootstrap framework js -->
 <script src="<?= base_url() ?>assets/eshop/js/bootstrap.min.js"></script>
 <!-- All js plugins included in this file. -->
 <script src="<?= base_url() ?>assets/eshop/js/plugins.js"></script>
 <script src="<?= base_url() ?>assets/eshop/js/slick.min.js"></script>
 <script src="<?= base_url() ?>assets/eshop/js/owl.carousel.min.js"></script>
 <!-- Waypoints.min.js. -->
 <script src="<?= base_url() ?>assets/eshop/js/waypoints.min.js"></script>
 <!-- Main js file that contents all jQuery plugins activation. -->
 <script src="<?= base_url() ?>assets/eshop/js/main.js"></script>
 <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

 <script>
     function getProduct(ID) {

         $.ajax({
             type: "GET",
             url: "<?= base_url() ?>product/getProduct/" + ID,
             dataType: "JSON",
             success: function(response) {
                 $('.modal-product').html(response.html);

             }
         });
         $('#productModal').modal('show');



     }

     function addcart(ID, stock) {
         var qty = $("#quantity").val();

         if (qty > stock) {
             Swal.fire({
                 title: "แจ้งเตือน!",
                 text: "ไม่สามารถสั่งเกินสต็อกสินค้าได้",
                 icon: "error",
                 confirmButtonColor: "#304ffe"
             });

             return false;
         }

         $.ajax({
             type: "POST",
             url: "<?= base_url() ?>Product/addToCart/" + ID,
             data: {
                 qty: qty,
                 stock: stock
             },
             dataType: "JSON",
             success: function(response) {
                 if (response.status == 200) {
                     Swal.fire({
                         title: 'Success',
                         text: response.msg,
                         icon: 'success',
                     }).then((result) => {
                         if (result.value) {
                             location.href = "<?= base_url('') ?>cart";
                         }
                     })

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
 </script>

 </body>

 </html>