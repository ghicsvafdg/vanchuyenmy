@extends('layouts.backend.app')
@section('content')
<div class="card-header">
    <h3>Chỉnh sửa thông tin người dùng</h3>
</div>

<form action="{{route('manage-user.update', $user->id)}}" method="POST">
    @method('PATCH')
    @csrf
    <div class="card-body">
        <label>Tên người dùng</label>
        <input type="text" name="username" class="form-control" value="{{$user->username}}" readonly>
        <br>
        <label>Email</label>
        <input type="text" name="username" class="form-control" value="{{$user->email}}" readonly>
        <br>
        <label>Trạng thái</label>
        <br>
        @if ($user->status == 1)
        Hoạt động <input type="radio" name="status" id="" value="1" checked="checked">
        Vô hiệu hóa<input type="radio" name="status" id="" value="0">
        @else
        Hoạt động <input type="radio" name="status" id="" value="1">
        Vô hiệu hóa<input type="radio" name="status" id="" value="0" checked="checked">
        @endif
        <br>
        <label>Vai trò</label>
        <br>
        @if ($user->role == 0)
        admin <input type="radio" name="role" id="" value="0" checked="checked">
        user <input type="radio" name="role" id="" value="1">
        @else
        admin <input type="radio" name="role" id="" value="0">
        user <input type="radio" name="role" id="" value="1"  checked="checked">
        @endif
    </div>
    <div class="card-footer">
        <a href="{{route('manage-user.index')}}" class="btn btn-danger">Hủy</a>
        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
    </div>
</form>
@endsection