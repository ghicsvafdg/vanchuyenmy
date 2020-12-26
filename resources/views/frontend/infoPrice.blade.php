<div class="mt-3 content">
    <div class="col" id="title-pay">
        <p><i class="fas fa-check" style="color: rgb(119, 197, 1);"></i> Quý khách được miễn phí xử lý giao dịch</p>
    </div>
    <div class="px-4 row" id="text-sum-cost">
        <div class="text-left col">
            <p>Tổng giá trị các sản phẩm:</p> 
        </div>
        <div class="text-right col">
            <p>{{number_format($sum*1000, 0, ',', '.')}}đ</p> 
        </div>
    </div>
    <div class="px-4 row" id="text-sum-cost">
        <div class="text-left col">
            <p>Số tiền được giảm từ mã giảm giá:</p>
        </div>
        @if (isset($code) && !isset($error))
            @if ($code->role == 0)
                <div class="text-right col">
                    <p>{{number_format((($sum*$code->amount)/100)*1000,0,',','.')}}đ</p>
                </div>
            @elseif($code->role == 1)
                <div class="text-right col">
                    <p>{{number_format(($code->amount)*1000,0,',','.')}}đ</p>
                </div>
            @endif
        @else
            <div class="text-right col">
                <p>0đ</p>
            </div>
        @endif
    </div>
    <div class="px-4 mb-2 row" id="text-sum-cost">
        <div class="text-left col">
            <p><b>TỔNG TIỀN:</b></p>
        </div>
        @if (isset($code) && !isset($error))
            @if ($code->role == 0)
                <div class="text-right col" style="color: #f09819;">
                    <p><b>{{number_format(($sum-(($sum*$code->amount)/100))*1000)}}đ</b></p>
                </div>
            @elseif($code->role == 1)
                <div class="text-right col" style="color: #f09819;">
                    <p><b>{{number_format(($sum-$code->amount)*1000)}}đ</b></p>
                </div>
            @endif
        @else    
            <div class="text-right col" style="color: #f09819;">
                <p><b>{{number_format($sum*1000, 0, ',', '.')}}đ</b></p>
            </div>
        @endif
    </div>
</div>