<div class="sidebar">
    <div id="accordion">
        <bold>{{$currentCategory->name}} <span> ({{$currentCategory->products_count}}) </span></bold>
        @foreach ($childCategories as $child)
            <a class="dropdown-item" href="{{url($child->slug.'-'.$child->id)}}">{{$child->name}}<span> ({{$child->products_count}}) </span></a>
        @endforeach
    </div>
</div>