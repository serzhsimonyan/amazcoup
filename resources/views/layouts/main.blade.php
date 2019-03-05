@extends('layouts.app')

@section('body')
    <div id="main">
        @yield('content')
    </div>
    @include('layouts.product_and_pagination')
@endsection

