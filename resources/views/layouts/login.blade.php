<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Admin</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->

    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('/theme_assets/css/adminlte.min.css')}}"/>
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('theme_assets/plugins/iCheck/square/blue.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

</head>
<body class="hold-transition login-page">
<div class="container">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

            <div class="">



            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="login-box">
                @yield('content')
            </div>
        </div>
    </div>
</div>


</body>
</html>
