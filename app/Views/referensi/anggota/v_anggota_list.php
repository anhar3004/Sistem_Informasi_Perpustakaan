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
                                    <a href="data_anggota/add" class="btn btn-primary"><i class="fa fa-plus"></i>
                                        Tambah Data Anggota</a>
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
            title: "Nama Lengkap",
            field: "nama_lengkap",
            sorter: "string",
            formatter: "html",
            width: "15%"
        },
        {
            title: "No Telpon",
            field: "no_hp_wa",
            sorter: "string",
            width: "25%"
        },
        {
            title: "Email",
            field: "email",
            sorter: "string",
            width: "25%"
        },
        {
            title: "Alamat",
            field: "alamat",
            sorter: "string",
            width: "25%"
        },
    ],
    placeholder: 'Tidak Ada Data',
    ajaxURL: window.location.origin + "/data_anggota/lists",
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
                url: window.location.origin + "/data_anggota/delete/" + id,
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