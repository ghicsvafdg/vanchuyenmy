@extends('layouts.backend.app')
@section('content')
<div class="col-md-12">
    <div class="card">
        <h1>Vị trí hiển thị banner</h1>
        <div class="row">
            <div class="col-8">
                <h2>Trang chủ</h2>
                <img src="{{asset('images/index_section.png')}}" alt="" height="400" width="500" >
            </div>
            <div class="col-4">
                <h2>Trang chi tiết sản phẩm</h2>
                <img src="{{asset('images/detail_section.png')}}" alt="" height="600" width="300">
            </div>
            <div class="col-8">
                <h2>Trang danh mục sản phẩm</h2>
                <img src="{{asset('images/cate_section.png')}}" alt="" height="400" width="500">
            </div>
            <div class="col-4">
                <h2>Quy tắc</h2>
                <table class="text-center table table-bordered table-striped">
                    <tr>
                        <td>Khu vực</td>
                        <td>Số lượng banner tối đa</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>5</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>4</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>1</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>1</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>2</td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>5</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Danh sách Banner</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div class="row">
                    <div class="col-6">
                        <a href="{{route('manage-banner.create')}}" class="btn btn-primary btn-small">
                            <span class="btn-label">
                                <i class="fa fa-plus"></i>
                            </span>
                            Thêm Banner
                        </a>
                    </div>
                    <div class="col-12">
                        <hr>
                    </div>
                </div>
                <table id="multi-filter-select" class="display table table-striped table-hover">
                    <!-- Example single danger button -->
                    <thead>
                        <tr>
                            <th>Tên banner</th>
                            <th>Nơi hiển thị</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($banner as $bn)
                        <tr>
                            <td>
                                {{$bn->name}}
                            </td>
                            <td>
                                {{$bn->section}}
                            </td>
                            <td>
                                <div class="row">
                                    <div class="col-4">
                                        <a href="{{route('manage-banner.edit', $bn->id)}}" data-toggle="tooltip" data-placement="bottom" title="Edit" class="btn btn-icon btn-secondary btn-xs"><i class="fas fa-pencil-alt"></i></a>
                                    </div>
                                    <form action="{{ route('manage-banner.destroy', $bn->id)}}" method="post" class="test col-4">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-icon btn-danger btn-xs" data-toggle="tooltip" data-placement="bottom" title="Delete">
                                                <i class="fas fa-trash"></i>  
                                        </button>
                                    </form>
                                </div>
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
                    title: 'Bạn có chắc muốn xóa banner này?',
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