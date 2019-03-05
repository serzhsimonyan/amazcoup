@php
    $is_home = request()->route()->getName() == 'home';
    $gifts_under_and_price_range = App\Helpers\DatabaseHelper::giftsUnderPriceAndPriceRange();
    $gifts_under_price = $gifts_under_and_price_range['gifts_under'];
    $price_range = $gifts_under_and_price_range['price_range'];
@endphp

<div id="loader" style="display:none">
    <div class="loader-inner">
        <img src="{{asset('images/loader.gif')}}" class="img-fluid">
    </div>
</div>
<div class="content" id="product-and-pagination" style="display: {{ $is_home ? 'block' : 'none' }}">
    <div class="main-content home-page-filters">
        <div class="container-fluid">
            @if($is_home)
                <div class="filter-list list-inline">
                    <a id="newest" href="javascript:void(0);" class="active" data-filter="newest">Newest</a>
                    <a id="popular" href="javascript:void(0);" data-filter="popular">Popular</a>
                    <a id="price_range" href="javascript:void(0);">Price Range</a>
                    <a class="gifts_under" href="javascript:void(0);">Gifts Under $<span class="price_under">{{$gifts_under_price}}</span></a>
                    <a id="random" href="javascript:void(0);" data-filter="random">Random</a>
                </div>
                <div class="col-lg-10 col-md-8" id="slider">
                    @include('slides.slide')
                </div>
            @endif
            <div id="products_list" class="d-flex flex-wrap"></div>
            <div class="row justify-content-center">
                <div class="btn-group mr-2" role="group" aria-label="First group" id="paginate"></div>
            </div>
        </div>
    </div>
</div>
