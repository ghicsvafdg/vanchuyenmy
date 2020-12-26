@extends('layouts.backend.app')
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Danh sách thẻ tag</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div class="row">
                    <div class="col-6">
                        <a href="{{route('manage-tag.create')}}" class="btn btn-primary">
                            <span class="btn-label">
                                <i class="fa fa-plus"></i>
                            </span>
                            Thêm mới thẻ tag
                        </a>
                    </div>
                    <div class="col-12">
                        <hr>
                    </div>
                </div>
                <table id="multi-filter-select" class="display table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Tên thẻ tag</th>
                            <th>Hành động</th> 
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>id</th>
                            <th>Tên thẻ tag</th>
                            <th>Hành động</th> 
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($tag as $t)
                        <tr>
                            <td>
                                {{$t->id}}
                            </td>
                            <td>
                                {{$t->name}}
                            </td>
                            <td>
                                <form action="{{ route('manage-tag.destroy', $t->id)}}" method="post" class="test col-4">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit"class="btn btn-icon btn-danger" data-toggle="tooltip" data-placement="bottom" title="Delete">
                                            <i class="fas fa-trash"></i>  
                                    </button>
                                </form>
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
                    title: 'Bạn có chắc muốn xóa thẻ tag?',
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