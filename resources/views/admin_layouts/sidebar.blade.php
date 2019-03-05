<div class="sidebar">
    <div class="sidebar-inner ">
        <!-- ### $Sidebar Header ### -->
        <div class="sidebar-logo">
            <div class="peers ai-c fxw-nw">
                <div class="peer peer-greed">
                    <a class="sidebar-link td-n" href="{{route('admin_dashboard')}}">
                        <div class="peers ai-c fxw-nw">
                            <div class="peer ">
                                <div class="logo" >
                                    <img src="{{asset("images/logo.png")}}" >
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="peer">
                    <div class="mobile-toggle sidebar-toggle">
                        <a href="" class="td-n">
                            <i class="ti-arrow-circle-left"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- ### $Sidebar Menu ### -->
        <ul class="sidebar-menu scrollable pos-r">
            <li class="nav-item mT-5 active">
                <a class="sidebar-link" href="{{route('admin_dashboard')}}">
                <span class="icon-holder">
                  <i class="c-blue-500 ti-home"></i>
                </span>
                    <span class="title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a href=" {{url('/admin/products')}}" class="sidebar-link">
                    <span class="icon-holder">
                      <i class="far fa-edit c-green-500"></i>
                    </span>
                    <span class="title ">Products</span>
                </a>
            </li>
            <li class="nav-item">
                <a class='sidebar-link' href="{{url('/admin/edit/categories')}}">
                <span class="icon-holder">
                  <i class="c-green-500 ti-pencil"></i>
                </span>
                    <span class="title">Categories</span>
                </a>
            </li>
        </ul>
    </div>
</div>
