@foreach ($childs as $child)
    <option value="{{$child->id}}">@if(isset($supChild)){{$supChild}}@endif -->{{$child->title}}</option>
    @if(count($child->childs) > 0)
        @include('backend.selectChildProduct',['childs' => $child->childs, 'supChild' => '-->'])
    @endif
@endforeach