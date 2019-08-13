<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title_prefix', config('adminlte.title_prefix', ''))
        @yield('title', config('adminlte.title', 'AdminLTE 2'))
        @yield('title_postfix', config('adminlte.title_postfix', ''))</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/bootstrap/dist/css/jquery.webui-popover.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Banner -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/sao_assets/engine1/style.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/sao_assets/engine1/style.mod.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/Ionicons/css/ionicons.min.css') }}">

    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/sao_assets/jquery.datetimepicker.min.css') }}">

    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/sao_assets/preload/css/introLoader.css') }}">

{{-- <link rel="stylesheet"
       href="{{ asset('vendor/adminlte/vendor/bootstrap4/dist/css/bootstrap-datetimepicker.min.css') }}">--}}

<!-- jquery-mobile -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/jquery_mobile/jquery.mobile-1.4.5.min.css') }}">
    <!--  DataTables  -->
    <link rel="stylesheet" href="{{asset('vendor/adminlte/dist/css/data_table_mini.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>

@if(config('adminlte.plugins.pace'))
    <!-- Pace -->
        <link rel="stylesheet" href="{{asset('vendor/adminlte/dist/sao_assets/pace/themes')}}/{{config('adminlte.pace.color', 'blue')}}/pace-theme-{{config('adminlte.pace.type', 'center-radar')}}.css">
@endif

@if(config('adminlte.plugins.select2'))
    <!-- Select2 -->
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css">
@endif

<!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/AdminLTE.css') }}">

@if(config('adminlte.plugins.datatables'))
    <!-- DataTables with bootstrap 3 style -->
       {{-- <link rel="stylesheet" href="//cdn.datatables.net/v/bs/dt-1.10.18/datatables.min.css">--}}
        <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/sao_assets/datatables/css/jquery.dataTables.css') }}">
        <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/sao_assets/datatables/css/dataTables.bootstrap4.css') }}">
        <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/sao_assets/datatables/css/responsive.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/sao_assets/datatables/css/responsive.bootstrap.min.css') }}">
      {{--  <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/sao_assets/datatables/css/dataTables.bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/sao_assets/datatables/css/fixedHeader.bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/sao_assets/datatables/css/responsive.bootstrap.min.css') }}">--}}

        @endif

    @yield('adminlte_css')

    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Google Font -->
        <link rel="stylesheet"
              href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition @yield('body_class')" oncontextmenu="return false;">

@yield('body')
<script src="{{ asset('vendor/adminlte/vendor/jquery/dist/jquery.js') }}"></script>
<script src="{{asset('vendor/adminlte/dist/sao_assets/data_tables_mini.js')}}"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script src="{{ asset('vendor/adminlte/dist/sao_assets/moment-with-locales.js') }}"></script>
<script src="{{ asset('vendor/adminlte/vendor/bootstrap4/dist/js/bootstrap.js') }}"></script>
{{--<script src="{{ asset('vendor/adminlte/dist/sao_assets/bootstrap-datetimepicker.js') }}"></script>--}}
<script src="{{ asset('vendor/adminlte/vendor/bootstrap4/dist/js/bootstrap.bundle.js') }}"></script>
<script src="{{ asset('vendor/adminlte/vendor/jquery/dist/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/vendor/bootstrap/dist/js/tooltip.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/vendor/bootstrap/dist/js/jquery.webui-popover.js') }}"></script>
<script src="{{ asset('vendor/adminlte/dist/sao_assets/sweetalert.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/vendor/jquery/dist/jquery.mobile-events.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/dist/sao_assets/jquery.datetimepicker.full.js') }}"></script>
{{--<script src="{{ asset('vendor/adminlte/dist/sao_assets/preload/helpers/jquery.easing.1.3.js') }}"></script>
<script src="{{ asset('vendor/adminlte/dist/sao_assets/preload/helpers/spin.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/dist/sao_assets/preload/jquery.introLoader.js') }}"></script>--}}
<script src="{{ asset('vendor/adminlte/dist/sao_assets/loader/js/prefixfree.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/dist/sao_assets/loader/js/jquery.preload-1.2.0.js') }}"></script>

@if(config('adminlte.plugins.pace'))
    <!-- Pace  -->
    <script src="{{ asset('vendor/adminlte/dist/sao_assets/pace/pace.js') }}"></script>
@endif

@if(config('adminlte.plugins.select2'))
    <!-- Select2 -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
@endif

@if(config('adminlte.plugins.datatables'))
    <!-- DataTables with bootstrap 3 renderer -->
    {{-- <script src="//cdn.datatables.net/v/bs/dt-1.10.18/datatables.min.js"></script>--}}
    <script src="{{ asset('vendor/adminlte/dist/sao_assets/datatables/js/dataTables.dataTables.js') }}"></script>
    <script src="{{ asset('vendor/adminlte/dist/sao_assets/datatables/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('vendor/adminlte/dist/sao_assets/datatables/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vendor/adminlte/dist/sao_assets/datatables/js/dataTables.responsive.min.js') }}"></script>
{{--    <script src="{{ asset('vendor/adminlte/dist/sao_assets/datatables/js/dataTables.fixedHeader.min.js') }}"></script>
    <script src="{{ asset('vendor/adminlte/dist/sao_assets/datatables/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('vendor/adminlte/dist/sao_assets/datatables/js/responsive.bootstrap.min.js') }}"></script>--}}
@endif

@if(config('adminlte.plugins.chartjs'))
    <!-- ChartJS -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js"></script>
@endif

@yield('adminlte_js')

</body>
</html>
