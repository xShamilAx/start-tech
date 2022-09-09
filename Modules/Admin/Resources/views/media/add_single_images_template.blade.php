<input type="hidden" id="media_id" name="media_id"
       value="@if(isset($media_id)) {{$media_id ?? ''}} @endif">
<ul class="media_view_list list-inline"
    id="media_view_list">
    @if(isset($media_id) && $media_id != null && isset($media) && $media != null)
        <li id="{{$media_id ?? ''}}"
            class="drag-item list-group-item list-group-item-success img-wrap">
            <img class="uploaded_image" width="100"
                 src="{{url($media)}}">
            <button class=" btn hvr-buzz-out  btn btn-danger btn-xs remove_media_btn" data-id="{{$media_id}}"><i class="fa fa-remove " aria-hidden="true"></i> Remove</button>
        </li>
    @endif
</ul>

<div id="uploader"></div>





