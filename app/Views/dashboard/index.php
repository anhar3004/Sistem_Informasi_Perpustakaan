<?= $this->extend('main'); ?>
<?= $this->section('content'); ?>
<!--**********************************
    Content body start
***********************************-->
<div class="content-body">

    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-md-12 ">
                <div class="card gradient-4">
                    <div class="card-body ">
                        <h1 class="title-1 text-white">Welcome <strong>"Anhar Hadhitya" </strong> </h1>
                        <h4 class="text-white">"Selamat pagi, semoga aktivitas kamu berjalan lancar"</h4>
                        <br>
                        <div class="progress" style="height: 6px">
                            <div class="progress-bar " style="width: 100%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-sm-6">
                <div class="card gradient-1">
                    <div class="card-body">
                        <h3 class="card-title text-white">Total Buku</h3>
                        <div class="d-inline-block">
                            <h2 class="text-white">75</h2>
                            <p class="text-white mb-0">2019-2023</p>
                        </div>
                        <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-sm-6">
                <div class="card gradient-2">
                    <div class="card-body">
                        <h3 class="card-title text-white">Total Anggota</h3>
                        <div class="d-inline-block">
                            <h2 class="text-white">20</h2>
                            <p class="text-white mb-0">2019-2023</p>
                        </div>
                        <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- #/ container -->
</div>
<!--**********************************
    Content body end
***********************************-->
<?= $this->endSection('content'); ?>