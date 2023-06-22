<!DOCTYPE html>
<html lang="en">

<head>
    <!-- <meta name="csrf-token" content="{{ csrf_token() }}"> -->
    <base href="<?= base_url(); ?>">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Sistem Informasi Perpustakaan</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="template/images/favicon.png">
    <!-- Pignose Calender -->
    <link href="template/plugins/pg-calendar/css/pignose.calendar.min.css" rel="stylesheet">
    <!-- Chartist -->
    <link rel="stylesheet" href="template/plugins/chartist/css/chartist.min.css">
    <!-- {{--  <link rel="stylesheet"
        href="template/plugins/chartist-plugin-tooltips/css/chartist-plugin-tooltip.css">  --}} -->
    <!-- Table -->
    <link href="template/plugins/tables/css/datatable/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- Custom Stylesheet -->
    <link href="template/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css"
        rel="stylesheet">
    <!-- Page plugins css -->
    <link href="template/plugins/clockpicker/dist/jquery-clockpicker.min.css" rel="stylesheet">
    <!-- Color picker plugins css -->
    <link href="template/plugins/jquery-asColorPicker-master/css/asColorPicker.css" rel="stylesheet">
    <!-- Date picker plugins css -->
    <link href="template/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet">
    <!-- Daterange picker plugins css -->
    <link href="template/plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
    <link href="template/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <!-- Tabulator - https://tabulator.info/docs/5.4 -->
    <link href="template/plugins/tabulator-tables/dist/css/tabulator_bootstrap5.min.css" rel="stylesheet">

    <!-- {{--  <link href="template/plugins/sweetalert/css/sweetalert.css" rel="stylesheet">  --}} -->
    <link href="template/plugins/toastr/css/toastr.min.css" rel="stylesheet">
    <!-- Custom Stylesheet -->
    <link href="template/css/style.css" rel="stylesheet">
    

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script>
    <!-- {{--  <script src="js/bootstrap.min.js"></script>  --}} -->

</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->


    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <?= $this->include('layout/header') ?>
        <?= $this->include('layout/sidebar') ?>
        <?= $this->renderSection('content') ?>

        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Copyright &copy; Anhar Hadhitya
                    2023</p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <script src="template/plugins/common/common.min.js"></script>
    <script src="template/js/custom.min.js"></script>
    <script src="template/js/settings.js"></script>
    <script src="template/js/gleek.js"></script>
    <script src="template/js/styleSwitcher.js"></script>

    <!-- Chartjs -->
    <!-- {{--  <script src="template/plugins/chart.js/Chart.bundle.min.js"></script>  --}} -->
    <!-- Circle progress -->
    <script src="template/plugins/circle-progress/circle-progress.min.js"></script>
    <!-- Datamap -->
    <!-- {{--  <script src="template/plugins/d3v3/index.js"></script>
    <script src="template/plugins/topojson/topojson.min.js"></script>
    <script src="template/plugins/datamaps/datamaps.world.min.js"></script> --}} -->
    <!-- Morrisjs -->
    <!-- {{--  <script src="template/plugins/raphael/raphael.min.js"></script>
    <script src="template/plugins/morris/morris.min.js"></script> --}} -->
    <!-- Pignose Calender -->
    <script src="template/plugins/moment/moment.min.js"></script>
    <script src="
                    template/plugins/pg-calendar/js/pignose.calendar.min.js"></script>
    <!-- ChartistJS -->
    <!-- {{--  <script src="template/plugins/chartist/js/chartist.min.js"></script>
    <script src="template/plugins/chartist-plugin-tooltips/js/chartist-plugin-tooltip.min.js"></script>  --}} -->
    <script src="template/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js">
    </script>
    <!-- Clock Plugin JavaScript -->
    <script src="template/plugins/clockpicker/dist/jquery-clockpicker.min.js"></script>
    <!-- Color Picker Plugin JavaScript -->
    <script src="template/plugins/jquery-asColorPicker-master/libs/jquery-asColor.js"></script>
    <script src="template/plugins/jquery-asColorPicker-master/libs/jquery-asGradient.js"></script>
    <script src="template/plugins/jquery-asColorPicker-master/dist/jquery-asColorPicker.min.js"></script>
    <!-- Date Picker Plugin JavaScript -->
    <script src="template/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <!-- Date range Plugin JavaScript -->
    <script src="template/plugins/timepicker/bootstrap-timepicker.min.js"></script>
    <script src="template/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>

    <script src="template/js/plugins-init/form-pickers-init.js"></script>

    <!-- <script src="template/js/dashboard/dashboard-1.js"></script> -->

    <script src="template/plugins/tables/js/jquery.dataTables.min.js"></script>
    <!-- {{--  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>  --}} -->


    <script src="template/plugins/tables/js/datatable/dataTables.bootstrap4.min.js"></script>
    <!-- {{--  <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>  --}}
    <script src="template/plugins/tables/js/datatable-init/datatable-basic.min.js"></script>

    {{--  <script src="template/plugins/sweetalert/js/sweetalert.min.js"></script>
    <script src="template/plugins/sweetalert/js/sweetalert.init.js"></script>  --}} -->

    <script src="template/plugins/toastr/js/toastr.min.js"></script>
    <script src="template/plugins/toastr/js/toastr.init.js"></script>
    <!-- Tabulator - https://tabulator.info/docs/5.4 -->
    <script src="template/plugins/tabulator-tables/dist/js/tabulator.min.js"></script>

    <?= $this->renderSection('script') ?>

</body>

</html>