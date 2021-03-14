<div class="col">
    <div class="row">
        <div class="col-md-11 px-0">
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    @if(!$banner->isEmpty())
                        @foreach ($banner as $bn)
                            @if ($bn->section == 1)
                                <?php $array[] = $bn; ?>
                            @endif
                        @endforeach
                        <div class="carousel-item active">
                            <a href="{{$array[0]->web_link}}">
                                <img src="{{asset('banner/'.$array[0]->filename)}}" class="img-fluid lazyload" alt="banner khu vực 1">
                            </a>
                        </div>
                        @for ($i = 1; $i < count($array); $i++)
                            <div class="carousel-item">
                                <a href="{{$array[$i]->web_link}}">
                                    <img src="{i{asset('banner/'.$array[$i]->filename)}}" class="img-fluid lazyload" alt="banner khu vực 1">
                                </a>
                            </div>
                        @endfor
                    @endif
                </div>
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
</div>
<div class="banner-voucher pl-1 pt-3">
    @if(!$banner->isEmpty())
        @foreach ($banner as $bn)
            @if ($bn->section == 2)
                <a href="{{$bn->web_link}}">
                    <img src="{{asset('banner/'.$bn->filename)}}" class="img-fluid lazyload" alt="banner khu vực 2">
                </a>
            @endif
        @endforeach
    @endif
</div>