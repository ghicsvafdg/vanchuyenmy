@extends('layouts.backend.app')
@section('content')
    <div class="card-header">
        <h3>Thông tin người dùng</h3>
    </div>
        <div class="card-body">
            <label>Tên người dùng</label>
            <input type="text" name="username" class="form-control" value="{{$user->username}}" readonly>
            
            <br>
            <label>Email</label>
            <input type="text" name="email" class="form-control" value="{{$user->email}}" readonly>
            <br>
            
            <label>Vai trò</label>
            
            <div class="form-group">
                <label><strong>Vai trò</strong></label>
                <br>
                <input type="radio" name="role" value="{{$user->role}}"> admin &nbsp;
                <input type="radio" name="role" value="{{$user->role}}"> user
            </div>
        </div>
        <div class="card-footer">
        <a href="{{route('manage-user.index')}}" class="btn btn-danger">Hủy</a>  
        </div>
@endsection