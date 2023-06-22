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
                                    <label class="col-lg-4 col-form-label" for="val-confirm-password">Nama Lengkap
                                    </label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" id="val-confirm-password"
                                            name="nama_lengkap" placeholder="" value="<?= $anggota->nama_lengkap ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-confirm-password">No Handphone
                                    </label>
                                    <div class="col-lg-8">
                                        <input type="number" class="form-control" id="val-confirm-password"
                                            name="no_hp_wa" placeholder="" value="<?= $anggota->no_hp_wa ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-email">Email
                                    </label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" id="val-email" name="email"
                                            placeholder="" value="<?= $anggota->email ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-email">Alamat
                                    </label>
                                    <div class="col-lg-8">
                                        <textarea class="form-control" id="alamat" name="alamat" rows="4" cols="5"><?= $anggota->alamat ?></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <a href="/data_anggota" type="button" class="btn btn-secondary">Close</a>
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