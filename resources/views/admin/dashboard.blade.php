@extends('admin_layouts.app')

@section('body')

    <div class="container" id="dashboard">
        <h1>Dashboard</h1>
        <a class="btn btn-outline-primary" href="{{url('/admin/add/category')}}" role="button">
                    <span class="icon-holder">
                      <i class="fas fa-pencil-alt c-green-300"></i>
                    </span>
            <span class="title">Add Category</span>
        </a><br>
        <a href=" {{url('/admin/add')}}" class="btn btn-outline-primary mt-2">
                    <span class="icon-holder">
                      <i class="fas fa-pencil-alt c-green-300"></i>
                    </span>
            <span class="title">Add Product</span>
        </a><br>
        <a href=" {{url('/admin/configurations')}}" class="btn btn-outline-primary mt-2">
                    <span class="icon-holder">
                      <i class="fas fa-pencil-alt c-green-300"></i>
                    </span>
            <span class="title">Configurations</span>
        </a>


    </div>

@endsection
