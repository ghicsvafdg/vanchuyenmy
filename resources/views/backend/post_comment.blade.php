@extends('layouts.backend.app')
@section('content')

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-6">
                <h4 class="card-title">Nhận xét về bài viết</h4>
            </div>
            
            {{-- <div class="col-6 text-left">
                <a href="{{route('manage-product.create')}}" class="btn btn-primary">
                    <span class="btn-label">
                        <i class="fa fa-plus"></i>
                    </span>
                    Thêm mới sản phẩm
                </a>
            </div> --}}
        </div>
        
    </div>
    <div class="card-body">
        <div class="table-responsive">
            {{-- <div class="btn-group col-6">     
                <button type="button" id="bulk" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" disabled>
                    Lựa chọn
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Xóa</a>
                </div>
                
            </div> --}}
            
            {{-- filter --}}
            {{-- <form action="{{route('filter')}}" method="GET">
                <div class="private-information">
                    <div class="row py-3">
                        <div class="col-2 pr-0">
                            <input type="text" class="form-control" placeholder="Tên" name="title">
                        </div>
                        <div class="col-2 px-0">
                            <div class="form-group py-0">
                                <select name="category" value="{{ old('category') }}" placeholder="danh mục" class="form-control input-square">
                                    <option value="" disabled selected>Danh mục</option>
                                    @foreach ($categories as $item)
                                    <option value="{{$item->id}}">{{$item->title}}</option>
                                    @if(count($item->childs))
                                    @include('backend.selectChildProduct',['childs' => $item->childs])
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-3 pl-4 " id="number-text">
                            <div class="row">
                                <div class="col pr-0 text-right">
                                    <p class="mt-2"> Số lượng</p>
                                </div>
                                <div class="col pr-0">
                                    <input type="text" class="form-control" id="email2" placeholder="Từ" name="quan_from"> 
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" id="email2" placeholder="Đến" name="quan_to"> 
                                </div>
                            </div>
                        </div>
                        <div class="col-3" id="number-text">
                            <div class="row">
                                <div class="col pr-0 text-right">
                                    <p class="mt-2"> Giá(KVNĐ)</p>
                                </div>
                                <div class="col pr-0">
                                    <input type="text" class="form-control" id="email2" placeholder="Từ" name="price_from"> 
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" id="email2" placeholder="Đến" name="price_to"> 
                                </div>
                            </div>
                        </div>
                        <div class="col-2 pl-4">
                            <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                        </div>
                    </div>
                </div>
            </form> --}}
            
            {{-- end filter --}}
            <hr>
            <table id="basic-datatables" class="display table table-striped table-hover" style="width:100%">
                <!-- Example single danger button -->
                <thead>
                    <tr>
                        <th>Tiêu đề bài viết</th>
                        <th>Ảnh</th>
                        <th>Tên người dùng</th>
                        <th>Nhận xét</th>
                        <th>Hành động</th>
                    </tr>
                    <tbody>
                        @foreach ($comment as $cmt)
                        <tr>
                            <td width="25%">  
                                <a href="{{route('post.show',$cmt->posts->slug)}}">{{$cmt->posts->title}}</a>
                                {{-- <a href="">{{$cmt->products->name}}</a> --}}
                            </td>
                            <td>
                                <img src="{{asset('images/'.$cmt->posts->filename)}}" alt="" height="40px" width="40px">
                            </td>
                            <td width="13%">
                                {{$cmt->users->username}}
                            </td>
                            <td>
                                {{$cmt->content}}
                            </td>
                            <td class="mt-2 navbar-nav text-center">
                                <li class="nav-item dropdown hidden-caret">
                                    <a class="dropdown-toggle profile-pic mt-1" data-toggle="dropdown" href="#" aria-expanded="false">
                                        Thao tác
                                    </a>
                                    <ul class="dropdown-menu dropdown-user animated fadeIn" style="width:10%">
                                        <li>
                                            {{-- <div>
                                                <a class="dropdown-item btn-primary text-center btn-link" href="" data-toggle="tooltip" data-placement="bottom"  title="View">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </div>
                                            <div>
                                                <a class="dropdown-item btn-secondary text-center btn-link" href="" data-toggle="tooltip" data-placement="bottom" title="Edit">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                            </div> --}}
                                            <div>
                                                <form action="{{ route('manage-comment.destroy', $cmt->id)}}" method="post">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="dropdown-item btn-danger text-center btn-link" data-toggle="tooltip" data-placement="bottom" title="Delete">
                                                        <i class="fas fa-trash"></i>  
                                                    </button>
                                                </form>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </thead>
                {{-- <tfoot>
                    <tr>
                        <th>Tiêu đề bài viết</th>
                        <th>Ảnh</th>
                        <th>Tên người dùng</th>
                        <th>Nhận xét</th>
                        <th>Hành động</th>
                    </tr>
                </tfoot> --}}
                <tbody>
                    @foreach ($comment as $cmt)
                    <tr>
                        <td width="25%">  
                            <a href="{{route('post.show',$cmt->posts->slug)}}">{{$cmt->posts->title}}</a>
                            {{-- <a href="">{{$cmt->products->name}}</a> --}}
                        </td>
                        <td>
                            <img src="{{asset('images/'.$cmt->posts->filename)}}" alt="" height="40px" width="40px">
                        </td>
                        <td width="13%">
                            {{$cmt->users->username}}
                        </td>
                        <td>
                            {{$cmt->content}}
                        </td>
                        <td class="mt-2 navbar-nav text-center">
                            <li class="nav-item dropdown hidden-caret">
                                <a class="dropdown-toggle profile-pic mt-1" data-toggle="dropdown" href="#" aria-expanded="false">
                                    Thao tác
                                </a>
                                <ul class="dropdown-menu dropdown-user animated fadeIn" style="width:10%">
                                    <li>
                                        {{-- <div>
                                            <a class="dropdown-item btn-primary text-center btn-link" href="" data-toggle="tooltip" data-placement="bottom"  title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </div>
                                        <div>
                                            <a class="dropdown-item btn-secondary text-center btn-link" href="" data-toggle="tooltip" data-placement="bottom" title="Edit">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                        </div> --}}
                                        <div>
                                            <form action="{{ route('manage-comment.destroy', $cmt->id)}}" method="post">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="dropdown-item btn-danger text-center btn-link" data-toggle="tooltip" data-placement="bottom" title="Delete">
                                                    <i class="fas fa-trash"></i>  
                                                </button>
                                            </form>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
@endsection
@section('script')
<script>
    //== Class definition
    var SweetAlert2Demo = function() {
        //== Demos
        var initDemos = function() {
            $('.btn-danger').click(function(e) {
                var $form =  $(this).closest("form");
                e.preventDefault();
                swal({
                    title: 'Bạn có chắc muốn xóa nhận xét này?',
                    text: "Một khi đã xóa sẽ không thể khôi phục!",
                    type: 'warning',
                    buttons:{
                        confirm: {
                            text : 'Có, Xóa đi!',
                            className : 'btn btn-success'
                        },
                        cancel: {
                            visible: true,
                            text: 'Hủy',
                            className: 'btn btn-danger'
                        }
                    }
                }).then((Delete) => {
                    
                    if (Delete) {
                        if (Delete) {
                            $form.submit();
                        }
                        swal({
                            title: user_id,
                            text: 'Your file has been deleted.',
                            type: 'success',
                            buttons : {
                                confirm: {
                                    className : 'btn btn-success'
                                }
                            }
                        });
                    } else {
                        swal.close();
                    }
                });
            });
        };
        return {
            //== Init
            init: function() {
                initDemos();
            },
        };
    }();
    
    //== Class Initialization
    jQuery(document).ready(function() {
        SweetAlert2Demo.init();
    });
</script>
@endsection