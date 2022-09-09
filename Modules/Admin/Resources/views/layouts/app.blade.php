<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin</title>

    <link rel="stylesheet" href="{{asset('/theme_assets/css/jquery_confirm/jquery-confirm.css')}}"/>
    <link rel="stylesheet" href="{{asset('/theme_assets/css/adminlte.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('/plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <link rel="stylesheet" href="{{asset('/plugins/wysiwyg-editor/editor.css')}}"/>
    <link rel="stylesheet" href="{{asset('/plugins/intlTelInput/intlTelInput.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/css/custom.css') }}">
{{--    <link rel="stylesheet" href="{{asset('/plugins/bootstrap/css/bootstrap.min.css')}}"/>--}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jQuery-Validation-Engine/2.6.4/validationEngine.jquery.css"/>
{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css"/>--}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/v/dt/dt-1.10.18/r-2.2.2/datatables.min.css"/>
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
{{--    <link rel="stylesheet" href="https://raw.githack.com/ttskch/select2-bootstrap4-theme/master/dist/select2-bootstrap4.css" >--}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet"/>


    @yield('include_css')

</head>
<body class="hold-transition sidebar-mini layout-fixed text-sm sidebar-collapse" >
<div class="wrapper">
    <!-- Navbar -->
@include('admin::header.header')
<!-- /.navbar -->
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{asset('/images/user_icons.png')}}" class="img-fluid">
                </div>
                <div class="info">
{{--                    <a href="#" class="d-block">{{strtoupper(Auth::user()->name)}}</a>--}}
                </div>
            </div>

            @include('admin::header.menu')
        </div>
        <!-- /.sidebar -->
    </aside>
    <div class="content-wrapper" style="background: linear-gradient(#000000, #828282, #fff);">
        <section class="content-header">
            <div class="container-fluid" >
                @yield('content_header')
{{--                <div class="progress progress-xs" id="animated_bar">--}}
{{--                    <div class="progress-bar progress-bar-striped progress-bar-animated " role="progressbar" aria-valuenow="100" aria-valuemin="100" aria-valuemax="100" style="width: 100%"></div>--}}
{{--                </div>--}}
            </div>
        </section>
        <section class="content">
            <section class="container-fluid">
                @yield('content')
            </section>
        </section>
    </div>

    <footer class="main-footer">
        <strong>© {{\Carbon\Carbon::now()->format('Y')}} Start Tech. All Rights Reserved. Developed by <a href="https://start-tech.ae/" class="text-black-50" target="_blank">Start Tech IT Solutions</a></strong>

    </footer>
</div>


<script type="text/javascript">
    var BASE = "{{url('/')}}/";
    {{--var PUBLIC_BASE = "{{url('/')}}/";--}}
</script>

<script src="{{asset('/plugins/jquery.js')}}"></script>
<script src="{{asset('/theme_assets/js/jquery_confirm/jquery-confirm.js')}}"></script>
<script src="{{asset('/theme_assets/js/adminlte.js')}}"></script>
<script src="{{asset('/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<script src="{{asset('/plugins/intlTelInput/intlTelInput.min.js')}}"></script>
<script src="{{asset('/plugins/wysiwyg-editor/editor.js') }}"></script>
<script src="{{asset('/plugins/bootstrap_notify_master/bootstrap_notify.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-Validation-Engine/2.6.4/languages/jquery.validationEngine-en.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-Validation-Engine/2.6.4/jquery.validationEngine.js"></script>
<script src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.16/af-2.2.2/b-1.5.1/b-colvis-1.5.1/b-flash-1.5.1/b-html5-1.5.1/b-print-1.5.1/kt-2.3.2/sc-1.4.4/datatables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
<script src="{{asset('/assets/js/custom.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function () {

        $('.select2').select2();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });
</script>

@yield('include_js')
@yield('custom_script')

</body>
</html>
