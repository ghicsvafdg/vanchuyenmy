@extends('layouts.frontend.app')

@section('content')

    <div class="container">
        <div class="product md-5 pb-lg-2">
            <div class="card-around">
                <div class="topbar-bottom pb-4 d-lg-block">
                    <div class="row">
                        <!-- hidden category (hover) -->
                        @include('layouts.frontend.hiddenCate')
                        <!-- end hidden category (hover) -->
                        
                        <!-- Banner & voucher -->
                        @include('layouts.frontend.banner')
                        <!-- End Banner & voucher -->
                    </div> 
                </div>  
            </div>
        </div>   
        <!-- Category horizontal -->
        @include('layouts.frontend.hrCate')
        <!--End Category horizontal -->
        
        
        <!-- SẢN PHẨM HOT -->
        @include('layouts.frontend.hotProduct')
        <!-- END SẢN PHẨM HOT -->
        
        
        <!--hot key-->
        @include('layouts.frontend.hotKey')
        <!--end hot key-->

        <!-- category -->
        @include('layouts.frontend.category')
        <!-- end category -->

        {{-- post --}}
        @include('frontend.post')
        {{-- end post --}}
    </div>
@endsection