<!--Menu For mobile-->
<div class="col-sm-12 pl-5">
    <div id="mySide-bar" class="side-bar">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
        <div class="col-12" style="padding-bottom: 20px;">
            <div class="row">  
                <div class="accordion" id="accordionExample">
                    @foreach ($categories as $parentCate)
                    <div class="card">
                        <button class="btn-mobile-collapse" type="button" data-toggle="collapse" data-target="#collapse{{$parentCate->id}}" aria-expanded="true" aria-controls="collapseOne">
                            {{$parentCate->title}}
                        </button>
                        <div id="collapse{{$parentCate->id}}" class="collapse fixformText" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <a style="color: #007bff;" href="{{route('danh-muc.show',$parentCate->slug)}}"><b>{{$parentCate->title}}</b></a>
                            @foreach (App\Models\ProductCategory::where([['parent_id',$parentCate->id],['status',1]])->get() as $childCate)
                            <a href="{{route('danh-muc.show',$childCate->slug)}}">{{$childCate->title}}</a>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    
</div>
<!-- open-hidden-btn -->
<script>
    function openNav() {
        document.getElementById("mySide-bar").style.width = "300px";
        
    }
    
    function closeNav() {
        document.getElementById("mySide-bar").style.width = "0";
        
    }
</script>
<!-- end-hidden-btn -->
<!--End Menu mobile-->