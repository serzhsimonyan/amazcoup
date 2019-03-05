@extends('admin_layouts.app')

@section('body')
<div class="container ">
    <div class="single">
        <div class="row ">
            <div class=" offset-2 col-md-7 border border-primary rounded bg-primary">
                <h1 class="c-white">Add product</h1>
                @include('admin_layouts.slug_error')
                <form method="POST" action="{{route('add_product')}}" class="ml-3" >
                    @csrf
                    <div class="contanier mt-3">
                            <div class="input-group row">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" >Product Url</span>
                                </div>
                                <input type="text" name="url" class="form-control" value="{{(old('url'))?old('url'):''}}" >
                            </div>
                            @if ($errors->has('url'))
                                <div class="alert alert-danger mr-4" role="alert" >
                                    {{ $errors->first('url') }}
                                </div>
                            @endif
                     </div>
                    {{--<div class="d-flex flex-wrap row">--}}
                        {{--<div class="input-group mt-3 col-md-12">--}}
                            {{--<span class="input-group-text" >Popular</span>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-12 mt-2">--}}
                            {{--<input type="radio" name="popular"  value="1"><label>yes</label>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-12 mt-2">--}}
                            {{--<input type="radio" name="popular"  value="0"><label>no</label>--}}
                        {{--</div>--}}
                        {{--@if ($errors->has('popular'))--}}
                            {{--<div class="alert alert-danger mr-4" role="alert" >--}}
                                {{--{{ $errors->first('popular') }}--}}
                            {{--</div>--}}
                        {{--@endif--}}
                    {{--</div>--}}

                    <div class="contanier mt-3">
                        <select class="js-example-basic-single" name="category">
                            <option value=""  {{(!old('parent_category'))?'selected':''}}>Select category</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}" {{(old('parent_category')==$category->name)?'selected':''}}>{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success mt-3 mb-3">
                        {{ __('Add') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection