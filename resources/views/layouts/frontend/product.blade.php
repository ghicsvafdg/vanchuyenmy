<div class="col px-0 pb-2">
    <h3 style="border-left: 4px solid #f09819; padding-left: 5px;"><b>SẢN PHẨM VỚI TỪ KHÓA "{{$search}}"</b></h3>
</div>

<div class="px-0 col-md-12">
    <form action="{{route('filter-search')}}" class="row" method="POST">
        @csrf
        <div style="margin-top:15px">
            <h2 style="margin-left:15px">Lọc sản phẩm</h2>
        </div>
        <input type="hidden" name="search" value="{{$search}}">
        
        <div class="col">
            <select name="price" class="form-control input-fixed" id="notify_placement_align" style="margin-top: 5px;" >
                <option value="" @if($price == null) selected @endif disabled>Giá</option>
                <option value="1" @if($price == 1) selected @endif>Giá: Thấp đến cao</option>
                <option value="2" @if($price == 2) selected @endif>Giá: Cao đến thấp</option>
            </select>
        </div>

        <div class="col">
            <select name="range" class="form-control input-fixed" id="notify_placement_align" style="margin-top: 5px;" >
                <option value="" @if($price == null) selected @endif disabled>Khoảng giá</option>
                <option value="1" @if($price == 1) selected @endif >0-200.000đ</option>
                <option value="2" @if($price == 2) selected @endif>200.000-500.000đ</option>
                <option value="3" @if($price == 3) selected @endif>500.000-1.000.000đ</option>
                <option value="4" @if($price == 4) selected @endif>>1.000.000đ</option>
            </select>
        </div>
        <div class="col text-center" style="margin-top:7px">
            <button type="submit" class="btn btn-primary btn-sm center-block">Lọc
            </button> 
        </div>      
    </form>
    <div class="card">
        <div class="px-2 card-body">
            <div class="tab-content mt-2 mb-3" id="pills-tabContent">
                <div class="tab-pane fade show active">
                    <div class="owl-carousel owl-theme">
                        @foreach ($product as $pro)
                        <div class="item">
                            <div class="card-product"> 
                                <a href="{{route('san-pham.show',$pro->slug)}}">
                                    <img class="img-fluid" style="height: 210px;" src="{{asset('images/'.json_decode($pro->filename)[0])}}" alt="Chania">
                                </a>
                                <div class="col">
                                    <div class="pt-3 title-card" style="height: 50px;">
                                        <a class="card-title" href="{{route('san-pham.show',$pro->slug)}}" style="height: 55px;">
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
                                                    {{number_format( $pro->promotion, 0, ',', ' ' )}}.000đ
                                                </p>                
                                                <p class="pt-1 abondon-text-cost">
                                                    <b>{{number_format( $pro->price, 0, ',', ' ' )}}.000đ</b>
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
                                        <span class="fa fa-star checked" id="star"></span>
                                        <span class="fa fa-star checked" id="star"></span>
                                        <span class="fa fa-star checked" id="star"></span>
                                        <span class="fa fa-star" id="star"></span>
                                        <span class="fa fa-star" id="star"></span>
                                    </div>
                                    <div class="row pb-3 icon-view-details">
                                        <a href="{{route('san-pham.show',$pro->slug)}}"> <div class="col" style="color: blue;">Xem chi tiết</div></a>
                                        @if (Auth::check())
                                        <form action="{{route('cart.store')}}" method="post">
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
                                            <div class="ml-4" style="color: #f09819;">
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
        </div>
    </div>
</div>