<div class="card_header mb-3" style=" margin-bottom: 0px;">
    <div class="active_header">
        <h2 id="active_text">SẢN PHẨM HOT</h2>
        <p id="demo"></p>
    </div>
</div>

<div class="owl-carousel owl-theme">
    @foreach ($hotProducts as $product)
    <div class="item">
        <div class="card-product">   
            <a href="{{route('san-pham.show',App\Models\Product::findOrFail($product->products_id)->slug)}}">
                <img class="img-fluid" style="height: 200px;" src="{{asset('images/'.json_decode(App\Models\Product::findOrFail($product->products_id)->filename)[0])}}" alt="Chania">
            </a>
            <div class="col">
                <div class="pt-3 title-card" style="height: 55px;">
                    <a class="card-title" style="height: 50px;" href="{{route('san-pham.show',App\Models\Product::findOrFail($product->products_id)->slug)}}">
                        <h4 class="ellipsis">
                            {{App\Models\Product::findOrFail($product->products_id)->name}}
                        </h4>
                    </a>
                </div>
                <div class="text-left common-cost">
                    <div class="col">
                        <div class="row">
                            @if (!empty(App\Models\Product::findOrFail($product->products_id)->promotion))               
                            <p class="main-cost">
                                <b>{{number_format(App\Models\Product::findOrFail($product->products_id)->promotion*1000, 0, ',', '.' )}}đ</b>
                            </p>                
                            <p class="pt-1 abondon-text-cost">
                                {{number_format(App\Models\Product::findOrFail($product->products_id)->price*1000, 0, ',', '.' )}}đ
                            </p>
                            @else
                            <p class="main-cost">
                                <b>{{number_format(App\Models\Product::findOrFail($product->products_id)->price*1000, 0, ',', '.' )}}đ</b>
                            </p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="text-left">
                </div>
                <div class="rating-star pb-2">
                    <span class="fa fa-star @if(floatval(App\Models\Product::findOrFail($product->products_id)->star) > 1) checked @endif" id="star"></span>
                    <span class="fa fa-star @if(floatval(App\Models\Product::findOrFail($product->products_id)->star) > 1.5) checked @endif" id="star"></span>
                    <span class="fa fa-star @if(floatval(App\Models\Product::findOrFail($product->products_id)->star) > 2.5) checked @endif" id="star"></span>
                    <span class="fa fa-star @if(floatval(App\Models\Product::findOrFail($product->products_id)->star) > 3.5) checked @endif" id="star"></span>
                    <span class="fa fa-star @if(floatval(App\Models\Product::findOrFail($product->products_id)->star) > 4.5) checked @endif" id="star"></span>
                </div>
                <div class="row pb-3 icon-view-details">
                    <a href="{{route('san-pham.show',App\Models\Product::findOrFail($product->products_id)->slug)}}">
                        <div class="col" style="color: blue;">Xem chi tiết</div>
                    </a>
                    @if (Auth::check())
                    <form action="{{route('cart.store')}}" method="post">
                    @csrf
                    <input type="text" value="{{Auth::user()->id}}" name="user_id" hidden>
                    <input type="text" value="1" name="quantity" hidden>
                    <input type="text" value="{{App\Models\Product::findOrFail($product->products_id)->id}}" name="product_id" hidden>
                    <input type="text" value="{{explode(',',App\Models\Product::findOrFail($product->products_id)->size)[0]}}" name="size" hidden>
                    <input type="text" value="{{explode(',',App\Models\Product::findOrFail($product->products_id)->color)[0]}}" name="color" hidden>
                    <button type="submit" class="btn-btn-cart">
                        <i class="fas fa-cart-plus" style="color: #f09819;"></i>
                    </button>
                    </form>
                    @else
                    <a href="{{route('login')}}"><div class="product-btn" style="color: #f09819;"><i class="fas fa-cart-plus"></i></div></a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>