@foreach ($childs as $child)
@if ($child->status == 1)
<li class="nav-item">
    <a class="nav-link" id="pills-{{$child->id}}-tab" data-toggle="pill" href="#pills-{{$child->id}}" aria-selected="false">{{$child->title}}</a>
</li>
@endif
@endforeach
