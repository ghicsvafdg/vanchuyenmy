@extends('layouts.frontend.app')
@section('content')
<div class="pb-2 pt-2 container">
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
                <li class="nav-item">
                    <a href="#">Blog</a>
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
            <div class="py-4 col-3 d-lg-block d-none">
                
                <div class="list-group" id="text-hidden-category">
                    <a href="#" class="list-group-item list-group-item-action">
                        <b><i class="fas fa-align-left" style="margin-right:10px;"></i>BÀI VIẾT GẦN ĐÂY</b>
                    </a>
                    @foreach ($latestPost as $posts)
                    <a href="{{route('post.show',$posts->slug)}}" class="list-group-item list-group-item-action">
                        <b>{{$posts->title}}</b>
                    </a>
                    @endforeach
                    
                    <a href="#" class="list-group-item list-group-item-action" style="color: #f09819;">
                        <i class="fas fa-caret-right" style="margin: 5px 5px 0px 0px; color: #f09819;"></i>
                        <b>BÀI VIẾT CÙNG DANH MỤC</b>
                    </a>
                    @foreach ($postInCategory as $postCate)
                    <a href="{{route('post.show',$postCate->slug)}}" class="list-group-item list-group-item-action">
                        <i class="fas fa-pen-square" style="margin: 3px 10px 0px 0px; color: #f09819;"></i>{{$postCate->title}}
                    </a>
                    @endforeach
                </div>
                
            </div>
            <!-- eND left category -->
            
            <div class="py-4 col-lg-9 col-12">
                <div class="pb-2 title-post">
                    <h3><b>  {{$post->title}}</b></h3>
                    <h5>Đăng Bởi: {{$post->author}} {{$post->created_at}}</h5>
                </div>
                <div class="text-para">
                    {!!$post->content!!}
                </div>
            </div>
        </div>
        <hr>
        
        <div class="row">
            <div class="py-4 col-3">
            </div>
            <div class=" py-4 col-9">
                <form action="{{route('comment')}}" method="post">
                    @csrf
                    <div class="card-body login">
                        <input type="text" value="{{$post->id}}" name="post_id" hidden>
                        
                        <div class="form-group">
                            <label  class="placeholder"><b>Nhận xét:</b></label>
                            <textarea name="content" required class="form-control" placeholder=""></textarea>
                            <br>
                        </div>
                        <button style="margin-left:9px" type="submit" class="btn btn-primary">
                            Nhận xét
                        </button> 
                    </div>
                </form>
                <br>
                <h4><b> Nhận xét: </b></h4>
                @foreach($comment as $comment)
                <table>
                    <div class="row">
                        <tr>
                            <td>
                                <b>
                                    @if ($comment->users->name)
                                    {{$comment->users->name}}: &nbsp; 
                                    @else
                                    {{$comment->users->username}}: &nbsp; 
                                    @endif
                                </b>
                            </td>
                            <td><i>{{$comment->created_at}}</i></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>{{$comment->content}}</td>
                        </tr>
                    </div> 
                    <hr>
                </table>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection