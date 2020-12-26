<div class="px-1 col-md-3 d-none d-lg-block">   
    <div class="list-group" id="list-tab" role="tablist">
        
        @foreach ($categories as $item)
        <div class="mega-menu">
            <div class="dropdown-hover"> 
                @if ($item->parent_id == 0)
                <div class="mega-menu">
                    <a class="list-group-item list-group-item-action" href="{{route('danh-muc.show',$item->slug)}}" style="width: 270px;" id="list-profile-list"  >
                        <i class="{{$item->icon}}" style=" color: #f09819; margin-right: 15px; margin-top: 2px; font-size: 20px;"></i>
                        {{$item->title}}
                    </a>
                </div>
                    @if (count($item->childs))
                    @include('frontend.manageChildProduct',['childs' => $item->childs])
                    @endif
                @endif
            </div>
        </div>
        @endforeach
        
    </div>
    
</div>