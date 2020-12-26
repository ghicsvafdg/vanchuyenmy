@extends('layouts.backend.app')
@section('content')
<div class="card">
    <div class="card-header">
        <h3>Nhập nội dung mail</h3>
    </div>
    <form action="{{route('manage-promotion.store')}}" method="post">
        @csrf
        <div class="card-body login">
            <div class="login-form">
                @foreach ($getUserEmail as $user)
                    <input type="text" name="email[]" value="{{$user}}" hidden>
                @endforeach
                <div class="form-group">
                    <label for="title" class="placeholder"><b>Tiêu đề</b></label>
                    <input id="title" type="text" class="form-control" name="title" required>
                </div>
                <label>Nội dung: </label>
                <textarea name="content" class="form-control" id="editor2" required></textarea>
            </div>
        </div>
        <div class="card-footer">
            <div class="form-group">
                <a href="{{route('manage-promotion.index')}}" class="btn btn-danger">Hủy</a>
                <button type="submit" class="btn btn-primary">Gửi email</button>
            </div>
        </div>
    </form>
</div>
@endsection