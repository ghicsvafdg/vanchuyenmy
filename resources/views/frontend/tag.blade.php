@extends('layouts.frontend.app')
@section('content')
<div class="py-4 container">
    <div class="page-header">
        <div class="px-0 col-md-12">
            <div class="card-header" style="margin: 0px">
                <ul class="nav nav-pills nav-secondary" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-popular-tab" data-toggle="pill" href="#pills-popular" role="tab" aria-controls="pills-popular" aria-selected="true">{{$tag->name}}</a>
                    </li>
                </ul>
            </div>
            <div class="tab-content mt-2 mb-3" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-popular" role="tabpanel" aria-labelledby="pills-popular-tab">
                    {{-- products in tag --}}
                    <div class="row">
                        <div class="col-3">
                            <h2>Sản phẩm</h2>
                        </div>
                        <div class="col-9">
                            <div class="row">
                                @foreach ($product as $pro)
                                <div class="px-2 col-lg-3" >
                                    <div class="card-product">  
                                        <a href="{{route('san-pham.show',$pro->getProduct->slug)}}"> <img class="img-fluid" style="height: 210px;" src="{{asset('images/'.json_decode($pro->getProduct->filename)[0])}}" alt="Chania"></a>
                                        <div class="col">
                                            <div class="pt-3 title-card" style="height: 55px;">
                                                <a class="card-title" style="height: 50px;"  href="{{route('san-pham.show',$pro->getProduct->slug)}}">
                                                    <h4 class="ellipsis">
                                                        {{$pro->getProduct->name}} 
                                                    </h4>
                                                </a>
                                            </div>
                                            <div class="text-left common-cost" >
                                                <div class="col">
                                                    <div class="row">
                                                        @if (!empty($pro->getProduct->promotion))               
                                                        <p class="main-cost">
                                                            <b>{{number_format( $pro->getProduct->promotion*1000, 0, ',', '.' )}}đ</b>
                                                        </p>                
                                                        <p class="pt-1 abondon-text-cost">
                                                            {{number_format( $pro->getProduct->price*1000, 0, ',', '.' )}}đ
                                                        </p>
                                                        @else
                                                        <p class="main-cost">
                                                            <b>{{number_format( $pro->getProduct->price*1000, 0, ',', '.' )}}đ</b>
                                                        </p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="rating-star pb-2">
                                                <span class="fa fa-star checked" id="star"></span>
                                                <span class="fa fa-star checked" id="star"></span>
                                                <span class="fa fa-star checked" id="star"></span>
                                                <span class="fa fa-star" id="star"></span>
                                                <span class="fa fa-star" id="star"></span>
                                            </div>
                                            <div class="row pb-3 icon-view-details">
                                                <a href="{{route('san-pham.show',$pro->getProduct->slug)}}">
                                                    <div class="col" style="color: blue;">Xem chi tiết</div>
                                                </a>
                                                @if (Auth::check())
                                                <form action="{{route('cart.store')}}" method="post">
                                                    @csrf
                                                    <input type="text" value="{{Auth::user()->id}}" name="user_id" hidden>
                                                    <input type="text" value="1" name="quantity" hidden>
                                                    <input type="text" value="{{$pro->getProduct->id}}" name="product_id" hidden>
                                                    <input type="text" value="{{explode(',',$pro->getProduct->size)[0]}}" name="size" hidden>
                                                    <input type="text" value="{{explode(',',$pro->getProduct->color)[0]}}" name="color" hidden>
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

                            {{-- pagination --}}
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4"></div>  
                                    <div class="col-4">
                                        {{ $product->appends(Illuminate\Support\Facades\Input::except('page')) }}
                                    </div>
                                    <div class="col-4"></div>
                                </div>
                            </div>
                            {{-- end pagination --}}
                        </div>
                    </div>
                    {{-- end products in tag --}}

                    {{-- posts in tag --}}
                    <div class="row">
                        <div class="col-3">
                            <h2>Bài viết</h2>
                        </div>
                        <div class="col-9">
                            <div class="row">
                                @foreach ($posts as $post)
                                <div class="px-2 col-lg-3" >
                                    <div class="item" id="title-post">
                                        <div class="img-blog">
                                            <a href="{{route('post.show',$post->getPost->slug)}}">
                                                <img src="{{asset('images/'.$post->getPost->filename)}}" style="height: 280px;" class="img-fluid pb-3" alt="...">
                                            </a>
                                        </div>
                                        <div class="col pt-2">
                                            <div class="title-post">
                                                <a href="{{route('post.show',$post->getPost->slug)}}"><h4>{{$post->getPost->title}}</h4></a>
                                            </div>
                                            <div class="time-post">
                                                <p class="date">{{$post->getPost->created_at}}</p>
                                                <p><i class="fas fa-comment mr-1"></i>Bình luận</p>
                                            </div>
                                            <p class="mb-1 description post-paragraph">{{$post->getPost->description}}</p>
                                            <a href="{{route('post.show',$post->getPost->slug)}}"><p>Đọc tiếp <i class="fas fa-arrow-circle-right"></i></p></a>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            {{-- pagination --}}
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4"></div>  
                                    <div class="col-4">
                                        {{ $posts->appends(Illuminate\Support\Facades\Input::except('page')) }}
                                    </div>
                                    <div class="col-4"></div>
                                </div>
                            </div>
                            {{-- end pagination --}}
                        </div>
                    </div>
                    {{-- end posts in tag --}}
                </div>
            </div>  
        </div>       
    </div> 
</div>
@endsection