<tr>
    <td>{{$product->title}}</td>
    <td>{{$product->content}}</td>
    <td>${{$product->price}}</td>
    <td>

            <a class="btn btn-outline-light" role="button" href="{{url('/admin/edit/'.$product->slug)}}">
                <i class="far fa-2x fa-edit c-green-500"></i>
            </a>
    </td>
    <td> <form action="{{route('delete_product')}}" method="post" class="float-left">
            @csrf
            <input type="text" style="display:none" name="slug" value="{{$product->slug}}" >
            <button type="submit" class="btn btn-outline-danger fa-1x"><i class="far fa-trash-alt"></i></button>
        </form>
    </td>
</tr>