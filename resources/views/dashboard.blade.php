@extends('admin::layouts.app')

@section('include_css')
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    {{--    <link rel="stylesheet" href="{{asset('/plugins/fontawesome-free/css/all.min.css')}}">--}}
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    {{--    <!-- Tempusdominus Bootstrap 4 -->--}}
    {{--    <link rel="stylesheet" href="{{asset('/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">--}}
    {{--    <!-- iCheck -->--}}
    {{--    <link rel="stylesheet" href="{{asset('/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">--}}
    {{--    <!-- overlayScrollbars -->--}}
    {{--    <link rel="stylesheet" href="{{asset('/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">--}}
    {{--    <!-- summernote -->--}}
    {{--    <link rel="stylesheet" href="{{asset('/plugins/summernote/summernote-bs4.min.css')}}">--}}

@endsection


@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard v1</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{$users}}</h3>

                                <p>Users</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="{{url('/admin/users')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{$products_unassigned}}</h3>
                                <p>Product unassigned</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="{{url('/admin/product')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header border-0">
                                <h3 class="card-title">Unassigned Products List</h3>
                                <div class="card-tools">
                                    <a href="#" class="btn btn-tool btn-sm">
                                        <i class="fas fa-download"></i>
                                    </a>
                                    <a href="#" class="btn btn-tool btn-sm">
                                        <i class="fas fa-bars"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body table-responsive p-0">
                                <table class="table table-striped table-valign-middle">
                                    <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Product Name</th>
                                        <th>Description</th>
                                        <th>More</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($products_unassigned_list as $product)

                                    <tr>
                                        <td>
                                            <img src="{{$product['product_image_url']}}" alt="{{$product['product_name']}}"
                                                 class="img-thumbnail img-size-64 mr-2">
                                        </td>
                                        <td>{{$product['product_name']}}</td>
                                        <td>{{$product['product_description']}}</td>
                                        <td>
                                            <a href="{{url('/admin/product/'.$product['id'].'/edit')}}" class="text-muted">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection


@section('include_js')

    {{--    <!-- Bootstrap 4 -->--}}
    {{--    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>--}}
    {{--    <!-- ChartJS -->--}}
    {{--    <script src="plugins/chart.js/Chart.min.js"></script>--}}
    {{--    <!-- Sparkline -->--}}
    {{--    <script src="plugins/sparklines/sparkline.js"></script>--}}

    {{--    <!-- jQuery Knob Chart -->--}}
    {{--    <script src="plugins/jquery-knob/jquery.knob.min.js"></script>--}}
    {{--    <!-- daterangepicker -->--}}
    {{--    <script src="plugins/moment/moment.min.js"></script>--}}
    {{--    <!-- Tempusdominus Bootstrap 4 -->--}}
    {{--    <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>--}}
    {{--    <!-- Summernote -->--}}
    {{--    <script src="plugins/summernote/summernote-bs4.min.js"></script>--}}
    {{--    <!-- overlayScrollbars -->--}}
    {{--    <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>--}}

@endsection
