@extends('layouts.frontend.app')
@section('content')
    <div class="container">
    <div class="page-header">
        {{-- bread crumb --}}
        <div class="product">
            <div class="row" > 
                <ul class="breadcrumbs">
                    <li class="nav-home">
                        <a href="{{route('index')}}">
                            <i class="flaticon-home"></i>
                        </a>
                    </li>
                    @if ($product->productCategory->parent_id == 0)
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('danh-muc',$product->productCategory->slug)}}">{{$product->productCategory->title}}</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('san-pham.show',$product->slug)}}">
                            {{$product->name}}
                        </a>
                    </li>
                    @elseif($product->productCategory->parent_id != 0)
                    @foreach ($allCate as $cate)
                    @if ($cate->parent_id == 0 && $cate->id == $product->productCategory->parent_id)
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('danh-muc',$cate->slug)}}">{{$cate->title}}</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('danh-muc',$product->productCategory->slug)}}">{{$product->productCategory->title}}</a>
                    </li>
                    @endif
                    @endforeach
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('san-pham.show',$product->slug)}}">
                            {{$product->name}}
                        </a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
        {{-- bread crumb end --}}
        <div class="card">
            <div class="pb-3">
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-md-6 col-lg-5">
                                @if (!($product->video === null))
                                <div class="mySlides pt-3 pl-3">
                                    <div class="frame">
                                        <div class="box-img">
                                            <iframe src="{{'https://www.youtube.com/embed/'.substr($product->video,32)}}">
                                            </iframe>
                                        </div>
                                    </div>
                                </div>   
                                <!-- product image -->
                                @foreach ($images as $image)
                                <div class="mySlides pt-3 pl-3">
                                    <div class="easyzoom easyzoom--overlay easyzoom--with-thumbnails">
                                        <div class="box-img">
                                            <a href="{{asset('images/'.$image)}}">
                                                <img src="{{asset('images/'.$image)}}" class="img-fluid lazyload" alt=""/>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                <!-- END product image -->
                                
                                <!-- small image -->
                                <div class="pt-3 owl-carousel owl-theme" id='carousel_horizontal1'> 
                                    <div class="item" id="product">
                                        <div class="box-img-cursor">
                                            <img class="demo img-fluid lazyload" id="cursor-img" src="{{asset('images/play.png')}}" onclick="currentSlide(1)" alt="The Woods">
                                        </div>
                                    </div>
                                    @foreach ($images as $img)
                                    <div class="item" id="product">
                                        <div class="box-img-cursor">
                                            <img class="demo img-fluid lazyload" id="cursor-img" src="{{asset('images/'.$img)}}" onclick="currentSlide({{$i++}})" alt="The Woods">
                                        </div>
                                    </div>
                                    @endforeach          
                                </div>
                                {{-- end small image --}}
                                @else
                                <!-- product image -->
                                @foreach ($images as $image)
                                <div class="mySlides pt-3 pl-3">
                                    <div class="easyzoom easyzoom--overlay easyzoom--with-thumbnails">
                                        <div class="box-img">
                                            <a href="{{asset('images/'.$image)}}">
                                                <img src="{{asset('images/'.$image)}}" class="img-fluid lazyload" alt=""/>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                <!-- END product image -->
                                <!-- small image -->
                                <div class="pt-3 owl-carousel owl-theme"> 
                                    @foreach ($images as $img)
                                    <div class="item" id="product">
                                        <div class="box-img-cursor">
                                            <img class="demo img-fluid lazyload" id="cursor-img" src="{{asset('images/'.$img)}}" onclick="currentSlide({{$z++}})" alt="The Woods">
                                        </div>
                                    </div>
                                    @endforeach          
                                </div>
                                {{-- end small image --}}
                                @endif

                                {{-- show 5 image --}}
                                <script>
                                    var slideIndex = 1;
                                    showSlides(slideIndex);
                                    
                                    function plusSlides(n) {
                                        showSlides(slideIndex += n);
                                    }
                                    
                                    function currentSlide(n) {
                                        showSlides(slideIndex = n);
                                    }
                                    
                                    function showSlides(n) {
                                        var i;
                                        var slides = document.getElementsByClassName("mySlides");
                                        var dots = document.getElementsByClassName("demo");
                                        var captionText = document.getElementById("caption");
                                        if (n > slides.length) {slideIndex = 1}
                                        if (n < 1) {slideIndex = slides.length}
                                        for (i = 0; i < slides.length; i++) {
                                            slides[i].style.display = "none";
                                        }
                                        for (i = 0; i < dots.length; i++) {
                                            dots[i].className = dots[i].className.replace(" active", "");
                                        }
                                        slides[slideIndex-1].style.display = "block";
                                        dots[slideIndex-1].className += " active";
                                        captionText.innerHTML = dots[slideIndex-1].alt;
                                    }
                                </script>
                                {{-- end show 5 image --}}
                            </div>
                            <div class="pr-0 pl-3 pt-3 col-md-6 col-lg-7">
                                <div class="row">
                                    <div class="ml-3 ml-lg-0 col-md-8 col-lg-8">
                                        <div class="pr-3">
                                            <h3><b>{{$product->name}}</b></h3>
                                        </div>
                                        <div class="pb-0" id="cost">
                                            <div class="row">
                                                @if (isset($product->promotion))
                                                <p2>{{number_format($product->price*1000, 0, ',', '.' )}} đ</p2>
                                                <p>
                                                    <b>{{number_format($product->promotion*1000, 0, ',', '.' )}} đ</b> 
                                                </p>
                                                <p3><b>{{100-ceil($product->promotion/$product->price*100)}}% GIẢM</b></p3>
                                                @else
                                                <p>
                                                    <b>{{number_format($product->price*1000, 0, ',', '.' )}} đ</b> 
                                                </p>
                                                @endif
                                            </div>
                                            
                                            <div class="rating-star pb-4">
                                                <span class="fa fa-star @if(floatval($product->star) > 1) checked @endif" id="star"></span>
                                                <span class="fa fa-star @if(floatval($product->star) > 1.5) checked @endif" id="star"></span>
                                                <span class="fa fa-star @if(floatval($product->star) > 2.5) checked @endif" id="star"></span>
                                                <span class="fa fa-star @if(floatval($product->star) > 3.5) checked @endif" id="star"></span>
                                                <span class="fa fa-star @if(floatval($product->star) > 4.5) checked @endif" id="star"></span>
                                            </div>
                                        </div>
                                        <div class="pt-2 pb-0" id="text-code-product">
                                            <h5>Mã sản phẩm: <b>{{$product->product_code}} </b></h5>&nbsp;
                                            <h5 class="status">Tình trạng: 
                                                @if($product->quantity > 0) 
                                                <span style="color: rgb(9, 185, 9);">
                                                    <i class="mr-1 fas fa-check-circle"></i>Sẵn có
                                                </span>
                                                @else 
                                                <span style="color:red;"><b>Hết hàng</b></span>
                                                @endif                                    
                                            </h5>
                                        </div>
                                        <div class="shiping-free">
                                            @foreach ($footerPost as $post)
                                            @if ($post->category == 6)
                                            <img class="img-fluid lazyload" src="{{asset('images/'.$post->filename)}}" alt="Chania" >
                                            <h5>{!!$post->content!!}</h5>
                                            @endif
                                            @endforeach
                                        </div>
                                        {{-- get attributes --}}
                                        <form action="{{route('cart.store')}}" method="post">
                                            @csrf
                                            {{-- get color --}}
                                            <div class="row pt-4">
                                                @if ($product->color)
                                                <div class="col-2">Màu:</div>
                                                <div class="col-10 pl-0">
                                                    <div class="radio-toolbar">
                                                        @foreach (explode(',',$product->color) as $color)
                                                        <input type="radio" id="{{$color}}" name="color" value="{{$color}}" checked>
                                                        <label for="{{$color}}">{{$color}}</label>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                @endif
                                            </div>
                                            {{-- end get color --}}

                                            {{-- get size --}}
                                            <div class="row py-3">
                                                @if ($product->size)
                                                <div class="col-2">Size:</div>
                                                <div class="col-10 pl-0">
                                                    <div class="radio-toolbar">
                                                        @foreach (explode(',',$product->size) as $size)
                                                        <input type="radio" id="{{$size}}" name="size" value="{{$size}}" checked>
                                                        <label for="{{$size}}">{{$size}}</label>
                                                        @endforeach 
                                                    </div>
                                                </div>
                                                @endif
                                            </div>
                                            {{-- end get size --}}

                                            <div class="px-3 py-1">
                                                <div class="row">
                                                    <div class="input-group">
                                                        <h5 class="pr-3" style="padding-top:20px;"><b>Số lượng</b></h5>
                                                        <p>
                                                            <button type="button" class="btn btn-default minus">
                                                                <i class="fas fa-minus"></i>
                                                            </button>
                                                            <input id="qty2" type="text" value="1" class="qty" size="1" name="quantity" class="form-control"/>
                                                            <button type="button" class="btn btn-default btn-icon add">
                                                                <i class="fas fa-plus"></i>
                                                            </button>
                                                        </p>
                                                        <h5 style="padding-top:20px;">&nbsp; &nbsp;{{$product->quantity}} sản phẩm có sẵn</h5>
                                                    </div>
                                                </div>
                                                <div class="pb-2 px-0" id="row-pay"> 
                                                    @if (Auth::check())
                                                    <div class="row">
                                                        <input type="text" value="{{$product->id}}" name="product_id" hidden>
                                                        <button type="submit" class="btn btn-info" id="alert_demo_1">
                                                            <i class="fas fa-cart-plus" style="margin-right: 7px; "></i>THÊM VÀO GIỎ HÀNG
                                                        </button>
                                                        &nbsp;
                                                        <a href="#"><button type="button" class="btn-pay">MUA NGAY</button></a>
                                                    </div>
                                                    @else
                                                    <a href="{{route('login')}}" class="btn btn-info" id="alert_demo_1"><i class="fas fa-cart-plus" style="margin-right: 7px;"></i>THÊM VÀO GIỎ HÀNG</a>
                                                    <a href="{{route('login')}}"><button type="button" class="btn-pay">MUA NGAY</button></a>
                                                    @endif 
                                                </div>
                                            </div>
                                        </form>
                                        {{-- end get attributes --}}
                                    </div>
                                    {{-- banner 4 --}}
                                    <div class="px-0 col-lg-4 d-none d-lg-block">
                                        @if(!$banner->isEmpty())
                                            @foreach ($banner as $bn)
                                            @if ($bn->section == 4)
                                                <a href="{{$bn->web_link}}">
                                                    <img class="img-fluid lazyload" src="{{asset('banner/'.$bn->filename)}}" style="padding-right: 10px;" alt="Banner khu vực 4">
                                                </a>
                                            @endif
                                            @endforeach
                                        @endif
                                    </div>
                                    {{-- end banner 4 --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <a name="comment"></a>
        <div class="col-md-12 px-0">
            <div class="card">
                <div class="pl-2 ml-1 py-2 card-header">
                    <ul class="nav nav-pills nav-secondary" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-products-tab" data-toggle="pill" href="#pills-products" role="tab" aria-controls="pills-products" aria-selected="true">CHI TIẾT SẢN PHẨM</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-feedback-tab" data-toggle="pill" href="#pills-feedback" role="tab" aria-controls="pills-feedback" aria-selected="false">ĐÁNH GIÁ</a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link" id="pills-QandA-tab" data-toggle="pill" href="#pills-QandA" role="tab" aria-controls="pills-QandA" aria-selected="false">HỎI ĐÁP</a>
                        </li> --}}
                    </ul>
                </div>
                <div class="tab-content mt-2 mb-3" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-products" role="tabpanel" aria-labelledby="pills-products-tab">
                        <div class="row">
                            <div class="col-lg-9">
                                <div class="px-4">
                                    <h5 style="border-bottom: 1px solid #f09819; padding-bottom: 10px;">THUỘC TÍNH SẢN PHẨM</h5>
                                    {!!$product->description!!}
                                </div>
                                <div class="px-4 pb-3">
                                    <h5 style="border-bottom: 1px solid #f09819; padding-bottom: 10px;">CHI TIẾT SẢN PHẨM</h5>
                                    {!!$product->content!!}
                                </div>
                            </div>
                            <div class="col-lg-3 d-none d-lg-block">
                                @if(!$banner->isEmpty())
                                    @foreach ($banner as $bn)
                                    @if ($bn->section == 5)
                                        <a href="{{$bn->web_link}}">
                                            <img class="img-fluid lazyload" src="{{asset('banner/'.$bn->filename)}}"  alt="Banner khu vực 5" height="445" width="220">
                                        </a>
                                    @endif
                                @endforeach                                               
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-feedback" role="tabpanel" aria-labelledby="pills-feedback-tab">
                        <h3 class="mx-3" style="background-color: gainsboro; padding:10px;">Đánh giá nhận xét về sản phẩm ( {{$comment->count()}} lượt đánh giá )</h3>
                        <div class="row mx-3">
                            <div class="col-6 pl-0">
                                <div class="rating-star">
                                    <span class="fa fa-star @if(floatval($product->star) > 1) checked @endif" id="star"></span>
                                    <span class="fa fa-star @if(floatval($product->star) > 1.5) checked @endif" id="star"></span>
                                    <span class="fa fa-star @if(floatval($product->star) > 2.5) checked @endif" id="star"></span>
                                    <span class="fa fa-star @if(floatval($product->star) > 3.5) checked @endif" id="star"></span>
                                    <span class="fa fa-star @if(floatval($product->star) > 4.5) checked @endif" id="star"></span>
                                </div>
                                <div class="text-rate-star">
                                    <h1><large>{{$product->star}}</large><small>/5 </small></h1> 
                                </div>
                                <h5><i>Đây là thông tin người mua đánh giá shop bán sản phẩm này có đúng mô tả không.</i></h5>
                            </div>

                            <div class="col-6">
                                <div class="row">
                                    <div class="side">
                                        <div>5 star</div>
                                    </div>
                                    <div class="middle">
                                        <div class="bar-container">
                                            <div style="width: @if($comment->count() > 0) {{App\Models\Comment::where([['product_id',$product->id],['rating_star',5]])->count()*100/$comment->count()}}% @endif; height: 18px; background-color: #4CAF50;"></div>
                                        </div>
                                    </div>
                                    <div class="side right">
                                        <div>{{App\Models\Comment::where([['product_id',$product->id],['rating_star',5]])->count()}}</div>
                                    </div>
                                    <div class="side">
                                        <div>4 star</div>
                                    </div>
                                    <div class="middle">
                                        <div class="bar-container">
                                            <div style="width: @if($comment->count() > 0) {{App\Models\Comment::where([['product_id',$product->id],['rating_star',4]])->count()*100/$comment->count()}}% @endif; height: 18px; background-color: #2196F3;"></div>
                                        </div>
                                    </div>
                                    <div class="side right">
                                        <div>{{App\Models\Comment::where([['product_id',$product->id],['rating_star',4]])->count()}}</div>
                                    </div>
                                    <div class="side">
                                        <div>3 star</div>
                                    </div>
                                    <div class="middle">
                                        <div class="bar-container">
                                            <div style="width: @if($comment->count() > 0) {{App\Models\Comment::where([['product_id',$product->id],['rating_star',3]])->count()*100/$comment->count()}}% @endif; height: 18px; background-color: #00bcd4;"></div>
                                        </div>
                                    </div>
                                    <div class="side right">
                                        <div>{{App\Models\Comment::where([['product_id',$product->id],['rating_star',3]])->count()}}</div>
                                    </div>
                                    <div class="side">
                                        <div>2 star</div>
                                    </div>
                                    <div class="middle">
                                        <div class="bar-container">
                                            <div style="width: @if($comment->count() > 0) {{App\Models\Comment::where([['product_id',$product->id],['rating_star',2]])->count()*100/$comment->count()}}% @endif; height: 18px; background-color: #ff9800;"></div>
                                        </div>
                                    </div>
                                    <div class="side right">
                                        <div>{{App\Models\Comment::where([['product_id',$product->id],['rating_star',2]])->count()}}</div>
                                    </div>
                                    <div class="side">
                                        <div>1 star</div>
                                    </div>
                                    <div class="middle">
                                        <div class="bar-container">
                                            <div style="width: @if($comment->count() > 0) {{App\Models\Comment::where([['product_id',$product->id],['rating_star',1]])->count()*100/$comment->count()}}% @endif; height: 18px; background-color: #f44336;"></div>
                                        </div>
                                    </div>
                                    <div class="side right">
                                        <div>{{App\Models\Comment::where([['product_id',$product->id],['rating_star',1]])->count()}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 py-4">
                            <div class="card-body login">
                                <form action="{{URL::route('comment')}}#comment" method="post">
                                    @csrf
                                    <input type="text" value="{{$product->id}}" name="product_id" hidden>
                                    <div class="form-group">
                                        <div>
                                            <b>Nhận xét về sản phẩm:</b>
                                        </div>
                                        <div class="rate">
                                        <input type="radio" id="star5" name="rate" value="5" required>
                                        <label for="star5" title="text"></label>
                                        <input type="radio" id="star4" name="rate" value="4">
                                        <label for="star4" title="text"></label>
                                        <input type="radio" id="star3" name="rate" value="3">
                                        <label for="star3" title="text"></label>
                                        <input type="radio" id="star2" name="rate" value="2">
                                        <label for="star2" title="text"></label>
                                        <input type="radio" id="star1" name="rate" value="1">
                                        <label for="star1" title="text"></label>
                                        </div>
                                        <textarea name="content" required class="form-control" placeholder="Nhận xét..."></textarea>
                                        <br>
                                    </div>
                                    <button type="submit" style="margin-left:9px" class="btn btn-primary">
                                        Nhận xét
                                    </button>
                                </form>
                                <hr>

                                {{-- show comment --}}
                                @foreach($comment as $comment)
                                <div class="comment-user">
                                    <div class="pt-5 row">
                                        <div class="col-lg-9 col-md-9 col-8 px-0 px-lg-2">
                                            <div class="row no-gutters">
                                                <div class="px-2 col-md-1 col-3">
                                                    <div class="avatar">
                                                        @if ($comment->users->avatar)
                                                        <object data="{{asset('profile/'.$comment->users->avatar)}}" class="avatar-img rounded-circle" type="image/png">
                                                            <img src="{{$comment->users->avatar}}" alt="image profile lazyload" class="avatar-img rounded-circle">
                                                        </object>
                                                        @else
                                                        <img src="{{asset('profile/default_av.png')}}" alt="image profile lazyload" class="avatar-img rounded-circle">
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-5 col-5">
                                                    <h5>
                                                        <b>
                                                            @if ($comment->users->name)
                                                            {{$comment->users->name}}:
                                                            @else
                                                            {{$comment->users->username}}:
                                                            @endif
                                                        </b>
                                                    </h5>
                                                    <p><i>{{$comment->created_at}}</i></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-4 px-0 px-lg pr-3">
                                            <div class="text-right rating-star pb-2">
                                                <span class="fa fa-star @if(floatval($comment->rating_star) >= 1) checked @endif" id="star"></span>
                                                <span class="fa fa-star @if(floatval($comment->rating_star) >= 2) checked @endif" id="star"></span>
                                                <span class="fa fa-star @if(floatval($comment->rating_star) >= 3) checked @endif" id="star"></span>
                                                <span class="fa fa-star @if(floatval($comment->rating_star) >= 4) checked @endif" id="star"></span>
                                                <span class="fa fa-star @if(floatval($comment->rating_star) == 5) checked @endif" id="star"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="comment">
                                        <h4>{{$comment->content}}</h4>
                                    </div>

                                    <div class="col-ml-7 col-7" style="margin-left:50px">
                                        <hr>
                                        @foreach($reply as $item)
                                        
                                        @if($item->comment_id == $comment->id)
                                        <strong>
                                            @if ($item->users->name)
                                                {{$item->users->name}}:
                                            @else
                                            {{$item->users->username}}:
                                            @endif
                                        </strong>  &nbsp;{{$item->content}}
                                        <br>
                                        @endif
                                        @endforeach
                                    </div>
                                    <form action="{{route('reply')}}" method="post">
                                        @csrf
                                        <div class="row pt-2" style="margin-left:50px">
                                            <div class="col-lg-5 pl-0 col-9">
                                                <input type="text" value="{{$product->id}}" name="product_id" hidden>
                                                <input type="text" value="{{$comment->id}}" hidden name="comment_id">
                                                <input type="text" value="{{$comment->users->id}}" hidden name="user_id">
                                                <textarea name="content" required class="form-control" placeholder="Reply"></textarea>
                                            </div>
                                            <div class="col-lg-5 col-2 px-0">
                                                <button type="submit" class="btn btn-primary btn-sm">
                                                    Reply
                                                </button> 
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                @endforeach
                                {{-- end show comment --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                        
        <!-- TAGS -->
        <div class="col px-0 pb-4" >
            <div class="card-header px-4" style="background-color: white; box-shadow: 0 1px 15px 1px rgba(69,65,78,.08);">
                <h4><b>TAGS</b></h4>
            </div>
            <div class="col py-3" style="background-color: white; box-shadow: 0 1px 15px 1px rgba(69,65,78,.08);">
                @foreach ($tag as $tag)
                <button type="button" class="btn-btn-tags"><a href="{{route('tag.show',$tag->getTag->slug)}}" style="color:white">{{$tag->getTag->name}}</a></button>
                @endforeach
            </div>
        </div>
        <!-- END-TAGS -->

        {{-- relate products --}}
        <div class="col px-0">
            <div class="card">
                <div class="card-header">
                    <h2 style="border-left: 4px solid orange; padding-left: 10px;">Sản phẩm liên quan</h2>
                </div>
                <div class="owl-carousel owl-theme product-watched_carousel">
                    @foreach ($relateProduct as $relateProduct)
                    <div class="item" id="shadow-card">
                        <div class="card">  
                            <a href="{{route('san-pham.show',$relateProduct->slug)}}">
                                <img class="img-fluid lazyload" style="height: 210px;" src="{{asset('images/'.json_decode($relateProduct->filename)[0])}}" alt="Chania">
                            </a>
                            <div class="px-2">
                                <div class="pt-3 title-card" style="height: 55px;">
                                    <a class="card-title" href="{{route('san-pham.show',$relateProduct->slug)}}">
                                        <h4 class="ellipsis">{{$relateProduct->name}}</h4>
                                    </a>
                                </div>
                                <div class="text-left common-cost">
                                    <div class="col">
                                        <div class="row">
                                            @if (!empty($relateProduct->promotion))
                                            <p class="main-cost">
                                                <b>{{number_format($relateProduct->promotion*1000, 0, ',', '.' )}}đ</b>
                                            </p>                
                                            <p class="pt-1 abondon-text-cost">
                                                {{number_format($relateProduct->price*1000, 0, ',', '.' )}}đ
                                            </p>
                                            @else
                                            <p class="main-cost">
                                                <b>{{number_format($relateProduct->price*1000, 0, ',', '.' )}}đ</b>
                                            </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="rating-star pb-2">
                                    <span class="fa fa-star @if(floatval($relateProduct->star) > 1) checked @endif" id="star"></span>
                                    <span class="fa fa-star @if(floatval($relateProduct->star) > 1.5) checked @endif" id="star"></span>
                                    <span class="fa fa-star @if(floatval($relateProduct->star) > 2.5) checked @endif" id="star"></span>
                                    <span class="fa fa-star @if(floatval($relateProduct->star) > 3.5) checked @endif" id="star"></span>
                                    <span class="fa fa-star @if(floatval($relateProduct->star) > 4.5) checked @endif" id="star"></span>
                                </div>
                                <div class="row pb-3 icon-view-details">
                                    <a href="{{route('san-pham.show',$relateProduct->slug)}}">
                                        <div class="col" style="color: blue;">Xem chi tiết</div>
                                    </a>
                                    @if (Auth::check())
                                    <form action="{{route('cart.store')}}" method="post">
                                        @csrf
                                        <input type="text" value="{{Auth::user()->id}}" name="user_id" hidden>
                                        <input type="text" value="1" name="quantity" hidden>
                                        <input type="text" value="{{$relateProduct->id}}" name="product_id" hidden>
                                        <input type="text" value="{{explode(',',$relateProduct->size)[0]}}" name="size" hidden>
                                        <input type="text" value="{{explode(',',$relateProduct->color)[0]}}" name="color" hidden>
                                        <button type="submit" class="btn-btn-cart">
                                            <i class="fas fa-cart-plus" style="color: #f09819;"></i>
                                        </button>
                                    </form>
                                    @else
                                    <a href="{{route('login')}}">
                                        <div class="product-btn" style="color: #f09819;">
                                            <i class="fas fa-cart-plus"></i>
                                        </div>
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        {{-- end relate products --}}

        {{-- viewed products --}}
        @if (Auth::check())
        <div class="col px-0">
            <div class="card">
                <div class="card-header">
                    <h2 style="border-left: 4px solid orange; padding-left: 10px;">SẢN PHẨM ĐÃ XEM</h2>
                </div>
                <div class="owl-carousel owl-theme">
                    @foreach ($viewedList as $productViewed)
                    <div class="item" id="shadow-card">
                        <div class="card">  
                            <a href="{{route('san-pham.show',$productViewed->viewedProduct->slug)}}">
                                <img class="img-fluid lazyload" style="height: 210px;" src="{{asset('images/'.json_decode($productViewed->viewedProduct->filename)[0])}}" alt="Chania">
                            </a>
                            <div class="px-2">
                                <div class="pt-3 title-card" style="height: 55px;">
                                    <a class="card-title" href="{{route('san-pham.show',$productViewed->viewedProduct->slug)}}">
                                        <h4 class="ellipsis">{{$productViewed->viewedProduct->name}}</h4>
                                    </a>
                                </div>
                                <div class="text-left common-cost">
                                    <div class="col">
                                        <div class="row">
                                            @if (!empty($productViewed->viewedProduct->promotion))
                                            <p class="main-cost">
                                                <b>{{number_format($productViewed->viewedProduct->promotion*1000, 0, ',', '.' )}}đ</b>
                                            </p>                
                                            <p class="pt-1 abondon-text-cost">
                                                {{number_format($productViewed->viewedProduct->price*1000, 0, ',', '.' )}}đ
                                            </p>
                                            @else
                                            <p class="main-cost">
                                                <b>{{number_format($productViewed->viewedProduct->price*1000, 0, ',', '.' )}}đ</b>
                                            </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="rating-star pb-2">
                                    <span class="fa fa-star @if(floatval($productViewed->viewedProduct->star) > 1) checked @endif" id="star"></span>
                                    <span class="fa fa-star @if(floatval($productViewed->viewedProduct->star) > 1.5) checked @endif" id="star"></span>
                                    <span class="fa fa-star @if(floatval($productViewed->viewedProduct->star) > 2.5) checked @endif" id="star"></span>
                                    <span class="fa fa-star @if(floatval($productViewed->viewedProduct->star) > 3.5) checked @endif" id="star"></span>
                                    <span class="fa fa-star @if(floatval($productViewed->viewedProduct->star) > 4.5) checked @endif" id="star"></span>
                                </div>
                                <div class="row pb-3 icon-view-details">
                                    <a href="{{route('san-pham.show',$productViewed->viewedProduct->slug)}}"> <div class="col" style="color: blue;">Xem chi tiết</div></a>
                                    
                                    @if (Auth::check())
                                    <form action="{{route('cart.store')}}" method="post">
                                        @csrf
                                        <input type="text" value="{{Auth::user()->id}}" name="user_id" hidden>
                                        <input type="text" value="1" name="quantity" hidden>
                                        <input type="text" value="{{$productViewed->products_id}}" name="product_id" hidden>
                                        <input type="text" value="{{explode(',',$productViewed->size)[0]}}" name="size" hidden>
                                        <input type="text" value="{{explode(',',$productViewed->color)[0]}}" name="color" hidden>
                                        <button type="submit" class="btn-btn-cart">
                                            <i class="fas fa-cart-plus" style="color: #f09819;"></i>
                                        </button>
                                    </form>
                                    @else
                                    <a href="{{route('login')}}">
                                        <div class="product-btn" style="color: #f09819;">
                                            <i class="fas fa-cart-plus"></i>
                                        </div>
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div> 
        @endif
        {{-- end viewed products --}}
    </div>
</div>
@endsection