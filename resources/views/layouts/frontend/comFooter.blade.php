<div class="px-0 col-sm-12 col-12 d-none d-lg-block" >
    <div class="text-center" id="main-footer-computer">
        <div class="container">
            <div class="col">
                <div class="row">
                    <div class="pt-5 col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <div class="col-12">
                            <div class="fb-page" data-href="https://www.facebook.com/ATMART.VN" data-tabs="" data-width="" data-height="200" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/ATMART.VN" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/ATMART.VN">Siêu thị  ATMART.vn</a></blockquote></div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="row">
                            <div class="text-left px-0  pt-5 col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                <div class="col" style="height: 30px; ">
                                    <a  href="#" style="color: #000;"><b>HỖ TRỢ</b></a>
                                </div>
                                <div class="col">
                                    <div class="text-footer">
                                        @foreach ($footerPost as $post)
                                        @if ($post->category == 0)
                                        <a  href="{{route('footer-post.show',$post->slug)}}" >
                                            <i class=" mr-1 fas fa-angle-right"></i>
                                            <p>{{$post->title}}</p>
                                        </a>
                                        @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="text-left px-0  py-5 col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                <div class="col" style="height: 30px;">
                                    <a  href="#" style="color: #000;"><b>LIÊN HỆ</b></a>
                                </div>
                                <div class="col">
                                    <div class="text-footer">
                                        @foreach ($footerPost as $post)
                                        @if ($post->category == 1)
                                        <a  href="{{route('footer-post.show',$post->slug)}}" >
                                            <i class="mr-1 fas fa-angle-right"></i>
                                            <p>{{$post->title}}</p>
                                        </a>
                                        @endif
                                        @if ($post->category == 2)
                                        <a  href="{{route('footer-post.show',$post->slug)}}" >
                                            <i class="mr-1 fas fa-angle-right"></i>
                                            <p> <i class="mr-1 fas fa-phone"></i> {{$post->title}}</p>
                                        </a>
                                        @endif
                                        @if ($post->category == 3)
                                        <a  href="{{route('footer-post.show',$post->slug)}}" >
                                            <i class="mr-1 fas fa-angle-right"></i>
                                            <p> <i class="fas fa-envelope"></i> {{$post->title}}</p>
                                        </a>
                                        @endif
                                        @endforeach
                                        <img class="img-fluid" style="width: 190px;" src="{{asset('assets/img/dathongbao.png')}}"  alt="Chania">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="text-left px-0  py-5 col-xs-2 col-sm-2 col-md-2 col-lg-3">
                        <div class="col" style="height: 30px;">
                            <a href="#" style="color: #000;"><b>THẺ PHỔ BIẾN</b></a>
                        </div>
                        <div class="col">
                            <div class="text-footer row">
                                @foreach ($tgs as $tag)
                                    <a href="{{route('tag.show',$tag->slug)}}" class="button-footer">{{$tag->name}}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="py-4 text-center" id="copyright-company">
            <div class="container">
                @foreach ($footerPost as $post)
                @if ($post->category == 7)
                    <p>{!!$post->content!!}</p>
                @endif
                @endforeach
            </div>
        </div>
    </div>
</div>
