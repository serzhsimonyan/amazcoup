@extends('admin_layouts.app')

@section('body')
    <div class="col-md-12">

        <div class="container border border-primary rounded bg-primary" style="width:700px" id="add-category">
            <h4 class="c-white mT-10 mB-30">Add category</h4>
            @include('admin_layouts.slug_error')
            @include('admin_layouts.complete')
            <form method="POST" action="{{route('add_category')}}" enctype="multipart/form-data">
                    @csrf

                    <div class="input-group mt-3">
                            <div class="input-group-prepend">
                                    <span class="input-group-text" >Title</span>
                            </div>
                            <input type="text" name="name" class="form-control" value="{{(old('name'))?old('name'):''}}" >
                    </div>
                            @if ($errors->has('name'))
                                <div class="alert alert-danger" role="alert">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                    <div class="contanier">
                            <div class="input-group mt-3">
                                    <div class="input-group-prepend">
                                           <span class="input-group-text">Description</span>
                                    </div>
                                    <textarea class="form-control" rows="5" name="description">{{(old('description'))?old('description'):''}}</textarea>
                            </div>
                            @if($errors->has('description'))
                                <div class="alert alert-danger" role="alert" >
                                    {{ $errors->first('description') }}
                                </div>
                            @endif
                    </div>
                    <div class="contanier mt-3">
                            <select class="js-example-basic-single" name="parent_category">
                                    <option value=""  {{(!old('parent_category'))?'selected':''}}>Select parent</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->name}}" {{(old('parent_category')==$category->name)?'selected':''}}>{{$category->name}}</option>
                                    @endforeach
                            </select>
                    </div>
                    <button type="submit" class="btn btn-success mt-3 mb-3">
                        {{ __('Add') }}
                    </button>
            </form>
        </div>
    </div>
@endsection