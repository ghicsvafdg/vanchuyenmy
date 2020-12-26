<h2>Xác nhận yêu cầu đặt lại mật khẩu</h2>
{{-- Greeting --}}
@if (! empty($greeting))
# {{ $greeting }}
@else
@if ($level === 'error')
# @lang('Whoops!')
@else
@lang('Xin Chào!')
@endif
@endif
<br>
{{-- Intro Lines --}}
Bạn đang nhận được email này vì chúng tôi đã nhận được yêu cầu đặt lại mật khẩu cho tài khoản của bạn.

{{-- Action Button --}}
@isset($actionText)
<?php
    switch ($level) {
        case 'success':
        case 'error':
            $color = $level;
            break;
        default:
            $color = 'primary';
    }
?>
@component('mail::button', ['url' => $actionUrl, 'color' => $color])
{{ "Đặt lại mật khẩu" }}
@endcomponent
@endisset

{{-- Outro Lines --}}
Liên kết đặt lại mật khẩu này sẽ hết hạn sau 60 phút.
<br>
<br>
{{-- Salutation --}}
Nếu bạn không yêu cầu đặt lại mật khẩu, không cần thực hiện thêm hành động nào.
<br><br>
Trân trọng,<br>
Ban quản trị vanchuyenmy

{{-- Subcopy --}}
@isset($actionText)
@slot('subcopy')
@lang(
    "Nếu bạn gặp sự cố khi nhấp vào nút ".'"Đặt lại mật khẩu"'.", hãy sao chép và dán URL bên dưới".
    'vào trình duyệt web của bạn: [:actionURL](:actionURL)',
    [
        'actionText' => $actionText,
        'actionURL' => $actionUrl,
    ]
)
@endslot
@endisset

