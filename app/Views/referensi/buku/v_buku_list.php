<?= $this->extend('main'); ?>
<?= $this->section('content'); ?>

<div class="content-body">
    <div class="container-fluid mt-3">
        <div id="content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <?php if (isset($_SESSION['message'])) { ?>
                            <script type="text/javascript">
                            window.setTimeout(function() {
                                $(".alert").alert('close');
                            }, 3000);
                            </script>
                            <div class="alert alert-success">
                                <strong><b>Info! </b><br></strong><?php echo $_SESSION['message']; ?>
                            </div>
                            <?php } ?>
                            <?php if (isset($_SESSION['err'])) { ?>
                            <script type="text/javascript">
                            window.setTimeout(function() {
                                $(".alert").alert('close');
                            }, 5000);
                            </script>
                            <div class="alert alert-error">
                                <strong>Warning! </strong><?php echo $_SESSION['err']; ?>
                            </div>
                            <?php }  ?>
                            <div class="col-md-12">
                                <div class="col-md-3 pull-right">
                                    <div class="homeSearch w-100"
                                        style="width: 100%; margin-left: 5%; margin-bottom: 25px;">
                                        <input type="text" id="tb-search" class="form-control"
                                            placeholder="Search . . .">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <a href="data_buku/add" class="btn btn-primary"><i class="fa fa-plus"></i>
                                        Tambah Data Buku</a>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div id="dt-list" class="table-responsive table-striped"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL TAMBAH-->
<!-- <div class="modal" id="modalTambah" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <h2 class="title-1"><strong>Tambah</strong> Data Buku</h2>
                </h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card-body card-block">
                    <form action="data_buku/add" method="post" class="form-horizontal">
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="val-confirm-password">ISBN
                            </label>
                            <div class="col-lg-8">
                                <input type="number" class="form-control" id="val-confirm-password" name="isbn"
                                    placeholder="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="val-email">Judul Buku
                            </label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" id="val-email" name="judul" placeholder="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="val-email">Penulis
                            </label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" id="val-email" name="penulis" placeholder="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="val-confirm-password">Penerbit
                            </label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" id="val-confirm-password" name="penerbit"
                                    placeholder="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="val-confirm-password">Tahun Terbit
                            </label>
                            <div class="col-lg-8">
                                <input type="number" class="form-control" id="val-confirm-password" name="tahun_terbit"
                                    placeholder="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="val-confirm-password">Jumlah Halaman
                            </label>
                            <div class="col-lg-8">
                                <input type="number" class="form-control" id="val-confirm-password"
                                    name="jumlah_halaman" placeholder="">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> -->
<!-- END MODAL TAMBAH-->

<?= $this->endSection('content'); ?>
<?= $this->section('script'); ?>
<script>
let dtList = new Tabulator("#dt-list", {
    columns: [{
            title: "#",
            field: "aksi",
            headerSort: false,
            formatter: "html",
            width: "10%"
        },

        {
            title: "ISBN",
            field: "isbn",
            sorter: "string",
            formatter: "html",
            width: "15%"
        },
        {
            title: "Judul",
            field: "judul",
            sorter: "string",
            width: "50%"
        },
        {
            title: "Penulis",
            field: "penulis",
            sorter: "string",
            width: "20%"
        },
        {
            title: "Penerbit",
            field: "penerbit",
            sorter: "string",
            width: "15%"
        },
        {
            title: "Tahun Terbit",
            field: "tahun_terbit",
            sorter: "string",
            width: "12%"
        },
        {
            title: "Jumlah Halaman",
            field: "jumlah_halaman",
            sorter: "string",
            width: "15%"
        },
    ],
    placeholder: 'Tidak Ada Data',
    ajaxURL: window.location.origin + "/data_buku/lists",
    ajaxConfig: "POST",
    sortMode: "remote",
    filterMode: "remote",
    ajaxRequesting: function(url, params) {
        params.start = params.size * (params.page - 1);
        params.length = params.size;
    },
    ajaxResponse: function(url, params, response) {
        let pageSize = dtList.getPageSize();
        let pageNo = dtList.getPage();
        let startRow = (pageSize * (pageNo - 1)) + 1;
        let endRow = response.data.length + startRow - 1;
        if (response.data.length === 0) {
            startRow = 0;
            endRow = 0;
        }
        let recordsFiltered = parseInt(response.recordsFiltered);
        let recordsTotal = parseInt(response.recordsTotal);

        $("#table-footer .tabulator-startrow").text(startRow);
        $("#table-footer .tabulator-endrow").text(endRow);
        $("#table-footer .tabulator-totalrow").text(recordsFiltered);

        let elTotalFilteredRow = $("#table-footer .tabulator-totalfilteredrow");
        elTotalFilteredRow.text("");
        if (recordsTotal > recordsFiltered) {
            elTotalFilteredRow.text(" (disaring dari " + recordsTotal +
                " entri keseluruhan)");
        }
        return response;
    },
    footerElement: '<div id="table-footer" class="pull-left tabulator-info">' +
        'Menampilkan <span class="tabulator-startrow"></span> - <span class="tabulator-endrow"></span> dari ' +
        '<span class="tabulator-totalrow"></span> entri<span class="tabulator-totalfilteredrow"></span></div>',
    pagination: true,
    paginationMode: "remote",
    paginationSize: 10,
    paginationButtonCount: 10,
    dataSendParams: {
        sorters: "sort"
    },
    selectable: false,
    placeholder: "Data tidak tersedia",
});

// dtList.on("dataProcessed", () => {
//     // confirmDelete();
//     confirmActive();
// });

let searchThread = null;
let elSearch = $("#tb-search");
if (elSearch != null) {
    elSearch.change(function(e) {
        if ($(this).val().length < 3 && e.keyCode > 13) {
            return;
        }
        clearTimeout(searchThread);
        searchThread = setTimeout(function() {
            dtList.setFilter("", "like", elSearch.val());
        }, 600);
    });
}

function hapus(id) {

    Swal.fire({
        title: 'Apakah kamu yakin ingin menghapus data ini?',
        text: "Data Yang telah dihapus tidak dapat dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Delete',
    }).then((result) =>{
        if (result.isConfirmed) {
            console.log(id)
            $.ajax({
                url: window.location.origin + "/data_buku/delete/" + id,
                type: 'GET',
                success: function(data) {
                    Swal.fire(
                        'Delete!',
                        'Data telah berhasil dihapus',
                        'success'
                    )
                    dtList.setData();
                    dtList.redraw(true);
                }
            })
        }
    })

}
</script>
<?= $this->endSection('script'); ?>