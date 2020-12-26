@extends('layouts.frontend.app')
@section('content')
<div class="container">
    <div class="product pt-2 pb-lg-2">
        <!-- breadcum -->
        <div class="row"> 
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="#">
                        <a href="index.html"><i class="flaticon-home"></i></a>
                    </a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Thiết lập địa chỉ</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
            </ul>
        </div>
        <!-- end breadcum -->
        
        {{-- avatar --}}
        @include('layouts.frontend.userInfoAva')
        {{-- end avatar --}}
        <div class="row">
            @include('layouts.frontend.userCategory')
            <div class="col-lg-9 col-12 mt-4">
                <div class="card">
                    <div class="row no-gutters">
                        <div class="pl-4 pt-4 col-lg-6 col-5">
                            <h3 style="border-left: 3px solid #f09819; padding-left:5px;"><b>Địa chỉ của tôi</b></h3>
                        </div>
                        <div class="col-7 col-lg-6 text-right pr-4" id="change_address">
                            <a href="{{url('tao-dia-chi')}}" class="mt-3 btn-gradient23 btn" style="width: 500x; margin-left:60px;"><i class="mr-1 fas fa-plus"></i>Thêm địa chỉ mới </a>
                        </div>
                        <hr width=100%>
                    </div>
                    @foreach ($address as $add)
                    <div class="row">
                        <div class="col-lg-9 col-10 pl-4">
                            <table class="table mt-3">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width: 30%">Họ và tên</th>
                                        <th scope="col text-left">{{$add->name}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Số điện thoại</td>
                                        <td class="text-leftt">{{$add->phone}}</td>
                                    </tr>
                                    <tr>
                                        <td>Địa chỉ</td>
                                        <td class="text-left">
                                            {{$add->note.', '.$add->address}}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-3 col-2">
                            <div class="row edit pr-2">
                                <h4 class="pt-2 mr-lg-4 ml-2">
                                    <a href="{{route('manage-address.edit',$add->id)}}">Sửa</a>
                                </h4>
                                <form action="{{route('address.destroy',$add->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-btn-delete">
                                        <i class="mr-1 fas fa-trash-alt"></i> Xóa
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <hr width=100%>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection