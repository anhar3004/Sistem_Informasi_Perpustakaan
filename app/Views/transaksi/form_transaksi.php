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
                                    <label class="col-lg-4 col-form-label" for="val-confirm-password">Judul Buku
                                    </label>
                                    <div class="col-lg-8">
                                        <select class="form-control" name="judul" id="cars">
                                            <?php foreach ($list_buku as $row) : ?>
                                            <option value="<?= $row->buku_id ?>"
                                                <?php if ($buku_id == $row->buku_id ) echo 'selected '?>>
                                                <?= $row->judul ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-confirm-password">Nama Lengkap
                                    </label>
                                    <div class="col-lg-8">
                                        <select class="form-control" name="nama_lengkap" id="cars">
                                            <?php foreach ($list_anggota as $row) : ?>
                                            <option value="<?= $row->anggota_id ?>"
                                                <?php if ($anggota_id == $row->anggota_id ) echo 'selected '?>>
                                                <?= $row->nama_lengkap ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-email">Tanggal Peminjaman
                                    </label>
                                    <div class="col-lg-8">
                                        <input class="form-control" type="date" id="start" name="tgl_peminjaman" value="<?= date('Y-m-d', strtotime($transaksi->tgl_peminjaman)) ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-email">Tanggal Pengembalian
                                    </label>
                                    <div class="col-lg-8">
                                        <input class="form-control" type="date" id="start" name="tgl_pengembalian" value="<?= date('Y-m-d', strtotime($transaksi->tgl_pengembalian)) ?>">
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