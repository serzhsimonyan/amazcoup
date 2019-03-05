@extends('admin_layouts.app')

@section('body')
        <div class="col-md-12">
            <div class="container " style="width:700px" id="edit-category">
                <div class="bd bdrs-3 p-20 mB-20  border border-primary rounded bg-primary" style="width:700px">

                    <h4 class="c-white mT-10 mB-30">Edit category</h4>
                    @include('admin_layouts.slug_error')
                    @include('admin_layouts.complete')
                    <form method="POST" action="{{route('edit_category')}}" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="id" class="form-control" value="{{$category->id}}"  >
                        <div class="input-group mt-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" >Title</span>
                            </div>
                            <input type="text" name="name" class="form-control" value="{{(old('name'))?old('name'):$category->name}}" >
                        </div>
                        @if ($errors->has('name'))
                            <div class="alert alert-danger" role="alert" >
                                {{ $errors->first('name') }}
                            </div>
                        @endif

                        <div class="d-flex flex-wrap row">
                            <div class="input-group mt-3 col-md-12">
                                <span class="input-group-text" >Show in footer ?</span>
                            </div>
                            <div class="col-md-12 mt-2">
                                <input type="radio" name="footer_show" {{($category->footer_show)?'checked':''}} value="1" ><label class="text-dark ml-1">yes</label>
                            </div>
                            <div class="col-md-12">
                                <input type="radio" name="footer_show" {{(!$category->footer_show)?'checked':''}} value="0"><label class="text-dark ml-1">no</label>
                            </div>
                        </div>

                        @if($errors->has('footer_show'))
                            <div class="alert alert-danger" role="alert" >
                                {{ $errors->first('footer_show') }}
                            </div>
                        @endif

                        @if(!$category->source_url)
                            <div class="d-flex flex-wrap row">
                                <div class="input-group mt-3 col-md-12">
                                    <span class="input-group-text" >Delete this category?</span>
                                </div>
                                <div class="col-md-12 mt-2">
                                    <input type="checkbox" name="category_delete" value="1" {{old('category_delete')? 'checked' :''}}><label class="text-dark ml-1">yes</label>
                                </div>
                            </div>
                        @endif

                        <div class="contanier">
                            <div class="input-group mt-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Description</span>
                                </div>
                                <textarea class="form-control" rows="5" name="description">{{(old('description'))?old('description'):$category->description}}</textarea>
                            </div>
                            @if($errors->has('description'))
                                <div class="alert alert-danger" role="alert" >
                                    {{ $errors->first('description') }}
                                </div>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-success mt-3 mb-3">
                            {{ __('Save') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
@endsection