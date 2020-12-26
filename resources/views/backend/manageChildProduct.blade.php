<div class="col">
    <ul>
        @foreach($childs as $child)
        <li>
            <div class="row">
                <div class="col-8">
                    [{{$child->order}}] -- [{{$child->status}}] -- {{ $child->title }} -- <i class="{{$child->icon}}"></i>
                </div>
                <div class="col-1">
                    <a href="{{route('manage-product-category.edit', $child->id)}}" class="btn btn-sm btn-secondary btn-link"  data-toggle="tooltip" data-placement="bottom" title="Edit"><i class="fas fa-pencil-alt"></i> </a>
                </div>
                <div class="col-1">
                    <form action="{{ route('manage-product-category.destroy', $category->id)}}" method="post" class="test col-4">
                        @method('DELETE')
                        @csrf
                        
                        <button type="submit"class="btn btn-sm btn-danger btn-link" data-toggle="tooltip" data-placement="bottom" title="Delete">
                            <i class="fas fa-trash"></i>  
                        </button>
                    </form>
                </div>
            </div>   
            @if(count($child->childs))
            @include('backend.manageChildProduct',['childs' => $child->childs])
            @endif
        </li>
        @endforeach
    </ul>
</div>
