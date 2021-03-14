<div class="owl-carousel owl-theme">
    @foreach ($categories as $item)
    <div class="item">
        <div class="card">  
            <div class="card-category">
                <div class="card-image">
                    <a href="{{route('danh-muc',$item->slug)}}">
                        <img src="{{asset('images/'.$item->filename)}}" class="img-fluid lazyload" alt="..." style="border-radius: 5px; width: 70px; height: 70px;">
                    </a> 
                </div>
                <div class="card-text">   
                    <a href="{{route('danh-muc',$item->slug)}}" style="color: #000;"><h4>{{$item->title}}</h4></a>
                </div>    
            </div>   
        </div> 
    </div>
    @endforeach
</div>
