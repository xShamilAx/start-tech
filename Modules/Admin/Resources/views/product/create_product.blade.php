@extends('admin::layouts.app')


@section('include_css')

    <link href="{{asset('/plugins/fineuploader/fine-uploader-gallery.min.css')}}" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dragula/3.7.2/dragula.min.css" rel="stylesheet"/>
    <!-- Data Tables -->
@endsection

@section('content')

    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        @if(isset($product->id))
                            <h5>Update Product</h5>
                        @else
                            <h5>Create Product</h5>
                        @endif
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <ul class="right-stats">
                            @can('ADD_PRODUCT')
                            @if(isset($product->id))
                                <button href="javascript:void(0)" class="btn btn-warning"
                                        id="product-update-btn">Update
                                </button>
                            @else
                                <button href="javascript:void(0)" class="btn btn-success"
                                        id="product-save-btn">Save
                                </button>
                            @endif
                            @endcan
                            <div class="btn-group">
                                <a class="btn btn-primary" href="{{url('/admin/product')}}"> <i
                                        class="icon-arrow-bold-left"></i> Product list</a>
                            </div>
                        </ul>
                    </div>
                </div>
            </div>
            {{--@dd($product)--}}
            <div class="card-body">
                <form action="{{url('/').'/admin/product'}}" method="POST" id="product_form">

                    @csrf
                    {{ csrf_field() }}
                    <input type="hidden" name="product_id" id="product_id" value="{{ $product->id ?? '' }}">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label class="control-label col-xs-6"
                                               for="product_name">Product Name</label>
                                        <div class="col-xs-8">
                                            <input id="product_name" type="text"
                                                   class="form-control validate[required]"
                                                   name="product_name" value="{{ $product->product_name ?? '' }}" required
                                                   autofocus>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="card" id="product-card">
                                        <div class="card-header">
                                            <h4>Product Image</h4>
                                        </div>
                                        <div class="card-body">
                                            <input type="hidden" name="product_image_url" id="product_image_url" class="product_image_url"
                                                   value="@if(isset($product->product_image_url)) {{$product->product_image_url ?? ''}} @endif">
                                            <ul class="media_view_list list-inline" id="product_view">
                                                @if(isset($product->product_image_url) && $product->product_image_url != null)
                                                    <li
                                                        class="drag-item list-group-item list-group-item-success img-wrap">
                                                        <a href="{{$product->product_image_url}}" target="_blank">
                                                            <img width="300" src="{{url($product->product_image_url)}}">
                                                        </a>
                                                        @can('REMOVE_UPLOADED_PRODUCT_IMAGE')
                                                                <button
                                                                    class=" btn hvr-buzz-out  btn btn-danger btn-xs remove_media_btn"
                                                                    data-id="{{$product->id}}">
                                                                    <i class="fa fa-remove " aria-hidden="true"></i>
                                                                    Remove
                                                                </button>
                                                        @endcan
                                                    </li>
                                                @endif
                                            </ul>
                                            <div id="uploader" class="uploader"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label class="control-label col-xs-6"
                                               for="product_name">Product Description</label>
                                        <div class="col-xs-8">
                                                <textarea name="product_description" id="product_description"
                                                          style=" width: 100%; height: 100px;">{{ $product->product_description ?? '' }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label class="control-label col-xs-6"
                                               for="assign_user">Assign User</label>
                                        <div class="col-xs-8">
                                            {{ Form::select('assign_user', App\Models\UserModel::pluck('first_name', 'id'),isset($product->assign_user) ? $product->assign_user : '',array('class'=> 'form-control select2 validate[required]' ,'id' => 'assign_user', 'placeholder'=> "Not Assign user",)) }}
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('include_js')
    <script src="{{asset('/plugins/fineuploader/fine-uploader.min.js')}}"></script>
{{--    <script src="{{asset('/admin/js/media_js.js') }}"></script>--}}
    <script src='https://cdnjs.cloudflare.com/ajax/libs/dragula/3.7.2/dragula.min.js'></script>

@endsection

@section('custom_script')

    @include('admin::media.qq_template')

    <script>
        $(document).ready(function () {

            var wrapper = $(".input_fields_wrap"); //Fields wrapper

                $("#product-save-btn ,#product-update-btn").click(function (e) {
                var params = {
                    product_details: $('#product_form').serialize(),
                };

                e.preventDefault();
                $.ajax({
                    url: BASE + 'admin/product',
                    type: 'POST',
                    dataType: 'JSON',
                    data: $.param(params),
                    success: function (response) {
                        if (response.status == 'error') {
                            notification(response);
                        } else {
                            notification(response);
                            setTimeout(
                                function () {
                                    window.location.href = BASE + 'admin/product';
                                }, 1000);
                        }
                    },
                    error: function (xhr, ajaxOptions, thrownError) {

                        notificationError(xhr, ajaxOptions, thrownError);
                    }
                });
                e.preventDefault();
                return false;
            });


            var allowedExtensions = ['jpg', 'gif', 'png', 'jpeg', 'pdf'];
            var uploader = new qq.FineUploader({
                element: document.getElementById("uploader"),
                request: {
                    endpoint: BASE + "admin/media_upload",
                    customHeaders: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                },
                callbacks: {
                    onComplete: function (id, name, responseJSON) {
                        if (responseJSON.success) {
                            $('#uploader').hide('slow');
                            $('#product_ids').val(responseJSON.media_id);
                            $("#product_view").append('<li id="' + responseJSON.media_id + '" class="drag-item list-group-item list-group-item-success img-wrap"> ' +
                                '<a href="' + BASE + 'uploads/' + responseJSON.folder_name + '/' + responseJSON.picture_name + '" target="_blank">' +
                                '<img width="300" src="' + BASE + 'uploads/' + responseJSON.folder_name + '/' + responseJSON.picture_name + '"></a>' +
                                '<button class=" btn hvr-buzz-out  btn btn-danger btn-xs remove_media_btn" data-id= "' + responseJSON.media_id + '">' +
                                '<i class="fa fa-remove " aria-hidden="true"></i> Remove </button> </li>');
                            uploader.reset();

                        }
                    },
                    onSubmit: function (id, fileName) {
                        var newParams = {
                            media_type: 'products',
                            ref_id: $('#product_id').val()
                        };

                        this.setParams(newParams);
                    }
                },
                debug: false,
                autoUpload: true,
                multiple: false,
                validation: {
                    allowedExtensions: allowedExtensions,
                    sizeLimit: 2000000,

                }
            });


            @if(isset($product) && $product->product_image_url != null)
            $('#uploader').hide('slow');
            @endif

        });


        $(document).on('click', '.remove_media_btn', function (e) {

            var media_id = $(this).data("id");
            var li = $(this).closest("li");

            var delete_confirm = $.confirm({
                title: "Are you sure you want to permanently delete this file?",
                type: 'red',
                buttons: {
                    delete: {
                        text: 'Delete',
                        keys: ['shift', 'alt'],
                        btnClass: 'btn-red',
                        action: function () {

                            e.preventDefault();
                            var params = {
                                media_id: media_id
                            };

                            $.ajax({
                                url: BASE + 'admin/delete_media',
                                type: 'POST',
                                dataType: 'JSON',
                                data: $.param(params),
                                success: function (response) {
                                    if (response.status == 'error') {
                                        delete_confirm.close();
                                        notification(response);
                                    } else {
                                        delete_confirm.close();
                                        li.closest('ul').next().closest('.uploader').show('slow');
                                        li.remove();
                                        notification(response);
                                    }
                                },
                                error: function (errors) {

                                }
                            });
                            e.preventDefault();
                            return false;
                        }
                    },
                    close: function () {
                    }
                }
            });
            e.preventDefault();
        });
    </script>
@endsection
