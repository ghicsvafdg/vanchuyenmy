@foreach ($categories as $item)
<div class="px-0 col-md-12">
    <div class="card">
        <div class="pl-3 card-header">
            <ul class="nav nav-pills nav-secondary" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pills-{{$item->id}}-tab" data-toggle="pill" href="#pills-{{$item->id}}" role="tab" aria-controls="pills-{{$item->id}}" aria-selected="true">{{$item->title}}</a>
                </li>
                @if (count($item->childs))
                @include('frontend.pillChild',['childs' => $item->childs])
                @endif
            </ul>
        </div>
        
        <div class="px-2 card-body">
            <div class="tab-content mt-2 mb-3" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-{{$item->id}}" role="tabpanel" aria-labelledby="pills-{{$item->id}}-tab">
                    <!--Carousel Wrapper-->
                    <div class="owl-carousel owl-theme">
                        @foreach ($item->product as $pro)
                        @if ($pro->status == 1)
                        <div class="item">
                            <div class="card-product"> 
                                <a href="{{route('detail-product',$pro->slug)}}">
                                    <img class="img-fluid lazyload" style="height: 210px;" src="{{asset('images/'.json_decode($pro->filename)[0])}}" alt="Chania">
                                </a>
                                <div class="col">
                                    <div class="pt-3 title-card" style="height: 55px;">
                                        <a class="card-title" href="{{route('detail-product',$pro->slug)}}" style="height: 50px;">
                                            <h4 class="ellipsis">
                                                {{$pro->name}} 
                                            </h4>
                                        </a>    
                                    </div>
                                    <div class="text-left common-cost">
                                        <div class="col">
                                            <div class="row">
                                                @if (!empty($pro->promotion))               
                                                <p class="main-cost">
                                                    <b>{{number_format( $pro->promotion*1000, 0, ',', '.' )}}đ</b>
                                                </p>                
                                                <p class="pt-1 abondon-text-cost">
                                                    {{number_format( $pro->price*1000, 0, ',', '.' )}}đ
                                                </p>
                                                @else
                                                <p class="main-cost">
                                                    <b>{{number_format( $pro->price*1000, 0, ',', '.' )}}đ</b>
                                                </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-left">  
                                    </div>
                                    <div class="rating-star pb-2">
                                        <span class="fa fa-star @if(floatval($pro->star) > 1) checked @endif" id="star"></span>
                                        <span class="fa fa-star @if(floatval($pro->star) > 1.5) checked @endif" id="star"></span>
                                        <span class="fa fa-star @if(floatval($pro->star) > 2.5) checked @endif" id="star"></span>
                                        <span class="fa fa-star @if(floatval($pro->star) > 3.5) checked @endif" id="star"></span>
                                        <span class="fa fa-star @if(floatval($pro->star) > 4.5) checked @endif" id="star"></span>
                                    </div>
                                    <div class="row pb-3 icon-view-details">
                                        <a href="{{route('detail-product',$pro->slug)}}"> <div class="col" style="color: blue;">Xem chi tiết</div></a>
                                        @if (Auth::check())
                                        <form action="{{URL::route('cart.store')}}#pills-{{$item->id}}" method="post">
                                            @csrf
                                            <input type="text" value="{{Auth::user()->id}}" name="user_id" hidden>
                                            <input type="text" value="1" name="quantity" hidden>
                                            <input type="text" value="{{$pro->id}}" name="product_id" hidden>
                                            <input type="text" value="{{explode(',',$pro->size)[0]}}" name="size" hidden>
                                            <input type="text" value="{{explode(',',$pro->color)[0]}}" name="color" hidden>
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
                        @endif
                        
                        @endforeach 
                        @foreach ($product as $pro)
                        @if ($pro->productCategory->parent_id == $item->id && $pro->status == 1 && $pro->productCategory->status == 1)
                        <div class="item">
                            <div class="card-product"> 
                                <a href="{{route('detail-product',$pro->slug)}}">
                                    <img class="img-fluid lazyload" style="height: 210px;" src="{{asset('images/'.json_decode($pro->filename)[0])}}" alt="Chania">
                                </a>
                                <div class="col">
                                    <div class="pt-3 title-card" style="height: 55px;">
                                        <a class="card-title" href="{{route('detail-product',$pro->slug)}}" style="height: 50px;">
                                            <h4 class="ellipsis">
                                                {{$pro->name}}
                                            </h4>
                                        </a>
                                    </div>
                                    <div class="text-left common-cost">
                                        <div class="col">
                                            <div class="row">
                                                @if (!empty($pro->promotion))               
                                                <p class="main-cost">
                                                    <b>{{number_format( $pro->promotion, 0, ',', ' ' )}}.000đ</b>
                                                </p>                
                                                <p class="pt-1 abondon-text-cost">
                                                    {{number_format( $pro->price, 0, ',', ' ' )}}.000đ
                                                </p>
                                                @else
                                                <p class="main-cost">
                                                    <b>{{number_format( $pro->price, 0, ',', ' ' )}}.000đ</b>
                                                </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-left">  
                                    </div>
                                    <div class="rating-star pb-2">
                                        <span class="fa fa-star @if(floatval($pro->star) > 1) checked @endif" id="star"></span>
                                        <span class="fa fa-star @if(floatval($pro->star) > 1.5) checked @endif" id="star"></span>
                                        <span class="fa fa-star @if(floatval($pro->star) > 2.5) checked @endif" id="star"></span>
                                        <span class="fa fa-star @if(floatval($pro->star) > 3.5) checked @endif" id="star"></span>
                                        <span class="fa fa-star @if(floatval($pro->star) > 4.5) checked @endif" id="star"></span>
                                    </div>
                                    <div class="row pb-3 icon-view-details">
                                        <a href="{{route('detail-product',$pro->slug)}}"> <div class="col" style="color: blue;">Xem chi tiết</div></a>
                                        @if (Auth::check())
                                        <form action="{{URL::route('cart.store')}}#pills-{{$item->id}}" method="post">
                                            @csrf
                                            <input type="text" value="{{Auth::user()->id}}" name="user_id" hidden>
                                            <input type="text" value="1" name="quantity" hidden>
                                            <input type="text" value="{{$pro->id}}" name="product_id" hidden>
                                            <input type="text" value="{{explode(',',$pro->size)[0]}}" name="size" hidden>
                                            <input type="text" value="{{explode(',',$pro->color)[0]}}" name="color" hidden>
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
                        @endif
                        @endforeach
                    </div>
                </div>
                @if (count($item->childs))
                @include('frontend.pillContentChild',['childs' => $item->childs])
                @endif
            </div>
        </div>
    </div>
</div>
@endforeach
