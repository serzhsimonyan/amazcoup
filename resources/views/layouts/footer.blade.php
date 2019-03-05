@php
    $footer_categories = App\Helpers\DatabaseHelper::footerContent();
    $gifts_under_price = App\Helpers\DatabaseHelper::giftsUnderPriceAndPriceRange()['gifts_under'];
@endphp

<footer class="footer">
    <div class="container">
        <ul class="footer--list">
            <li class="footer--list-heading">By Recipient</li>
            @foreach($footer_categories as $key => $category )
                @if($key<5)<li><a href="{{url('/'.$category['slug'].'/'.$category['id'])}}">{{$category['name']}}</a></li>@endif
            @endforeach
        </ul>
        <ul class="footer--list">
          <li class="footer--list-heading">More Gift Ideas</li>
           @foreach($footer_categories as $key => $category )
               @if($key>=5)<li><a href="{{url('/'.$category['slug'].'/'.$category['id'])}}">{{$category['name']}}</a></li>@endif
           @endforeach
            <li><a class="gifts_under" href="javascript:void(0)">Gifts under $<span class="price_under">{{$gifts_under_price}}</span></a></li>
        </ul>
        <ul class="footer--list">
            <li class="footer--list-heading">Helpful Links</li>
            <li><a href="{{ url('/contact') }}">Contact us</a></li>
            <li><a href="{{url('/about')}}">About us</a></li>
            <li><a href="{{url('/privacy')}}">Privacy policy</a></li>
        </ul>
        <ul class="footer--list">
            <li class="footer--list-heading">Follow Us</li>
            <li><a href="#">Facebook</a></li>
        </ul>
    </div>
</footer>