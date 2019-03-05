@extends('admin_layouts.app')

@section('body')
    <div class="col-md-12">
        <div class="container " style="width:700px" id="edit-configurations">
            <div class="bd bdrs-3 p-20 mB-20  border border-primary rounded bg-primary" style="width:700px">

                <h4 class="c-white mT-10 mB-30">Edit configurations</h4>
                @include('admin_layouts.slug_error')
                @include('admin_layouts.complete')
                <form method="POST" action="{{route('edit_configuration')}}" enctype="multipart/form-data">
                    @csrf

                    <div class="input-group mt-3" style="width:230px">
                        <div class="input-group-prepend">
                            <span class="input-group-text" >Gifts under price $</span>
                        </div>

                        <input type="text" class="form-control" name="under_price"  value="{{(old('under_price'))?old('under_price'):$configuration->gifts_under_price}}" >
                    </div>
                    @if ($errors->has('under_price'))
                        <div class="alert alert-danger" role="alert" >
                            {{ $errors->first('under_price') }}
                        </div>
                    @endif


                    <div class="input-group mt-3" style="width:230px">
                        <div class="input-group-prepend">
                            <span class="input-group-text" >Price range max $</span>
                        </div>

                        <input type="text" class="form-control" name="price_range_max"  value="{{(old('price_range_max'))?old('price_range_max'):$configuration->price_range}}" >
                    </div>
                    @if ($errors->has('price_range_max'))
                        <div class="alert alert-danger" role="alert" >
                            {{ $errors->first('price_range_max') }}
                        </div>
                    @endif
                    <button type="submit" class="btn btn-success mt-3 mb-3">
                        {{ __('Save') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection