@extends('layouts.backend.app')
@section('content')
<div class="card">
    <div class="card-header">
        <h3>Thêm mới mã giảm giá</h3>
    </div>
    <form action="{{route('manage-code.store')}}" method="post">
        @csrf
        <div class="card-body row">
            <div class="col-6">
                <div class="form-group">
                    <label><strong>Mã giảm giá</strong></label>
                    <input type="text" name="code" class="form-control @error('code') is-invalid @enderror" value="{{ old('code') }}" required>
                    @error('code')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label><strong>Chức năng</strong></label>
                    <br>
                    Giảm theo % <input type="radio" name="role" id="" value="0" checked="checked"> &nbsp; &nbsp;
                    Giảm theo tiền mặt (nghìn đồng) <input type="radio" name="role" id="" value="1">
                </div>
                
                <div class="form-group">
                    <label><strong>Đơn vị giảm</strong></label>
                    <input type="text" name="amount" class="form-control @error('amount') is-invalid @enderror" value="{{ old('amount') }}" required>
                    @error('amount')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label><strong>Áp dụng cho đơn hàng từ: (.000 VNĐ)</strong></label>
                    <input type="text" name="limited" class="form-control @error('limited') is-invalid @enderror" value="{{ old('limited') }}" required>
                    @error('limited')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label><strong>Số lượt dùng</strong></label>
                    <input type="text" name="use_time" class="form-control @error('use_time') is-invalid @enderror" value="{{ old('use_time') }}" required>
                    @error('use_time')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label><strong>Ngày hết hạn(*)</strong></label>
                    <input id="datepicker" readonly name="date">
                </div>
                <script>
                    $('#datepicker').datepicker({
                        format: 'dd/mm/yyyy',
                    });
                </script>
            </div>
        </div>
        <div class="card-footer">
            <div class="form-group">
                <a href="{{route('manage-code.index')}}" class="btn btn-danger">Hủy</a>
                <button type="submit" class="btn btn-primary">Thêm mã giảm giá</button>
            </div>
            
        </div>
    </form>
</div>
@endsection