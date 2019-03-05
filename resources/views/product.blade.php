<div class="product">
    <div class="product--inner">
        <div class="product--img-box">
            <a href="{{url('/asin/'.$product->asin)}}" target="_blank">
                <img src="{{$product->image}}" alt="product alt" class="product--img"
                     onerror="this.onerror=null; this.src='{{asset('/images/default-product.jpg')}}'">
            </a>
        </div>
        <div class="product--details">
            {{--<p class="product--desc">--}}
            {{--{{ $product->description }}--}}
            {{--</p>--}}
            <h3 class="product--title">
                <a href="{{url('/asin/'.$product->asin)}}" target="_blank" style="color:black;">
                    {{ $product->title }}
                </a>
            </h3>
            <p class="price text-center">
                <b class="discount-price">${{ $product->discount_price}}</b>
                <small>
                    <del class="product-price"> ${{$product->price}}</del>
                </small>
            </p>
            <p class="text-center mb-0 d-flex justify-content-center">
                <span class="discount-banner">{{substr($product->promocode->discount, 0, strpos($product->promocode->discount,'.'))}}% OFF</span>
                <a href="{{url('/asin/'.$product->asin)}}" class="btn btn--main product--btn" target="_blank">
                    Get Coupon
                </a>
            </p>
        </div>
    </div>
</div>