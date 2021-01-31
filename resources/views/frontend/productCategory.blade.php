@extends('layouts.frontend.app')
@section('content')
<div class="py-4 container">
    <div class="page-header">
        <!-- breadcum -->
        <div class="row"> 
            
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="#">
                        <a href="{{route('index')}}"><i class="flaticon-home"></i></a>
                    </a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                @if ($category->parent_id == 0)
                <li class="nav-item">
                    <a href="{{route('danh-muc.show',$category->slug)}}">{{$category->title}}</a>
                </li>
                @else
                <li class="nav-item">
                    <a href="{{route('danh-muc.show',App\Models\ProductCategory::where([['id',$category->parent_id],['status',1]])->first()->slug)}}">{{App\Models\ProductCategory::where([['id',$category->parent_id],['status',1]])->first()->title}}</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="{{route('danh-muc.show',$category->slug)}}">{{$category->title}}</a>
                </li>
                @endif
            </ul>
        </div>
        <!-- end breadcum -->
        
        <!-- Banner -->
        <div class="row pl-3 pb-4">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" >
                <div class="carousel-inner">
                    @foreach ($banner as $bn)
                        @if ($bn->section == 6)
                            <?php $array[] = $bn; ?>
                        @endif
                    @endforeach
                    <div class="carousel-item active">
                        <a href="{{$array[0]->web_link}}">
                            <img src="{{asset('banner/'.$array[0]->filename)}}" class="img-fluid" alt="banner khu vực 6">
                        </a>
                    </div>
                    @for ($i = 1; $i < count($array); $i++)
                        <div class="carousel-item">
                            <a href="{{$array[$i]->web_link}}">
                                <img src="{{asset('banner/'.$array[$i]->filename)}}" class="img-fluid" alt="banner khu vực 6">
                            </a>
                        </div>
                    @endfor
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            
        </div>
        <!--End Banner -->
        
        <div class="px-0 col-md-12">
            <div class="card-header" style="margin: 0px">
                <ul class="nav nav-pills nav-secondary" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-popular-tab" data-toggle="pill" href="#pills-popular" role="tab" aria-controls="pills-popular" aria-selected="true">Phổ Biến</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-newest-tab" data-toggle="pill" href="#pills-newest" role="tab" aria-controls="pills-newest" aria-selected="false">Mới Nhất</a> 
                    </li>
                    <div>
                        <form action="{{route('filter-product-cate', $category->id)}}" method="GET" style="display: flex">
                            @csrf
                            <li class="nav-item">
                                <select name="price" class="form-control input-fixed" id="range-price" style="margin-top: 5px; width: 200px;">
                                    <option value="" selected >Giá</option>
                                    <option value="1" >Giá: Thấp đến cao</option>
                                    <option value="2">Giá: Cao đến thấp</option>
                                </select>
                            </li>
                            <li class="nav-item">
                                <select name="range" class="form-control input-fixed" id="range-price" style="margin-top: 5px; width: 200px;">
                                    <option value="" selected>Khoảng giá</option>
                                    <option value="1">0-200.000đ</option>
                                    <option value="2">200.000-500.000đ</option>
                                    <option value="3">500.000-1.000.000đ</option>
                                    <option value="4">>1.000.000đ</option>
                                </select>
                            </li>
                            <li>
                                <button type="submit" class="ml-3 my-1 btn btn-primary">Lọc</button> 
                            </li>
                        </form>
                    </div>
                </ul>
            </div>
            <div class="tab-content mt-2 mb-3" id="pills-tabContent">
                <!-- popular tab -->
                <div class="tab-pane fade show active" id="pills-popular" role="tabpanel" aria-labelledby="pills-popular-tab">
                    <div class="row">
                        {{-- small category --}}
                        @include('layouts.frontend.smallCategory')
                        {{-- end small category --}}
                        
                        <div class="col-lg-9 col-12">
                            <div class="col">
                                <div class="row">
                                    @foreach ($product as $pro)
                                    <div class="px-2 col-lg-3 col-6">
                                        <div class="card-product">  
                                            <a href="{{route('san-pham.show',$pro->slug)}}">
                                                <img class="img-fluid" style="height: 210px;" src="{{asset('images/'.json_decode($pro->filename)[0])}}" alt="Chania">
                                            </a>
                                            <div class="col">
                                                <div class="pt-3" id="title-card">
                                                    <a class="card-title" href="{{route('san-pham.show',$pro->slug)}}">
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
                                                                <b>{{number_format( $pro->price*1000, 0, ',', '.' )}}đ</b>
                                                            </p>                
                                                            <p class="pt-1" id="abondon-text-cost">
                                                                {{number_format( $pro->promotion*1000, 0, ',', '.' )}}đ
                                                            </p>
                                                            @else
                                                            <p class="main-cost">
                                                                <b>{{number_format( $pro->promotion*1000, 0, ',', '.' )}}đ</b>
                                                            </p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="rating-star pb-2">
                                                    <span class="fa fa-star @if(floatval($pro->star) > 1) checked @endif" id="star"></span>
                                                    <span class="fa fa-star @if(floatval($pro->star) > 1.5) checked @endif" id="star"></span>
                                                    <span class="fa fa-star @if(floatval($pro->star) > 2.5) checked @endif" id="star"></span>
                                                    <span class="fa fa-star @if(floatval($pro->star) > 3.5) checked @endif" id="star"></span>
                                                    <span class="fa fa-star @if(floatval($pro->star) > 4.5) checked @endif" id="star"></span>
                                                </div>
                                                <div class="row pb-3" id="icon-view-details">
                                                    <a href="{{route('san-pham.show',$pro->slug)}}">
                                                        <div class="col" style="color: blue;">Xem chi tiết</div>
                                                    </a>
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
                                                        <div class="btn-btn-cart" style="color: #f09819;">
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
                </div>
                <!-- End popular tab -->
                
                <!-- Latest -->
                <div class="tab-pane fade" id="pills-newest" role="tabpanel" aria-labelledby="pills-newest-tab">
                    <div class="row">
                        @include('layouts.frontend.smallCategory')
                        <div class="col-lg-9 col-12">
                            <div class="col">
                                <div class="row">
                                    {{-- @if(isset($newest)) --}}
                                    @foreach ($newest as $pro)
                                    <div class="px-2 col-lg-3 col-6">
                                        <div class="card-product">  
                                            <a href="{{route('san-pham.show',$pro->slug)}}">
                                                <img class="img-fluid" style="height: 210px;" src="{{asset('images/'.json_decode($pro->filename)[0])}}" alt="Chania">
                                            </a>
                                            <div class="col">
                                                <div class="pt-3" id="title-card">
                                                    <a class="card-title" href="{{route('san-pham.show',$pro->slug)}}">
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
                                                            <p class="pt-1" id="abondon-text-cost">
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
                                                
                                                <div class="rating-star pb-2">
                                                    <span class="fa fa-star @if(floatval($pro->star) > 1) checked @endif" id="star"></span>
                                                    <span class="fa fa-star @if(floatval($pro->star) > 1.5) checked @endif" id="star"></span>
                                                    <span class="fa fa-star @if(floatval($pro->star) > 2.5) checked @endif" id="star"></span>
                                                    <span class="fa fa-star @if(floatval($pro->star) > 3.5) checked @endif" id="star"></span>
                                                    <span class="fa fa-star @if(floatval($pro->star) > 4.5) checked @endif" id="star"></span>
                                                </div>
                                                <div class="row pb-3" id="icon-view-details">
                                                    <a href="{{route('san-pham.show',$pro->slug)}}">
                                                        <div class="col" style="color: blue;">Xem chi tiết</div>
                                                    </a>
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
                                                        <div class="btn-btn-cart" style="color: #f09819;">
                                                            <i class="fas fa-cart-plus"></i>
                                                        </div>
                                                    </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    {{-- @endif --}}
                                </div>
                            </div>
                            
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4"></div>  
                                    <div class="col-4">
                                        {{-- @if(isset($newest)) --}}
                                        {{ $newest->appends(Illuminate\Support\Facades\Input::except('page')) }}
                                        {{-- @endif --}}
                                    </div>
                                    <div class="col-4"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End latest -->
            </div>  
        </div>       
    </div> 
</div>
@endsection