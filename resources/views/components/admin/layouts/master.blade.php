@props(['breadcrumb' => false])

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../images/favicon.ico">

    <title>{{ $pageTitle }}</title>

    <!-- Vendors Style-->
    <link rel="stylesheet" href="{{ asset('/admin_ui/main/css/vendors_css.css') }}">

    <!-- Style-->
    <link rel="stylesheet" href="{{ asset('/admin_ui/main/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/admin_ui/main/css/skin_color.css') }}">
    <script src="//unpkg.com/alpinejs" defer></script>
</head>

<body class="hold-transition dark-skin sidebar-mini theme-primary fixed">

    <div class="wrapper">

        <x-admin.partials.flash_message />

        {{-- Header --}}
        <x-admin.partials.header />

        {{-- End Header --}}

        <!-- Left side column. contains the logo and sidebar -->
        <x-admin.partials.main-sidebar />

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <div class="container-full">

                @if ($breadcrumb)
                    {{ $breadcrumbSection }}
                @endif
                <!-- Main content -->
                <section class="content">
                    {{ $slot }}
                </section>
                <!-- /.content -->
            </div>
        </div>
        <!-- /.content-wrapper -->
        <x-admin.partials.footer />

        <!-- Control Sidebar -->
        <x-admin.partials.control-sidebar />
        <!-- /.control-sidebar -->

        <!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
        <div class="control-sidebar-bg"></div>

    </div>
    <!-- ./wrapper -->


    <!-- Vendor JS -->
    <script src="{{ asset('admin_ui/main/js/vendors.min.js') }}"></script>
    <script src="{{ asset('admin_ui/assets/icons/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('admin_ui/assets/vendor_components/easypiechart/dist/jquery.easypiechart.js') }}"></script>
    <script src="{{ asset('admin_ui/assets/vendor_components/apexcharts-bundle/irregular-data-series.js') }}"></script>
    <script src="{{ asset('admin_ui/assets/vendor_components/apexcharts-bundle/dist/apexcharts.js') }}"></script>
    <script src="{{ asset('admin_ui/assets/vendor_components/datatable/datatables.min.js') }}"></script>
    <script src="{{ asset('admin_ui/main/js/pages/data-table.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Sunny Admin App -->
    <script src="{{ asset('admin_ui/main/js/template.js') }}"></script>
    <script src="{{ asset('admin_ui/main/js/pages/dashboard.js') }}"></script>

    {{-- Additional Js --}}
    <script src="{{ asset('js/script.js') }}"></script>
</body>

</html>
