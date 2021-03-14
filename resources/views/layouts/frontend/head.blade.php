<meta name="google-site-verification" content="ZT_vVYVntgZqhbl4KRKDtddmO3w17nWo7niQkUpin9o" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="_token" content="{{csrf_token()}}"/>
<title>
    @if(request()->is('danh-muc/*'))
        {{$category->title}}
    @elseif(request()->is('post/*'))
        {{$post->title}}
    @elseif(request()->is('san-pham/*'))
        {{$product->name}}
    @else
        Trao ba mẹ niềm tin
    @endif
    | mamabi
</title>
<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
<meta charset="utf-8">
<link rel="icon" href="{{asset('images/logo_without_text.png')}}" type="image/x-icon"/>

<!-- Fonts and icons -->

<!-- CSS Files -->
<link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">

<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript" defer></script>
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{asset('assets/css/azzara.min.css')}}">
<link rel="stylesheet" href="{{asset('OwlCarousel2-2.3.4/dist/assets/owl.carousel.min.css')}}">
<link rel="stylesheet" href="{{asset('OwlCarousel2-2.3.4/dist/assets/owl.theme.default.min.css')}}">

<link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">
<style>
    p img {
        width: 100%;
        height: auto;
    }
    .ellipsis {
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp:2; 
        line-height: X;        
        max-height: X*N; 
    }
    .description {
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp:4; 
        line-height: X;        
        max-height: X*N; 
    }
    .ellipsis2 {
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp:1; 
        line-height: X;        
        max-height: X*N; 
    }
</style>
