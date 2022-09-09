<ul class="list-group no-margin">
@foreach($childs as $child)
<li class="list-group-item">

    <a href="{{url('/admin/permissions/'.$child->id.'/edit')}}">  -{{ $child->display_name }} </a><span class="permission_name">{{$child->name}}</span>
	@if(count($child->childs))
            @include('admin::permission.managechild',['childs' => $child->childs])
        @endif
	</li>
@endforeach
</ul>
