@extends('admin::layouts.app')


@section('include_css')
    <!-- Data Tables -->

@endsection

@section('content')
    <!-- Dashboard wrapper starts -->
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <h5>User Permissions</h5>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <ul class="right-stats" id="mini-nav-right">
{{--                                                        @can('ADD_PERMISSION')--}}
                            <a href="{{url('admin/permissions/create')}}" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i>
                                New permissions</a>
{{--                                                        @endcan--}}
                        </ul>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div id="collapseOne" class="">
                    <ul class="list-group no-margin">

                        @foreach($permissions as $permission)
                            <li class="list-group-item">
                                <a href="{{url('/admin/permissions/'.$permission->id.'/edit')}}"><strong>{{ $permission->display_name }} </strong></a><span class="permission_name">{{$permission->name}}</span>
                                @if(count($permission->childs)!=0)
                                    @include('admin::permission.managechild',['childs' => $permission->childs])
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection


{{--@extends('layouts.app')--}}


@section('content')
    <!-- Top bar starts -->
    <!-- Top bar ends -->



<!-- Main content -->
<div class="main-container">
    <!-- Row starts -->
    <div class="row gutter">
        <div class="col-sm-12">
            <div class="card card-bd lobidrag">
                  <div class="card-header">
                    <div class="btn-group">

                    </div>
                </div>
                 <div class="card-body">

                 </div>
            </div>


        </div>
    </div>
    <!-- Row ends -->

</div> <!-- /.content -->
@endsection

