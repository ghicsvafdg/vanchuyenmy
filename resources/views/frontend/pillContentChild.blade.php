@foreach ($childs as $child)
@if ($child->status == 1)
<div class="tab-pane fade" id="pills-{{$child->id}}" role="tabpanel" aria-labelledby="pills-{{$child->id}}-tab">
    <div class="owl-carousel owl-theme">
        @foreach ($child->product as $pro)
        @if ($pro->status == 1)
        <div class="item">
            <div class="card-product"> 
                <a href="{{route('detail-product',$pro->slug)}}">
                    <img class="img-fluid lazyload" style="height: 210px;" src="{{asset('images/'.json_decode($pro->filename)[0])}}" alt="Chania">
                </a>
                <div class="col">
                    <div class="pt-3 title-card" style="height: 55px;">
                        <a class="card-title" style="height: 55px;" href="{{route('detail-product',$pro->slug)}}">
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
                        <form action="{{URL::route('cart.store')}}#pills-{{$child->id}}" method="post">
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
                            <div class="product-btn" style="color: #f09819;"><i class="fas fa-cart-plus"></i></div>
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
@endif
@endforeach
