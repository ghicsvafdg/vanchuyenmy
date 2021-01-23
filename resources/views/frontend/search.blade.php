@extends('layouts.frontend.app')

@section('content')

<div class="container">
    <div class="product md-5 pb-lg-2">
        <div class="card-around">
            <div class="topbar-bottom pb-4 d-lg-block">
                <div class="row">
                    
                </div> 
            </div>  
        </div>
    </div>   

    <h1 style="text-align:center"><strong> KẾT QUẢ TÌM KIẾM CHO TỪ KHÓA "{{$search}}"</strong></h1>
    
    <!-- category -->
    @include('layouts.frontend.category')
    <!-- end category -->

    @include('layouts.frontend.product')

    {{-- post --}}
    @include('frontend.post')
    {{-- end post --}}
</div>
@endsection