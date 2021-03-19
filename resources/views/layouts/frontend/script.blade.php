<script>
    WebFont.load({
        google: {"families":["Open+Sans:300,400,600,700"]},
        custom: {"families":["Flaticon", "Font Awesome 5 Solid",
                "Font Awesome 5 Regular", "Font Awesome 5 Brands"], urls: ['{{asset('assets/css/fonts.css')}}']},
        active: function() {
            sessionStorage.fonts = true;
        }
    });
</script>

{{-- scroll to top --}}
<script>
    var btn = $('#button');
    $(window).scroll(function() {
        if ($(window).scrollTop() > 300) {
            btn.addClass('show');
        } else {
            btn.removeClass('show');
        }
    });
    
    btn.on('click', function(e) {
        e.preventDefault();
        $('html, body').animate({scrollTop:0}, '300');
    });
</script>
{{-- end scroll to top --}}

{{-- select address --}}
<script type="text/javascript">
    $('#country').change(function(){
        var provinceID = $(this).val();    
        if(provinceID){
            $.ajax({
                type:"GET",
                url:"{{url('get-district-list')}}?province_id="+provinceID,
                success:function(res){               
                    if(res){
                        $("#state").empty();
                        $("#state").append('<option value="">Chọn Quận/Huyện</option>');
                        $.each(res,function(key,value){
                            $("#state").append('<option value="'+key+'">'+value+'</option>');
                        });
                        
                    }else{
                        $("#state").empty();
                    }
                }
            });
        }else{
            $("#state").empty();
            $("#city").empty();
        }      
    });
    $('#state').on('change',function(){
        var districtID = $(this).val();    
        if(districtID){
            $.ajax({
                type:"GET",
                url:"{{url('get-ward-list')}}?district_id="+districtID,
                success:function(res){               
                    if(res){
                        $("#city").empty();
                        $("#city").append('<option value="">Chọn Phường/Xã</option>');
                        $.each(res,function(key,value){
                            $("#city").append('<option value="'+key+'">'+value+'</option>');
                        });
                        
                    }else{
                        $("#city").empty();
                    }
                }
            });
        } else {
            $("#city").empty();
        }
    });
</script> 
{{-- end select address --}}
<script src="{{asset('EasyZoom/dist/easyzoom.js')}}"></script>
<script>
    // Instantiate EasyZoom instances
    var $easyzoom = $('.easyzoom').easyZoom();

    // Setup thumbnails example
    var api1 = $easyzoom.filter('.easyzoom--with-thumbnails').data('easyZoom');

    $('.thumbnails').on('click', 'a', function(e) {
        var $this = $(this);

        e.preventDefault();

        // Use EasyZoom's `swap` method
        api1.swap($this.data('standard'), $this.attr('href'));
    });

    // Setup toggles example
    var api2 = $easyzoom.filter('.easyzoom--with-toggle').data('easyZoom');

    $('.toggle').on('click', function() {
        var $this = $(this);

        if ($this.data("active") === true) {
            $this.text("Switch on").data("active", false);
            api2.teardown();
        } else {
            $this.text("Switch off").data("active", true);
            api2._init();
        }
    });
</script>

{{-- add and minus quantities product --}}
<script>
    $(function () {
        $('.add').on('click',function(){
            var $qty=$(this).closest('p').find('.qty');
            var currentVal = parseInt($qty.val());
            if (!isNaN(currentVal)) {
                $qty.val(currentVal + 1);
            }
        });
        $('.minus').on('click',function(){
            var $qty=$(this).closest('p').find('.qty');
            var currentVal = parseInt($qty.val());
            if (!isNaN(currentVal) && currentVal > 1) {
                $qty.val(currentVal - 1);
            }
        });
    });
</script>
{{-- end add and minus quantities product --}}

{{-- show product --}}
<script>
    $('.owl-carousel').owlCarousel({
        margin:10,
        nav:true,
        responsiveClass:true,
        responsive:{
            0:{
                items:2,
                nav:true
            },
            600:{
                items:3,
                nav:false
            },
            1000:{
                items:5,
                nav:true,
                loop:false
            }
        }
    })
</script>
{{-- show product end --}}

<script>
    window.onscroll = function() {myFunction()};
    
    var navbar = document.getElementById("navbar");
    var sticky = navbar.offsetTop;
    
    function myFunction() {
        if (window.pageYOffset >= sticky) {
            navbar.classList.add("sticky")
        } else {
            navbar.classList.remove("sticky");
        }
    }
</script>

<!--COUNTDOWN-->
<script>
    // Set the date we're counting down to
    var countDownDate = new Date("Jan 5, 2021 0:37:25").getTime();
    
    // Update the count down every 1 second
    var x = setInterval(function() {
        
        // Get today's date and time
        var now = new Date().getTime();
        
        // Find the distance between now and the count down date
        var distance = countDownDate - now;
        
        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        
        // Output the result in an element with id="demo"
        document.getElementById("demo").innerHTML = hours + "H "
        + minutes + "M " + seconds + "S ";
        
        // If the count down is over, write some text 
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("demo").innerHTML = "EXPIRED";
        }
    }, 1000);
</script>
<!--END- COUNTDOWN-->

<!--   Core JS Files   -->
<script src="{{asset('assets/js/core/jquery.3.2.1.min.js')}}"></script>
<script src="{{asset('assets/js/core/popper.min.js')}}"></script>
<script src="{{asset('assets/js/core/bootstrap.min.js')}}"></script>

<!-- jQuery UI -->
<script src="{{asset('assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js')}}"></script>
<script src="{{asset('assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js')}}"></script>

<!-- Bootstrap Notify -->
<script src="{{asset('assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js')}}"></script>

<!-- Bootstrap Toggle -->
<script src="{{asset('assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js')}}"></script>

<!-- Sweet Alert -->
<script src="{{asset('assets/js/plugin/sweetalert/sweetalert.min.js')}}"></script>

{{--<script >--}}
{{--    $(document).ready(function() {--}}
{{--        $('#basic-datatables').DataTable({--}}
{{--            "pageLength": 50,--}}
{{--        });--}}
{{--    });--}}
{{--</script>--}}

@if (isset($error))
<script>
    var mess = "{{$error}}";
    $.notify({
        // options
        icon: 'fa fa-bell',
        title: 'Thất bại',
        message: mess,
    },
    {
        // settings
        element: 'body',
        position: null,
        type: "danger",
        allow_dismiss: true,
        newest_on_top: false,
        placement: {
            from: "top",
            align: "center"
        },
        offset: 20,
        spacing: 10,
        z_index: 1031,
        template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
            '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
            '<span data-notify="icon"></span> ' +
            '<span data-notify="title">{1}</span> ' +
            '<span data-notify="message">{2}</span>' +
            '<div class="progress" data-notify="progressbar">' +
                '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
                '</div>' +
                '<a href="{3}" target="{4}" data-notify="url"></a>' +
                '</div>' 
            });      
</script>
@endif
{{-- code status --}}
@if (session('success'))
    <script>
        var mess = '{{session('success')}}';
        $.notify({
            // options
            icon: 'fa fa-bell',
            title: 'Thành công',
            message: mess,
        },
        {
            // settings
            element: 'body',
            position: null,
            type: "success",
            allow_dismiss: true,
            newest_on_top: false,
            placement: {
                from: "top",
                align: "center"
            },
            offset: 20,
            spacing: 10,
            z_index: 1031,
            template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
                '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
                '<span data-notify="icon"></span> ' +
                '<span data-notify="title">{1}</span> ' +
                '<span data-notify="message">{2}</span>' +
                '<div class="progress" data-notify="progressbar">' +
                    '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
                    '</div>' +
                    '<a href="{3}" target="{4}" data-notify="url"></a>' +
                    '</div>' 
                });      
    </script>
@elseif(session('error'))
    <script>
        var mess = '{!!session('error')!!}';
        $.notify({
            // options
            icon: 'fa fa-bell',
            title: 'Thất bại',
            message: mess,
        },
        {
            // settings
            element: 'body',
            position: null,
            type: "danger",
            allow_dismiss: true,
            newest_on_top: false,
            placement: {
                from: "top",
                align: "center"
            },
            offset: 20,
            spacing: 10,
            z_index: 1031,
            template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
                '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
                '<span data-notify="icon"></span> ' +
                '<span data-notify="title">{1}</span> ' +
                '<span data-notify="message">{2}</span>' +
                '<div class="progress" data-notify="progressbar">' +
                    '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
                    '</div>' +
                    '<a href="{3}" target="{4}" data-notify="url"></a>' +
                    '</div>' 
                });      
    </script>
@endif
{{-- code status end --}}
