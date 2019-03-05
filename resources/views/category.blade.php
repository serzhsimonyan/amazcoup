@extends('layouts.app')

@section('body')
    @php $price_range = App\Helpers\DatabaseHelper::giftsUnderPriceAndPriceRange()['price_range'];@endphp

    <div class="main-content" id="category_page">
        <div class="container-fluid d-flex">
            @if(isset($currentCategory))
            @include('layouts.sidebar')
            <div class="product--list" id="{{$currentCategory->id}}">
                <div>
                    <h1 class="title--main mb-1">{{$currentCategory->name}}</h1>
                    @if(!is_null($currentCategory->description))
                       <p class="main-txt">
                         {{$currentCategory->description}}
                       </p>
                    @endif
                </div>
                <hr class="w-100"/>
                <div class="d-md-flex w-100 my-4">
                    <div class="col-lg-10 col-md-8" id="slider">
                         @include('slides.slide')
                    </div>
                    <div class="col-lg-2 col-md-4">
                        <div>
                            <select class="form-control" id="filter-dropdown">
                                <option value="">All</option>
                                <option value="newest">Newest</option>
                                <option value="popular">Popular</option>
                            </select>
                        </div>
                    </div>
                </div>
               @include('layouts.product_and_pagination')
            </div>
            @else
                <div class="row" >
                    <div class="col-md-9 offset-md-3">
                        <h1> Sorry no products to show</h1>
                    </div>
                </div>
            @endif
        </div>
    </div>

@endsection
