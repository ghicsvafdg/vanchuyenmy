<div class="row py-2 mt-2 px-lg-5 mx-1" id="background-infor">
    @if (Auth::user()->avatar)
    <object data="{{asset('profile/'.Auth::user()->avatar)}}" class="rounded-circle" width="125px" type="image/png">
        <img src="{{Auth::user()->avatar}}" alt="image profile" class="rounded-circle lazyload" width="125px">
    </object>
    @else
    <img src="{{asset('profile/default_av.png')}}" alt="image profile" class="rounded-circle lazyload" width="125px">
    @endif
    <div id="pesonal-infor">
        <p >Xin chào 
            <b>
                @if (Auth::user()->name)
                {{Auth::user()->name}}
                @else
                {{Auth::user()->username}}
                @endif
            </b>
        </p>
        {{-- <p><i class="fas fa-pen" style="margin-right: 3px;"></i>Sửa hồ sơ</p> --}}
    </div>
</div>