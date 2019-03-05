@extends('layouts.main')

@section('content')

    @if(isset($product) and !empty($product))
    <div class="main-content" id="single">
        <div class="container">
            <div class="single">
                <div class="row">

                    <div class="col-md-12">
                        <p class="breadcrumb">
                            @isset($categories)
                                @foreach( $categories as $category)
                                    <a href="{{url($category->slug.'-'.$category->id)}}">{{$category->name}}</a>
                                    @if($category!=$categories[count($categories)-1]) <span>/</span>@endif
                                @endforeach
                            @endisset
                        </p>
                    </div>

                    <div class="col-md-3">

                        <img src="{{ $product->image }}" alt="product alt" class="product--img" onerror="this.onerror=null; this.src='images/default-product.jpg';">
                    </div>
                    <div class="col-md-9">
                        <h1 class="single--title" id="title">
                           {{$product->title}}
                        </h1>
                        <p class="price">
                            <b class="new-price" >${{$product->discount_price}}</b>
                            <del class="new-price"><small>${{$product->price}}</small></del>
                            <span class="discount-banner ml-2"> %{{$product->promocode->discount}}</span>
                        </p>


                        <p class="price">
                            <span class="new-price" ><strong>start date: </strong>{{$product->promocode->start_date}} </span>
                        </p>
                        <p class="price">
                            <span class="new-price"><strong>end date:  </strong><span class="text-danger">{{$product->promocode->end_date}}</span></span>
                        </p>
                        <p>
                        @if($product->rating)
                            <div class="rating star-icon justify-content-start">
                                <div class="rating  value-{{floor($product->rating)}}  label-top">
                                    <div class="label-value">{{$product->rating}}</div>
                                    <div class="star-container">
                                        @for($i=0;$i<=4;$i++)
                                            <div class="star">
                                                <i class="star-empty"></i>
                                                <i class="star-half"></i>
                                                <i class="star-filled"></i>
                                            </div>

                                        @endfor

                                    </div>
                                </div>
                            </div>
                        @endif
                        </p>
                        <div class="row">
                            <div class="input-group mb-3 col-md-6 promo-code-form">
                                <input type="text" readonly id="promo_code" class="form-control" value="{{$product->promocode->promocode}}" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-warning " style="background-color: #ffaa30;color:white" id="promo_code_button" type="button">Copy promo code</button>
                                </div>
                            </div>
                            <p class="col-md-6">
                                <a href="{{$product->url}}" class="btn btn--main single--btn">GO TO AMAZON</a>
                            </p>
                        </div>
                        @if(!empty($product->description))
                            <div>
                                <h4 class="single--desc">Description</h4>
                                <p class="single--desc" id="description">
                                   {{$product->description}}
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid product--like-list">
            <div class="product--list">
             @if(!empty($products))
                @foreach($products as $prod)
                        <div class="product">
                            <div class="product--inner">
                                <div class="product--img-box">
                                    <a href="{{url('/asin/'.$prod->asin)}}" target="_blank">
                                        <img src="{{$prod->image}}" alt="product alt" class="product--img"
                                             onerror="this.onerror=null; this.src='{{asset('/images/default-product.jpg')}}'">
                                    </a>
                                </div>
                                <div class="product--details">
                                    {{--<p class="product--desc">--}}
                                    {{--{{ $product->description }}--}}
                                    {{--</p>--}}
                                    <h3 class="product--title">
                                        <a href="{{url('/asin/'.$prod->asin)}}" target="_blank" style="color:black;">
                                            {{ $prod->title }}
                                        </a>
                                    </h3>
                                    <p class="price text-center">
                                        <b class="discount-price">${{ $prod->discount_price}}</b>
                                        <small>
                                            <del class="product-price"> ${{$prod->price}}</del>
                                        </small>
                                    </p>
                                    <p class="text-center mb-0 d-flex justify-content-center">
                                        <span class="discount-banner">{{substr($prod->promocode->discount, 0, strpos($prod->promocode->discount,'.'))}}% OFF</span>
                                        <a href="{{url('/asin/'.$prod->asin)}}" class="btn btn--main product--btn" target="_blank">
                                            Get Coupon
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                @endforeach
           @endif
             </div>
            </div>
    </div>
    @else
        <div class="row" >
            <div class="col-md-12 offset-md-2">
               <h1> Sorry this product is not defined</h1>
            </div>
        </div>

    @endif
@endsection