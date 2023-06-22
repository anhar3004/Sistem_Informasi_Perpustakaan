<?= $this->extend('main'); ?>
<?= $this->section('content'); ?>

<div class="content-body">
    <div class="container-fluid mt-3">
        <div id="content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h2><?= $titlehead ?></h2>
                            <br>
                            <form action="<?= current_url() ?>" method="post" class="form-horizontal">
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-confirm-password">ISBN
                                    </label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" id="val-confirm-password" name="isbn"
                                            placeholder="" value="<?= $buku->isbn ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-email">Judul Buku
                                    </label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" id="val-email" name="judul"
                                            placeholder="" value="<?= $buku->judul ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-email">Penulis
                                    </label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" id="val-email" name="penulis"
                                            placeholder="" value="<?= $buku->penulis ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-confirm-password">Penerbit
                                    </label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" id="val-confirm-password"
                                            name="penerbit" placeholder="" value="<?= $buku->penerbit ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-confirm-password">Tahun Terbit
                                    </label>
                                    <div class="col-lg-8">
                                        <input type="number" class="form-control" id="val-confirm-password"
                                            name="tahun_terbit" placeholder="" value="<?= $buku->tahun_terbit ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-confirm-password">Jumlah Halaman
                                    </label>
                                    <div class="col-lg-8">
                                        <input type="number" class="form-control" id="val-confirm-password"
                                            name="jumlah_halaman" placeholder="" value="<?= $buku->jumlah_halaman ?>">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <a href="/data_buku" type="button" class="btn btn-secondary" >Close</a>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection('content'); ?>