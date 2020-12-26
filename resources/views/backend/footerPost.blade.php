@extends('layouts.backend.app')
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Danh sách bài viết giới thiệu</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div class="row">
                    <div class="col-6">
                        <a href="{{route('manage-footer-post.create')}}" class="btn btn-primary">
                            <span class="btn-label">
                                <i class="fa fa-plus"></i>
                            </span>
                            Thêm bài viết
                        </a>
                    </div>
                    <div class="col-12">
                        <hr>
                    </div>
                </div>
                <table id="basic-datatables" class="display table table-striped table-hover">
                    <!-- Example single danger button -->
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên bài viết</th>
                            <th>Danh mục</th>
                            <th>Trạng thái</th>
                            <th>Ngày đăng</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>STT</th>
                            <th>Tên bài viết</th>
                            <th>Danh mục</th>
                            <th>Trạng thái</th>
                            <th>Ngày đăng</th>
                            <th>Hành động</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($post as $ps)
                        <tr>
                            <td>
                                {{$i++}}
                            </td>
                            <td width="25%">
                                <a href="{{route('footer-post.show',$ps->slug)}}" target="_blank" rel="noopener noreferrer">{{$ps->title}}</a>
                            </td>
                            <td>
                                @if ($ps->category == 0)
                                    Hỗ trợ
                                @elseif($ps->category == 1)
                                    Liên hệ
                                @elseif($ps->category == 2)
                                    Hotline
                                @elseif($ps->category == 3)
                                    Email
                                @elseif($ps->category == 4)
                                    Câu hỏi thường gặp
                                @elseif($ps->category == 5)
                                    Thông báo
                                @elseif($ps->category == 6)
                                    Chi tiết sản phẩm
                                @elseif($ps->category == 7)
                                    Thông tin trang web
                                @endif
                            </td>
                            <td>
                                @if ($ps->status == 1)
                                Hoạt động
                                @else
                                tạm ẩn
                                @endif
                            </td>
                            <td>
                                {{$ps->created_at}}
                            </td>
                            <td class="mt-2 navbar-nav text-center">
                                <li class="nav-item dropdown hidden-caret">
                                    <a class="dropdown-toggle profile-pic mt-1" data-toggle="dropdown" href="#" aria-expanded="false">
                                        Thao tác
                                    </a>
                                    <ul class="dropdown-menu dropdown-user animated fadeIn" style="width:10%">
                                        <li>
                                            <div>
                                                <a class="dropdown-item btn-primary text-center btn-link" href="{{route('manage-footer-post.show', $ps->id)}}" data-toggle="tooltip" data-placement="bottom"  title="View">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </div>
                                            <div>
                                                <a class="dropdown-item btn-secondary text-center btn-link" href="{{route('manage-footer-post.edit', $ps->id)}}" data-toggle="tooltip" data-placement="bottom" title="Edit">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                            </div>
                                            <div>
                                                <form action="{{ route('manage-footer-post.destroy', $ps->id)}}" method="post">
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
                    title: 'Bạn có chắc muốn xóa bài viết này?',
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