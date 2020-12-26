<div class="product pb-lg-4">
    <div class="card-body">
        <h2 style="border-left: 4px solid orange; padding-left: 10px;"><b>TỪ KHÓA HOT</b></h2>
    </div>
    <div class="pl-4 col-md-12">
        <div class="row">
            @foreach ($tags as $tag)
            <div class="mb-3 col-6 col-md-6 col-lg-2">
                <button type="button" class="btn-gradient{{$i++}}"><a href="{{route('tag.show',$tag->slug)}}" style="color:white">{{$tag->name}}</a></button>
            </div>
            @endforeach
        </div>
    </div>
</div>