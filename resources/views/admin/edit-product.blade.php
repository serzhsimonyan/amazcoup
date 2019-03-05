@extends('admin_layouts.app')

@section('body')

        <div class="container c-white" id="edit-product">

            <div class="offset-1 col-md-9 border border-primary rounded bg-primary">

            <h4 class="mT-10 mB-30">Edit product</h4>
                @include('admin_layouts.slug_error')
                @include('admin_layouts.complete')
                <div class="row">
                    @if (session('empty_values'))
                        @foreach (session('empty_values') as $key)
                            <div class="alert alert-danger col-md-3" role="alert">
                                {{$key}} is empty
                            </div>
                        @endforeach
                    @endif
                </div>
            <div class="single">
                <div class="row">
                    <div class="col-md-6" >
                        <img src="{{ $product->image }}" alt="product alt" style="width:100%;height:100% " onerror="this.onerror=null; this.src='{{asset('/images/default-product.jpg')}}';">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-9">
                        <form method="POST" action="{{route('edit_product')}}" enctype="multipart/form-data">
                             @csrf

                            <input type="hidden" name="id" class="form-control" value="{{$product->id}}"   >

                            <div class="input-group">
                                <span class="input-group-text" >Image</span>
                                <input type="file" class="form-control-file" name="image">

                                @if ($errors->has('image'))
                                    <div class="alert alert-danger" role="alert" >
                                        {{ $errors->first('image') }}
                                    </div>
                                @endif
                            </div>

                            <div class="input-group mt-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" >Title</span>
                                </div>
                                <input type="text" name="title" class="form-control" value="{{(old('title'))?old('title'):$product->title}}" >
                            </div>
                            @if ($errors->has('title'))
                                <div class="alert alert-danger" role="alert" >
                                    {{ $errors->first('title') }}
                                </div>
                            @endif


                            {{--<div class="d-flex flex-wrap row">--}}
                                {{--<div class="input-group mt-3 col-md-12">--}}
                                    {{--<span class="input-group-text" >Popular</span>--}}
                                {{--</div>--}}
                                {{--<div class="col-md-12 mt-2">--}}
                                    {{--<input type="radio" name="popular" {{($product->popular)?'checked':''}} value="1"><label class="text-dark ml-1">yes</label>--}}
                                {{--</div>--}}
                                {{--<div class="col-md-12">--}}
                                    {{--<input type="radio" name="popular" {{(!$product->popular)?'checked':''}} value="0"><label class="text-dark ml-1">no</label>--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            {{--@if ($errors->has('popular'))--}}
                                {{--<div class="alert alert-danger" role="alert" >--}}
                                    {{--{{ $errors->first('popular') }}--}}
                                {{--</div>--}}
                            {{--@endif--}}

                            <div class="input-group mt-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Description</span>
                                </div>
                                <textarea class="form-control" rows="4" name="description">{{(old('description'))?old('description'):$product->description}}</textarea>
                            </div>
                            @if ($errors->has('description'))
                                <div class="alert alert-danger" role="alert" >
                                    {{ $errors->first('description') }}
                                </div>
                            @endif

                            <div class="input-group mt-3" style="width:200px">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">discount price $</span>
                                </div>
                                <input type="text" class="form-control" name="discount_price" value="{{(old('discount_price'))?old('discount_price'):$product->discount_price}}">
                                @if ($errors->has('discount_price'))
                                    <div class="alert alert-danger" role="alert" >
                                        {{ $errors->first('discount_price') }}
                                    </div>
                                @endif
                            </div>

                            <div class="input-group mt-3" style="width:200px">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">price $</span>
                                </div>
                                <input type="text" class="form-control" name="price" value="{{(old('price'))?old('price'):$product->price}}">
                                @if ($errors->has('price'))
                                    <div class="alert alert-danger" role="alert" >
                                        {{ $errors->first('price') }}
                                    </div>
                                @endif
                            </div>
                         @if(isset($product->categories) and !$product->categories->isEmpty())
                             <div class="row mt-5">
                                 <div class="col-md-6">
                                     <h4>Product categories</h4>
                                 </div>
                                 <div class="col-md-7 ">
                                     <table class="table table-bordered  " style="background-color: #0EAAF7">
                                         <thead>
                                         <tr>
                                             <th scope="col">Name</th>
                                             <th scope="col" >Delete</th>
                                         </tr>
                                         </thead>
                                         <tbody>
                                         @foreach($product->categories as $category)
                                             <tr>
                                                 <th>{{$category->name}}</th>
                                                 <td align="center" >
                                                     <input type="checkbox" name="delete_categories[]" value="{{$category->id}}" >
                                                 </td>
                                             </tr>
                                         @endforeach
                                         </tbody>
                                     </table>
                                 </div>
                             </div>
                            @endif

                            <div class="contanier mt-3">
                                <div class="row ">
                                    <div class="col-md-6">
                                        <h4>Add categories</h4>
                                    </div>
                                </div>
                                <select class="js-example-basic-multiple"  multiple="multiple" name="add_categories[]">
                                     @foreach($categories as $category)
                                         <option value="{{$category->id}}" {{(old('parent_category')==$category->name)?'selected':''}}>{{$category->name}}</option>
                                     @endforeach
                                 </select>
                            </div>

                                <button type="submit" class="btn btn-success mt-3 mb-3">
                                    {{ __('Save') }}
                                </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection