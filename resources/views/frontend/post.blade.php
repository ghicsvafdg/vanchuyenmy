<div class="owl-carousel owl-theme">
    @foreach ($posts as $post)
        <div class="item" id="title-post">
            <div class="img-blog">
                <a href="{{route('post.show',$post->slug)}}">
                    <img src="{{asset('images/'.$post->filename)}}" style="height: 280px;" class="img-fluid pb-3" alt="...">
                </a>
            </div>
            <div class="col pt-2">
                <div class="title-post">
                    <a href="{{route('post.show',$post->slug)}}"><h4>{{$post->title}}</h4></a>
                </div>
                <div class="time-post">
                    <p class="date">{{$post->created_at}}</p>
                    <p><i class="fas fa-comment mr-1"></i>Bình luận</p>
                </div>
                <p class="mb-1 description post-paragraph">{{$post->description}}</p>
                <a href="{{route('post.show',$post->slug)}}"><p>Đọc tiếp <i class="fas fa-arrow-circle-right"></i></p></a>
            </div>
        </div>
    @endforeach
</div>