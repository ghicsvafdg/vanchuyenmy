<div class="col">
    <div class="row">
        <div class="col-md-8 px-0">
            
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($banner as $bn)
                        @if ($bn->section == 1)
                        <div class="carousel-item active">
                            <img src="{{asset('banner/'.json_decode($bn->filename)[0])}}" class="img-fluid" alt="...">
                        </div>
                        @for ($i = 1; $i < count(json_decode($bn->filename,true)); $i++)
                        <div class="carousel-item">
                            <img src="{{asset('banner/'.json_decode($bn->filename)[$i])}}" class="img-fluid" alt="...">
                        </div>
                        @endfor
                        @endif
                    @endforeach
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
        <div class="pl-lg-0 col-12 col-md-4 col-lg-4">
            <div class="row">
                @foreach ($banner as $bn)
                    @if ($bn->section == 2)
                        @for ($i = 0; $i < count(json_decode($bn->filename),true); $i++)
                        <div class="px-0 col-6">
                            <img src="{{asset('banner/'.json_decode($bn->filename)[$i])}}" class="img-fluid" alt="..." >
                        </div>
                        @endfor
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    <div class="pl-0 d-none d-lg-block row">
        @foreach ($banner as $bn)
        @if ($bn->section == 3)
            <img src="{{asset('banner/'.json_decode($bn->filename)[0])}}" class="img-fluid" alt="...">
        @endif
        @endforeach
    </div>
</div>