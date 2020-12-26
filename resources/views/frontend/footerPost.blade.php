@extends('layouts.frontend.app')
@section('content')
<div class="pb-2 pt-2 container">
    <div class="page-header">
        <!-- breadcum -->
        <div class="row"> 
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="{{route('index')}}">
                        <i class="flaticon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    @if ($post->category == 0)
                        Hỗ trợ
                    @else
                        Liên hệ
                    @endif
                    <a href="#"></a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="#">{{$post->title}}</a>
                </li>
            </ul>
        </div>
        <!-- end breadcum -->
        
        <div class="row">
            <!-- left category -->
            <div class=" py-4 col-3 d-lg-block d-none">
                <div class="list-group" id="text-hidden-category">
                    <a href="#" class="list-group-item list-group-item-action" style="color: #f09819;"><i class="fas fa-caret-right" style="margin: 5px 5px 0px 0px; color: #f09819;"></i><b>BÀI VIẾT CÙNG DANH MỤC</b></a>
                    @foreach ($footerPost as $posts)
                    @if ($posts->category == $post->category)
                        <a href="{{route('footer-post.show',$posts->slug)}}" class="list-group-item list-group-item-action"><i class="fas fa-pen-square"  style="margin: 3px 10px 0px 0px; color: #f09819;"></i>{{$posts->title}}</a>
                    @endif
                    @endforeach
                </div>
            </div>
            <!-- eND left category -->
            
            <div class="py-4 col-9" style="">
                <div class="pb-2 title-post">
                    <h3><b>{{$post->title}}</b></h3>
                    <h5>{{$post->created_at}}</h5>
                </div>
                <div class="text-para">
                    {!!$post->content!!}
                </div>
            </div>
        </div>
        <hr>
    </div>
</div>
@endsection