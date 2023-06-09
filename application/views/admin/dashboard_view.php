<style>
    .custom-file-label {
        overflow: hidden;
    }
</style>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Dashboard</h1>
    <!-- h2>วันนี้: < ?php echo date("Y-m-d");?></h2> -->

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card  bg-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                                สมาชิกทั้งหมด</div>
                            <div class="h5 mb-0 font-weight-bold text-white"><?= $users ?> User</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card bg-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                                สินค้าทั้งหมด</div>
                            <div class="h5 mb-0 font-weight-bold text-white"><?= $products ?> รายการ</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-horse fa-2x text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card bg-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                                รอดำเนินการ</div>
                            <div class="h5 mb-0 font-weight-bold text-white"><?= $orders ?> รายการ</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="col-xl-3 col-md-6 mb-4">
            <div class="card bg-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                                ยอดขายเดือนนี้</div>
                            <div class="h5 mb-0 font-weight-bold text-white">฿<?= number_format($total['sum'], 2) ?>.-</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-chart-bar fa-2x text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
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
<?php $this->load->view('themplate/footer'); ?>