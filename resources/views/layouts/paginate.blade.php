
@php
     $lastPage = $products->lastPage();
     $currentPage = $products->currentPage();
@endphp
<ul class="pagination" role="navigation">

    @if($lastPage!=1)<li class="page-item {{($currentPage==1)?' disabled':''}}" ><a class="page-link" name="{{($currentPage-1)}}">‹</a></li>@endif
    @if($lastPage<=6 and $lastPage!=1)
    @for($i=1;$i<=$lastPage;$i++)
        <li class="page-item {{($currentPage==$i)?'active':''}}">@if($currentPage==$i)<span class="page-link">{{$i}}</span>@else<a class="page-link" >{{$i}}</a>@endif</li>
    @endfor
    @elseif($lastPage==7)
        <li class="page-item {{($currentPage==1)?'active':''}}">@if($currentPage==1)<span class="page-link">1</span>@else<a class="page-link" >1</a>@endif</li>
        <li class="page-item {{($currentPage==2)?'active':''}}">@if($currentPage==2)<span class="page-link">2</span>@else<a class="page-link" >2</a>@endif</li>
        @if($currentPage==3 || $currentPage==2)
            <li class="page-item {{($currentPage==3)?'active':''}}">@if($currentPage==3)<span class="page-link">3</span>@else<a class="page-link" >3</a>@endif</li>
            <li class="page-item"><a class="page-link" >4</a></li>
            <li class="page-item"><a class="page-link" >...</a></li>
        @elseif($currentPage==4)
            <li class="page-item"><a class="page-link" >3</a></li>
            <li class="page-item active" ><span class="page-link">4</span></li>
            <li class="page-item" ><a class="page-link" >5</a></li>
            @elseif($currentPage==5)
            <li class="page-item"><a class="page-link" >...</a></li>
            <li class="page-item " ><a class="page-link" >4</a></li>
            <li class="page-item active " ><span class="page-link">5</span></li>
            @else
                <li class="page-item"><a class="page-link" >...</a></li>
        @endif
        <li class="page-item {{($currentPage==6)?'active':''}}">@if($currentPage==1)<span class="page-link">6</span>@else<a class="page-link" >6</a>@endif</li>
        <li class="page-item {{($currentPage==7)?'active ':''}}">@if($currentPage==1)<span class="page-link">7</span>@else<a class="page-link" >7</a>@endif</li>
    @elseif($lastPage>7)
        @if($currentPage<=2 or $currentPage>=($lastPage-1))
             <li class="page-item {{($currentPage==1)?'active':''}}">@if($currentPage==1)<span class="page-link">1</span>@else<a class="page-link" >1</a>@endif</li>
             <li class="page-item {{($currentPage==2)?'active':''}}">@if($currentPage==2)<span class="page-link">2</span>@else<a class="page-link" >2</a>@endif</li>
            <li class="page-item {{($currentPage==3)?'active ':''}}">@if($currentPage==3)<span class="page-link">3</span>@else<a class="page-link" >3</a>@endif</li>
             <li class="page-item" ><a class="page-link" >...</a></li>
            <li class="page-item {{($currentPage==($lastPage-2))?'active ':''}}">@if($currentPage==3)<span class="page-link">{{$lastPage-2}}</span>@else<a class="page-link" >{{$lastPage-2}}</a>@endif</li>
             <li class="page-item {{($currentPage==($lastPage-1))?'active ':''}}">@if($currentPage==3)<span class="page-link">{{$lastPage-1}}</span>@else<a class="page-link" >{{$lastPage-1}}</a>@endif</li>
             <li class="page-item {{($currentPage==$lastPage)?'active':''}}">@if($currentPage==3)<span class="page-link">{{$lastPage}}</span>@else<a class="page-link" >{{$lastPage}}</a>@endif</a></li>

        @elseif($currentPage==3)
             <li class="page-item"><a class="page-link" >1</a></li>
             <li class="page-item"><a class="page-link" >2</a></li>
             <li class="page-item active"><span class="page-link">3</span></li>
            <li class="page-item"><a class="page-link" >4</a></li>
             <li class="page-item"><a class="page-link" >...</a></li>
             <li class="page-item"><a class="page-link" >{{$lastPage}}</a></li>
        @elseif($currentPage==($lastPage-2))
            <li class="page-item"><a class="page-link" >1</a></li>
            <li class="page-item"><a class="page-link" >2</a></li>
            <li class="page-item"><a class="page-link" >...</a></li>
            <li class="page-item"><a class="page-link" >{{$lastPage-3}}</a></li>
            <li class="page-item active "><span class="page-link">{{$lastPage-2}}</span></li>
            <li class="page-item"><a class="page-link" >{{$lastPage-1}}</a></li>
            <li class="page-item"><a class="page-link" >{{$lastPage}}</a></li>

    @elseif($currentPage>2 or $currentPage<($lastPage-2))
        <li class="page-item"><a class="page-link" >1</a></li>
        <li class="page-item"><a class="page-link" >2</a></li>
       @if($currentPage!=4) <li class="page-item"><a class="page-link" >...</a></li> @endif
        <li class="page-item"><a class="page-link" >{{$currentPage-1}}</a></li>
        <li class="page-item active "><span class="page-link">{{$currentPage}}</span></li>
        <li class="page-item"><a class="page-link" >{{$currentPage+1}}</a></li>
        @if($currentPage!=($lastPage-3))<li class="page-item"><a class="page-link" >...</a></li>@endif
        <li class="page-item"><a class="page-link" >{{$lastPage-1}}</a></li>
        <li class="page-item"><a class="page-link" >{{$lastPage}}</a></li>

    @endif
@endif
    @if($lastPage!=1)<li class="page-item {{($currentPage==$lastPage)?' disabled':''}}"><a class="page-link"  name="{{($currentPage+1)}}" >›</a></li>@endif
</ul>
