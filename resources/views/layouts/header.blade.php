@php

$headerArray = \App\Helpers\DatabaseHelper::headerContent();
$header =  $headerArray['header'];
$showCategories = $headerArray['show_categories'];
@endphp

    <header class="header">
        <div class="header--top">
            <div class="container text-center">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('images/logo-02.png') }}" alt="Amazcoup logo" class="img-fluid center-block logo">
                </a>
            </div>
        </div>
        <div class="header--main">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-dark">
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>


                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto main-menu">
                            <li class="nav-item {{(Request::path() == 'new') ? 'active' : ''}}">
                                <a class="nav-link" href="{{url('/new')}}" >What’s New</a>
                            </li>
                            @foreach ($header as $head)
                                <li class="nav-item {{(Request::path() == $head->slug) ? 'active' : ''}}">
                                    <a class="nav-link" href="{{url($head->slug.'-'.$head->id)}}" >{{$head->name}}</a>
                                </li>
                            @endforeach

                            <li class="dropdown" >
                                <button class="btn main-menu-dropdown dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Categories
                                </button>
                                <!--style="height: auto;max-height: 150px;overflow-x: hidden;"-->
                                <div class="dropdown-menu" aria-labelledby="dropdownMenu2" >
                                    @foreach($showCategories as $showCategory)
                                      <a class="dropdown-item " style="font-size: small" href="{{url($showCategory->slug.'-'.$showCategory->id)}}">{{$showCategory->name}}</a>
                                    @endforeach
                                </div>
                            </li>

                            <li class="nav-item {{(Request::path() == 'contact') ? 'active' : ''}}">
                                <a class="nav-link" href="{{ url('/contact') }}">Contact Us</a>
                            </li>
                        </ul>
                        <form class="form-inline my-2 my-lg-0 search--form justify-content-between"  action="javascript:void(0)">
                            <input id="search-button" class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search" >
                            <button class="search--btn" type="button">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>
                    </div>
                </nav>
            </div>
        </div>
    </header>
