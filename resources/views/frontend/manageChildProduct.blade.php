<div class="dropdown-content">  
    <div class="row">
        <div class="column" id="text-hidden-category">
            @foreach ($childs as $child)
            @if ($child->status == 1)
                <a href="{{route('danh-muc',$child->slug)}}">
                    <i class="{{$child->icon}}" id="icon_menu"></i>
                    {{$child->title}}
                </a>
            @endif
            @endforeach  
        </div>
    </div>
</div>