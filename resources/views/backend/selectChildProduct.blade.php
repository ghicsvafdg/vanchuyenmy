@foreach ($childs as $child)
    <option value="{{$child->id}}">-->{{$child->title}}</option>
{{--    @if(count($child->childs) > 0)--}}
{{--        @include('backend.selectChildProduct',['childs' => $child->childs])--}}
{{--    @endif--}}
@endforeach