
@extends('layouts.backend.app')
@section('content')
<div class="row">
    <div class="card col-7">
        <div class="card-header">
            Danh sách danh mục bài viết
        </div>
        <div class="card-body">
            <ul>
                @foreach($categories as $category)
                <li>
                    <div class="row">
                        <div class="col-8">
                          [{{$category->order}}] -- {{ $category->title }} 
                        </div>
                        <div class="col-1">
                            <a href="{{route('manage-post-category.edit', $category->id)}}" class="btn btn-sm btn-secondary btn-link" data-toggle="tooltip" data-placement="bottom" title="Edit"> 
                                <i class="fas fa-pencil-alt"></i> 
                            </a>
                        </div>
                        <div class="col-1">
                            <form action="{{ route('manage-post-category.destroy', $category->id)}}" method="post" class="test col-4">
                                @method('DELETE')
                                @csrf
                                
                                <button type="submit"class="btn btn-link btn-sm btn-danger" data-toggle="tooltip" data-placement="bottom" title="Delete">
                                    <i class="fas fa-trash"></i>  
                                </button>
                            </form>
                        </div>
                    </div>
                    
                    @if(count($category->childs))
                    @include('backend.manageChildPost',['childs' => $category->childs])
                    @endif
                </li>
                @endforeach
                
            </ul>
        </div>
    </div>
    <div class="col-1">
    </div>
    <div class="card col">
        <div class="card-header">
            Thêm mới danh mục bài viết
        </div>
        <div class="card-body">
            <form action="{{route('manage-post-category.store')}}" method="POST">
                @csrf
                <form action="{{route('manage-post-category.store')}}" method="POST">
                    @csrf
                    @if ($message = Session::get('success'))
                    @endif
                    <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                        <label for="title">Tiêu đề: </label>
                        <input type="text" class="form-control" placeholder="Nhập tiêu đề" name="title" required>
                        <span class="text-danger">{{ $errors->first('title') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="order">Số thứ tự:</label>
                        <input type="text" class="form-control" name="order" placeholder="Nhập số thứ tự">
                    </div>
                    <div class="form-group {{ $errors->has('parent_id') ? 'has-error' : '' }}">
                        <label>Thuộc về danh mục: </label>
                        <select class="form-control" name="parent_id">
                            <option selected value="0"></option>
                            @foreach ($categories as $item)
                            <option value="{{$item->id}}">{{$item->title}}</option>
                            @if(count($item->childs))
                            @include('backend.selectChildProduct',['childs' => $item->childs])
                            @endif
                            @endforeach
                        </select>
                        <span class="text-danger">{{ $errors->first('parent_id') }}</span>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success">Thêm mới</button>
                    </div>
                </form>
            </form>
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
                    title: 'Bạn có chắc muốn xóa danh mục này?',
                    text: "Danh mục đã xóa sẽ xóa toàn bộ danh mục con và bài viết thuộc danh mục này!",
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